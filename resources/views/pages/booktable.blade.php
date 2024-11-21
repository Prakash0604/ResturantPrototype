@extends('index')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-success btn-lg bg-gray-100 mt-3 mb-3" data-bs-toggle="modal"
                    data-bs-target="#modalId">
                    <i class="bi bi-plus-lg"></i>
                    Add Table
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="addTable" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Add Table
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="mb-3">
                                            @csrf
                                            <label for="" class="form-label">Table Number</label>
                                            <input type="name" name="table_number" class="form-control"
                                                placeholder="Enter the table number" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Seat Capaicty</label>
                                            <input type="number" name="seat_capicity" class="form-control"
                                                placeholder="Enter the capacity " />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Status</label>
                                            <select class="form-select form-select-lg" name="status" id="">
                                                <option selected>Select one</option>
                                                <option selected value="Available">Available</option>
                                                <option value="Occupied">Occupied</option>
                                                <option value="Reserved">Reserved</option>
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

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered" id="fetch-table-lists">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            S.N
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Table Number</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Seat Capicity
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Datatables
            var table = $("#fetch-table-lists").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.table') }}",
                columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                }, {
                    data: "table_number",
                    name: "table_number"
                }, {
                    data: "seat_capicity",
                    name: "seat_capicity"
                }, {
                    data: "status",
                    name: "status",
                    fetch: function(data) {
                        if (data == 'Available') {
                            return `<span class="badge badge-success">Available</span>`;
                        } else {
                            return `<span class="badge badge-danger">Reserved</span>`;
                        }
                    }
                }, {
                    data: "action",
                    name: "action"
                }]
            })
            $("#addTable").submit(function(event) {
                event.preventDefault();
                $("#btnsave").text("Saving...");
                $("#btnsave").prop("disabled", true);
                let formdata = new FormData(this);
                $.ajax({
                    method: "POST",
                    url: "table/add",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Table Saved successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            table.draw();
                            $("#addTable")[0].reset();
                            $("#modalId").modal("hide");
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong ?",
                            });
                            $("#btnsave").text("Save");
                            $("#btnsave").prop("disabled", false);
                        }

                    }
                })
            });

            // Delete Table
            $(document).on('click', '.deleteTable', function() {
                let id = $(this).attr("data-id");
                console.log(id);
                Swal.fire({
                    icon: "warning",
                    title: "Are you Sure ?",
                    text: "You can't revert this change!",
                    showCancelButton: true,
                    confirmButtonText: "Yes,Delete it!",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "get",
                            url: "table/delete/" + id,
                            success: function(data) {
                                // console.log(data);
                                if (data.success == true) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Table Deleted Successfully !",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                  table.draw();
                                }
                                if (data.success == false) {
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Something Went Wrong !",
                                        text:"Already Tagged in another module !"
                                    });
                                    $("#btndelete").text("Confirm Delete");
                                    $("#btndelete").prop("disabled", false);
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection
