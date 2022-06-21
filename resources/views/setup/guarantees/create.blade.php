@extends('setup.index')
@section('title', 'Guarantees')
@section('setting_page')

<div class="actions-toolbar py-2 mb-1">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-1">Guarantees</h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="route('guarantees.index')" class="btn btn-sm btn-success">Back</a>
        </div>
    </div>
    <hr>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Website Frontend</li>
        <li class="breadcrumb-item" aria-current="page">Create New Guarantees</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('guarantees.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">Icon</label>
                    <input type="text" name="icon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="answer">Content</label>
                    <textarea name="content" id="answer" class="form-control" cols="30" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>


@endsection