<!-- Thumbnails  -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Media Library <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalUpload">Add New</button></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body scrollMView"> 
        <div class="uploadMessage" role="alert"></div>
          <!-- Normal -->
          <div class="divThumbnailsId">
            <div class="row">
              <?php $cunt = 1; ?>
              <?php $__currentLoopData = $medies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($cunt <= 12): ?>
                  <div class="col-md-3"> 
                      <input type="radio" name="test" class="noradio" id="<?php echo e($media->id); ?>" />
                      <label for="<?php echo e($media->id); ?>" class="labelMedia">
                           <!--for pdf or image check -->
                            <?php
                            $link = "asset('public/uploads/images/')/$media->img_name";
                            $file_extension = pathinfo($link, PATHINFO_EXTENSION);
                            if ($file_extension == "pdf" || $file_extension == "xlsx") {
                            ?>
                            <a class="btn btn-info bbtn" ><i class="fas fa-file"></i></a>
                            <?php
                            } else {
                            ?>
                                <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($media->img_name); ?>" class="img-thumbnail" onclick="changeValue('<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($media->img_name); ?>', '<?php echo e($media->img_name); ?>')"/>
                            <?php 
                            }
                            ?>
                            
                          
                          </label>               
                  </div> 
                  <?php endif; ?>
                  <?php $cunt += 1; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div> 
            </div>           
            
            <div class="row thumbId" id="thumbId"></div>   

            <div id="loadingIconthumbId" style="display: none; width:100%; text-align: center;"> 
                <img src="https://media.tenor.com/JeNT_qdjEYcAAAAj/loading.gif" alt="Loading..."  style="width:100px"/>
            </div>

            <div class="row">
              <div class="align-self-center mx-auto">
                <button class="btn btn-info" id="loadMoreID" type="button" style="display: none;">Load More</button>
                <button class="btn btn-info" id="fetchDataAjaxBtnThumb" type="button">Load</button>                 
              </div>
            </div>            
            <!-- Normal end-->      
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- end thumbnails  -->

<!-- new Gallery  -->
<div class="modal fade" id="exampleModalGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Media Gallery <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalUpload">Add New</button></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body scrollMView">   
        <div class="uploadMessage" role="alert"></div>
        <!-- Gallery -->
        <div class="divGalleryid">
              <div class="row">
              <?php $cunt = 1; ?>
              <?php $__currentLoopData = $medies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($cunt <= 12): ?>
                  <div class="col-md-3"> 
                      <input type="checkbox" name="test[]" class="noradio2" id="g<?php echo e($media->id); ?>"/>
                      <label for="g<?php echo e($media->id); ?>" class="labelMedia">
                          
                          <!--for pdf or image check -->
                            <?php
                            $link = "asset('public/uploads/images/')/$media->img_name";
                            $file_extension = pathinfo($link, PATHINFO_EXTENSION);
                            if ($file_extension == "pdf" || $file_extension == "xlsx") {
                            ?>
                            <a class="btn btn-info bbtn" ><i class="fas fa-file"></i></a>
                            <?php
                            } else {
                            ?>
                                <img src="<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($media->img_name); ?>" class="img-thumbnail" onclick="changeValueForGallery('<?php echo e(asset('public/uploads/images/')); ?>/<?php echo e($media->img_name); ?>', '<?php echo e($media->img_name); ?>')"/>
                            <?php 
                            }
                            ?>
                          
                            <!--<img src="<?php echo e(asset('public/images/')); ?>/<?php echo e($media->img_name); ?>" class="img-thumbnail" onclick="changeValueForGallery('<?php echo e(asset('public/images/')); ?>/<?php echo e($media->img_name); ?>', '<?php echo e($media->img_name); ?>')"/>-->
                    
                    </label>               
                  </div> 
                  <?php endif; ?>
                  <?php $cunt += 1; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div> 
            </div>
            
            <div class="row galleryJs" id="galleryJs">              
            </div>             

            <div id="loadingIcon" style="display: none; width:100%; text-align: center;"> 
                <img src="https://media.tenor.com/JeNT_qdjEYcAAAAj/loading.gif" alt="Loading..."  style="width:100px"/>
            </div>

            <div class="row">
              <div class="align-self-center mx-auto">
                
                <button class="btn btn-info" id="loadMoreID2" type="button" style="display: none;">Load More</button>
                <button class="btn btn-info" id="fetchDataAjaxBtn" type="button">Load</button>
              </div>
            </div>
             <!-- Gallery end-->        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- new Gallery  -->

