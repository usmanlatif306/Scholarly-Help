@extends('setup.index')
@section('title', 'Subjects')
@section('setting_page')

@include('setup.partials.action_toolbar', [
'title' => (isset($subject->id)) ? 'Edit Subject' : 'Create new Subject',
'hide_save_button' => TRUE,
'back_link' => ['title' => 'back to subject', 'url' => route("subject_list")],
])
<form role="form" class="form-horizontal" enctype="multipart/form-data"
   action="{{ (isset($subject->id)) ? route( 'subject_update', $subject->id) : route('subject_store') }}" method="post"
   autocomplete="off">
   {{ csrf_field() }}
   @if(isset($subject->id))
   {{ method_field('PATCH') }}
   @endif
   <div class="form-row">
      <!-- <div class="form-group col-md-6">
         <label>Icon <span class="required">*</span></label>
         <input type="text" class="form-control form-control-sm {{ showErrorClass($errors, 'icon') }}" name="icon"
            value="{{ old_set('icon', NULL, $subject) }}">
         <div class="invalid-feedback d-block">{{ showError($errors, 'icon') }}</div>
      </div> -->
      <div class="form-group col-md-6">
         <label>Name <span class="required">*</span></label>
         <input type="text" class="form-control form-control-sm {{ showErrorClass($errors, 'name') }}" name="name"
            value="{{ old_set('name', NULL, $subject) }}">
         <div class="invalid-feedback d-block">{{ showError($errors, 'name') }}</div>
      </div>
      <div class="form-group col-md-6">
         <label>Slug <span class="required">*</span></label>
         <input type="text" class="form-control form-control-sm {{ showErrorClass($errors, 'slug') }}" name="slug"
            value="{{ old_set('slug', NULL, $subject) }}">
         <div class="invalid-feedback d-block">{{ showError($errors, 'name') }}</div>
      </div>
   </div>

   <input type="submit" name="submit" class="btn btn-success" value="Submit" />
</form>
@endsection