@extends('admin.layouts.master')
@section('content')
@if(optional(auth()->user())->role == 111 || optional(auth()->user())->media == 'media')
<form class="user" action="{{ url('/dashboard/media/') }}/{{ $media->id }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('PATCH')
    <div class="row"> 
        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Media File</h6>                
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">                                                    
                            <input type="text" name="caption" class="form-control form-control-user labelBalloon" id="exampleFirstName" placeholder="Caption" value="{{$media->caption}}"><label for="exampleFirstName">Caption</label>                                                      
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" name="alt_text" class="form-control form-control-user labelBalloon" id="alttext" value="{{$media->alt_text}}" placeholder="ALT Text">
                            <label for="alttext">ALT Text</label>
                        </div> 
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="hidden" name="uploaded_by" class="form-control form-control-user" id="exampleFirstName" placeholder="user" value="{{optional(auth()->user())->id}}">
                        </div> 
                    </div> 
                </div>
            </div> 
            
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
                            <img id="myImg" src="{{ $media->img_name == null ? asset('packages/larapress/src/Assets/admin/img/dummy-image-square.jpg') : asset('public/uploads').'/'.$media->img_name }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">  
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                    </div> 
                </div>
            </div> 
        </div> 
        
    </div>
</form>
@else
You can't access this page. Please contact admin.
@endif
@endsection