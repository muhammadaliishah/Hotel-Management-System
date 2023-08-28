@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Purchase Order Detail Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('purchaseorders.index')}}">Purchase Orders</a></li>
                        <li class="breadcrumb-item active">Detail Report</li>
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
      <i class="fa fa-receipt mr-1"></i>
      Purchase Order And Invoice Details
    </h3>
    <div class="float-right">
            <a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
    </div>
    </div>
    <div class="card-body" style="overflow:auto;">
        <!-- /.card-header -->
        <!-- Widget: user widget style 1 -->
        <div class="row">
            <div class="col-md-4">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header">
                        <h1><span class="badge bg-danger">{{$vendors[0]->orderId}}</span><br>
                        </h1>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ Storage::url($vendors[0]->avatar) }}" alt="User Avatar">
                    </div>
                    <div class="card-body mt-5 text-center" >
                         <div id="po_status"></div>
                         <div id="bill_status" class=""></div>
                    </div>
                    <div class="card-footer pt-2">
                        <div class="description-block">
                            
                                
                                <h1 class="mb-2">{{$vendors[0]->vendorName}}</h1>
                            <ul class="list-group">
                            	<li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Vendor Name</strong>
                                    <span>{{$vendors[0]->vendorName}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><i class="fa fa-envelope"></i></strong>
                                    <span>{{$vendors[0]->email}}</span>
                                    <strong><i class="fa fa-phone"></i></strong>
                                    <span>{{$vendors[0]->phone}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong><i class="fa fa-address-card"></i></strong>
                                    <span>{{$vendors[0]->address}}</span>
                                </li>
                            </ul>
                        </div>
                        <!-- /.description-block -->
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="bg-secondary">
                            <th colspan="3"><h5 class="inf-titles">Purchase Order Information<span class="float-right">Ordered on: {{ \Carbon\Carbon::parse($vendors[0]->orderedDate)->format('d F Y') }}</span></h5></th>
                        </tr>
                        <tr>
                            <th>S. No</th>
                            <th>Ordered Name</th>
                            <th>Ordered Quanity</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($purchaseorders as $key=>$po)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$po->itemName}}</td>
                            <td><span class="po_quan">{{$po->quantity }}</span> {{$po->unitOfMeasurement }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="bg-secondary">
                            <th colspan="3">
                            <h5 class="inf-titles">Received Order & Invoive Information
                                <span class="float-right " id="addinvoice">
                                </span>
                            </h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $inNum=""; $rCount=0;?>
                    @foreach($invoices as $key=>$invoice)
                    @if($invoice->invoiceNumber!=$inNum)
                        <?php $inNum=$invoice->invoiceNumber; $rCount=1?>
                        <tr >
                            <th colspan="3" class="text-center">
                                <h5 class="text-blue">
                                <strong>Invoice Number: </strong> 
                                <span>{{$inNum}}</span>,
                                <strong >Received Date: </strong>
                                <span>{{ \Carbon\Carbon::parse($invoice->receivedDate)->format('d F Y') }}</span>
                                <h5>
                            </th>
                        </tr>
                        <tr>
                            <th>S. No</th>
                            <th>Item Name</th>
                            <th>Received Quantity</th>
                        </tr>
                        @endif
                        <tr>
                            <td>{{$rCount}}</td>
                            <td>{{$invoice->itemName}}</td>
                            <td><span class="ri_quan">{{$invoice->sRQuantity}}</span> {{$invoice->unitOfMeasurement}}</td>
                        </tr>
                        <?php $rCount++;?>
                    @endforeach
                    </tbody>
                </table>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="bg-secondary">
                            <th colspan="5"><h5 class="inf-titles">Bill Payment Information
                                <span class="billpay float-right"></span></h5></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $inCat=""; $invoicCount=0; $totalBillPaid=0;
                            $len=sizeof($bills)-1;
                        ?>
                        @foreach($bills as $knum=>$bill)
                         @if($bill->invoiceNumber!=$inCat)
                        <?php $inCat=$bill->invoiceNumber; $invoicCount=1; $totalBillPaid=0; ?>
                        <tr >
                            <th colspan="3" class="text-center">
                                <h5 class="text-blue">
                                <strong>Invoice Number: </strong> 
                                <span>{{$inCat}}</span>,
                                <strong >Total Bill: </strong>
                                <span>Rs. <span  class="inBillRec">{{$bill->totalBill}}</span></span>
                                <h5>
                            </th>
                        </tr>
                        <tr>
                            <th>S.No</th>
                            <th>Bill Paid</th>
                            <th>Payment Date</th>
                        </tr>
                        @endif
                        <?php $totalBillPaid= $totalBillPaid+$bill->bill_paid;?>
                        <tr>
                            <td>{{$invoicCount}}</td>
                            <td>Rs. {{$bill->bill_paid}}</td>
                            <td>{{ \Carbon\Carbon::parse($bill->payment_date)->format('d F Y') }}</td>
                        </tr>
                     {{-- @if($knum ==$len)  --}}
                     @if($knum<$len)
                     @if($bills[$knum]->invoiceNumber!=$bills[$knum+1]->invoiceNumber)
                        <tr>
                            <td colspan="2"><strong class="float-right">Bill Paid</strong></td>
                            <td>Rs. <span class="inBillPaid">{{$totalBillPaid}}</span></td>
                        </tr> 
                        <tr>
                            <td colspan="2"><strong class="float-right">Bill Due</strong></td>
                            <td>Rs. {{$bill->totalBill-$totalBillPaid}}
                                @if($bill->totalBill-$totalBillPaid>0)
                                    <span class="float-right"><a href="{{ route('pobill.create', $bill->mainRItemId)}}" class="badge badge-danger"><i class="fa fa-plus"></i>  Pay Remaining Bill</a></span>
                                @else
                                    <span class="float-right badge badge-success">Payment Complete</span>
                                @endif
                            </td>
                        </tr> 
                       @endif 
                    @else
                    <tr>
                            <td colspan="2"><strong class="float-right">Bill Paid</strong></td>
                            <td>Rs. <span class="inBillPaid">{{$totalBillPaid}}</span></td>
                    </tr> 
                    <tr>
                            <td colspan="2"><strong class="float-right">Bill Due</strong></td>
                            <td>Rs. {{$bill->totalBill-$totalBillPaid}}
                                @if($bill->totalBill-$totalBillPaid>0)
                                    <span class="float-right"><a href="{{ route('pobill.create', $bill->mainRItemId)}}" class="badge badge-danger"><i class="fa fa-plus"></i>  Pay Remaining Bill</a></span>
                                @else
                                    <span class="float-right badge badge-success">Payment Complete</span>
                                @endif
                            </td>
                    </tr>  
                       @endif
                        <?php $invoicCount++; ?>
                        @endforeach
                    </tbody>
                </table>

                
            </div>
        </div>
        <!-- /.widget-user -->
        <!-- /.col -->
        <!-- /.row -->
        <!-- /.widget-user -->
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
        var pototal = 0;
        var ritotal = 0;
        var inbillrec=0;
        var inbillpaid=0;
        $(".po_quan").each(function(){
            pototal += parseFloat($(this).text()||0);
        });
        $(".ri_quan").each(function(){
            ritotal += parseFloat($(this).text()||0);
        });

        if(pototal==ritotal){
            $('#po_status').html('<h3>Order Status:</h3><div class="progress progress-lg mb-2"><div class="progress-bar progress-bar-striped bg-success" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Order is complete 100%</div></div>');
            $('#addinvoice').html('<span class="float-right badge badge-success">All Items Received</span>');
        }
        else if(pototal>ritotal && ritotal>0){
            $('#po_status').html('<h3>Order Status:<div class="progress progress-lg mb-2"><div class="progress-bar progress-bar-striped bg-warning" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Partial Order 50%</div></div>');
            $('#addinvoice').html('<a href="{{ route('receiveditems.create', ['ven'=>$vendors[0]->orderId,'det'=>1] ) }}" class="btn btn-danger text-white"><i class="fa fa-plus"></i> Add Invoice</a>');
        }
        else{
            $('#po_status').html('<h3>Order Status:</h3><div class="progress progress-lg mb-2"><div class="progress-bar progress-bar-striped bg-danger" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Order Pending 0%</div></div>');
            $('#addinvoice').html('<a href="{{ route('receiveditems.create', ['ven'=>$vendors[0]->orderId,'det'=>1] ) }}" class="btn btn-danger text-white"><i class="fa fa-plus"></i> Add Invoice</a>');
        }

        $(".inBillRec").each(function(){
            inbillrec += parseFloat($(this).text()||0);
        });
        $(".inBillPaid").each(function(){
            inbillpaid += parseFloat($(this).text()||0);
        });
       // alert('Total Bill: '+ inbillrec+ 'Bill Rec: '+inbillpaid);
        if(inbillrec==inbillpaid){
             $('#bill_status').html('<h3>Payment Status</h3><div class="progress progress-lg mb-2"><div class="progress-bar progress-bar-striped bg-success" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Payment is Complete 100%</div></div>');
             $('.billpay').html('<span class="badge badge-success">Payment is Complete</span>');
        }
        else if(inbillrec>inbillpaid && inbillpaid>0){
            $('#bill_status').html('<h3>Payment Status</h3><div class="progress progress-lg mb-2"><div class="progress-bar progress-bar-striped bg-warning" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Partial Payment 50%</div></div>');
            $('.billpay').html('<span class="badge badge-warning">Partial Payment</span>');
        }
        else{
            $('#bill_status').html('<h3>Payment Status</h3><div class="progress progress-lg mb-2"><div class="progress-bar progress-bar-striped bg-danger" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Payment Pending 0%</div></div>');
            $('.billpay').html('<span class="badge badge-danger">No Payment Yet</span>');
        }
    })
</script>
@endsection