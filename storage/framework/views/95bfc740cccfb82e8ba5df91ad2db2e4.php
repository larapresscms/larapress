
<?php if(auth()->guard()->check()): ?>
<!--toplabel menu -->
<style>
    .topnav {
    	background: #000;
    	color: #fff;
    	text-align: center;
    	position: fixed;
    	width: 100%; 
    	top:0;
    	left: 0;
    	right: 0;
    	background-color: #162434;
    	z-index: 9999;
        padding: 0px;
    }
    .topnav a{
        color: #fff;
        padding-right: 10px;
    }
</style>
<div class="topnav">
  <a class="active" href="<?php echo e(url('/dashboard')); ?>">Dashboard</a> 
    <a href="<?php echo e(url('/dashboard/posts/posttype/')); ?>/<?php echo e($post->id); ?>/edit/<?php echo e($post->post_type); ?>">Edit Post</a>   
  <a href="<?php echo e(url('/logout')); ?>">Logout</a>
</div>
<!--end top lavel menu-->
<?php endif; ?>
<?php $__env->startSection('content'); ?>
  <!--====================  breadcrumb area ====================-->
    <div class="breadcrumb-area breadcrumb-area-bg section-space--inner--80 bg-img" data-bg="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path); ?>">
        <div class="container">
            <div class="row align-items-center comon-titel_set">
                <div class="col-sm-6">
                    <h2 class="breadcrumb-page-title"><?php echo e($post->title); ?></h2>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb-page-list text-uppercase">
                        <li class="has-children"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><?php echo e($post->title); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="innar-overlay"></div>     
    </div>

    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  icon info area ====================-->
    <?php echo $post->content; ?>

    
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('front.themes.elegant.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\elegant\single.blade.php ENDPATH**/ ?>