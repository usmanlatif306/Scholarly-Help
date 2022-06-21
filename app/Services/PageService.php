<?php

namespace App\Services;

use App\AssignmentPage;
use App\Choice;
use App\Faq;
use App\Order;
use App\Quality;
use App\Rating;
use App\Subject;
use App\Tag;
use App\User;
use App\HomeWorkPage;
use App\OnlineClassPage;
use App\OnlineExamPage;
use App\PastWork;
use App\Service;

class PageService
{
    private $seoService;
    function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function calculatorData($props)
    {
        $this->seoService->load($props);
        $data = Order::dropdown('home');
        $data['title'] = 'Let\'s get started on your project!';

        $data['subjects'] = Tag::orderBy('name')->get();
        $data['faqs'] = Faq::where('page', $props)->get();
        $data['guarantees'] = Choice::all();
        $data['services'] = Quality::all();

        $services = Service::with(['subCategories'])->whereNull('inactive')->get();
        $service_arr = [];
        foreach ($services  as $key => $service) {
            $newItem = [];
            $newItem['category'] = $service->name;
            if ($service->subCategories && count($service->subCategories) > 0) {
                $sub_categories = $service->subCategories;
                foreach ($sub_categories as $val => $item) {
                    $item["parent"] = 0;
                    $item["service_id"] = $service->id;
                    $newItem['subcategory'][] = $item;
                }
            } else {
                $newItem['subcategory'][] = $service;
            }
            $service_arr[] = $newItem;
        }
        $data['service_id_list'] = $service_arr;

        $data['works'] = PastWork::where('page', $props)->get();
        $writers_all = User::has('completed_orders')->with(['ratings_received'])->where('role_id', 2)->inRandomOrder()->get();

        $data['ratings'] = Rating::with(['user'])->where(function ($query) {
            $query->where('number', '>=', 4);
        })->get();
        // $data['subjs'] = Subject::all();
        $writers = [];

        foreach ($writers_all  as $writer) {
            if ($writer->ratings_received->avg('number') >= 4) {
                $writers[] =  $writer;
            }
        }
        $data['writers'] = array_chunk($writers, 20)[0];
        return $data;
    }

    // fetching all subcategory pages

    public function pages()
    {
        $pages = [];
        $pages['class'] = OnlineClassPage::select(['name', 'slug'])->get();
        $pages['exam'] = OnlineExamPage::select(['name', 'slug'])->get();
        $pages['homework'] = HomeWorkPage::select(['name', 'slug'])->get();
        $pages['assignment'] = AssignmentPage::select(['name', 'slug'])->get();

        return $pages;
    }
}
