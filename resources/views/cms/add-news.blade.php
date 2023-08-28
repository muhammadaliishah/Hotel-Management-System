@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>News </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/news') }}">News</a></li>
                        <li class="breadcrumb-item active">Create News</li>
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
      Add New News
    </h3>
    <div class="float-right">
            <a href="{{ route('news.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open News
            </a>
    </div>
    </div>
    <div class="card-body">


        @isset($createnewcategory)


        <form action="{{ route('news.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="catgeoryName">News Title</label>
                <input type="text" name="title" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="News Title " value="{{ old('catgeoryName') }}">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="catgeoryName">Select Image</label>
                <input type="file" name="image" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
value="{{ old('catgeoryName') }}">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Write  Detail</label>
                <textarea name="content" class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail" placeholder="Write  Detail">{{ old('categoryDetail') }}</textarea>
                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoryAbb">Set Date</label>
                <input type="date" name="date" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="categoryAbb" value="{{ old('categoryAbb') }}">
                @error('categoryAbb')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>


        @endisset




        @isset($updatingdata)


        <form action="{{ route('news.update' , $updatingdata->id ) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="catgeoryName">News Title</label>
                <input type="text" name="title"  value="{{ $updatingdata->title }}" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Catgeory Name" value="{{ old('catgeoryName') }}">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="catgeoryName">Select Image</label>
                <input type="file" name="image"  class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
value="{{ old('catgeoryName') }}">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryDetail">Write  Detail</label>
                <textarea name="content" class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail" placeholder="Write  Detail"> {{ $updatingdata->title }} </textarea>
                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoryAbb">Set Date</label>
                <input type="date" name="date" value="{{ $updatingdata->date }}" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="categoryAbb" value="{{ old('categoryAbb') }}">
                @error('categoryAbb')
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
