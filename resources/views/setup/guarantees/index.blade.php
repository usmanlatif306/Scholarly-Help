@extends('setup.index')
@section('title', 'Guarantees')
@section('setting_page')

<div class="actions-toolbar py-2 mb-1">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-1">Guarantees</h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('guarantees.create')}}" class="btn btn-sm btn-success">Create New</a>
        </div>
    </div>
    <hr>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Website Frontend</li>
        <li class="breadcrumb-item" aria-current="page">Guarantees</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 45%;">Title</th>
                            <th scope="col" style="width: 45%;">Content</th>
                            <th scope="col" style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guarantees as $item)
                        <tr>
                            <td style="width: 45%;">{{$item->title}}</td>
                            <td style="width: 45%;">{{$item->content}}</td>
                            <td style="width: 10%;">
                                <a href="{{route('guarantees.edit',$item->id)}}"><i class="fas fa-edit"></i></a>
                                <span style="cursor: pointer;font-size: 18px;margin-left: 5px;"
                                    onclick="return window.confirm(document.getElementById('guarantee-{{$item->id}}').submit());"><i
                                        class="fas fa-times text-danger"></i></span>
                                <form id="guarantee-{{$item->id}}" action="{{route('guarantees.destroy',$item->id)}}"
                                    method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>


@endsection