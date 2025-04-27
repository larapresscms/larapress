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
                <h2 class="display-4">What's New v{{$CurrentLaraPressVersion ?? "Not Available"}}</h2>
                <hr>
                <p class="lead"></p>
                <p>Laravel ^12.0</p>
                <p>More bug fixed.</p>         
            </div> 
        </div>
    </div>                       
</div>
@endsection