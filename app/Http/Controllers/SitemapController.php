<?php

namespace App\Http\Controllers;

use App\About;
use App\Assignment;
use App\AssignmentPage;
use App\Contact;
use Illuminate\Http\Request;
use App\Content;
use App\EssayWriting;
use App\HomeWork;
use App\HomeWorkPage;
use App\OnlineClass;
use App\OnlineClassPage;
use App\OnlineExam;
use App\OnlineExamPage;
use App\Services\PageService;
use Carbon\Carbon;

class SitemapController extends Controller
{

    private $pageService;
    function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index(Request $request)
    {
        // return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
        $contents['online-class'] = OnlineClass::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['online-class'];
        $contents['online-exam'] = OnlineExam::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['online-exam'];
        $contents['homework'] = HomeWork::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['homework'];
        $contents['assignment'] = Assignment::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['assignment'];
        $contents['essay-writing'] = EssayWriting::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['essay-writing'];
        $contents['contact-us'] = Contact::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['contact-us'];
        $contents['about-us'] = About::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['about-us'];
        $classPages = OnlineClassPage::select(['updated_at', 'slug'])->get()->pluck('updated_at', 'slug');
        $examPages = OnlineExamPage::select(['updated_at', 'slug'])->get()->pluck('updated_at', 'slug');
        $homeworkPages = HomeWorkPage::select(['updated_at', 'slug'])->get()->pluck('updated_at', 'slug');
        $assignmentPages = AssignmentPage::select(['updated_at', 'slug'])->get()->pluck('updated_at', 'slug');

        // creating content for sub category pages
        foreach ($classPages as $key => $value) {
            $contents[$key] = $value;
        }
        foreach ($examPages as $key => $value) {
            $contents[$key] = $value;
        }
        foreach ($homeworkPages as $key => $value) {
            $contents[$key] = $value;
        }
        foreach ($assignmentPages as $key => $value) {
            $contents[$key] = $value;
        }

        // dd($contents);

        $homepage_last_updated_at = settings('homepage_last_updated_at');

        if ($homepage_last_updated_at) {
            $homepage_last_updated_at = Carbon::createFromDate($homepage_last_updated_at);
        }

        $data['routes'] = [
            'homepage' => [
                'route' => '',
                'date' => $homepage_last_updated_at
            ],
            'online_class_page' => [
                'route' => '',
                'date' => optional($contents)['online-class']
            ],
            'exam_page' => [
                'route' => '',
                'date' => optional($contents)['online-exam']
            ],
            'homework_page' => [
                'route' => '',
                'date' => optional($contents)['homework']
            ],
            'assignment_page' => [
                'route' => '',
                'date' => optional($contents)['assignment']
            ],
            'essay_writing_page' => [
                'route' => '',
                'date' => optional($contents)['essay-writing']
            ],
            'contact_page' => [
                'route' => '',
                'date' => optional($contents)['contact-us']
            ],
            'about_page' => [
                'route' => '',
                'date' => optional($contents)['about-us']
            ],

        ];

        // creating routes for sub category pages
        foreach ($classPages as $key => $value) {
            $data['sub_pages'][] = [
                'route' => 'class_page_sub',
                'slug' => $key,
                'date' => optional($contents)[$key]
            ];
        }
        foreach ($examPages as $key => $value) {
            $data['sub_pages'][] = [
                'route' => 'exam_page_sub',
                'slug' => $key,
                'date' => optional($contents)[$key]
            ];
        }
        foreach ($homeworkPages as $key => $value) {
            $data['sub_pages'][] = [
                'route' => 'homework_page_sub',
                'slug' => $key,
                'date' => optional($contents)[$key]
            ];
        }
        foreach ($assignmentPages as $key => $value) {
            $data['sub_pages'][] = [
                'route' => 'assignment_page_sub',
                'slug' => $key,
                'date' => optional($contents)[$key]
            ];
        }
        // dd($data['sub_pages']);

        return response()->view('sitemap.index', compact('data'))->header('Content-Type', 'text/xml');
    }

    public function page(Request $request)
    {

        // $contents = Content::select('updated_at', 'slug')->whereIn('slug', [
        //     'how-it-works',
        //     'faq',
        //     'money-back-guarantee',
        //     'privacy-policy',
        //     'revision-policy',
        //     'disclaimer',
        //     'terms-and-conditions'
        // ])->pluck('updated_at', 'slug');
        $contents['online-class'] = OnlineClass::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['online-class'];
        $contents['online-exam'] = OnlineExam::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['online-exam'];
        $contents['homework'] = HomeWork::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['homework'];
        $contents['assignment'] = Assignment::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['assignment'];
        $contents['essay-writing'] = EssayWriting::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['essay-writing'];
        $contents['contact-us'] = Contact::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['contact-us'];
        $contents['about-us'] = About::select('updated_at', 'slug')->first()->pluck('updated_at', 'slug')['about-us'];
        $classPages = OnlineClassPage::select(['updated_at', 'slug'])->get()->pluck('updated_at', 'slug');
        $examPages = OnlineExamPage::select(['updated_at', 'slug'])->get()->pluck('updated_at', 'slug');
        $homeworkPages = HomeWorkPage::select(['updated_at', 'slug'])->get()->pluck('updated_at', 'slug');

        // creating content for sub category pages
        foreach ($classPages as $key => $value) {
            $contents[$key] = $value;
        }
        foreach ($examPages as $key => $value) {
            $contents[$key] = $value;
        }
        foreach ($homeworkPages as $key => $value) {
            $contents[$key] = $value;
        }

        // dd($contents);

        $homepage_last_updated_at = settings('homepage_last_updated_at');

        if ($homepage_last_updated_at) {
            $homepage_last_updated_at = Carbon::createFromDate($homepage_last_updated_at);
        }


        $data['routes'] = [
            'homepage' => [
                'route' => '',
                'date' => $homepage_last_updated_at
            ],
            'online_class_page' => [
                'route' => '',
                'date' => optional($contents)['online-class']
            ],
            'exam_page' => [
                'route' => '',
                'date' => optional($contents)['online-exam']
            ],
            'homework_page' => [
                'route' => '',
                'date' => optional($contents)['homework']
            ],
            'assignment_page' => [
                'route' => '',
                'date' => optional($contents)['assignment']
            ],
            'essay_writing_page' => [
                'route' => '',
                'date' => optional($contents)['essay-writing']
            ],
            'contact_page' => [
                'route' => '',
                'date' => optional($contents)['contact-us']
            ],
            'about_page' => [
                'route' => '',
                'date' => optional($contents)['about-us']
            ],

        ];

        // creating routes for sub category pages
        foreach ($classPages as $key => $value) {
            $data['sub_pages'][] = [
                'route' => 'class_page_sub',
                'slug' => $key,
                'date' => optional($contents)[$key]
            ];
        }
        foreach ($examPages as $key => $value) {
            $data['sub_pages'][] = [
                'route' => 'exam_page_sub',
                'slug' => $key,
                'date' => optional($contents)[$key]
            ];
        }
        foreach ($homeworkPages as $key => $value) {
            $data['sub_pages'][] = [
                'route' => 'homework_page_sub',
                'slug' => $key,
                'date' => optional($contents)[$key]
            ];
        }
        // dd($data['sub_pages']);

        return response()->view('sitemap.page', compact('data'))->header('Content-Type', 'text/xml');
    }
}
