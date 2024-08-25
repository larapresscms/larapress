
<?php $__env->startSection('content'); ?>
<!-- //current post type id -->
<?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if( $posttype->slug ==  collect(request()->segments())->last() ): ?>
        <?php $currnt_posttypeID = $posttype->id; ?> 
        <?php break; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $currnt_posttypeID = $posttype->id ?? ''; ?>

<!-- role mang editor--> 		
<?php $values = explode(',',optional(auth()->user())->posttypes_id); ?>
<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <?php if($vid): ?>  							
        <?php if(optional(auth()->user())->role == 111 || $vid == $currnt_posttypeID): ?>
            <?php $result = $vid; ?>
            <?php break; ?>
        <?php endif; ?>											   
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php $result = $vid ?? ''; ?>
<!-- role mang editor--> 

<?php if(optional(auth()->user())->role == 111 || $result == $currnt_posttypeID): ?>


<!-- Page Heading -->
<h5 class="h5 mb-2 text-gray-800"><a href="<?php echo e(url('/dashboard/posttypes/')); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>    
    <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if( $posttype->slug ==  collect(request()->segments())->last() ): ?>
            <?php echo e($posttype->name); ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-uppercase">     
        <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if( $posttype->slug ==  collect(request()->segments())->last() ): ?>
            All <?php echo e($posttype->name); ?>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(url('/dashboard/posttypes/create/')); ?>/<?php echo e(collect(request()->segments())->last()); ?>" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a>
        </h6>                    
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Title</th> 
                        <th>Slug</th> 
                        <th>Cate</th>
                        <th>P-Type</th>
                        <th>Position</th>
                        <th>Last Edit</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL.</th>
                        <th>Title</th> 
                        <th>Slug</th> 
                        <th>Cate</th>
                        <th>P-Type</th>
                        <th>Position</th>
                        <th>Last Edit</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sl = 0;
                    ?>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <!-- role mang admin--> 
                    <?php if(optional(auth()->user())->role == 111): ?>
                    <tr>
                        <td><?php echo e(++$sl); ?></td>
                        <td>
                        <?php if(auth()->guard()->check()): ?>
                        <?php if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112"): ?>
                            <a href="<?php echo e(url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last())); ?>"><?php echo Str::limit($post->title, 15, ' ...'); ?></a>
                        <?php else: ?>
                        <?php echo Str::limit($post->title, 15, ' ...'); ?>

                        <?php endif; ?>
                        <?php endif; ?>  
                        </td> 
                        <td><?php echo e($post->slug); ?></td>
                        <td>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($post->category_id == $categorie->id): ?>
                                    <?php echo e($categorie->name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                        </td> 
                        <td><?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if( $posttype->slug ==  collect(request()->segments())->last() ): ?>
                                <?php echo e($posttype->name); ?>

                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url($post->post_type)); ?>" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
                        </td> 
                        
                        <td><?php echo e($post->position); ?></td>
                        <td>
                           <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php if($user->id == $post->user_id): ?>
                               <?php echo e($user->name); ?>

                               <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           at <?php echo e($post->updated_at); ?>

                        </td> 

                        <td><?php echo e($post->status == 0 ? 'Unpublish' : 'Publish'); ?></td> 
                        <td><a href="<?php echo e(url($post->post_type, $post->slug)); ?>" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
                        <!-- <a href="<?php echo e(url('dashboard/posts/'.$post->id)); ?>" class="btn btn-success">Show</a> -->
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112"): ?>
                                <!-- check user won post action -->
                                <a href="<?php echo e(url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last())); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                
                                <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($post->id); ?>"><i class="fas fa-trash"></i></a> 
                                    
                                <!-- Delete Modal-->
                                <div class="modal fade" id="logoutModal<?php echo e($post->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                <form action="<?php echo e(url('/dashboard/posts/posttype',$post->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>     
                                                    <?php echo method_field('DELETE'); ?>         
                                                    <input class="d-none" name="post_type" type="text" value="<?php echo e($post->post_type); ?>">                                                 
                                                    <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                </form>                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!-- Delete Modal-->
                                
                            <?php endif; ?>
                        <?php endif; ?>                        

                        </td>                                            
                    </tr>
                    <?php elseif(optional(auth()->user())->role == 112): ?>					
                    <!-- role mang editor--> 
                        <?php $values = explode(',',optional(auth()->user())->posts_id); ?>
                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <?php if($vid): ?>  							
                                <?php if(optional(auth()->user())->role == 111 || $vid == $post->id): ?>
                                <tr>
                                    <td><?php echo e(++$sl); ?></td>
                                    <td>
                                    <?php if(auth()->guard()->check()): ?>
                                    <?php if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112"): ?>
                                        <a href="<?php echo e(url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last())); ?>"><?php echo Str::limit($post->title, 15, ' ...'); ?></a>
                                    <?php else: ?>
                                    <?php echo Str::limit($post->title, 15, ' ...'); ?>

                                    <?php endif; ?>
                                    <?php endif; ?>  
                                    </td> 
                                    <td>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($post->category_id == $categorie->id): ?>
                                                <?php echo e($categorie->name); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                    </td> 
                                    <td><?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if( $posttype->slug ==  collect(request()->segments())->last() ): ?>
                                            <?php echo e($posttype->name); ?>

                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($post->more_option_1); ?></td>
                                    <td>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($user->id == $post->user_id): ?>
                                        <?php echo e($user->name); ?>

                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($post->updated_at); ?></td>
                                    <td><?php echo e($post->status == 0 ? 'Unpublish' : 'Publish'); ?></td> 
                                    <td>
                                    <!-- <a href="<?php echo e(url('dashboard/posts/'.$post->id)); ?>" class="btn btn-success">Show</a> -->
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112"): ?>
                                            <!-- check user won post action -->
                                            <a href="<?php echo e(url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last())); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                            
                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($post->id); ?>"><i class="fas fa-trash"></i></a> 
                                                
                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="logoutModal<?php echo e($post->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                            <a  class="btn btn-danger bbtn">
                                                            <?php echo Form::open(['url' => 'dashboard/posts/posttype/'.$post->id, 'method'=>'delete']); ?>

                                                            <?php echo Form::input('text', 'post_type', $post->post_type, ['class' => 'd-none']); ?>

                                                            <?php echo Form::submit('Delete'); ?>

                                                            <?php echo Form::close(); ?>

                                                            </a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <!-- Delete Modal-->
                                            
                                        <?php endif; ?>
                                    <?php endif; ?>                        

                                    </td>                                            
                                </tr>

                                <?php endif; ?>											   
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 				
                    <?php endif; ?>	
                    <!-- role mang editor--> 
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\posttypes\show.blade.php ENDPATH**/ ?>