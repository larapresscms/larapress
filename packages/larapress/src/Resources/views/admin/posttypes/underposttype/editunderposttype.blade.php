@extends('admin.layouts.master')

@section('content')
<!-- role mang editor--> 		
@php $values = explode(',',optional(auth()->user())->posts_id); @endphp
@foreach($values as $vid) 
    @if($vid)  							
        @if(optional(auth()->user())->role == 111 || $vid == $posts->id)
            @php $result = $vid; @endphp
            @break
        @endif											   
    @endif
@endforeach 
@php $result = $vid ?? ''; @endphp
<!-- role mang editor--> 

@if(optional(auth()->user())->role == 111 || $result == $posts->id)

<h5 class="mb-2 text-gray-800 navbar"><a href="{{ url('/dashboard/posttypes/')}}/{{ collect(request()->segments())->last() }}" class="text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a><a href="{{url($posts->post_type, $posts->slug)}}" target="_blank" class="text-decoration-none">View Page</a></h5>  

<form class="user" action="{{ url('/dashboard/posts/posttype/') }}/{{ $posts->id }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@method('PATCH')
    <div class="row">    
        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit a {{ collect(request()->segments())->last() }}!</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            @if($posttypeSlug->title != "#")                        
                            <input type="text" name='title' class="form-control form-control-user labelBalloon" id="exampleFirstName"
                                placeholder="{{ $posttypeSlug->title }}" value="{{$posts->title}}"><label for="exampleFirstName">{{ $posttypeSlug->title }}</label>
                            @else                                  
                            <input type="hidden" name='title' value="{{$posts->title}}" class="form-control form-control-user" id="exampleFirstName"
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
                        <textarea name="content">{{ $posts->content }}</textarea>  
                        @else
                        <!-- editor 2-->                
                        <textarea id="html" name="content">{!! $posts->content !!}</textarea>
                        <textarea id="css" name="content_css">{!! $posts->content_css !!}</textarea>                
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
                            <input type="text" name='excerpt' value="{{ $posts->excerpt }}" class="form-control form-control-user labelBalloon" placeholder="{{ $posttypeSlug->excerpt }}" id="excerpt"><label for="excerpt">{{ $posttypeSlug->excerpt }}</label>
                        @endif
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            @if($posttypeSlug->option_1 != "#")
                            <input type="text" name='option_1' value="{{ $posts->option_1 }}" id="option_1" class="form-control form-control-user labelBalloon" placeholder="{{$posttypeSlug->option_1}}"> <label for="option_1">{{ $posttypeSlug->option_1 }}</label>
                            @endif
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            @if($posttypeSlug->option_2 != "#")
                            <input type="text" name='option_2' value="{{ $posts->option_2 }}" id="option_2" class="form-control form-control-user labelBalloon" placeholder="{{$posttypeSlug->option_2}}"><label for="option_2">{{ $posttypeSlug->option_2 }}</label>
                            @endif
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        @if($posttypeSlug->option_3 != "#")
                            <input type="text" name='option_3' value="{{ $posts->option_3 }}" id="option_3" class="form-control form-control-user labelBalloon" placeholder="{{$posttypeSlug->option_3}}"><label for="option_3">{{ $posttypeSlug->option_3 }}</label>
                        @endif 
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        @if($posttypeSlug->option_4 != "#")
                            <input type="text" name='option_4' value="{{ $posts->option_4 }}" id="option_4" class="form-control form-control-user labelBalloon" placeholder="{{$posttypeSlug->option_4}}"><label for="option_4">{{ $posttypeSlug->option_4 }}</label>
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
                                <input type="text" name='more_option_1' id="more_option_1" value="{{ $posts->more_option_1 }}" class="form-control form-control-user labelBalloon" placeholder="{{$posttypeSlug->more_option_1}}"> <label for="more_option_1">{{ $posttypeSlug->more_option_1 }}</label>
                            @endif
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0"> 
                            @if($posttypeSlug->more_option_2 != "#")
                                <textarea name="more_option_2" class="form-control">{!! $posts->more_option_2 !!}</textarea>
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
                    <p class="mb-2 text-primary">Author: 
                        @foreach($users as $user)
                            @if($user->id == $posts->user_id)
                                {{$user->name}}
                            @endif
                        @endforeach</p> 
                    <p class="mb-2 text-primary">Publish Date: {{ $posts->updated_at }}</p>  
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">  
                            <input type="text" name='slug' value="{{ $posts->slug }}" id="slug" class="form-control form-control-user form-select-sm labelBalloon" placeholder="Slug"> <label for="slug">Slug</label>
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">   
                            <input type="text" name='position' value="{{ $posts->position }}" id="position" class="form-control form-control-user form-select-sm labelBalloon" placeholder="Position"><label for="position">Position</label> 
                        </div>
                    </div> 
                    <div class="form-group">
                        @foreach($posttypes as $posttype)
                        @if($posts->post_type == $posttype->slug)
                        <input type="text" name='post_type' class="form-control form-control-user" id="exampleFirstName" value='{{ $posttype->slug }}' readonly>
                        @endif
                        @endforeach
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-user form-select form-select-sm custom-select" aria-label=".form-select-sm example" name="status">                            
                            <option value="0" {{ $posts->status == 0 ? 'selected' : '' }}  >Unpublish</option>
                            <option value="1" {{ $posts->status == 1 ? 'selected' : '' }}  >Publish</option>
                        </select>
                    </div> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                    </div>
                    @foreach ($errors->all() as $message)
                    {{ $message }}
                    @endforeach
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
                        <input type="text" name='categori_name' class="form-control form-select-sm form-control-user" placeholder="Creat a new">
                    </div> 
                    <div class="form-group scrollCat">                         

                        
                        @foreach($specificCatOnly as $specificCat) 
                        <label class="form-check">
                            <input class="form-select form-select-sm form-check-input checkchild" name="category_id[]" type="checkbox" value="{{ $specificCat->id }}"  
                            
                            @php $values = explode(',',$posts->category_id); @endphp
                            @foreach($values as $vid) 
                                @if($vid)                                                
                                    {{$vid == $specificCat->id ? 'checked':''}}               
                                @endif
                            @endforeach

                            >
                            <span class="form-check-label">{{$specificCat->name}}</span> 
                        </label>
                        @endforeach

                            <!-- <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_id">
                                <option value="0" selected>No Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select> -->
                        
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
                            <input type="hidden" id="type" name='thumbnail_path' placeholder="Image Url" class="form-control" value="{{ $posts->thumbnail_path }}">
                            <img id="myImg" src="{{ $posts->thumbnail_path == null ? asset('public/admin/img/dummy-image-square.jpg') : asset('public/uploads/images').'/'.$posts->thumbnail_path }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">
                            <button type="button" onclick="removeValue('{{url('public/admin/img/dummy-image-square.jpg')}}')" class="btn btn-secondary btn-sm mt-3">Remove Images</button>                        
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
                    <div class="form-group ">
                        <div class="mb-3">
                            <div class="form-group">                            
                                <img id="myImg" src="{{ asset('public/admin/img/dummy-image-square.jpg') }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalGallery" class="border border-info">
                            </div> 
                        </div> 
                        <div class="row container1">  
                            
                        @php $values = explode(",",$posts->gallery_img); @endphp
                        @foreach($values as $imgid)
                            @if($imgid)
                            <div class="col-md-3 col-sm-12">
                                <div class="mb-3 removeClass">
                                    <input type="hidden" name="gallery_img[]" value="{{ $imgid }}">
                                    <img src="{{ asset('public/uploads/images/') }}/{{$imgid }}" width="100%" height="auto" class="border border-info">
                                    <a href="#" class="delete">Delete</a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        <!-- generate image container1 -->
                        </div>
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
@else
You can't access this page. Please contact admin.
@endif

<!-- Insert Image from library -->
@include('admin.media.medialibrary')
@include('admin.media.mediauploads')
<!-- Modal -->
@endsection