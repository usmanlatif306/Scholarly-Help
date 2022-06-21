<?php

namespace App\Http\Controllers;

use App\About;
use App\Assignment;
use App\Contact;
use App\EssayWriting;
use App\HomeWork;
use App\OnlineClass;
use App\OnlineExam;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    // oline class
    public function class()
    {
        $class = OnlineClass::find(1);
        return  view('setup.pages.class', compact('class'));
    }

    public function update_class(Request $request)
    {
        $class = OnlineClass::find(1);
        $class->update($request->all());
        return redirect()->back();
    }

    // oline exam
    public function exam()
    {
        $data['fields'] = OnlineExam::form_elements();
        $exam = OnlineExam::find(1);

        return view('setup.pages.exam', compact('exam', 'data'));
    }

    public function update_exam(Request $request)
    {
        $exam = OnlineExam::find(1);
        $exam->update($request->all());
        return redirect()->back();
    }


    // homework
    public function homework()
    {
        $data['fields'] = HomeWork::form_elements();
        $homework = HomeWork::find(1);

        return  view('setup.pages.homework', compact('homework', 'data'));
    }

    public function update_homework(Request $request)
    {
        $homework = HomeWork::find(1);

        $homework->update($request->all());
        return redirect()->back();
    }

    // assignment
    public function assignment()
    {
        $data['fields'] = Assignment::form_elements();
        $assignment = Assignment::find(1);

        return  view('setup.pages.assignment', compact('assignment', 'data'));
    }

    public function update_assignment(Request $request)
    {
        $assignment = Assignment::find(1);

        $assignment->update($request->all());
        return redirect()->back();
    }

    // essay writing
    public function essay()
    {
        $data['fields'] = EssayWriting::form_elements();
        $essay = EssayWriting::find(1);

        return  view('setup.pages.essay', compact('essay', 'data'));
    }

    public function update_essay(Request $request)
    {
        $essay = EssayWriting::find(1);

        $essay->update($request->all());
        return redirect()->back();
    }

    // about
    public function about()
    {
        $data['fields'] = About::form_elements();
        $page = About::find(1);

        return  view('setup.pages.about', compact('page', 'data'));
    }

    public function update_about(Request $request)
    {
        $page = About::first();

        $page->update($request->all());

        return redirect()->back();
    }

    // contact
    public function contact()
    {
        $data['fields'] = Contact::form_elements();
        $page = Contact::first();

        return  view('setup.pages.contact', compact('page', 'data'));
    }

    public function update_contact(Request $request)
    {
        $essay = Contact::first();
        $essay->update($request->all());
        return redirect()->back();
    }
}
