

<?php $__env->startSection('content'); ?>
<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->menus == 'menus'): ?>
       <!-- Page Heading -->
       <h5 class="h5 mb-2 text-gray-800">Add New Menu <a href="<?php echo e(url('/dashboard/menu/create')); ?>" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a></h5>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Menus</h6> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th>  
                                            <th>Menu Name</th> 
                                            <th>Last Edit</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th>  
                                            <th>Menu Name</th> 
                                            <th>Last Edit</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sl = 0;
                                        ?>
                                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($menu->sub_menu_id == 0): ?>
                                            <tr>
                                                <td><?php echo e(++$sl); ?></td>
                                                <td>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($menu->category_id == $categorie->id): ?>
                                                        <?php echo e($categorie->name); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                                </td>
                                                <td><?php echo e($menu->title); ?></td>  

                                                <td>
                                                   <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <?php if($user->id == $menu->user_id): ?>
                                                       <?php echo e($user->name); ?>

                                                       <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   at <?php echo e($menu->updated_at); ?>

                                                </td> 

                                                <td><?php echo e($menu->status == 0 ? 'Unpublish' : 'Publish'); ?></td>

                                                <td><a href="<?php echo e(url('dashboard/menu/'.$menu->id)); ?>" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                                <a href="<?php echo e(url('dashboard/menu/'.$menu->id.'/edit')); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                                <?php if(optional(auth()->user())->role == 111): ?>
                                                <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($menu->id); ?>"><i class="fas fa-trash"></i></a> 
                                                <?php endif; ?>
                                        
                                                <!-- Delete Modal-->
                                                <div class="modal fade" id="logoutModal<?php echo e($menu->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Select "Delete - <?php echo e($menu->title); ?>" below if you are ready to Permanently delete your current data.</div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <form action="<?php echo e(url('/dashboard/menu',$menu->id)); ?>" method="POST">
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
                                        
                                            <!-- //find sub menu -->
                                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($menu->id == $submenu->sub_menu_id && $submenu->sub_menu_id != 0): ?>
                                                <tr>
                                                    <td><?php echo e(++$sl); ?></td>
                                                    <td>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($submenu->category_id == $categorie->id): ?>
                                                            <?php echo e($categorie->name); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                                    </td>
                                                    <td> _<?php echo e($submenu->title); ?></td>  

                                                    <td>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($user->id == $submenu->user_id): ?>
                                                        <?php echo e($user->name); ?>

                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    at <?php echo e($submenu->updated_at); ?>

                                                    </td> 

                                                    <td><?php echo e($submenu->status == 0 ? 'Unpublish' : 'Publish'); ?></td>

                                                    <td><a href="<?php echo e(url('dashboard/menu/'.$submenu->id)); ?>" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                                    <a href="<?php echo e(url('dashboard/menu/'.$submenu->id.'/edit')); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                                    <?php if(optional(auth()->user())->role == 111): ?>
                                                    <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($submenu->id); ?>"><i class="fas fa-trash"></i></a> 
                                                    <?php endif; ?>
                                                    <!-- Delete Modal-->
                                                    <div class="modal fade" id="logoutModal<?php echo e($submenu->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Select "Delete - <?php echo e($submenu->title); ?>" below if you are ready to Permanently delete your current data.</div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                    <a  class="btn btn-danger bbtn">
                                                                    <?php echo Form::open(['url' => 'dashboard/menu/'.$submenu->id, 'method'=>'delete']); ?>

                                                                    <?php echo Form::submit('Delete'); ?>

                                                                    <?php echo Form::close(); ?>

                                                                    </a>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <!-- Delete Modal-->
                                                    
                                                    </td>
                                                </tr>

                                                    <!-- //find sub menu -->
                                                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($submenu->id == $submenu2->sub_menu_id && $submenu2->sub_menu_id != 0): ?>
                                                        <tr>
                                                            <td><?php echo e(++$sl); ?></td>
                                                            <td>
                                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($submenu2->category_id == $categorie->id): ?>
                                                                    <?php echo e($categorie->name); ?>

                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                                            </td>
                                                            <td>  __<?php echo e($submenu2->title); ?></td>  

                                                            <td>
                                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($user->id == $submenu2->user_id): ?>
                                                                <?php echo e($user->name); ?>

                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            at <?php echo e($submenu2->updated_at); ?>

                                                            </td> 

                                                            <td><?php echo e($submenu2->status == 0 ? 'Unpublish' : 'Publish'); ?></td>

                                                            <td><a href="<?php echo e(url('dashboard/menu/'.$submenu2->id)); ?>" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                                            <a href="<?php echo e(url('dashboard/menu/'.$submenu2->id.'/edit')); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                                            <?php if(optional(auth()->user())->role == 111): ?>
                                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($submenu2->id); ?>"><i class="fas fa-trash"></i></a> 
                                                            <?php endif; ?>
                                                            <!-- Delete Modal-->
                                                            <div class="modal fade" id="logoutModal<?php echo e($submenu2->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">Select "Delete - <?php echo e($submenu2->title); ?>" below if you are ready to Permanently delete your current data.</div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                            <a  class="btn btn-danger bbtn">
                                                                            <?php echo Form::open(['url' => 'dashboard/menu/'.$submenu2->id, 'method'=>'delete']); ?>

                                                                            <?php echo Form::submit('Delete'); ?>

                                                                            <?php echo Form::close(); ?>

                                                                            </a>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            <!-- Delete Modal-->
                                                            
                                                            </td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        
                                            <?php endif; ?>
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\menu\index.blade.php ENDPATH**/ ?>