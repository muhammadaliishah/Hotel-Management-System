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
      Inventory System
    </h3>
    </div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('itemcategories.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">Item Categories</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('itemcategories.create')}}">
	        <span class="float-left">Add Item Category</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-purple color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('storeitems.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-barcode "></i>
	            </div>
	            <div class="mr-5">Store Item</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-purple disabled color-palette"  href="{{ route('storeitems.create')}}">
	        <span class="float-left">Add Store Item</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-success color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('vendors.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-users "></i>
	            </div>
	            <div class="mr-5">Vendors</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-success disabled color-palette"  href="{{ route('vendors.create')}}">
	        <span class="float-left">Add Vendor</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-secondary color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('purchaseorders.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-receipt "></i>
	            </div>
	            <div class="mr-5">Purchase Orders</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-secondary disabled color-palette"  href="{{ route('purchaseorders.create') }}">
	        <span class="float-left">Add Purchase Order</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>
<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-blue color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('pobill.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-bank "></i>
	            </div>
	            <div class="mr-5">Bills & Payments</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-blue disabled color-palette"  href="{{ route('pobill.create',null)}}">
	        <span class="float-left">Add Payments</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>
<div class="col-xl-2 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-orange color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('consumeditems.index') }}" style="text-decoration: none;">
	            <div class="card-body-icon float-right text-white">
	                <i class="fa fa-fw fa-server "></i>
	            </div>
	            <div class="mr-5 text-white">Consumed Items</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-orange disabled color-palette"  href="{{ route('consumeditems.create') }}">
	        <span class="float-left">Add Consumed Item</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>


<div class="card">
	<div class="card-header">
		<h3 class="card-title">Storage</h3>
		<div class="float-right">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search Inventory">
                <button type="submit" class="btn btn-danger text-white ml-1">Search</button>
            </form>
    	</div>
	</div>
	<div class="card-body">
		<table class="table table-sm table-striped">
			<thead>
				<tr>
					<th>S.No</th>
					<th>
						Category Name
					</th>
					<th>Item Name</th>
					<th>Barcode</th>
					<th>Item Image</th>
					<th>Received Quantity</th>
					<th>Consumed Quantity</th>
					<th>Total Storage</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $key=>$dataa)
				<tr>
					<td>{{++$key}}</td>
					<td>{{$dataa->catgeoryName}}</td>
					<td>{{$dataa->itemName}}</td>
					<td>{{$dataa->barcode}}</td>
					<td><img class="StoreItem-img" src="{{ Storage::url($dataa->image) }}" alt="" style="height:20px;width: 40px;"></td>
					<td>{{$dataa->TotalStorage}} {{$dataa->unitOfMeasurement}}</td>
					<td>{{$dataa->QuantityConsumed}} {{$dataa->unitOfMeasurement}}</td>
					<td>
						@if(($dataa->TotalStorage-$dataa->QuantityConsumed)<=$dataa->minQuantity)
							<span class="badge badge-danger" style="width: 100%;">{{$dataa->TotalStorage-$dataa->QuantityConsumed}} {{$dataa->unitOfMeasurement}}</span>
						 @elseif((($dataa->TotalStorage-$dataa->QuantityConsumed)> $dataa->minQuantity) && (($dataa->TotalStorage-$dataa->QuantityConsumed)<= $dataa->minQuantity+10))
							<span class="badge badge-warning" style="width: 100%;">{{$dataa->TotalStorage-$dataa->QuantityConsumed}} {{$dataa->unitOfMeasurement}}</span> 
						@else
							<span class="badge badge-success" style="width: 100%;">{{$dataa->TotalStorage-$dataa->QuantityConsumed}} {{$dataa->unitOfMeasurement}}</span>
						@endif
					</td>
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
