<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Elegant</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/front/elegant/img/logo/fab-logo.png')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@200;400&display=swap" rel="stylesheet">
    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/vendor/bootstrap.min.css')}}">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/vendor/font-awesome.min.css')}}">

    <!-- Ionicons CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/vendor/ionicons.min.css')}}">

    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/vendor/flaticon.min.css')}}">

    <!-- Icomoon CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/vendor/icomoon.min.css')}}">

    <!-- Tractor icon CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/vendor/tractor-icon.min.css')}}">

    <!-- Swiper slider CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/plugins/swiper.min.css')}}">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/plugins/animate.min.css')}}">

    <!-- Light gallery CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/plugins/lightgallery.min.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('public/front/elegant/css/style.css')}}">

    <!-- Revolution Slider CSS -->
    <link href="{{ asset('public/front/elegant/revolution/css/settings.css')}}" rel="stylesheet">
    <link href="{{ asset('public/front/elegant/revolution/css/navigation.css')}}" rel="stylesheet">
    <link href="{{ asset('public/front/elegant/revolution/custom-setting.css')}}" rel="stylesheet">


</head>

<body>
    <!--====================  preloader ====================-->
    <!--<div class="preloader-activate preloader-active">-->
    <!--    <div class="preloader-area-wrap">-->
    <!--        <div class="spinner d-flex justify-content-center align-items-center h-100">-->
    <!--            <img src="{{ asset('public/front/elegant/img/preloader.gif')}}" alt="">-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!--====================  End of preloader  ====================-->
    <!--====================  header area ====================-->
    <div class="header-area header-sticky">
        <div class="header-area__desktop">
        
            <!--=======  header navigation area  =======-->
            <div class="header-navigation-area">
                <div class="container-fluid container-fluid--cp-60">
                    <div class="row">
                        <div class="col-lg-2">
                            <!--<div class="col-lg-2" style="background-color: #23232a;border-right: 1px solid #ffc246;">-->
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('public/front/elegant/img/logo/logo-e.png')}}" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="header-navigation-wrapper">
                                <!-- header navigation -->
                                <div class="header-navigation ">
                                    <div class="header-navigation__nav">
                                        <nav>
                                            <ul>
                                                <div class="menu-widget">
                                                </div>
                                                @foreach($menus as $menu)
                                                @if($menu->sub_menu_id == 0)
                                                    
                                                        <!-- finddin dropdown for arraw  -->
                                                        @foreach($menus as $menuDopdown)                                    
                                                            @if($menu->id == $menuDopdown->sub_menu_id)
                                                                @php $dropdowntoggle = 'dropdown-toggle'; @endphp
                                                            @break
                                                            @else
                                                                @php $dropdowntoggle = ''; @endphp
                                                            @endif
                                                        @endforeach                                                      


                                                        <li class="{{$dropdowntoggle == 'dropdown-toggle' ? 'has-children':''}}">  
                                                        <!-- finddin dropdown for arraw  -->
                                                        <a href="{{ $menu->target == 'external_link' ? $menu->url : url('/') . $menu->url }}" target="{{$menu->target}}">{{$menu->title}}</a>
                                                        @if($dropdowntoggle == 'dropdown-toggle')
                                                            
                                                            @foreach($categories as $category) 
                                                                @if($category->slug == 'mega-menu')

                                                                <ul class="megamenu megamenu--tab">                                                
                                                                    <li class="megamenu--tab__menu bg-img bg-img--menu">
                                                                        <nav>
                                                                            <div class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
                                                                                @php $count = 1; @endphp
                                                                                @foreach($menus as $menuDopdown)                                    
                                                                                    @if($menu->id == $menuDopdown->sub_menu_id)                                                                      
                                                                                        <a class="nav-item nav-link {{ $count == 1 ? 'active':''}}" id="item{{$count}}-tab" data-bs-toggle="tab" href="#item{{$count}}" role="tab" aria-selected="true">{{$menuDopdown->title}}</a>
                                                                                        @php $count++; @endphp
                                                                                    @endif
                                                                                @endforeach 
                                                                            </div>
                                                                        </nav>
                                                                    </li>
                                                                    <li class="megamenu--tab__content tab-content">
                                                                        @php $count = 1; @endphp
                                                                        @foreach($menus as $menuDopdown)                                    
                                                                            @if($menu->id == $menuDopdown->sub_menu_id)

                                                                                <div class="tab-pane show {{ $count == 1 ? 'active':''}}" id="item{{$count}}" role="tabpanel" aria-labelledby="item{{$count}}-tab">                                                                
                                                                                    <ul class="megamenu-tab-wrapper">
                                                                                        <div class="row db-col w-100">
                                                                                            <h2 class="page-list-title"><a href="{{ $menuDopdown->target == 'external_link' ? $menuDopdown->url : url('/') . $menuDopdown->url }}" target="{{$menuDopdown->target}}">{{$menuDopdown->title}}</a>  </h2>                                                                                            
                                                                                            <div class='col-md-12'>
                                                                                                <ul class="list-unstyled row w-100" style="margin-left: 0px;" >

                                                                                                @foreach($menus as $menuDopdownMegamenu)                                    
                                                                                                    @if($menuDopdown->id == $menuDopdownMegamenu->sub_menu_id)                            
                                                                                                    <li class="col-md-6"><a href="{{ $menuDopdownMegamenu->target == 'external_link' ? $menuDopdownMegamenu->url : url('/') . $menuDopdownMegamenu->url }}" target="{{$menuDopdownMegamenu->target}}">{{$menuDopdownMegamenu->title}}</a></li> 
                                                                                                @endif
                                                                                                @endforeach                                                                                                    
                                                                                                
                                                                                                </ul>  
                                                                                            </div>
                                                                                        </div>                                                                                        
                                                                                    </ul>
                                                                                </div>

                                                                                @php $count++; @endphp
                                                                            @endif
                                                                        @endforeach                                                                        
                                                                        
                                                                        
                                                                    </li>
                                                                    @php
                                                                    $postsmm = DB::table('posts')->orderBy('id','DESC')->where('status','1')->where('post_type','pages')->get(); 
                                                                    @endphp
                                                                    @foreach($postsmm as $post)
                                                                    @if($post->post_type == 'pages' && $post->slug == 'garments-apparels-1') 
                                                                     
                                                                    <div class="menu-widget__content">
                                                                        @auth()
                                                                            <!--toplabel menu -->
                                                                            <style>
                                                                                .topnavfooter {
                                                                                    background: #000;
                                                                                    color: #fff;
                                                                                    text-align: center;
                                                                                    width: 100%; 
                                                                                    top:0;
                                                                                    left: 0;
                                                                                    right: 0;
                                                                                    background-color: #162434;
                                                                                    z-index: 9999;
                                                                                    padding: 5px;
                                                                                }
                                                                                .topnavfooter a{
                                                                                    color: #fff;
                                                                                    padding-right: 10px;
                                                                                }
                                                                            </style>
                                                                            <div class="topnavfooter">
                                                                            <a class="active" href="{{url('/dashboard')}}">Dashboard</a> 
                                                                                <a href="{{url('/dashboard/posts/posttype/')}}/{{$post->id}}/edit/{{$post->post_type}}">Edit Post</a>   
                                                                            <a href="{{ url('/logout')}}">Logout</a>
                                                                            </div>
                                                                            <!--end top lavel menu-->
                                                                            @endauth
                                                                        <h3 class="menu-widget__title">{{$post->title}}</h3>
                                                                        {!! $post->content !!}
                                                                        <a href="{{$post->excerpt}}" class="menu-widget__link">SEE MORE <i class="ion-arrow-right-c"></i></a>
                                                                    </div>  
                                                                    
                                                                    @endif
                                                                    @endforeach                                                   
                                                                </ul>



                                                                @else

                                                                <ul class="sub-menu">
                                                                @foreach($menus as $menuDopdown)                                    
                                                                    @if($menu->id == $menuDopdown->sub_menu_id)  
                                                                    <li> 
                                                                    <!-- finddin dropdown for arraw 2 -->
                                                                    <a href="{{ $menuDopdown->target == 'external_link' ? $menuDopdown->url : url('/') . $menuDopdown->url }}" target="{{$menuDopdown->target}}">{{$menuDopdown->title}}</a>                                                     
                                                                    </li>
                                                                    @endif
                                                                @endforeach  
                                                                </ul>

                                                                @endif
                                                            @endforeach 
                                                        
                                                            

                                                        @endif
                                                    </li>
                                                @endif
                                                @endforeach                          
                                            </ul>                                     
                                        </nav> 
                                  
                                    </div>
                                </div>

                                <!-- header search -->
                                <div class="header-search">
                                    <div class="header-navigation__contact">
                                        <div class="header-navigation__contact__image">
                                            <i class="ion-ios-telephone-outline"></i>
                                        </div>
                                        <div class="header-navigation__contact__content">
                                        
                                            <h4 class="sub-text text-light">+880-2-8816599</h4>
                                        </div>
                                 </div>

                                 <div class="header-search--style4">
                                    <div class="header-navigation__icon__search">
                                        <a href="javascript:void(0)" id="search-overlay-trigger">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=======  End of header navigation area =======-->
        </div>



        <div class="header-area__mobile">
            <!--=======  mobile menu  =======-->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-sm-6 col-5">
                            <!-- logo -->
                            <div class="logo">
                                <a href="{{url('/')}}">
                                    <img src="{{ asset('public/front/elegant/img/logo/logo-e.png')}}" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6 col-7">
                            <!-- mobile menu content -->
                            <div class="mobile-menu-content">
                                <div class="social-links d-none d-md-block">
                                    <ul>
                                        <li><a href="http://facebook.com/" data-tippy="Facebook" data-tippy-inertia="false" data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder__yellow" data-tippy-placement="bottom"><i class="ion-social-facebook"></i></a></li>
                                        <li><a href="http://twitter.com/" data-tippy="Twitter" data-tippy-inertia="false" data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder__yellow" data-tippy-placement="bottom"><i class="ion-social-twitter"></i></a></li>
                                        <li><a href="http://vimeo.com/" data-tippy="Vimeo" data-tippy-inertia="false" data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder__yellow" data-tippy-placement="bottom"><i class="ion-social-vimeo"></i></a></li>
                                        <li><a href="http://linkedin.com/" data-tippy="Linkedin" data-tippy-inertia="false" data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder__yellow" data-tippy-placement="bottom"><i class="ion-social-linkedin"></i></a></li>
                                        <li><a href="http://skype.com/" data-tippy="Skype" data-tippy-inertia="false" data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder__yellow" data-tippy-placement="bottom"><i class="ion-social-skype"></i></a></li>
                                    </ul>
                                </div>
                                <div class="mobile-navigation-icon" id="mobile-menu-trigger">
                                    <i></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=======  End of mobile menu  =======-->
        </div>
    </div>
    <!--====================  End of header area  ====================-->
    <!--====================  mobile menu overlay ====================-->
    <div class="mobile-menu-overlay" id="mobile-menu-overlay">
        <div class="mobile-menu-overlay__header">
            <div class="container-fluid--cp-60">
                <div class="row align-items-center">
                    <div class="col-md-4 col-sm-6 col-9">
                        <!-- logo -->
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ asset('public/front/elegant/img/logo/logo-e.png')}}" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6 col-3">
                        <!-- mobile menu content -->
                        <div class="mobile-menu-content">
                            <a class="mobile-navigation-close-icon" id="mobile-menu-close-trigger" href="javascript:void(0)">
                                <i class="ion-ios-close-empty"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay__body">
            <nav class="offcanvas-navigation">
                <ul>
                @foreach($menus as $menu)
                @if($menu->sub_menu_id == 0)                
                    <!-- finddin dropdown for arraw  -->
                    @foreach($menus as $menuDopdown)                                    
                        @if($menu->id == $menuDopdown->sub_menu_id)
                            @php $dropdowntoggle = 'dropdown-toggle'; @endphp
                        @break
                        @else
                            @php $dropdowntoggle = ''; @endphp
                        @endif
                    @endforeach 
                    <li class="{{$dropdowntoggle == 'dropdown-toggle' ? 'has-children':''}}">  
                        <!-- finddin dropdown for arraw  -->
                        <a href="{{ $menu->target == 'external_link' ? $menu->url : url('/') . $menu->url }}" target="{{$menu->target}}">{{$menu->title}}</a>
                        @if($dropdowntoggle == 'dropdown-toggle')                              

                            <ul class="sub-menu">
                            @foreach($menus as $menuDopdown2)                                    
                                @if($menu->id == $menuDopdown2->sub_menu_id) 

                                <!-- finddin dropdown for arraw  -->
                                @foreach($menus as $menuDopdown3)                                    
                                    @if($menuDopdown3->id == $menuDopdown2->sub_menu_id)
                                        @php $dropdowntoggle = 'dropdown-toggle'; @endphp
                                    @break
                                    @else
                                        @php $dropdowntoggle = ''; @endphp
                                    @endif
                                @endforeach 

                                <li class="{{$dropdowntoggle == 'dropdown-toggle' ? 'has-children':''}}"> 
                                <!-- finddin dropdown for arraw 2 -->
                                <a href="{{ $menuDopdown2->target == 'external_link' ? $menuDopdown2->url : url('/') . $menuDopdown2->url }}" target="{{$menuDopdown2->target}}">{{$menuDopdown2->title}}</a>

                                    @if($dropdowntoggle == 'dropdown-toggle')                              

                                    <ul class="sub-menu">
                                    @foreach($menus as $menuDopdown4)                                    
                                        @if($menuDopdown2->id == $menuDopdown4->sub_menu_id) 
                                            <li> 
                                            <!-- finddin dropdown for arraw 2 -->
                                            <a href="{{ $menuDopdown4->target == 'external_link' ? $menuDopdown4->url : url('/') . $menuDopdown4->url }}" target="{{$menuDopdown4->target}}">{{$menuDopdown4->title}}</a>
                                            </li>
                                        @endif
                                    @endforeach                                    
                                    
                                    </ul>

                                    @endif

                                </li>
                                @endif
                            @endforeach  
                            </ul> 

                        @endif
                    </li>
                @endif
                @endforeach    

                     
                </ul>
            </nav>
        </div>
    </div>
    <!--====================  End of mobile menu overlay  ====================-->
    <!--====================  search overlay ====================-->
    <div class="search-overlay" id="search-overlay">
        <a id="popup-search-close" href="#" class="popup-search-close"><i class="ion-ios-close-empty"></i></a>
        <div class="page-popup-search-inner">
            <form action="{{url('/searchall')}}" method="get">
                <input type="text" name="name" placeholder="" class="search-field" id="search-field">
            </form>


            <p class="form-description">Hit enter to search or ESC to close</p>
        </div>
    </div>
    <!--====================  End of search overlay  ====================-->


    @yield('content')


    <!--====================  End of support footer area  ====================-->

    @php
    $posts = DB::table('posts')->orderBy('id','DESC')->where('status','1')->where('post_type','pages')->get(); 
    @endphp

    @foreach($posts as $post)
    @if($post->post_type == 'pages' && $post->slug == 'footer') 
    @auth()
    <!--toplabel menu -->
    <style>
        .topnavfooter {
            background: #000;
            color: #fff;
            text-align: center;
            width: 100%; 
            top:0;
            left: 0;
            right: 0;
            background-color: #162434;
            z-index: 9999;
            padding: 5px;
        }
        .topnavfooter a{
            color: #fff;
            padding-right: 10px;
        }
    </style>
    <div class="topnavfooter">
    <a class="active" href="{{url('/dashboard')}}">Dashboard</a> 
        <a href="{{url('/dashboard/posts/posttype/')}}/{{$post->id}}/edit/{{$post->post_type}}">Edit Post</a>   
    <a href="{{ url('/logout')}}">Logout</a>
    </div>
    <!--end top lavel menu-->
    @endauth

    {!! $post->content !!}

    @endif
    @endforeach  

    <div class="container-fluid px-0 f-copy">
        <div class="about_under">
            <div class="d-flex">
                <div class="copyright">
                    <p>© 2024 Elegant. All Rights Reserved.</p>
                </div>
                <div class="power">                   
                        <p>
                            <em>Powered by - </em>
                            <a href="https://aamrainfotainment.com/">
                                <img src="{{ asset('public/front/elegant/img/aamra-logo-b.png')}}" alt="">
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--====================  OLD footer area ====================-->
  
    <!--====================  End of footer area  ====================-->


    <!--====================  scroll top ====================-->
    <a href="#" class="scroll-top" id="scroll-top">
        <i class="ion-android-arrow-up"></i>
    </a>
    <!--====================  End of scroll top  ====================-->
    <!-- JS
    ============================================ -->

    <!-- Modernizer JS -->
    <script src="{{ asset('public/front/elegant/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <!-- jQuery JS -->
    <script src="{{ asset('public/front/elegant/js/vendor/jquery.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('public/front/elegant/js/vendor/bootstrap.min.js')}}"></script>

    <!-- Popper JS -->
    <script src="{{ asset('public/front/elegant/js/vendor/popper.min.js')}}"></script>

    <!-- Swiper Slider JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/swiper.min.js')}}"></script>

    <!-- Tippy JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/tippy.min.js')}}"></script>

    <!-- Light gallery JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/lightgallery.min.js')}}"></script>

    <!-- Light gallery video JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/lg-video.min.js')}}"></script>

    <!-- Waypoints JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/waypoints.min.js')}}"></script>

    <!-- Counter up JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/counterup.min.js')}}"></script>

    <!-- Appear JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/appear.min.js')}}"></script>

    <!-- Gmap3 JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/gmap3.min.js')}}"></script>

    <!-- Isotope JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/isotope.min.js')}}"></script>

    <!-- Mailchimp JS -->
    <script src="{{ asset('public/front/elegant/js/plugins/mailchimp-ajax-submit.min.js')}}"></script>


    <!-- Main JS -->
    <script src="{{ asset('public/front/elegant/js/main.js')}}"></script>


    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD79MY72taVRlZVX2DU6L5PXOh3ezUUKMc&amp;callback=initMap"></script>

    <!-- Map JS -->
 


    <!-- Revolution Slider JS -->
    <script src="{{ asset('public/front/elegant/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="{{ asset('public/front/elegant/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{ asset('public/front/elegant/revolution/revolution-active.js')}}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="{{ asset('public/front/elegant/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script src="{{ asset('public/front/elegant/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script src="{{ asset('public/front/elegant/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script src="{{ asset('public/front/elegant/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script src="{{ asset('public/front/elegant/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script src="{{ asset('public/front/elegant/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>

    <!--=====  End of JS files ======-->

    <script>
        $('.read-more').click(function() {
        $(this).prev().slideToggle();
        if (($(this).text()) == "Read More..") {
            $(this).text("Read Less");
        } else {
            $(this).text("Read More..");
        }
    });
    </script>
    
    
    
<script>
    $(".show-more").click(function () {
        if($(".text_text").hasClass("show-more-height")) {
            $(this).text("Show Less");
        } else {
            $(this).text("Show More");
        }

        $(".text_text").toggleClass("show-more-height");
    });
</script>
    
<script>
    $(".show-more1").click(function () {
        if($(".text_text1").hasClass("show-more-height_light")) {
            $(this).text("Show Less");
        } else {
            $(this).text("Show More");
        }

        $(".text_text1").toggleClass("show-more-height_light");
    });
</script>



</body>

</html>