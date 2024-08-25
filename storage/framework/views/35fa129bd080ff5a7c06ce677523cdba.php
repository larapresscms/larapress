<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/x-icon" href="<?php echo e($settingsAdmin->fav_icon == null ? asset('public/admin/img/fav.png') : asset('public/uploads/images/').'/'.$settingsAdmin->fav_icon); ?>">

	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <title>Dashboard - <?php echo e($settingsAdmin->site_title ?? 'None'); ?> </title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('public/admin/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('public/admin/css/sb-admin-2.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/admin/css/style.css')); ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">


    <?php if($settingsAdmin->editor == "classic"): ?>
        <!-- editor 1 -->
        <script src="<?php echo e(asset('public/admin/js/tinymce.min.js')); ?>" referrerpolicy="origin"></script>
    <?php else: ?>
        <!--graphjs editor 2-->    
        <link  href="<?php echo e(asset('public/admin/editor_visual/grapes.min.css')); ?>" rel="stylesheet"/>
        <link  href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet"/>     
        <!--graphjs -->
    <?php endif; ?>

    <style>
        .bg-gradient-primary{
            background-color:<?php echo e($settingsAdmin->dashboard_color ?? 'None'); ?>;
            background-image: none;
        }
        .text-gray-400, a, .text-primary, .text-gray-900, a.small, h1, h2, h3, h4, h5, h6, .sidebar .nav-item .collapse .collapse-inner .collapse-item, .sidebar-dark .nav-item .nav-link {
            color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?> !important;
        }
        .sidebar-dark .nav-item .nav-link:focus, .sidebar-dark .nav-item .nav-link:hover {
            color: <?php echo e($settingsAdmin->text_hover ?? 'None'); ?>;
        }
        .topbar.navbar-light .navbar-nav .nav-item .nav-link, .sidebar-dark .nav-item .nav-link i {
            color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?>;
        }
        .topbar.navbar-light .navbar-nav .nav-item .nav-link:hover, .sidebar-dark .nav-item .nav-link:focus i, .sidebar-dark .nav-item .nav-link:hover i {
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
        .sidebar .nav-item .collapse .collapse-inner .collapse-header{
            color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?>;
            opacity: 50%;
        }
        .page-item.active .page-link, .btn:active, .btn:hover, .btn{
            color: <?php echo e($settingsAdmin->dashboard_color ?? 'None'); ?> !important;
            background-color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?> !important;
            border-color: <?php echo e($settingsAdmin->text_color ?? 'None'); ?> !important;
        }
        .labelBalloon:focus + label, .labelBalloon:active + label, .labelBalloon:hover + label {
            color: <?php echo e($settingsAdmin->dashboard_color ?? 'None'); ?> !important;
            background: <?php echo e($settingsAdmin->text_color ?? 'None'); ?> !important;
        }
    </style>
     
    
    
</head>

<body id="page-top">
    

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php if(auth()->guard()->check()): ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(url('/')); ?>" target='_blank'>
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">
                    <div>
                        <img src="<?php echo e($settingsAdmin->site_logo ? url('/public/uploads/images/'.$settingsAdmin->site_logo) : asset('public/admin/img/larapress.png')); ?>" class="img-fluid" width="100%" alt="Logo">
                     </div>
                </div>
            </a>
             
            <!-- Divider -->
            <hr class="sidebar-divider my-0 mt-3">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/dashboard')); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
<!--without subscriber -->

    <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->role == 112): ?>
            
            <!-- Divider --> 
            <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->media == 'media'): ?>
            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedia"
                    aria-expanded="true" aria-controls="collapseMedia">
                    <i class="fas fa-photo-video"></i>
                    <span>Media</span>
                </a>
                <div id="collapseMedia" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Create Media:</h6>
                        <a class="collapse-item" href="<?php echo e(url('/dashboard/media')); ?>">All Media</a>
                        <a class="collapse-item" href="<?php echo e(url('/dashboard/media/create')); ?>">Add New</a>
                    </div>
                </div>
            </li>
            <?php endif; ?>             
                          
            <?php $i = 1; ?>
            <?php $__currentLoopData = $posttypesD; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype_result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($posttype_result->menu_icon != '' && $posttype_result->menu_icon != null): ?> 
                
                <!-- Divider -->
                <?php if(optional(auth()->user())->role == 111): ?>

                    <hr class="sidebar-divider"> 
                    <li class="nav-item"> 
                        
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseD<?php echo e($i); ?>"
                    aria-expanded="true" aria-controls="collapseD<?php echo e($i); ?>">
                    <i class="fas fa-thumbtack"></i>
                    <span><?php echo e($posttype_result->menu_icon); ?></span>
                    </a>
                    <div id="collapseD<?php echo e($i); ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">All <?php echo e($posttype_result->menu_icon); ?>:</h6>
                            <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($posttype->in_menu_swh == '1' && ($posttype->menu_icon != null || $posttype->menu_icon != '')): ?> 
                                    <?php if($posttype_result->menu_icon == $posttype->menu_icon): ?>
                                        
                                        <?php if(optional(auth()->user())->role == 111): ?>
                                        <a class="collapse-item" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>"><?php echo e($posttype->name); ?></a> 
                                        <?php else: ?>
                                        
                                            <!-- role mang --> 
                                            <?php $values = explode(',',optional(auth()->user())->posttypes_id); ?>
                                            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <?php if($vid): ?>  
                                                
                                                    <?php if(optional(auth()->user())->role == 111 || $vid == $posttype->id): ?>
                                                    <a class="collapse-item" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>"><?php echo e($posttype->name); ?></a> 
                                                    <?php endif; ?>
                                                                
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        
                                        <?php endif; ?>								
                                        
                                        
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        </div>
                    </li>

                <?php elseif(optional(auth()->user())->role == 112): ?>
                
                <!-- role mang-------------------------> 
                <?php $uaptmenu = explode(',',optional(auth()->user())->admin_pt_menu); ?>
                    <?php $__currentLoopData = $uaptmenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uaptmenu_vlu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <?php if($uaptmenu_vlu): ?> 
                            <?php if(optional(auth()->user())->role == 111 || $uaptmenu_vlu == $posttype_result->menu_icon): ?>
								                
                                <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->posttypes_id != null): ?>


                                <hr class="sidebar-divider"> 
                                <li class="nav-item"> 
                                    
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseD<?php echo e($i); ?>"
                                aria-expanded="true" aria-controls="collapseD<?php echo e($i); ?>">
                                <i class="fas fa-thumbtack"></i>
                                <span><?php echo e($posttype_result->menu_icon); ?></span>
                                </a>
                                <div id="collapseD<?php echo e($i); ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <h6 class="collapse-header">All <?php echo e($posttype_result->menu_icon); ?>:</h6>
                                        <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($posttype->in_menu_swh == '1' && ($posttype->menu_icon != null || $posttype->menu_icon != '')): ?> 
                                                <?php if($posttype_result->menu_icon == $posttype->menu_icon): ?>
                                                    
                                                    <?php if(optional(auth()->user())->role == 111): ?>
                                                    <a class="collapse-item" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>"><?php echo e($posttype->name); ?></a> 
                                                    <?php else: ?>
                                                    
                                                        <!-- role mang --> 
                                                        <?php $values = explode(',',optional(auth()->user())->posttypes_id); ?>
                                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                            <?php if($vid): ?>  
                                                            
                                                                <?php if(optional(auth()->user())->role == 111 || $vid == $posttype->id): ?>
                                                                <a class="collapse-item" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>"><?php echo e($posttype->name); ?></a> 
                                                                <?php endif; ?>
                                                                            
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                    
                                                    <?php endif; ?>								
                                                    
                                                    
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    </div>
                                </li>
                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 					
                <!-- role mang ------------------------->  
                <?php endif; ?>
                
                <?php $i += 1; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
            

            <!-- dynamic post type  -->
            <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($posttype->in_menu_swh == '1' && ($posttype->menu_icon == null || $posttype->menu_icon == '')): ?> 
                
                <!-- role mang admin--> 
                <?php if(optional(auth()->user())->role == 111): ?>
					<!-- Divider -->
					<hr class="sidebar-divider">
					<!-- Nav Item - Pages Collapse Menu -->
					<li class="nav-item"> 
						
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?php echo e($posttype->id); ?>"
					aria-expanded="true" aria-controls="collapse<?php echo e($posttype->id); ?>">
					<i class="fas fa-thumbtack"></i>
					<span><?php echo e($posttype->name); ?></span>
					</a>
					<div id="collapse<?php echo e($posttype->id); ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Create <?php echo e($posttype->name); ?>:</h6>
							<a class="collapse-item" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>">All <?php echo e($posttype->name); ?></a>
							<a class="collapse-item" href="<?php echo e(url('/dashboard/posttypes/create/'.$posttype->slug)); ?>">Add New</a>
						</div>
						</div>
					</li>
				<?php else: ?>
				
					<!-- role mang editor--> 
					<?php $values = explode(',',optional(auth()->user())->posttypes_id); ?>
					<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
						<?php if($vid): ?>  
						
							<?php if(optional(auth()->user())->role == 111 || $vid == $posttype->id): ?>
								<!-- Divider -->
								<hr class="sidebar-divider">
								<!-- Nav Item - Pages Collapse Menu -->
								<li class="nav-item"> 
									
								<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?php echo e($posttype->id); ?>"
								aria-expanded="true" aria-controls="collapse<?php echo e($posttype->id); ?>">
								<i class="fas fa-thumbtack"></i>
								<span><?php echo e($posttype->name); ?></span>
								</a>
								<div id="collapse<?php echo e($posttype->id); ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
									<div class="bg-white py-2 collapse-inner rounded">
										<h6 class="collapse-header">Create <?php echo e($posttype->name); ?>:</h6>
										<a class="collapse-item" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>">All <?php echo e($posttype->name); ?></a>
										<a class="collapse-item" href="<?php echo e(url('/dashboard/posttypes/create/'.$posttype->slug)); ?>">Add New</a>
									</div>
									</div>
								</li>
							<?php endif; ?>
										   
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 				
				<?php endif; ?>	
				<!-- role mang editor--> 		
                
                
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- dynamic post type  -->
        
            <!-- Divider -->
            <hr class="sidebar-divider">

             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>User</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Create User:</h6>
                         
                            <?php if(optional(auth()->user())->role == 111): ?>
                            <a class="collapse-item" href="<?php echo e(url('/dashboard/showUser')); ?>">All Users</a>
                            <a class="collapse-item" href="<?php echo e(url('/dashboard/user/create')); ?>">Add New</a>
                            <?php endif; ?>            
                         
                        <a class="collapse-item" href="<?php echo e(url('/dashboard/profile')); ?>">Your Profile</a>
                    </div>
                </div>
            </li>

             
            <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->posttypes_id != null || optional(auth()->user())->categories == 'categories' || optional(auth()->user())->menus == 'menus'): ?>
            <hr class="sidebar-divider d-none d-md-block"> 

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTools" aria-expanded="true" aria-controls="collapseSettings"> 
                   <i class="fas fa-fw fa-cog"></i> 
                    <span>Tools</span>
                 </a> 
                 <div id="collapseTools" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar"> 
                     <div class="bg-white py-2 collapse-inner rounded"> 
                         <h6 class="collapse-header">Tools:</h6> 
                         <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->posttypes_id != null): ?>
						 <a class="collapse-item" href="<?php echo e(url('/dashboard/posttypes')); ?>">Post Type</a>
                         <?php endif; ?>
						 <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->categories == 'categories'): ?>
                         <a class="collapse-item" href="<?php echo e(url('/dashboard/categories')); ?>">Categories</a> 
                         <?php endif; ?>
                         <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->menus == 'menus'): ?>
                        <a class="collapse-item" href="<?php echo e(url('/dashboard/menu/create')); ?>">Menu</a> 
                        <?php endif; ?>
                     </div>
                 </div>
            </li>
            <?php endif; ?>

            <!-- Divider -->
            <?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->feedbacks == 'feedbacks'): ?>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/dashboard/feedbacks/')); ?>">
                    <i class="fas fa-comment-alt"></i>
                    <span>Feedback</span></a>
            </li>
            <?php endif; ?>

            <!-- Divider -->
             
            <?php if(optional(auth()->user())->role == 111): ?>
            <hr class="sidebar-divider d-none d-md-block"> 

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings"> 
                   <i class="fas fa-fw fa-cog"></i> 
                    <span>Settings</span>
                 </a> 
                 <div id="collapseSettings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar"> 
                     <div class="bg-white py-2 collapse-inner rounded"> 
                         <h6 class="collapse-header">Settings:</h6> 
                         <a class="collapse-item" href="<?php echo e(url('/dashboard/settings')); ?>">General</a> 
                         <a class="collapse-item" href="<?php echo e(url('/dashboard/clear')); ?>">Cache Clear</a> 
                         <a class="collapse-item" href="<?php echo e(url('/dashboard/about')); ?>">About</a> 
                     </div>
                 </div>
            </li>

            <?php endif; ?> 

    <?php else: ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/dashboard/profile')); ?>">
            <i class="fas fa-users"></i>
            <span>Your Profile</span></a> 
    </li>
    <?php endif; ?>
    
