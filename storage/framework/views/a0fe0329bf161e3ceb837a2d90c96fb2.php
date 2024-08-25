

<?php $__env->startSection('content'); ?>
<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->categories == 'categories'): ?>
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Category Show</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category</h6> <br/>
                            Name: <?php echo e($categories->name); ?> <br/><hr/>
                            Slug: <?php echo e($categories->slug); ?> <br/><hr/>
                            Status: <?php echo e($categories->status == 0 ? 'Unpublish' : 'Publish'); ?>

                        </div>
                       
                    </div>
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\categories\show.blade.php ENDPATH**/ ?>