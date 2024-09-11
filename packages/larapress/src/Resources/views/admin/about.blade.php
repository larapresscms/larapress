@extends('admin.layouts.master')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">  
        <div class="jumbotron jumbotron-fluid">
            <div class="container"> 
                <h2>LaraPress Update Available.</h2>
                <a href="{{url('/dashboard/update')}}" class="btn btn-primary">Install Update</a>    
            </div>                          
            <div class="container mt-5"> 
                <h2>Template Upload.</h2>
                <form action="{{url('/dashboard/upload-template')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="templateZip" accept=".zip">
                    <button type="submit" class="btn btn-primary">Upload and Install</button>
                </form>    
            </div>      
        </div>
    </div>                       
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">  
        <div class="jumbotron jumbotron-fluid">            
            <div class="container">
                <h2 class="display-4">What's New v1.0.8</h2>
                <hr>
                <p class="lead"></p>
                <p>Template theme make</p>
                <p>Post type url fix.</p>
                <p>Menu url fix. Add post type with more...</p>         
            </div> 
        </div>
    </div>                       
</div>
@endsection