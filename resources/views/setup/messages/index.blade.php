@extends('layouts.app')
@section('title', 'Messages')
@section('content')
<div class="container page-container">
    <div class="row">
        <div class="col-md-12">
            <h4>Messages</h4>
            <br>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            @include('setup.messages.search')
        </div>
        <div class="col-md-8">
            <table id="table" class="w-100">
                <thead>
                    <tr>
                        <th scope="col"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function () {

        var oTable = $('#table').DataTable({
            "bLengthChange": false,
            searching: false,
            processing: true,
            serverSide: true,
            "ordering": false,
            "ajax": {
                "url": "{!! route('messages_datatable') !!}",
                "type": "POST",
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                "data": function (d) {
                    d.search = $("input[name=search]").val();
                    console.log(d)
                }
            },
            columns: [
                { data: 'message_html', name: 'message_html' }
            ]
        })
        $('#search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });      
</script>
@endpush