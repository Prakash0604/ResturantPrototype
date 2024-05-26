@extends('index')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-secondary btn-lg bg-gray-100 text-dark" data-bs-toggle="modal"
                    data-bs-target="#modalId">
                    <i class="bi bi-plus-lg"></i>
                    Add Item
                </button>
                <a href="{{ url('/admin/category/list') }}" class="btn btn-secondary btn-lg bg-gray-100 text-dark">

                    View Category

                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="add_item" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Add Items
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="mb-3">
                                            @csrf
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter Item name" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Images</label>
                                            <input type="file" name="images" class="form-control" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Rich chocolate cake" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control"
                                                placeholder="Enter the rate " />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Category</label>
                                            <select class="form-select form-select-lg" name="category">
                                                <option selected>Select one</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="btnsave">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Menu Item</h6>
                    </div>
                     <div class="card-header pb-0">
                        <h6>
                            <form method="get">
                                <div class="row d-flex">
                                {{-- <div class="mb-3"> --}}
                                    <label for="" class="form-label">Category</label>
                                    <select
                                        class="form-select col-3"
                                        name="search"
                                    >
                                        <option value="">Select to filter</option>
                                        @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                {{-- </div> --}}
                                <button class="btn btn-primary">Filter <i class="bi bi-list"></i></button>
                            </div>
                            </form>
                        </h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image
                                       </th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        name</th>
                                        <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Description
                                       </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category</th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menuitems as $menu)
                                        <tr>


                                            <td class="align-middle text-center text-sm">
                                                    <div>
                                                        @if ($menu->images != '')
                                                            <img src="{{ asset('storage/food/' . $menu->images) }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        @else
                                                            <img src="{{ asset('default/user.png') }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        @endif
                                                    </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <h6>
                                                    {{ $menu->name }}
                                                </h6>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <h6>{{ $menu->description }}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <h6>{{ $menu->price }} Rs</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-dark badge badge-pill bg-gradient-success font-weight-bold">{{ $menu->category->name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="" class="btn btn-primary">Edit</a>
                                                <a href="" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- <tr>
                        <td colspan="5" class="text-center">No data found</td>
                    </tr> --}}
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#add_item").submit(function(e) {
                e.preventDefault();
                $("#btnsave").text("Saving...");
                $("#btnsave").prop("disabled", true);
                var formdata = new FormData(this);
                // var formdata=$(this).serialize();
                console.log(formdata);
                $.ajax({
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/add/item') }}",
                    data: formdata,
                    processData:false,
                    contentType:false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Saved Successfully",
                                confirmButtonShow: false,
                                timer: 1500
                            });
                        }
                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $("#btnsave").prop("disabled", false);
                            $("#btnsave").text("Save");
                        }
                    }
                })
            });
        });
    </script>
@endsection
