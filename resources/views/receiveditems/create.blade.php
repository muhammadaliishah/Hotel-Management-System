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
  ;
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
    <div class="float-right">
            <a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
    </div>
    </div>
    <div class="card-body">
    	
    	<form id="order-entry" action="{{ route('receiveditems.store') }}" method="POST" enctype="multipart/form-data">
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
    				<th>From</th>
    				<th>Order ID</th>
            <th>Ordered Date</th>
    			</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td>
    						{{$data[0]->vendorName}}
                <input type="hidden" name="orderId" value="{{$data[0]->orderId}}">
    					</td>
    					<td>
    						<input type="hidden" name="poMainId" value="{{$data[0]->poMainId}}">
                <input type="hidden" name="det" value="{{$det}}">
    						{{$data[0]->orderId}} 
    					</td>
    					<td>
    						{{ \Carbon\Carbon::parse($data[0]->orderedDate)->format('d F Y') }}
    					</td>
    				</tr>
    			</tbody>
    		</table>
        <table class="table table-bordered table-striped" style="width:50%">
          <thead class="bg-secondary">
          <tr>
            <th>Invoice Number</th>
            <th>Upload Invoice</th>
          </tr>
          </thead>
          <tbody>
              <tr>
                <td>
                  <input type="text" name='invoiceNumber' class="form-control" value="{{ old('invoiceNumber') }}">
                @error('invoiceNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
                <td>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="invoiceImage" value="{{ old('invoiceImage') }}">
                    <label class="custom-file-label" for="invoiceImage">Choose file</label>
                </div>
                
                  </div>
                </td>
              </tr>
          </tbody>
          <thead class="bg-secondary">
          <tr>
            <th>Delivery Status</th>
            <th>Received Date</th>
          </tr>
          </thead>
          <tbody>
              <tr>
                <td>
                  <select name="deliveryStatus" class="form-control @error('deliveryStatus') is-invalid @enderror" id="status" >
                    <option value="1" {{ old('deliveryStatus') == 1 ? 'selected' : ''}}>Complete</option>
                    <option value="0" {{ old('deliveryStatus') == 0 ? 'selected' : ''}}>Partial</option>
                </select>
                @error('deliveryStatus')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </td>
                <td>
                  <input type="date" name='receivedDate' class="form-control" value="{{ old('receivedDate',$defaultDate) }}">
                @error('receivedDate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
              </tr>
          </tbody>
        </table>
    		 <table class="table table-sm"  id="dynamicTable">
    			<thead class="bg-secondary">
    			<tr>
    				<th>S.No</th>
    				<th>Item Name</th>
    				<th>Complete/Partial Ordered Quantity</th>
    				<th>Complete/Partial Received Quantity</th>
    				<th>Price</th>
    				<th>Total</th>
    			</tr>
    			</thead>
    			<tbody>
					@foreach($data as $key=>$item)
					<tr>
						<td>{{$key}}</td>
						<td>
              <input type="hidden" name="addMore[{{$key}}][sRItemId]" value="{{$item->itemId}}">
              <input type="hidden" name="addMore[{{$key}}][poSubItemId]" value="{{$item->poItemId}}">
              {{$item->itemName}}
            </td>
						<td><input type="hidden" name="addMore[{{$key}}][poQuan]" value="{{$item->quantity-$item->ReceivedQuan}}">{{$item->quantity-$item->ReceivedQuan}}</td>
						<td><input class="form-control form-calc form-qty" name='addMore[{{$key}}][sRQuantity]' value="{{old('addMore.'.$key.'.sRQuantity')}}"></td>
						<td><input class="form-control form-calc form-cost" name='addMore[{{$key}}][sRPrice]' value="{{old('addMore.'.$key.'.sRPrice')}}"></td>
						<td><input class="form-control form-line" readonly value="0"></td>
					</tr>
					@endforeach
				</tbody>
    				<tfoot>
        <tr>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
        <td style="text-align:right"><label>SUB TOTAL: </label></td>
        <td class="amount subtotal" id="subtotal">0.00</td>
        <td class="docEdit"></td>
        </tr>
        <tr>
          <td style=""></td>
          <td style=""></td>
          <td style=""></td>
          <td ></td>
        <td style=";text-align:right"><label>SALES TAX:</label></td>
        <td class="amount" contenteditable="true">0.00</td>
        <td class="docEdit"></td>
        </tr>
        <tr>
          <td style=""></td>
          <td style=""></td>
          <td style=""></td>
          <td ></td>
        <td style=";text-align:right;white-space:nowrap"><label>SHIPPING & HANDLING:</label></td>
        <td class="amount" contenteditable="true">0.00</td>
        <td class="docEdit"></td>
        </tr>
        <tr>
          <td style=""></td>
          <td style=""></td>
          <td style=""></td>
          <td ></td>
        <td style=";text-align:right"><label>TOTAL BILL:</label></td>
        <td class="total amount" contenteditable="true"" id="total">0.00
        </td>
        <td class="docEdit"></td>
        </tr>

        <tr>
          <td style=""></td>
          <td style=""></td>
          <td style=""></td>
          <td ></td>
        <td style=";text-align:right"><label>BILL PAID:</label></td>
        <td class="bill" contenteditable="true"" id="bill">
          <input type="hidden" class="form-control" name="totbill" id="totbill">
          <input type="text" name='bill_paid' class="form-control" value="{{ old('bill_paid') }}">
                @error('bill_paid')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
        </td>
        <tr>
          <td style=""></td>
          <td style=""></td>
          <td style=""></td>
          <td ></td>
        <td style=";text-align:right"><label>BILL PAID DATE:</label></td>
        <td class="bill" contenteditable="true" id="bill">
          <input type="date" name='bill_paid_date' class="form-control" value="{{ old('bill_paid_date',$defaultDate) }}">
                @error('bill_paid_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
        </td>
        <td></td>
        </tr>
        
      </tfoot>
    		</table> 
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
<script type="text/javascript">
  $(document).ready(function() {
    $("#order-entry").on("keyup", ".form-calc", function() {
        var parent = $(this).closest("tr");
         parent.find(".form-line").val((parent.find(".form-qty").val() * parent.find(".form-cost").val()).toFixed(2));
        // var bb=parent.find(".form-qty").val();
        // alert(bb);

        var total = 0;
        $(".form-line").each(function(){
            total += parseFloat($(this).val()||0);
        });
        $("#subtotal").text(total.toFixed(2));
        $("#total").text(total.toFixed(2));
        $("#totbill").val(total.toFixed(2));
    });
        $('.form-calc').each(function() {
          var parent = $(this).closest("tr");
         parent.find(".form-line").val((parent.find(".form-qty").val() * parent.find(".form-cost").val()).toFixed(2));
        // var bb=parent.find(".form-qty").val();
        // alert(bb);

        var total = 0;
        $(".form-line").each(function(){
            total += parseFloat($(this).val()||0);
        });
        $("#subtotal").text(total.toFixed(2));
        $("#total").text(total.toFixed(2));
        $("#totbill").val(total.toFixed(2));
      });
});

function addCommas(n){
    var s=n.split('.')[1];
    (s) ? s="."+s : s="";
    n=n.split('.')[0]
    while(n.length>3){
        s=","+n.substr(n.length-3,3)+s;
        n=n.substr(0,n.length-3)
    }
    return n+s
}
</script>
@endsection
