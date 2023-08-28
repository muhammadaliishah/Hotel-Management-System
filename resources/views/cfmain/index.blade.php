@section('cs')

@endsection
@extends('layouts.master')
@section('content')
{{-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Point of Sale</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Point of Sale</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
</section> --}}
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
      Cash Flow Management
    </h3>
    </div>
</div>
<div class="col-xl-6 col-sm-6 mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('cashflowcategories.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">Expense Categories</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('cashflowcategories.create')}}">
	        <span class="float-left">Add Expense Category</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-6 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-purple color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('cashflow.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-barcode "></i>
	            </div>
	            <div class="mr-5">Non Inventory Expenses</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-purple disabled color-palette"  href="{{ route('cashflow.create')}}">
	        <span class="float-left">Add Expenses</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h3 class="card-title">Cash Flow and Expense Report</h3>
		<div class="float-right">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search Cash">
                <button type="submit" class="btn btn-danger text-white ml-1">Search Cash Flow</button>
            </form>
    	</div>
	</div>
	<div class="card-body">
		<table class="table table-sm table-striped">
			<thead>
				<tr>
					<th>S.No</th>
					<th>
						POS Income
					</th>
					<th>Inventory Expenses</th>
					<th>Other Exepnses</th>
					<th>Total Profit</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<td>1</td>
				<td>
					{{$result['pos']}}
				</td>
				<td>
					{{$result['inventory']}}
				</td>
				<td>
					{{$result['extraExpense']}}
				</td>
				<td>{{$result['pos']-($result['inventory']+$result['extraExpense'])}}</td>
				<td>{{Carbon\Carbon::now()->format('d F Y')}}</td>
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
