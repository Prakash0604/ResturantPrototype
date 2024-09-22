@extends('index')

@section('content')
    <div class="container">
        <h2>Stock Management</h2>

        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stockModal">
            Add New Stock
        </button>

        <!-- Stocks Table -->
        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Ingredient</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="stockTable">
                @php
                    $n=1;
                @endphp
                @foreach ($stocks as $stock)
                    <tr id="stock-{{ $stock->id }}">
                        <td>{{ $n++ }}</td>
                        <td>{{ $stock->ingredient->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->unit }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $stock->id }}"
                                data-bs-toggle="modal" data-bs-target="#editStockModal">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $stock->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $stocks->links() }}
        </div>

        <!-- Modal for Adding Stock -->
        <div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stockModalLabel">Add New Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Stock Form Inside Modal -->
                        <form id="stockForm">
                            @csrf
                            <div class="mb-3">
                                <label for="ingredient_id" class="form-label">Ingredient</label>
                                <select class="form-control" id="ingredient_id" name="ingredient_id" required>
                                    <option value="">Select Ingredient</option>
                                    @foreach ($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" step="any" class="form-control" id="quantity" name="quantity"
                                    placeholder="Quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="text" class="form-control" id="unit" name="unit"
                                    placeholder="Unit (kg, liter, etc.)" required>
                            </div>
                            <button type="submit" id="stockAddBtn" class="btn btn-primary">Add Stock</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Stock -->
    <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStockModalLabel">Edit Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Stock Form Inside Modal -->
                    <form id="editStockForm">
                        @csrf
                        @method('PUT') <!-- Spoof the PUT method -->
                        <div class="mb-3">
                            <label for="edit_ingredient_id" class="form-label">Ingredient</label>
                            <select class="form-control" id="edit_ingredient_id" name="ingredient_id" required>
                                <option value="">Select Ingredient</option>
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_quantity" class="form-label">Quantity</label>
                            <input type="number" step="any" class="form-control" id="edit_quantity" name="quantity"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="edit_unit" name="unit" required>
                        </div>
                        <button type="submit" class="btn btn-primary editUpdateBtn">Update Stock</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Submit the stock form using AJAX
            $('#stockForm').on('submit', function(e) {
                e.preventDefault();
                $("#stockAddBtn").text("Saving");
                $("#stockAddBtn").prop("disabled", false);

                $.ajax({
                    url: "{{ route('stocks.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#stockModal').modal('hide');
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Stock added successfully",
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
                            $("#stockAddBtn").text("Save");
                            $("#stockAddBtn").prop("disabled", false);
                        }
                    }
                });
            });

            // Delete stock
            $('.delete-btn').on('click', function() {
                if (confirm('Are you sure you want to delete this stock?')) {
                    let id = $(this).data('id');

                    $.ajax({
                        url: '/admin/stocks/' + id,
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // alert(response.success);
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Stock deleted successfully",
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
                                $("#stockAddBtn").text("Save");
                                $("#stockAddBtn").prop("disabled", false);
                            }
                            $('#stock-' + id).remove();
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            // Fetch data and open the edit modal
            $('.edit-btn').on('click', function() {
                let id = $(this).data('id');

                // Fetch stock details via AJAX
                $.get('/admin/stocks/' + id, function(data) {
                    $('#edit_ingredient_id').val(data.ingredient_id);
                    $('#edit_quantity').val(data.quantity);
                    $('#edit_unit').val(data.unit);
                    $('#editStockForm').attr('action', '/admin/stocks/' + id); // Update form action URL
                });
            });

            // Submit the edit stock form using AJAX
            $('#editStockForm').on('submit', function(e) {
                e.preventDefault();
                let actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // alert(response.success);
                        $('#editStockModal').modal('hide');
                        if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Stock updated successfully",
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
                                $(".editUpdateBtn").text("Save");
                                $(".editUpdateBtn").prop("disabled", false);
                            }
                    }
                });
            });

            // Other existing AJAX calls for adding and deleting...
        });
    </script>
@endsection
