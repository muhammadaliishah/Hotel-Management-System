@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Users Role Managment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
    <section class="content">
<div class="row">
    
<div class="col-md-12">
    @if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
    <div class="card">
        <div class="card-header bg-info">
                <h3 class="card-title">
      <i class="fa fa-users mr-1"></i>
      Role Management
    </h3>
    <a class="float-right btn-primary mb-2 p-2"  href="{{ route('roles.create')}}">Create New Role</a>
            </div>
<div class="card-body">
<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            {{-- <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a> --}}
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            @endcan
        </td>
    </tr>
    @endforeach
</table>
</div>
</div>
</div>
</div>
{!! $roles->render() !!}
</section>
@endsection