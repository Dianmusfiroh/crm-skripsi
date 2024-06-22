@extends('layouts.main')
@section('content')
<div class="row">
  <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-12">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Tugas Baru</p>
              <h5 class="font-weight-bolder">
                {{$tugas_baru->count()}}
              </h5>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Proses</p>
              <h5 class="font-weight-bolder">
                {{$tugas_proses->count()}}
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Testing</p>
              <h5 class="font-weight-bolder">
                {{$tugas_testing->count()}}
              </h5>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-2 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Selesai</p>
              <h5 class="font-weight-bolder">
                {{$tugas_selesai->count()}}
              </h5>
           
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Optimasi</p>
              <h5 class="font-weight-bolder">
                {{$daysDifference}} hari 
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="numbers">
              @if ($total<50)
                <h5 class="font-weight-bolder text-danger mt-3">
                  {{number_format($total,2)}} %
                </h5>
              @else
                <h5 class="font-weight-bolder mt-3">
                  {{number_format($total,2)}} %
                </h5>
              @endif
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mt-5">
  <div class="card">
    <div class="card-header pb-0">
      <div class="row">
        <div class="col-md-10">
          <h6>Daftar Tugas</h6>
        </div>
        <div class="col-md-2 ">
          @if (Auth::user()->role_id != 4)
              
          <a data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success">Tambah</a>
          @endif
          
        </div>
      </div>
    </div>
  </div>
  <div class="row  mt-3 flex-nowrap overflow-auto">
      <div class="col-4">
          
        <div class="card z-index-2 h-100  bg-opacity-50">
          <div class="card-header  pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize text-white">Tugas Baru</h6>
          </div>
          <div class="card-body overflow-auto" style="height: 200px;">
          @foreach ($tugas_baru as $tb )

            <div class="card mt-2 card-header-outline">
              <div class="card-body">
                <h5>{{$tb->projek ? $tb->projek->name: ''}}</h5>
                <h6>{{$tb->judul}}</h6>
                <span class="fs-6">{{$tb->id_anggota ? $tb->anggota->name : ''}} ({{$tb->id_anggota ? $tb->anggota->divisi->name : ''}})</span>
                <br>

                @if ($tb->status == 'normal')
                <span class="badge bg-gradient-info">Normal</span>
                @else
                <span class="badge bg-gradient-danger">Urgent</span>
                @endif
                <span class="badge bg-gradient-primary">Baru</span>
                <br>
                <span>{{Carbon\Carbon::parse($tb->target_awal)->format('d/m/Y')}} - {{Carbon\Carbon::parse($tb->target_akhir)->format('d/m/Y')}}</span>
                <p>{{$tb->deskripsi}}</p>
                <div class="d-flex justify-content-end">
                  <a onclick="toProses('{{$tb->id}}')" id="mulai" class=" btn btn-sm btn-success">Mulai</a>
                </div>
              </div>
       
            </div>
          @endforeach
           
          </div>  
          </div>

        </div>
  
      <div class="col-4">
        <div class="card z-index-2 h-100  bg-opacity-50">
          <div class="card-header  pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize text-white">Proses</h6>
          </div>
          <div class="card-body overflow-auto" style="height: 200px;">
            @foreach ($tugas_proses as $tp )

            <div class="card mt-2 card-header-outline">
              <div class="card-body">
                <h5>{{$tp->projek ? $tp->projek->name: ''}}</h5>
                <h6>{{$tp->judul}}</h6>
                <span class="fs-6">{{$tp->id_anggota ? $tp->anggota->name : ''}} ({{$tp->id_anggota ? $tp->anggota->divisi->name : ''}})</span>
                <br>

                @if ($tp->status == 'normal')
                <span class="badge bg-gradient-info">Normal</span>
                @else
                <span class="badge bg-gradient-danger">Urgent</span>
                @endif
                <span class="badge bg-gradient-secondary">Proses</span>
                <br>
                <span>{{Carbon\Carbon::parse($tp->target_awal)->format('d/m/Y')}} - {{Carbon\Carbon::parse($tp->target_akhir)->format('d/m/Y')}}</span>
                              <p>{{$tp->deskripsi}}</p>
                <div class="d-flex justify-content-end">
                  <a onclick="toVerif('{{$tp->id}}')" class=" btn btn-sm btn-success">Selesai</a>
                </div>
              </div>
       
            </div>
          @endforeach
        
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card z-index-2 h-100  bg-opacity-50">
          <div class="card-header  pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize text-white">Pemeriksaan</h6>
          </div>
          <div class="card-body overflow-auto" style="height: 200px;">
            @foreach ($tugas_testing as $tt )

            <div class="card mt-2 card-header-outline">
              <div class="card-body">
                <h5>{{$tt->projek ? $tt->projek->name: ''}}</h5>
                <h6>{{$tt->judul}}</h6>
                <span class="fs-6">{{$tt->id_anggota ? $tt->anggota->name : ''}} ({{$tt->id_anggota ? $tt->anggota->divisi->name : ''}})</span>
                <br>

                @if ($tt->status == 'normal')
                <span class="badge bg-gradient-info">Normal</span>
                @else
                <span class="badge bg-gradient-danger">Urgent</span>
                @endif
                <span class="badge bg-gradient-warning">Testing</span>
                <br>
                <span>{{Carbon\Carbon::parse($tt->target_awal)->format('d/m/Y')}} - {{Carbon\Carbon::parse($tt->target_akhir)->format('d/m/Y')}}</span>
                              <p>{{$tt->deskripsi}}</p>
                @if (Auth::user()->role_id != 4)
                  <div class="d-flex justify-content-end">
                    <a onclick="toSelesai('{{$tt->id}}')" class=" btn btn-sm btn-success">Selesai</a>
                  </div>
                @endif
              </div>
       
            </div>
          @endforeach
        
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card z-index-2 h-100  bg-opacity-50">
          <div class="card-header  pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize text-white">Selesai</h6>
          </div>
          <div class="card-body overflow-auto" style="height: 200px;">
            @foreach ($tugas_selesai as $ts )

            <div class="card mt-2 card-header-outline">
              <div class="card-body">
                <h5>{{$ts->projek ? $ts->projek->name: ''}}</h5>
                <h6>{{$ts->judul}}</h6>
                <span class="fs-6">{{$ts->id_anggota ? $ts->anggota->name : ''}} ({{$ts->id_anggota ? $ts->anggota->divisi->name : ''}})</span>
                <br>

                @if ($ts->status == 'normal')
                <span class="badge bg-gradient-info">Normal</span>
                @else
                <span class="badge bg-gradient-danger">Urgent</span>
                @endif
                <span class="badge bg-gradient-success">Selesai</span>
                <br>
                <span>{{Carbon\Carbon::parse($ts->target_awal)->format('d/m/Y')}} - {{Carbon\Carbon::parse($ts->target_akhir)->format('d/m/Y')}}</span>
                              <p>{{$ts->deskripsi}}</p>
              </div>
       
            </div>
          @endforeach
        
          </div>
        </div>
      </div>
      <!-- Tambahkan lebih banyak kartu sesuai kebutuhan -->
  </div>
