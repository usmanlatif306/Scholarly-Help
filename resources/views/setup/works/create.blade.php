@extends('setup.index')
@section('title', 'Past Works')
@section('setting_page')

@include('setup.partials.action_toolbar', [
'title' => (isset($work->id)) ? 'Edit Work' : 'Create new Work',
'hide_save_button' => TRUE,
'back_link' => ['title' => 'back to works', 'url' => route("works.index")],
])
<form role="form" class="form-horizontal" enctype="multipart/form-data"
   action="{{ (isset($work->id)) ? route( 'works.update', $work->id) : route('works.store') }}" method="post"
   autocomplete="off">
   {{ csrf_field() }}
   @if(isset($work->id))
   {{ method_field('PATCH') }}
   @endif
   <div class="row">
      <div class="col-12">
         <div class="form-group">
            <label>Name <span class="required">*</span></label>
            <input type="text" class="form-control {{ showErrorClass($errors, 'name') }}" name="name"
               value="{{ old_set('name') }}">
            <div class="invalid-feedback d-block">{{ showError($errors, 'name') }}</div>
         </div>
         <div class="form-group">
            <label for="">For Page <span class="required">*</span></label>
            <select name="page" class="form-control">
               <option value="home">Home</option>
               <option value="online_class">Online Class</option>
               <option value="online_exam">Online Exam</option>
               <option value="homework">Homework</option>
               <option value="assignment">Assignment</option>
               <option value="essay_writing">Essay Writing</option>
               @foreach($pages as $key=>$page)
               @foreach($page as $item)
               <option value="{{strtolower($item->slug).'_'.$key}}" class="text-capitalize">{{$item->name}}</option>
               @endforeach
               @endforeach
            </select>
         </div>

         <div class="form-group">
            <label>File <span class="required">*</span></label>
            <input type="file" class="form-control {{ showErrorClass($errors, 'file') }}" name="file"
               value="{{ old_set('file') }}">
            <div class="invalid-feedback d-block">{{ showError($errors, 'file') }}</div>
         </div>
      </div>

   </div>

   <input type="submit" name="submit" class="btn btn-success" value="Submit" />
</form>
@endsection