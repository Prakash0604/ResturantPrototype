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
                                    <select class="form-select col-3" name="search">
                                        <option value="">Show All</option>
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
                            <table class="table align-items-center mb-0 table-bordered">
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

                                            {{-- @php
                                                dd($menu);
                                            @endphp --}}
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
                                                    class="text-secondary text-dark badge badge-pill bg-gradient-success font-weight-bold">
                                                    @if ($menu->category)
                                                        {{ $menu->category->name }}
                                                        @else
                                                        Category Not assigned
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="" class="btn btn-primary editMenu"
                                                    data-id="{{ $menu->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#editModal">Edit</a>
                                                <a href="" class="btn btn-danger deleteMenu"
                                                    data-id="{{ $menu->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal">Delete</a>
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


    {{-- ===============================Edit Modal Start ==================================== --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateItem" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Item
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="mb-3">
                                @csrf
                                <input type="hidden" name="id" id="item_id">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="edit_name" id="edit_name" class="form-control"
                                    placeholder="Enter Item name" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Images</label>
                                <input type="file" name="edit_images" id="edit_images" class="form-control" />
                                <div id="image">

                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea name="edit_description" id="edit_description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" name="edit_price" id="edit_price" class="form-control"
                                    placeholder="Enter the rate " />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select class="form-select form-select-lg" id="edit_category" name="edit_category">
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
                        <button type="submit" class="btn btn-primary" id="btnupdate">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===============================Edit Modal End ==================================== --}}
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
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Saved Successfully",
                                showconfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                location.realod();
                            }, 1500);
                        }
                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,

                            });
                            $("#btnsave").prop("disabled", false);
                            $("#btnsave").text("Save");
                        }
                    }
                })
            });

            $(document).on("click", ".editMenu", function(e) {
                var id = $(this).attr("data-id");
                $.ajax({
                    method: "get",
                    url: "{{ url('admin/edit/item') }}/" + id,
                    success: function(data) {
                        console.log(data);
                        $("#edit_name").val(data.message.name);
                        $("#edit_description").val(data.message.description);
                        $("#edit_price").val(data.message.price);
                        $("#edit_category").val(data.message.category_id);
                        $("#image").html(`
                            <img src="{{ asset('storage/food/') }}/${data.message.images}"alt="" width="100" height="100">
                        `);
                        $("#item_id").val(data.message.id);
                    }
                });
            });

            $("#updateItem").submit(function(e) {
                e.preventDefault();
                $("#btnupdate").text("Updating...");
                $("#btnupdate").prop("disabled", true);
                var formdata=new FormData(this);
                $.ajax({
                    method:"POST",
                    url:"{{ url('admin/edit/item') }}",
                    data:formdata,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        console.log(data);
                        if(data.success==true){
                            Swal.fire({
                                icon:"success",
                                title:"Menu Updated Successfully",
                                showconfirmButton:false,
                                timer:1500,
                            });
                            $("input[type='text']").val("");
                            $("input[type='file']").val("");
                            $("input[type='textarea']").val("");
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }
                        if(data.success==false){
                            Swal.fire({
                                icon:"warning",
                                title:data.message,
                                showConfirmButton:false,
                                timer:1500,
                            });
                            $("#updatebtn").prop("disabled",false);
                            $("#updatebtn").text("Update");
                        }
                    }
                })

            })
        });
    </script>
@endsection
