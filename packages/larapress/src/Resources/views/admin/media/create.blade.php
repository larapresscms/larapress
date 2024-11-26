@extends('admin.layouts.master')
@section('content')
@if(optional(auth()->user())->role == 111 || optional(auth()->user())->media == 'media')
   <!-- Nested Row within Card Body -->
   <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create a Media!</h1>
            </div>
            <form class="user" action="{{ url('/dashboard/media') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                        <label class=newbtn>
                            <img id="blah" src="{{ asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') }}" >
                            <input name='img_name[]' id="images_multiple" class='pis form-control' onchange="readURL(this);" type="file" multiple>
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

<script>
//  $('.newbtn').bind("click" , function () {
//         $('#images_multiple').click();
//  });
 $('.reset').bind("click" , function () {
    $(".images-preview-div").empty(); // image preview remove
 }); 
//   function readURL(input) {
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
@else
You can't access this page. Please contact admin.
@endif
@endsection