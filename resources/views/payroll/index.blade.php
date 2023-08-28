@section('cs')

@endsection
@extends('layouts.master')
@section('content')
<section class="content">
<div class="row">
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<div class="col-md-12">
    <div class="card-header bg-info mb-3 p-3">
        <h3 class="card-title">
      <i class="fa fa-users mr-1"></i>
     	Payroll Management
    </h3>
    </div>
</div>
<div class="col-xl-1">
</div>
<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('employees.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">Employees</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('employees.create')}}">
	        <span class="float-left">Add Employee</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-purple color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('employee_positions.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-barcode "></i>
	            </div>
	            <div class="mr-5">Positions</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-purple disabled color-palette"  href="{{ route('employee_positions.create')}}">
	        <span class="float-left">Add Position</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-success color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('employee_salaries.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-wallet "></i>
	            </div>
	            <div class="mr-5">Salaries</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-success disabled color-palette"  href="{{ route('employee_salaries.create')}}">
	        <span class="float-left">Add Salaray</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-yellow color-palette " style="font-size: 20px;">
	    	<a  href="{{ route('employee_transactions.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon text-white float-right">
	                <i class="fa fa-fw fa-money-check "></i>
	            </div>
	            <div class="mr-5 text-white">Loans</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-yellow disabled color-palette"  href="{{ route('employee_transactions.create')}}">
	        <span class="float-left">Add advance/Loans</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-secondary color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('employees_payroll.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-users "></i>
	            </div>
	            <div class="mr-5">Employee Payroll</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-secondary disabled color-palette"  href="{{ route('employees_payroll.create')}}">
	        <span class="float-left">Add Payroll</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>
<div class="col-xl-1">
</div>

<div class="card">
	<div class="card-header">
		<h3 class="card-title">Employee Payroll Report</h3>
		<div class="float-right">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search Payroll">
                <button type="submit" class="btn btn-danger text-white ml-1">Search</button>
            </form>
    	</div>
	</div>
	<div class="card-body">
		<table class="table table-sm table-striped">
			<thead>
			<tr>
				<th>S.No</th>
				<th>Name</th>
				<th>Position</th>
				<th>Job Status</th>
				<th>From - To</th>
				<th>Contact</th>
				<th>Salary</th>
				<th>Total Loan</th>
				<th>Loan Returned</th>
				<th>Loan Remaining</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data as $Key=>$em)
			<tr>
				<td>{{$Key+1}}</td>
				<td>{{$em->emp_fname}} {{$em->emp_lname}}</td>
				<td>{{$em->positionName}}</td>
				<td><span class="right badge badge-{{ $em->emp_status ? 'success' : 'danger' }}">{{$em->emp_status ? 'Active' : 'Left'}}
                    </span>
                </td>
				<td>
					@if($em->emp_status==0)
					{{ \Carbon\Carbon::parse($em->joining_date)->format('d F Y').' to '.\Carbon\Carbon::parse($em->leaving_date)->format('d F Y') }}
					@else
					{{ \Carbon\Carbon::parse($em->joining_date)->format('d F Y').' to Currently Working'}}
					@endif
				</td>
				<td>{{$em->emp_contact}}</td>
				<td>{{$em->monthlySalary}}</td>
				<td><span class="right badge badge-danger">Rs. {{$em->loan_taken}}</span></td>
				<td><span class="right badge badge-success">Rs. {{-$em->loan_returned}}</span></td>
				<td><span class="right badge badge-warning">Rs. {{$em->loan_taken+$em->loan_returned}}</span></td>
			</tr>
			@endforeach
			</tbody>
		</table>
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
