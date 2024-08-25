
<?php $__env->startSection('content'); ?>
<section class="cart-thank section-bg padding-y-120 position-relative z-index-1 overflow-hidden">
    <img src="<?php echo e(asset('public/front/laratheme/assets/images/gradients/thank-you-gradient.png')); ?>" alt="" class="bg--gradient">    
    <div class="container container-two">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="cart-thank__content text-center">
                    <h2 class="cart-thank__title mb-48">Thank you for your interest in Larapress CMS!!</h2>
                    <p><?php echo e($postss); ?></p>
                    <div class="cart-thank__img">
                        <img src="<?php echo e(asset('public/front/laratheme/assets/images/thumbs/thank-evenelope.png')); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>
<?php $__env->stopSection(); ?>      
<?php echo $__env->make('front.themes.'.$themeName.'.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\email\mail.blade.php ENDPATH**/ ?>