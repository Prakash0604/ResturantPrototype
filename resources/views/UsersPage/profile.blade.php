@extends('LandingPage.user-index')
@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8">
        @if (session()->has('message'))
          <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <div class="card">
            <form method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <p class="text-uppercase text-sm">User Information</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                  <label for="example-text-input" class="form-control-label">Username</label>
                  <input class="form-control" name="user_name" type="text" value="{{ $user->name }}">
                 @error('user_name')
                     <div class="text-danger">{{ $message }}</div>
                 @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email </label>
                  <input class="form-control" readonly name="user_email" type="email" value="{{ $user->email }}">
                  @error('user_email')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
                </div>
              </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Contact Information</p>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <label for="example-text-input" class="form-control-label">Address</label>
                  <input class="form-control" name="user_address" type="text" value="{{ $user->address }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Phone</label>
                  <input class="form-control" name="user_phone" type="text" value="{{ $user->phone }}">
                  @error('user_phone')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Images</label>
                  <input class="form-control" name="user_images" type="file" >
                  @error('user_images')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Bio</button>
          </div>
        </form>
        </div>
      </div>
      <div class="col-md-4  bg-white rounded">
        <div class="card card-profile">
          <div class="row justify-content-center">
            <div class="col-4 col-lg-9 mt-3 order-lg-2">
              {{-- <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0"> --}}
                <a href="javascript:;">
                @if ($user->images!="")
                <img src="{{ asset('storage/images/'.$user->images) }}" class="rounded-circle img-fluid border border-2 border-white">
                @else
                <img src="{{ asset('default/user.png') }}" class="rounded-circle img-fluid border border-2 border-white">
                @endif
                </a>
              {{-- </div> --}}
              <div class="card-body pt-0">
                <div class="text-center mt-4">
                  <h5>
                    <i class="bi bi-person"></i>
                    {{ $user->name }}
                  </h5>
                  <div class="h6 font-weight-300">
                    <i class="bi bi-geo-alt"></i> {{ $user->address }} - {{ $user->phone }}
                    <p> <i class="bi bi-google"></i> {{ $user->email }}</p>
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i>Resturant Management System
                  </div>
                </div>
              </div>

            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
