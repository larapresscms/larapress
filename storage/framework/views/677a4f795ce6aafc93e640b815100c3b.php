
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
    <!--====================  start area  ====================-->
  <!--====================  breadcrumb area ====================-->
  <div class="breadcrumb-area breadcrumb-area-bg section-space--inner--80 bg-img" data-bg="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($posttype->pt_thumbnail_path); ?>">
        <div class="container">
            <div class="row align-items-center comon-titel_set">
                <div class="col-sm-6">
                    <h2 class="breadcrumb-page-title"><?php echo e($posttype->name); ?></h2>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb-page-list text-uppercase">
                        <li class="has-children"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><?php echo e($posttype->name); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="innar-overlay"></div>
     
    </div>

    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  icon info area ====================-->
    <div class="career-contact section-space--inner--120  secend-bg">
            <div class="container">
                
                    <div class="case-study__image-gallery-wrapper section-space--top--80">
                        <div class="row image-popup">
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($post->post_type == $posttype->slug): ?> 
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <?php if(auth()->guard()->check()): ?>
                                <!--toplabel menu -->
                                <style>
                                    .topnav {
                                        background: #000;
                                        color: #fff;
                                        text-align: center;
                                        width: 100%; 
                                        top:0;
                                        left: 0;
                                        right: 0;
                                        background-color: #162434;
                                        z-index: 9999;
                                        padding: 5px;
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
                                <div class="case-study__single-gallery-image">
                                    <a href="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path); ?>" class="single-gallery-thumb">
                                        <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path); ?>" class="img-fluid" alt="">
                                        <div class="stady_text"><h4><?php echo $post->title; ?></h4>
                                        <h4><?php echo $post->content; ?></h4>
                                       </div>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                        </div>
                    </div>
                
            </div>
    </div>
    <!--====================  End of icon info area  ====================-->
    <div class="icon-info-area section-space--inner--60 dark-bg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="icon-info-wrapper">
               <div class="row">
                   <?php echo $posttype->pt_content; ?>

                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<!-- address end  -->
<!--====================  End area  ====================-->
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('front.themes.elegant.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\elegant\elegant-construction.blade.php ENDPATH**/ ?>