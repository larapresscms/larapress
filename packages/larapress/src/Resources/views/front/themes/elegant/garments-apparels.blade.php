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
    <div class=" section-space--inner--50 secend-bg">
        <div class="container-fluid about_under">
            <div class="row">
                {!! $posttype->pt_content !!}
            </div>
           <div id="miss"></div> 
        </div>
    </div>



<!-- address end  -->

<div class="page-content-wrapper section-space--inner--120 grey-bg">
        <div class="row g-0">
            <div class="col-lg-12">
                <div class="industry-five-slider__container-area">
                    <div class="swiper-container industry-five-slider__container swiper-container-initialized swiper-container-horizontal">
                        <div class="swiper-wrapper industry-five-slider__wrapper" style="transition-duration: 0ms; transform: translate3d(-3221.67px, 0px, 0px);">
                            <!--  -->

                            @foreach($posts as $post)
                            @if($post->post_type == $posttype->slug)                             
                            
                            <div class="swiper-slide" data-swiper-slide-index="0" style="width: 614.333px; margin-right: 30px;">
                                <div class="industry-five-slider__single-slide">
                                    <div class="industry-five-slider__single-slide__image bg-img" data-bg="{{ asset('public/uploads/images/')}}/{{$post->thumbnail_path}}" style="background-image: url(&quot;{{ asset('public/uploads/images/')}}/{{$post->thumbnail_path}}&quot;);"></div>
                                    <div class="industry-five-slider__single-slide__content">
                                        <div class="post-icon">
                                        <i class="flaticon-041-eco"></i>
                                        </div>
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
                                        <h3 class="title"><a href="#">{!! $post->title !!}</a></h3>
                                        <p class="post-excerpt">{!! $post->excerpt !!}</p>
                                        <a href="{!! $post->option_1 !!}" class="see-more-link see-more-link--dark">SEE MORE <i class="ion-arrow-right-c"></i></a>
                                    </div>
                                </div>
                            </div>
                                
                            @endif
                            @endforeach 
 
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="false"></span></div>
                    <div class="swiper-pagination swiper-pagination-6 swiper-pagination-clickable swiper-pagination-bullets">
                        <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span>
                        <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span>
                        <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 3"></span>
                        <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span>
                        <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span>
                        <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6"></span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>


<!-- address end  -->
<!--====================  End area  ====================-->
@endsection 