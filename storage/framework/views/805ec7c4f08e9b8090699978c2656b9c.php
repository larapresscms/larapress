

<?php $__env->startSection('content'); ?>
<?php if(optional(auth()->user())->role == 111): ?>
       <!-- Page Heading --> 
    <h5 class="h5 mb-2 text-gray-800">Add New Users <a href="<?php echo e(url('/dashboard/user/create')); ?>" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a></h5>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>User Name</th> 
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>SL.</th>
                            <th>User Name</th> 
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sl = 0;
                        ?>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php if(session()->has('message'.$user->id)): ?> alert alert-<?php echo e(session('message'.$user->id)); ?> <?php endif; ?>">
                            <td><?php echo e(++$sl); ?></td>
                            <td><?php echo e($user->name); ?></td> 
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <!-- <?php echo e($user->role == 111 ? 'Administrator':'Editor'); ?> -->
                                <?php if($user->role == 111): ?>
                                    Administrator
                                <?php elseif($user->role == 112): ?>
                                    Editor
                                <?php elseif($user->role == 2): ?>
                                    Author
                                <?php elseif($user->role == 3): ?>
                                    Subscriber
                                <?php else: ?>
                                    Pendding
                                <?php endif; ?>

                            </td>
                            <td>
                            <?php if(optional(auth()->user())->role == 1): ?> 
                            <?php else: ?> 
                                <a href="<?php echo e(url('dashboard/singleUser/'.$user->id)); ?>" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                <a href="<?php echo e(url('dashboard/user/'.$user->id.'/edit')); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                <?php if(optional(auth()->user())->id == $user->id && optional(auth()->user())->role == 111): ?> 
                                <?php else: ?> 
                                <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($user->id); ?>"><i class="fas fa-trash"></i></a> 
                    
                                <!-- Delete Modal-->
                                <div class="modal fade" id="logoutModal<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Select "Delete - <?php echo e($user->name); ?>" below if you are ready to Permanently delete your current data.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <form action="<?php echo e(url('/dashboard/delete',$user->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>     
                                                    <?php echo method_field('DELETE'); ?>                                                           
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\user\backend\index.blade.php ENDPATH**/ ?>