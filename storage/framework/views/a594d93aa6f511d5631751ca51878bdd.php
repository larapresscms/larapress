

<?php $__env->startSection('content'); ?>

<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->menus == 'menus'): ?>
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Menu Show</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Menu</h6> <br/>
                            Menu Name: <?php echo e($menu->title); ?> <br/><hr/>  

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($menu->category_id == $categorie->id): ?>
                                    Menu Category: <?php echo e($categorie->name); ?><br/><hr/> 
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   

                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($menuC->id == $menu->sub_menu_id): ?>
                                 Menu Parent: <?php echo e($menuC->title); ?><br/><hr/>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            Menu URL: <?php echo e($menu->url); ?> <br/><hr/> 
                            Menu Target: <?php echo e($menu->target); ?> <br/><hr/> 
                            Status: <?php echo e($menu->status == 0 ? 'Unpublish' : 'Publish'); ?>

                        </div>
                       
                    </div>
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\menu\show.blade.php ENDPATH**/ ?>