
<?php if(auth()->guard()->check()): ?>
<!--toplabel menu -->
<style>
    .topnavp {
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
    .topnavp a{
        color: #fff;
        padding-right: 10px;
    }
</style>
<div class="topnavp">
  <a class="active" href="<?php echo e(url('/dashboard')); ?>">Dashboard</a> 
    <a href="<?php echo e(url('/dashboard/posttypes/')); ?>/<?php echo e($posttype->id); ?>/edit">Edit Post</a>  
  <a href="<?php echo e(url('/logout')); ?>">Logout</a>
</div>
<!--end top lavel menu-->
<?php endif; ?>
<?php $__env->startSection('content'); ?>
    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  icon info area ====================-->
    <div class="career-contact section-space--inner--120  secend-bg">
            <div class="container">
            <?php echo $posttype->pt_content; ?>                
            </div>
        </div>
    <!--====================  End of icon info area  ====================-->


<!-- address end  -->
<!--====================  End area  ====================-->
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('front.themes.elegant.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\elegant\404.blade.php ENDPATH**/ ?>