<?php

namespace App\Http\Controllers\Api;

use App\AdditionalService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\WritersResource;
use App\Guarantee;
use App\Service;
use App\SubCategory;
use App\Tag;
use App\Urgency;
use App\User;
use App\WorkLevel;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    // fetching writers base on subject
    public function fetchWriters(Request $request)
    {
        $subject = $request->query('subject');

        $writers = User::withCount(['completed_orders'])->with(['ratings_received'])->whereHas('tags', function ($query) use ($subject) {
            $query->where('name', $subject);
        })->where('role_id', 2)->get();

        return response()->json([
            'error' => false,
            'writers' => WritersResource::collection($writers),
        ]);
    }

    // writers which are not present on api side
    public function apiWriters(Request $request)
    {
        $writers = User::where('role_id', 2)->whereNull('deleted_at')->get()->makeVisible('password');

        return response()->json([
            'error' => false,
            'writers' => $writers,
        ]);
    }

    // sending services to request
    public function services()
    {
        $data['guarantees'] = Guarantee::get();
        $data['services'] = Service::get();
        $data['sub_categories'] = SubCategory::get();
        $data['tags'] = Tag::get();
        $data['work_levels'] = WorkLevel::get();
        $data['urgencies'] = Urgency::get();
        $data['additional_services'] = AdditionalService::get();
        $data['service_tag_additional_services'] = DB::table('service_tag_additional_services')->get();
        $data['service_tag_sub_categories'] = DB::table('service_tag_sub_categories')->get();

        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }
}
