@extends('front.themes.default.layouts.master')

@section('content')
<!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h4 class="fw-bolder">{{ $page->title }}</h4>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ $page->thumbnail_path }}"/>
                        <div class="card-body">
                            <h2 class="card-title"></h2>
                            <style>
                                {!! $page->content_css !!}
                            </style>
                            <p class="card-text">{!! $page->content !!}</p> 
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection      