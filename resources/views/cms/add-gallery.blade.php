@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/gallery') }}">Gallery</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
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
      Add New Pics To Gallery
    </h3>
    <div class="float-right">
            <a href="{{ route('gallery.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open POS
            </a>
    </div>
    </div>
    <div class="card-body">

        @isset($createnewcategory)

        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="catgeoryName">Name</label>
                <input type="text" required name="name" class="form-control @error('catgeoryName') is-invalid @enderror" >
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Select File</label>
                <input type="file" name="image" required class="form-control @error('catgeoryName') is-invalid @enderror" >
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>

        @endisset






        @isset($updatingdata)
        <form action="{{ route('gallery.update' , $updatingdata->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="catgeoryName">Name</label>
                <input type="text" value="{{ $updatingdata->title }}" name="name" value="{{ $updatingdata->name }}" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Enter Name" value="{{ old('catgeoryName') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Select File</label>
                <input type="file"  name="image" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                placeholder="Enter Name" value="{{ old('catgeoryName') }}">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>
        @endisset



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
