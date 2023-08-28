@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

@isset($message)


            <div>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>

            @endisset

                    <h1>Add  Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('pages.create') }}">Pages</a></li>
                        <li class="breadcrumb-item active">Add PAges</li>
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
      Add New Page
    </h3>
    <div class="float-right">
            <a href="{{ route('pages.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                All Pages
            </a>
    </div>
    </div>

    @isset($updatingdata)

    <div class="card-body">

        <form action="{{ route('pages.update' , $updatingdata->id ) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="catgeoryName">Page Title</label>
                <input type="text" value="{{ $updatingdata->title }}" name="title" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Enter text here" value="{{ old('title') }}">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Add Content</label>
                <textarea name="content" class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail" placeholder="Enter text here">{{  $updatingdata->content  }}</textarea>
                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <select name="category" id="" class="form-control">
                    <option value="">{{  $updatingdata->category  }}</option>
                    <option value="travel">travel</option>
                    <option value="book">book</option>
                    <option value="tour">tour</option>
                </select>

                <input type="number" name="added_by" value="1" hidden>
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>

    @endisset






@isset($createnewpage)



    <div class="card-body">

        <form action="{{ route('pages.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="catgeoryName">Page Title</label>
                <input type="text" name="title" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Enter text here" value="{{ old('title') }}">
                <input type="hidden" name="category" value="0">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Add Content</label>
                <textarea name="content" class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail" placeholder="Enter text here">{{ old('categoryDetail') }}</textarea>
                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <select name="category" id="" class="form-control">
                    <option value="">Select Category</option>
                    <option value="travel">travel</option>
                    <option value="book">book</option>
                    <option value="tour">tour</option>
                </select>

                <input type="number" name="added_by" value="1" hidden>
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
