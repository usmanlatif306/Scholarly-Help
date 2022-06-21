@extends('setup.index')
@section('title', 'FAQs Settings')
@section('setting_page')

<div class="actions-toolbar py-2 mb-1">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-1">Frequently Asked Questions</h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('settings_show_faqs')}}" class="btn btn-sm btn-success">Back</a>
        </div>
    </div>
    <hr>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Website Frontend</li>
        <li class="breadcrumb-item" aria-current="page">Edit FAQ</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('settings_update_faqs',$faq->id)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="">For Page</label>
                    <select name="page" class="form-control" value="{{$faq->page}}">
                        <option value="home" @if($faq->page === 'home')'selected' @endif>Home</option>
                        <option value="online_class" {{ ($faq->page) == 'online_class' ? 'selected' : ''
                            }}>Online Class
                        </option>
                        <option value="online_exam" {{ ($faq->page) == 'online_exam' ? 'selected' : '' }}>Online
                            Exam</option>
                        <option value="homework" {{ ($faq->page) == 'homework' ? 'selected' : '' }}>Homework
                        </option>
                        <option value="assignment" {{ ($faq->page) == 'assignment' ? 'selected' : ''
                            }}>Assignment</option>
                        <option value="essay_writing" {{ ($faq->page) == 'essay_writing' ? 'selected' : ''
                            }}>Essay Writing
                        </option>
                        @foreach($pages as $key=>$page)
                        @foreach($page as $item)

                        <option value="{{strtolower($item->slug)}}" {{ $faq->page ==
                            strtolower($item->slug) ? 'selected' :
                            '' }} class="text-capitalize">{{$item->name.' '.$key}}
                        </option>
                        @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Question</label>
                    <input type="text" name="question" class="form-control" value="{{$faq->question}}" required>
                </div>
                <div class="form-group">
                    <label for="answer">Aaswer</label>
                    <textarea name="answer" id="answer" class="form-control" cols="30" rows="5"
                        required>{{$faq->answer}}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>


@endsection