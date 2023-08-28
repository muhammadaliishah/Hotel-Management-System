@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('users') }}">Users</a></li>
                        <li class="breadcrumb-item active">Create User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">
      <i class="fa fa-users mr-1"></i>
      Create New User
    </h3>
    <a class="float-right btn-primary mb-2 p-2"  href="{{ route('users.index')}}">Back</a>
            </div>
    <div class="card-body">
    

<form method="post" action="{{ route('users.store') }}" >
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" >
	        @error('name')
	        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
	        @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" >
	        @error('username')
	        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
	        @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="email" value="{{ old('email') }}"> 
	        @error('email')
	        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
	        @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" >
	        @error('password')
	        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
	        @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
	        @error('password_confirmation')
	        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
	        @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <select class="form-control" name="roles[]" multiple>
                <option value="">-- Role --</option>
                @foreach($roles as $role) 
                	<option value="{{$role->name}}">{{$role->name}}</option>
            	 @endforeach    
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
@endsection