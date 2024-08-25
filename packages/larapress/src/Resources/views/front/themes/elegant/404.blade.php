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
    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  icon info area ====================-->
    <div class="career-contact section-space--inner--120  secend-bg">
            <div class="container">
            {!! $posttype->pt_content !!}                
            </div>
        </div>
    <!--====================  End of icon info area  ====================-->


<!-- address end  -->
<!--====================  End area  ====================-->
@endsection  