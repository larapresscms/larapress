@extends('front.themes.default.layouts.master')
@auth()
<!--toplabel menu -->
<div class="navbar-dark bg-dark fixed-top py-2">
    <div class="container text-center">
        <a class="navbar-brand text-white" href="{{url('/dashboard')}}">Dashboard</a>
        <a class="nav-link text-white d-inline-block" href="{{url('/dashboard/posts/posttype/')}}/{{$post->id}}/edit/{{$post->post_type}}">- Edit Post -</a>
        <a class="nav-link text-white d-inline-block" href="{{ url('/logout') }}">Logout</a>
    </div>
</div>
<!--end top lavel menu-->
@endauth
@section('content')
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-12">
            <!-- Featured blog post-->            
            @if($post->thumbnail_path)
            <img class="card-img-top mt-4" src="{!! asset('public/uploads/' . $post->thumbnail_path) ?? '' !!}" alt="..." />  
            @endif                    
            <style>{!! $post->content_css ?? '' !!}</style>
            <p class="card-text">{!! $post->content ?? '' !!}</p>            
        </div>                
    </div>
</div>
@getTemplate($post->template ?? '')  
@endsection      