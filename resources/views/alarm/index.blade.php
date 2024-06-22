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
              </div>
            </div>
          </div>
          <form action="{{ route($modul.'.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
          <div class="card-body px-3 pt-0 pb-2">
            <label for="alarm">Waktu Pengingat</label>
            <input type="time" name="waktu" id="alarm" value="{{ date($data->waktu) }}" class="form-control ">
          
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary ">Simpan</button>
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