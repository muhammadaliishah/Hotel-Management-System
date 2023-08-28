
@extends('layouts.master')
@section('title')
CMS | Sivana
@endsection
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
      CMS
    </h3>
    </div>
</div>
<div class="col-xl-3 col-sm-6   mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('pages.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">Pages</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('pages.create')}}">
	        <span class="float-left">Add Page</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-info color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('categories.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-barcode "></i>
	            </div>
	            <div class="mr-5">Categories</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-info disabled color-palette"  href="{{ route('categories.create')}}">
	        <span class="float-left">Add Category</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-success color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('blog.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-users "></i>
	            </div>
	            <div class="mr-5">Blog</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-success disabled color-palette"  href="{{ route('blog.create')}}">
	        <span class="float-left">Add Blog</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>

<div class="col-xl-3 col-sm-6 mb-3">
	<div class="hrd-comp card text-white o-hidden h-100">
	    <div class="card-body bg-secondary color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('event.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-receipt "></i>
	            </div>
	            <div class="mr-5">Events</div>
	        </a>
	    </div>
	    <a class="card-footer text-white clearfix small z-1 bg-secondary disabled color-palette"  href="{{ route('event.index') }}">
	        <span class="float-left">Add Event</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>



<div class="col-xl-3 col-sm-6   mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('gallery.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">Gallery</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('gallery.create')}}">
	        <span class="float-left">Add Page</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>


<div class="col-xl-3 col-sm-6   mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('news.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">News</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('news.create')}}">
	        <span class="float-left">Add News</span>
	        <span class="float-right">
	            <i class="fa fa-plus"></i>
	        </span>
	    </a>
	</div>
</div>


