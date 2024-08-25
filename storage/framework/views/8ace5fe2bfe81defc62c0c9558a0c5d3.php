<!DOCTYPE html>
<html>
<body>
<?php $__currentLoopData = $name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<p><?php echo e(ucfirst($k)); ?> = <?php echo e($v); ?></p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html> <?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\email\mailbody.blade.php ENDPATH**/ ?>