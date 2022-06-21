@extends('setup.index')
@section('title', 'Online Exam Sub Category Pages')
@section('setting_page')
@include('setup.partials.action_toolbar', [
'title' => (isset($page->id)) ? 'Edit Page' : 'Create new Page',
'hide_save_button' => TRUE,
'back_link' => ['title' => 'back to pages', 'url' => route("online_exam.pages.index")],
])
<form role="form" class="form-horizontal"
    action="{{ (isset($page->id)) ? route( 'online_exam.pages.update', $page->id) : route('online_exam.pages.store') }}"
    method="post" autocomplete="off">
    {{ csrf_field() }}
    @if(isset($page->id))
    {{ method_field('PATCH') }}
    @endif
    @include('setup.partials.action_toolbar', ['title' => 'Online Exam Sub Category Pages'])
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Website Frontend</li>
            <li class="breadcrumb-item" aria-current="page">Online Exam Sub Category Pages</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                @foreach($data['fields'] as $key=>$row)

                @if($row == 'input')
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', $key)) }}</label>
                    <input type="text" class="form-control form-control-sm" name="{{ $key }}"
                        value="{{ $page ? $page[$key]:''  }}">

                </div>
                @else
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', $key)) }}</label>
                    <textarea id="{{$key}}" class="form-control form-control-sm" name="{{ $key }}"
                        rows="4">{{ $page ? $page[$key]:''  }}</textarea>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</form>

@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#main_content'));
    ClassicEditor
        .create(document.querySelector('#main_extra_content'));
    ClassicEditor
        .create(document.querySelector('#subject_discipline_content'));
    ClassicEditor
        .create(document.querySelector('#subject_specialist_content'));
    ClassicEditor
        .create(document.querySelector('#academic_service_about'));
    ClassicEditor
        .create(document.querySelector('#academic_service_1_about'));
    ClassicEditor
        .create(document.querySelector('#academic_service_2_about'));
    ClassicEditor
        .create(document.querySelector('#academic_service_3_about'));

</script>

@endpush