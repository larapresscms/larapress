

<?php $__env->startSection('content'); ?>
<!-- role mang editor--> 		
<?php $values = explode(',',optional(auth()->user())->posts_id); ?>
<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <?php if($vid): ?>  							
        <?php if(optional(auth()->user())->role == 111 || $vid == $posts->id): ?>
            <?php $result = $vid; ?>
            <?php break; ?>
        <?php endif; ?>											   
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php $result = $vid ?? ''; ?>
<!-- role mang editor--> 

<?php if(optional(auth()->user())->role == 111 || $result == $posts->id): ?>

<h5 class="mb-2 text-gray-800 navbar"><a href="<?php echo e(url('/dashboard/posttypes/')); ?>/<?php echo e(collect(request()->segments())->last()); ?>" class="text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a><a href="<?php echo e(url($posts->post_type, $posts->slug)); ?>" target="_blank" class="text-decoration-none">View Page</a></h5>  

<form class="user" action="<?php echo e(url('/dashboard/posts/posttype/')); ?>/<?php echo e($posts->id); ?>" method="POST" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<?php echo method_field('PATCH'); ?>
    <div class="row">    
        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit a <?php echo e(collect(request()->segments())->last()); ?>!</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <?php if($posttypeSlug->title != "#"): ?>                        
                            <input type="text" name='title' class="form-control form-control-user labelBalloon" id="exampleFirstName"
                                placeholder="<?php echo e($posttypeSlug->title); ?>" value="<?php echo e($posts->title); ?>"><label for="exampleFirstName"><?php echo e($posttypeSlug->title); ?></label>
                            <?php else: ?>                                  
                            <input type="hidden" name='title' value="<?php echo e($posts->title); ?>" class="form-control form-control-user" id="exampleFirstName"
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
                        <textarea name="content"><?php echo e($posts->content); ?></textarea>  
                        <?php else: ?>
                        <!-- editor 2-->                
                        <textarea id="html" name="content"><?php echo $posts->content; ?></textarea>
                        <textarea id="css" name="content_css"><?php echo $posts->content_css; ?></textarea>                
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
                            <input type="text" name='excerpt' value="<?php echo e($posts->excerpt); ?>" class="form-control form-control-user labelBalloon" placeholder="<?php echo e($posttypeSlug->excerpt); ?>" id="excerpt"><label for="excerpt"><?php echo e($posttypeSlug->excerpt); ?></label>
                        <?php endif; ?>
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <?php if($posttypeSlug->option_1 != "#"): ?>
                            <input type="text" name='option_1' value="<?php echo e($posts->option_1); ?>" id="option_1" class="form-control form-control-user labelBalloon" placeholder="<?php echo e($posttypeSlug->option_1); ?>"> <label for="option_1"><?php echo e($posttypeSlug->option_1); ?></label>
                            <?php endif; ?>
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <?php if($posttypeSlug->option_2 != "#"): ?>
                            <input type="text" name='option_2' value="<?php echo e($posts->option_2); ?>" id="option_2" class="form-control form-control-user labelBalloon" placeholder="<?php echo e($posttypeSlug->option_2); ?>"><label for="option_2"><?php echo e($posttypeSlug->option_2); ?></label>
                            <?php endif; ?>
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <?php if($posttypeSlug->option_3 != "#"): ?>
                            <input type="text" name='option_3' value="<?php echo e($posts->option_3); ?>" id="option_3" class="form-control form-control-user labelBalloon" placeholder="<?php echo e($posttypeSlug->option_3); ?>"><label for="option_3"><?php echo e($posttypeSlug->option_3); ?></label>
                        <?php endif; ?> 
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <?php if($posttypeSlug->option_4 != "#"): ?>
                            <input type="text" name='option_4' value="<?php echo e($posts->option_4); ?>" id="option_4" class="form-control form-control-user labelBalloon" placeholder="<?php echo e($posttypeSlug->option_4); ?>"><label for="option_4"><?php echo e($posttypeSlug->option_4); ?></label>
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
                                <input type="text" name='more_option_1' id="more_option_1" value="<?php echo e($posts->more_option_1); ?>" class="form-control form-control-user labelBalloon" placeholder="<?php echo e($posttypeSlug->more_option_1); ?>"> <label for="more_option_1"><?php echo e($posttypeSlug->more_option_1); ?></label>
                            <?php endif; ?>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <?php if($posttypeSlug->more_option_2 != "#"): ?>
                                <textarea name="more_option_2" class="form-control"><?php echo $posts->more_option_2; ?></textarea>
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
                    <p class="mb-2 text-primary">Author: 
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($user->id == $posts->user_id): ?>
                                <?php echo e($user->name); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></p> 
                    <p class="mb-2 text-primary">Publish Date: <?php echo e($posts->updated_at); ?></p>  
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">  
                            <input type="text" name='slug' value="<?php echo e($posts->slug); ?>" id="slug" class="form-control form-control-user form-select-sm labelBalloon" placeholder="Slug"> <label for="slug">Slug</label>
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">   
                            <input type="text" name='position' value="<?php echo e($posts->position); ?>" id="position" class="form-control form-control-user form-select-sm labelBalloon" placeholder="Position"><label for="position">Position</label> 
                        </div>
                    </div> 
                    <div class="form-group">
                        <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($posts->post_type == $posttype->slug): ?>
                        <input type="text" name='post_type' class="form-control form-control-user" id="exampleFirstName" value='<?php echo e($posttype->slug); ?>' readonly>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-user form-select form-select-sm custom-select" aria-label=".form-select-sm example" name="status">                            
                            <option value="0" <?php echo e($posts->status == 0 ? 'selected' : ''); ?>  >Unpublish</option>
                            <option value="1" <?php echo e($posts->status == 1 ? 'selected' : ''); ?>  >Publish</option>
                        </select>
                    </div> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                    </div>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($message); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <input type="text" name='categori_name' class="form-control form-select-sm form-control-user" placeholder="Creat a new">
                    </div> 
                    <div class="form-group scrollCat">                         

                        
                        <?php $__currentLoopData = $specificCatOnly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specificCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <label class="form-check">
                            <input class="form-select form-select-sm form-check-input checkchild" name="category_id[]" type="checkbox" value="<?php echo e($specificCat->id); ?>"  
                            
                            <?php $values = explode(',',$posts->category_id); ?>
                            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <?php if($vid): ?>                                                
                                    <?php echo e($vid == $specificCat->id ? 'checked':''); ?>               
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            >
                            <span class="form-check-label"><?php echo e($specificCat->name); ?></span> 
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <!-- <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_id">
                                <option value="0" selected>No Categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select> -->
                        
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
                            <input type="hidden" id="type" name='thumbnail_path' placeholder="Image Url" class="form-control" value="<?php echo e($posts->thumbnail_path); ?>">
                            <img id="myImg" src="<?php echo e($posts->thumbnail_path == null ? asset('public/admin/img/dummy-image-square.jpg') : asset('public/uploads/images').'/'.$posts->thumbnail_path); ?>" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">
                            <button type="button" onclick="removeValue('<?php echo e(url('public/admin/img/dummy-image-square.jpg')); ?>')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>                        
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
                    <div class="form-group ">
                        <div class="mb-3">
                            <div class="form-group">                            
                                <img id="myImg" src="<?php echo e(asset('public/admin/img/dummy-image-square.jpg')); ?>" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalGallery" class="border border-info">
                            </div> 
                        </div> 
                        <div class="row container1">  
                            
                        <?php $values = explode(",",$posts->gallery_img); ?>
                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($imgid): ?>
                            <div class="col-md-3 col-sm-12">
                                <div class="mb-3 removeClass">
                                    <input type="hidden" name="gallery_img[]" value="<?php echo e($imgid); ?>">
                                    <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($imgid); ?>" width="100%" height="auto" class="border border-info">
                                    <a href="#" class="delete">Delete</a>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- generate image container1 -->
                        </div>
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
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>

<!-- Insert Image from library -->
<?php echo $__env->make('admin.media.medialibrary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.media.mediauploads', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Modal -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\posttypes\underposttype\editunderposttype.blade.php ENDPATH**/ ?>