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
                        <li class="breadcrumb-item active">Employee Loan Details</li>
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
      Employee Loan Details
    </h3>
    <div class="float-right">
            <a href="{{ route('payroll.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Payroll
            </a>
            {{-- <a class="btn btn-danger"  href="{{ route('employee_transactions.create')}}"><i class="fa fa-plus text-white"></i></a> --}}
    </div>
            </div>
    <div class="card-body" style="overflow:auto;">
        <div class="float-right mt-2 mb-3">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search Loans">
                <button type="submit" class="btn btn-primary ml-1">Search</button>
            </form>
        </div>
        <table class="table table-sm table-striped" >
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Employee Name</th>
                    <th>Employee Position</th>
                    <th>Amount Type</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $Key=> $empLoan)
                {{-- {{$i++}} --}}
                <tr>
                    <th>{{++$Key}}</th>
                    <td>{{$empLoan->emp_fname.' '.$empLoan->emp_lname}}</td>
                    <td>{{$empLoan->pos_name}}</td>
                    <td>{{$empLoan->payment_nature}}</td>
                    <td>
                    	@if($empLoan->payment_nature=='Addition')
                    	<span class="right badge badge-danger">
                    		Rs. {{$empLoan->transaction_amount}}
                    	</span>
                    	@else
                    	<span class="right badge badge-success">
                    		Rs. {{$empLoan->transaction_amount}}
                    	</span>
                    	@endif
                    </td>
                    <td>
                    	@if($empLoan->payment_nature!='Deduction')
                    	<a href="{{ route('employee_transactions.edit', $empLoan->loanId) }}" class="btn btn-info"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('employee_transactions.destroy', $empLoan->loanId  )}}"><i
                                class="fas fa-trash"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->render() }}
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
                text: "Do you really want to delete this Loan Transaction?",
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
