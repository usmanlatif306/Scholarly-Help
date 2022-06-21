<?php

namespace App\Http\Controllers;

use App\PastWork;
use App\Services\PageService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PastWorkController extends Controller
{
    private $pageService;

    function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setup.works.index');
    }

    public function datatable(Request $request)
    {
        $works = PastWork::orderBy('name', 'ASC');


        return Datatables::eloquent($works)->editColumn('name', function ($page) {

            return '<a href="' . route('works.edit', $page->id) . '">' . $page->name . '</a>';
        })

            ->addColumn('action', function ($page) {

                return '<a class="btn btn-sm btn-danger delete-item" href="' . route('works_delete', $page->id) . '"><i class="fas fa-minus-circle"></i></a>';
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
        $pages = $this->pageService->pages();
        return view('setup.works.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'page' => 'required',
            'name' => 'required',
            'file' => 'required|file|max:8192',
        ]);

        $file = $request->file('file')->getClientOriginalName();
        $name = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $fileName = $name . "-" . time() . "." . $extension;
        $request->file('file')->storeAs("files", $fileName, "public");

        $path = 'storage/files/' . $fileName;

        PastWork::create([
            'page' => $request->page,
            'name' => $request->name,
            'file' => $path,
        ]);

        return redirect()->back()->withSuccess('File uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PastWork  $pastWork
     * @return \Illuminate\Http\Response
     */
    public function show(PastWork $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PastWork  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(PastWork $work)
    {

        $pages = $this->pageService->pages();
        return view('setup.works.edit', compact('work', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PastWork  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PastWork $work)
    {
        $request->validate([
            'page' => 'required',
            'name' => 'required',
        ]);
        $work->update($request->all());
        if ($request->has('file')) {
            $file = $request->file('file')->getClientOriginalName();
            $name = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $fileName = $name . "-" . time() . "." . $extension;
            $request->file('file')->storeAs("files", $fileName, "public");
            $path = 'storage/files/' . $fileName;

            unlink($work->file);
            $work->update(['file' => $path]);
        }

        return redirect()->back()->withSuccess('File updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PastWork  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(PastWork $work)
    {
        unlink($work->file);
        $work->delete();
        return redirect()->back()->withSuccess('File deleted successfully');
    }
}
