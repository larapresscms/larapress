@extends('admin.layouts.master')
@section('content')
<!-- role mang editor--> 		
@php $values = explode(',',optional(auth()->user())->posttypes_id); @endphp
@foreach($values as $vid) 
    @if($vid)  							
        @if(optional(auth()->user())->role == 111 || $vid == $posttypeSlug->id)
            @php $result = $vid; @endphp
            @break
        @endif											   
    @endif
@endforeach 
@php $result = $vid ?? ''; @endphp
<!-- role mang editor--> 

@if(optional(auth()->user())->role == 111 || $result == $posttypeSlug->id)

<h5 class="h5 mb-2 text-gray-800"><a href="{{ url('/dashboard/posttypes/')}}/{{ collect(request()->segments())->last() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Back</h5>

<form class="user" action="{{ url('/dashboard/posts/posttypes') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">    

        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create a {{ collect(request()->segments())->last() }}!</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            @if($posttypeSlug->title != "#")                        
                            <input type="text" name='title' class="form-control form-control-user labelBalloon" id="exampleFirstName"
                                placeholder="{{ $posttypeSlug->title }}"><label for="exampleFirstName">{{ $posttypeSlug->title }}</label>
                            @else                                  
                            <input type="hidden" name='title' value="Untitled" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="">
                            @endif                            
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="hidden" name='user_id' class="form-control form-control-user" id="exampleFirstName"
                                placeholder="user" value="@auth(){{ optional(auth()->user())->id}}@endauth">
                        </div> 
                    </div>
                    <!-- editor -->
                    @if($posttypeSlug->content != "#")
                        <!-- choose editor  -->
                        @if($settingsAdmin->editor == "classic")
                        <!-- editor 1-->
                            <textarea name="content"></textarea>  
                        @else
                        <!-- editor 2-->                
                        <textarea id="html" name="content"></textarea>
                        <textarea id="css" name="content_css"></textarea>                
                        <div id="gjs" style="height:500px !important;"></div>                      
                        @endif  
                    @endif


                </div>
            </div>

            @if($posttypeSlug->excerpt != "#" || $posttypeSlug->option_1 != "#" || $posttypeSlug->option_2 != "#" || $posttypeSlug->option_3 != "#" || $posttypeSlug->option_4 != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">More Fields for {{ collect(request()->segments())->last() }}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        @if($posttypeSlug->excerpt != "#")
                            <input type="text" name='excerpt' class="form-control form-control-user labelBalloon" id="excerpt" placeholder="{{ $posttypeSlug->excerpt }}">
                            <label for="excerpt">{{ $posttypeSlug->excerpt }}</label>
                        @endif
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            @if($posttypeSlug->option_1 != "#")
                            <input type="text" name='option_1' class="form-control form-control-user labelBalloon" id="option_1" placeholder="{{$posttypeSlug->option_1}}">
                            <label for="option_1">{{ $posttypeSlug->option_1 }}</label> 
                            @endif
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            @if($posttypeSlug->option_2 != "#")
                            <input type="text" name='option_2' class="form-control form-control-user labelBalloon" id="option_2" placeholder="{{$posttypeSlug->option_2}}">
                            <label for="option_2">{{ $posttypeSlug->option_2 }}</label> 
                            @endif
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        @if($posttypeSlug->option_3 != "#")
                            <input type="text" name='option_3' class="form-control form-control-user labelBalloon" id="option_3" placeholder="{{$posttypeSlug->option_3}}">
                            <label for="option_3">{{ $posttypeSlug->option_3 }}</label> 
                        @endif 
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        @if($posttypeSlug->option_4 != "#")
                            <input type="text" name='option_4' class="form-control form-control-user labelBalloon" id="option_4" placeholder="{{$posttypeSlug->option_4}}">
                            <label for="option_4">{{ $posttypeSlug->option_4 }}</label> 
                        @endif
                        </div> 
                    </div> 

                </div>
            </div>
            @endif

            @if($posttypeSlug->more_option_1 != "#" || $posttypeSlug->more_option_2 != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">More Fields for {{ collect(request()->segments())->last() }}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            @if($posttypeSlug->more_option_1 != "#")
                                <input type="text" name='more_option_1' class="form-control form-control-user labelBalloon" id="more_option_1" placeholder="{{$posttypeSlug->more_option_1}}"> 
                            <label for="more_option_1">{{ $posttypeSlug->more_option_1 }}</label> 
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            @if($posttypeSlug->more_option_2 != "#")
                                <textarea name="more_option_2" class="form-control"></textarea>
                            @endif
                        </div>  
                    </div>

                </div>
            </div>
            @endif

        </div>
        <!-- Pie Chart -->
        <div class="col-xl-3 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Publish</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group row"> 
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            <input type="text" name='position' value="" class="form-control form-control-user form-select-sm labelBalloon" id="positionId" placeholder="Position"><label for="positionId">Position</label>  
                        </div>
                    </div> 
                    <div class="form-group">
                        <input class="form-control form-select form-control-user form-select-sm" aria-label=".form-select-sm example" name="post_type" value="{{ collect(request()->segments())->last() }}" readonly>
                    </div> 
                    <div class="form-group row">                           
                        <div class="col-sm-12 mb-3 mb-sm-0">                  
                            <select class="form-control form-control-user form-select form-select-sm custom-select" aria-label=".form-select-sm example" name="status">                            
                                <option value="1" selected>Publish</option>    
                                <option value="0">Unpublish</option>
                            </select>
                        </div>
                    </div> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Publish</button>
                    </div> 
                </div>
            </div>


            @if($posttypeSlug->category_id != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$posttypeSlug->category_id}}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group">                                
                        <input type="text" name='categori_name' class="form-control form-control-user form-select-sm" placeholder="Creat a new">
                    </div> 
                    <div class="form-group scrollCat">
                        
                        @foreach($specificCatOnly as $specificCat) 
                        <label class="form-check">
                            <input class="form-select form-select-sm form-check-input checkchild" name="category_id[]" type="checkbox" value="{{ $specificCat->id }}">
                            <span class="form-check-label">{{$specificCat->name}}</span> 
                        </label>
                        @endforeach                        
                    </div>                                        
                </div>
            </div>
            @else
               <input type="hidden" name="category_id" value=""> 
            @endif
            
            @if($posttypeSlug->thumbnail_path != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$posttypeSlug->thumbnail_path}}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                    
                    <div class="form-group">                       
                            <input type="hidden" id="type" name='thumbnail_path' placeholder="Image Url" class="form-control" >
                            <img id="myImg" src="{{ asset('public/admin/img/dummy-image-square.jpg') }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">
                            <button type="button" onclick="removeValue('{{url('/public/admin/img/dummy-image-square.jpg')}}')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>                        
                    </div>
                </div>
            </div>
            @endif 

            @if($posttypeSlug->gallery_img != "#")
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$posttypeSlug->gallery_img}} for {{ collect(request()->segments())->last() }}</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">                    
                    <div class="form-group">
                        <div class="mb-3">
                            <div class="form-group">                            
                                <img id="myImg" src="{{ asset('/public/admin/img/dummy-image-square.jpg') }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalGallery" class="border border-info">
                            </div> 
                        </div> 
                        <div class="row container1"></div>   
                    <!-- generate image container1 -->
                    </div>

                </div>
            </div>
            @else
            <!-- tempory value  -->
            <input type="hidden" name="gallery_img[]" >
            @endif

        </div>
    </div>
</form>
<!-- Insert Image from library -->
@include('admin.media.medialibrary')
@include('admin.media.mediauploads')
<!-- Modal -->
@else
You can't access this page. Please contact admin.
@endif
@endsection