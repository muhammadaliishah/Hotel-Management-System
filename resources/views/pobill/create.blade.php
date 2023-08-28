@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Bill Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/pobill') }}">Bill Payements</a></li>
                        <li class="breadcrumb-item active">Add Bill</li>
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
      Add New Bill
    </h3>
    <div class="float-right">
            <a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
    </div>
    </div>
    <div class="card-body">

        <form action="{{ route('pobill.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="invoice_Id"></label>
                <input type="hidden" name="invoice" value="{{$invoiceNumber}}">
                <select name="invoice_Id" id="invoice_Id" class="form-control @error('invoice_Id') is-invalid @enderror">
                    <option value="">--Select Invoice--</option>
                    @foreach($invoices as $invoice)
                    <option value="{{$invoice->mainRItemId}}" {{old("invoice_Id")==$invoice->mainRItemId?"selected":""}}>{{$invoice->invoiceNumber}}</option>
                    @endforeach
                </select>
                @error('invoice_Id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="bill_paid">Amount Paid</label>
                <input type="text" name="bill_paid" class="form-control @error('bill_paid') is-invalid @enderror" id="bill_paid"
                    placeholder="Amount Paid" value="{{ old('bill_paid') }}">
                @error('bill_paid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="bill_details">Payment Description</label>
                <textarea name="bill_details" class="form-control @error('bill_details') is-invalid @enderror"
                    id="bill_details" placeholder="Payment Description">{{ old('bill_details') }}</textarea>
                @error('bill_details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date"
                    placeholder="Payment Date" value="{{ old('payment_date',$defaultDate) }}">
                @error('payment_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button class="btn btn-primary btn-lg float-right text-white" type="submit">Add Payment</button>
        </form>
</div>
</div>
</div>
</div>
</section>
@endsection
@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection