@extends('layouts.master', ['title' => $title])
@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }}  </span>
</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header pb-0">
      <a class="btn btn-primary " href="{{route('karyawan.create')}}"><i class="ti ti-plus me-1"></i>  <span>Tambah Karyawan</span></a>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>No Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Email</th>
                    <th>No Whatsapp</th>
                    <th>Alamat</th>
                    <th>Departemen</th>
                    <th>Perusahaan</th>
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
    var table = $('#dataTable').DataTable({
      ajax: {
          url: "{{route('karyawan.index')}}",
          type: "GET",
          data: function(d) {
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
          [0, 'ASC']
      ],
      columns: [
          {
              data: 'nrp',
              name: 'nrp'
          },

          {
              data: 'name',
              name: 'name'
          },
          {
              data: 'email',
              name: 'email'
          },
          {
              data:'no_handphone',
              name:'no_handphone'
          },
          {
              data: 'address',
              name: 'address'
          },
          {
              data: 'department.name',
              name: 'department.name'
          },
          {
              data: 'company.name',
              name: 'company.name'
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
