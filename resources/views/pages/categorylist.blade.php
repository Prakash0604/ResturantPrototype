@extends('index')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-secondary btn-lg bg-gray-100 text-dark" data-bs-toggle="modal"
                data-bs-target="#addCategory">
                <i class="bi bi-plus-lg"></i>
                Add Category
               </button>
                <a href="{{ url('admin/add/menu') }}" class="btn btn-secondary btn-lg bg-gray-100 text-dark" >
                    <i class="bi bi-arrow-left-circle"></i>
                    View Menu
                </a>
                                {{-- Category add start --}}
                                <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="addCategories">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">
                                                    Add Category
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    {{-- @csrf --}}
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Category Name</label>
                                                        <input type="text" name="cat_name" class="form-control"
                                                            placeholder="Enter your category" />
                                                        <small id="error" class="text-danger"></small>
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
                            {{-- Category add End --}}

                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Category List</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-4">
                                            S.N
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            Cateory Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $n=1;
                                    @endphp
                                    @forelse ($categories as $cat)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <h5>{{ $n }}</h5>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                           <h5>{{ $cat->name }}</h5>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <h5><span class="badge badge-pill bg-{{ $cat->status ? "success":"danger" }}">{{ $cat->status ? "Active":"Inactive" }}</span></h5>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <button class="btn btn-primary editcat" data-id={{ $cat->id }} data-bs-toggle="modal" data-bs-target="#editCat"><i class="bi bi-pencil-square"></i>Edit</button>
                                            <button class="btn btn-danger deletecat" data-id="{{ $cat->id }}"         data-bs-toggle="modal"
                                                data-bs-target="#deletecat"><i class="bi bi-trash"></i>Delete</button>
                                        </td>
                                    </tr>
                                    @php
                                        $n=$n+1;
                                    @endphp
                                    @empty
                                    <tr>
                                        <td class="align-middle text-center text-sm" colspan="4">
                                            <h5>No data found</h5>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <!--Delete Modal -->
    <div
        class="modal fade"
        id="deletecat"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteCat">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Delete Cateogry
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-3">
                           <input type="hidden" id="catid">
                           <h4>Are your sure your want to delete ?</h4>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger" id="deletebtn">Confirm Delete</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!--Delete Modal End  -->
    <div
        class="modal fade"
        id="editCat"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateCat">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Edit Category
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input
                                type="text"
                                name="edit_cat_name"
                                id="edit_cat_name"
                                class="form-control"
                            />
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnupdate">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            // Category Add Script Start
            $("#addCategories").submit(function(e) {
                e.preventDefault();
                $("#btnsave").text("Saving...");
                $("#btnsave").prop("disabled", true);
                var formdata = $(this).serialize();
                // console.log(formdata);
                // var formdata=new FormData($("#addCategory"));
                $.ajax({
                    method: "post",
                    url: "{{ url('/admin/add/category') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formdata,
                    success: function(data) {
                        console.log(data);
                        if(data.success==true){
                            console.log(data);
                            Swal.fire({
                                icon:"success",
                                title:data.message,
                                showConfirmButton:false,
                                timer:1500
                            });
                            setTimeout(() => {
                                location.reload();
                                $("input[type='text']").val("");
                            }, 1500);
                        }

                        if(data.success==false){
                            Swal.fire({
                                icon:"error",
                                title:data.message,
                                showConfirmButton:false,
                                timer:1500
                            });
                            $("#btnsave").text("Save");
                            $("#btnsave").prop("disabled",false);
                        }
                    }
                })
            });
            // Category Add Script End

            // Edit category id wise start
            $(document).on("click",".editcat",function(){
                var id=$(this).attr("data-id");
                console.log(id);
                $.ajax({
                    method:"get",
                    url:"{{ url('admin/category/edit/') }}/"+id,
                    success:function(data){
                        console.log(data);
                        $("#edit_cat_name").val(data.cat.name);
                        $("#id").val(data.cat.id);
                    }
                })
            });
                // Edit category id wise start

                // Update  categeory

                $("#updateCat").submit(function(e){
                    e.preventDefault();
                    $("#btnupdate").text("Updating...");
                    $("#btnupdate").prop("disabled",true);
                    var formdata=$(this).serialize();
                    // var formdata=new FormData($(this));
                    console.log(formdata);
                    $.ajax({
                        method:"POST",
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                        url:"{{ url('admin/category/edit/') }}",
                        data:formdata,
                        success:function(data){
                            console.log(data);
                            if(data.success==true){
                                Swal.fire({

                                    icon:"success",
                                    title:"Category updated successfully",
                                    showConfirmButton:false,
                                    timer:1500,
                                })
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                        }
                    });
                });

                // End Update Category

                // Delete Category start
                $(document).on("click",".deletecat",function(){
                    var id=$(this).attr("data-id");
                    // console.log(id);
                    // let input=$("#catid").val(id);
                    // console.log(input);
                    $("#deleteCat").submit(function(e){
                        e.preventDefault();
                        $("#deletebtn").text("Deleting...");
                        $("#deletebtn").prop("disabled",true);
                        // var id=$(this).serialize;
                        $.ajax({
                            method:"get",
                            url:"/admin/category/delete/"+id,
                            success:function(data){
                                // console.log(data);
                                if(data.success==true){
                                    Swal.fire({
                                        icon:"success",
                                        title:"Category deleted",
                                        showConfirmButton:false,
                                        timer:1500,
                                    });
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                }
                                if(data.success==false){
                                    Swal.fire({
                                        icon:"error",
                                        title:"Something went wrong",
                                        showConfirmButton:false,
                                        timer:1500
                                    });
                                }
                            }
                        })

                    })
                })
                // Delete Category start
            });
            </script>
@endsection
