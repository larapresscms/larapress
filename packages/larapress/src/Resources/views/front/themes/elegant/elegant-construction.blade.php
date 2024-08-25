@extends('front.themes.elegant.layouts.master')
@auth()
<!--toplabel menu -->
<style>
    .topnavp {
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
    .topnavp a{
        color: #fff;
        padding-right: 10px;
    }
</style>
<div class="topnavp">
  <a class="active" href="{{url('/dashboard')}}">Dashboard</a> 
    <a href="{{url('/dashboard/posttypes/')}}/{{$posttype->id}}/edit">Edit Post</a>  
  <a href="{{ url('/logout')}}">Logout</a>
</div>
<!--end top lavel menu-->
@endauth
@section('content')
    <!--====================  start area  ====================-->
  <!--====================  breadcrumb area ====================-->
  <div class="breadcrumb-area breadcrumb-area-bg section-space--inner--80 bg-img" data-bg="{{ asset('public/uploads/images/')}}/{{$posttype->pt_thumbnail_path}}">
        <div class="container">
            <div class="row align-items-center comon-titel_set">
                <div class="col-sm-6">
                    <h2 class="breadcrumb-page-title">{{$posttype->name}}</h2>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb-page-list text-uppercase">
                        <li class="has-children"><a href="{{url('/')}}">Home</a></li>
                        <li>{{$posttype->name}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="innar-overlay"></div>
     
    </div>

    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  icon info area ====================-->
    <div class="career-contact section-space--inner--120  secend-bg">
            <div class="container">
                
                    <div class="case-study__image-gallery-wrapper section-space--top--80">
                        <div class="row image-popup">
                            @foreach($posts as $post)
                            @if($post->post_type == $posttype->slug) 
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                @auth()
                                <!--toplabel menu -->
                                <style>
                                    .topnav {
                                        background: #000;
                                        color: #fff;
                                        text-align: center;
                                        width: 100%; 
                                        top:0;
                                        left: 0;
                                        right: 0;
                                        background-color: #162434;
                                        z-index: 9999;
                                        padding: 5px;
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
                                <div class="case-study__single-gallery-image">
                                    <a href="{{ asset('public/uploads/images/')}}/{{$post->thumbnail_path}}" class="single-gallery-thumb">
                                        <img src="{{ asset('public/uploads/images/')}}/{{$post->thumbnail_path}}" class="img-fluid" alt="">
                                        <div class="stady_text"><h4>{!!$post->title!!}</h4>
                                        <h4>{!!$post->content!!}</h4>
                                       </div>
                                    </a>
                                </div>
                            </div>
                            @endif 
                            @endforeach  
                        </div>
                    </div>
                
            </div>
    </div>
    <!--====================  End of icon info area  ====================-->
    <div class="icon-info-area section-space--inner--60 dark-bg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="icon-info-wrapper">
               <div class="row">
                   {!! $posttype->pt_content !!}
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<!-- address end  -->
<!--====================  End area  ====================-->
@endsection  