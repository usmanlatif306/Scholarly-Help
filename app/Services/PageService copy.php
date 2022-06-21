<?php

namespace App\Services;

use App\AssignmentPage;
use App\Choice;
use App\Service;
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
        $data['works'] = PastWork::where('page', $props)->get();
        $writers_all = User::with(['ratings_received'])->withCount(['tasks', 'tags', 'ratings_received', 'records'])->where('role_id', 2)->inRandomOrder()->get();
        $data['ratings'] = Rating::with(['user'])->where(function ($query) {
            $query->where('number', '>=', 4);
        })->get();
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
