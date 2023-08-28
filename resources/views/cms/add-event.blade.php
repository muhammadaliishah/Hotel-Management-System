@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Events</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/event') }}">Product Categories</a></li>
                        <li class="breadcrumb-item active">Add Events</li>
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
      Add New Event
    </h3>
    <div class="float-right">
            <a href="{{ route('event.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Events
            </a>
    </div>
    </div>
    <div class="card-body">

        @isset($createnewcategory)


        <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Enter Title</label>
                <input type="text" name="title" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Enter Title" value="{{ old('catgeoryName') }}">
                <input type="hidden" name="parentCategory" value="0">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>




            <div class="form-group">
                <label for="categoryDetail">Enter  Detail</label>
                <textarea name="detail" class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail" placeholder="Enter Detail"></textarea>
                @error('categoryDetail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoryAbb">Location</label>
                <input type="text" name="location" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="categoryAbb" value="{{ old('categoryAbb') }}">
                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>




              <div class="form-group">
                <label for="categoryAbb">Select Image</label>
                <input type="file" name="image" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="categoryAbb" value="{{ old('categoryAbb') }}">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>






            <div class="form-group">
                <label for="categoryAbb">Set Date</label>
                <input type="date" name="date" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="" value="{{ old('categoryAbb') }}">
                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>



            <div class="form-group">
                <label for="categoryAbb">Set Time</label>
                <input type="time" name="time" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="" value="{{ old('categoryAbb') }}">
                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>
        @endisset




        @isset($updatingdata)


        <form action="{{ route('event.update' , $updatingdata->id ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Enter Title</label>
                <input type="text" value="{{ $updatingdata->title }}" name="title" class="form-control @error('catgeoryName') is-invalid @enderror" id="catgeoryName"
                    placeholder="Enter Title" value="{{ old('catgeoryName') }}">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>




            <div class="form-group">
                <label for="categoryDetail">Enter  Detail</label>
                <textarea name="detail"  class="form-control @error('categoryDetail') is-invalid @enderror"
                    id="categoryDetail" placeholder="Enter Detail"> {{ $updatingdata->detail }}</textarea>
                @error('categoryDetail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoryAbb">Location</label>
                <input type="text" name="location" value="{{ $updatingdata->location }}" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="categoryAbb" value="{{ old('categoryAbb') }}">
                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="categoryAbb">Select Image</label>
                <input type="file" name="image" value="{{ $updatingdata->location }}" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="categoryAbb" value="{{ old('categoryAbb') }}">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>




            <div class="form-group">
                <label for="categoryAbb">Set Date</label>
                <input type="date"  value="{{ $updatingdata->date }}" name="date" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="" value="{{ old('categoryAbb') }}">
                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>



            <div class="form-group">
                <label for="categoryAbb">Set Time</label>
                <input type="time" name="time" value="{{ $updatingdata->time }}" class="form-control @error('categoryAbb') is-invalid @enderror"
                    id="categoryAbb" placeholder="" value="{{ old('categoryAbb') }}">
                @error('location')
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
