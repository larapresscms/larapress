
<?php $__env->startSection('content'); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">  
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">What's New v1.1</h1>
                <hr>
                <p class="lead"></p>
                <p>Fav icon fix.</p>
                <p>Post type url fix.</p>
                <p>Menu url fix. Add post type.</p>
                <p>404 page create</p>                
            </div>  
            <div class="container"> 
            <h1>LaraPress Update Available.</h1>
            <a href="<?php echo e(url('/dashboard/update')); ?>" class="btn btn-primary">Install Update</a>    
            </div>       
        </div>
    </div>                       
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\larapress-packages\packages\larapress\src\Resources\views/admin/about.blade.php ENDPATH**/ ?>