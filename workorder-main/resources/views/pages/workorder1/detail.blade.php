@extends('layouts.master')
@section('content')
<h4 class="fw-bold py-3 mb-34">
    <span class="text-muted fw-light">Data Work Order 1  /</span> Feature / {{ $title }}
</h4>
<div class="row">
    <!-- Inline text elements -->
    <div class="col">
      <div class="card mb-4">
        <h5 class="card-header">{{ $title }}</h5>
        <div class="card-body">
          <table id="wo-detail" class="table table-borderless">
            <tbody>
              <tr>
                <td width="250px"><small class="text-light fw-semibold">No Work Order</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->wo_number }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Tanggal Order</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ Carbon\Carbon::parse($data->order_date)->format('d-m-Y') }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Perusahaan Pemohon</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->company->name }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Departemen</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->department->name }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Nama Pemohon</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->employee->name }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">NRP Pemohon</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->employee->nrp }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Alamat</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->company->address }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-danger fw-bold">Deskripsi Permintaan</small></td>
                <td class="py-1">
                  <p class="mb-0 text-danger fw-bold">{{ $data->request_description }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Unit yang diperlukan</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->details()->pluck('item')->unique()->implode(', ') ?? '-' }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Jumlah</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->details()->sum('qty') ?? '0' }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Tanggal Mulai</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->start_date }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Tanggal Akhir</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->end_date }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">status</small></td>
                <td class="py-1">
                    @if ($data->status == 2)
                        <span class="badge bg-success">Disetujui</span>
                    @elseif($data->status == 3)
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <div class="row col-5 ">
                            <div class="col-5">
                                <form action="{{ route('workorder1.accept', $data->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="btn btn-info btn-block btn-accept">Terima</button>
                                </form>
                            </div>
                            <div class="col-5">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectModal" class="btn btn-danger btn-block">Tolak</button>
                            </div>
                        </div>
                    @endif
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Deskripsi (Alasan Ditolak)</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->description ?? '-' }}</p>
                </td>
              </tr>
            </tbody>
          </table>
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
