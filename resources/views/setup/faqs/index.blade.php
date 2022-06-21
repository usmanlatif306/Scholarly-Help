@extends('setup.index')
@section('title', 'FAQs Settings')
@section('setting_page')

<div class="actions-toolbar py-2 mb-1">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-1">Frequently Asked Questions</h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('settings_create_faqs')}}" class="btn btn-sm btn-success">Create New</a>
        </div>
    </div>
    <hr>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Website Frontend</li>
        <li class="breadcrumb-item" aria-current="page">FAQ's</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 30%;">Question</th>
                            <th scope="col" style="width: 45%;">Answer</th>
                            <th scope="col" style="width: 15%;">Page</th>
                            <th scope="col" style="width: 10%;">Action</th>
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
                "url": "{!! route('faq_datatable') !!}",
                "type": "POST",
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },
            columns: [
                { data: 'question', name: 'question', },
                { data: 'answer', name: 'answer' },
                { data: 'page', name: 'page' },
                { data: 'action', name: 'action', },

            ]
        });


        $('#table').on('click', '.delete-item', function (e) {
            e.preventDefault();
            runSwal($(this).attr("href"));
        });


    });

    function runSwal($link_to_delete) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location = $link_to_delete;
            }
        });

    }   
</script>
@endsection