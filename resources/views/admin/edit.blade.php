@extends('layouts/app')
<!--  -->
@section('title','Admin | Edit') @section('subtitle', "Edit User")
<!--  -->
@section('nav-menu')
<div class="nav_list">
  <a href="{{ route('admin_home') }}" class="nav_link active">
    <i class="bx bx-grid-alt nav_icon"></i>
    <span class="nav_name">Dashboard</span>
  </a>
</div>
@endsection
<!--  -->
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 col-md-4">
      <form
        class="form-group"
        action="{{route ('admin_update',$user->id)}}"
        method="POST"
      >
        @method('post')
        <!--  -->
        @csrf
        <div class="form-group">
          <label for="nama">Nama </label>
          <input
            autocomplete="off"
            class="form-control @error('name') is-invalid @enderror"
            type="text"
            name="name"
            id="nama"
            value="{{$user->name}}"
          />
          @error('name')
          <span class="text-danger" role="alert">
            {{ $message }}
          </span>
          @enderror
        </div>
        <div class="form-group my-3">
          <label for="email">Email </label>
          <input
            autocomplete="off"
            class="form-control @error('email') is-invalid @enderror"
            type="email"
            name="email"
            id="email"
            value="{{$user->email}}"
          />
          @error('email')
          <span class="text-danger" role="alert">
            {{ $message }}
          </span>
          @enderror
        </div>

        <div class="input-group my-3">
          <label class="input-group-text" for="role">Role</label>
          <select class="form-select" id="role" name="role">
            <option
              value="{{$user->role}}"
              selected
              hidden
              >{{$user->role}}</option
            >
            <option value="Pimpinan">Pimpinan</option>
            <option value="Teknisi">Teknisi</option>
          </select>
        </div>
        <div class="form-group my-3">
          <label for="password">Password </label>
          <input
            autocomplete="off"
            class="form-control @error('password') is-invalid @enderror"
            type="password"
            name="password"
            id="password"
            placeholder="Kosongkan jika tidak ingin diubah"
          />
          @error('password')
          <span class="text-danger" role="alert">
            {{ $message }}
          </span>
          @enderror
        </div>
        <input
          class="btn btn-primary w-100 my-3"
          type="submit"
          value="SUBMIT"
        />
      </form>
    </div>
  </div>
</div>
@endsection
