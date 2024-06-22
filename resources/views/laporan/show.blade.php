@extends('layouts.main')
@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-md-10">
                <h6>Daftar {{$modul}}</h6>
              </div>
              <div class="col-md-2 ">
                <a href="{{ route('generatePDF', $data->id) }}" class="btn btn-success"><i class="fas fa-print  me-2"></i> Print</a>
              </div>
            </div>
          </div>
          
          <div class="card-body px-3 pt-0 pb-2">
            <div class="table-responsive p-2 ">
              <table class="table align-items-center mb-0" id="myTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tugas</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">penanggung jawab</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estimasi Hari</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tugas as $item)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">
                            {{ $item->judul }}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->anggota ? $item->anggota->name  : ''}}</p>
                    </td>
                    <td class="align-middle text-center">
                        @if ($item->status_progres == 'selesai')
                        <span class="badge bg-gradient-success">Selesai</span>
                            
                        @elseif ($item->status_progres == 'testing')
                        <span class="badge bg-gradient-warning">Testing</span>

                        @elseif ($item->status_progres == 'proses')
                        <span class="badge bg-gradient-secondary">Proses</span>

                        @elseif ($item->status_progres == 'baru')
                        <span class="badge bg-gradient-primary">Baru</span>
                            
                        @endif

                    </td>
                    <td class="align-middle text-center">
                      <p class="text-xs font-weight-bold mb-0">
                    
                        {{Carbon\Carbon::parse($item->target_awal)->diffInDays(Carbon\Carbon::parse($item->target_akhir))}}</p>
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
} );

@endsection
@endsection