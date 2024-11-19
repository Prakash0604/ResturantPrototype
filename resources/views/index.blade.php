<!doctype html>
<html lang="en">

<head>
    <title>Resturant Management System</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('sidebar/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4">
                <h1><a href="{{ url('admin/dashboard') }}" class="logo">Dashboard</a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="{{ url('admin/employee/list') }}"><i class="bi bi-people-fill"></i> Employee</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/add/menu') }}"><i class="bi bi-list"></i> Menus</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/table') }}"><i class="bi bi-table"></i> Table </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}"><i class="bi bi-card-list"></i> Order List</a>
                    </li>
                    <li>
                        <a href="{{ route('bills.index') }}"><span class="bi bi-cash-stack"></span> Billing</a>
                    </li>
                    <li>
                        <a href="{{ route('ingredients.index') }}"><i class="bi bi-diagram-3"></i> Ingredient</a>
                    </li>
                    <li>
                        <a href="{{ route('stocks.index') }}"><i class="bi bi-calendar3-event-fill"></i> Stocks</a>
                    </li>
                    <li>
                        <a href="{{ route('suppliers.index') }}"><i class="bi bi-calendar3-event-fill"></i>
                            Supplier</a>
                    </li>
                    <li>
                        <a href="{{ route('purchases.index') }}"><i class="bi bi-gear-wide-connected"></i> Purchase</a>
                    </li>
                    <li>
                    <li>
                        <a href="{{ url('admin/profile') }}"><i class="bi bi-person-circle"></i> Profile</a>
                    </li>
                    <li>
                        <a href="{{ url('logout') }}"><i class="bi bi-box-arrow-in-right"></i> LogOut</a>
                    </li>
                </ul>

                <div class="footer">

                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5" style="background: linear-gradient(to right, #00c6ff, #0072ff);">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('sidebar/js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('sidebar/js/popper.js') }}"></script>
    <script src="{{ asset('sidebar/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sidebar/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

</body>

</html>
