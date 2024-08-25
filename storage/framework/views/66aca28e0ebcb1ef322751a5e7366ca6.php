
<?php $__env->startSection('content'); ?>
<!--====================  hero slider area ====================-->
<div class="hero-slider-area">
        <div id="rev_slider_2_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="home" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <!-- START REVOLUTION SLIDER 5.4.7 fullwidth mode -->
            <div id="rev_slider_2_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.7">
                <ul>
                <?php $count = 0; ?>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        <?php if($post->post_type == 'sliders'): ?>
                    <!-- SLIDE  -->
                    <li data-index="rs-<?php echo e($count); ?>" data-transition="incube-horizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="<?php echo e(asset('public/front/elegant/img/slider/one/100x50_home_00_15.jpg')); ?>" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                     
                        <img src="<?php echo e(url('/public/uploads/images/'.$post->thumbnail_path)); ?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                          <div class="overlay"></div>
                        <!-- LAYERS -->

                        <!-- LAYER NR. 6 -->
                        <div class="tp-caption  " id="slide-<?php echo e($count); ?>-layer-2" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-100','-100','-90','-100']" data-lineheight="['105','105','60','54']" data-fontweight="['900','900','900','700']" data-width="['none','none','90%','400']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":640,"speed":300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,21]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,21]" data-marginbottom="[0,0,0,15]" data-fontsize="[90, 80, 70, 60]" style="z-index: 5; white-space: nowrap; font-size: 70px; line-height: 105px; font-weight: 600; color: #ffffff; letter-spacing: 0px;"><?php echo $post->option_1; ?></div>

                        <!-- LAYER NR. 7 -->
                        <div class="tp-caption  " id="slide-<?php echo e($count); ?>-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-lineheight="['18','18','18','28']" data-width="['none','none','none','90%']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-type="text" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":1040,"speed":300,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 18px; line-height: 18px; font-weight: 400; color: #ffffff; letter-spacing: 0px;"><?php echo $post->option_2; ?></div>

                     
                    </li>
                    <?php $count++; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                </ul>
                <div class="tp-bannertimer" style="height: 5px; background: rgba(0,0,0,0.15);"></div>
            </div>
        </div><!-- END REVOLUTION SLIDER -->
    </div>
    <!--====================  End of hero slider area  ====================-->

    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($post->post_type == 'pages' && $post->slug == 'about-elegant'): ?>
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
                z-index: 9999;padding: 5px;
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
            
        
    <!--====================  featured project area ====================-->
    <div class="featured-project-area secend-bg  section-space--inner--bottom--300" data-bg="<?php echo e(asset('public/front/elegant/img/patterns/1.png')); ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="featured-project-wrapper">
                        <div class="row">

                            <div class="col-lg-6">
                                <!-- section title left align -->
                                <div class="section-title-area">
                                    <h2 class="title title--left pinkish"><?php echo $post->title; ?></h2>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- section title content -->
                                <div class="section-title-content-area">
                                    <p class="section-title-content gray"><?php echo $post->excerpt; ?></p>
                                    <div class="d-flex">
                                        <div class="video-button-container video-popup">
                                            <a href="<?php echo $post->option_1; ?>" class="section-title-video-button">
                                                <div class="video-play bg-img" data-bg="<?php echo e(asset('public/front/elegant/img/icons/video-play.png')); ?>">
                                                    <i class="ion-ios-play"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="video-text gray"><a href="<?php echo e(url($post->post_type, $post->slug)); ?>">LEARN ABOUT US <i class="ion-arrow-right-c"></i></a></div>
                                    </div>                                    
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of featured project area  ====================-->

    <!--====================  feature project box slider area ====================-->
    <div class="feature-project-box-slider-area ">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12 about_under">
                    <!-- feature project box wrapper -->
                    <div class="feature-project-box-wrapper">
                        <div class="row">
                            <?php echo $post->more_option_2; ?>

                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <!--====================  End of feature project box slider area  ====================-->
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($post->post_type == 'pages' && $post->slug == 'numbers-speak-for-themselves'): ?>
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
                z-index: 9999;padding: 5px;
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
    <div class="counter-brand-logo-area counter-brand-logo-area-bg  bg-img" data-bg="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path); ?>" style="background-image: url(&quot;<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path); ?>&quot;);">
        <div class="container">
          
            <div class="row">
                <div class="col-lg-12 p__t p__b">
                    <div class="section-title-area text-center section-space--bottom--80">
                        <h2 class="title title--style4"><?php echo e($post->title); ?></h2>
                    </div>
                    <div class="project-counter-single-content-wrapper">
                        <div class="row">
                            <?php echo $post->content; ?>                           

                        </div>
                    </div>
                </div>
            </div>
         
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <!--====================  industry slider area ====================-->
    <div class="industry-slider-area bg-sister">
        <!-- industry slider nav -->
        <div class="industry-slider-nav-area">
            <div class="swiper-container industry-slider-nav-container">
                <div class="swiper-wrapper industry-slider-nav-wrapper">

                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($post->post_type == 'our-sister-concerns'): ?>                   
                    
                    <div class="swiper-slide">
                        <div class="industry-single-nav">
                            <div class="industry-single-nav__icon">
                                <img src="<?php echo e($post->option_1); ?>" class="icon-im" alt="">
                            </div>
                            <div class="industry-single-nav__title">
                                <?php echo e($post->title); ?>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    

                </div> 
             
            </div>
            <div class="ht-swiper-button-prev ht-swiper-button-prev-2 ht-swiper-button-nav d-none d-lg-block"><i class="ion-ios-arrow-left"></i></div>
            <div class="ht-swiper-button-next ht-swiper-button-next-2 ht-swiper-button-nav d-none d-lg-block"><i class="ion-ios-arrow-forward"></i></div>
        </div>
         <h2 class="sister-mid-text">Our Sister Concerns</h2>
        <!-- industry slider content -->
        <div class="industry-slider-content-area">
            <div class="swiper-container industry-slider-content-container">
                <div class="swiper-wrapper industry-slider-content-wrapper">

                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($post->post_type == 'home-sister-concerns'): ?>                                    
                    <div class="swiper-slide">
                        <div class="industry-slider-content-single bg-img" data-bg="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path); ?>">
                            <div class="container">
                                <div class="industry-content-inner">
                                    <div class="section-title-area">
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
                                        <h2 class="title title--left"><?php echo e($post->title); ?></h2>
                                    </div>
                                    
                                    <?php if($post->slug == 'garments-apparels-2'): ?> 
                                    <p class="section-title-content"><?php echo $post->content; ?></p>
                                    <?php else: ?>
                                    <p class="section-title-content"><?php echo $post->option_2; ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if($post->excerpt): ?>                                    
                                    <a href="<?php echo e($post->excerpt); ?>" class="ht-btn ht-btn--dark">READ MORE</a>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                     
                    
                </div>
            </div>
        </div>        
          
    </div>
    <!--====================  End of industry slider area  ====================-->
    <!--====================  testimonial brand slider area ====================-->
    <div class="testimonial-brand-slider-area pt-3 pb-5 grey-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- testimonial slider -->
                    <div class="testimonial-slider__body-wrapper pb-3">
                    
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($post->post_type == 'pages' && $post->slug == 'partners-clients'): ?> 
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
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                        <div class="testimonial-slider__title-wrapper ">
                            <h2 class="testimonial-slider__title text-light">Partners & Clients</h2>     

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- brand logo slider -->
                    <div class="brand-logo-slider__container-area">
                        <div class="swiper-container brand-logo-slider__container">
                            <div class="swiper-wrapper brand-logo-slider__wrapper">

                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($post->post_type == 'pages' && $post->slug == 'partners-clients'): ?>                                                             
                                
                                    <?php $values = explode(",",$post->gallery_img); ?>
                                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($imgid): ?> 
                                        <div class="swiper-slide brand-logo-slider__single">
                                            <div class="image">
                                            <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="image-hover">
                                                <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
                                        
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of testimonial brand slider area  ====================-->
    <!--====================  project counter area ====================-->
    <div class="project-counter-area">
        <div class="row g-0">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($post->post_type == 'pages' && $post->slug == 'power-plants'): ?> 
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
            <div class="col-lg-12">
                <div class="project-counter-wrapper">                

                    <!-- project counter-bg -->
                    <div class="project-counter-bg bg-img" data-bg="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path); ?>"></div>
                    <!-- project counter content -->
                    <div class="project-counter-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="project-counter-single-content-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">                       
                                            
                                            <div class="project-counter-single-content">
                                                <div class="project-counter-single-content__image">
                                                    <img src="<?php echo e($post->option_1); ?>" class="img-fluid" alt="">
                                                </div>
                                                <div class="project-counter-single-content__content">                                                  
                                                    <h5 class="project-counter-single-content__project-title"><?php echo e($post->title); ?></h5>
                                                    <p class="project-counter-single-content__subtext text-white text-start"><?php echo $post->excerpt; ?></p>
                                                    <a href="<?php echo e($post->option_2); ?>" class="single-feature-project-box__link text-center"> <span>READ MORE </span> <i class="ion-arrow-right-c"></i></a>
                                                </div>
                                            </div>  

                                        </div>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   

                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <!--====================  End of project counter area  ====================-->
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('front.themes.elegant.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\elegant\index.blade.php ENDPATH**/ ?>