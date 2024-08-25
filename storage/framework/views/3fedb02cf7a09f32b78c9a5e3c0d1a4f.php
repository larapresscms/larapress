

<?php $__env->startSection('content'); ?>
<?php if(session()->has('messageDestroy')): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo e(session('messageDestroy')); ?>

    </div> 
    <?php endif; ?>
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h4 class="mb-0">Hi <span class="text-info"><?php if(auth()->guard()->check()): ?> <?php echo e(optional(auth()->user())->name); ?>, <?php endif; ?></span> Welcome back.</h4>
        <div class="small">
            <span><?php echo e(date('l jS \of F Y g:i a')); ?></span> 
        </div>
    </div>
</div>

<!-- <div class="row mb-4">
    <div class="col-xl-12 col-lg-12">
    <a class="weatherwidget-io" href="https://forecast7.com/en/23d6890d36/bangladesh/" data-label_1="BANGLADESH" data-label_2="WEATHER" data-theme="original" >BANGLADESH WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
    </div>
</div> -->

<!-- Content Row -->
<div class="row">
<?php if(optional(auth()->user())->role == 111): ?> 
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            All Page</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e($posts->count()); ?>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-thumbtack fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Media</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($media->count()); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-copy fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($users->count()); ?></div>
                            </div>
                            <!--<div class="col">-->
                            <!--    <div class="progress progress-sm mr-2">-->
                            <!--        <div class="progress-bar bg-info" role="progressbar"-->
                            <!--            style="width: 0%" aria-valuenow="50" aria-valuemin="0"-->
                            <!--            aria-valuemax="100"></div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($categories->count()); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <!-- dynamic posts type  -->
    <?php $__currentLoopData = $posttypes_inDash; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($posttype->in_menu_swh == '1'): ?>

        
        <?php if(optional(auth()->user())->role == 111): ?> 

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-color shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-posttype-color text-uppercase mb-1"><?php echo e($posttype->name); ?></div>
                            <?php $cont = 0; ?>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($post->post_type == $posttype->slug): ?>                                    
                                    <?php $cont += 1 ?>                                     
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($cont); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="<?php echo e($posttype->menu_icon != 0 ? $posttype->menu_icon : 'fas fa-thumbtack'); ?> fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php elseif(optional(auth()->user())->role == 112): ?>
            <!-- role mang --> 
            <?php $values = explode(',',optional(auth()->user())->posttypes_id); ?>
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if($vid): ?>  
                
                    <?php if(optional(auth()->user())->role == 111 || $vid == $posttype->id): ?>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-color shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-posttype-color text-uppercase mb-1"><?php echo e($posttype->name); ?></div>
                                        <?php $cont = 0; ?>
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($post->post_type == $posttype->slug): ?>                                    
                                                <?php $cont += 1 ?>                                     
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($cont); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="<?php echo e($posttype->menu_icon != 0 ? $posttype->menu_icon : 'fas fa-thumbtack'); ?> fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                                
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

        <?php endif; ?>	


        
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- End dynamic posts type  --> 

</div>

<!-- <form class="navbar-form navbar-left" method="GET" action="<?php echo e(url('dashboard/search')); ?>">
<?php echo e(csrf_token()); ?>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
            <button class="btn btn-default" type="submit">
              <i class="fa fa-search"></i>
            </button>
        </div>
      </form> -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\larapress-packages\packages\larapress\src\Resources\views/admin/index.blade.php ENDPATH**/ ?>