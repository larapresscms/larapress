<!-- Thumbnails  -->
<div class="modal fade" id="exampleModalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Files</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 

        <div class="row">
          <div class="col-lg-12">
              <div class="p-5">
                  <div class="text-center">
                      <h1 class="h4 text-gray-900">Create a Media!</h1>
                  </div>

                  <form class="user" id="data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  {{ csrf_field() }}
                      <div class="form-group row">
                          <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                              <label class=newbtn>
                                  <img id="blah" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" >
                                  <input name='img_name[]' id="images_multiple" class='pis form-control' type="file" multiple>
                                  <!-- <input name='img_name[]' id="images" class='pis form-control' onchange="readURL(this);" type="file" multiple> -->
                              </label>
                              <!-- <input type="file" name='img_name' class="form-control" id="exampleFirstName"> -->
                          </div> 

                          <div class="col-md-12">
                              <div class="mt-1 text-center">
                                  <div class="images-preview-div"> </div>
                              </div>  
                          </div> 
                          
                      </div>
                      <div class="form-group row">
                          <div class="col-md-6"> 
                              <input type="reset" class="btn btn-secondary btn-user btn-block reset" value="Reset"> 
                          </div>
                          <div class="col-md-6"> 
                              <button type="submit" class="btn btn-primary btn-user btn-block float-left" data-dismiss-modal="uploadmodal">Upload</button>
                          </div> 
                      </div> 
                      @foreach ($errors->all() as $message)
                      {{ $message }}
                      @endforeach
                  </form>

                  <!-- media ajax  -->
                  <script>
                            $("form#data").submit(function(e) {
                              e.preventDefault();    
                              var formData = new FormData(this);

                              $.ajax({
                                  url: '{{url('/')}}/dashboardajx/media',
                                  type: 'POST',
                                  data: formData,
                                  success: function (data) {
                                      //alert(data); 
                                      // for refresh load more btn 
                                      $("#loadMoreID").text("Load More").removeClass("noContent");
                                      $("#loadMoreID2").text("Load More").removeClass("noContent2");

                                      //thumb
                                      var thumbId = document.getElementById('thumbId');
                                      thumbId.innerHTML = '';
                                      $('#loadMoreID').hide();  
                                      $('#fetchDataAjaxBtnThumb').show();  
                                      //gallery
                                      var outputDiv = document.getElementById('galleryJs');
                                      outputDiv.innerHTML = '';
                                      $('#loadMoreID2').hide();  
                                      $('#fetchDataAjaxBtn').show();  

                                       
                                      $(".divThumbnailsId").load(" .divThumbnailsId"); //for div replace
                                      $(".divGalleryid").load(" .divGalleryid"); //for div replace
                                      $(".images-preview-div").empty(); // image preview remove
                                      $("#images_multiple").val('');  // image remove do not again
                                      if(data == 'failed'){
                                        $(".uploadMessage").text('You are not allowed to upload.');  // image remove do not again
                                        $(".uploadMessage").addClass("alert alert-danger");
                                      }else{
                                          $(".uploadMessage").text('File Uploaded Successfully.');  // image remove do not again
                                          $(".uploadMessage").addClass("alert alert-success");
                                      }
                                    

                                      //document.getElementsByClassName("uploadMessage").innerHTML = "File Uploaded Successfully.";   
                                  },
                                  cache: false,
                                  contentType: false,
                                  processData: false
                              });
                          });
                          </script>

                          <script type="text/javascript">
                        //   $(".newbtn").bind("click" , function () {
                        //           $('#images_multiple').click();
                        //   });
                          $('.reset').bind("click" , function () {
                              $(".images-preview-div").empty(); // image preview remove
                          }); 
                          // function readURL(input) {
                          //     if (input.files && input.files[0]) {
                          //         var reader = new FileReader();
                          //         reader.onload = function (e) {
                          //             $('#blah')
                          //                 .attr('src', e.target.result);
                          //         };
                          //         reader.readAsDataURL(input.files[0]);
                          //     }
                          // }


                          </script>
                          <style>
                          #images_multiple{display: none;}
                          .newbtn{cursor: pointer;}
                          #blah{
                            max-width:20%;
                            height:auto;
                            margin-top:20px;
                            border: 1px solid #d2d2d2;
                          }
                          .images-preview-div img {
                            padding: 0px;
                            max-width: 100px;
                            border: 1px solid #d2d2d2;
                            margin: 5px;
                          }
                          </style>
                          <!-- media ajax  -->

                  
              </div>
          </div>
        </div>  


      </div>
      <!-- <div class="modal-footer"> -->
        <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Insert</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      <!-- </div> -->
    </div>
  </div>
</div>

<!-- end thumbnails  -->
