@extends('layouts.master')
@section('content')
<h4 class="fw-bold py-3 mb-34">
    <span class="text-muted fw-light">Data Karyawan  /</span> Feature / {{ $title }}
</h4>
<div class="row">
    <form method="POST" enctype="multipart/form-data" action="{{ $action }}">
        @method($method)
        @csrf
    <!-- Input Mask -->
    <div class="col-12">
      <div class="card mb-34">
        <h5 class="card-header">{{ $title }}</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-xl-3 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">No. NRP</label>
                <div class="input-group input-group-merge">
                  <input type="text" id="nrp" class="form-control" name="nrp" placeholder="No NRP" value="{{ $employee->nrp ?? old('nrp') }}" />
                </div>
                @error('nrp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-xl-3 col-md- col-sm-12 mb-3">
              <label class="form-label" for="creditCardMask">Nama Karyawan</label>
              <div class="input-group input-group-merge">
                <input type="text" id="name" class="form-control" name="name" placeholder="Nama Karyawan"  value='{{ $employee->name ?? old('name') }}'/>
              </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-xl-3 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">Email</label>
                <div class="input-group input-group-merge">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Email" value='{{ $employee->email ?? old('email') }}'/>
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-xl-3 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">No Whatsapp</label>
                <div class="input-group input-group-merge">
                    <input type="number" id="no_handphone" class="form-control" name="no_handphone" placeholder="No Whatsapp" value='{{ $employee->no_handphone ?? old('no_handphone') }}'/>
                </div>
                @error('no_handphone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="col-xl-3 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">Tanggal Lahir</label>
                <div class="input-group input-group-merge">
                    <input type="date" id="date_born" class="form-control" name="date_born" placeholder="Tanggal Lahir" value='{{ $employee->date_born ?? old('date_born') }}'/>
                </div>
                @error('date_born')
                   <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-xl-6 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">Alamat</label>
                <div class="input-group input-group-merge">
                    <input type="text" id="address" class="form-control" name="address" placeholder="Alamat" value='{{ $employee->address ?? old('address') }}'/>
                </div>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-xl-3 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-xl-3 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">Departemen</label>
                <div class="input-group input-group-merge">
                  <select class="form-select" name="department_id" id="department_id">
                    <option disabled selected value="">Pilih Departemen</option>
                    @foreach ($department as $item)
                        <option value="{{ $item->id }}" @if($item->id == $employee->department_id) selected @endif>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                  @error('department_id')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
              <div class="col-xl-3 col-md- col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">Perusahaan</label>
                <div class="input-group input-group-merge">
                  <select class="form-select" name="company_id" id="company_id">
                    <option disabled selected value="">Pilih Perusahaan</option>
                    @foreach ($company as $item)
                        <option value="{{ $item->id }}" @if($item->id == $employee->company_id) selected @endif>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                  @error('company_id')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
            <div class="float-right">
                <button class="btn btn-primary mt-2" type="submit">
                    <i class="fa fa-save me-2"></i>
                    <span class="align-middle">Simpan Data</span>
                </button>
            </div>
        </div>
      </form>
      </div>
    </div>
</div>
@endsection
