@extends('layouts.main')
@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-md-10">
                <h6>Log Broadcast</h6>
              </div>
              <div class="col-md-2 ">
                </div>
            </div>
          </div>
          
          <div class="card-body px-3 pt-0 pb-2">
            <div class="table-responsive p-2 ">
              <table class="table align-items-center mb-0" id="myTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Hp</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal terkirim</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pesan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $no => $item )
                    
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">
                            {{ ++$no }}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">
                            {{ $item->nomor }}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">
                            {{ $item->create_time }}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">
                            {{ $item->pesan }}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span>
                        <a onclick="send('{{$item->kd_list_broadcast}}')" class="btn btn-warning">
                          Kirim Ulang 
                    </a></span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  
@include('layouts.script.delete')
@section('js')
$(document).ready( function () {
  $('#myTable').DataTable();
  console.log('ada');
  
} );
function send(id) {
  Swal.fire({
    title: 'Apakah Anda Yakin?',
    text: "Kamu Mengirim Kembali pesan ini ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
            url :"{{ route('send') }}",
            type: 'GET',
            data: { id: id },
              success: function(response) {
                  Swal.fire(
                      'Proses!',
                      'Pesan Sementara Di proses.',
                      'success'
                  );
                  location.reload();
              },
              error: function(xhr, status, error) {
                  Swal.fire(
                      'Failed!',
                      'Terjadi Kesalahan.',
                      'error'
                  );
              }
          });
      }
  });
}
@endsection
@endsection