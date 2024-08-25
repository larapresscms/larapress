
<?php $__env->startSection('content'); ?>
<!-- role mang editor--> 		
<?php $values = explode(',',optional(auth()->user())->posttypes_id); ?>
<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <?php if($vid): ?>  							
        <?php if(optional(auth()->user())->role == 111 || $vid == $posttypeSlug->id): ?>
            <?php $result = $vid; ?>
            <?php break; ?>
        <?php endif; ?>											   
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php $result = $vid ?? ''; ?>
<!-- role mang editor--> 

<?php if(optional(auth()->user())->role == 111 || $result == $posttypeSlug->id): ?>

<h5 class="h5 mb-2 text-gray-800"><a href="<?php echo e(url('/dashboard/posttypes/')); ?>/<?php echo e(collect(request()->segments())->last()); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Back</h5>

<form class="user" action="<?php echo e(url('/dashboard/posts/posttypes')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <div class="row">    

        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create a <?php echo e(collect(request()->segments())->last()); ?>!</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <?php if($posttypeSlug->title != "#"): ?>                        
                            <input type="text" name='title' class="form-control form-control-user labelBalloon" id="exampleFirstName"
                                placeholder="<?php echo e($posttypeSlug->title); ?>"><label for="exampleFirstName"><?php echo e($posttypeSlug->title); ?></label>
                            <?php else: ?>                                  
                            <input type="hidden" name='title' value="Untitled" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="">
                            <?php endif; ?>                            
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="hidden" name='user_id' class="form-control form-control-user" id="exampleFirstName"
                                placeholder="user" value="<?php if(auth()->guard()->check()): ?><?php echo e(optional(auth()->user())->id); ?><?php endif; ?>">
                        </div> 
                    </div>
                    <!-- editor -->
                    <?php if($posttypeSlug->content != "#"): ?>
                        <!-- choose editor  -->
                        <?php if($settingsAdmin->editor == "classic"): ?>
                        <!-- editor 1-->
                            <textarea name="content"></textarea>  
                        <?php else: ?>
                        <!-- editor 2-->                
                        <textarea id="html" name="content"></textarea>
                        <textarea id="css" name="content_css"></textarea>                
                        <div id="gjs" style="height:500px !important;"></div>                      
                        <?php endif; ?>  
                    <?php endif; ?>


                </div>
            </div>

            <?php if($posttypeSlug->excerpt != "#" || $posttypeSlug->option_1 != "#" || $posttypeSlug->option_2 != "#" || $posttypeSlug->option_3 != "#" || $posttypeSlug->option_4 != "#"): ?>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">More Fields for <?php echo e(collect(request()->segments())->last()); ?></h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <?php if($posttypeSlug->excerpt != "#"): ?>
                            <input type="text" name='excerpt' class="form-control form-control-user labelBalloon" id="excerpt" placeholder="<?php echo e($posttypeSlug->excerpt); ?>">
                            <label for="excerpt"><?php echo e($posttypeSlug->excerpt); ?></label>
                        <?php endif; ?>
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <?php if($posttypeSlug->option_1 != "#"): ?>
                            <input type="text" name='option_1' class="form-control form-control-user labelBalloon" id="option_1" placeholder="<?php echo e($posttypeSlug->option_1); ?>">
                            <label for="option_1"><?php echo e($posttypeSlug->option_1); ?></label> 
                            <?php endif; ?>
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <?php if($posttypeSlug->option_2 != "#"): ?>
                            <input type="text" name='option_2' class="form-control form-control-user labelBalloon" id="option_2" placeholder="<?php echo e($posttypeSlug->option_2); ?>">
                            <label for="option_2"><?php echo e($posttypeSlug->option_2); ?></label> 
                            <?php endif; ?>
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <?php if($posttypeSlug->option_3 != "#"): ?>
                            <input type="text" name='option_3' class="form-control form-control-user labelBalloon" id="option_3" placeholder="<?php echo e($posttypeSlug->option_3); ?>">
                            <label for="option_3"><?php echo e($posttypeSlug->option_3); ?></label> 
                        <?php endif; ?> 
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <?php if($posttypeSlug->option_4 != "#"): ?>
                            <input type="text" name='option_4' class="form-control form-control-user labelBalloon" id="option_4" placeholder="<?php echo e($posttypeSlug->option_4); ?>">
                            <label for="option_4"><?php echo e($posttypeSlug->option_4); ?></label> 
                        <?php endif; ?>
                        </div> 
                    </div> 

                </div>
            </div>
            <?php endif; ?>

            <?php if($posttypeSlug->more_option_1 != "#" || $posttypeSlug->more_option_2 != "#"): ?>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">More Fields for <?php echo e(collect(request()->segments())->last()); ?></h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <?php if($posttypeSlug->more_option_1 != "#"): ?>
                                <input type="text" name='more_option_1' class="form-control form-control-user labelBalloon" id="more_option_1" placeholder="<?php echo e($posttypeSlug->more_option_1); ?>"> 
                            <label for="more_option_1"><?php echo e($posttypeSlug->more_option_1); ?></label> 
                            <?php endif; ?>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <?php if($posttypeSlug->more_option_2 != "#"): ?>
                                <textarea name="more_option_2" class="form-control"></textarea>
                            <?php endif; ?>
                        </div>  
                    </div>

                </div>
            </div>
            <?php endif; ?>

        </div>
        <!-- Pie Chart -->
        <div class="col-xl-3 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Publish</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group row"> 
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <input type="text" name='position' value="" class="form-control form-control-user form-select-sm labelBalloon" id="positionId" placeholder="Position"><label for="positionId">Position</label>  
                        </div>
                    </div> 
                    <div class="form-group">
                        <input class="form-control form-select form-control-user form-select-sm" aria-label=".form-select-sm example" name="post_type" value="<?php echo e(collect(request()->segments())->last()); ?>" readonly>
                    </div> 
                    <div class="form-group row">                           
                        <div class="col-sm-12 mb-3 mb-sm-0">                  
                            <select class="form-control form-control-user form-select form-select-sm custom-select" aria-label=".form-select-sm example" name="status">                            
                                <option value="1" selected>Publish</option>    
                                <option value="0">Unpublish</option>
                            </select>
                        </div>
                    </div> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Publish</button>
                    </div> 
                </div>
            </div>


            <?php if($posttypeSlug->category_id != "#"): ?>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e($posttypeSlug->category_id); ?></h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group">                                
                        <input type="text" name='categori_name' class="form-control form-control-user form-select-sm" placeholder="Creat a new">
                    </div> 
                    <div class="form-group scrollCat">
                        
                        <?php $__currentLoopData = $specificCatOnly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specificCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <label class="form-check">
                            <input class="form-select form-select-sm form-check-input checkchild" name="category_id[]" type="checkbox" value="<?php echo e($specificCat->id); ?>">
                            <span class="form-check-label"><?php echo e($specificCat->name); ?></span> 
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                    </div>                                        
                </div>
            </div>
            <?php else: ?>
               <input type="hidden" name="category_id" value=""> 
            <?php endif; ?>
            
            <?php if($posttypeSlug->thumbnail_path != "#"): ?>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e($posttypeSlug->thumbnail_path); ?></h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                    
                    <div class="form-group">                       
                            <input type="hidden" id="type" name='thumbnail_path' placeholder="Image Url" class="form-control" >
                            <img id="myImg" src="<?php echo e(asset('public/admin/img/dummy-image-square.jpg')); ?>" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">
                            <button type="button" onclick="removeValue('<?php echo e(url('/public/admin/img/dummy-image-square.jpg')); ?>')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>                        
                    </div>
                </div>
            </div>
            <?php endif; ?> 

            <?php if($posttypeSlug->gallery_img != "#"): ?>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e($posttypeSlug->gallery_img); ?> for <?php echo e(collect(request()->segments())->last()); ?></h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                    
                    <div class="form-group">
                        <div class="mb-3">
                            <div class="form-group">                            
                                <img id="myImg" src="<?php echo e(asset('/public/admin/img/dummy-image-square.jpg')); ?>" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalGallery" class="border border-info">
                            </div> 
                        </div> 
                        <div class="row container1"></div>   
                    <!-- generate image container1 -->
                    </div>

                </div>
            </div>
            <?php else: ?>
            <!-- tempory value  -->
            <input type="hidden" name="gallery_img[]" >
            <?php endif; ?>

        </div>
    </div>
</form>
<!-- Insert Image from library -->
<?php echo $__env->make('admin.media.medialibrary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.media.mediauploads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Modal -->
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\posttypes\underposttype\createppost.blade.php ENDPATH**/ ?>