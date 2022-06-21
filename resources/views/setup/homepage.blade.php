@extends('setup.index')
@section('title', 'Homepage Settings')
@section('setting_page')
<form role="form" class="form-horizontal" enctype="multipart/form-data" action="{{ route('patch_settings_homepage') }}"
   method="post" autocomplete="off">
   {{ csrf_field() }}
   {{ method_field('PATCH') }}
   @include('setup.partials.action_toolbar', ['title' => 'Homepage Contents'])
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">Website Frontend</li>
         <li class="breadcrumb-item" aria-current="page">Homepage</li>
      </ol>
   </nav>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <br>
            @foreach($data['records'] as $row)

            @if($data['fields'][$row['option_key']] == 'input')
            <div class="form-group">
               <label>{{ ucfirst(str_replace('_',' ', $row['option_key'])) }}</label>
               <input type="text" class="form-control form-control-sm {{ showErrorClass($errors, $row['option_key']) }}"
                  name="{{ $row['option_key'] }}" value="{{ old($row['option_key'], $row['option_value'])  }}">
               <div class="invalid-feedback">{{ showError($errors, $row['option_key']) }}</div>
            </div>
            @elseif($data['fields'][$row['option_key']] == 'file')
            <div class="form-group">
               <label>{{ ucfirst(str_replace('_',' ', $row['option_key'])) }}</label>
               <input type="file" class="form-control {{ showErrorClass($errors, $row['option_key']) }}"
                  name="{{ $row['option_key'] }}" value="{{ old($row['option_key'], $row['option_value'])  }}">
               <div class="invalid-feedback">{{ showError($errors, $row['option_key']) }}</div>
            </div>
            @else
            <div class="form-group">
               <label>{{ ucfirst(str_replace('_',' ', $row['option_key'])) }}</label>
               <textarea id="{{$row['option_key']}}"
                  class="form-control form-control-sm {{ showErrorClass($errors, $row['option_key']) }}"
                  name="{{ $row['option_key'] }}"
                  rows="4">{{ old($row['option_key'], $row['option_value'])  }}</textarea>
               <div class="invalid-feedback">{{ showError($errors, $row['option_key']) }}</div>
            </div>
            @endif
            @endforeach
         </div>
      </div>
   </div>
</form>
<hr />
<br>
<form class="form-horizontal" enctype="multipart/form-data" action="{{ route('update_homepage_image') }}" method="post">
   {{ csrf_field() }}
   <div class="container">
      <div class="row">
         <!-- <div class="col-md-12">
            <div class="form-group">
               <label>Header Logo</label>
               <input type="file" class="form-control" name="logo">
            </div>
         </div> -->
         <div class="col-md-12">
            <div class="form-group">
               <label>Hero Image</label>
               <input type="file" class="form-control" name="image">
            </div>
         </div>
         <div class="col-md-12">
            <div class="form-group">
               <label>Section Image</label>
               <input type="file" class="form-control" name="sectionImage">
            </div>
            <button type="submit" class="btn btn-sm btn-info">Update</button>
         </div>
      </div>
   </div>

</form>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
   ClassicEditor
      .create(document.querySelector('#hero_content_3'));
</script>
@endpush