
<?php $__env->startSection('content'); ?>
   <!-- Nested Row within Card Body -->
   <div class="row justify-content-md-center">         
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">  
                    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-4" href="<?php echo e(url('/')); ?>">
                        <div class="sidebar-brand-icon rotate-n-15">
                        </div>
                        <div class="sidebar-brand-text mx-3">
                            <div>
                                <img src="<?php echo e($settingsAdmin->site_logo ? url('public/uploads/images/'.$settingsAdmin->site_logo) : asset('public/admin/img/larapress.png')); ?>" class="img-fluid" width="100%" alt="Logo">
                             </div>
                        </div>
                    </a> 
                    <!--<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>-->
                </div>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                 
                <?php if(session()->has('message')): ?>
                    <div class="alert alert-<?php echo e(session('type')); ?>">
                    <?php echo session('message'); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(url('/login')); ?>" method="post" class="user">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="emailHelp"
                            placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Remember
                                Me</label>
                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                </form>
                <hr>
                <div class="text-center">
                    <!--<a class="small" href="forgot-password.html">Forgot Password?</a>-->
                </div>
                <div class="text-center">
                    <a class="small text-decoration-none" href="<?php echo e(url('/register')); ?>">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.user.front.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\user\front\login.blade.php ENDPATH**/ ?>