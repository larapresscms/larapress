
<?php $__env->startSection('content'); ?>

<?php if(optional(auth()->user())->role == 111): ?>
 <!-- Nested Row within Card Body -->
 <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit a Home Page!</h1>
            </div>
            <form class="user" action="<?php echo e(url('/dashboard/settings/')); ?>/<?php echo e($settings->id); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <?php echo method_field('PATCH'); ?> 
                <div class="form-group row">
                    <div class="col-sm-8 mb-3 mb-sm-0">
                        <div class="form-group">
                            <label for="floatingSiteTitle" class="form-label">Site Title</label>
                            <input type="text" name='site_title' value="<?php echo e($settings->site_title); ?>" class="form-control form-control-user" id="floatingSiteTitle"
                            placeholder="Site Title">
                        </div>
                        <div class="form-group">
                            <label for="floatingSubTitle" class="form-label">Sub Title</label>
                            <input type="text" name='sub_title' value="<?php echo e($settings->sub_title); ?>" class="form-control form-control-user" id="floatingSubTitle"
                            placeholder="Sub Title">
                        </div>
                        <div class="form-group">
                            <label for="floatingInputDashboard" class="form-label">Dashboard Color</label>
                            <input type="color" name='dashboard_color' value="<?php echo e($settings->dashboard_color); ?>" class="form-control form-control-user panel_color" id="floatingInputDashboard"
                                placeholder="Dashboard Color"> 
                        </div>
                        
                        <div class="form-group">
                        <label for="floatingText" class="form-label">Text Color</label>
                            <input type="color" name='text_color' value="<?php echo e($settings->text_color); ?>" class="form-control form-control-user panel_color" id="floatingText"
                                    placeholder="Text Color">
                        </div>
                        <div class="form-group">
                        <label for="floatingInputHover" class="form-label">Text Hover Color</label>
                            <input type="color" name='text_hover' value="<?php echo e($settings->text_hover); ?>" class="form-control form-control-user panel_color" id="floatingInputHover"
                                    placeholder="Text Hover Color">
                        </div>
                        <!-- //create theme name as folder name  -->
                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Theme folder Name</label>
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="theme_url">
                                <option value="default" selected>No theme set</option> 
                                <?php
                                    $foler_names = [];
                                    $i = 0;                                    

                                    // Define the paths
                                    $mainResourceDir = resource_path('views/front/themes');
                                    $packageDir = base_path('packages/larapress/src/resources/views/front/themes');

                                    // Initialize an empty array to hold the merged directory list
                                    $mergedDirList = [];

                                    // Scan the main resource directory
                                    if (is_dir($mainResourceDir)) {
                                        $dirList = scandir($mainResourceDir);
                                        foreach ($dirList as $value) {
                                            if (strpos($value, '.') === false) {
                                                $mergedDirList[$value] = $value;
                                            }
                                        }
                                    }

                                    // Scan the package directory
                                    if (is_dir($packageDir)) {
                                        $dirList = scandir($packageDir);
                                        foreach ($dirList as $value) {
                                            if (strpos($value, '.') === false) {
                                                $mergedDirList[$value] = $value;
                                            }
                                        }
                                    }

                                    // Iterate through the merged directory list and output options
                                    foreach ($mergedDirList as $value) {
                                        ?>
                                        <option value="<?php echo e($value); ?>" <?php echo e($value == $settingsAdmin->theme_url ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                        <?php
                                    } 
                                    ?>  
                            </select>                            
                        </div>  

                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Home Page Name</label>
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="home_url">
                                <option value="0" selected>No Home page set</option>
                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($post->id); ?>" <?php echo e($post->id == $settingsAdmin->home_url ? 'selected' : ''); ?>><?php echo e($post->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editor" class="form-label">Editor Choose</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-label mr-1" for="editor1">Classic </label>
                                    <input class="form-check-input" type="radio" name="editor" id="editor1" value="classic" <?php echo e($settings->editor == "classic" ? 'checked' : ''); ?>>                                    
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-label mr-1" for="editor2">Visual </label>
                                    <input class="form-check-input" type="radio" name="editor" id="editor2" value="visual" <?php echo e($settings->editor == "visual" ? 'checked' : ''); ?>>                                    
                                </div>
                            </div>                            
                        </div>


                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0 text-center">
                        <div class="form-group">
                            <label class="form-check-label form-label mr-1" for="">Website Logo</label><br>
                            <input type="hidden" id="type" name='site_logo' value="<?php echo e($settings->site_logo); ?>" placeholder="Image Url" class="form-control" >                              
                            <img id="myImg" src="<?php echo e($settings->site_logo == null ? asset('public/admin/img/dummy-image-square.jpg') : asset('public/uploads/images/').'/'.$settings->site_logo); ?>" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">
                            <button type="button" onclick="removeValue('<?php echo e(url('public/admin/img/dummy-image-square.jpg')); ?>')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>
                        </div> 
                        <!-- fevicon  -->
                        <div class="form-group">
                            <label for="floatingfevicon" class="form-label">Favicon Image Link:</label>
                            <input type="text" name='fav_icon' value="<?php echo e($settings->fav_icon); ?>" class="form-control form-control-user" id="floatingfevicon"
                            placeholder="Example: 12423223.jpg">
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>                            
            </form>            
            <hr>
        </div>
    </div>
</div> 

<!-- Insert Image from library -->
<?php echo $__env->make('admin.media.medialibrary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.media.mediauploads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Modal -->
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\settings\edit.blade.php ENDPATH**/ ?>