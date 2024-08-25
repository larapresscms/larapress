
<?php $__env->startSection('content'); ?>

<?php if(optional(auth()->user())->role == 111): ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">General</h1>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"> 

        <?php $settingN = 0; ?>
            <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group row">
                <div class="col-12">
                    <div class="p-2">Site Title: <?php echo e($setting->site_title); ?></div>
                    <div class="p-2" style="background-color: <?php echo e($setting->dashboard_color); ?>; color: <?php echo e($setting->text_color); ?>">Dashboard Color</div>
                    <div class="p-2" style="color: <?php echo e($setting->text_color); ?>">Text Color</div>
                    <div class="p-2" style="color: <?php echo e($setting->text_hover); ?>">Text Hover Color</div>
                    <div class="p-2 bg-primary text-white">Theme Name: <?php echo e($setting->theme_url); ?></div> 
                    <div class="p-2 bg-primary text-white">Set Home Page: <?php echo e($setting->home_url); ?></div> 
                    <div class="p-2">Theme Editor: <?php echo e($setting->editor == "classic" ? 'Classic' : 'Visual'); ?></div> 
                    <img class="p-2" src="<?php echo e($settingsAdmin->site_logo ? url('/public/uploads/images/'.$settingsAdmin->site_logo) : asset('public/admin/img/larapress.png')); ?>" width="100px"/>
                </div>              
            </div>  
            <div class="form-group">
                <a href="<?php echo e(url('dashboard/settings/'.$setting->id.'/edit')); ?>" class="btn btn-primary">Edit</a>
            </div>
            <?php $settingN = 1; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        
            <?php if($settingN == 0): ?>
            <a class="collapse-item btn btn-primary" href="<?php echo e(url('/dashboard/settings/create')); ?>">Add New</a>
            <?php endif; ?>  
        </div>
    </div>
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\settings\index.blade.php ENDPATH**/ ?>