<script> 
// for thmbnail
function fetchDataFromThumb() { 
    $('#loadMoreID').show();  
    $('#loadingIconthumbId').show();  
    $('#fetchDataAjaxBtnThumb').hide();    
    // Making an AJAX GET request using Fetch API
    //fetch(`/dashboardmediamanager?page=${page}`)
    fetch(`<?php echo e(url('/dashboardmediamanager')); ?>`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
            return response.json();
        })
        .then(data => { 
            // Handle the retrieved data here
             //console.log(data);
            // Target div where the HTML will be displayed
            var outputDiv = document.getElementById('thumbId');
            outputDiv.innerHTML = '';
            // Loop through the data array and generate HTML
              data.forEach(function(item) {
              var html = `<div class="col-md-3 ${item.id} contentnew"> 
                  <input type="radio" name="test" class="noradio" id="${item.id}" />
                  <label for="${item.id}" class="labelMedia">
                      <!--for pdf or image check -->
                      ${item.img_name.split('.').pop() === 'pdf' ?
                          `<a class="btn btn-info bbtn"><i class="fas fa-file-pdf"></i></a>` :
                          `<img src="<?php echo e(asset('public/uploads/images/')); ?>/${item.img_name}" class="img-thumbnail" onclick="changeValue('<?php echo e(asset('public/uploads/images/')); ?>/${item.img_name}', '${item.img_name}')"/>`
                      }
                  </label>
              </div>`; 
                // Append the generated HTML to the outputDiv
                outputDiv.insertAdjacentHTML('beforeend', html);
            });
            $('#loadingIconthumbId').hide();              
		        $(".contentnew:hidden").slice(12, 20).slideDown(); //exicute then show 12
        })
        .catch(error => {
            // Handle errors here
            console.error('There was a problem with the fetch operation:', error);
            $('#loadingIconthumbId').hide();
        });
}
// Call the function to fetch data when needed (e.g., button click)
document.getElementById('fetchDataAjaxBtnThumb').addEventListener('click', fetchDataFromThumb);

// for gallery
function fetchDataFromLaravel() { 
    $('#loadMoreID2').show();  
    $('#loadingIcon').show();  
    $('#fetchDataAjaxBtn').hide();    
    // Making an AJAX GET request using Fetch API
    //fetch(`/dashboardmediamanager?page=${page}`)
    fetch(`<?php echo e(url('/dashboardmediamanager')); ?>`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
            return response.json();
        })
        .then(data => { 
            // Handle the retrieved data here
            // console.log(data);
            // Target div where the HTML will be displayed
            var outputDiv = document.getElementById('galleryJs');
            outputDiv.innerHTML = '';
            // Loop through the data array and generate HTML
              data.forEach(function(item) { 
              var html = `<div class="col-md-3 ${item.id} contentnew2"> 
                  <input type="checkbox" name="test[]" class="noradio2" id="g${item.id}" />
                  <label for="g${item.id}" class="labelMedia">
                      <!--for pdf or image check -->
                      ${item.img_name.split('.').pop() === 'pdf' ?
                          `<a class="btn btn-info bbtn"><i class="fas fa-file-pdf"></i></a>` :
                          `<img src="<?php echo e(asset('public/uploads/images/')); ?>/${item.img_name}" class="img-thumbnail" onclick="changeValueForGallery('<?php echo e(asset('public/uploads/images/')); ?>/${item.img_name}', '${item.img_name}')"/>`
                      }
                  </label>
              </div>`; 
                // Append the generated HTML to the outputDiv
                outputDiv.insertAdjacentHTML('beforeend', html);
            });
            $('#loadingIcon').hide();              
		        $(".contentnew2:hidden").slice(12, 20).slideDown(); //exicute then show 12
        })
        .catch(error => {
            // Handle errors here
            console.error('There was a problem with the fetch operation:', error);
            $('#loadingIcon').hide();
        });
}
// Call the function to fetch data when needed (e.g., button click)
document.getElementById('fetchDataAjaxBtn').addEventListener('click', fetchDataFromLaravel);
</script><?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views/admin/media/medialibrary.blade.php ENDPATH**/ ?>