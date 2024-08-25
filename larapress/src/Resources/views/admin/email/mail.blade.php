@extends('front.themes.'.$themeName.'.layouts.master')
@section('content')
<section class="cart-thank section-bg padding-y-120 position-relative z-index-1 overflow-hidden">
    <img src="{{ asset('public/front/laratheme/assets/images/gradients/thank-you-gradient.png')}}" alt="" class="bg--gradient">    
    <div class="container container-two">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="cart-thank__content text-center">
                    <h2 class="cart-thank__title mb-48">Thank you for your interest in Larapress CMS!!</h2>
                    <p>{{$postss}}</p>
                    <div class="cart-thank__img">
                        <img src="{{ asset('public/front/laratheme/assets/images/thumbs/thank-evenelope.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>
@endsection      