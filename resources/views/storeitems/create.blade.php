@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Store Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/storeitems') }}">Store Items</a></li>
                        <li class="breadcrumb-item active">Create Store Item</li>
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
      Add New Store Item
    </h3>
    <div class="float-right">
            <a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
    </div>
    </div>
    <div class="card-body">

        <form action="{{ route('storeitems.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="categoryId">Store Item Category</label>
                <select name="categoryId" id="categoryId" class="form-control @error('categoryId') is-invalid @enderror">
                    <option value="">--Select Store Item Category--</option>
                    @foreach($categories as $category)
                    <option value="{{$category->categoryId}}" {{old("categoryId")==$category->categoryId?"selected":""}}>{{$category->catgeoryName}}</option>
                    @endforeach
                </select>
                @error('categoryId')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="itemName">Name</label>
                <input type="text" name="itemName" class="form-control @error('itemName') is-invalid @enderror" id="itemName"
                    placeholder="Name" value="{{ old('itemName') }}">
                @error('itemName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                    id="description" placeholder="description">{{ old('description') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image" value="{{ old('image') }}">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
                @error('image')
                <span class="" role="alert" style="color:red;">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
                
            <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror"
                    id="barcode" placeholder="barcode" value="{{ old('barcode') }}">
                @error('barcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Base Price</label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                    placeholder="price" value="{{ old('price') }}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unitOfMeasurement">Measurement Unit</label>
                <select name="unitOfMeasurement" class="form-control @error('unitOfMeasurement') is-invalid @enderror" id="unitOfMeasurement">
                    <option>--Select--</option>
                    <option value="kg" {{ old('unitOfMeasurement') === 'kg' ? 'selected' : ''}}>Kilogram</option>
                    <option value="litre" {{ old('unitOfMeasurement') === 'litre' ? 'selected' : ''}}>Litre</option>
                    <option value="dozen" {{ old('unitOfMeasurement') === 'dozen' ? 'selected' : ''}}>Meter</option>
                    <option value="unit" {{ old('unitOfMeasurement') === 'unit' ? 'selected' : ''}}>Unit</option>
                </select>
                @error('unitOfMeasurement')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="minQuantity">Minimum Quantity</label>
                <input type="text" name="minQuantity" class="form-control @error('minQuantity') is-invalid @enderror" id="minQuantity"
                    placeholder="minQuantity" value="{{ old('minQuantity') }}">
                @error('minQuantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                    <option value="1" {{ old('status') == 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : ''}}>Inactive</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
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