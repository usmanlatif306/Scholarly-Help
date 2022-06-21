@extends('setup.index')
@section('title', 'Guarantees')
@section('setting_page')

@include('setup.partials.action_toolbar', [
'title' => (isset($guarantee->id)) ? 'Edit Guarantees' : 'Create new Guarantees',
'hide_save_button' => TRUE,
'back_link' => ['title' => 'back to guaranteess', 'url' => route("guarantee_list")],
])
<form role="form" class="form-horizontal" enctype="multipart/form-data"
   action="{{ (isset($guarantee->id)) ? route( 'guarantees_update', $guarantee->id) : route('guarantees_store') }}"
   method="post" autocomplete="off">
   {{ csrf_field() }}
   @if(isset($guarantee->id))
   {{ method_field('PATCH') }}
   @endif
   <div class="form-row">
      <div class="form-group col-md-6">
         <label>Name <span class="required">*</span></label>
         <input type="text" class="form-control form-control-sm {{ showErrorClass($errors, 'name') }}" name="name"
            value="{{ old_set('name', NULL, $guarantee) }}">
         <div class="invalid-feedback d-block">{{ showError($errors, 'name') }}</div>
      </div>
   </div>
   <div class="form-row">
      <div class="form-group col-md-7">
         <label>
            <span data-toggle="tooltip"
               title="Enter the percentage of base price of a service that should add up with the total of an order"><i
                  class="fas fa-question-circle"></i></span>
            Percentage of base price of a service<span class="required">*</span>
         </label>
         <div class="input-group mb-3">
            <input type="text" class="form-control {{ showErrorClass($errors, 'percentage_to_add') }}"
               name="percentage_to_add" value="{{ old_set('percentage_to_add', NULL, $guarantee) }}">
            <div class="input-group-append">
               <span class="input-group-text">%</span>
            </div>
         </div>
         <small class="form-text text-muted">Enter the percentage of base price of a service that should add up with the
            total of an order</small>
         <div class="invalid-feedback d-block">{{ showError($errors, 'percentage_to_add') }}</div>
      </div>
   </div>
   <div class="form-group">
      <div class="custom-control custom-checkbox">
         <input type="checkbox" class="custom-control-input" id="inactive" name="inactive" value="1" {{
            old_set('inactive', NULL, $guarantee) ? 'checked="checked"' : '' }}>
         <label class="custom-control-label" for="inactive">Inactive</label>
      </div>
   </div>
   <input type="submit" name="submit" class="btn btn-success" value="Submit" />
</form>
@endsection