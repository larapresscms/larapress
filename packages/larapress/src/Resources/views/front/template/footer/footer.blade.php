<?php
/* Template Name: Footer
    Version: 1.0
*/
?>
{{insertDummyData('Footer', 1, 'Copyright', 'Copyright 2024')}}
<footer class="py-5 bg-dark">
    @foreach(getPostsByType('footer') as $post)
    <div class="container"><p class="m-0 text-center text-white">{!! $post->content !!}</p></div>
    @endforeach
</footer>