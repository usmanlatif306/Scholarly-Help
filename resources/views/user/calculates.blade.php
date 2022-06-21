@extends('layouts.app')
@section('title', 'Calculates User')
@section('content')
<div class="container page-container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h4>List of Calculates Users</h4>
            <br>
        </div>
        <div class="col-md-10 offset-md-1">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th>{{$loop->iteration + $users->firstItem() - 1}}</th>
                            <td>{{$user->email}}</td>
                            <td>{{$user->number}}</td>
                            <td>{{$user->created_at->format('Y-m-d h:m:s')}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{$users->links()}}
            </div>

        </div>
    </div>
</div>
@endsection