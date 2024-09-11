@extends('admin.layouts.master')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">  
        <div class="jumbotron jumbotron-fluid">            
            <div class="container">
                <h1 class="display-4">What's New v1.1</h1>
                <hr>
                <p class="lead"></p>
                <p>Fav icon fix.</p>
                <p>Post type url fix.</p>
                <p>Menu url fix. Add post type.</p>
                <p>404 page create</p>                
            </div> 
        </div>
    </div>                       
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">  
        <div class="jumbotron jumbotron-fluid">
            <div class="container"> 
                <h1>LaraPress Update Available.</h1>
                <a href="{{url('/dashboard/update')}}" class="btn btn-primary">Install Update</a>    
            </div>                          
            <div class="container mt-5"> 
                <h1>Template Upload.</h1>
                <form action="{{url('/dashboard/upload-template')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="templateZip" accept=".zip">
                    <button type="submit" class="btn btn-primary">Upload and Install</button>
                </form>    
            </div>      
        </div>
    </div>                       
</div>
@endsection