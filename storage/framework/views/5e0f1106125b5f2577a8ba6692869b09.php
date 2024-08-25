

<?php $__env->startSection('content'); ?>
       <!-- Page Heading --> 

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    <th scope="row">Name:</th>
                                    <td>
                                        <?php if(auth()->guard()->check()): ?>
                                        Profile (<?php echo e(optional(auth()->user())->name); ?>)
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Password:</th>
                                    <td>**********</td>
                                    </tr>
                                     
                                    <tr>
                                    <th scope="row">Permission:</th>
                                    <td>
                                        <!-- <?php echo e(optional(auth()->user())->role == 111 ? 'Administrator':'Editor'); ?> -->
                                        <?php if(optional(auth()->user())->role == 111): ?>
                                            Administrator
                                        <?php elseif(optional(auth()->user())->role == 1): ?>
                                            Editor
                                        <?php elseif(optional(auth()->user())->role == 2): ?>
                                            Author
                                        <?php elseif(optional(auth()->user())->role == 3): ?>
                                            Subscriber
                                        <?php endif; ?>

                                    </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Profile Photo:</th>
                                    <td><img src="" width="100"/></td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                       
                    </div>
                    <h5 class="h5 mb-2 text-gray-800 text-center"> 
                    <a href="<?php echo e(url('dashboard/user/'.optional(auth()->user())->id.'/edit')); ?>" class="text-white">
                        <button class="btn btn-primary btn-user">Update Profile</button></a></h5>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\user\backend\profile.blade.php ENDPATH**/ ?>