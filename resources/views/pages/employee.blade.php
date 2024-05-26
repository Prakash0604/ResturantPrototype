@extends('index')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Employee table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact Info</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Verified</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Designation</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Join Date</th>
                      <th class="text-secondary opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @forelse ($users as $user) --}}
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            {{-- @if ($user->images!="") --}}
                            {{-- <img src="{{ asset('storage/images/'.$user->images) }}" class="avatar avatar-sm me-3" alt="user1">
                            @else
                            <img src="{{ asset('default/user.png') }}" class="avatar avatar-sm me-3" alt="user1">
                            @endif --}}

                          </div>
                        </td>
                        <td>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Testing</h6>
                            <p class="text-xs text-secondary mb-0">Testing</p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">testing</h6>
                            <p class="text-xs text-secondary mb-0">testing</p>
                          </div>
                      </td>

                      <td class="align-middle text-center text-sm">
                        {{-- @if ($user->is_verified==1) --}}
                        <span class="badge badge-sm bg-gradient-success">
                            Verified
                        </span>
                        {{-- @else --}}
                        {{-- <span class="badge badge-sm bg-gradient-danger">
                            Not Verified
                        </span>
                        @endif --}}
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">testing</span>
                      </td> <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">testing</span>
                      </td>
                      <td class="align-middle">
                        <a href="" class="btn btn-primary">Edit</a>
                        <a href="" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    {{-- @empty --}}
                    {{-- <tr>
                        <td colspan="5" class="text-center">No data found</td>
                    </tr>
                    @endforelse --}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @endsection
