<?php

namespace App\Http\Controllers;

use App\Guarantee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class GuaranteeController extends Controller
{
    public function index()
    {
        return view('setup.guarantee.index');
    }

    public function datatable(Request $request)
    {
        $guarantees = Guarantee::orderBy('name', 'ASC');

        if (!$request->include_inactive_items) {
            $guarantees->whereNull('inactive');
        }

        return Datatables::eloquent($guarantees)->editColumn('name', function ($guarantee) {

            return '<a href="' . route('guarantees_edit', $guarantee->id) . '">' . $guarantee->name . '</a>';
        })
            ->editColumn('percentage_to_add', function ($guarantee) {
                return $guarantee->percentage_to_add . '%';
            })
            ->addColumn('status', function ($guarantee) {
                return ($guarantee->inactive) ? 'Inactive' : 'Active';
            })
            ->addColumn('action', function ($guarantee) {

                return '<a class="btn btn-sm btn-danger delete-item" href="' . route('guarantees_delete', $guarantee->id) . '"><i class="fas fa-minus-circle"></i></a>';
            })
            ->rawColumns([
                'name',
                'percentage_to_add',
                'status',
                'action'
            ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $guarantee = new \StdClass();

        return view('setup.guarantee.create', compact('guarantee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:work_levels',
            'percentage_to_add' => 'required|numeric|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $request['inactive'] = (isset($request->inactive)) ? TRUE : NULL;

        Guarantee::create($request->all());

        return redirect()->back()->withSuccess('Created a new guarantee');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guarantee $guarantee)
    {
        return view('setup.guarantee.create', compact('guarantee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:work_levels,id,' . $id,
            'percentage_to_add' => 'required|numeric|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $request['inactive'] = (isset($request->inactive)) ? TRUE : NULL;

        Guarantee::where('id', $id)->update($request->only('name', 'percentage_to_add', 'inactive'));

        return redirect()->back()->withSuccess('Updated the guarantee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Guarantee $guarantee)
    {
        $redirect = redirect()->route('guarantee_list');
        try {
            $guarantee->delete();
            $redirect->withSuccess('Successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {

            $redirect->withFail('Cannot be deleted as it is associated with one or multiple orders');
        } catch (\Exception $e) {
            $redirect->withFail('Could not perform the requested action');
        }

        return $redirect;
    }
}
