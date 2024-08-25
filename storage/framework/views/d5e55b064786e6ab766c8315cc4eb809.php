
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
    <div class="breadcrumb-area breadcrumb-area-bg section-space--inner--80 bg-img" data-bg="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($post->thumbnail_path ?? ''); ?>">
        <div class="container">
            <div class="row align-items-center comon-titel_set">
                <div class="col-sm-6">
                    <h2 class="breadcrumb-page-title"><?php echo e($post->title ?? ''); ?></h2>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb-page-list text-uppercase">
                        <li class="has-children"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><?php echo e($post->title ?? ''); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="innar-overlay"></div>     
    </div>

    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  icon info area ====================-->
    {!! $post->content !! ?? ''}
    <?php if($post->slug == 'partners-clients'): ?>
<div class="page-content-wrapper section-space--inner--60 secend-bg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="common-page-content">
               <div class="common-page-text-wrapper section-space--bottom--50">
                   
                  <h2 class="common-page-title">Partnerships &amp; Affiliations</h2>
                  <p>Our clients satisfaction is our utmost importance, we in elegant pride ourselves in working long-term with our clients in order to achieve success for both parties.</p>
               </div>
               <div class="brand-logo-grid__wrapper section-space--bottom--50">
                  <div class="row">
                  <?php if($post->slug == 'partners-clients'): ?>
                        <?php $values = explode(",",$post->gallery_img); ?>
                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($imgid): ?> 
                            <div class="col-md-3 col-6">
                                <div class="brand-logo-grid__single">
                                   <div class="brand-logo-slider__single">
                                      <div class="image"><img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" class="img-fluid" alt="" /></div>
                                      <div class="image-hover"><img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" class="img-fluid" alt="" /></div>
                                   </div>
                                </div>
                             </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
                    <?php endif; ?> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
 <?php endif; ?>    
    
    
    
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('front.themes.elegant.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\elegant\single_pages.blade.php ENDPATH**/ ?>