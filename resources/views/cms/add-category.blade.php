@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Add Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/productcategories') }}">Product Categories</a></li>
                        <li class="breadcrumb-item active">Create Category</li>
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
      Add New  Category
    </h3>
    <div class="float-right">
            <a href="{{ route('categories.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
              Categories
            </a>
    </div>
    </div>


    @isset($createnewcategory)

    <div class="card-body">

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="catgeoryName"> Category Name</label>
                <input type="text" name="name" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Catgeory Name" value="{{ old('catgeoryName') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
    @endisset




    @isset($updatingdata)


    <div class="card-body">

        <form action="{{ route('categories.update' , $updatingdata->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="catgeoryName"> Category Name</label>
                <input type="text" value="{{ $updatingdata->name }}" name="name" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Catgeory Name" value="{{ old('catgeoryName') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
    @endisset
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