</div>
{{-- modal --}}
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Tambah Tugas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route($modul.'.store') }}" method="POST">
            @csrf

          <div class="modal-body">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Judul Tugas</label>
                <input class="form-control" type="text" name="judul" placeholder="Judul Tugas" id="example-text-input">
            </div>
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="" placeholder="Deskripsi" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Status</label>
              <select name="status" id="" class="form-control">
                <option value="">Pilih Status</option>
                <option value="urgent">urgent</option>
                <option value="normal">normal</option>
              </select>
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Target Awal</label>
              <input class="form-control" type="date" name="target_awal"  id="example-text-input">
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Target Akhir</label>
              <input class="form-control" type="date" name="target_akhir"  id="example-text-input">
            </div>
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Projek</label>
              <select name="projek_id" id="" class="form-control">
                <option value="">Pilih Projek</option>
                @foreach ($projek as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-control">
              <label for="example-text-input" class="form-control-label">Karyawan</label>
              <select name="karyawan_id" id="" class="form-control">
                <option value="">Pilih Karyawan</option>
                @foreach ($karyawan as $item)
                  <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->divisi->name }}</option>
                @endforeach
              </select>
            </div>
        </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
  </div>
</div>
@include('layouts.script.delete')
@section('js')
$(document).ready( function () {
  $('#myTable').DataTable();
  {{-- $.ajax({
    url :"{{ route('count_proses') }}",
    type: 'GET',
    success: function(response) {
       
      if(response > 0){
        $('#mulai').hide();
      }
    },
    error: function(xhr, status, error) {
        console.log(error);
    }
  })   --}}
  
} );

function toProses(id) {
  Swal.fire({
    title: 'Apakah Anda Yakin?',
    text: "Kamu Akan Memulai Tugas ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
            url :"{{ route('toProses') }}",
            {{-- url :"{{ route('toProses') }}", --}}
            type: 'GET',
            data: { id: id },
              success: function(response) {
                  Swal.fire(
                      'Proses!',
                      'Tugas Dalam Proses.',
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
function toVerif(id) {
  Swal.fire({
    title: 'Apakah Anda Yakin?',
    text: "Kamu  Sudah Menyelesaikan Tugas ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
            url :"{{ route('toVerif') }}",
            type: 'GET',
            data: { id: id },
              success: function(response) {
                  Swal.fire(
                      'Proses!',
                      'Tugas Telah Selesai.',
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
function toSelesai(id) {
  Swal.fire({
    title: 'Apakah Anda Yakin?',
    text: "Kamu Menyelesaikan Tugas ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
            url :"{{ route('toSelesai') }}",
            type: 'GET',
            data: { id: id },
              success: function(response) {
                  Swal.fire(
                      'Proses!',
                      'Tugas Telah Selesai.',
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