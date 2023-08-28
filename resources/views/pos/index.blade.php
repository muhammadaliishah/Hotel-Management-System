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
      Point of Sale
    </h3>
    </div>
</div>
<div class="col-xl-3 col-sm-6 mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('productcategories.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">Product Categories</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('productcategories.create')}}">
	        <span class="float-left">Add Product Category</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-info color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('products.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-barcode "></i>
	            </div>
	            <div class="mr-5">Products</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-info disabled color-palette"  href="{{ route('products.create')}}">
	        <span class="float-left">Add Product</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-success color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('customers.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-users "></i>
	            </div>
	            <div class="mr-5">Customers</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-success disabled color-palette"  href="{{ route('customers.create')}}">
	        <span class="float-left">Add Customer</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-secondary color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('orders.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-receipt "></i>
	            </div>
	            <div class="mr-5">Orders</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-secondary disabled color-palette"  href="{{ route('cart.index') }}">
	        <span class="float-left">Add Order</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

</div>
</section>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Income Details</h3>
		<div class="float-right">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search POS">
                <button type="submit" class="btn btn-danger text-white ml-1">Search</button>
            </form>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
            <div class="col-md-6">
            	<h3>Status Summery</h3>
				<table class="table table-bordered table-striped">
					<tr>
						<th colspan="2" class="text-center">Orders & Income</th>
					</tr>
						<tr>
							<th>
								Orders Count
							</th>
							<td>{{$orders_count}}</td>
						</tr>

						<tr>
							<th>Total Income</th>
							<td>{{$income}}</td>
						</tr>
						<tr>
							<th>Income Today</th>
							<td>{{$income_today}}</td>
						</tr>
						<tr>
							<th>Customers Count</th>
							<td>{{$customers_count}}</td>
						</tr>
				</table>
			</div>
	</div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('adm/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('adm/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adm/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('Highcharts-10.3.3/code/highcharts.js')}}"></script>
<script src="{{asset('Highcharts-10.3.3/code/modules/sunburst.js')}}"></script>
<script src="{{asset('Highcharts-10.3.3/code/modules/exporting.js')}}"></script>
<script src="{{asset('Highcharts-10.3.3/code/modules/export-data.js')}}"></script>
<script src="{{asset('Highcharts-10.3.3/code/modules/accessibility.js')}}"></script>

<script type="text/javascript">
        var data = [{
            id: '0.0',
            parent: '',
            name: 'Sivana'
        }, {
            id: '1.1',
            parent: '0.0',
            name: 'Breakfast Menu'
        },
        {
            id: '1.2',
            parent: '0.0',
            name: 'Breakfast Menu'
        },

        /* Africa */
        {
            id: '2.1',
            parent: '1.1',
            name: 'burger',
            value: 12
        },

        {
            id: '2.2',
            parent: '1.1',
            name: 'Nashta',
            value: 12
        },
        {
            id: '2.2',
            parent: '1.2',
            name: 'Karai',
            value: 12
        }
        ];


        Highcharts.chart('container', {

            chart: {
                height: '100%'
            },

            // Let the center circle be transparent
            colors: ['transparent'].concat(Highcharts.getOptions().colors),

            title: {
                text: 'Income Distribution By Products'
            },

            subtitle: {
                text: 'Source <a href="")">Sivana</a>'
            },

            series: [{
                type: 'sunburst',
                data: data,
                name: 'Root',
                allowDrillToNode: true,
                cursor: 'pointer',
                dataLabels: {
                    format: '{point.name}',
                    filter: {
                        property: 'innerArcLength',
                        operator: '>',
                        value: 16
                    },
                    rotationMode: 'circular'
                },
                levels: [{
                    level: 1,
                    levelIsConstant: false,
                    dataLabels: {
                        filter: {
                            property: 'outerArcLength',
                            operator: '>',
                            value: 64
                        }
                    }
                }, {
                    level: 2,
                    colorByPoint: true
                },
                {
                    level: 3,
                    colorVariation: {
                        key: 'brightness',
                        to: -0.9
                    }
                }, {
                    level: 4,
                    colorVariation: {
                        key: 'brightness',
                        to: 0.9
                    }
                }]

            }],

            tooltip: {
                headerFormat: '',
                pointFormat: 'Total Income generated by <b>{point.name}</b> is <b>{point.value}</b>'
            }
        });
    </script>
@endsection
