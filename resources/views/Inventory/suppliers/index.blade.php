@extends('index')

@section('content')
    <div class="container">
        <h2>Suppliers Management</h2>

        <!-- Add Supplier Button -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSupplierModal">Add Supplier</button>

        <!-- Suppliers Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n=1;
                @endphp
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td>{{ $n++ }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $supplier->id }}"
                                data-bs-toggle="modal" data-bs-target="#editSupplierModal">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $supplier->id }}">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No data found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $suppliers->links() }}
        </div>

        <!-- Add Supplier Modal -->
        <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSupplierModalLabel">Add Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addSupplierForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Supplier Modal -->
        <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editSupplierForm">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="edit_phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_address" class="form-label">Address</label>
                                <textarea class="form-control" id="edit_address" name="address"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary updateBtn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Add Supplier
            $('#addSupplierForm').on('submit', function(e) {
                e.preventDefault();
                $("#btnSave").text("Saving....");
                $("#btnSave").prop("disabled", true);

                $.ajax({
                    url: "{{ route('suppliers.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // alert(response.success);
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Supplier Added successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#addSupplierModal').modal('hide');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);

                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong ?",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                            $("#btnSave").text("Save");
                            $("#btnSave").prop("disabled", false);
                        }
                    }
                });
            });

            // Edit Supplier - Fetch Data
            $('.edit-btn').on('click', function() {
                let id = $(this).data('id');
                $.get('/suppliers/' + id, function(data) {
                    $('#edit_name').val(data.name);
                    $('#edit_email').val(data.email);
                    $('#edit_phone').val(data.phone);
                    $('#edit_address').val(data.address);
                    $('#editSupplierForm').attr('action', '/suppliers/' + id);
                });
            });

            // Update Supplier
            $('#editSupplierForm').on('submit', function(e) {
                e.preventDefault();
                $(".updateBtn").text("Updating....");
                $(".updateBtn").prop("disabled", true);
                let actionUrl = $(this).attr('action');
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // alert(response.success);
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Supplier Updated successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#editSupplierModal').modal('hide');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);

                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong ?",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                            $(".updateBtn").text("Save");
                            $(".updateBtn").prop("disabled", false);
                        }
                    }
                });
            });

            // Delete Supplier
            $('.delete-btn').on('click', function() {
                let id = $(this).data('id');
                $("#btnSave").text("Deleting....");
                $("#btnSave").prop("disabled", true);
                if (confirm('Are you sure you want to delete this supplier?')) {
                    $.ajax({
                        url: '/suppliers/' + id,
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // alert(response.success);
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Supplier Deleted successfully",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);

                            } else {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Something went wrong ?",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
