@extends('layouts.master', ['title' => $title.'' ])
@section('page-style')
<style>
    .dt-buttons {
        float: left !important;
    }
</style>
@endsection
@section('content')
<h4 id="pageTitle" class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }}</span>
</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="row px-4 pt-3">
        <div class="alert alert-info text-danger">
            * Untuk melakukan export perbaikan mohon lakukan filter terlebih dahulu.
        </div>
    </div>
    <div class="row my-3 mx-1">
        <div class="form-group col-md-3">
            <label for="date-input1">Tanggal</label>
            <input type="text" name="tanggal" id="tanggal" class="form-control datetimes" value="{{ request('tanggal') ?? '' }}">
        </div>
        <div class="form-group col-md-4 mt-4" id="filterRow">
            <div style="display: flex; align-items: center;">
                <button type="button" class="btn btn-primary" id="filterButton"><i class="fas fa-filter me-1"></i> Filter</button>
                <div id="exportButtonContainer" style="margin-left: 10px;">
                    <!-- Export button will be appended here -->
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4 mt-4" id="filterTopCriteria">
        </div> --}}
    </div>


    <div class="card-datatable table-responsive pt-0">
        <table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">No</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">No. Work Order</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Perusahaan</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">NRP Pemohon</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Pemohon</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">Deskripsi Work Order</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">Jumlah</th>
                    <th colspan="2" class="text-center">Tanggal</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle" width="50px">Total Rata-Rata Penggunaan Unit</th>
                </tr>
                <tr>
                    <th class="text-center">Mulai</th>
                    <th class="text-center">Selesai</th>
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

        $('#filterButton').on('click', function() {
            table.ajax.reload(function(data) {
            var tanggalValue = $('#tanggal').val();
            appendExportButton(tanggalValue);
            });
        });

        function appendExportButton(tanggalValue) {
            var exportButtonContainer = $('#exportButtonContainer');
            exportButtonContainer.empty();

            if (tanggalValue) {
                var exportButton = $('<a href="{{ route('report.export') }}?tanggal=' + tanggalValue + '" class="btn btn-success text-white"><i class="fas fa-file-excel me-1"></i> Export</a>');
                exportButtonContainer.append(exportButton);
            }
        }

        var table = $('#dataTable').DataTable({
        ajax: {
            url: "{{route('report')}}",
            type: "GET",
            data: function(d) {
                d.tanggal = $('#tanggal').val();

                // d._user = $('#user').val(),
                // d._start_date = $('#start_date').val(),
                // d._end_date = $('#end_date').val()
            },
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
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: true,
                searchable: true,
                className: 'text-center'
            },
            {
                data: 'wo_number',
                name: 'wo_number'
            },
            {
                data: 'company.name',
                name: 'company.name'
            },
            {
                data: 'employee.nrp',
                name: 'employee.nrp'
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
                data: 'amount',
                name: 'amount',
                className: 'text-center'
            },
            {
                data: 'start_date',
                name: 'start_date'
            },
            {
                data: 'end_date',
                name: 'end_date'
            },
            {
                data: 'avg_use',
                name: 'avg_use',
                className: 'text-center'
            },
        ],
    });

    // new $.fn.dataTable.Buttons( table, {
    //     buttons: [ 'colvis', 'excel',
    //             {
    //             extend: 'collection',
    //             text: 'Print',
    //             className: "btnArrow",
    //             buttons: [
    //                 { extend: "print",
    //                     exportOptions: {
    //                     columns: ':visible', rows: ':visible' }
    //                 },
    //                 { extend: "pdf",
    //                     exportOptions: {
    //                     columns: ':visible', rows: ':visible' }
    //                 }
    //             ]
    //         }
    //     ]
    // });
        table.buttons( 0, null ).containers().appendTo( '#filterTopCriteria' );
    })
</script>
@endsection
