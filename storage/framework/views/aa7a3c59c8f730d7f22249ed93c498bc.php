
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
<!-- ======================= Blog Details Section Start ========================= -->
<section class="blog-details padding-y-120 position-relative overflow-hidden">
    <div class="container container-two">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details top Start -->
                <div class="blog-details-top mb-64">                    
                    <h2 class="blog-details-top__title mb-4 text-capitalize"><?php echo e($post->title ?? ''); ?></h2>                     
                </div>
                <!-- blog details top End -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details content Start -->
                <div class="blog-details-content">
                <?php echo $post->content; ?>                    
                </div>
                <!-- blog details content End-->
            </div>
        </div>
    </div>
</section>
<!-- ======================= Blog Details Section End ========================= -->    
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('front.themes.laratheme.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\laratheme\single.blade.php ENDPATH**/ ?>