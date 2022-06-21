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
               value="{{ $work->name }}">
            <div class="invalid-feedback d-block">{{ showError($errors, 'name') }}</div>
         </div>
         <div class="form-group">
            <label for="">For Page</label>
            <select name="page" class="form-control" value="{{$work->page}}">
               <option value="home" @if($work->page === 'home')'selected' @endif>Home</option>
               <option value="online_class" {{ ($work->page) == 'online_class' ? 'selected' : ''
                  }}>Online Class
               </option>
               <option value="online_exam" {{ ($work->page) == 'online_exam' ? 'selected' : '' }}>Online
                  Exam</option>
               <option value="homework" {{ ($work->page) == 'homework' ? 'selected' : '' }}>Homework
               </option>
               <option value="assignment" {{ ($work->page) == 'assignment' ? 'selected' : ''
                  }}>Assignment</option>
               <option value="essay_writing" {{ ($work->page) == 'essay_writing' ? 'selected' : ''
                  }}>Essay Writing
               </option>
               @foreach($pages as $key=>$page)
               @foreach($page as $item)

               <option value="{{strtolower($item->slug)}}" {{ $work->page ==
                  strtolower($item->slug.'_'.$key) ? 'selected' :
                  '' }} class="text-capitalize">{{$item->name.' '.$key}}
               </option>
               @endforeach
               @endforeach
            </select>
         </div>

         <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control {{ showErrorClass($errors, 'file') }}" name="file"
               value="{{ old_set('file') }}">
            <div class="invalid-feedback d-block">{{ showError($errors, 'file') }}</div>
            <small>If you want to keep old file then do not change it.</small>
         </div>
      </div>

   </div>

   <input type="submit" name="submit" class="btn btn-success" value="Submit" />
</form>
@endsection