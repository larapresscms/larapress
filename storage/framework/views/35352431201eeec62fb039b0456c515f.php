
<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<h5 class="h5 mb-2 text-gray-800">Add New Post type <a href="<?php echo e(url('/dashboard/posttypes/create')); ?>" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a></h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Post type</h6>  
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Post type</th> 
                        <th>Slug</th>
						<th>Last Edit</th>
						<th>Edit Date</th>
                        <th>Status</th>
                        <th>Menu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL.</th>
                        <th>Post type</th> 
                        <th>Slug</th>
						<th>Last Edit</th>
						<th>Edit Date</th>
                        <th>Status</th>
                        <th>Menu</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sl = 0;
                    ?>
                    <?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <!-- role mang admin--> 
					<?php if(optional(auth()->user())->role == 111): ?>
						 
						 <tr>
							<td><?php echo e(++$sl); ?></td>
							<td><a class="badge sizetext" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>"><?php echo e($posttype->name); ?></a></td> 
							<td><?php echo e($posttype->slug); ?>  
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($category->id == $posttype->category_main_id): ?>
								<a href="<?php echo e(url('/posts/'.$posttype->slug.'/'.$category->slug)); ?>" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
							<td>
							   <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							       <?php if($user->id == $posttype->user_id): ?>
							       <?php echo e($user->name); ?>

							       <?php endif; ?>
							   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
							<td><?php echo e($posttype->updated_at); ?></td>
							<td><?php echo e($posttype->status == 0 ? 'Unpublish' : 'Publish'); ?></td>

							<td> 
								<?php if($posttype->in_menu_swh == '0'): ?>
								<span class="btn badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
								<?php else: ?>
								<span class="btn badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>
								<?php endif; ?> 
							</td> 

							<td><a href="<?php echo e(url($posttype->slug)); ?>" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
							<a href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a> 
							<a href="<?php echo e(url('dashboard/posttypes/'.$posttype->id.'/edit')); ?>" class="btn btn-success"><i class="fas fa-edit"></i></a> 
							
							<a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($posttype->id); ?>"><i class="fas fa-trash"></i></a> 
										
							<!-- Delete Modal-->
							<div class="modal fade" id="logoutModal<?php echo e($posttype->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
											<form action="<?php echo e(url('/dashboard/posttypes',$posttype->id)); ?>" method="POST">
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
						 
					<?php elseif(optional(auth()->user())->role == 112): ?>					
						<!-- role mang editor--> 
						<?php $values = explode(',',optional(auth()->user())->posttypes_id); ?>
						<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
							<?php if($vid): ?>  							
								<?php if(optional(auth()->user())->role == 111 || $vid == $posttype->id): ?>
									
									<tr>
										<td><?php echo e(++$sl); ?></td>
										<td><a class="badge sizetext" href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>"><?php echo e($posttype->name); ?></a></td> 
										<td><?php echo e($posttype->slug); ?>  
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($category->id == $posttype->category_main_id): ?>
											<a href="<?php echo e(url('/posts/'.$posttype->slug.'/'.$category->slug)); ?>" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</td>
										<td>
										<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($user->id == $posttype->user_id): ?>
											<?php echo e($user->name); ?>

											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</td>
										<td><?php echo e($posttype->updated_at); ?></td>
										<td><?php echo e($posttype->status == 0 ? 'Unpublish' : 'Publish'); ?></td>

										<td> 
											<?php if($posttype->in_menu_swh == '0'): ?>
											<span class="btn badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
											<?php else: ?>
											<span class="btn badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>
											<?php endif; ?> 
										</td> 
										
										<td>
										<?php if(optional(auth()->user())->role == 111): ?>
										<a href="<?php echo e(url('dashboard/posttypes/'.$posttype->slug)); ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a> 
										<a href="<?php echo e(url('dashboard/posttypes/'.$posttype->id.'/edit')); ?>" class="btn btn-success"><i class="fas fa-edit"></i></a> 
										
										<a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal<?php echo e($posttype->id); ?>"><i class="fas fa-trash"></i></a> 
										<?php else: ?>
										Not Allow
										<?php endif; ?>
													
										<!-- Delete Modal-->
										<div class="modal fade" id="logoutModal<?php echo e($posttype->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
														<?php echo Form::open(['url' => 'dashboard/posttypes/'.$posttype->id, 'method'=>'delete']); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\posttypes\index.blade.php ENDPATH**/ ?>