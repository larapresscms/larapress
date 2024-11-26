<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ $settingsAdmin->fav_icon ?? asset('packages/larapress/src/Assets/admin/img/fav.png') }}">

    <title>{{ $settingsAdmin->site_title ?? ''}} Authentication</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('packages/larapress/src/Assets/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('packages/larapress/src/Assets/admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('packages/larapress/src/Assets/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
    <style>
        .bg-gradient-primary{
            background-color:{{ $settingsAdmin->dashboard_color ?? 'none'}};
            background-image: none;
        }
        a.small, h1, h2, h3, h4, h5, h6, .sidebar-dark .nav-item .nav-link {
            color: {{ $settingsAdmin->text_color ?? 'None'}} !important;
        }
        .sidebar-dark .nav-item .nav-link:focus, .sidebar-dark .nav-item .nav-link:hover {
            color: {{ $settingsAdmin->text_hover ?? 'None'}};
        }
        .sidebar-dark .nav-item .nav-link i {
            color: {{ $settingsAdmin->text_color ?? 'None'}};
        }
        .sidebar-dark .nav-item .nav-link:focus i, .sidebar-dark .nav-item .nav-link:hover i {
            color: {{ $settingsAdmin->text_hover ?? 'None'}};
        }
        .sidebar-dark .nav-item .nav-link[data-toggle="collapse"]::after {
            color: {{ $settingsAdmin->text_color ?? 'None'}};
        }
        #html, #css, #save{display:none}
        .sidebar-dark #sidebarToggle{background-color: {{ $settingsAdmin->text_color ?? 'None'}};}
        .sidebar-dark #sidebarToggle:hover {background-color: {{ $settingsAdmin->text_hover ?? 'None'}};}
        .text-posttype-color {
            color: {{ $settingsAdmin->text_color ?? 'None'}}
        }
        .border-left-color {
            border-left: 0.25rem solid {{ $settingsAdmin->text_color ?? 'None'}};
        }

        /* sidebar color  */
        .sidebar .nav-item .collapse .collapse-inner .collapse-header{
            color:
        }
        .btn:active, .btn:hover, .btn{
            color: {{ $settingsAdmin->dashboard_color ?? 'None'}} !important;
            background-color: {{ $settingsAdmin->text_color ?? 'None'}} !important;
            border-color: {{ $settingsAdmin->text_color ?? 'None'}} !important;
        }


    </style>

</head>

<body class="bg-gradient-primary" style="margin-top:20vh">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                   @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('packages/larapress/src/Assets/admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/chart.js/Chart.min.js')}}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('packages/larapress/src/Assets/admin/js/demo/chart-area-demo.js')}}"></script> -->
    <!-- <script src="{{ asset('packages/larapress/src/Assets/admin/js/demo/chart-pie-demo.js')}}"></script> -->

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script> -->
    <!-- <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('packages/larapress/src/Assets/admin/js/demo/datatables-demo.js')}}"></script> -->


</body>

</html>