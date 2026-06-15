<?php
/* Template Name: Single Page
    Version: 1.0
*/
?> 
<style>{!! getContentBySlug(collect(request()->segments())->last())->content_css ?? '' !!}</style>
{!! getContentBySlug(collect(request()->segments())->last())->content ?? '' !!}
