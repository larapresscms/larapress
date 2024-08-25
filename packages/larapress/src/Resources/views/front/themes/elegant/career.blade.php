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
                    <h2 class="breadcrumb-page-title">Career</h2>
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
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="career-title-area text-center section-space--bottom--50">
                        {!! $posttype->pt_content !!}
                        </div>
                    </div>
                </div>
                <div class="row row-30">
                    <div class="col-md-6">
                    <div class="common-page-content">
                        <div class="common-page-text-wrapper section-space--bottom--50">
                            <h2 class="common-page-title">Corporate</h2>
                          
                        </div>
                        <div class="faq-wrapper section-space--bottom--60">

                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            AVAILABLE JOBS <span> <i class="ion-plus"></i>
                                                <i class="ion-minus"></i> </span>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion" style="">
                                        
                                    @foreach($posts as $post)
                                    @if($post->post_type == 'career') 
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
                                    @endif
                                    <div class="card-body card_open_bg">
                                        {!!$post->content!!}
                                    </div>
                                    @endforeach  

                                        

                                    </div>
                                </div>
                            
                         
                            </div>

                        </div>
   
                     
                      
                    </div>

                    </div>
                    <div class="col-md-6">
                        <div class="contact-form-wrapper">
                            <form id="contact-form" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="text" name="con_name" id="con_name" placeholder="Your Name (required) *" required="">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" name="con_email" id="con_email" placeholder="Your Email (required) *" required="">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="con_phone" id="con_phone" placeholder="Phone Number">
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" name="con_name" id="con_name" placeholder="Subject*" required="">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Message" name="con_message" id="con_message"></textarea>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" value="submit" id="submit" name="submit" class="ht-btn ht-btn--default">SUBMIT NOW</button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--====================  End of icon info area  ====================-->


<!-- address end  -->
<!--====================  End area  ====================-->
@endsection  