<?php endif; ?> 
<!--without subscriber -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block mb-3">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- <div class="copyright text-center my-auto">
                <span>Powered by Larapress 2.0</span>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form style="display:none !important"
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">

                        <form id="custom-search-form" class="form-search form-horizontal pull-right" action="<?php echo e(url('/dashboard/search')); ?>" method="get">
                        <?php echo csrf_field(); ?>
                            <input type="text" class="form-control bg-light border-0 small" name="search" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" >
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </form>

                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none" style="display:none !important">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1" style="display:none !important">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1" style="display:none !important">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                    <!-- <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="..."> -->
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                    <!-- <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="..."> -->
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                    <!-- <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="..."> -->
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="#"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small">
                                    <?php if(auth()->guard()->check()): ?>
                                    <?php echo e(optional(auth()->user())->name); ?>

                                    <?php endif; ?>
                                </span>
								<i class="fas fa-user"></i>
                                <!--<img class="img-profile rounded-circle"
                                    src="<?php echo e(asset('admin/img/undraw_profile.svg')); ?>"> -->
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo e(url('/dashboard/profile')); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!--<a class="dropdown-item" href="#">-->
                                <!--    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>-->
                                <!--    Settings-->
                                <!--</a>-->
                                <!--<a class="dropdown-item" href="#">-->
                                <!--    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>-->
                                <!--    Activity Log-->
                                <!--</a>-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(url('/logout')); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->                

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- toast   -->
                    <!--
                    <div class="border-primary border-left border-width-4 px-4 py-3 mx-3 mb-3 bg-white text-black shadow-sm animated flipInX delay-02s alert alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">Well done!</h4>
                        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                        <hr>
                        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                    </div>-->

                    <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Toasts will be dynamically added here --> 
                        <div class="text-capitalize alert alert-dismissible fade show border-danger border-left border-width-4 px-4 py-3 mx-3 mb-3 bg-white text-black shadow-sm animated flipInX delay-02s " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fas fa-exclamation opacity-05 mr-3 text-danger"></i>
                            <?php echo e($error); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if(session()->has('message')): ?>
                        <!-- Toasts will be dynamically added here --> 
                        <div class="text-capitalize alert alert-dismissible fade show border-<?php echo e(session('type') ?? 'success'); ?> border-left border-width-4 px-4 py-3 mx-3 mb-3 bg-white text-black shadow-sm animated flipInX delay-02s " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fas fa-exclamation opacity-05 mr-3 text-<?php echo e(session('type') ?? 'success'); ?>"></i>
                            <?php echo e(session('message')); ?>

                        </div>
                    <?php endif; ?>    
                    <?php if(session()->has('messageDestroy')): ?>
                    <!-- Toasts will be dynamically added here --> 
                    <div class="text-capitalize alert alert-dismissible fade show border-<?php echo e(session('type') ?? 'danger'); ?> border-left border-width-4 px-4 py-3 mx-3 mb-3 bg-white text-black shadow-sm animated flipInX delay-02s " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fas fa-exclamation opacity-05 mr-3 text-<?php echo e(session('type') ?? 'danger'); ?>"></i>
                        <?php echo e(session('messageDestroy')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if($lara_version !== 'LaraPress is up-to-date.'): ?>
                        <!-- Toasts will be dynamically added here --> 
                        <div class="text-capitalize alert alert-dismissible fade show border-<?php echo e(session('type') ?? 'success'); ?> border-left border-width-4 px-4 py-3 mx-3 mb-3 bg-white text-black shadow-sm animated flipInX delay-02s " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fas fa-exclamation opacity-05 mr-3 text-<?php echo e(session('type') ?? 'success'); ?>"></i>
                            <?php echo e($lara_version); ?> - <a href="<?php echo e(url('/dashboard/update')); ?>">Update Now</a>
                        </div>
                    <?php endif; ?>  
                    <!-- end toast   -->
 
                    <!-- Page Heading -->
                    <!-- 
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    -->
                   <?php echo $__env->yieldContent('content'); ?>

                  


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto laradrop">
                        <a href="https://larapress.org"><span>LaraPress CMS v<?php echo e($CurrentLaraPressVersion ?? "Not Available"); ?>  || All rights reserved.</span></a>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo e(url('/logout')); ?>">Logout</a>
                </div>
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
    <script src="<?php echo e(asset('public/admin/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset('public/admin/js/demo/datatables-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('public/admin/js/custom.js')); ?>"></script>

<!-- image upload -->
<script >
    $(function() {
    // Multiple images preview with JavaScript
    var previewImages = function(input, imgPreviewPlaceholder) {                    
        if (input.files) {
            var filesAmount = input.files.length;                    
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();                    
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }                    
                reader.readAsDataURL(input.files[i]);
            }
        }

    };                    
    $('#images_multiple').on('change', function() {
        previewImages(this, 'div.images-preview-div');
    });
});
</script>
<!-- image upload -->
<!-- editor choose  -->
<?php if($settingsAdmin->editor == "classic"): ?>
    <!-- editor 1 -->
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 550,
            directionality: '',
            language: '',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap emoticons', // imagetools, quickbars
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: false,
            document_base_url: '<?php echo e(url('/')); ?>',
            relative_urls: true,
            convert_urls: false,
            valid_elements : '*[*]',
            toolbar_mode: 'sliding',
            file_picker_callback(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

                tinymce.activeEditor.windowManager.openUrl({
                    url: '<?php echo e(url('/dashboard/mediamanager')); ?>',
                    title: '<?php echo e(__("Media Library")); ?>',
                    width: x * 0.8,
                    height: y * 0.8,
                    onMessage: (api, message) => {
                        callback(message.content, {text: message.text})
                    }
                })
            }
        });
    </script>
