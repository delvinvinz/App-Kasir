@auth
@extends('app')
@section('content')
<div class="card-body">
  <div class="login-logo">
  <b>Edit Pengguna Baru</b>
  </div>
<div class="card">
  @if(session('success'))
   <p class="alert alert-success">
		{{ session('success') }}</p>
  @endif
  <div class="card-body login-card-body">
    <form action="{{ route('editregister.action', $useredit->id) }}" method="post">
    @csrf
    @method('PUT')
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{old('nama', $useredit->NamaUser) }}">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="username" placeholder="Username" value="{{old('username', $useredit->username) }}">
          <div class="input-group-append">
             <div class="input-group-text">
               <span class="fas fa-envelope"></span>
             </div>
          </div>
       </div>
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
             <div class="input-group-text">
               <span class="fas fa-lock"></span>
             </div>
          </div>
       </div>
       <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('list') }}" class="btn btn-danger">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@endsection
@endauth
