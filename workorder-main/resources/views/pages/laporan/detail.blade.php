@extends('layouts.master')
@section('content')
<h4 class="fw-bold py-3 mb-34">
    <span class="text-muted fw-light">Data Laporan  /</span> Feature / {{ $title }}
</h4>
<div class="row">
    <!-- Inline text elements -->
    <div class="col">
      <div class="card mb-4">
        <h5 class="card-header">{{ $title }}</h5>
        <div class="card-body">
            <div class="row">
                <!-- Menu Kiri -->
                <div class="col-md-6">
                    <table cellpadding="5">
                        <tr>
                            <td><b>No. Work Order</b></td>
                            <td>:</td>
                            <td>{{ $data->wo_number }}</td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Order </b></td>
                            <td>:</td>
                            <td>{{ $data->order_date }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Menu Kanan -->
                <div class="col-md-6 text-md-right">
                    <table cellpadding="5">
                        <tr>
                            <td><b>Perusahaan</b></td>
                            <td>:</td>
                            <td>{{ $data->company->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Departement </b></td>
                            <td>:</td>
                            <td>{{ $data->department->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Nama Pemohon </b></td>
                            <td>:</td>
                            <td>{{ $data->employee->name }}</td>
                        </tr>
                        <tr>
                            <td><b>NRP Pemohon </b></td>
                            <td>:</td>
                            <td>{{ $data->employee->nrp }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Tabel Detail -->
            <div class="row mt-4">
                <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-twitter">
                            <th rowspan="2" class="text-center" style="vertical-align: middle">No</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Deskripsi Permintaan</th>
                            <th colspan="3" class="text-center">Unit yang di perlukan</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Jumlah</th>
                            <th colspan="2" class="text-center">Tanggal</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle" width="50px">Estimasi Jam Penggunaan</th>
                        </tr>
                        <tr class="bg-info">
                            <th class="text-center">Jenis Unit</th>
                            <th class="text-center">Kode Unit</th>
                            <th class="text-center">Egi</th>
                            <th class="text-center">Mulai</th>
                            <th class="text-center">Selesai</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data->details as $item)
                            <tr>
                                <td class="text-center" style="vertical-align: middle">{{ $loop->iteration }}</td>
                                <td class="text-center" style="vertical-align: middle">{{ $data->request_description ?? '-' }}</td>
                                <td class="text-center">{{ $item->unit->type ?? '-' }}</td>
                                <td class="text-center">{{ $item->unit->unit ?? '-' }}</td>
                                <td class="text-center">{{ $item->unit->egi ?? '-' }}</td>
                                <td class="text-center" style="vertical-align: middle">1</td>
                                <td class="text-center">{{ $item->start_date ?? '-'}}</td>
                                <td class="text-center">{{ $item->final_date ??'-'}}</td>
                                <td class="text-center" style="vertical-align: middle">{{ $item->hours_use == null ? '-' : $item->hours_use.' Jam' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Modal -->
  <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Keterangan Ditolak</h3>
            <p class="text-muted"></p>
          </div>
          <form action="{{ route('workorder1.reject', $data->id) }}" method="POST"  class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-12">
                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label" for="creditCardMask">Keterangan</label>
                    <div class="input-group input-group-merge">

                      <textarea id="description" class="form-control" name="description" placeholder="Berikan Alasan Kenapa Ditolak !!!!!!" cols="30" rows="5"></textarea>
                    </div>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan</button>
              <button
                type="reset"unit_code
                unit_code
                class="btn btn-label-secondary btn-reset"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Card Modal -->

@endsection

@section('page-script')
  <script>
    $(document).ready(function(){
        $("#wo-detail").on('click', '.btn-accept', function(e) {
            e.preventDefault();
                Swal.fire({
                    title: 'Edit data?',
                    text: "Setujui data bersifat permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Terima!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit()
                    }
                })
            });
    })
  </script>
@endsection
