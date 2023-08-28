@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Employee Payroll Mangement</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/employees_payroll') }}">Employee Payroll</a></li>
                        <li class="breadcrumb-item active">Create Employee Payroll</li>
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
      Add New Employee Payroll
    </h3>
    <div class="float-right">
            <a href="{{ route('payroll.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Payroll
            </a>
    </div>
    </div>
    <div class="card-body">
        
        <form id="expense-entry" action="{{ route('employees_payroll.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        	<table class="table table-striped table-bordered" style="width:50%;">
        		<thead>
        			<tr>
        				<th colspan="3" class="bg-secondary text-center">
        					Employee and Salary Month
        				</th>
        			</tr>
        			<tr>
        				<th>Employee</th>
        				<th>Month</th>
        				<th>Year</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr>
        				<td>
                            <input type="hidden" name="loanId" value="0">
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
            			</td>
        				<td>
        					<select name="salary_month" class="form-control @error('salary_month') is-invalid @enderror" id="salary_month">
                    <option value="1" {{ old('salary_month') === 1 ? 'selected' : ''}}>January</option>
                    <option value="2" {{ old('salary_month') === 2 ? 'selected' : ''}}>February</option>
                    <option value="3" {{ old('salary_month') === 3 ? 'selected' : ''}}>March</option>
                    <option value="4" {{ old('salary_month') === 4 ? 'selected' : ''}}>April</option>
                    <option value="5" {{ old('salary_month') === 5 ? 'selected' : ''}}>May</option>
                    <option value="6" {{ old('salary_month') === 6 ? 'selected' : ''}}>June</option>
                    <option value="7" {{ old('salary_month') === 7 ? 'selected' : ''}}>July</option>
                    <option value="8" {{ old('salary_month') === 8 ? 'selected' : ''}}>August</option>
                    <option value="9" {{ old('salary_month') === 9 ? 'selected' : ''}}>September</option>
                    <option value="10" {{ old('salary_month') === 10 ? 'selected' : ''}}>October</option>
                    <option value="11" {{ old('salary_month') === 11 ? 'selected' : ''}}>November</option>
                    <option value="12" {{ old('salary_month') === 12 ? 'selected' : ''}}>December</option>
                </select>
                @error('salary_month')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        				</td>
    					<td>
    						<select name="salary_year" class="form-control @error('salary_year') is-invalid @enderror" id="salary_year">
                    			<option value="{{$currentYear}}" {{ old('salary_year') ===  $currentYear? 'selected' : ''}}>{{$currentYear}}</option>
			                </select>
			                @error('salary_year')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			                @enderror
    					</td>
        			</tr>
        		</tbody>
        	</table>
        	<table class="table table-bordered table-sm">
        		<thead>
        			<tr>
        				<th colspan="5" class="bg-secondary text-center">
        					Employee Monthly Salary Calculations
        				</th>
        			</tr>
        		</thead>
        		<tbody>
        			<tr style="background: #0000000D;">
        				<td>1.</td>
        				<td><span class="float-right">Number of days worked</span></td>
        				<td>
        					<input type="text" name="days_worked" class="form-control @error('days_worked') is-invalid @enderror" id="days_worked"
                   				 placeholder="Number of days worked" value="{{ old('days_worked',0) }}">
			                @error('days_worked')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			                @enderror
            			</td>
        				<td><span class="float-right">Monthly Salary (Rs)</span></td>
        				<td><input type="text" name="mn_salary" id="mn_salary" class="form-control input-number" value="{{ old('mn_salary',0) }}" readonly></td>
        			</tr>
        			<tr style="background: #0000000D;">
        				<td>2</td>
        				<td><span class="float-right">Number of overtime hours worked</span></td>
        				<td><input type="text" name="overtime_hrs_worked" class="form-control @error('overtime_hrs_worked') is-invalid @enderror" id="overtime_hrs_worked"
                    placeholder="Number of overtime hours worked" value="{{ old('overtime_hrs_worked',0) }}">
                @error('overtime_hrs_worked')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        				<td><span class="float-right">Overtime hours fare amount (Rs)</span></td>
        				<td><input type="text" name="overtime_hrs_fare" class="form-control input-number addition @error('overtime_hrs_fare') is-invalid @enderror" id="overtime_hrs_fare "
                    placeholder="Overtime hours fare amount(Rs)" value="{{ old('overtime_hrs_fare',0) }}">
                @error('overtime_hrs_fare')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        			</tr>
        			<tr style="background: #0000000D;">
        				<td>3</td>
        				<td><span class="float-right">Number of hours late</span></td>
        				<td><input type="text" name="hours_late" class="form-control @error('hours_late') is-invalid @enderror" id="hours_late"
                    placeholder="Number of hours late" value="{{ old('hours_late',0) }}">
                @error('hours_late')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        				<td><span class="float-right">Late hours amount deduction (Rs)</span></td>
        				<td><input type="text" name="hours_late_deduction" class="form-control input-number subtraction @error('hours_late_deduction') is-invalid @enderror" id="hours_late_deduction"
                    placeholder="Late hours amount deduction(Rs)" value="{{ old('hours_late_deduction',0) }}">
                @error('hours_late_deduction')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        			</tr>
        			<tr style="background: #0000000D;">
        				<td>4</td>
        				<td><span class="float-right">Number of days absent</span></td>
        				<td><input type="text" name="days_absent" class="form-control @error('days_absent') is-invalid @enderror" id="days_absent"
                    placeholder="Number of days absent" value="{{ old('days_absent',0) }}">
                @error('days_absent')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        				<td><span class="float-right">Absent days amount deduction (Rs)</span></td>
        				<td><input type="text" name="days_absent_deduction" class="form-control input-number subtraction @error('days_absent_deduction') is-invalid @enderror" id="days_absent_deduction"
                    placeholder="Absent days amount deduction" value="{{ old('days_absent_deduction',0) }}">
                @error('days_absent_deduction')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        			</tr>
        			<tr style="background: #0000000D;">
        				<td>5</td>
        				<td><span class="float-right">Bonus description</span></td>
        				<td><textarea type="text" name="bonus_description" class="form-control @error('bonus_description') is-invalid @enderror" id="bonus_description"
                    placeholder="Bonus description" >{{ old('bonus_description','none') }}</textarea>
                @error('bonus_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        				<td><span class="float-right">Bonus amount if any (Rs)</span></td>
        				<td><input type="text" name="bonus_amount" class="form-control input-number addition  @error('bonus_amount') is-invalid @enderror" id="bonus_amount"
                    placeholder="Bonus amount (if any)" value="{{ old('bonus_amount',0) }}">
                @error('bonus_amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        			</tr>
        			<tr style="background: #0000000D;">
        				<td>6</td>
        				<td><span class="float-right">Loan Dues Rs.</span></td>
        				<td><input name="loan_dues" id="loan_dues" type="text" class="form-control" value="{{ old('loan_dues',0) }}" readonly></td>
        				<td><span class="float-right">Loan deduction amount (Rs)</span></td>
        				<td><input type="text" name="loan_deduction" class="form-control input-number subtraction  @error('loan_deduction') is-invalid @enderror" id="loan_deduction"
                    placeholder="Loan deduction amount" value="{{ old('loan_deduction',0) }}">
                @error('loan_deduction')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</td>
        			</tr>
        			<tr style="background:#e9ecef;">
        				<th colspan="4"><strong class="float-right">Estimated monthly salary (Rs)</strong></th>
        				<th><input type="text" name="estimated_month_salary" class="form-control @error('estimated_month_salary') is-invalid @enderror" id="estimated_month_salary"
                    placeholder="Estimated monthly salary" value="{{ old('estimated_month_salary',0) }}" readonly>
                @error('estimated_month_salary')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror</th>
        			</tr>
        		</tbody>
        	</table>

            <button class="btn btn-lg btn-primary float-right text-white" type="submit">Add Monthly Salary</button>
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
<script type="text/javascript">
$(document).on('change', '#emp_Id', function() {
  var emp = $(this).val();

  // Make the AJAX call
  // Retrieve the CSRF token value from the meta tag
var csrfToken = $('meta[name="csrf-token"]').attr('content');
if (csrfToken){
  $.ajax({
    url: '{{ route('employees_payroll.getEmpDetails') }}', // Replace with the actual route to your Laravel controller/action
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    data: { value: emp },
    success: function(response) {
    	//alert();
    	$('#mn_salary').val(response['result']['monSalary']);
    	$('#loan_dues').val(response['result']['totalLoan']);
    	$('#estimated_month_salary').val(response['result']['monSalary']);
    },
        error: function (xhr, status, error) {
        // Handle the error response
        console.log(xhr.responseText);
    }

  });
}
else{
    console.log('CSRF token not found');
}
});
$(document).ready(function() {
    // $("#expense-entry").on("input", ".input-number", function() {
    //     alert('asdas');
    $('.input-number').on('keyup', function() {
	//alert('asdd');
    var sum = parseFloat($('#mn_salary').val());
    $('.input-number').each(function() {
      var value = parseFloat($(this).val());
      if (!isNaN(value)) {
        if ($(this).hasClass('addition')) {
          sum += value;
        } else if ($(this).hasClass('subtraction')) {
          sum -= value;
        }
      }
    });
    $('#estimated_month_salary').val(sum);
  });
});

</script>
@endsection