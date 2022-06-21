<?php

namespace App\Http\Controllers;

use App\About;
use App\Assignment;
use App\AssignmentPage;
use App\Services\SeoService;
use Illuminate\Http\Request;
use App\Choice;
use App\Contact;
use App\EssayWriting;
use App\Service;
use App\Faq;
use App\HomeWork;
use App\HomeWorkPage;
use App\OnlineClass;
use App\OnlineClassPage;
use App\OnlineExam;
use App\OnlineExamPage;
use App\Order;
use App\Page;
use App\Quality;
use App\Rating;
use App\Services\PageService;
use App\Subject;
use App\Tag;
use App\Testimonial;
use App\Tutor;
use App\User;

class PagesController extends Controller
{
    private $seoService;
    private $pageService;
    function __construct(SeoService $seoService, PageService $pageService)
    {
        $this->seoService = $seoService;
        $this->pageService = $pageService;
    }
    // Online class page
    public function class()
    {
        $data = $this->pageService->calculatorData('online_class');
        $data['subjs'] = OnlineClassPage::select(['name', 'slug'])->get();
        $class = OnlineClass::first();
        return view('website.pages.class', compact('data', 'class'));
    }

    // Online exam page
    public function exam()
    {
        $data = $this->pageService->calculatorData('online_exam');
        $data['subjs'] = OnlineExamPage::select(['name', 'slug'])->get();
        $exam = OnlineExam::first();
        return view('website.pages.exam', compact('data', 'exam'));
    }

    // homework page
    public function homework()
    {
        $data = $this->pageService->calculatorData('homework');
        $data['subjs'] = HomeWorkPage::select(['name', 'slug'])->get();
        $homework = HomeWork::first();
        return view('website.pages.homework', compact('data', 'homework'));
    }

    // Online assignment page
    public function assignment()
    {
        $data = $this->pageService->calculatorData('assignment');
        $data['subjs'] = AssignmentPage::select(['name', 'slug'])->get();
        $assignment = Assignment::first();
        return view('website.pages.assignment', compact('data', 'assignment'));
    }

    // Online essay page
    public function essay()
    {
        $data = $this->pageService->calculatorData('essay_writing');
        $essay = EssayWriting::first();

        return view('website.pages.essay', compact('data', 'essay'));
    }

    // tools
    public function tools()
    {
        return view('website.pages.tools');
    }

    // blog
    public function blogs()
    {
        return view('website.pages.blog');
    }

    // contact us
    public function contacts()
    {
        $data = $this->pageService->calculatorData('contact_us');
        $page = Contact::first();

        return view('website.pages.contact', compact('data', 'page'));
    }

    // about us
    public function about()
    {
        $data = $this->pageService->calculatorData('about_us');
        $page = About::first();

        return view('website.pages.about', compact('data', 'page'));
    }

    // online exam sub category page
    public function examPages(OnlineExamPage $page)
    {
        $data = $this->pageService->calculatorData($page->slug . '_exam');
        return view('website.pages.subPages.exam', compact('page', 'data'));
    }
    // online class sub category page
    public function classPages(OnlineClassPage $page)
    {
        $data = $this->pageService->calculatorData($page->slug . '_class');
        return view('website.pages.subPages.class', compact('page', 'data'));
    }

    // homework sub category page
    public function homeworkPages(HomeWorkPage $page)
    {
        $data = $this->pageService->calculatorData($page->slug . '_homework');
        return view('website.pages.subPages.homework', compact('page', 'data'));
    }

    // homework sub category page
    public function assignmentPages(AssignmentPage $page)
    {
        $data = $this->pageService->calculatorData($page->slug . '_assignment');
        return view('website.pages.subPages.assignment', compact('page', 'data'));
    }
}
