@extends('layouts.main')
@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-md-10">
                <h6>Authors table</h6>
              </div>
              <div class="col-md-2 ">
                <a data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success">Tambah</a>
              </div>
            </div>
          </div>
          
          <div class="card-body px-3 pt-0 pb-2">
            <div class="table-responsive p-2 ">
              <table class="table align-items-center mb-0" id="myTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Divisi</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">aksi</th>
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
                    <td class="align-middle text-center">
                      <span>
                        <a href="{{ route('divisi.edit', $item->id) }}" class="text-info text-end"><i class="fas fa-edit me-2"></i></a>
                        <a href="javascript:;"  data-bs-toggle="modal" data-bs-target="#DeleteModal"   onclick="deleteData('{{ $item->id }}')"
                        class="text-danger text-end">
                        <i class="far fa-trash-alt me-2"></i> 
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
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Tambah Divisi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('divisi.store') }}" method="POST">
                @csrf

              <div class="modal-body">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Divisi</label>
                    <input class="form-control" type="text" name="name" placeholder="divisi" id="example-text-input">
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
  console.log('ada');
  
} );

@endsection
@endsection