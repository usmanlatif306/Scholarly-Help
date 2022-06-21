<?php

namespace App\Http\Controllers;

use App\AssignmentPage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AssignmentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setup.pages.assignment.index');
    }
    public function datatable(Request $request)
    {
        $pages = AssignmentPage::orderBy('name', 'ASC');

        return Datatables::eloquent($pages)->editColumn('name', function ($page) {

            return '<a href="' . route('assignment.pages.edit', $page->id) . '">' . $page->name . '</a>';
        })

            ->addColumn('action', function ($page) {

                return '<a class="btn btn-sm btn-danger delete-item" href="' . route('assignment.page_delete', $page->id) . '"><i class="fas fa-minus-circle"></i></a>';
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
        $page = NULL;
        $data['fields'] = AssignmentPage::form_elements();
        return view('setup.pages.assignment.create', compact('data', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::slug($request->name);
        AssignmentPage::create($request->all());

        return redirect()->back()->withSuccess('Created a new page');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignmentPage  $page
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentPage $page)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignmentPage  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentPage $page)
    {
        $data['fields'] = AssignmentPage::form_elements();
        return view('setup.pages.assignment.create', compact('page', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignmentPage  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignmentPage $page)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::slug($request->name);
        $page->update($request->all());
        return redirect()->back()->withSuccess('Page Content Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignmentPage  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentPage $page)
    {
        $redirect = redirect()->route('assignment.pages.index');
        try {
            $page->delete();
            $redirect->withSuccess('Successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {

            $redirect->withFail('Cannot be deleted as it is associated with one or multiple orders');
        } catch (\Exception $e) {
            $redirect->withFail('Could not perform the requested action');
        }

        return $redirect;
    }
}
