@section('cs')
<style>
.spreadSheetGroup{
    /*font:0.75em/1.5 sans-serif;
    font-size:14px;
  */
    color:#333;
    background-color:#fff;
    padding:1em;
}

/* Tables */
.spreadSheetGroup table{
    width:100%;
    margin-bottom:1em;
    border-collapse: collapse;
}
.spreadSheetGroup .proposedWork th{
    background-color:#eee;
}
.tableBorder th{
  background-color:#eee;
}
.spreadSheetGroup th,
.spreadSheetGroup tbody td{
    padding:0.5em;

}
.spreadSheetGroup tfoot td{
    padding:0.5em;

}
.spreadSheetGroup td:focus { 
  border:1px solid #fff;
  -webkit-box-shadow:inset 0px 0px 0px 2px #5292F7;
  -moz-box-shadow:inset 0px 0px 0px 2px #5292F7;
  box-shadow:inset 0px 0px 0px 2px #5292F7;
  outline: none;
}
.spreadSheetGroup .spreadSheetTitle{ 
  font-weight: bold;
}
.spreadSheetGroup tr td{
  text-align:center;
}
/*
.spreadSheetGroup tr td:nth-child(2){
  text-align:left;
  width:100%;
}
*/

/*
.documentArea.active tr td.calculation{
  background-color:#fafafa;
  text-align:right;
  cursor: not-allowed;
}
*/
.spreadSheetGroup .calculation::before, .spreadSheetGroup .groupTotal::before{
  /*content: "$";*/
}
.spreadSheetGroup .trAdd{
  background-color: #007bff !important;
  color:#fff;
  font-weight:800;
  cursor: pointer;
}
.spreadSheetGroup .tdDelete{
  background-color: #eee;
  color:#888;
  font-weight:800;
  cursor: pointer;
}
.spreadSheetGroup .tdDelete:hover{
  background-color: #df5640;
  color:#fff;
  border-color: #ce3118;
}
.documentControls{
  text-align:right;
}
.spreadSheetTitle span{
  padding-right:10px;
}

.spreadSheetTitle a{
  font-weight: normal;
  padding: 0 12px;
}
.spreadSheetTitle a:hover, .spreadSheetTitle a:focus, .spreadSheetTitle a:active{
  text-decoration:none;
}
.spreadSheetGroup .groupTotal{
  text-align:right;
}



table.style1 tr td:first-child{
  font-weight:bold;
  white-space:nowrap;
  text-align:right;
}
table.style1 tr td:last-child{
  border-bottom:1px solid #000;
}



table.proposedWork td,
table.proposedWork th,
table.exclusions td,
table.exclusions th{
  border:1px solid #000;
}
table.proposedWork thead th, table.exclusions thead th{
  font-weight:bold;
}
table.proposedWork td,
table.proposedWork th:first-child,
table.exclusions th, table.exclusions td{
  text-align:left;
  vertical-align:top;
}
table.proposedWork td.description{
  width:80%;
}

table.proposedWork td.amountColumn, table.proposedWork th.amountColumn,
table.proposedWork td:last-child, table.proposedWork th:last-child{
  text-align:center;
  vertical-align:top;
  white-space:nowrap;
}

.amount:before, .total:before{
  content: "$";
}
table.proposedWork tfoot td:first-child{
  border:none;
  text-align:right;
}
table.proposedWork tfoot tr:last-child td{
  font-size:16px;
  font-weight:bold;
}

table.style1 tr td:last-child{
  width:100%;
}
table.style1 td:last-child{
  text-align:left;
}
td.tdDelete{
  width:1%;
}

table.coResponse td{text-align:left}
table.shipToFrom td, table.shipToFrom th{text-align:left}

.docEdit{border:0 !important}

.tableBorder td, .tableBorder th{
  border:1px solid #000;
}
.tableBorder th, .tableBorder td{text-align:center}

table.proposedWork td, table.proposedWork th{text-align:center}
table.proposedWork td.description{text-align:left}
</style>
@endsection
@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Invoice and Received Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Invoice and Received Orders</li>
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
      Invoice and Received Orders
    </h3>
    <a class="float-right btn-primary mb-2 p-2"  href="">Create Invoice</a>
    </div>
    <div class="card-body">
    	
    	<form action="{{ route('receiveditems.store') }}" method="POST" >
        @csrf
   
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    		<div class="document active">
    		<table class="table table-bordered table-striped" style="width:50%">
    			<thead class="bg-secondary">
    			<tr>
    				<th>To</th>
    				<th>Order ID</th>
            <th>Ordered Date</th>
    			</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td>
    						@foreach($data as $Key=>$dat)
    						{{$dat->vendorId}}
    						@endforeach
    					</td>
    						{{-- {{$data[0]['first_name']}} </td> --}}
    						{{-- <input type="hidden" name="vendorId" value="{{$data[0]->vendorId}}" class="form-control" readonly >
 	   					</td>
 	   					<td><input type="text" name="orderId" value="{{$data[0]->orderId}}" class="form-control" readonly ></td>
              			<td>
              				<input type="date" name="orderedDate" class="form-control" value="{{$data[0]->orderedDate}}" readonly>
              			</td> --}}
    				</tr>
    			</tbody>
    		</table>
    		{{-- <table class="table table-striped table-sm"  id="dynamicTable">
    			<thead class="bg-secondary">
    			<tr>
    				<th>S.No</th>
    				<th>Item Name</th>
    				<th>Quantity</th>
    				<th>Description</th>
    				<th class="trAdd" id="trAdd"><span><i class="fa fa-check-circle text-success"></i></span></th>
    			</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td>1</td>
    					<td>
                <select name="addmore[0][itemId]"  class="form-control">
                    <option value="">--Select Item--</option>
                    @foreach($items as $item)
                    <option value="{{$item->itemId }}">{{$item->itemName}}</option>
                    @endforeach
                </select>
 	   					</td>
 	   					<td>
 	   						<input type="text" name="addmore[0][quantity]" class="form-control" placeholder="Enter your Qty">
 	   					</td>
 	   					<td>
 	   						<input type="text" name="addmore[0][description]" id="description" class="form-control" placeholder="Enter Description">
 	   					</td>
 	   					
 	   					<td class="tdDelete">
 	   						<span><i class="fa fa-times-circle text-danger"></i></span>
 	   					</td>
    				</tr>
    				</tbody>
    				
    		</table> --}}
    		</div>
    		<button class="btn btn-primary text-white" type="submit" style="float:right">Submit Purchase Order</button>
    	</form>

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
    
@endsection
