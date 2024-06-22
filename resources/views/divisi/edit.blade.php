@extends('layouts.main')
@section('content')
<a href="javascript:history.back()" class="mb-3 text-white" ><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Edit {{$modul}}</h5>
  </div>
  <div class="card-body">
    <form action="{{ route($modul.'.update', $data->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="example-text-input" class="form-control-label">Divisi</label>
        <input class="form-control" type="text" name="name" value="{{ $data->name }}" placeholder="Divisi" id="example-text-input">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
</div>
@endsection