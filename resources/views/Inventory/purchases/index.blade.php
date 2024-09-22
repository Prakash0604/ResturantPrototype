@extends('index')

@section('content')
    <div class="container">
        <h1 class="text-center">Purchases</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#purchaseModal">Add Purchase</button>

        <!-- Purchases Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Purchase Date</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->purchase_date }}</td>
                        <td>Rs.{{ $purchase->total_price }}/only</td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="viewPurchase({{ $purchase->id }})">View</button>
                            <button class="btn btn-warning btn-sm" onclick="editPurchase({{ $purchase->id }})">Edit</button>
                            <button class="btn btn-danger btn-sm"
                                onclick="deletePurchase({{ $purchase->id }})">Delete</button>
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

    <!-- Add Modal -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="purchaseForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="purchaseModalLabel">Add/Edit Purchase</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option value="">Please Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="purchase_date">Purchase Date</label>
                            <input type="date" name="purchase_date" id="purchase_date" class="form-control">
                        </div>

                        <h6 class="mt-1">Ingredients</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ingredient</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ingredientRows">
                                <tr>
                                    <td>
                                        <select name="ingredients[]" class="form-control ingredient-select">
                                            @foreach ($ingredients as $ingredient)
                                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" name="quantity[]" class="form-control quantity-input"
                                            placeholder="Quantity">
                                    </td>
                                    <td><input type="number" name="price[]" class="form-control price-input"
                                            placeholder="Price"></td>
                                    <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="addMoreIngredients" class="btn btn-primary">Add More Ingredients</button>
                        <div class="form-group mb-3 mt-3">
                            <label for="total_price">Total Price</label>
                            <input type="number" name="total_price" id="total_price" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="editPurchaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editPurchaseForm" method="POST" action="/purchases/update"> <!-- Set correct action -->
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPurchaseModalLabel">Edit Purchase</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="form-control" required>
                                <!-- Populate suppliers -->
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purchase_date">Purchase Date</label>
                            <input type="date" name="purchase_date" id="purchase_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ingredient</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="editIngredientsContainer">

                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-secondary" id="addMoreIngredientsEdit">Add More
                            Ingredients</button>
                        <div class="form-group mt-3">
                            <label for="total_price">Total Price</label>
                            <input type="number" name="total_price" id="total_price_edit" class="form-control"
                                readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnUpdate">Update Purchase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Edit Modal --}}

    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Purchase Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="purchaseDetails">
                    <table>
                        <tr>
                            <th>Supplier Name :</th>
                            <td class="supplier_name_detail"></td>
                        </tr>
                        <tr>
                            <th>Purchase Date :</th>
                            <td class="purchase_date_detail"></td>
                        </tr>
                        <tr>
                            <th>Total Price :</th>
                            <td class="total_price_detail"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to calculate total price dynamically
        function calculateTotalPrice() {
            let totalPrice = 0;

            // Loop through each row and sum the total price
            $('#ingredientRows tr').each(function() {
                const quantity = $(this).find('.quantity-input').val();
                const price = $(this).find('.price-input').val();

                if (quantity && price) {
                    totalPrice += quantity * price;
                }
            });

            // Set the total price in the total_price input field
            $('#total_price').val(totalPrice.toFixed(2)); // Display total price with 2 decimal places
        }

        // Add more ingredients (clone row)
        $('#addMoreIngredients').on('click', function() {
            let newRow = `<tr>
            <td>
                <select name="ingredients[]" class="form-control ingredient-select">
                    @foreach ($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="quantity[]" class="form-control quantity-input" placeholder="Quantity"></td>
            <td><input type="number" name="price[]" class="form-control price-input" placeholder="Price"></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
        </tr>`;

            $('#ingredientRows').append(newRow);
            calculateTotalPrice();
        });

        // Remove row functionality
        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
            calculateTotalPrice();
        });

        // Trigger price calculation when quantity or price input changes
        $(document).on('input', '.quantity-input, .price-input', function() {
            calculateTotalPrice();
        });

        // Handle form submission
        $('#purchaseForm').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize(); // Serialize form data
            $("#btnSave").text("Saving...");
            $("#btnSave").prop("disabled",true);
            // AJAX request to submit the purchase data
            $.ajax({
                url: '/purchases/store', // Replace with your route
                method: 'POST',
                data: formData,
                success: function(response) {
                    // alert('Purchase saved successfully!');
                    // console.log(response);
                    if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Purchase saved successfully",
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
                                $("#btnSave").text("Save");
                                $("#btnSave").prop("disabled", false);
                            }
                    $('#purchaseModal').modal('hide'); // Hide the modal
                },

            });
        });

        // Edit

        function calculateEditTotalPrice() {
            let totalPrice = 0;

            // Loop through each row and sum the total price
            $('#editIngredientsContainer tr').each(function() {
                const quantity = $(this).find('.quantity-input').val();
                const price = $(this).find('.price-input').val();

                if (quantity && price) {
                    totalPrice += quantity * price;
                }
            });

            // Set the total price in the total_price input field
            $('#total_price_edit').val(totalPrice.toFixed(2));
        }

        function editPurchase(id) {
            $.ajax({
                url: '/purchases/edit/' + id,
                type: 'GET',
                success: function(response) {
                    const purchase = response.purchase;
                    const ingredients = response.ingredients;

                    // Populate the modal fields with the purchase data
                    $('#editPurchaseModal #supplier_id').val(purchase.supplier_id);
                    $('#editPurchaseModal #purchase_date').val(purchase.purchase_date);
                    $('#editPurchaseModal #total_price_edit').val(purchase.total_price);

                    // Clear existing ingredient fields
                    $('#editIngredientsContainer').empty();

                    // Populate ingredient fields
                    purchase.details.forEach(function(detail) {
                        $('#editIngredientsContainer').append(`
                        <tr> <td><select name="ingredients[]" class="form-control">
                            ${ingredients.map(ingredient =>
                                `<option value="${ingredient.id}" ${ingredient.id === detail.ingredient_id ? 'selected' : ''}>${ingredient.name}</option>`
                            ).join('')}
                        </select></td>
                        <td>
                        <input type="number" name="quantity[]" class="form-control quantity-input" value="${detail.quantity}" placeholder="Quantity"></td>
                        <td>
                        <input type="number" name="price[]" class="form-control price-input" value="${detail.price}" placeholder="Price"></td>
                        <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                        </tr>`);
                        calculateEditTotalPrice();
                    });

                    // Show the modal
                    $('#editPurchaseModal').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Failed to load purchase data.');
                }
            });

            // Update
            $('#editPurchaseForm').on('submit', function(event) {

                event.preventDefault(); // Prevent the default form submission
                $(".btnUpdate").text("Updating...");
                $(".btnUpdate").prop("disabled",true);

                const formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    url: '/purchases/update/' + id, // Adjust this URL to your update route
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            if (response.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Purchase Updated successfully",
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
                                $(".btnUpdate").text("Update Purchase");
                                $(".btnUpdate").prop("disabled",false);
                            }
                            $('#editPurchaseModal').modal('hide'); // Close the modal
                        }
                    },
                });
            });
        }

        $('#addMoreIngredientsEdit').click(function() {
            $('#editIngredientsContainer').append(`
            <tr>
                <td>
            <select name="ingredients[]" class="form-control" required>
                @foreach ($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                @endforeach
            </select>
            </td>
            <td>
            <input type="number" name="quantity[]" class="form-control quantity-input" placeholder="Quantity" required></td>
            <td>
            <input type="number" name="price[]" class="form-control price-input" placeholder="Price" required></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
            </tr>`);
            calculateEditTotalPrice();
        });

        // Delete Purchase
        function deletePurchase(id) {
            if (confirm('Are you sure you want to delete this purchase?')) {
                $.ajax({
                    url: `/purchases/destroy/${id}`,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        }

        // View Purchase
        function viewPurchase(id) {
            $.ajax({
                url: `/purchases/show/${id}`,
                method: 'GET',
                success: function(purchase) {
                    // Populate the modal with purchase details
                    let details = `
                    <table class="table table-bordered">
                        <tr>
                            <th>Supplier Name :</th>
                            <td class="supplier_name_detail">${purchase.supplier.name}</td>
                        </tr>
                        <tr>
                            <th>Purchase Date :</th>
                            <td class="purchase_date_detail">${purchase.purchase_date}</td>
                        </tr>
                        <tr>
                            <th>Total Price :</th>
                            <td class="total_price_detail">${purchase.total_price}</td>
                        </tr>
                    </table>`;
                    purchase.details.forEach(function(detail) {
                        details +=
                            `
                            <ul class="list-group list-group-horizontal mb-2 mt-2">
                            <li class="list-group-item"><b>Ingrediance:</b> ${detail.ingredient.name}</li>
                            <li class="list-group-item"><b>Quantity:</b> ${detail.quantity}</li>
                            <li class="list-group-item"><b>Rate:</b> ${detail.price}</li>
                           </ul>
                            `;
                    });
                    details += `</ul>`;
                    $('#purchaseDetails').html(details);
                    $('#viewModal').modal('show');
                }
            });
        }
    </script>
@endsection
