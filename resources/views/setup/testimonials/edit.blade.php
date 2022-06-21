@extends('setup.index')
@section('title', 'Testimonials')
@section('setting_page')

<div class="actions-toolbar py-2 mb-1">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-1">Testimonials</h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('testimonials.index')}}" class="btn btn-sm btn-success">Back</a>
        </div>
    </div>
    <hr>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Website Frontend</li>
        <li class="breadcrumb-item" aria-current="page">Edit Testimonials</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('testimonials.update',$testimonial->id)}}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="title" class="form-control" value="{{$testimonial->name}}" required>
                </div>
                <div class="form-group">
                    <label for="answer">Comment</label>
                    <textarea name="content" id="answer" class="form-control" cols="30" rows="5"
                        required>{{$testimonial->comment}}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Image (Don't upload if you want use old image)</label>
                    <input type="file" name="image" value="$testimonial->image" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>


@endsection