@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Product Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/productcategories') }}">Product Categories</a></li>
                        <li class="breadcrumb-item active">Edit Product Category</li>
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
      Edit Product Category
    </h3>
    <div class="float-right">
            <a href="{{ route('pos.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open POS
            </a>
    </div>
    </div>
    <div class="card-body">

        <form action="{{ route('productcategories.update', $procategory->categoryId) }}" method="POST" >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="catgeoryName">Category Name</label>
                <input type="text" name="catgeoryName" class="form-control @error('name') is-invalid @enderror" id="catgeoryName"
                    placeholder="Catgeory Name" value="{{ old('catgeoryName', $procategory->catgeoryName) }}">
                @error('catgeoryName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Category Detail</label>
                <textarea name="categoryDetail" class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail"
                    placeholder="categoryDetail">{{ old('categoryDetail', $procategory->categoryDetail) }}</textarea>
                @error('categoryDetail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoryAbb">Category Abbreviation</label>
                <input type="text" name="categoryAbb" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="Category Abbreviation" value="{{ old('categoryAbb', $procategory->categoryAbb) }}">
                @error('categoryAbb')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
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