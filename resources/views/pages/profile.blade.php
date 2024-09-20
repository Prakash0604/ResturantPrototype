@extends('index')
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
                  <label for="example-text-input" class="form-control-label">Username</label>
                  <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email </label>
                  <input class="form-control" name="email" type="email" value="{{ $user->email }}">
                </div>
              </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Contact Information</p>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Address</label>
                  <input class="form-control" name="address" type="text" value="{{ $user->address }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Phone</label>
                  <input class="form-control" name="phone" type="text" value="{{ $user->phone }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Images</label>
                  <input class="form-control" name="images" type="file" >
                </div>
              </div>
            </div>
            <button class="btn btn-success mt-3">Update Bio</button>
          </div>
        </form>
        </div>
      </div>
      <div class="col-md-4  bg-white rounded">
        <div class="card card-profile mt-3">
          <img src="{{ asset('login/images/bg-01.jpg') }}" alt="Image placeholder" class="card-img-top">
          <div class="row justify-content-center">
            <div class="col-4 col-lg-4 order-lg-2">
              <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                <a href="javascript:;">
                @if ($user->images!="")
                <img src="{{ asset('storage/teams/'.$user->images) }}" class="rounded-circle img-fluid border border-2 border-white">
                @else
                <img src="{{ asset('default/user.png') }}" class="rounded-circle img-fluid border border-2 border-white">
                @endif
                </a>
              </div>
            </div>
          </div>
          </div>
          <div class="card-body pt-0">
            <div class="text-center mt-4">
              <h5>
                {{ $user->name }}
              </h5>
              <div class="h6 font-weight-300">
                <i class="ni location_pin mr-2"></i>{{ $user->address }} - {{ $user->phone }}
                <p>{{ $user->email }}</p>
              </div>
              <div class="h6 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>{{ $user->position }}, at Online Khaja Ghar
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
@endsection
