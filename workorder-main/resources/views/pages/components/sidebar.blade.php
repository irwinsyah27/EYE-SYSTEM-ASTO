<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical bg-black ">
    <div class="app-brand demo">
      <a href="{{ route('dashboard') }}" class="app-brand-link">
        <span class="app-brand-logo">
          <img src="{{ asset('assets/logo/logoasto.png') }}" alt="" srcset="" width="50px" height="50px">
        </span>
        <span class="app-brand-text demo menu-text fw-bold">Eye System</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-white text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <li class="menu-item {{ (request()->is('dashboard') ? 'active':'') }}">
        <a href="{{ route('dashboard') }}" class="menu-link text-white">
          <i class="menu-icon tf-icons ti ti-dashboard"></i>
          <div >Dashboard</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('karyawan') || request()->is('karyawan/*') || request()->is('departemen') || request()->is('departemen/*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link text-white menu-toggle">
            <i class="menu-icon tf-icons ti ti-database"></i>
            <div>Data Master</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->is('karyawan') || request()->is('karyawan/*') ? 'active' : '' }}">
                <a href="{{ route('karyawan.index') }}" class="menu-link text-white">
                    <div>Karyawan</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('perusahaan') || request()->is('perusahaan/*') ? 'active' : '' }}">
                <a href="{{ route('perusahaan.index') }}" class="menu-link text-white">
                    <div>Perusahaan</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('departemen') || request()->is('departemen/*') ? 'active' : '' }}">
                <a href="{{ route('departemen.index') }}" class="menu-link text-white">
                    <div>Departemen</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('unit') || request()->is('unit/*') ? 'active' : '' }}">
                <a href="{{ route('unit.index') }}" class="menu-link text-white">
                    <div>Unit</div>
                </a>
            </li>
        </ul>
      </li>
      <li class="menu-item {{ (request()->is('workorder-1') ? 'active':'') }}">
        <a href="{{ route('workorder1') }}" class="menu-link text-white">
          <i class="menu-icon tf-icons ti ti-clipboard"></i>
          <div >Work Order 1</div>
        </a>
      </li>
      <li class="menu-item {{ (request()->is('workorder-2') ? 'active':'') }}">
        <a href="{{ route('workorder2') }}" class="menu-link text-white">
          <i class="menu-icon tf-icons ti ti-archive"></i>
          <div >Work Order 2</div>
        </a>
      </li>
      <li class="menu-item {{ (request()->is('laporan') ? 'active':'') }}">
        <a href="{{ route('laporan') }}" class="menu-link text-white">
          <i class="menu-icon tf-icons ti ti-report-analytics"></i>
          <div >Laporan</div>
        </a>
      </li>
      <li class="menu-item {{ (request()->is('report') ? 'active':'') }}">
        <a href="{{ route('report') }}" class="menu-link text-white">
          <i class="menu-icon tf-icons ti ti-report"></i>
          <div >Report</div>
        </a>
      </li>
    </ul>
  </aside>
