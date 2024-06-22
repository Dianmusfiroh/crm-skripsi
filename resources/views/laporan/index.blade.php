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
                {{-- <a data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success">Tambah</a> --}}
              </div>
            </div>
          </div>
          
          <div class="card-body px-3 pt-0 pb-2">
            <div class="table-responsive p-2 ">
              <table class="table align-items-center mb-0" id="myTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Divisi</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Progres</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                    
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">
                            {{ $item->name }}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->divisi ? $item->divisi->name  : 'Programmer'}}</p>
                    </td>
                    <td class="align-middle text-center">
                      {{$item->tugas->count() ? ($tugas_selesai->count()/$item->tugas->count())* 100 : 0}}%
                    </td>
                    <td class="align-middle text-center">
                      <span>
                        <a href="{{ route('laporan.show', $item->id) }}" class="text-info text-end">
                        <i class="fas fa-eye me-2"></i></a>
                      </span>
                      <span>
                        <a href="{{ route('generatePDF', $item->id) }}" class="text-secondary text-end">
                        <i class="fas fa-print  me-2"></i></a>
                      </span>
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