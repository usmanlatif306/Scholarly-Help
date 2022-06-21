@extends('setup.index')
@section('title', 'Online Exam')
@section('setting_page')
<form role="form" class="form-horizontal" enctype="multipart/form-data" action="{{ route('put_online_exam_settings') }}"
    method="post" autocomplete="off">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    @include('setup.partials.action_toolbar', ['title' => 'Online Exam'])
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Website Frontend</li>
            <li class="breadcrumb-item" aria-current="page">Online Exam</li>
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
                        value="{{ $exam[$key]  }}">

                </div>
                @else
                <div class="form-group">
                    <label>{{ ucfirst(str_replace('_',' ', $key)) }}</label>
                    <textarea id="{{$key}}" class="form-control form-control-sm" name="{{ $key }}"
                        rows="4">{{ $exam[$key]  }}</textarea>

                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</form>

</form>
@endsection