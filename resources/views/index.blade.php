<!doctype html>
<html lang="en">

<head>
    <title>Resturant Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('sidebar/css/style.css') }}">
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
                        <a href="{{ url('admin/employee/list') }}"><span class="fa fa-home mr-3"></span> Employee</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/add/menu') }}"><span class="fa fa-user mr-3"></span> Menus</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/table') }}"><span class="fa fa-briefcase mr-3"></span>Table </a>
                    </li>
                    <li>
                        <a href="{{ route('orders') }}"><span class="fa fa-sticky-note mr-3"></span> Order List</a>
                    </li>
                    <li>
                        <a href="{{ route('bills.index') }}"><span class="fa fa-paper-plane mr-3"></span> Billing</a>
                    </li>
                    <li>
                    <li>
                        <a href="{{ url('admin/profile') }}"><span class="fa fa-paper-plane mr-3"></span> Profile</a>
                    </li>
                    <li>
                    <a href="{{ url('logout') }}"><span class="fa fa-paper-plane mr-3"></span> LogOut</a>
                    </li>
                </ul>

                <div class="footer">

                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
           <div class="container">
            @yield('content')
           </div>
        </div>
    </div>

    <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>
    <script src="{{ asset('sidebar/js/jquery.min.js') }}"></script>
    <script src="{{ asset('sidebar/js/popper.js') }}"></script>
    <script src="{{ asset('sidebar/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sidebar/js/main.js') }}"></script>
</body>

</html>
