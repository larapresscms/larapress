@extends('admin.layouts.master')

@section('content')

@if(optional(auth()->user())->role == 111)
   <!-- Nested Row within Card Body -->
   <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create a Home Page!</h1>
            </div>
           
            <form class="user" action="{{ url('/dashboard/settings') }}" method="post">
            @csrf
                <div class="form-group row">
                    <div class="col-sm-8 mb-3 mb-sm-0">
                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Site Title</label>
                            <input type="text" name='site_title' class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Site Title">
                        </div>
                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Dashboard Color</label>
                            <input type="color" name='dashboard_color' class="form-control form-control-user panel_color" id="floatingInput"
                                placeholder="Dashboard Color"> 
                        </div>
                        
                        <div class="form-group">
                        <label for="floatingInput" class="form-label">Text Color</label>
                            <input type="color" name='text_color' class="form-control form-control-user panel_color" id="exampleFirstName"
                                    placeholder="Text Color">
                        </div>
                        <div class="form-group">
                        <label for="floatingInput" class="form-label">Text Hover Color</label>
                            <input type="color" name='text_hover' class="form-control form-control-user panel_color" id="exampleFirstName"
                                    placeholder="Text Hover Color">
                        </div>
                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Theme folder Name</label>
                            <input type="text" name='theme_url' class="form-control form-control-user" id="themefoldername"
                                    placeholder="Theme folder Name"> 
                        </div>  
                        <div class="form-group">
                            <label for="floatingInput" class="form-label">Home Page Name</label>
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="home_url">
                                <option value="0" selected>No Home page set</option>
                                @foreach($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editor" class="form-label">Editor Choose</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-label mr-1" for="editor1">Classic </label>
                                    <input class="form-check-input" type="radio" name="editor" id="editor1" value="classic">
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-label mr-1" for="editor2">Visual </label>
                                    <input class="form-check-input" type="radio" name="editor" id="editor2" value="visual">
                                </div>
                            </div>                            
                        </div>  

                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0 mt-5">
                        <div class="form-group">
                            <input type="hidden" id="type" name='site_logo' placeholder="Image Url" class="form-control" >
                            <img id="myImg" src="{{ asset('admin/img/dummy-image-square.jpg') }}" width="100%" height="auto" data-toggle="modal" data-target="#exampleModalCenter" class="border border-info">
                        </div> 
                    </div>  
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Save</button>                            
            </form>            
            <hr>
        </div>
    </div>
</div> 
<!-- Insert Image from library -->
@include('admin.media.medialibrary')
@include('admin.media.mediauploads')
<!-- Modal -->
@else
You can't access this page. Please contact admin.
@endif
@endsection