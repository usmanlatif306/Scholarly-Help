@extends('setup.index')
@section('title', 'Assignment')
@section('setting_page')
<form role="form" class="form-horizontal" enctype="multipart/form-data" action="{{ route('put_assignment_settings') }}"
    method="post" autocomplete="off">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    @include('setup.partials.action_toolbar', ['title' => 'Assignment'])
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Website Frontend</li>
            <li class="breadcrumb-item" aria-current="page">Assignment</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                @foreach($data['fields'] as $key=>$row)

                @if($row == 'input')
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', $key)) }}</label>
                    <input type="text" class="form-control form-control-sm" name="{{ $key }}"
                        value="{{ $assignment[$key]  }}">

                </div>
                @else
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', $key)) }}</label>
                    <textarea id="{{$key}}" class="form-control form-control-sm" name="{{ $key }}"
                        rows="4">{{ $assignment[$key]  }}</textarea>

                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</form>

</form>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#expert_content'));
    ClassicEditor
        .create(document.querySelector('#main_extra_content'));
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#we_are_best'));
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#features'));
</script>
@endpush