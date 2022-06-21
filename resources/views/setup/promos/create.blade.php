@extends('setup.index')
@section('title', 'Create Promo Code')
@section('setting_page')
@include('setup.partials.action_toolbar', [
'title' => (isset($promo->id)) ? 'Edit Promo Code' : 'Create New Promo Code',
'hide_save_button' => TRUE,
'back_link' => ['title' => 'back to Promo Codes', 'url' => route("promos.index")],
])

<form role="form" class="form-horizontal"
   action="{{ (isset($promo->id)) ? route( 'promos.edit', $promo->id) : route('promos.store') }}" method="post"
   autocomplete="off">
   {{ csrf_field() }}
   @if(isset($promos->id))
   {{ method_field('PUT') }}
   @endif
   <div class="row">
      <div class="col-md-8">
         <div class="form-group">
            <label>Code <span class="required">*</span></label>
            <input type="text" id="promoCode" class="form-control form-control-sm {{ showErrorClass($errors, 'code') }}"
               name="code" value="{{ old_set('code', NULL, $promo) }}" placeholder="Enter Coupon Code">
            <div class="invalid-feedback">{{ showError($errors, 'code') }}</div>
            <small><a id="generateCode" href="javascript:void(0)">Generate Code</a></small>
         </div>
         <div class="form-group">
            <label>Value <span class="required">*</span></label>
            <input type="number" class="form-control form-control-sm {{ showErrorClass($errors, 'value') }}"
               name="value" value="{{ old_set('value', NULL, $promo) }}" placeholder="Enter Coupon Balance">
            <div class="invalid-feedback">{{ showError($errors, 'value') }}</div>
         </div>

         <input type="submit" name="submit" class="btn btn-success" value="Submit" />
      </div>
   </div>

</form>

@endsection
@section('innerPageJS')
<script>
   $('#generateCode').on('click', function () {
      $.ajax({
         url: "{!! route('generate_promo_code') !!}", success: function (result) {
            $('#promoCode').val(result);
         }
      });
   });
</script>
@endsection