@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Purchase Orders And Invoices</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Purchase Orders And Invoices</li>
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
      Purchase Order And Invoice Management
    </h3>
    <div class="float-right">
            <a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
            <a class="btn btn-danger"  href="{{ route('purchaseorders.create')}}"><i class="fa fa-plus text-white"></i></a>
    </div>
        </div>
    <div class="card-body" style="overflow:auto;">
        <div class="float-right mt-2 mb-3">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search Purchase Orders">
                <button type="submit" class="btn btn-primary ml-1">Search</button>
            </form>
        </div>
        <table class="table table-sm table-striped table-bordered" >
            <thead >
                <tr >
                    <th>S. No</th>
                    <th>Order/Reference ID</th>
                    <th>Vendor</th>
                    <th>Ordered On</th>
                    <th>Invoice & Order Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $Key=> $storeitem)
                <tr>
                    <td>{{++$Key}}</td>
                    <td>{{$storeitem->orderId}}</td>
                    <td>{{$storeitem->vendorName}}</td>
                    <td>{{ \Carbon\Carbon::parse($storeitem->orderedDate)->format('d F Y') }}
                    </td>
                    <td>
                        @if($storeitem->TotalOrder - $storeitem->recOrder==$storeitem->TotalOrder)
                            <span class="badge badge-danger" style="width: 100%;">
                                Order Pending
                            </span>
                        @elseif($storeitem->TotalOrder - $storeitem->recOrder==0)
                            <span class="badge badge-success" style="width: 100%;">
                                Complete Order Received
                            </span>
                        @else
                            <span class="badge badge-warning" style="width: 100%;">
                                Partial Order Received
                            </span>
                        @endif
                    </td>
                    <td>
                        @if(($storeitem->TotalOrder - $storeitem->recOrder==$storeitem->TotalOrder) || ($storeitem->TotalOrder - $storeitem->recOrder!=0))
                        <a href="{{ route('receiveditems.create', $storeitem->orderId ) }}" class="btn btn-info"><i class="fas fa-edit"></i> Add Invoice</a> |
                        @endif
                        <a href="{{ route('purchaseorders.po_summery', $storeitem->orderId ) }}" class="btn btn-info"><i class="fas fa-eye"></i> View Details</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        
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
                text: "Do you really want to delete this Store Item?",
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