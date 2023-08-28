@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>News</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item active">News</li>
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
      Vendors
    </h3>
    <div class="float-right">
            <a href="{{ route('news.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open News
            </a>
            <a class="btn btn-danger"  href="{{ route('news.create')}}"><i class="fa fa-plus text-white"></i></a>
    </div>
    </div>
        <div class="card-body" style="overflow: auto;">
            <div class="float-right mt-2 mb-3">
            <form class="form-inline">
                <input type="text" class="form-control" name="search" placeholder="Search Vendors">
                <button type="submit" class="btn btn-primary ml-1">Search</button>
            </form>
        </div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @isset($data)

                @foreach ($data as $key=>$Vendor)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$Vendor->title}}</td>

                        <td>
                            <img width="50" height="30" src="{{ Storage::url($Vendor->avatar) }}" alt="">
                        </td>
                        <td>{{$Vendor->content}}</td>
                        <td>{{$Vendor->date}}</td>
                        <td>
                        <a href="{{ route('news.edit',$Vendor->id ) }}">
                            <button class="btn btn-info">Update</button>
                        </a>


                        <form action="{{ route('news.update',$Vendor->id ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                        </form>
                        </td>


                    </tr>
                @endforeach

                </tbody>
            </table>

            @endisset
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
                    text: "Do you really want to delete this Vendor?",
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
