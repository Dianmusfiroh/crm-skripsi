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
        <label for="example-text-input" class="form-control-label">Nama</label>
        <input class="form-control" type="text" name="name" value="{{ $data->name }}" placeholder="Nama" id="example-text-input">
      </div>
      <div class="form-group">
        <label for="example-text-input" class="form-control-label">Nomor Hp</label>
        <input class="form-control" type="text" name="no_hp" value="{{ $data->no_hp }}" placeholder="Nomor Hp" id="example-text-input">
      </div>
      <div class="form-group">
        <label for="example-text-input" class="form-control-label">Divisi</label>
        <select name="divisi_id" id="" class="form-control">
          @foreach ($divisi as $item)
            <option value="{{ $item->id }}" {{ $data->divisi_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="example-text-input" class="form-control-label">Role</label>
        <select name="role_id" id="" class="form-control">
          @foreach ($role as $item)
            <option value="{{ $item->id }}" {{ $data->role_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="example-text-input" class="form-control-label">Email</label>
        <input class="form-control" type="email" name="email" value="{{ $data->user->email }}" id="example-text-input">
      </div>
      <div class="form-group">
        <label for="example-text-input" class="form-control-label">Password</label>
        <input class="form-control" type="password" name="password" value="{{ $data->user->password }}" id="example-text-input">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
</div>
@endsection