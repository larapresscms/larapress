@extends('front.themes.laratheme.layouts.master')
@section('content')
<!-- end header -->
<!-- Breadcrumbs Start -->
<div class="breadcrumb-area breadcrumb-area-bg section-space--inner--80 bg-img" data-bg="{{ asset('public/uploads/images/855928.jpg')}}">
    <div class="container">
        <div class="row align-items-center comon-titel_set">
            <div class="col-sm-6">
                <h2 class="breadcrumb-page-title">Search Result:</h2>
            </div>            
        </div>
    </div>
    <div class="innar-overlay"></div>
    
</div>
<div class="career-contact section-space--inner--120  secend-bg">
            <div class="container">
<!-- Breadcrumbs End -->
<div class="container mt-50">
<!--End breadcrumb area-->  
@if($search_posts == "[]")
<section class="fasality-pag">
    <div class="container">
    <!--Start bottom text-->
        <div class="row">
            <div class="col-md-12 ">
                <div class="sec-title">
                <h2>Nothing Found <span></span></h2>
                <span class="decor"></span>
                </div>
                <p class="facilities-body">Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
            </div>
        </div>
    </div>
</section>
@endif
@foreach($search_posts as $post)    
    <div class="col-md-12">        
        <li><a href="{{ url($post->post_type, $post->slug) }}">{{ $post->title }}<span></span></a></li>
    </div>
@endforeach
</div>
</div>
</div>
<!-- footer start -->
@endsection   