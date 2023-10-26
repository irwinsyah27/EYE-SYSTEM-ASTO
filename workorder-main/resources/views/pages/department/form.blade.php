@extends('layouts.master')
@section('content')
<h4 class="fw-bold py-3 mb-34">
    <span class="text-muted fw-light">Data Departemen  /</span> Feature / {{ $title }}
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
            <div class="col-xl-4 col-md-3 col-sm-12 mb-3">
                <label class="form-label" for="creditCardMask">Nama Departemen</label>
                <div class="input-group input-group-merge">
                  <input type="text" id="name" class="form-control" name="name" placeholder="Nama Departemen" value="{{ $department->name ?? old('name') }}" />
                </div>
                @error('name')
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
