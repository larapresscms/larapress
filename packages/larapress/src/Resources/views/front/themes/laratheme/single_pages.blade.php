@extends('front.themes.laratheme.layouts.master')
@auth()
<!--toplabel menu -->
<style>
    .topnav {
    	background: #000;
    	color: #fff;
    	text-align: center;
    	position: fixed;
    	width: 100%; 
    	top:0;
    	left: 0;
    	right: 0;
    	background-color: #162434;
    	z-index: 9999;
        padding: 0px;
    }
    .topnav a{
        color: #fff;
        padding-right: 10px;
    }
</style>
<div class="topnav">
  <a class="active" href="{{url('/dashboard')}}">Dashboard</a> 
    <a href="{{url('/dashboard/posts/posttype/')}}/{{$post->id}}/edit/{{$post->post_type}}">Edit Post</a>   
  <a href="{{ url('/logout')}}">Logout</a>
</div>
<!--end top lavel menu-->
@endauth
@section('content')  
<!-- ======================= Blog Details Section Start ========================= -->
<section class="blog-details padding-y-120 position-relative overflow-hidden">
    <div class="container container-two">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details top Start -->
                <div class="blog-details-top mb-64">                    
                    <h2 class="blog-details-top__title mb-4 text-capitalize">{{$post->title ?? ''}}</h2>                     
                </div>
                <!-- blog details top End -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details content Start -->
                <div class="blog-details-content">
                {!! $post->content !!}                    
                </div>
                <!-- blog details content End-->
            </div>
        </div>
    </div>
</section>
<!-- ======================= Blog Details Section End ========================= -->    
@endsection  