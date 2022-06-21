<div class="card mb-3 bg-white w-100">
    <div class="row no-gutters">
        <div class="col-md-12">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Sender: {{$message->user->full_name}}</span>
                    <span>Receiver: {{$message->receiver->full_name}}</span>
                </div>
                @if($message->type === 'text')
                <p class="card-text text-sm text-muted mb-0">Message: {{ $message->message }}</p>
                @else
                <a href="{{url('/').'/storage/'.$message->message}}" download="">{{$message->file_name ?? 'File'}}</a>
                @endif
                <p class="card-text text-sm text-muted mb-0 mt-2">Time: {{ $message->created_at }}</p>
            </div>
        </div>
    </div>
</div>