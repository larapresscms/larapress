@extends('front.themes.laratheme.layouts.master')
@section('content')  
<!-- ======================= Blog Details Section Start ========================= -->
<section class="blog-details padding-y-120 position-relative overflow-hidden">
    <div class="container container-two">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details top Start -->
                <div class="blog-details-top mb-64">                    
                    <h2 class="blog-details-top__title mb-4 text-capitalize">{{$posttype->name}}</h2>                     
                </div>
                <!-- blog details top End -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details content Start -->
                <div class="blog-details-content">
                    <!-- ================== Setting Section Start ====================== -->
                    <div class="row gy-4">
                        <div class="col-lg-4 pe-xl-5">
                            <div class="setting-sidebar top-24">
                                <!-- <h6 class="setting-sidebar__title">Doc:</h6> -->
                                <ul class="setting-sidebar-list">
                                    @foreach($posts as $post)
                                    <li class="setting-sidebar-list__item"><a href="#info{{$post->id}}" class="setting-sidebar-list__link active">{{$post->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <!-- <form action="#"> -->
                                <div class="setting-content" data-bs-spy="scroll" data-bs-target="#sidebar-scroll-spy">
                                    @foreach($posts as $post)
                                    <div class="card common-card border border-gray-five overflow-hidden mb-24"  id="info{{$post->id}}">
                                        <div class="card-header">
                                            <h6 class="title">{{$post->title}}</h6>
                                        </div>
                                        <div class="card-body">
                                        {!! $post->content !!}
                                        </div>
                                    </div>
                                    @endforeach                        
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <!-- ================== Setting Section End ====================== -->                  
                </div>
                <!-- blog details content End-->
            </div>
        </div>
    </div>
</section>
<!-- ======================= Blog Details Section End ========================= -->    
@endsection  