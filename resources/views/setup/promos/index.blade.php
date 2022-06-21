@extends('setup.index')
@section('title', 'Promo Codes')
@section('setting_page')

<style type="text/css">
  .toolbar {
    float: left;
  }
</style>
@include('setup.partials.action_toolbar', [
'title' => 'Promo Codes',
'hide_save_button' => TRUE,
'create_link' => ['title' => 'Create Promo Code', 'url' => route("promos.create")]

])

<table id="table" class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="width: 35%;">Code</th>
      <th scope="col" style="width: 35%;">Value</th>
      <th scope="col" class="text-right">Action</th>
    </tr>
  </thead>
</table>
@endsection
@section('innerPageJS')
<script>
  $(function () {

    var oTable = $('#table').DataTable({
      "bLengthChange": false,
      "dom": '<"toolbar">frtip',
      "bSort": false,
      processing: true,
      serverSide: true,
      "ajax": {
        "url": "{!! route('promos_datatable') !!}",
        "type": "POST",
        'headers': {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
      },
      columns: [
        // { data: 'DT_RowIndex', name: 'DT_RowIndex' },                        
        { data: 'code', code: 'code' },
        { data: 'value', value: 'value' },
        { data: 'action', name: 'action', className: "text-right" },

      ]
    });



    // var createButton = '<a class="btn btn-sm btn-primary" href="{{ route("tags_create") }}">New Tag</a>';

    // var toolbar = '<div class="d-flex flex-row">' + createButton + '</div>';

    // $("div.toolbar").html(toolbar);    


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
@endsection