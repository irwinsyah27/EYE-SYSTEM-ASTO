@extends('layouts.master')
@section('content')
<h4 class="fw-bold py-3 mb-34">
    <span class="text-muted fw-light"> Data Work Order 2 /</span> Feature / {{ $title }}
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
                  <p class="mb-0">{{ $data->workorder->wo_number }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Tanggal Order</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ Carbon\Carbon::parse($data->workorder->order_date)->format('d-m-Y') }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Perusahaan Pemohon</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->workorder->company->name }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Departemen</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->workorder->department->name }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Nama Pemohon</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->workorder->employee->name }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">NRP Pemohon</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->workorder->employee->nrp }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Alamat</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->workorder->company->address }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Tanggal Mulai</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->workorder->start_date }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Tanggal Akhir</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->workorder->end_date }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Unit yang diperlukan</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->item ?? '-' }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Jumlah</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->qty ?? '0' }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Type Unit</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->unit->type ?? '-' }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Kode Unit</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->unit->unit ?? '-' }}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">EGI</small></td>
                <td class="py-1">
                  <p class="mb-0">{{ $data->unit->egi ?? '-' }}</p>
                </td>
              </tr>
            <tr>
                <td><small class="text-light fw-semibold">Jam Penggunaan</small></td>
                <td class="py-1">
                <p class="mb-0">{{ $data->hours_use != null ? $data->hours_use.' Jam' : '-' }}</p>
                </td>
            </tr>
            <tr>
                <td><small class="text-light fw-semibold">Tanggal Selesai</small></td>
                <td class="py-1">
                  <p class="mb-0">{{  $data->final_date ?? '-' }}</p>
                </td>
            </tr>
              @if ($data->image != null)
                <tr>
                    <td><small class="text-light fw-semibold">Image</small></td>
                    <td class="py-1">
                    <a href="{{ asset('./storage/'.$data->image) }}">Klik untuk melihat gambar</a>
                    </td>
                </tr>
              @endif
              @if($data->unit_id == null)
                <tr>
                    <td class="py-2">
                        <div class="row">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="col-6 btn btn-danger btn-block">Edit</button>
                        </div>
                    </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

   <!-- Card Modal -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Data Work Order</h3>
            <p class="text-muted">Edit Data Work Order Lainnya</p>
          </div>
          <form action="{{ route('workorder2.update', $data->id) }}" method="POST"  class="row g-3" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12">
                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label" for="creditCardMask">Type Unit</label>
                    <div class="input-group input-group-merge">
                        <select name="type" id="type" class="form-select">
                            <option selected disabled value="">Pilih Type Unit</option>
                            @foreach ($type as $i)
                                <option value="{{ $i->type }}">{{ $i->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label" for="creditCardMask">Kode Unit</label>
                    <div class="form-group">
                        <select id="unit" name="unit" class="form-control" disabled>
                          <option value="">Pilih Unit</option>
                        </select>
                    </div>
                    @error('unit')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label" for="creditCardMask">EGI</label>
                    <div class="form-group">
                        <select id="egi" name="egi" class="form-control" disabled>
                          <option value="">Pilih EGI</option>
                        </select>
                    </div>
                    @error('egi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label" for="creditCardMask">Upload Gambar (Max: 1 gambar)</label>
                    <div class="input-group input-group-merge">
                      <input type="file" id="image" class="form-control" name="image"/>
                    </div>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label" for="creditCardMask">Tanggal Selesai</label>
                    <div class="input-group input-group-merge">
                      <input type="datetime-local" id="final_date" class="form-control" name="final_date"/>
                    </div>
                    @error('final_date')
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // Ambil elemen-elemen yang diperlukan
    var typeSelect = document.getElementById('type');
    var unitSelect = document.getElementById('unit');
    var egiSelect = document.getElementById('egi');

    // Tambahkan event listener untuk perubahan pilihan tipe
    typeSelect.addEventListener('change', function() {
      var selectedType = this.value;

      // Kosongkan pilihan unit sebelumnya
      unitSelect.innerHTML = '<option value="">Pilih Unit</option>';
      unitSelect.disabled = true;

      egiSelect.innerHTML = '<option value="">Pilih EGI</option>';
      egiSelect.disabled = true;

      if (selectedType) {
        var url = '/unit/' + selectedType + '/get-by-type';
        // Lakukan permintaan AJAX menggunakan library seperti Axios atau fetch
        axios.get(url)
            .then(function(response) {
                var units = response.data;
                units.forEach(function(unit) {
                    var option = document.createElement('option');
                    option.value = unit.unit; // Ganti dengan nilai yang sesuai
                    option.textContent = unit.unit; // Ganti dengan atribut yang sesuai
                    unitSelect.appendChild(option);
                });
                unitSelect.disabled = false;

                var egis = response.data;
                egis.forEach(function(egi) {
                    var option = document.createElement('option');
                    option.value = egi.egi; // Ganti dengan nilai yang sesuai
                    option.textContent = egi.egi; // Ganti dengan atribut yang sesuai
                    egiSelect.appendChild(option);
                });
                egiSelect.disabled = false;
            })
            .catch(function(error) {
                console.error(error);
            });
        }
    });

    // Tambahkan event listener untuk perubahan pilihan kode unit
  unitSelect.addEventListener('change', function() {
    var selectedUnit = this.value;

    // Kosongkan pilihan egi sebelumnya
    egiSelect.innerHTML = '<option value="">Pilih EGI</option>';
    egiSelect.disabled = true;

    if (selectedUnit) {
      var url = '/unit/' + selectedUnit + '/get-egi';
      // Lakukan permintaan AJAX menggunakan library seperti Axios atau fetch
      axios.get(url)
        .then(function(response) {
          var egis = response.data.egis;
          egis.forEach(function(egi) {
            var option = document.createElement('option');
            option.value = egi; // Ganti dengan nilai yang sesuai
            option.textContent = egi; // Ganti dengan atribut yang sesuai
            egiSelect.appendChild(option);
            $('#egi').val(egi)
          });

          // Set the selected EGI value if available
          var selectedEgi = '{{ $data->egi }}'; // Assuming you pass the $data->egi from your controller
          if (selectedEgi) {
            egiSelect.value = selectedEgi;
          }
          console.log('selectedEgi:', selectedEgi); // Check the value in the console
        egiSelect.disabled = false;
        })
        .catch(function(error) {
          console.error(error);
        });
    }
  });
  </script>
@endsection
