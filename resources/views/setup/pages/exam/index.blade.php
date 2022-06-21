@extends('setup.index')
@section('title', 'Online Exam Sub Category Pages')
@section('setting_page')

<style type="text/css">
    .toolbar {
        float: left;
    }
</style>
@include('setup.partials.action_toolbar', [
'title' => 'Online Exam Sub Category Pages',
'hide_save_button' => TRUE,
'create_link' => ['title' => 'Create New Page', 'url' => route("online_exam.pages.create")]
])
<table id="table" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col" class="text-right">Action</th>
        </tr>
    </thead>
</table>
@endsection
@push('scripts')
<script>
    $(function () {

        var oTable = $('#table').DataTable({
            "bLengthChange": false,
            "dom": '<"toolbar">frtip',
            "bSort": false,
            processing: true,
            serverSide: true,
            "ajax": {
                "url": "{!! route('online_exam.datatables') !!}",
                "type": "POST",
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                "data": function (d) {
                    if ($("#showInactive").is(":checked")) {
                        d.include_inactive_items = 1;
                    }
                }
            },
            columns: [
                { data: 'name', name: 'name' },

                { data: 'action', name: 'action', className: "text-right" },

            ]
        });

        $('#table').on('click', '.delete-item', function (e) {

            e.preventDefault();
            runSwal($(this).attr("href"));

        });

        $('#showInactive').change(function () {
            oTable.draw();
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
@endpush