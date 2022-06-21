<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Content;
use App\Services\CalculatorService;
use App\Services\SeoService;
use App\Mail\CustomerQuery;
use App\Services\ApiOrderService;
use App\Services\PageService;


class HomeController extends Controller
{
    private $seoService;
    private $pageService;

    function __construct(SeoService $seoService, PageService $pageService)
    {
        $this->seoService = $seoService;
        $this->pageService = $pageService;
    }

    public function index()
    {
        if (env('ENABLE_APP_SETUP_CONFIG') != TRUE) {
            return redirect()->route('installer_page');
        }

        $data = $this->pageService->calculatorData('home');

        return view('website.index', compact('data'));
    }

    function pricing(CalculatorService $calculator)
    {
        $this->seoService->load('pricing');

        return view('website.pricing')->with(['data' => $calculator->priceList()]);
    }

    function content(Request $request)
    {
        $this->seoService->load($request->route()->getName());

        $slug = $request->segment(count($request->segments()));

        $content = Content::where('slug', $slug)->get();

        if ($content->count() > 0) {
            $content = $content->first();
        } else {
            abort(404);
        }

        return view('website.content')->with('content', $content);
    }

    function contact()
    {
        $this->seoService->load('contact');

        return view('website.contact');
    }

    function handle_email_query(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Mail::to(settings('company_email'))->send(new CustomerQuery($request->all()));

        $request->session()->flash('alert-class', 'alert-success');
        $request->session()->flash('message', 'Thank you for your query. We will get back to you as soon as possible');

        return redirect()->back();
    }
}
