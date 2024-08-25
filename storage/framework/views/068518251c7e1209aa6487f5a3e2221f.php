

<?php $__env->startSection('content'); ?>

<?php if(optional(auth()->user())->role == 111 || optional(auth()->user())->feedbacks == 'feedbacks'): ?>
       <!-- Page Heading -->               
       
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-feedbacks" role="tab" aria-controls="nav-home" aria-selected="true">Feedbacks</a>
            <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-subscriber" role="tab" aria-controls="nav-profile" aria-selected="false">Subscribers</a>  -->
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-feedbacks" role="tabpanel" aria-labelledby="nav-home-tab">
            <!-- Feedbacks -->
             <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Feedbacks</h6>                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable_1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Feedbacks</th> 
                                            <th>Subject</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Messages</th>
                                            <th>Att.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Feedbacks</th> 
                                            <th>Subject</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Messages</th>
                                            <th>Att.</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sl = 0;
                                        ?>
                                        <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($feedback->fname != null || $feedback->fname != ''): ?>
                                        <tr>
                                            <td><?php echo e(++$sl); ?></td>
                                            <td><?php echo e($feedback->fname); ?></td> 
                                            <td><?php echo e($feedback->fsubject); ?></td>
                                            <td><?php echo e($feedback->femail); ?></td>
                                            <td><?php echo e($feedback->fphone); ?></td>
                                            <td><?php echo e($feedback->fmessage); ?></td>
                                            <td><?php echo e($feedback->fattachemnt); ?></td>                                            

                                            <td><a  class="btn btn-danger bbtn">                                            
                                            <?php echo Form::open(['url' => 'dashboard/feedbacks/'.$feedback->id, 'method'=>'delete']); ?>

                                            <?php echo Form::submit('Delete'); ?>

                                            <?php echo Form::close(); ?></a>                                            
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            <!-- Feedbacks end-->
          </div>
          <div class="tab-pane fade" id="nav-subscriber" role="tabpanel" aria-labelledby="nav-profile-tab">
            <!-- Subscribers -->
             <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Subscribers</h6>
                            
                            <?php if(session()->has('message')): ?>
                            <br/>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('message')); ?>

                            </div>
                            <?php endif; ?>

                            <?php if(session()->has('messageDestroy')): ?><br/>
                            <div class="alert alert-danger" role="alert">
                                <?php echo e(session('messageDestroy')); ?>

                            </div>
                            <?php endif; ?>
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable_2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL.</th> 
                                            <th>Email</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th> 
                                            <th>Email</th> 
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sl = 0;
                                        ?>
                                        <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($feedback->fname == null || $feedback->fname == ''): ?>
                                        <tr>
                                            <td><?php echo e(++$sl); ?></td> 
                                            <td><?php echo e($feedback->femail); ?></td>
                                            <td><a  class="btn btn-danger bbtn">                                            
                                            <?php echo Form::open(['url' => 'dashboard/feedbacks/'.$feedback->id, 'method'=>'delete']); ?>

                                            <?php echo Form::submit('Delete'); ?>

                                            <?php echo Form::close(); ?></a>                                            
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
             <!-- Subscribers end-->
          </div> 
        </div>
        
        <script type="text/javascript" defer="defer">
        $(document).ready(function() {
            $("table[id^='dataTable']").DataTable( {
                "scrollY": "200px",
                "scrollCollapse": true,
                "searching": true,
                "paging": true
            } );
        } );
        </script>
<?php else: ?>
You can't access this page. Please contact admin.
<?php endif; ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\admin\feedbacks\index.blade.php ENDPATH**/ ?>