@extends('index')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <div class="container bg-white ">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-lg mt-4" data-bs-toggle="modal" data-bs-target="#modalId">
            Order Item
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Order Items
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form id="orderItems">
                                <div class="mb-3">
                                    <label for="" class="form-label">Table</label>
                                    <select class="form-select form-select-lg" name="table_no" id="tableSelect">
                                        <option selected>Select one</option>
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}">{{ $table->table_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 menu-row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Menus</th>
                                                    <th scope="col">Action </th>
                                                </tr>
                                            </thead>
                                            <tbody class="fetchmenu">

                                                <tr class="">
                                                    <td scope="row"><select class="form-select form-select-lg mb-2"
                                                            name="" id="menus">
                                                            <option selected>Select one</option>
                                                            @foreach ($menus as $menu)
                                                                <option value="{{ $menu->id }}">{{ $menu->name }}
                                                                </option>
                                                            @endforeach
                                                        </select></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger"
                                                            disabled>Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-warning mt-3" type="button" id="addMore">Add More</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Cards Table Start --}}
    <div class="row">
        @foreach ($orders as $orderGroup)
            <div class="card text-center col-6 mt-4 p-3">
                <div class="card-header text-white bg-secondary">
                    <h4 class="text-white">{{ $orderGroup->first()->order->table->table_number }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary text-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Menu Items</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderGroup as $order)
                                    <tr class="">
                                        <td scope="row">{{ $order->menu->name }}</td>
                                        <td scope="row">{{ $order->menu->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h5 class="card-title">Seat Capacity: {{ $orderGroup->first()->order->table->seat_capicity }}</h5>
                    @if ($orderGroup->first()->status ==0)
                    <a class="btn btn-primary totalBills mb-4 text-white" data-bs-toggle="modal" data-bs-target="#totalBillModal"
                    data-id="{{ $orderGroup->first()->order_id }}">Total Bill</a><br>

                    <a class="btn btn-warning  editOrderItemBtn " data-id="{{ $orderGroup->first()->order_id }}"
                        data-bs-toggle="modal" data-bs-target="#editOrderItemModal">Edit
                        Order</a>

                    <a class="btn btn-danger deleteOrders " data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-id="{{ $orderGroup->first()->order_id }}">Delete Order</a>
                        @endif
                </div>
                <div class="card-footer text-body-secondary bg-secondary text-white">
                    Bill status: <span
                        class="badge bg-{{ $orderGroup->first()->status ? 'success' : 'danger' }}">{{ $orderGroup->first()->status ? 'Paid' : 'Pending' }}</span>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Cards Table End --}}

    {{-- Delete Orders --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary ">
                    <h5 class="modal-title text-white" id="modalTitleId">
                        Delete Order Items
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <h5 class="text-danger">Are you sure you want to delete orders ?</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger confirmDelete">Confirm Delete</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Delete Orders --}}


    {{-- Edit Modal Start --}}
    <div class="modal fade" id="editOrderItemModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editOrderItemsForm">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white" id="modalTitleId">Edit Order Table</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Menus</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="orderItemsContainer">
                                    {{-- Order items will be loaded here via JS --}}
                                </tbody>
                            </table>
                            <button class="btn btn-warning mt-3 addMore" type="button">Add More</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btnUpdate">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Modal End --}}


    <!-- Total Bill Modal -->
    <div class="modal fade" id="totalBillModal" tabindex="-1" role="dialog" aria-labelledby="totalBillModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="saveOrderBill">
                    <div class="modal-header">
                        <h5 class="modal-title" id="totalBillModalLabel">Total Bill</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Menu Item</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody id="billItemsContainer">
                                    <!-- Menu items will be populated here dynamically -->
                                </tbody>
                            </table>
                        </div>
                        @csrf

                        <!-- Tax, Discount, Service Charge -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tax">Tax (%)</label>
                                <input type="number" id="tax" name="tax" class="form-control"
                                    value="0">
                            </div>
                            <div class="col-md-4">
                                <label for="discount">Discount (%)</label>
                                <input type="number" id="discount" name="discount" class="form-control"
                                    value="0">
                            </div>
                            <div class="col-md-4">
                                <label for="serviceCharge">Service Charge (%)</label>
                                <input type="number" id="serviceCharge" name="service_charge" class="form-control"
                                    value="0">
                            </div>
                        </div>

                        <!-- Total Calculation -->
                        <div class="mt-3">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Sub Total:</th>
                                    <td><input type="number" name="subTotal" class="form-control" id="subTotal"
                                            readonly value=""> </td>
                                </tr>
                                <tr>
                                    <th>Tax Amount:</th>
                                    <td><span id="taxAmount"> </td>
                                </tr>
                                <tr>
                                    <th>Discount Amount:</th>
                                    <td><span id="discountAmount"></span> </td>
                                </tr>
                                <tr>
                                    <th>Service Charge Amount:</th>
                                    <td><span id="serviceChargeAmount"></span></td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td><input type="number" name="totalAmount" class="form-control" id="totalAmount"
                                            readonly value=""> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Generate Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Total Bill Modal -->
    </div>




    <script>
        $(document).ready(function() {
            $("#addMore").on("click", function() {
                $(".fetchmenu").append(`
            <tr class="">
                <td scope="row">
                    <select class="form-select form-select-lg mb-2" name="menus[]" id="menus">
                        <option selected>Select one</option>
                        @foreach ($menus as $menu) <option value="{{ $menu->id }}">{{ $menu->name }}</option>  @endforeach
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeMenu">Remove</button>
                </td>
            </tr>
        `);
            });

            $(".fetchmenu").on("click", ".removeMenu", function() {
                $(this).closest("tr").remove();
            });


            $('#saveButton').click(function() {
                $("#saveButton").prop("disabled", true);
                $("#saveButton").text("saving...");
                var tableNo = $('#tableSelect').val();
                var menuItems = [];

                $('.fetchmenu select').each(function() {
                    menuItems.push($(this).val());
                });

                $.ajax({
                    url: '/save-order',
                    method: 'POST',
                    data: {
                        table_no: tableNo,
                        menu_items: menuItems,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // alert(response.message);
                        // console.log(response);
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Order saved Successfully",
                                showConfirmButton: false,
                                timer: 1500,
                            });

                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        }
                    },
                });
            });

            $(".deleteOrders").on("click", function() {
                let id = $(this).attr("data-id");
                console.log(id);
                $(".confirmDelete").on("click", function(event) {
                    event.preventDefault();
                    $(".confirmDelete").text("Deleting...");
                    $(".confirmDelete").prop("disabled", true);
                    $.ajax({
                        url: "/admin/delete/orders/" + id,
                        method: "get",
                        success: function(data) {
                            // console.log(data);
                            if (data.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Order has been deleted",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Something went wrong",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $(".confirmDelete").text("Confirm Delete");
                                $(".confirmDelete").prop("disabled", false);

                            }
                        }
                    })
                })
            })
        });

        $(document).ready(function() {
            // Function to open the edit modal and load existing order items
            $('.editOrderItemBtn').on('click', function() {
                var orderId = $(this).data('id');

                // Clear the table before adding new content
                $('#orderItemsContainer').html('');

                // Fetch order items via AJAX
                $.ajax({
                    url: '/order-items/' + orderId + '/edit',
                    type: 'GET',
                    success: function(response) {
                        response.orderItems.forEach(function(orderItem) {
                            $('#orderItemsContainer').append(`
                                <tr>
                                    <td>
                                        <select class="form-select form-select-lg mb-2" name="menu_id[]">
                                            @foreach ($menus as $menu)
                                                <option value="{{ $menu->id }}" ${orderItem.menu_id == {{ $menu->id }} ? 'selected' : ''}>{{ $menu->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removeRow">Remove</button>
                                    </td>
                                </tr>
                            `);
                        });

                        // Show the modal
                        $('#editOrderItemModal').modal('show');
                    }
                });
            });

            // Add new menu row in the edit modal
            $(document).on('click', '.addMore', function() {
                $('#orderItemsContainer').append(`
                    <tr>
                        <td>
                            <select class="form-select form-select-lg mb-2" name="menu_id[]">
                                <option selected>Select one</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removeRow">Remove</button>
                        </td>
                    </tr>
                `);
            });

            // Remove a menu row
            $(document).on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });

            // Update order items via AJAX
            $('#editOrderItemsForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize(); // Serialize form data
                var orderId = $('.editOrderItemBtn').data('id'); // Get order ID
                $('.btnUpdate').text("Updating...");
                $(".btnUpdate").prop("disabled", true);

                $.ajax({
                    url: '/order-items/' + orderId,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#editOrderItemModal').modal('hide'); // Close modal
                            setTimeout(function() {
                                location.reload(); // Reload the page
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        alert(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[0]]);
                    }
                });
            });
        });


        $(document).ready(function() {
            // Function to open the total bill modal and load the menu items
            $(document).on('click', '.totalBills', function() {
                let orderId = $(this).attr('data-id');
                // console.log(orderId);
                loadBillDetails(orderId); // Fetch order details
            });

            // Fetch order details and populate the bill modal
            function loadBillDetails(orderId) {
                $.ajax({
                    url: '/get-order-details/' + orderId, // Modify according to your route
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#billItemsContainer').html(''); // Clear the table
                        var subTotal = 0;

                        response.orderItems.forEach(function(item) {
                            subTotal += parseFloat(item.menu.price); // Calculate subTotal
                            $('#billItemsContainer').append(
                                `<tr>
                            <td>
                                <input type="hidden" name="tables_id[]" value="${item.order.id}">
                                <input type="hidden" name="menus_id[]" value="${item.menu.id}">
                                 <input type="text" class="form-control"  value="${item.menu.name}" readonly/>
                            </td>
                            <td> <input type="number" class="form-control" name="price[]"  value="${item.menu.price}" readonly/></td>
                        </tr>`
                            );
                        });

                        $('#subTotal').val(subTotal.toFixed(2)); // Update subTotal
                        calculateTotal(); // Recalculate the total bill
                        $('#totalBillModal').modal('show');
                    }
                });
            }

            // Function to calculate the total bill including tax, discount, and service charge
            function calculateTotal() {
                var subTotal = parseFloat($('#subTotal').val());
                var tax = parseFloat($('#tax').val()) || 0;
                var discount = parseFloat($('#discount').val()) || 0;
                var serviceCharge = parseFloat($('#serviceCharge').val()) || 0;

                var taxAmount = (subTotal * tax) / 100;
                var discountAmount = (subTotal * discount) / 100;
                var serviceChargeAmount = (subTotal * serviceCharge) / 100;

                var totalAmount = subTotal + taxAmount + serviceChargeAmount - discountAmount;

                $('#taxAmount').text(taxAmount.toFixed(2));
                $('#discountAmount').text(discountAmount.toFixed(2));
                $('#serviceChargeAmount').text(serviceChargeAmount.toFixed(2));
                $('#totalAmount').val(totalAmount.toFixed(2));
            }

            // Trigger calculation when values are updated
            $('#tax, #discount, #serviceCharge').on('input', function() {
                calculateTotal();
            });

            $("#saveOrderBill").submit(function(event) {
                event.preventDefault();
                // var formdata=new FormData(this);
                var formdata = $(this).serialize();
                console.log(formdata);
                $.ajax({
                    url: '/get-order-details/save', // Replace with your actual save route
                    type: 'POST',
                    data: formdata,
                    success: function(response) {
                    console.log(response);
                    if (response.success==true) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                location.reload(); // Reload the page
                            }, 1500);
                        }
                    },
                });
            })

        });
    </script>
@endsection
