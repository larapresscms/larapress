@extends('front.themes.default.layouts.master')
@auth()
<!--toplabel menu -->
<div class="navbar-dark bg-dark fixed-top py-2">
    <div class="container text-center">
        <a class="text-white" href="{{url('/dashboard')}}">Dashboard</a>
        <a class="text-white d-inline-block" href="{{url('/dashboard/posts/posttype/')}}/{{$post->id}}/edit/{{$post->post_type}}">- Edit Post -</a>
        <a class="text-white d-inline-block" href="{{ url('/logout') }}">Logout</a>
    </div>
</div>
<!--end top lavel menu-->
@endauth
@section('content') 
@getTemplate($post->template ?? '')  
@endsection      



