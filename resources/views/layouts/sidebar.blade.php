<div class="min-height-300 bg-primary position-absolute w-100 me-2"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
      <img src="{{ asset('/assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">Argon Dashboard 2</span>
    </a>
  </div>
  <hr class="horizontal dark ">
  <div class="" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'dashboard'): {{'active'}} @endif" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
    @if (Auth::user()->role->name == "Admin" || Auth::user()->role->name == "Ketua Tim")

      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'projek'): {{'active'}} @endif " href="{{ url('projek') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Projek</span>
        </a>
      </li>
    @endif
    @if (Auth::user()->role->name != "Pimpinan" )

      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'tugas'): {{'active'}} @endif " href="{{ url('tugas') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Tugas</span>
        </a>
      </li>
    @endif

    @if (Auth::user()->role->name == "Admin" || Auth::user()->role->name == "Ketua Tim")

      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'divisi'): {{'active'}} @endif " href="{{ url('divisi') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">TIM</span>
        </a>
      </li>
    @endif

      {{-- <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'tim'): {{'active'}} @endif" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ">TIM</span>
            <i class="ni ni-bold-right"></i>
          </a>
          <ul class="dropdown-menu me-2 p-3 align-items-center justify-content-center" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>

      </li> --}}
    @if (Auth::user()->role->name == "Admin" || Auth::user()->role->name == "Ketua Tim" || Auth::user()->role->name == "Pimpinan")

      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'laporan'): {{'active'}} @endif" href="{{ url('laporan') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporan</span>
        </a>
      </li>
    @endif

    @if (Auth::user()->role->name == "Admin" || Auth::user()->role->name == "Ketua Tim")
          
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'anggota'): {{'active'}} @endif" href="{{ url('anggota') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Anggota</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'broadcast'): {{'active'}} @endif" href="{{ url('broadcast') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-mobile-alt  text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Log Broadcast</span>
        </a>
      </li>
    @endif

    @if (Auth::user()->role->name == "Admin")
        
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Master</h6>
      </li>
      
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'perangkat'): {{'active'}} @endif" href="{{ url('perangkat') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-mobile-alt  text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Perangkat</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'setting-alarm'): {{'active'}} @endif" href="{{ url('setting-alarm') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-mobile-alt  text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Waktu Pengingat</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link @if(Request::segment(1) == 'divisi'): {{'active'}} @endif" href="{{ url('divisi') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-mobile-alt  text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Divisi</span>
        </a>
      </li>
    @endif
      
    
    </li>
    </ul>
  </div>
</aside>
