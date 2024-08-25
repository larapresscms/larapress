
<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                  
        <h3 class="text-center p-2"><?php echo e($post->title); ?></h3>                             
        <a class="apply-but " href="<?php echo e(url('/')); ?>/<?php echo e($post->slug); ?>">Apply Now</a>                
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php $__env->stopSection(); ?>      

 
<?php echo $__env->make('front.themes.default.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\default\posts.blade.php ENDPATH**/ ?>