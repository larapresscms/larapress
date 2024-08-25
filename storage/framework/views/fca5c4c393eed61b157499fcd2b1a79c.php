
<?php $__env->startSection('content'); ?>
<!-- end header -->
<!-- Breadcrumbs Start -->
<div class="breadcrumb-area breadcrumb-area-bg section-space--inner--80 bg-img" data-bg="<?php echo e(asset('public/uploads/images/855928.jpg')); ?>">
    <div class="container">
        <div class="row align-items-center comon-titel_set">
            <div class="col-sm-6">
                <h2 class="breadcrumb-page-title">Search Result:</h2>
            </div>            
        </div>
    </div>
    <div class="innar-overlay"></div>
    
</div>
<div class="career-contact section-space--inner--120  secend-bg">
            <div class="container">
<!-- Breadcrumbs End -->
<div class="container mt-50">
<!--End breadcrumb area-->  
<?php if($search_posts == "[]"): ?>
<section class="fasality-pag">
    <div class="container">
    <!--Start bottom text-->
        <div class="row">
            <div class="col-md-12 ">
                <div class="sec-title">
                <h2>Nothing Found <span></span></h2>
                <span class="decor"></span>
                </div>
                <p class="facilities-body">Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__currentLoopData = $search_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
    <div class="col-md-12">        
        <li><a href="<?php echo e(url($post->post_type, $post->slug)); ?>"><?php echo e($post->title); ?><span></span></a></li>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
<!-- footer start -->
<?php $__env->stopSection(); ?>   
<?php echo $__env->make('front.themes.elegant.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\elegant\search.blade.php ENDPATH**/ ?>