<?php else: ?>
<!-- graphjs  editor 2 visual-->
<script src="<?php echo e(asset('public/admin/editor_visual/grapesjs')); ?>"></script>
<script src="<?php echo e(asset('public/admin/editor_visual/grapesjs-preset-webpage.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/admin/editor_visual/grapesjs-echarts.min.js')); ?>"></script>

<script>
  const editor = grapesjs.init({
        height: '500px',
        container: '#gjs',
        showOffsets: true,
        fromElement: true,
        noticeOnUnload: false,
        storageManager: false,
        plugins: ['grapesjs-preset-webpage'],
      }); 
const htmlTextarea = document.getElementById('html')
const cssTextarea = document.getElementById('css')
const updateTextarea = (component, editor)=>{
  const e = component.em.get("Editor");
  htmlTextarea.value= e.getHtml();
  cssTextarea.value= e.getCss();
}
editor.on('component:add', updateTextarea);
editor.on('component:update', updateTextarea);
editor.on('component:remove', updateTextarea);

const updateInstance = () => {
  editor.setComponents(htmlTextarea.value)
  editor.setStyle(cssTextarea.value)
}
document.getElementById('save').onclick=updateInstance;

editor.setComponents(htmlTextarea.value)
editor.setStyle(cssTextarea.value)

</script>
<!-- graphjs -->
<?php endif; ?>  

<!-- close inner uploads modal  -->
<script>
$("button[data-dismiss-modal=uploadmodal]").click(function () {
    $('#exampleModalUpload').modal('hide');
});
</script>
<!-- close inner uploads modal  -->

</body>
</html>
<?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\layouts\master.blade.php ENDPATH**/ ?>