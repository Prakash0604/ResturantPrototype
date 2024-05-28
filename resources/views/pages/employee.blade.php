@extends('index')
@section('content')
    <div class="container-fluid py-4">
        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
            <i class="bi bi-plus-lg"></i>
            Add Employee
        </button>

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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employee Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Contact Info</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Designation</th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($employees as $emp)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($emp->images != '')
                                                            <img src="{{ asset('storage/teams/' . $emp->images) }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        @elseif($emp->images != '')
                                                            <img src="{{ asset('storage/images/' . $emp->images) }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        @else
                                                            <img src="{{ asset('default/user.png') }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        @endif

                                                    </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $emp->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $emp->email }}</p>
                                                </div>
                        </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $emp->address }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $emp->phone }}</p>
                            </div>
                        </td>

                        <td class="align-middle text-center text-sm">
                            @if ($emp->is_verified == 1)
                                <span class="badge badge-sm bg-gradient-success">
                                    Active
                                </span>
                            @else
                                <span class="badge badge-sm bg-gradient-danger">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $emp->designation }}</span>
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-primary editEmployee" data-id="{{ $emp->id }}" data-bs-toggle="modal"
                                data-bs-target="#editModal">Edit</a>
                            <a class="btn btn-danger deleteEmployee" data-id="{{ $emp->id }}" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">Delete</a>
                        </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
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


    {{-- ==================================Employee Delete Modal Start==================================== --}}

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteEmployee">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Delete Employee
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            @csrf
                            <h5>Are you sure your want to delete ?</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <button type="submit" class="btn btn-danger" id="btnDelete"> <i class="bi bi-floppy2-fill"></i>
                            Confirm Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ==================================Employee Delete Modal End==================================== --}}



    <script>
        $(document).ready(function() {
            // e.preventDefault();
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
                $("#deleteEmployee").submit(function(e) {
                    e.preventDefault();
                    $("#btnDelete").prop("disabled", true);
                    $("#btnDelete").text("Deleting...");
                    $.ajax({
                        method: "get",
                        url: "{{ url('admin/employee/delete') }}/" + id,
                        success: function(data) {
                            // console.log(data);
                            if (data.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted successfully",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
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
                })
            })
            // ==========================Delete Data in Delete Modal Start======================================
        });
    </script>
@endsection
