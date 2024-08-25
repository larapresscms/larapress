
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
  <div class="breadcrumb-area breadcrumb-area-bg_sister section-space--inner--80 bg-img" data-bg="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($posttype->pt_thumbnail_path); ?>">
        <div class="container">
            <div class="row align-items-center">
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

    <div class="about-feature-icon-area section-space--inner--60 secend-bg">
            <div class="container">
                <div class="row">

                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($post->post_type == $posttype->slug && $post->slug == 'about-factory-elegant-washing-plant-ltd'): ?> 
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
                    
                    <div class="col-lg-4">
                        <div class="about-list-title-wrapper">
                            <div class="career-title-area section-space--bottom--50">
                                <h2 class="title mb-0"><?php echo e($post->title); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <div class="about-list-wrapper mt-0">
                        <?php echo $post->content; ?>                         
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>              
            </div>
        </div>


        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($post->post_type == $posttype->slug && $post->slug == 'mission-vission-elegant-washing-plant-ltd'): ?> 
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
        <!--====================  about feature icon area ====================-->
        <div class="about-feature-icon-area section-space--inner--60 " style="background: #1e1e1e;">
            <div class="container-fluid about_under">                
                <?php echo $post->content; ?>

            </div>
        </div>
        <!--====================  End of about feature icon area  ====================-->
        <!--====================  feature background area ====================-->
        <div class="feature-background__area dark-bg">
            <div class="row g-0">
            <?php echo $post->more_option_2; ?>

            </div>
        </div>
        <!--====================  End of feature background area  ====================-->
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!--====================  about responsibility area ====================-->
        
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($post->post_type == $posttype->slug && $post->slug == 'factory-products-and-services-cassiopea-garments-ltd'): ?> 
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
                    <div class="about-responsibility-area section-space--inner--120 grey-bg">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="career-title-area section-space--bottom--50 text-center">
                                        <h2 class="title mb-0">FACTORY PRODUCTS AND SERVICES</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <?php echo $post->content; ?>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                 

        
        
        
        <!--====================  End of about responsibility area  ====================-->
        <!--====================  about list content area ====================-->
        <div class="about-list-content section-space--inner--120 secend-bg">
            <div class="container">
            <div class="row">

            <div class="col-lg-12">
            <h2 class="common-page-title">PRODUCT GALLERY</h2>

                         <div class="team-slider">
                            <div class="swiper-container team-slider__container swiper-container-initialized swiper-container-horizontal">
                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($post->post_type == $posttype->slug && $post->slug == 'product-gallery-elegant-washing-plant-ltd'): ?> 
                                
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
                                     
                                <div class="swiper-wrapper team-slider__wrapper" style="transform: translate3d(-600px, 0px, 0px); transition-duration: 0ms;">
                                    <?php $values = explode(",",$post->gallery_img); ?>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($imgid): ?>
                                            <div class="swiper-slide" data-swiper-slide-index="<?php echo e($count); ?>" style="width: 270px; margin-right: 30px;">                                        
                                                <div class="image">
                                                    <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" class="img-fluid" alt="">
                                                </div>                                        
                                            </div>  
                                            <?php $count++; ?>                                          
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	 
                                    </div> 
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                    
                         
                            
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                            <div class="ht-swiper-button-prev ht-swiper-button-prev-14 ht-swiper-button-nav" tabindex="0" role="button" aria-label="Previous slide"><i class="ion-chevron-left"></i></div>
                            <div class="ht-swiper-button-next ht-swiper-button-next-14 ht-swiper-button-nav" tabindex="0" role="button" aria-label="Next slide"><i class="ion-chevron-right"></i></div>
                        </div>
            </div>

                <div class="col-lg-12 mt-5">
                    <div class="common-page-content">
                        <div class="common-page-text-wrapper section-space--bottom--50">
                            <h2 class="common-page-title">PARTNERS & CLIENTS</h2>                        
                        </div>
                        <div class="brand-logo-grid__wrapper section-space--bottom--50">
                            <div class="row">

                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($post->post_type == $posttype->slug && $post->slug == 'partners-clients-elegant-washing-plant-ltd'): ?>      
                                
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
                                
                                    <?php $values = explode(",",$post->gallery_img); ?>
                                        <?php $count = 1; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($imgid): ?> 
                                            <div class="col-md-3 col-6">
                                                <div class="brand-logo-grid__single">
                                                    <div class="brand-logo-slider__single">
                                                        <div class="image">
                                                            <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="image-hover">
                                                            <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $count++; ?>                                          
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	 
                                   
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                                
                          
                            </div>
                        </div>

                    </div>
                </div>
           <!-- ------------------------------------------------ -->
           
              </div>
            </div>
        </div>
        <!--====================  End of about list content area  ====================-->
        <div class="icon-info-area section-space--inner--60 dark-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="icon-info-wrapper">
                        <div class="row">

                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($post->post_type == $posttype->slug && $post->slug == 'corporate-office-elegant-washing-plant-ltd'): ?> 
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
                            <?php echo $post->content; ?>  
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End area  ====================-->
    <?php $__env->stopSection(); ?> 
<?php echo $__env->make('front.themes.elegant.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\elegant\elegant-washing-plant-ltd.blade.php ENDPATH**/ ?>