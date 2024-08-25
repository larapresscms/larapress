<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Title -->
        <title>LaraPress – The CMS that grows with you.</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('public/front/laratheme/assets/images/larapress/big-logo.png')); ?>">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo e(asset('public/front/laratheme/assets/css/bootstrap.min.css')); ?>">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="<?php echo e(asset('public/front/laratheme/assets/css/fontawesome-all.min.css')); ?>">
        <!-- Slick -->
        <link rel="stylesheet" href="<?php echo e(asset('public/front/laratheme/assets/css/slick.css')); ?>">
        <!-- magnific popup -->
        <link rel="stylesheet" href="<?php echo e(asset('public/front/laratheme/assets/css/magnific-popup.css')); ?>">
        <!-- line awesome -->
        <link rel="stylesheet" href="<?php echo e(asset('public/front/laratheme/assets/css/line-awesome.min.css')); ?>">
        <!-- Main css -->
        <link rel="stylesheet" href="<?php echo e(asset('public/front/laratheme/assets/css/main.css')); ?>">
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-9DMTC6SZS0"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'G-9DMTC6SZS0');
        </script>

    </head>
    <body>
    
        <!--==================== Preloader Start ====================-->
        <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
        </div>
        <!--==================== Preloader End ====================-->

        <!--==================== Overlay Start ====================-->
        <div class="overlay"></div>
        <!--==================== Overlay End ====================-->

        <!--==================== Sidebar Overlay End ====================-->
        <div class="side-overlay"></div>
        <!--==================== Sidebar Overlay End ====================-->

        <!-- ==================== Scroll to Top End Here ==================== -->
        <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
        </div>
        <!-- ==================== Scroll to Top End Here ==================== -->

        <!-- ==================== Mobile Menu Start Here ==================== -->
        <div class="mobile-menu d-lg-none d-block">
            <button type="button" class="close-button"> <i class="las la-times"></i> </button>
            <div class="mobile-menu__inner">
                <a href="index-2.html" class="mobile-menu__logo">
                    <img src="<?php echo e(asset('public/front/laratheme/assets/images/larapress/larapress.png')); ?>" alt="Logo" class="white-version">
                    <img src="<?php echo e(asset('public/front/laratheme/assets/images/logo/white-logo-two.png')); ?>" alt="Logo" class="dark-version">
                </a>
                <div class="mobile-menu__menu">
                    
                    <ul class="nav-menu flx-align nav-menu--mobile">
                        <li class="nav-menu__item has-submenu">
                            <a href="#" class="nav-menu__link">Home</a>
                            <!--<ul class="nav-submenu">-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="index-2.html" class="nav-submenu__link"> Home One</a>-->
                            <!--    </li>-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="index-two.html" class="nav-submenu__link"> Home Two</a>-->
                            <!--    </li>-->
                            <!--</ul>-->
                        </li>
                        <li class="nav-menu__item has-submenu">
                            <a href="<?php echo e(url ('/pages/about-us')); ?>" class="nav-menu__link">About Us</a>
                            <!-- <ul class="nav-submenu">-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="all-product.html" class="nav-submenu__link"> All Products</a>-->
                            <!--    </li>-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="product-details.html" class="nav-submenu__link"> Product Details</a>-->
                            <!--    </li>-->
                            <!--</ul>-->
                        </li>
                        <li class="nav-menu__item has-submenu">
                            <a href="<?php echo e(url ('/documentation')); ?>" class="nav-menu__link">Documentation</a>
                            <!-- <ul class="nav-submenu">-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="profile.html" class="nav-submenu__link"> Profile</a>-->
                            <!--    </li>-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="cart.html" class="nav-submenu__link"> Shopping Cart</a>-->
                            <!--    </li>-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="cart-personal.html" class="nav-submenu__link"> Mailing Address</a>-->
                            <!--    </li>-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="cart-payment.html" class="nav-submenu__link"> Payment Method</a>-->
                            <!--    </li>-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="cart-thank-you.html" class="nav-submenu__link"> Preview Order</a>-->
                            <!--    </li>-->
                            <!--    <li class="nav-submenu__item">-->
                            <!--        <a href="dashboard.html" class="nav-submenu__link"> Dashboard</a>-->
                            <!--    </li>-->
                            <!--</ul>-->
                        </li>
                        <li class="nav-menu__item has-submenu">
                            <a href="<?php echo e(url ('/pages/about-us')); ?>" class="nav-menu__link">Blog</a>
                            <ul class="nav-submenu">
                                <li class="nav-submenu__item">
                                    <a href="<?php echo e(url ('/pages/about-us')); ?>" class="nav-submenu__link"> Blog</a>
                                </li>
                                <li class="nav-submenu__item">
                                    <a href="<?php echo e(url ('/pages/about-us')); ?>" class="nav-submenu__link"> Blog Details</a>
                                </li>
                                <li class="nav-submenu__item">
                                    <a href="blog-details-sidebar.html" class="nav-submenu__link"> Blog Details Sidebar</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-menu__item">
                            <a href="contact.html" class="nav-menu__link">Contact</a>
                        </li>
                    </ul>
                    <div class="header-right__inner d-lg-none my-3 gap-1 d-flex flx-align">
                        
            <a href="register.html" class="btn btn-main pill">
                <span class="icon-left icon"> 
                    <img src="<?php echo e(asset('public/front/laratheme/assets/images/icons/user.svg')); ?>" alt="">
                </span>Create Account  
            </a>
            <div class="language-select flx-align select-has-icon">
                <img src="<?php echo e(asset('public/front/laratheme/assets/images/icons/globe.svg')); ?>" alt="" class="globe-icon white-version">
                <img src="<?php echo e(asset('public/front/laratheme/assets/images/icons/globe-white.svg')); ?>" alt="" class="globe-icon dark-version">
                <select class="select py-0 ps-2 border-0 fw-500">
                    <option value="1">Eng</option>
                    <option value="2">Bn</option>
                    <option value="3">Eur</option>
                    <option value="4">Urd</option>
                </select>
            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==================== Mobile Menu End Here ==================== -->

        <!-- ============================ Sale Offer Start =========================== -->
        <div class="sale-offer sales-offer-bg-two d-none">
            <div class="container container-full ">
                <div class="sale-offer__content flx-between position-relative">
                    <div class="sale-offer__countdown">
            
                        <div class="countdown" data-date="14-10-2026" data-time="12:00">
                            <div class="day"><span class="num"></span><span class="word"></span></div>
                            <div class="hour"><span class="num"></span><span class="word"></span></div>
                            <div class="min"><span class="num"></span><span class="word"></span></div>
                            <div class="sec"><span class="num"></span><span class="word"></span></div>
                        </div>
            
                    </div>
                    <div class="sale-offer__discount flx-align gap-2">
                        <span class="sale-offer__text text-heading text-capitalize">New Year Flash Sale Offer</span>
                        <strong class="sale-offer__qty text-heading font-heading">45% OFF</strong>
                        <a href="#" class="btn btn-sm btn-white pill fw-500">Shop Now</a>
                    </div>
                    <div class="sale-offer__button">
                        <button type="submit" class="sale-offer__close text-heading"><i class="las la-times"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================ Sale Offer End =========================== -->

        <!-- ==================== Header Start Here ==================== -->
        <header class="header">
            <div class="container container-full">
                <nav class="header-inner flx-between">
                    <!-- Logo Start -->
                    <div class="logo">
                        <a href="<?php echo e(url('/')); ?>" class="link white-version">
                            <img src="<?php echo e(asset('public/front/laratheme/assets/images/larapress/larapress.png')); ?>" alt="Logo">
                        </a>
                        <a href="<?php echo e(url('/')); ?>" class="link dark-version">
                            <img src="<?php echo e(asset('public/front/laratheme/assets/images/larapress/larapress.png')); ?>" alt="Logo">
                        </a>
                    </div>
                    <!-- Logo End  -->

                    <!-- Menu Start  -->
                    <div class="header-menu d-lg-block d-none">
                        
                        <ul class="nav-menu flx-align ">
                            <li class="nav-menu__item">
                                <a href="<?php echo e(url('/')); ?>" class="nav-menu__link">Home</a>
                                <!--<ul class="nav-submenu">-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="index-2.html" class="nav-submenu__link"> Home One</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="index-two.html" class="nav-submenu__link"> Home Two</a>-->
                                <!--    </li>-->
                                <!--</ul>-->
                            </li>
                            <li class="nav-menu__item">
                                <a href="<?php echo e(url('/pages/about-us')); ?>" class="nav-menu__link">About Us</a>
                                <!--<ul class="nav-submenu">-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="all-product.html" class="nav-submenu__link"> All Products</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="product-details.html" class="nav-submenu__link"> Product Details</a>-->
                                <!--    </li>-->
                                <!--</ul>-->
                            </li>
                            <li class="nav-menu__item">
                                <a href="<?php echo e(url('/documentation')); ?>" class="nav-menu__link">Documentation</a>
                                <!--<ul class="nav-submenu">-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="profile.html" class="nav-submenu__link"> Profile</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="cart.html" class="nav-submenu__link"> Shopping Cart</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="cart-personal.html" class="nav-submenu__link"> Mailing Address</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="cart-payment.html" class="nav-submenu__link"> Payment Method</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="cart-thank-you.html" class="nav-submenu__link"> Preview Order</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="dashboard.html" class="nav-submenu__link"> Dashboard</a>-->
                                <!--    </li>-->
                                <!--</ul>-->
                            </li>
                            <!-- <li class="nav-menu__item"> -->
                                <!-- <a href="#" class="nav-menu__link">Blog</a> -->
                                <!-- <ul class="nav-submenu">-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="blog.html" class="nav-submenu__link"> Blog</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="blog-details.html" class="nav-submenu__link"> Blog Details</a>-->
                                <!--    </li>-->
                                <!--    <li class="nav-submenu__item">-->
                                <!--        <a href="blog-details-sidebar.html" class="nav-submenu__link"> Blog Details Sidebar</a>-->
                                <!--    </li>-->
                                <!--</ul>-->
                            <!-- </li> -->
                            <li class="nav-menu__item">
                                <a href="<?php echo e(url('/pages/contact-us')); ?>" class="nav-menu__link">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Menu End  -->

                    <!-- Header Right start -->
                    <div class="header-right flx-align">
                        <!-- <a href="cart.html" class="header-right__button cart-btn position-relative">
                            <img src="assets/images/icons/cart.svg" alt="" class="white-version">
                            <img src="assets/images/icons/cart-white.svg" alt="" class="dark-version">
                            <span class="qty-badge font-12">0</span>
                        </a> -->

                        <!-- Light Dark Mode -->
                        <div class="theme-switch-wrapper position-relative">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" class="d-none" id="checkbox">
                                <span class="slider text-black header-right__button white-version">
                                    <img src="<?php echo e(asset('public/front/laratheme/assets/images/icons/sun.svg')); ?>" alt="">
                                </span>
                                <span class="slider text-black header-right__button dark-version">
                                    <img src="<?php echo e(asset('public/front/laratheme/assets/images/icons/moon.svg')); ?>" alt="">
                                </span>
                            </label>
                        </div>
                
                
                        <div class="header-right__inner gap-3 flx-align d-lg-flex d-none">
                            
                            <a href="<?php echo e(url('/pages/request-a-for-download')); ?>" class="btn btn-main pill">
                                <span class="icon-left icon"> 
                                    <!-- <img src="assets/images/icons/user.svg" alt=""> -->
                                </span>Get LaraPress  
                            </a>
                            <!-- <div class="language-select flx-align select-has-icon">
                                <img src="assets/images/icons/globe.svg" alt="" class="globe-icon white-version">
                                <img src="assets/images/icons/globe-white.svg" alt="" class="globe-icon dark-version">
                                <select class="select py-0 ps-2 border-0 fw-500">
                                    <option value="1">Eng</option>
                                    <option value="2">Bn</option>
                                    <option value="3">Eur</option>
                                    <option value="4">Urd</option>
                                </select>
                            </div> -->
                        </div>
                        <button type="button" class="toggle-mobileMenu d-lg-none"> <i class="las la-bars"></i> </button>
                    </div>
                    <!-- Header Right End  -->
                </nav>
            </div>
        </header>
        <!-- ==================== Header End Here ==================== -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- ==================== Footer Two Start Here ==================== -->
        <footer class="footer-two section-bg position-relative z-index-1 overflow-hidden">

            <img src="<?php echo e(asset('public/front/laratheme/assets/images/gradients/footer-gradient-bg.png')); ?>" alt="" class="bg--gradient">
            
            <img src="<?php echo e(asset('public/front/laratheme/assets/images/shapes/footer-pattern1.png')); ?>" alt="" class="position-absolute end-0 top-0 z-index--1">
            <img src="<?php echo e(asset('public/front/laratheme/assets/images/shapes/footer-pattern2.png')); ?>" alt="" class="position-absolute start-0 top-0 z-index--1">
            
            <div class="footer-inner padding-y-120">
                <div class="container container-two">
                    <div class="row gy-5">
                        <div class="col-xl-3 col-sm-6">
                            <div class="footer-widget">
                                <div class="footer-widget__logo">
                                    <a href="index-2.html"> 
                                        <img src="<?php echo e(asset('public/front/laratheme/assets/images/larapress/larapress.png')); ?>" alt="" class="white-version">
                                        <img src="<?php echo e(asset('public/front/laratheme/assets/images/larapress/larapress.png')); ?>" alt="" class="dark-version">
                                    </a>
                                </div>
                                <p class="footer-widget__desc">Join the growing community of satisfied users who trust LaraPress for their content management needs. Experience the difference with a CMS that combines simplicity, power, and flexibility in one seamless package.</p>                    
                                <div class="footer-widget__social">
                                    <ul class="social-icon-list">
                                        <li class="social-icon-list__item">
                                            <a href="https://www.facebook.com/mdshahinurislam2m" class="social-icon-list__link flx-center"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <!-- <li class="social-icon-list__item">
                                            <a href="https://www.twitter.com/" class="social-icon-list__link flx-center"> <i class="fab fa-twitter"></i></a>
                                        </li> -->
                                        <li class="social-icon-list__item">
                                            <a href="https://www.linkedin.com/in/mdshahinurislamm/" class="social-icon-list__link flx-center"> <i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <!-- <li class="social-icon-list__item">
                                            <a href="https://www.pinterest.com/" class="social-icon-list__link flx-center"> <i class="fab fa-pinterest-p"></i></a>
                                        </li> -->
                                        <li class="social-icon-list__item">
                                            <a href="https://www.youtube.com/@devopswithshahin" class="social-icon-list__link flx-center"> <i class="fab fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 col-xs-6">
                            <div class="footer-widget">
                                <h5 class="footer-widget__title">Useful Link</h5>
                                <ul class="footer-lists">
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/pages/about-us')); ?>" class="footer-lists__link">About Us </a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/pages/contact-us')); ?>" class="footer-lists__link">Contact Us</a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/pages/privacy-policy')); ?>" class="footer-lists__link">Privacy Policy </a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/pages/terms-of-service')); ?>" class="footer-lists__link">Terms of Service</a></li> 
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-1 d-xl-block d-none"></div>
                        <div class="col-xl-3 col-sm-6 col-xs-6">
                            <div class="footer-widget">
                                <h5 class="footer-widget__title">Quick Links </h5>
                                <ul class="footer-lists">
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/login')); ?>" class="footer-lists__link">Demo </a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/login')); ?>" class="footer-lists__link">Login </a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/register')); ?>" class="footer-lists__link">Register</a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/documentation')); ?>" class="footer-lists__link">Documentation </a></li> 
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-xs-6">
                            <div class="footer-widget">
                                <h5 class="footer-widget__title">Others</h5>
                                <ul class="footer-lists">
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/pages/frequently-asked-questions-faqs')); ?>" class="footer-lists__link">Frequently Asked Questions (FAQs)</a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/pages/contact-us')); ?>" class="footer-lists__link">Support/Help Center</a></li>
                                    <li class="footer-lists__item"><a href="<?php echo e(url('/')); ?>" class="footer-lists__link">Sitemap</a></li> 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- bottom Footer Two -->
            <div class="bottom-footer-two">
                <div class="container container-two">
                    <div class="bottom-footer__inner flx-between gap-3">
                        <p class="bottom-footer__text font-14"> Copyright &copy; 2024 LaraPress, All rights reserved.</p>
                        <div class="footer-links">
                            <a href="<?php echo e(url('/pages/terms-of-service')); ?>" class="footer-link font-14">Terms of service</a>
                            <a href="<?php echo e(url('/pages/privacy-policy')); ?>" class="footer-link font-14">Privacy Policy</a>
                            <!-- <a href="contact.html" class="footer-link font-14">cookies</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ==================== Footer Two End Here ==================== -->  

        <!-- Jquery js -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/jquery-3.7.1.min.js')); ?>"></script>
        <!-- Bootstrap Bundle Js -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/boostrap.bundle.min.js')); ?>"></script>
        <!-- CountDown -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/countdown.js')); ?>"></script>
        <!-- counter up -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/counterup.min.js')); ?>"></script>
        <!-- Slick js -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/slick.min.js')); ?>"></script>
        <!-- magnific popup -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/jquery.magnific-popup.js')); ?>"></script>
        <!-- apex chart -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/apexchart.js')); ?>"></script>
        <!-- main js -->
        <script src="<?php echo e(asset('public/front/laratheme/assets/js/main.js')); ?>"></script>

    </body>
</html>
<?php /**PATH F:\xamp\htdocs\git-packagist\larapress\packages\larapress\src\Resources\views\front\themes\laratheme\layouts\master.blade.php ENDPATH**/ ?>