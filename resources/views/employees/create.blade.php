@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Employees Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/employees') }}">Employees</a></li>
                        <li class="breadcrumb-item active">Create Employee</li>
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
      Add New Employees
    </h3>
    <div class="float-right">
            <a href="{{ route('payroll.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Payroll
            </a>
    </div>
    </div>
    <div class="card-body">
        
        <form id="expense-entry" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-group">
                <label for="emp_fname">First Name</label>
                <input type="text" name="emp_fname" class="form-control @error('emp_fname') is-invalid @enderror" id="emp_fname"
                    placeholder="First Name" value="{{ old('emp_fname') }}">
                @error('emp_fname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="emp_lname">Last Name</label>
                <input type="text" name="emp_lname" class="form-control @error('emp_lname') is-invalid @enderror" id="emp_lname"
                    placeholder="Last Name" value="{{ old('emp_lname') }}">
                @error('emp_lname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="emp_gen">Gender</label>
                <select name="emp_gen" class="form-control @error('emp_gen') is-invalid @enderror" id="emp_gen">
                    <option value="Male" {{ old('emp_gen') === 'Male' ? 'selected' : ''}}>Male</option>
                    <option value="Female" {{ old('emp_gen') === 'Female' ? 'selected' : ''}}>Female</option>
                </select>
                @error('emp_gen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="emp_contact">Employee Contact</label>
                <input type="text" name="emp_contact" class="form-control @error('emp_contact') is-invalid @enderror" id="emp_contact"
                    placeholder="Employee Contact" value="{{ old('emp_contact') }}">
                @error('emp_contact')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="emp_address">Employee Address</label>
                <textarea name="emp_address" class="form-control @error('emp_address') is-invalid @enderror"
                    id="emp_address" placeholder="Employee Address">{{ old('emp_address') }}</textarea>
                @error('emp_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="pos_id">Employee Position</label>
                <select name="pos_id" id="pos_id" class="form-control @error('pos_id') is-invalid @enderror">
                    <option value="">--Select Position--</option>
                    @foreach($empsPos as $empsPo)
                    <option value="{{$empsPo->pos_id}}" {{old("pos_id")==$empsPo->pos_id?"selected":""}}>{{$empsPo->pos_name .'('. $empsPo->pos_type.')'}}</option>
                    @endforeach
                </select>
                @error('pos_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="emp_status">Employee Status</label>
                <select name="emp_status" class="form-control @error('emp_status') is-invalid @enderror" id="emp_status">
                    <option value="1" {{ old('emp_status') === 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('emp_status') === 0 ? 'selected' : ''}}>Left</option>
                </select>
                @error('emp_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="joining_date">Employee Joining Date</label>
                <input type="date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date"
                    placeholder="Joining Date" value="{{ old('joining_date',$defaultDate) }}">
                @error('joining_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="hidden" name="leaving_date" class="form-control">
            </div>

            <button class="btn btn-lg btn-primary float-right" type="submit">Create Employee</button>
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