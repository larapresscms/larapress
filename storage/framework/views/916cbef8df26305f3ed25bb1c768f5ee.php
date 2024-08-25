
<?php $__env->startSection('content'); ?>  
<!-- ======================= Blog Details Section Start ========================= -->
<section class="blog-details padding-y-120 position-relative overflow-hidden">
    <div class="container container-two">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details top Start -->
                <div class="blog-details-top mb-64">                    
                    <h2 class="blog-details-top__title mb-4 text-capitalize"><?php echo e($posttype->name); ?></h2>                     
                </div>
                <!-- blog details top End -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details content Start -->
                <div class="blog-details-content">
                    <!-- ================== Setting Section Start ====================== -->
                    <div class="row gy-4">
                        <div class="col-lg-4 pe-xl-5">
                            <div class="setting-sidebar top-24">
                                <!-- <h6 class="setting-sidebar__title">Doc:</h6> -->
                                <ul class="setting-sidebar-list">
                                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="setting-sidebar-list__item"><a href="#info<?php echo e($post->id); ?>" class="setting-sidebar-list__link active"><?php echo e($post->title); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <!-- <form action="#"> -->
                                <div class="setting-content" data-bs-spy="scroll" data-bs-target="#sidebar-scroll-spy">
                                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card common-card border border-gray-five overflow-hidden mb-24"  id="info<?php echo e($post->id); ?>">
                                        <div class="card-header">
                                            <h6 class="title"><?php echo e($post->title); ?></h6>
                                        </div>
                                        <div class="card-body">
                                        <?php echo $post->content; ?>

                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <!-- ================== Setting Section End ====================== -->                  
                </div>
                <!-- blog details content End-->
            </div>
        </div>
    </div>
</section>
<!-- ======================= Blog Details Section End ========================= -->    
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('front.themes.laratheme.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\laratheme\documentation.blade.php ENDPATH**/ ?>