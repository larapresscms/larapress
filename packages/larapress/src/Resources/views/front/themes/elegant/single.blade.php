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
    
@endsection  