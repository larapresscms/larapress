

<?php $__env->startSection('content'); ?>
<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->categories == 'categories'): ?>
       <!-- Page Heading -->
       <h5 class="h5 mb-2 text-gray-800">Add New Category <button class="btn btn-primary btn-user"><a href="<?php echo e(url('/dashboard/categories/create')); ?>" class="text-white">Add New</a></button></h5>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th> 
                                            <th>Slug</th>                                            
                                            <th>Posts</th>                                          
                                            <th>Menu</th>                                          
                                            <th>Posttype</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th> 
                                            <th>Slug</th>                                     
                                            <th>Posts</th>                                          
                                            <th>Menu</th>                                          
                                            <th>Posttype</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sl = 0;
                                        ?>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$sl); ?></td>
                                            <td><?php echo e($category->name); ?></td> 
                                            <td><?php echo e($category->slug); ?></td>

                                            <td>
                                            <!-- how many post involved in this cat -->
                                            <?php $countP = 0; ?>
                                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $values = explode(',',$post->category_id); ?>                                                
                                                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                    <?php if($vid == $category->id): ?>                               
                                                    <?php ++$countP  ?>           
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($countP); ?>

                                            <!-- how many post involved in this cat -->
                                            </td>
                                            <td>
                                            <!-- how many menus involved in this cat -->
                                            <?php $countM = 0; ?>
                                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $values = explode(',',$menu->category_id); ?>                                                
                                                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                    <?php if($vid == $category->id): ?>                               
                                                    <?php ++$countM  ?>           
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($countM); ?>

                                            <!-- how many menus involved in this cat -->
                                            </td> 
                                            <td>
                                            <!-- how many posttype involved in this cat -->
                                            <?php $countT = 0; ?>
                                            <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $values = explode(',',$posttype->category_main_id); ?>                                                
                                                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                    <?php if($vid == $category->id): ?>                               
                                                    <?php ++$countT  ?>           
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($countT); ?>

                                            <!-- how many post posttype in this cat -->
                                            </td>  

                                            <td><?php echo e($category->status == 0 ? 'Unpublish' : 'Publish'); ?></td>

                                            <td><a href="<?php echo e(url('dashboard/categories/'.$category->id)); ?>" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                            <a href="<?php echo e(url('dashboard/categories/'.$category->id.'/edit')); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                            
                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($category->id); ?>"><i class="fas fa-trash"></i></a> 
                                    
                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="logoutModal<?php echo e($category->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                            <form action="<?php echo e(url('/dashboard/categories',$category->id)); ?>" method="POST">
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
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\categories\index.blade.php ENDPATH**/ ?>