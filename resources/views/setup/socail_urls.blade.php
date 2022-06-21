@extends('setup.index')
@section('title', 'Social Login Urls')
@section('setting_page')
<form role="form" class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin_social_urls_update') }}"
   method="post" autocomplete="off">
   {{ csrf_field() }}
   {{ method_field('PATCH') }}
   @include('setup.partials.action_toolbar', ['title' => 'Homepage Contents'])
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">Website Frontend</li>
         <li class="breadcrumb-item" aria-current="page">Social Login Urls</li>
      </ol>
   </nav>
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <br>
            @foreach($links as $name=>$value)
            <div class="form-group">
               <label>{{ ucfirst(str_replace('_',' ', $name)) }}</label>
               <input type="text" class="form-control form-control-sm {{ showErrorClass($errors, $name) }}"
                  name="{{ $name }}" value="{{ old($name, $value)  }}">
               <div class="invalid-feedback">{{ showError($errors, $name) }}</div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</form>
@endsection