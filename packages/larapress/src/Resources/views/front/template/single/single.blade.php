<?php
/* Template Name: Single Page
    Version: 1.0
*/
?> 
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({!! asset('public/uploads/' . getContentBySlug(collect(request()->segments())->last())->thumbnail_path) ?? '' !!})">
    </div>
    <div class="container">
        <div class="page-header__inner">             
            <h2>{!! getContentBySlug(collect(request()->segments())->last())->title ?? '' !!}</h2>
        </div>
    </div>
</section> 
<section style="background: #f4f4f4;">
    <div class="container teem-costom py-5">
         <style>{!! getContentBySlug(collect(request()->segments())->last())->content_css ?? '' !!}</style>
        {!! getContentBySlug(collect(request()->segments())->last())->content ?? '' !!}
    </div>
</section>    