<div class="col-xl-3 col-sm-6   mb-3">
	<div class="hrd-comp card text-black o-hidden h-100">
	    <div class="card-body bg-warning color-palette" style="font-size: 20px;">
	    	<a  href="{{ route('trips.index')}}" style="text-decoration: none;">
	            <div class="card-body-icon float-right">
	                <i class="fa fa-fw fa-train "></i>
	            </div>
	            <div class="mr-5">Trips</div>
	        </a>
	    </div>
	    <a class="card-footer text-black clearfix small z-1 bg-warning disabled color-palette"  href="{{ route('trips.create')}}">
	        <span class="float-left">Add Trip</span>
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
		<h3 class="card-title">Basic Settings</h3>
		{{-- <div class="float-right">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Enter a keyword">
                <button type="submit" class="btn btn-danger text-white ml-1">Search</button>
            </form>
		</div> --}}
	</div>
	<div class="card-body">
		<div class="row">

            <div class="col-6">

                <form action="{{ route('basic-settings.update', 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <img class="p-3" src="/{{$bsettings->logo }} " width="90px" height="60px" alt="">
                        <input type="file"  name="logo"  value={{$bsettings->logo }} class="form-control" >
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Edit Title</label>
                      <input type="text" name="title" value="{{ $bsettings->title }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">About part 1</label>
                        <textarea   class="form-control" name="detail2"  id="" cols="10" rows="3">
                            {{ $bsettings->detail2  }}

                        </textarea>
                        {{-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> --}}
                      </div>




                    <div class="form-group">
                        <label for="exampleInputPassword1">About Center Image</label>
                        <input type="file"    class="form-control" name="about_image"  />

                        {{-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> --}}
                      </div>




                      <div class="form-group">
                        <label for="exampleInputPassword1">About part 2</label>
                        <textarea   class="form-control" name="detail"  id="" cols="10" rows="3">
                            {{ $bsettings->detail  }}

                        </textarea>
                        {{-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> --}}
                      </div>


                      <div class="form-group">
                        <label for="exampleInputPassword1">Edit Meta Description</label>
                        <textarea   class="form-control" name="metatag"  id="" cols="10" rows="3">

                            {{ $bsettings->metatag  }}
                        </textarea>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputPassword1">Edit Social Links</label>

                        <div class="d-flex">
                            <p class="form-control bg-info">Facebook </p>
                            <p class="form-control bg-info">Linkedin </p>
                            <p class="form-control bg-info">Twitter </p>
                        </div>

                        <div class="d-flex">
                            <input type="text" name="facebook" value="{{ $bsettings->facebook }}" class="form-control" id="exampleInputPassword1" placeholder="Enter Title">
                            <input type="text" name="linkedin" value="{{ $bsettings->linkedin }}" class="form-control" id="exampleInputPassword1" placeholder="Enter Title">
                            <input type="text" name="twitter" value="{{ $bsettings->twitter }}" class="form-control" id="exampleInputPassword1" placeholder="Enter Title">
                        </div>

                      </div>



                      <div class="form-group">
                        <label for="exampleInputPassword1">Edit Contact Details</label>

                        <div class="d-flex">
                            <p class="form-control bg-info">Email </p>
                            <p class="form-control bg-info">Phone Number </p>
                            <p class="form-control bg-info">Address </p>
                        </div>

                        <div class="d-flex">
                            <input type="text" name="email" value=" {{ $bsettings->email }} " class="form-control" id="exampleInputPassword1" placeholder="Enter Title">
                            <input type="text" name="number" value="{{ $bsettings->number }}" class="form-control" id="exampleInputPassword1" placeholder="Enter Title">
                            <input type="text" name="address" value="{{ $bsettings->address }}" class="form-control" id="exampleInputPassword1" placeholder="Enter Title">
                        </div>

                      </div>



                      <div class="form-group">
                        <label for="exampleInputPassword1">Edit Map Link</label>

                        <div class="d-flex">

                            <p class="form-control bg-info">Map Link </p>
                        </div>

                        <div class="d-flex">
                            <input type="text" name="map_link" value="{{ $bsettings->map_link }}" class="form-control" id="exampleInputPassword1" placeholder="Enter Title">
                        </div>

                      </div>


                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>

            </div>


            <div class="col-6">
                <h5 class="text-center form-control bg-info">Edit Navbar</h5>


                    @if (session('navbarinputs'))
                    <div class="alert alert-danger">
                        isues
                     {{ session('navbarinputs') }}
                    </div>
                    @endif


                        <form  action="{{ route('set-navbar.update',$navbar->id ) }}"  method="POST">
                            @csrf
                            @method('PUT')


                            <div  class="row">
                                <div class="col-6">


                                    <label for="">Nav Text</label>
                                </div>
                                <div class="col-6">
                                    <label for="">Nav Link</label>
                                </div>
                            </div>



                            <div  class="row">
                                <div class="col-6">


                                    <input  class="form-control" type="text" name="nav_text1" value="{{ $navbar->nav_text1 }} " >
                                </div>
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="link1" value="{{ $navbar->link1 }} " >
                                </div>
                            </div>


                            <div  class="row">
                                <div class="col-6">


                                    <input  class="form-control" type="text" name="nav_text2" value="{{ $navbar->nav_text2 }} " >
                                </div>
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="link2" value="{{ $navbar->link2 }} " >
                                </div>
                            </div>


                            <div  class="row">
                                <div class="col-6">


                                    <input  class="form-control" type="text" name="nav_text3" value="{{ $navbar->nav_text3 }} " >
                                </div>
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="link3" value="{{ $navbar->link3 }} " >
                                </div>
                            </div>


                            <div  class="row">
                                <div class="col-6">


                                    <input  class="form-control" type="text" name="nav_text4" value="{{ $navbar->nav_text4 }} " >
                                </div>
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="link4" value="{{ $navbar->link4 }} " >
                                </div>
                            </div>


                            <div  class="row">
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="nav_text5" value="{{ $navbar->nav_text5 }} " >
                                </div>
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="link5" value="{{ $navbar->link5 }} " >
                                </div>
                            </div>


                            <div class="d-flex  justify-content-center ">
                                <button type="submit" class="btn btn-info mt-3 text-center">Update</button>
                            </div>


                        </form>




                        {{-- edit Banner  --}}

                        <h5 class="text-center  form-control bg-info mt-3">Edit Banner</h5>

                        <form action="/admin/banner-added" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="d-flex">
                            <input type="file" name="banner" class="form-control">
                            <button type="submit" class="form-control  bg-success">Add</button>
                        </div>
                       </form>

                        <div  class="row mt-1">
                            <div class="col">
                                <label for="">Banner Image</label>
                            </div>
                            <div class="col">
                                <label for="">Delete</label>
                            </div>
                        </div>

                        @foreach ($banners as $banner )


                        <div  class="row mt-1 d-flex" >
                            {{-- <div class="col">


                                <label for=""> {{ $banner->banner }} </label>
                            </div> --}}
                            <div class="col">
                                <img src=" /{{ $banner->banner }} " width="22px" height="22px" alt="">
                            </div>
                            <div class="col">
                                <button class="form-control  bg-danger"><a href="banner-delete/{{ $banner->id }}">Delete</a></button>
                            </div>
                        </div>

                        @endforeach




                        <h5 class="text-center form-control bg-info mt-3">Edit Footer</h5>

                        <form  action="{{ route('set-footer.update',$navbar->id ) }}"  method="POST">
                            @csrf
                            @method('PUT')


                            <div  class="row">
                                <div class="col-6">


                                    <label for="">Footer Text</label>
                                </div>
                                <div class="col-6">
                                    <label for=""> Link</label>
                                </div>
                            </div>




                            <div  class="row">
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="text" value="{{ $footer->text }} " >
                                </div>
                                <div class="col-6">
                                    <input  class="form-control" type="text" name="link" value="{{ $footer->link }} " >
                                </div>
                            </div>


                            <div class="d-flex  justify-content-center ">
                                <button type="submit" class="btn btn-info mt-3 text-center">Update</button>
                            </div>


                        </form>



                        <h5 class="text-center form-control bg-info mt-3">Client Messages </h5>
                        <table class="table b-3">
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <tbody >
                                @foreach ($messges as $message )

                                @endforeach
                                <tr>
                                    <td> {{ $message->id }} </td>
                                    <td> {{ $message->name }}</td>
                                    <td> {{ $message->email }}</td>
                                    <td> {{ $message->message }} </td>
                                </tr>
                            </tbody>
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
