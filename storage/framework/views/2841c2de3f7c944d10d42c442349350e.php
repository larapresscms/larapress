<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo e($settingsAdmin->fav_icon ?? asset('public/admin/img/fav.png')); ?>">

    <title><?php echo e($settingsAdmin->site_title ?? ''); ?> Authentication</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('public/admin/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('public/admin/css/sb-admin-2.min.css')); ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
    
    <style>
        .bg-gradient-primary{
            background-color:<?php echo e($settingsAdmin->dashboard_color ?? 'none'); ?>;
            background-image: none;
        }
        a.small, h1, h2, h3, h4, h5, h6, .sidebar-dark .nav-item .nav-link {
            color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?> !important;
        }
        .sidebar-dark .nav-item .nav-link:focus, .sidebar-dark .nav-item .nav-link:hover {
            color: <?php echo e($settingsAdmin->text_hover ?? 'None'); ?>;
        }
        .sidebar-dark .nav-item .nav-link i {
            color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?>;
        }
        .sidebar-dark .nav-item .nav-link:focus i, .sidebar-dark .nav-item .nav-link:hover i {
            color: <?php echo e($settingsAdmin->text_hover ?? 'None'); ?>;
        }
        .sidebar-dark .nav-item .nav-link[data-toggle="collapse"]::after {
            color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?>;
        }
        #html, #css, #save{display:none}
        .sidebar-dark #sidebarToggle{background-color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?>;}
        .sidebar-dark #sidebarToggle:hover {background-color: <?php echo e($settingsAdmin->text_hover ?? 'None'); ?>;}
        .text-posttype-color {
            color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?>

        }
        .border-left-color {
            border-left: 0.25rem solid <?php echo e($settingsAdmin->text_color ?? 'None'); ?>;
        }

        /* sidebar color  */
        .sidebar .nav-item .collapse .collapse-inner .collapse-header{
            color:
        }
        .btn:active, .btn:hover, .btn{
            color: <?php echo e($settingsAdmin->dashboard_color ?? 'None'); ?> !important;
            background-color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?> !important;
            border-color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?> !important;
        }


    </style>

</head>

<body class="bg-gradient-primary" style="margin-top:20vh">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                   <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('public/admin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('public/admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset('public/admin/js/sb-admin-2.min.js')); ?>"></script>

    <!-- Page level plugins -->
    <!-- <script src="<?php echo e(asset('public/admin/vendor/chart.js/Chart.min.js')); ?>"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="<?php echo e(asset('public/admin/js/demo/chart-area-demo.js')); ?>"></script> -->
    <!-- <script src="<?php echo e(asset('public/admin/js/demo/chart-pie-demo.js')); ?>"></script> -->

    <!-- Page level plugins -->
    <!-- <script src="<?php echo e(asset('public/admin/vendor/datatables/jquery.dataTables.min.js')); ?>"></script> -->
    <!-- <script src="<?php echo e(asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="<?php echo e(asset('public/admin/js/demo/datatables-demo.js')); ?>"></script> -->


</body>

</html><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\user\front\master.blade.php ENDPATH**/ ?>