<?php
/* Template Name: Hero Blog
    Version: 1.0
*/
?>
{{insertDummyData('Hero Blog',3)}}
<div class="container mb-4 mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach(getPostsByType('hero-blog') as $post)
        <div class="col">
            <a href="{{url($post->post_type, $post->slug)}}">
                <div class="card shadow-sm">
                    <img src="{!! asset('public/uploads/' . $post->thumbnail_path) ?? '' !!}" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="{{$post->title}}">
                    <div class="card-body">
                        <p class="card-text">{{$post->title}}</p>                
                    </div>
                </div>
            </a>
        </div>   
    @endforeach      
    </div>
</div>