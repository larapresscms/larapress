<?php if(auth()->guard()->check()): ?>
<!--toplabel menu -->
<style>
    .topnav {
    	background: #000;
    	color: #fff;
    	text-align: center;
    	position: fixed;
    	width: 100%; 
    	top:0;
    	left: 0;
    	right: 0;
    	background-color: #162434;
    	z-index: 9999;
    }
    .topnav a{
        color: #fff;
        padding-right: 10px;
    }
</style>
<div class="topnav">
  <a class="active" href="<?php echo e(url('/dashboard')); ?>">Dashboard</a> 
   
  <?php if(is_numeric($post->id)): ?> 
    <a href="<?php echo e(url('/dashboard/posts/posttype/')); ?>/<?php echo e($post->id); ?>/edit/<?php echo e($post->post_type); ?>">Edit Post</a>
  <?php else: ?>
    <a href="<?php echo e(url('/dashboard/page/')); ?>/<?php echo e(collect(request()->segments())->last()); ?>/edit">Edit Page</a>
  <?php endif; ?>
  <a href="<?php echo e(url('/logout')); ?>">Logout</a>
</div>
<!--end top lavel menu-->
<?php endif; ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\layouts\topedit.blade.php ENDPATH**/ ?>