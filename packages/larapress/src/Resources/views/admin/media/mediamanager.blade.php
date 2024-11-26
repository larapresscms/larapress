<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <title> {{ $settingsAdmin->site_title ?? 'None'}} </title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('packages/larapress/src/Assets/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('packages/larapress/src/Assets/admin/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{ asset('packages/larapress/src/Assets/admin/css/style.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('packages/larapress/src/Assets/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"> 
</head>

<body id="page-top"> 

    <div class="modal-content">       
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
                              <button type="submit" class="btn btn-primary btn-user btn-block float-left">Create</button>
                          </div> 
                      </div> 
                      @foreach ($errors->all() as $message)
                      {{ $message }}
                      @endforeach
                  </form>
              </div>
          </div>
        </div> 




        <!-- Normal -->
        <div class="divgid">
              <div class="row">
              <?php $cunt = 1; ?>
              @foreach($medies as $media)
                @if($cunt <= 12)
                  <div class="col-md-3"> 
                      <input type="radio" name="test" class="noradio" id="{{$media->id }}" />
                      <label for="{{$media->id }}" class="labelMedia">

                      <!--for pdf or image check -->
                      @php
                      $link = "asset('public/uploads/')/$media->img_name";
                      $file_extension = pathinfo($link, PATHINFO_EXTENSION);
                      if ($file_extension == "pdf" || $file_extension == "xlsx") {
                      @endphp
                      <a class="btn btn-info bbtn" ><i class="fas fa-file"></i></a>
                      @php
                      } else {
                      @endphp
                          <img src="{{ asset('public/uploads/') }}/{{$media->img_name }}" style="width:100%; height:200px" class="img-thumbnail" onclick="changeValue('{{ asset('public/uploads/') }}/{{$media->img_name }}', '{{$media->img_name }}')"/>
                      @php 
                      }
                      @endphp
                        
                      <!-- <img src="{{ asset('public/images/') }}/{{$media->img_name }}" class="img-thumbnail" onclick="changeValue('{{ asset('public/images/') }}/{{$media->img_name }}', '{{$media->img_name }}')"/> -->
                    
                      <!-- Tooltip----- -->
                      <span class="input">
                        <input type="text" class="btn-block btn100" id="afInput{{$media->id }}" value="{{ asset('public/uploads/') }}/{{$media->img_name }}" readonly>
                      </span>
                      <!-- <div class="tooltip-af">
                          <button class="btn btn-primary btn-user btn-block btn100" onclick="afTooltipFunction{{$media->id }}()" onmouseout="afoutFunc{{$media->id }}()" class="button-ffu">
                            <span class="tooltiptext{{$media->id }}" id="afTooltip{{$media->id }}">Copy to clipboard</span> 
                            </button>
                      </div> 

                      <script>
                        // Tooltip-----
                        function afTooltipFunction{{$media->id }}() {
                          var copyText = document.getElementById("afInput{{$media->id }}");
                          copyText.select();
                          copyText.setSelectionRange(0, 99999);
                          navigator.clipboard.writeText(copyText.value);
                          
                          var tooltip = document.getElementById("afTooltip{{$media->id }}");
                          tooltip.innerHTML = "Copied: " + copyText.value;
                        }

                        function afoutFunc{{$media->id }}() {
                          var tooltip = document.getElementById("afTooltip{{$media->id }}");
                          tooltip.innerHTML = "Copy to clipboard";
                        }
                      </script> -->
                      <!-- Tooltip--end--- -->
                    
                    </label>               
                  </div> 
                  @endif
                  <?php $cunt += 1; ?>
              @endforeach
              </div> 
            </div>
            
            <?php /*
            <div class="row">
              @foreach($medies as $media)
                  <div class="col-md-3 contentnew"> 
                      <input type="radio" name="test" class="noradio" id="{{$media->id }}" />
                      <label for="{{$media->id }}" class="labelMedia">
                          <!--for pdf or image check -->
                            @php
                            $link = "asset('public/images/')/$media->img_name";
                            $file_extension = pathinfo($link, PATHINFO_EXTENSION);
                            if ($file_extension == "pdf") {
                            @endphp
                            <a class="btn btn-info bbtn" ><i class="fas fa-file-pdf"></i></a>
                            @php
                            } else {
                            @endphp
                                <img src="{{ asset('public/images/') }}/{{$media->img_name }}" class="img-thumbnail" onclick="changeValue('{{ asset('public/images/') }}/{{$media->img_name }}', '{{$media->img_name }}')"/>
                            @php 
                            }
                            @endphp
                          
                                <!--<img src="{{ asset('public/images/') }}/{{$media->img_name }}" class="img-thumbnail" onclick="changeValue('{{ asset('public/images/') }}/{{$media->img_name }}', '{{$media->img_name }}')"/>-->

                       <!-- Tooltip----- -->
                      <span class="input">
                        <input type="text" class="btn-block btn100" id="afInput{{$media->id }}" value="{{ asset('public/images/') }}/{{$media->img_name }}" readonly>
                      </span>
                      <div class="tooltip-af">
                          <button class="btn btn-primary btn-user btn-block btn100" onclick="afTooltipFunction{{$media->id }}()" onmouseout="afoutFunc{{$media->id }}()" class="button-ffu">
                            <span class="tooltiptext{{$media->id }}" id="afTooltip{{$media->id }}">Copy to clipboard</span> 
                            </button>
                      </div> 

                      <script>
                        // Tooltip-----
                        function afTooltipFunction{{$media->id }}() {
                          var copyText = document.getElementById("afInput{{$media->id }}");
                          copyText.select();
                          copyText.setSelectionRange(0, 99999);
                          navigator.clipboard.writeText(copyText.value);
                          
                          var tooltip = document.getElementById("afTooltip{{$media->id }}");
                          tooltip.innerHTML = "Copied: " + copyText.value;
                        }

                        function afoutFunc{{$media->id }}() {
                          var tooltip = document.getElementById("afTooltip{{$media->id }}");
                          tooltip.innerHTML = "Copy to clipboard";
                        }
                      </script>
                      <!-- Tooltip--end--- -->

                    </label>           
                  </div> 
              @endforeach
              </div> */ ?>

            <div class="row thumbId" id="thumbId"></div>   

            <div id="loadingIconthumbId" style="display: none; width:100%; text-align: center;"> 
                <!-- <img src="https://media.tenor.com/JeNT_qdjEYcAAAAj/loading.gif" alt="Loading..."  style="width:100px"/> -->
            </div>

            <div class="row">
              <div class="align-self-center mx-auto">
                <button class="btn btn-info" id="loadMoreID" type="button" style="display: none;">Load More</button>
                <button class="btn btn-info" id="fetchDataAjaxBtnThumb" type="button">Load</button>                 
              </div>
            </div> 
            <!-- Normal end-->        
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Insert</button> 
      </div> -->
    </div> 



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
                    //thumb
                    var thumbId = document.getElementById('thumbId');
                    thumbId.innerHTML = '';
                    $('#loadMoreID').hide();  
                    $('#fetchDataAjaxBtnThumb').show();  

                    $(".divgid").load(" .divgid"); //for div replace
                    $(".images-preview-div").empty(); // image preview remove
                    $("#images_multiple").val('');  // image remove do not again
                     
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        </script>

        <script type="text/javascript">
        // $(".newbtn").bind("click" , function () {
        //         $('#images_multiple').click();
        // });
        $('.reset').bind("click" , function () {
            $(".images-preview-div").empty(); // image preview remove
        }); 

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

        <script> 
// for thmbnail
function fetchDataFromThumb() { 
    $('#loadMoreID').show();  
    $('#loadingIconthumbId').show();  
    $('#fetchDataAjaxBtnThumb').hide();    
    // Making an AJAX GET request using Fetch API
    //fetch(`/dashboardmediamanager?page=${page}`)
    fetch(`{{url('/dashboardmediamanager')}}`)
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
                          `<img src="{{ asset('public/uploads/') }}/${item.img_name}" style="width:100%; height:200px" class="img-thumbnail" onclick="changeValue('{{ asset('public/uploads/') }}/${item.img_name}', '${item.img_name}')"/>`
                      }
                  </label>
                  <span class="input">
                    <input type="text" class="btn-block btn100" id="afInput${item.id}" value="{{ asset('public/uploads/') }}/${item.img_name}" readonly>
                  </span>
              </div>
              `; 
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
</script>

 
   <!-- Bootstrap core JavaScript-->
   <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('packages/larapress/src/Assets/admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->

    <!-- Page level plugins -->
    <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('packages/larapress/src/Assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('packages/larapress/src/Assets/admin/js/demo/datatables-demo.js')}}"></script>
    <!-- image upload -->
    <script >
        $(function() {
        // Multiple images preview with JavaScript
        var previewImages = function(input, imgPreviewPlaceholder) {                    
            if (input.files) {
                var filesAmount = input.files.length;                    
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();                    
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }                    
                    reader.readAsDataURL(input.files[i]);
                }
            }

        };                    
        $('#images_multiple').on('change', function() {
            previewImages(this, 'div.images-preview-div');
        });
    });
    </script>
    <!-- image upload -->
    <script>
    //load more

    $(document).ready(function(){
      $(".contentnew").slice(12, 20).show();
      $("#loadMoreID").on("click", function(e){
        e.preventDefault();
        $(".contentnew:hidden").slice(12, 20).slideDown();
        if($(".contentnew:hidden").length == 12) {
          $("#loadMoreID").text("No Content").addClass("noContent");
        }
      });})

    </script>
</body>
</html>