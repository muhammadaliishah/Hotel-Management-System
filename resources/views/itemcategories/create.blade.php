@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Store Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/itemcategories') }}">Store Item Categories</a></li>
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
      Add New Store Item Category
    </h3>
    <div class="float-right">
            <a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
    </div>
    </div>
    </div>
<div class="card">
    <div class="card-body">

        <form action="{{ route('itemcategories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="catgeoryName">Store Category Item Name</label>
                <input type="text" name="catgeoryName" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Catgeory Name" value="{{ old('catgeoryName') }}">
                <input type="hidden" name="parentCategory" value="0">
                @error('catgeoryName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Category Detail</label>
                <textarea name="categoryDetail" class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail" placeholder="Category Detail">{{ old('categoryDetail') }}</textarea>
                @error('categoryDetail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoryAbb">Category Abb</label>
                <input type="text" name="categoryAbb" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="categoryAbb" value="{{ old('categoryAbb') }}">
                @error('categoryAbb')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
</div>
@endsection
</div>
</div>
</div>
</section>
@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection