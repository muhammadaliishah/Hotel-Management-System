@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Salary Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/employee_salaries') }}">Salaries</a></li>
                        <li class="breadcrumb-item active">Create Salary</li>
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
      Add New Salary
    </h3>
    <div class="float-right">
            <a href="{{ route('payroll.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Payroll
            </a>
    </div>
    </div>
    <div class="card-body">
        
        <form id="expense-entry" action="{{ route('employee_salaries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-group">
                <label for="emp_Id">Employee</label>
                <select name="emp_Id" id="emp_Id" class="form-control @error('emp_Id') is-invalid @enderror">
                    <option value="">--Select Employee--</option>
                    @foreach($emp as $em)
                    <option value="{{$em->emp_Id}}" {{old("emp_Id")==$em->emp_Id?"selected":""}}>{{$em->emp_fname.' '.$em->emp_lname.'('. $em->pos_name.')'}}</option>
                    @endforeach
                </select>
                @error('emp_Id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="monthly_salary">Employee Salary Amount</label>
                <input type="text" name="monthly_salary" class="form-control @error('monthly_salary') is-invalid @enderror" id="monthly_salary"
                    placeholder="Employee Salary Amount" value="{{ old('monthly_salary') }}">
                @error('monthly_salary')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="salary_status">Salary Status</label>
                <select name="salary_status" class="form-control @error('salary_status') is-invalid @enderror" id="salary_status">
                    <option value="1" {{ old('salary_status') == 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('salary_status') == 0 ? 'selected' : ''}}>Inactive</option>
                </select>
                @error('salary_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-lg btn-primary float-right text-white" type="submit">Create Salary</button>
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