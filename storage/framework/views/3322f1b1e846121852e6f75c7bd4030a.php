

<?php $__env->startSection('content'); ?>
<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->categories == 'categories'): ?>
   <!-- Nested Row within Card Body -->
   <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit</h1>
            </div>
            <?php echo Form::open(['url' => '/dashboard/categories/'.$categories->id,'method'=>'patch','class'=>'user']); ?>

<!-- 
            <form class="user" action="<?php echo e(url('/dashboard/categories')); ?>" method="post">
            <?php echo e(csrf_field()); ?> -->
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" name='name' value='<?php echo e($categories->name); ?>' class="form-control form-control-user" id="exampleFirstName"
                            placeholder="First Name">
                    </div> 
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" name='slug' value='<?php echo e($categories->slug); ?>' class="form-control form-control-user" id="exampleFirstName"
                            placeholder="slug">
                    </div> 
                </div>
               

                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <select class="form-control form-select form-select-sm" aria-label=".form-select-sm example" name="status">
                            <option value="0" <?php echo e($categories->status == 0 ? 'selected' : ''); ?>  >Unpublish</option>
                            <option value="1" <?php echo e($categories->status == 1 ? 'selected' : ''); ?>  >Publish</option>
                        </select>
                    </div> 
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                </div>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($message); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- </form> -->
             
            <?php echo Form::close(); ?>


            <hr>
        </div>
    </div>
</div> 
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\categories\edit.blade.php ENDPATH**/ ?>