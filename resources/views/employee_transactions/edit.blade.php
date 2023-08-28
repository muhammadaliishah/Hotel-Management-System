@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Employee Loans Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/employee_transactions') }}">Employee Loans</a></li>
                        <li class="breadcrumb-item active">Edit Loan</li>
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
      Edit Loan
    </h3>
    <div class="float-right">
            <a href="{{ route('payroll.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Payroll
            </a>
    </div>
    </div>
    <div class="card-body">
        
        <form id="expense-entry" action="{{ route('employee_transactions.update',$emp_transaction->loanId) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="emp_Id">Employee</label>
                <select name="emp_Id" id="emp_Id" class="form-control @error('emp_Id') is-invalid @enderror">
                    <option value="">--Select Employee--</option>
                    @foreach($emp as $em)
                    <option value="{{$em->emp_Id}}" {{old("emp_Id",$emp_transaction->emp_Id)==$em->emp_Id?"selected":""}}>{{$em->emp_fname.' '.$em->emp_lname.'('. $em->pos_name.')'}}</option>
                    @endforeach
                </select>
                @error('emp_Id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="transaction_amount">Loan Paid or Received</label>
                <input type="text" name="transaction_amount" class="form-control @error('transaction_amount') is-invalid @enderror" id="transaction_amount"
                    placeholder="Employee Salary Amount" value="{{ old('transaction_amount',$emp_transaction->transaction_amount) }}">
                @error('transaction_amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="transaction_date">Loan Paid or Received Date</label>
                <input type="date" name="transaction_date" class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date"
                    placeholder="Employee Salary Amount" value="{{ old('transaction_date',$emp_transaction->transaction_date) }}">
                @error('transaction_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-lg btn-primary float-right text-white" type="submit">Update Loan</button>
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