@extends('index')

@section('content')
    <div class="container">
        <h2 class="text-center">Ingredients Inventory</h2>

        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#ingredientModal">
            Add New Ingredient
        </button>

        <!-- Ingredients Table -->
        <div class="card p-2 mt-3">
            <table class="table mt-3 table-striped" id="fetch-ingrediance-list">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

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
           var table= $("#fetch-ingrediance-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ingredients.index') }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex"
                    },
                    {
                        data: "name",
                        name: "name"
                    }, {
                        data: "quantity",
                        name: "quality"
                    }, {
                        data: "unit",
                        name: "unit"
                    }, {
                        data: "action",
                        name: "action"
                    }
                ]
            })
            // Submit the ingredient form using AJAX
            $('#ingredientForm').on('submit', function(e) {
                e.preventDefault();
                $("#ingredientsadd").text("Saving...");
                $("#ingredientsadd").prop("disabled", true);

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

                           table.draw();
                           $("#ingredientForm")[0].reset();
                           $("#ingredientModal").modal("hide");

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
            $(document).on('click',".deleteIngrediance", function() {
                let id = $(this).data('id');
                Swal.fire({
                    icon: "warning",
                    title: "Are you Sure ?",
                    text: "You won't be able to rever this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Yes,Delete it !",
                    cancelButtonColor: "#d33",
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                   table.draw();

                                } else {
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Something went wrong ?",
                                    });
                                    $("#ingredientsadd").text("Save");
                                    $("#ingredientsadd").prop("disabled", false);
                                }

                                $('#ingredient-' + id).remove();
                            }
                        });
                    }
                })

            });
        });
    </script>
@endsection
