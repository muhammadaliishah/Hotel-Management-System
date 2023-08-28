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
                        <li class="breadcrumb-item active">Employee Payroll</li>
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
      Employee Payroll Mangement
    </h3>
    <div class="float-right">
            <a href="{{ route('payroll.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Payroll
            </a>
            <a class="btn btn-danger"  href="{{ route('employees_payroll.create')}}"><i class="fa fa-plus text-white"></i></a>
    </div>
            </div>
    <div class="card-body" style="overflow:auto;">
        <div class="float-right mt-2 mb-3">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search Payroll">
                <button type="submit" class="btn btn-primary ml-1">Search</button>
            </form>
        </div>
        <table class="table table-sm table-striped" >
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Full Name</th>
                    <th>Position</th>
                    <th>Salary Month</th>
                    <th>Calculated Salary</th>
                    <th>Days Worked</th>
                    <th>Overtime Hours</th>
                    <th>Overtime Hours Fare</th>
                    <th>Late Hours</th>
                    <th>Late Hours Deduction</th>
                    <th>Absent Days</th>
                    <th>Absent Days Deduction</th>
                    <th>Bonus Details</th>
                    <th>Bonus Amount</th>
                    <th>Loan Deduction</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $Key=> $payroll)
                {{-- {{$i++}} --}}
                <tr>
                    <th>{{++$Key}}</th>
                    <td>{{$payroll->emp_fname}} {{$payroll->emp_lname}}</td>
                    <td>{{$payroll->pos_name}} {{$payroll->pos_type}}</td>
                    <td>{{ \Carbon\Carbon::parse($payroll->salary_year.'-'.$payroll->salary_month.'-01')->format('F Y') }}</td>
                    <td>
                        <span class="right badge badge-success">
                            Rs. {{$payroll->estimated_month_salary}}
                        </span>
                    </td>
                    <td>{{$payroll->days_worked}}</td>
                    <td>{{$payroll->overtime_hrs_worked}}</td>
                    <td>Rs. {{$payroll->overtime_hrs_fare}}</td>
                    <td>{{$payroll->hours_late}}</td>
                    <td>Rs. {{$payroll->hours_late_deduction}}</td>
                    <td>{{$payroll->days_absent}}</td>
                    <td>Rs. {{$payroll->days_absent_deduction}}</td>
                    <td>{{$payroll->bonus_description}}</td>
                    <td>Rs. {{$payroll->bonus_amount}}</td>
                    <td>Rs. {{$payroll->loan_deduction}}</td>
                    <td>
                        <a href="{{ route('employees_payroll.edit', $payroll->payroll_Id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('employees_payroll.destroy', $payroll->payroll_Id)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       <div class="float-right mt-2"> 
        {{ $data->render('pagination::bootstrap-4') }}
    </div> 
    </div>
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
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-delete', function () {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this Employee Payroll?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                        $this.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection
