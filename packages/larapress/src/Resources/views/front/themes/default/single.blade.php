@extends('front.themes.default.layouts.master')
@section('content')
<!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h4 class="fw-bolder">{{ $post->title ?? ''}}</h4>
                    <!-- <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p> -->
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <div class="mb-4">
                        <img class="card-img-top" src="{{ url('public/uploads/images/',$post->thumbnail_path ?? '') }}" alt="..." />                      
                        <style>{!! $post->content_css ?? '' !!}</style>
                        <p class="card-text">{!! $post->content ?? '' !!}</p>
                    </div>
                </div>                
            </div>
        </div>
        @getTemplate($post->template ?? '')  
@endsection      