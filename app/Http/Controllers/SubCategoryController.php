<?php

namespace App\Http\Controllers;

use App\Enums\PriceType;
use App\Http\Requests\StoreServicesRequest;
use App\Service;
use App\SubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setup.sub_category.index');
    }

    public function datatable(Request $request)
    {
        $services = SubCategory::with('price_type')->orderBy('name', 'ASC');

        if (!$request->include_inactive_items) {
            $services->whereNull('inactive');
        }

        return Datatables::eloquent($services)->editColumn('name', function ($service) {

            return '<a href="' . route('sub_category_edit', $service->id) . '">' . $service->name . '</a>';
        })
            ->addColumn('price_type', function ($service) {
                return $service->price_type->name;
            })
            ->addColumn('status', function ($service) {
                return ($service->inactive) ? 'Inactive' : 'Active';
            })
            ->addColumn('action', function ($service) {

                return '<a class="btn btn-sm btn-danger delete-item" href="' . route('sub_category_delete', $service->id) . '"><i class="fas fa-minus-circle"></i></a>';
            })
            ->rawColumns([
                'name',
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
        $service = new \StdClass();
        $service->price_type_id = PriceType::Fixed;
        $data = SubCategory::dropdown();
        $services = SubCategory::all();
        // dd($data['additional_services_list']);
        return view('setup.sub_category.create', compact('service', 'data', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServicesRequest $request)
    {
        $request['inactive'] = (isset($request->inactive)) ? TRUE : NULL;

        if ($request->price_type_id == PriceType::Fixed) {
            $request['minimum_order_quantity'] =   1;
        }

        $service = SubCategory::create($request->all());

        return redirect()->back()->withSuccess('Successfully created a new service');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $data = SubCategory::dropdown();

        $services = SubCategory::all();
        $service = $subCategory;

        return view('setup.sub_category.create', compact('service', 'data', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request['inactive'] = (isset($request->inactive)) ? TRUE : NULL;

        if ($request->price_type_id == PriceType::Fixed) {
            $request['minimum_order_quantity'] =   1;
        }
        $subCategory->fill($request->all());
        $subCategory->update();

        return redirect()->back()->withSuccess('Successfully updated the service item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $redirect = redirect()->route('sub_category_list');

        try {

            $subCategory->delete();
            $redirect->withSuccess('Successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            $redirect->withFail('You cannot delete the service as it is associated with one or multiple orders');
        } catch (\Exception $e) {
            $redirect->withFail('Could not perform the requested action');
        }
        return $redirect;
    }

    public function getSubCategoriesByServiceId(Request $request)
    {
        $service = Service::find($request->service_id);
        $subCategories = $service->subCategories()->select(['sub_categories.id', 'name', 'price_type_id', 'price', 'single_spacing_price', 'double_spacing_price', 'minimum_order_quantity'])->get();
        return response()->json($subCategories);
    }
}
