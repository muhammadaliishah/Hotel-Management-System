@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Expense Item Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/cashflowcategories') }}">Expense Item Categories</a></li>
                        <li class="breadcrumb-item active">Edit Expense Item Category</li>
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
      Edit Expense Item Category
    </h3>
    <div class="float-right">
            <a href="{{ route('cfmain.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Cash Flow
            </a>
    </div>
    </div>
<div class="card">
    <div class="card-body">

        <form action="{{ route('cashflowcategories.update', $category->cf_catId ) }}" method="POST" >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="cf_catName">Category Name</label>
                <input type="text" name="cf_catName" class="form-control @error('name') is-invalid @enderror" id="cf_catName"
                    placeholder="Catgeory Name" value="{{ old('cf_catName', $category->cf_catName) }}">
                @error('cf_catName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="cf_catDetail">Category Detail</label>
                <textarea name="cf_catDetail" class="form-control @error('cf_catDetail') is-invalid @enderror"
                    id="cf_catDetail"
                    placeholder="cf_catDetail">{{ old('cf_catDetail', $category->cf_catDetail) }}</textarea>
                @error('cf_catDetail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cf_catAbb">Category Abbreviation</label>
                <input type="text" name="cf_catAbb" class="form-control @error('cf_catAbb') is-invalid @enderror"
                    id="cf_catAbb" placeholder="Category Abbreviation" value="{{ old('cf_catAbb', $category->cf_catAbb) }}">
                @error('cf_catAbb')
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