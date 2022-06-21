@extends('setup.index')
@section('title', 'Messages')
@section('setting_page')

<div class="actions-toolbar py-2 mb-1">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-1">Messages</h5>
        </div>
        <!-- <div class="col-md-6 text-right">
            <a href="{{route('settings_create_faqs')}}" class="btn btn-sm btn-success">Create New</a>
        </div> -->
    </div>
    <hr>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Website Frontend</li>
        <li class="breadcrumb-item" aria-current="page">Messages</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 25%;">User</th>
                            <th scope="col" style="width: 25%;">Writer</th>
                            <th scope="col" style="width: 50%;">Message</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('innerPageJS')
<script>
    $(function () {

        var oTable = $('#table').DataTable({
            responsive: true,
            "bLengthChange": false,
            "dom": '<"toolbar">frtip',
            "bSort": false,
            processing: true,
            serverSide: true,
            "ajax": {
                "url": "{!! route('messages_datatable') !!}",
                "type": "POST",
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },
            columns: [
                { data: 'user', name: 'user', },
                { data: 'writer', name: 'writer' },
                { data: 'message', name: 'message' },

            ]
        });
    });  
</script>
@endsection