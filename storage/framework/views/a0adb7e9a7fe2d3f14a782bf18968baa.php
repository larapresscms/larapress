

<?php $__env->startSection('content'); ?>
<!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h4 class="fw-bolder"><?php echo e($page->title); ?></h4>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <img class="card-img-top" src="<?php echo e($page->thumbnail_path); ?>"/>
                        <div class="card-body">
                            <h2 class="card-title"></h2>
                            <style>
                                <?php echo $page->content_css; ?>

                            </style>
                            <p class="card-text"><?php echo $page->content; ?></p> 
                        </div>
                    </div>
                </div>

            </div>
        </div>
<?php $__env->stopSection(); ?>      
<?php echo $__env->make('front.themes.default.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\default\page.blade.php ENDPATH**/ ?>