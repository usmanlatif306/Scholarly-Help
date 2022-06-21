@extends('website.layouts.template')
@if($content->count() > 0)
@section('title', Purifier::clean($content->title))
@section('content')
<div class="bradcam_area breadcam_bg overlay2">
   <h3 class="text-center pt-5 pb-4">{{ Purifier::clean($content->title) }}</h3>
</div>
<div class="about_area pb-5">
   <div class="container">
      <div class="row">
         <div class="offset-lg-2 col-lg-8">
            <?php echo Purifier::clean($content->description); ?>
         </div>
      </div>
   </div>
</div>

@endsection

@endif