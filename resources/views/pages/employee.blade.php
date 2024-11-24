@extends('index')
@section('content')
    <div class=" py-4">
        <h1 class="text-center ">Employee List</h1>
        <button type="button" class="btn btn-success btn-lg mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalId">
            <i class="bi bi-plus-lg"></i>
            Add Employee
        </button>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="text-center">Employee table</h6>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-striped align-items-center mb-0" id="fetch-user-data">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder">S.N</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder">Image</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder">Employee Name</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder">Email</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder">Address</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact Number</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Designation</th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                        </table>

                    </div>
            </div>
        </div>
    </div>
    </div>


    {{-- ==================================Employee Add Modal Start================================== --}}

    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addEmployee">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Add Employee
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Employee Info</label>
                                <input type="text" name="name" placeholder="Employee name" id=""
                                    class="form-control mb-2" />
                                <input type="text" name="address" placeholder="Enter your address" id=""
                                    class="form-control mb-2" />
                                <input type="password" name="password" placeholder="Enter password" id=""
                                    class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Contact</label>
                                <input type="number" name="phone" placeholder="Enter your contact number"
                                    id="" class="form-control mb-2" />
                                <input type="email" name="email" placeholder="Enter your email" id=""
                                    class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Designation</label>
                                <input type="text" name="designation" id=""
                                    placeholder="chef,patissier,cook,etc..." class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnsave"> <i
                                class="bi bi-floppy2-fill"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================================Employee Add Modal End==================================== --}}


    {{-- ==================================Employee Edit Modal Start==================================== --}}


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editEmployee">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Employee
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="edit_images" class="form-control" />
                                <div id="img">

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Employee Info</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="edit_name" placeholder="Employee name" id="edit_name"
                                    class="form-control mb-2" />
                                <input type="text" name="edit_address" placeholder="Enter your address"
                                    id="edit_address" class="form-control mb-2" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Contact</label>
                                <input type="number" name="edit_phone" placeholder="Enter your contact number"
                                    id="edit_phone" class="form-control mb-2" />
                                <input type="email" name="edit_email" readonly placeholder="Enter your email"
                                    id="edit_email" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Designation</label>
                                <input type="text" name="edit_designation" id="edit_designation"
                                    placeholder="chef,patissier,cook,etc..." class="form-control" />
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select class="form-select form-select-lg" name="edit_status" id="">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnUpdate"> <i
                                class="bi bi-floppy2-fill"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ==================================Employee Edit Modal End==================================== --}}

    <script>
        $(document).ready(function() {
            // e.preventDefault();
            // Data Tables
            var table=$("#fetch-user-data").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employee.index') }}",
                columns: [
                    {data: "DT_RowIndex", name: "DT_RowIndex"},
                    {data: "empImage", name: "empImage" },
                    {data: "name", name: "name"},
                    {data: "email",name: "email"},
                    {data: "address",name: "address"},
                    {data: "phone",name: "phone"},
                    {data: "status", name: "status"},
                    {data: "designation", name: "designation"},
                    {data: "action",name: "action"}
                ]
            });
            $("#addEmployee").submit(function(e) {
                e.preventDefault();
                $("#btnsave").text("Saving...");
                $("#btnsave").prop("disabled", true);
                var formdata = new FormData(this);
                $.ajax({
                    method: "POST",
                    url: "{{ url('admin/employee/add') }}",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Employee added Successfully",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                            $("#btnsave").prop("disabled", false);
                            $("#btnsave").text("Save");
                        }
                        if (data.success == false) {
                            Swal.fire({
                                icon: "warning",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $("#btnsave").prop("disabled", false);
                            $("#btnsave").text("Save");
                        }
                    },
                    complete: function() {
                        ("#btnsave").text("Save");
                        $("#btnsave").prop("disabled", false);
                    }
                });
            });

            // ==========================Show Data in Edit Modal Start======================================
            $(document).on("click", '.editEmployee', function() {
                var id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    method: "get",
                    url: "{{ url('admin/employee/edit') }}/" + id,
                    success: function(data) {
                        console.log(data);
                        $("#id").val(data.data.id);
                        $("#edit_name").val(data.data.name);
                        $("#edit_email").val(data.data.email);
                        $("#edit_address").val(data.data.address);
                        $("#edit_phone").val(data.data.phone);
                        $("#edit_designation").val(data.data.designation);
                        $("#img").html(`<img src="{{ asset('storage/teams') }}/` + data.data
                            .images + `"alt='teams' width="100" height="100">`);
                    }
                });
            });
            // ==========================Show Data in Edit Modal End======================================


            // ==========================Update Data in Edit Modal Start======================================

            $("#editEmployee").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData(this);
                // console.log(formdata);
                $("#btnUpdate").prop("disabled", true);
                $("#btnUpdate").text("Updating...");
                $.ajax({
                    method: "POST",
                    url: "{{ url('admin/employee/edit') }}",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Employee has been updated",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }
                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $("#btnUpdate").prop("disabled", false);
                            $("#btnUpdate").text("Update");
                        }
                    }
                });
            });
            // ==========================Update Data in Edit Modal End======================================

            // ==========================Delete Data in Delete Modal Start======================================
            $(document).on("click", ".deleteEmployee", function() {
                var id = $(this).attr("data-id");
                Swal.fire({
                    icon:"warning",
                    title:"Are you Sure ?",
                    text:"You won't be able to rever this!",
                    showCancelButton:true,
                    confirmButtonText:"Yes,Delete it!",
                    confirmButtonColor:"#3085d6",
                    cancelButtonColor:"#d33"
                }).then((result)=>{
                    if(result.isConfirmed){
                        $.ajax({
                        method: "get",
                        url: '/admin/employee/delete/' + id,
                        success: function(data) {
                            // console.log(data);
                            if (data.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted successfully",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                               table.draw();
                            }
                            if (data.success == false) {
                                Swal.fire({
                                    icon: "warning",
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#btnDelete").prop("disabled", false);
                                $("#btnDelete").text("Confirm Delete");
                            }
                        }
                    })
                    }
                })
            })
            // ==========================Delete Data in Delete Modal Start======================================

            // Status Toggle Button
            $(document).on("click",".statusCheckBoxBtn",function(){
                let id=$(this).attr("data-id");
                $.ajax({
                    type:"get",
                    url:"/admin/employee/status/update/"+id,
                    success:function(response){
                        table.draw();
                    },
                    error:function(xhr){
                        console.log(xhr);
                    }
                })
            })
        });
    </script>
@endsection
