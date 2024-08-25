@extends('front.themes.default.layouts.master')
@section('content')
<!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h4 class="fw-bolder">{{ $post->title }} aaa</h4>
                    <!-- <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p> -->
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="{{ $post->thumbnail_path }}" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->created_at }}</div>
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{!! $post->content !!}</p> 
                        </div>
                    </div>
                </div>
                @include('front.themes.default.sidebar')
            </div>
        </div>
@endsection      