
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}">
  <title>
   {{ config('app.name', 'Laravel') }} 
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

  <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  {{-- <script src="{{ mix('js/app.js') }}"></script> --}}

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link id="pagestyle" href="{{ asset('/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>


  <style>
    .bg-opacity-50 {
        background-color: rgb(55, 55, 94, 0.8); /* 0.5 indicates 50% opacity */
    }
    .card-header-outline {
      border-top: 5px solid #007bff; /* warna dan ketebalan garis atas */
      border-radius: .25rem .25rem 0 0; /* sudut lengkung pada sisi atas */
    }
  </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    @include('layouts.sidebar')
    <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.nav')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield('content')
      @include('sweetalert::alert')
          <!-- Modal -->
          <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="myDeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myDeleteModal">HAPUS KONFIRMASI</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
             
                    <form action="" id="deleteForm" method="post">

                    <div class="modal-body">
                      <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p class="text-center">Apa Kamu Yakin Akan Menghapus Data ini ?</p>      
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                      <button type="button" onclick="formSubmit()" class="btn btn-danger">Ya, Hapus</button>
                    </div>
                  </form>
                </div>
            </div>
          </div>
      {{-- <div class="modal fade none-border"  id="DeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog w-50">
            <div class="modal-content">
              <form action="" id="deleteForm" method="post">
                <div class="modal-header">
                  <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  
                    <h4 class="modal-title"><strong>HAPUS KONFIRMASI</strong></h4>

                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p class="text-center">Apa Kamu Yakin Akan Menghapus Data ini ?</p>      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                  <button type="button" onclick="formSubmit()" class="btn btn-danger">Ya, Hapus</button>
                </div>
              </form>

            </div>
        </div>
      </div> --}}
      <footer class="footer pt-3  ">

        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank"> </a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
 
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>
  <script>
    @yield('js')
  </script>
  <script>

  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>