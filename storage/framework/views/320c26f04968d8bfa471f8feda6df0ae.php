

<?php $__env->startSection('content'); ?>
  <!-- Nested Row within Card Body -->
  <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>                

                <form action="<?php echo e(url('/register')); ?>" method="post" class="user">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="First Name" value="<?php echo e(old('name')); ?>">
                     </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                            placeholder="Email Address" value="<?php echo e(old('email')); ?>">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user"
                                id="exampleInputPassword" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                id="exampleRepeatPassword" placeholder="Repeat Password">
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block"> Register Account</button>
                    </div>
                    
                    
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="<?php echo e(url('/login')); ?>">Already have an account? Login!</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\user\backend\create.blade.php ENDPATH**/ ?>