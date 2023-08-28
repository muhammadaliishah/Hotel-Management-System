@section('cs')
<style>
  thead {border: 2px solid red !important;}
   thead th {border: 1px solid red !important;}
</style>
@endsection
@extends('layouts.master')
@section('content')
<section class="content">
<div class="row">
  <div class="col-md-12 mt-3">
  <p class="float-right ">
<a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
    <a href="" class="btn btn-success text-white" onclick="printableDiv('printableArea')">
    <i class="fa fa-print"></i> Print Purchase Order</a></p>
</div>
<div class="col-md-12">
    <div class="card" id="printableArea">
        <div class="card-header bg-black">
	        <h3 class="card-title">
	        	<img src="{{ asset('home/frontend/home/images/logo.png')}}" alt="Sivana" >
			</h3>
			<p class="float-right mb-2 p-2"><strong>Sivana Restaurant</strong><br>Food Street Chinarbagh Gilgit Pakistan<br>Phone: 00000-0000000
			<br>Email: info@sivana.com</p>
    	</div>
    <div class="card-body">
    		<div class="document active">
          <h4><strong>To:</strong> {{$data[0]->first_name}} {{$data[0]->last_name}}</h4>
          <h4><strong>Order ID:</strong> {{$data[0]->orderId}}</h4>
          <h4><strong>Ordered Date:</strong> {{ \Carbon\Carbon::parse($data[0]->orderedDate)->format('d F Y') }}</h4>
    		<table class="table"  id="dynamicTable">
    			<thead class="bg-secondary text-black">
    			<tr>
    				<th>S.No</th>
    				<th>Item Name</th>
    				<th>Quantity</th>
    				<th>Description</th>
    			</tr>
    			</thead>
    			<tbody>
    				@foreach ($data as $Key=> $storeitem)
                <tr>
                    <td>{{++$Key}}</td>
                    <td>{{$storeitem->itemName}}</td>
                    <td>{{$storeitem->quantity}}</td>
                    <td>{{$storeitem->description}}</td>
                </tr>
                @endforeach
				</tbody>
    		</table>
    		</div>
        <div class="float-right">
          <h4><strong>Issued By:</strong>   _______________</h4>
          <h4><strong>Designation:</strong> _______________</h4>
          <h4><strong>Signature:</strong>  _______________</h4>
        </div>
        
    </div>
    <div class="card-footer">
      
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
</script>
<script type="text/javascript">
  function printableDiv(printableAreaDivId) {
     var printContents = document.getElementById(printableAreaDivId).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection
