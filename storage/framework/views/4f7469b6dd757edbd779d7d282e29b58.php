
<?php $__env->startSection('content'); ?>
<!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h4 class="fw-bolder"><?php echo e($post->title ?? ''); ?></h4>
                    <!-- <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p> -->
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="<?php echo e($post->thumbnail_path ?? ''); ?>" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted"><?php echo e($post->created_at ?? ''); ?></div>
                            <h2 class="card-title"><?php echo e($post->title ?? ''); ?></h2>
                            <p class="card-text"><?php echo $post->content ?? ''; ?></p> 
                        </div>
                    </div>
                </div>
                <?php echo $__env->make('front.themes.default.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
<?php $__env->stopSection(); ?>      
<?php echo $__env->make('front.themes.default.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views/front/themes/default/single.blade.php ENDPATH**/ ?>