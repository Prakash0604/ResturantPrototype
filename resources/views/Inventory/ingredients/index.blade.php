@extends('index')

@section('content')
    <div class="container">
        <h2>Ingredients Inventory</h2>

        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ingredientModal">
            Add New Ingredient
        </button>

        <!-- Ingredients Table -->
        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="ingredientTable">
                @php
                    $n=1;
                @endphp
                @foreach ($ingredients as $ingredient)
                    <tr id="ingredient-{{ $ingredient->id }}">
                        <td>{{ $n++ }}</td>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->quantity }}</td>
                        <td>{{ $ingredient->unit }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $ingredient->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal for Adding Ingredient -->
        <div class="modal fade" id="ingredientModal" tabindex="-1" aria-labelledby="ingredientModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ingredientModalLabel">Add New Ingredient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Ingredient Form Inside Modal -->
                        <form id="ingredientForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Ingredient Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Ingredient Name" required>
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
                            <button type="submit" id="ingredientsadd" class="btn btn-primary">Add Ingredient</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Submit the ingredient form using AJAX
            $('#ingredientForm').on('submit', function(e) {
                e.preventDefault();
                $("#ingredientsadd").text("Saving...");
                $("#ingredientsadd").prop("disabled",true);

                $.ajax({
                    url: "{{ route('ingredients.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#ingredientModal').modal('hide');
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Ingredient added successfully",
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
                            $("#ingredientsadd").text("Save");
                            $("#ingredientsadd").prop("disabled", false);
                        }
                    }
                });
            });

            // Delete ingredient
            $('.delete-btn').on('click', function() {
                if (confirm('Are you sure you want to delete this ingredient?')) {
                    let id = $(this).data('id');

                    $.ajax({
                        url: '/admin/ingredients/' + id,
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // alert(response.success);
                            if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Ingredient deleted successfully",
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
                            $("#ingredientsadd").text("Save");
                            $("#ingredientsadd").prop("disabled", false);
                        }

                            $('#ingredient-' + id).remove();
                        }
                    });
                }
            });
        });
    </script>
@endsection
