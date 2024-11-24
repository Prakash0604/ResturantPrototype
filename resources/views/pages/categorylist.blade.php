@extends('index')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary text-white btn-lg bg-gray-100 mt-3 mb-3" data-bs-toggle="modal"
                    data-bs-target="#addCategory">
                    <i class="bi bi-plus-lg"></i>
                    Add Category
                </button>
                <a href="{{ url('admin/add/menu') }}" class="btn btn-primary text-white mt-3 mb-3 btn-lg bg-gray-100">
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
                            <table class="table align-items-center table-bordered table-striped mb-0" id="fetch-category-list">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-4">
                                            S.N
                                        </th>
                                        <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            Cateory Name
                                        </th>
                                        <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <div class="modal fade" id="editCat" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateCat">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Category
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" name="edit_cat_name" id="edit_cat_name" class="form-control" />
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
    <script>
        $(document).ready(function() {

            // Datatable
            var table = $("#fetch-category-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.category') }}",
                columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                }, {
                    data: "name",
                    name: "name"
                }, {
                    data: "status",
                    name: "status"
                }, {
                    data: "action",
                    name: "status"
                }]
            })
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
                        if (data.success == true) {
                            console.log(data);
                            Swal.fire({
                                icon: "success",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#addCategories")[0].reset();
                            $("#addCategory").modal("hide");
                            table.draw();
                        }

                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                            });
                            $("#btnsave").text("Save");
                            $("#btnsave").prop("disabled", false);
                        }
                    },
                    complete: function() {
                        ("#btnsave").text("Save");
                        $("#btnsave").prop("disabled", false);
                    }
                })
            });
            // Category Add Script End

            // Edit category id wise start
            $(document).on("click", ".editcat", function() {
                var id = $(this).attr("data-id");
                console.log(id);
                $.ajax({
                    method: "get",
                    url: "/admin/category/edit/" + id,
                    success: function(data) {
                        console.log(data);
                        $("#edit_cat_name").val(data.cat.name);
                        $("#id").val(data.cat.id);
                    }
                })
            });
            // Edit category id wise start

            // Update  categeory

            $("#updateCat").submit(function(e) {
                e.preventDefault();
                $("#btnupdate").text("Updating...");
                $("#btnupdate").prop("disabled", true);
                var formdata = $(this).serialize();
                // var formdata=new FormData($(this));
                console.log(formdata);
                $.ajax({
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/category/edit/') }}",
                    data: formdata,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({

                                icon: "success",
                                title: "Category updated successfully",
                                showConfirmButton: false,
                                timer: 1500,
                            })
                            table.draw();
                            $("#editCat").modal("hide");
                        }
                    }
                });
            });

            // End Update Category

            // Delete Category start
            $(document).on("click", ".deletecat", function() {
                var id = $(this).attr("data-id");
               Swal.fire({
                icon:"warning",
                title:"Are you Sure ?",
                text:"You won't be able to rever this !",
                showCancelButton:true,
                confirmButtonColor:"#3085d6",
                confirmButtonText:"Yes,Delete it !",
                cancelButtonColor:"#d33"
               }).then((result)=>{
                if(result.isConfirmed){
                    $.ajax({
                        method: "get",
                        url: "/admin/category/delete/" + id,
                        success: function(data) {
                            // console.log(data);
                            if (data.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Category deleted",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                               table.draw();
                            }
                            if (data.success == false) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Something went wrong",
                                });
                            }
                        },
                        error:function(xhr){
                            console.log(xhr);
                        }
                    })
                }
               })
            })
            // Delete Category start

            // Status Toggle Button
            $(document).on("click", ".statusCheckBoxBtn", function() {
                let id = $(this).attr("data-id");
                $.ajax({
                    type: "get",
                    url: "/admin/category/status/update/" + id,
                    success: function(response) {
                        table.draw();
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                })
            })
        });
    </script>
@endsection
