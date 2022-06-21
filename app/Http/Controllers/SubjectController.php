<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index()
    {
        return view('setup.subject.index');
    }

    public function datatable(Request $request)
    {
        $guarantees = Subject::orderBy('name', 'ASC');


        return Datatables::eloquent($guarantees)->editColumn('name', function ($guarantee) {

            return '<a href="' . route('subject_edit', $guarantee->id) . '">' . $guarantee->name . '</a>';
        })

            ->addColumn('action', function ($guarantee) {

                return '<a class="btn btn-sm btn-danger delete-item" href="' . route('subject_delete', $guarantee->id) . '"><i class="fas fa-minus-circle"></i></a>';
            })
            ->rawColumns([
                'name',
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

        $subject = new \StdClass();

        return view('setup.subject.create', compact('subject'));
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
            'name' => 'required|unique:subjects',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Subject::create($request->all());

        return redirect()->back()->withSuccess('Created a new subject');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('setup.subject.create', compact('subject'));
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
            'name' => 'required|unique:subjects,id,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        Subject::where('id', $id)->update($request->only('name'));

        return redirect()->back()->withSuccess('Updated the subject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Subject $subject)
    {
        $redirect = redirect()->route('subject_list');
        try {
            $subject->delete();
            $redirect->withSuccess('Successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {

            $redirect->withFail('Cannot be deleted as it is associated with one or multiple orders');
        } catch (\Exception $e) {
            $redirect->withFail('Could not perform the requested action');
        }

        return $redirect;
    }
}
