@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Position Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/employee_positions') }}">Positions</a></li>
                        <li class="breadcrumb-item active">Edit Position</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
</section>
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
      Edit Position
    </h3>
    <div class="float-right">
            <a href="{{ route('payroll.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Payroll
            </a>
    </div>
    </div>
    <div class="card-body">
        
        <form id="expense-entry" action="{{ route('employee_positions.update', $emp_position->pos_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="pos_type">Position Type</label>
                <select name="pos_type" class="form-control @error('pos_type') is-invalid @enderror" id="pos_type">
                    <option value="Regular" {{ old('pos_type',$emp_position->pos_type) === 'Regular' ? 'selected' : ''}}>Regular</option>
                    <option value="Contractual" {{ old('pos_type',$emp_position->pos_type) === 'Contractual' ? 'selected' : ''}}>Contractual</option>
                </select>
                @error('pos_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="pos_name">Position Name</label>
                <input type="text" name="pos_name" class="form-control @error('pos_name') is-invalid @enderror" id="pos_name"
                    placeholder="Position Name" value="{{ old('pos_name',$emp_position->pos_name) }}">
                @error('pos_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="pos_status">Position Status</label>
                <select name="pos_status" class="form-control @error('pos_status') is-invalid @enderror" id="pos_status">
                    <option value="1" {{ old('pos_status',$emp_position->pos_status) == 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('pos_status',$emp_position->pos_status) == 0 ? 'selected' : ''}}>Inactive</option>
                </select>
                @error('pos_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-lg btn-primary float-right" type="submit">Update Position</button>
        </form>
</div>
</div>
</div>
</section>
@endsection
@section('js')
<script src="{{ asset('adm/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('adm/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adm/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

@endsection