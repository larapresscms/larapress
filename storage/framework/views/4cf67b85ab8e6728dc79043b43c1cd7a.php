
<?php $__env->startSection('content'); ?>

<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->media == 'media'): ?>

       <!-- Page Heading -->
       <h5 class="h5 mb-2 text-gray-800">Add New Media <a href="<?php echo e(url('/dashboard/media/create')); ?>" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Media Library</button> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalGallery">Media Gallery</button></h5>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Media</h6>  
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Image</th> 
                                            <th>Permalink</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Image</th> 
                                            <th>Permalink</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sl = 0;
                                        ?>
                                        <?php $__currentLoopData = $medies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$sl); ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($media->img_name); ?>">
                                                <?php
                                                $link = "asset('public/uploads/images/')/$media->img_name";
                                                $file_extension = pathinfo($link, PATHINFO_EXTENSION);
                                                if ($file_extension == "pdf" || $file_extension == "xlsx") {
                                                ?>
                                                <a class="btn btn-info bbtn"><i class="fas fa-file"></i></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($media->img_name); ?>" width="100" alt="Image"/>
                                                <?php 
                                                }
                                                ?>
                                                </a>
                                            </td>
                                            <td><?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($media->img_name); ?></td> 

                                            <td> 
                                            <?php if(optional(auth()->user())->role == 111): ?>
                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($media->id); ?>"><i class="fas fa-trash"></i></a> 
                                            <?php endif; ?>
                                    
                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="logoutModal<?php echo e($media->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Select "Delete" below if you are ready to Permanently delete your current data.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>                                                            
                                                            <form action="<?php echo e(url('/dashboard/media',$media->id)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>     
                                                                <?php echo method_field('DELETE'); ?>                                                           
                                                                <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                            </form>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <!-- Delete Modal-->
                                            
                                            </td>
                                        </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
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




<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\larapress-packages\packages\larapress\src\Resources\views/admin/media/index.blade.php ENDPATH**/ ?>