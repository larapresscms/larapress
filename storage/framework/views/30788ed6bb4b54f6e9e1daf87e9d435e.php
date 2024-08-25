

<?php $__env->startSection('content'); ?>
  <!-- Nested Row within Card Body -->
  <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit an Account!</h1>
                </div>               
                

                <form action="<?php echo e(url('/dashboard/user/')); ?>/<?php echo e($user->id); ?>" method="post" class="user">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="First Name" value='<?php echo e($user->name); ?>'>
                     </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                            placeholder="Email Address" value="<?php echo e($user->email); ?>">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user"
                                id="exampleInputPassword" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                id="exampleRepeatPassword" placeholder="Repeat Password">
                        </div>
                    </div>
                    <?php if(auth()->guard()->check()): ?> 
                    <?php if(optional(auth()->user())->role == 111): ?>
                    <div class="form-group">
                        <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="role" onchange="changeFunc(value);">
                            <option value="111" <?php echo e($user->role == 111 ? 'selected':''); ?>>Administrator</option>
                            <option value="112" <?php echo e($user->role == 112 ? 'selected':''); ?>>Editor</option>

                            <!-- <option value="2" <?php echo e($user->role == 2 ? 'selected':''); ?>>Author</option>
                            <option value="3" <?php echo e($user->role == 3 ? 'selected':''); ?>>Subscriber</option> -->

                        </select>
                    </div>

                    <!-- // for editor role  -->
                    <div class="<?php echo e($user->role == 112 ? 'd-block':'d-none'); ?>" id="permission_id"> 
						<div class="row mb-2">
							<aside class="col-sm-4">
								<p>Post Permission</p>
								<div class="card">
									<article class="card-group-item">
										<header class="card-header">
											<h6 class="title">Post Type</h6>
										</header>
										<div class="filter-content">
											<div class="card-body">
												<?php $__currentLoopData = $posttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												
												<div class="custom-control custom-checkbox mb-1">
													<span class="float-right badge badge-light round"></span>
													<input class="custom-control-input" name="posttypes_id[]" type="checkbox" value="<?php echo e($posttype->id); ?>" id="Check<?php echo e($posttype->id); ?>"										
													<?php $ptvalues = explode(',',$user->posttypes_id); ?>
													<?php $__currentLoopData = $ptvalues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
														<?php if($vid): ?>                                                
															<?php echo e($vid == $posttype->id ? 'checked':''); ?>               
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
													> 
													<label class="custom-control-label" for="Check<?php echo e($posttype->id); ?>"><?php echo e($posttype->name); ?></label>
													
													<!--all post -->
														<div class="card-body">
														<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if($post->post_type == $posttype->slug): ?>
														
														
														
														<label class="form-check">
															<input class="form-check-input checkchild<?php echo e($posttype->id); ?>" name="posts_id[]" type="checkbox" value="<?php echo e($post->id); ?>" 
															
															<?php $values = explode(',',$user->posts_id); ?>
															<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
																<?php if($vid): ?>                                                
																	<?php echo e($vid == $post->id ? 'checked':''); ?>               
																<?php endif; ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
															>
															<span class="form-check-label  ">
																<?php echo e($post->title); ?>

															</span>
														</label> <!-- form-check.// -->
														<?php endif; ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</div> <!-- card-body.// -->
													
													
												</div> <!-- form-check.// -->
												
												<script>
														$("#Check<?php echo e($posttype->id); ?>").click(function () {
															$('.checkchild<?php echo e($posttype->id); ?>').not(this).prop('checked', this.checked);
														});
												</script>
												
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</div> <!-- card-body.// -->
										</div>
									</article> <!-- card-group-item.// -->						

								</div> <!-- card.// -->
							</aside> <!-- col.// -->
							
							<aside class="col-sm-4">
								<p>Others Permission</p>
								<div class="card">
									<article class="card-group-item">
										<header class="card-header"><h6 class="title">Check Others</h6></header>
										<div class="filter-content">
											<div class="card-body">
												<label class="btn btn-danger">
												<input class="" type="checkbox" name="categories" value="categories" <?php echo e($user->categories == 'categories' ? 'checked':''); ?> >
												<span class="form-check-label">Category</span>
												</label>
												<label class="btn btn-success">
												<input class="" type="checkbox" name="menus" value="menus" <?php echo e($user->menus == 'menus' ? 'checked':''); ?> >
												<span class="form-check-label">Menu</span>
												</label>
												<label class="btn btn-primary">
												<input class="" type="checkbox" name="media" value="media" <?php echo e($user->media == 'media' ? 'checked':''); ?>>
												<span class="form-check-label">Media</span>
												</label>

												<label class="btn btn-primary">
												<input class="" type="checkbox" name="feedbacks" value="feedbacks" <?php echo e($user->feedbacks == 'feedbacks' ? 'checked':''); ?>>
												<span class="form-check-label">Feedback</span>
												</label>
											</div> <!-- card-body.// -->
										</div>
									</article> <!-- card-group-item.// -->	
								</div> <!-- card.// -->
							</aside> <!-- col.// -->   
							<aside class="col-sm-4">
								<p>Menu Permission</p>
								<div class="card"> 
									<article class="card-group-item">
										<header class="card-header">
											<h6 class="title">Menu</h6>
										</header>
										<div class="filter-content">
											<div class="card-body">
												<?php $__currentLoopData = $posttypesD; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posttypeD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if($posttypeD->menu_icon != '' && $posttypeD->menu_icon != null): ?> 
												<div class="custom-control custom-checkbox">
													<span class="float-right badge badge-light round"></span>
													<input class="custom-control-input" name="admin_pt_menu[]" type="checkbox" value="<?php echo e($posttypeD->menu_icon); ?>" id="Check<?php echo e($posttypeD->menu_icon); ?>"										
													<?php $ptvalues = explode(',',$user->admin_pt_menu); ?>
													<?php $__currentLoopData = $ptvalues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
														<?php if($vid): ?>                                                
															<?php echo e($vid == $posttypeD->menu_icon ? 'checked':''); ?>               
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
													> 
													<label class="custom-control-label" for="Check<?php echo e($posttypeD->menu_icon); ?>"><?php echo e($posttypeD->menu_icon); ?></label>
												</div> <!-- form-check.// -->
												<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</div> <!-- card-body.// -->
										</div>
									</article> <!-- card-group-item.// -->                                  
								</div> <!-- card.// -->
							</aside> <!-- col.// -->                     
						</div> <!-- row.// -->
                    </div>
                    <script>
                    function changeFunc(i) {
						if(i == '112'){ 
							$('#permission_id').addClass('d-block'); 
						}else if(i == '111'){						
							$('#permission_id').removeClass('d-block'); 
							$('#permission_id').addClass('d-none'); 
						}
					}
                    </script>


                    <?php else: ?>
                    <input name="role" type="hidden" value="<?php echo e($user->role); ?>"/>
                    <?php endif; ?>
                    <?php endif; ?>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\user\backend\edit.blade.php ENDPATH**/ ?>