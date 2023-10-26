<nav class="layout-navbar container-xxl navbar position-absolute navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="ti ti-menu-2 ti-sm"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
          <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
            <i class="ti ti-search ti-md me-2"></i>
            <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
          </a>
        </div>
      </div>
      <!-- /Search -->

      <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- Style Switcher -->
        <li class="nav-item me-2 me-xl-0">
            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
              <i class="ti ti-md"></i>
            </a>
        </li>
        <!--/ Style Switcher -->

        <!-- Notification -->
        <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a
              class="nav-link dropdown-toggle hide-arrow"
              href="javascript:void(0);"
              data-bs-toggle="dropdown"
              data-bs-auto-close="outside"
              aria-expanded="false"
            >
              <i class="ti ti-bell ti-md"></i>
              @if (App\Models\WorkOrder::where('status',1)->count() != 0)
                  <span class="badge bg-danger rounded-pill badge-notifications">{{ App\Models\WorkOrder::where('status',1)->count() }}</span>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
              <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Notification</h5>
                  <a
                    href="javascript:void(0)"
                    class="dropdown-notifications-all text-body"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Mark all as read"
                    ><i class="ti ti-mail-opened fs-4"></i
                  ></a>
                </div>
              </li>
              <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush">
                    @if(App\Models\WorkOrder::where('status',1)->count() == 0)
                    <div class="flex-grow-1 p-1">
                        <p class="mb-0 text-center">Tidak ada permintaan terbaru</p>
                    </div>
                    @else

                    @foreach (App\Models\WorkOrder::with(['employee'])->where('status',1)->orderBy('created_at','desc')->get() as $item)
                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                <img src="https://ui-avatars.com/api/?name={{ $item->employee->name }}" alt class="h-auto rounded-circle" />
                            </div>
                            </div>
                            <div class="flex-grow-1" onclick="window.location.href = '{{ route('workorder1.show', $item->id) }}'">
                            <h6 class="mb-1">{{ $item->employee->name }} Menunggu Persetujuan Work Order</h6>
                            <p class="mb-0">Anda memiliki permintaan persetujuan yang perlu ditinjau. Silahkan klik untuk memberikan persetujuan atau penolakan.</p>
                            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                                    ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"
                            ><span class="ti ti-x"></span
                            ></a>
                        </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
              </li>
              <li class="dropdown-menu-footer border-top">
                <a
                  href="javascript:void(0);"
                  id="view-all-notifications-link"
                  class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center"
                >
                  Close notifications
                </a>
              </li>
            </ul>
          </li>
          <!--/ Notification -->

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt class="h-auto rounded-circle" />
            </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ url('/dashboard') }}">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt class="h-auto rounded-circle" />
                    </div>
                    </div>
                    <div class="flex-grow-1">
                    <span class="fw-semibold d-block">{{ Auth::user()->email }}</span>
                    <small class="text-muted">admin</small>
                    </div>
                </div>
                </a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <div class="dropdown-item">
                    <i class="ti ti-logout me-2 ti-sm"></i>
                    <button type="button" class="btn align-middle logout">Log Out</button>
                </form>
                </a>
            </li>
            </ul>
        </li>
        <!--/ User -->
      </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper  d-none">
      <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
      <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>
</nav>

