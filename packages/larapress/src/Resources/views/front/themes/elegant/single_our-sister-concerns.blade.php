@extends('front.themes.elegant.layouts.master')
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
  <!--====================  breadcrumb area ====================-->
    <div class="breadcrumb-area breadcrumb-area-bg section-space--inner--80 bg-img" data-bg="{{ asset('public/uploads/images/')}}/{{$post->thumbnail_path}}">
        <div class="container">
            <div class="row align-items-center comon-titel_set">
                <div class="col-sm-6">
                    <h2 class="breadcrumb-page-title">{{$post->title}}</h2>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb-page-list text-uppercase">
                        <li class="has-children"><a href="{{ url('/') }}">Home</a></li>
                        <li>{{$post->title}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="innar-overlay"></div>     
    </div>

    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  icon info area ====================-->
    {!! $post->content !!}
    
    
    
    {!! $post->more_option_2 !!}
    
@php
    $posts = DB::table('posts')->orderBy('position','ASC')->where('status','1')->where('post_type',collect(request()->segments())->last())->get(); 
@endphp    
    
<div class="container-fluid " style="background-color: #000;">
   <!-- start  -->
   <div class="container section-space--inner--50">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-title-area">
               <h2 class="title title--style4 section-space--bottom--30 text-white">{{$post->option_3}}</h2>
            </div>
            <!-- industry grid wrapper -->
            <div class="industry-grid-wrapper">
               <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            @auth()
                            <!--toplabel menu -->
                            <style>
                                .topnavn {
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
                                .topnavn a{
                                    color: #fff;
                                    padding-right: 10px;
                                }
                            </style>
                            <div class="topnavn">
                            <a class="active" href="{{url('/dashboard')}}">Dashboard</a> 
                                <a href="{{url('/dashboard/posts/posttype/')}}/{{$post->id}}/edit/{{$post->post_type}}">Edit Post</a>   
                            <a href="{{ url('/logout')}}">Logout</a>
                            </div>
                            <!--end top lavel menu-->
                            @endauth
                    
                         <div class="industry-two-slider__single-item industry-two-slider__single-item--style2 section-space--bottom--60">
                            <div class="industry-two-slider__single-item__image"><a href="{{$post->option_1}}"> <img src="{{ asset('public/uploads/images/')}}/{{$post->thumbnail_path}}" class="img-fluid" alt=""> </a></div>
                            <div class="industry-two-slider__single-item__content">
                               <h3 class="title"><a href="{{$post->option_1}}">{{$post->title}}</a></h3>
                            </div>
                         </div>
                      </div>
                    @endforeach
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
@endsection  