@extends('layouts.master', ['title' => $title])
@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }} </span>
</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="row my-3 mx-1">
        <div class="form-group col-md-2">
            <label for="status">Status</label>
            <select class="form-select" name="status" id="status">
                <option value="">Semua..</option>
                <option value="open">Open</option>
                <option value="close">Close</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="date-input1">Tanggal</label>
            <input type="text" name="tanggal" id="tanggal" class="form-control datetimes" value="{{ request('tanggal') ?? '' }}">
        </div>
        <div class="form-group col-md-3 mt-4">
            <button type="button" class="btn btn-primary" id="filterButton"><i class="fas fa-filter"></i> Filter</button>
        </div>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>No WO</th>
                    <th>Tanggal Order</th>
                    <th>Perusahaan Pemohon</th>
                    <th>Nama Pemohon</th>
                    <th>Deskripsi Permintaan</th>
                    <th>Unit yang diperlukan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Status Projek</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('page-script')
<script src="{{asset('assets/js/tables-datatables-basic.js')}}"></script>
<script>


  $(document).ready(function(){

    $('.datetimes').daterangepicker({
        locale: {
            format: 'M/DD/YYYY'
        }
    });

    $('#filterButton').on('click', function () {
        table.ajax.reload();
    });

    var table = $('#dataTable').DataTable({
      ajax: {
          url: "{{route('laporan')}}",
          type: "GET",
          data: function(d) {
            d.status = $('#status').val();
            d.tanggal = $('#tanggal').val();
              // d._user = $('#user').val(),
              // d._start_date = $('#start_date').val(),
              // d._end_date = $('#end_date').val()

          }
      },
      processing: true,
      serverSide: true,
      columnDefs: [{
              "defaultContent": "-",
              "targets": "_all"
          },
      ],
      order: [
          [0, 'DESC']
      ],
      columns: [
          {
              data: 'wo_number',
              name: 'wo_number'
          },
          {
              data: 'order_date',
              name: 'order_date'
          },
          {
              data: 'company.name',
              name: 'company.name'
          },
          {
              data: 'employee.name',
              name: 'employee.name'
          },
          {
              data: 'request_description',
              name: 'request_description'
          },
          {
              data: 'units',
              name: 'units'
          },
          {
              data: 'amount',
              name: 'amount'
          },
          {
              data: 'status',
              name: 'status'
          },
          {
              data: 'status_project',
              name: 'status_project'
          },
          {
              data: 'action',
              name: 'action'
          },
      ],
  });


  })
</script>
@endsection
