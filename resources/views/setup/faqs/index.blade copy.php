@extends('setup.index')
@section('title', 'FAQs Settings')
@section('setting_page')

<div class="actions-toolbar py-2 mb-1">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-1">Frequently Asked Questions</h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('settings_create_faqs')}}" class="btn btn-sm btn-success">Create New</a>
        </div>
    </div>
    <hr>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Website Frontend</li>
        <li class="breadcrumb-item" aria-current="page">FAQ's</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 30%;">Question</th>
                            <th scope="col" style="width: 45%;">Answer</th>
                            <th scope="col" style="width: 15%;">Page</th>
                            <th scope="col" style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td style="width: 30%;">{{$faq->question}}</td>
                            <td style="width: 45%;">{{$faq->answer}}</td>
                            <td style="width: 15%;" class="text-capitalize">{{$faq->page}}</td>
                            <td style="width: 10%;">
                                <a href="{{route('settings_edit_faqs',$faq->id)}}"><i class="fas fa-edit"></i></a>
                                <span style="cursor: pointer;font-size: 18px;margin-left: 5px;"
                                    onclick="return window.confirm(document.getElementById('faq-{{$faq->id}}').submit());"><i
                                        class="fas fa-times text-danger"></i></span>
                                <form id="faq-{{$faq->id}}" action="{{route('settings_delete_faqs',$faq->id)}}"
                                    method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$faqs->links()}}
            </div>
        </div>
    </div>
</div>


@endsection