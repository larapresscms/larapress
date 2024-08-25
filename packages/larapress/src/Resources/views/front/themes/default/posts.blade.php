@extends('front.themes.default.layouts.master')
@section('content')
    @foreach($posts as $post)                  
        <h3 class="text-center p-2">{{$post->title}}</h3>                             
        <a class="apply-but " href="{{url('/')}}/{{$post->slug}}">Apply Now</a>                
    @endforeach 
@endsection      

 