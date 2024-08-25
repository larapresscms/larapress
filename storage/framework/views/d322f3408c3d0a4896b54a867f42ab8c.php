

<?php $__env->startSection('content'); ?>
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">User Profile</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    <th scope="row">Name:</th>
                                    <td><?php echo e($user->name); ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Password:</th>
                                    <td>**********</td>
                                    </tr>
                                    
                                    <tr>
                                    <th scope="row">Permission:</th>
                                    <td>
                                        <!-- <?php echo e($user->name == 111 ? 'Administrator':'Editor'); ?> -->
                                        <?php if($user->role == 111): ?>
                                            Administrator
                                        <?php elseif($user->role == 1): ?>
                                            Editor
                                        <?php else: ?>
                                            Pendding
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\user\backend\show.blade.php ENDPATH**/ ?>