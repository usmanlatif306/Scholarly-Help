@extends('layouts.app')
@section('title', 'Inbox')
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-md-12">
            <h4>Messages</h4>
            <hr>
        </div>
    </div>

    <Message :user="{{auth()->user()}}" :add_message_url="'{{ route('message.save') }}'"
        :get_all_message="'{{ route('writer_messages') }}'" :change_message_status_url="'{{ route('message.status') }}'"
        :sound="'{{asset('music/sound.mp3')}}'" />

</div>
@endsection