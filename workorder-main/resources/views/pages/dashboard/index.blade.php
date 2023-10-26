@extends('layouts.master')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }}  </span>
</h4>
<div class="row">
    <!-- Revenue Growth -->
    <div class="col-xl-3 col-md-8 mb-4">
        <a href="{{ route('workorder1') }}">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <div class="d-flex flex-column">
                    <div class="card-title mb-auto">
                      <h5 class="mb-1 text-nowrap text-center">{{ App\Models\WorkOrder::count() }}</h5>
                    </div>
                    <div class="chart-statistics">
                      <small class="card-title mb-1 text-black">Total Permohonan</small>
                    </div>
                  </div>
                  <div id="revenueGrowth"></div>
                </div>
              </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-8 mb-4">
        <a href="{{ route('workorder1') }}">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <div class="d-flex flex-column">
                    <div class="card-title mb-auto">
                      <h5 class="mb-1 text-nowrap text-center">{{ App\Models\WorkOrder::where('status',2)->count() }}</h5>
                    </div>
                    <div class="chart-statistics">
                      <small class="card-title mb-1 text-black">Total Yang Diterima</small>
                    </div>
                  </div>
                  <div id="revenueGrowth"></div>
                </div>
              </div>
            </div>
        </a>
      </div>

      <div class="col-xl-3 col-md-8 mb-4">
        <a href="{{ route('workorder1') }}">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <div class="d-flex flex-column">
                    <div class="card-title mb-auto">
                      <h5 class="mb-1 text-nowrap text-center">{{ App\Models\WorkOrder::where('status',3)->count() }}</h5>
                    </div>
                    <div class="chart-statistics">
                      <small class="card-title mb-1 text-black">Total Yang Ditolak</small>
                    </div>
                  </div>
                  <div id="revenueGrowth"></div>
                </div>
              </div>
            </div>
        </a>
      </div>

      <div class="col-xl-3 col-md-8 mb-4">
        <a href="{{ route('karyawan.index') }}">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <div class="d-flex flex-column">
                    <div class="card-title mb-auto">
                      <h5 class="mb-1 text-nowrap text-center">{{ App\Models\Employee::count() }}</h5>
                    </div>
                    <div class="chart-statistics">
                      <small class="card-title mb-1 text-black text-black">Total Karyawan</small>
                    </div>
                  </div>
                  <div id="revenueGrowth"></div>
                </div>
              </div>
            </div>
        </a>
      </div>
@endsection

@section('page-script')

@endsection
