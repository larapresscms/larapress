

<?php $__env->startSection('content'); ?>
<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->menus == 'menus'): ?>
<h5 class="h5 mb-2 text-gray-800">Add New Menu <a href="<?php echo e(url('/dashboard/menu/create')); ?>" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a></h5>

   <!-- Nested Row within Card Body -->
   <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Menu</h1>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="table-responsive mb-5">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>All Pages</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>All Pages</th> 
                                    </tr>
                                </tfoot>
                                <tbody class="list-group d-contents" style="height: 300px; overflow-y: scroll;">
                                    <!--//posts-->
                                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($post->category_id == $category->id): ?>
                                                <?php $category_name = $category->slug ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                        <tr>
                                            <td><button onclick="changemenu('<?php echo e($post->title); ?>','/<?php echo e($post->post_type); ?>/<?php echo e($post->slug); ?>')" class="list-group-item list-group-item-action"><?php echo e($post->title); ?></button></td>
                                        </tr>                          
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                                    <!--//posts type-->
                                    <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                          
                                        <tr>
                                            <td><button onclick="changemenu('<?php echo e($posttype->name); ?>','/<?php echo e($posttype->slug); ?>')" class="list-group-item list-group-item-action"><?php echo e($posttype->name); ?></button></td>
                                        </tr>                          
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <form method="POST" action="<?php echo e(url('/dashboard/menu',$menu->id)); ?>" accept-charset="UTF-8" class="user">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>                    

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name='title' id="menutitle" value="<?php echo e($menu->title); ?>" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="Menu name">

                                    <input type="hidden" name='user_id' class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="user" value="<?php if(auth()->guard()->check()): ?><?php echo e(optional(auth()->user())->id); ?><?php endif; ?>">
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name='url' id="menuurl" class="form-control form-control-user" value="<?php echo e($menu->url); ?>" placeholder="URL"> 
                            </div> 
                        </div>
                        <div class="form-group"> 
                                <input type="text" name='position' value="<?php echo e($menu->position); ?>" class="form-control form-select-sm" placeholder="Position"> 
                            </div> 
                        <div class="form-group">
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_id">
                                <option value="0" selected>No Categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $menu->category_id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>  
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="sub_menu_id">
                            <option value="0">No Parent</option>
                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($menuC->id != $menu->id): ?> 
                                        <!-- finding categories  -->
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($menuC->category_id == $category->id): ?>
                                                <?php $category_n = $category->name; ?>
                                            <?php break; ?>
                                            <?php else: ?> 
                                                <?php $category_n = ''; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($menuC->id); ?>" <?php echo e($menuC->id == $menu->sub_menu_id ? 'selected' : ''); ?>><?php echo e($category_n ?? ''); ?>_<?php echo e($menuC->title); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div> 
                        </div> 

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="target">
                                <option value="_self" <?php echo e($menu->target == '_self' ? 'selected' : ''); ?>>_self</option>
                                <option value="_blank" <?php echo e($menu->target == '_blank' ? 'selected' : ''); ?>>_blank</option> 
                                <option value="_parent" <?php echo e($menu->target == '_parent' ? 'selected' : ''); ?>>_parent</option>
                                <option value="_top" <?php echo e($menu->target == '_top' ? 'selected' : ''); ?>>_top</option> 
                                <option value="external_link" <?php echo e($menu->target == 'external_link' ? 'selected' : ''); ?>>External Link</option>   
                            </select>
                            </div> 
                        </div> 

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <select class="form-control form-select form-select-sm" aria-label=".form-select-sm example" name="status">
                                    <option value="1" <?php echo e($menu->status == 1 ? 'selected' : ''); ?>  >Publish</option>
                                    <option value="0" <?php echo e($menu->status == 0 ? 'selected' : ''); ?>  >Unpublish</option>
                                </select>
                            </div> 
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                        </div>                        
                    </form>
                    </div>
                    <div class="col-md-4">
                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($menu->sub_menu_id == 0): ?>
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between <?php if(session()->has('message'.$menu->id)): ?> alert-<?php echo e(session('message'.$menu->id)); ?> <?php endif; ?>">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e($menu->title); ?></h6>
                                    <div class="dropdown no-arrow"><span class="btn badge badge-primary"><?php echo e($menu->position); ?></span>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="<?php echo e(url('dashboard/menu/'.$menu->id.'/edit')); ?>">Edit</a>
                                            <?php if(optional(auth()->user())->role == 111): ?>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal<?php echo e($menu->id); ?>">Delete</a> 
                                            <?php endif; ?>
                                        </div>
                                    </div>
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
                                </div> 
                            </div>  
                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($menu->id == $submenu->sub_menu_id && $submenu->sub_menu_id != 0): ?>                  
                                    <div class="card shadow ml-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between <?php if(session()->has('message'.$submenu->id)): ?> alert-<?php echo e(session('message'.$submenu->id)); ?> <?php endif; ?>">
                                            <h6 class="m-0 font-weight-bold text-primary"><?php echo e($submenu->title); ?></h6>
                                            <div class="dropdown no-arrow"><span class="btn badge badge-primary"><?php echo e($submenu->position); ?></span>
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                    <div class="dropdown-header">Action:</div>
                                                    <a class="dropdown-item" href="<?php echo e(url('dashboard/menu/'.$submenu->id.'/edit')); ?>">Edit</a>
                                                    <?php if(optional(auth()->user())->role == 111): ?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal<?php echo e($submenu->id); ?>">Delete</a> 
                                                    <?php endif; ?>
                                                </div>
                                            </div>
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
                                        </div> 
                                    </div>
                                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($submenu->id == $submenu2->sub_menu_id && $submenu2->sub_menu_id != 0): ?>
                                        <div class="card shadow ml-5">
                                            <!-- Card Header - Dropdown -->
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between <?php if(session()->has('message'.$submenu2->id)): ?> alert-<?php echo e(session('message'.$submenu2->id)); ?> <?php endif; ?>">
                                                <h6 class="m-0 font-weight-bold text-primary"><?php echo e($submenu2->title); ?></h6>
                                                <div class="dropdown no-arrow"><span class="btn badge badge-primary"><?php echo e($submenu2->position); ?></span>
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                        <div class="dropdown-header">Action:</div>
                                                        <a class="dropdown-item" href="<?php echo e(url('dashboard/menu/'.$submenu2->id.'/edit')); ?>">Edit</a>
                                                        <?php if(optional(auth()->user())->role == 111): ?>
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal<?php echo e($submenu2->id); ?>">Delete</a> 
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
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
                                            </div> 
                                        </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <hr>
                </div>
            </div>
        </div> 
    </div>


<style>
    .dataTables_filter {
    	/* width: -2%; */
    	float: left;
    	text-align: left;
    	margin-left: -170px;
    }
</style>

<script>
    function changemenu(value, value2){
        document.getElementById("menutitle").value= value; 
        document.getElementById("menuurl").value= value2; 
    }  
    
    // datatable entries off
    $(document).ready(function() {
    $('#dataTable').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": true });
    });
</script>
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\menu\edit.blade.php ENDPATH**/ ?>