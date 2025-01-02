<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@getSetting('site_title')</title>
        <link rel="icon" type="image/x-icon" href="{{ getSetting('fav_icon') == null ? asset('packages/larapress/src/Assets/admin/img/fav.png') : asset('public/uploads/').'/'.getSetting('fav_icon') }}" />
        <link href="{{ asset('packages/larapress/public/front/default/css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous"> 
    </head>
    <body>
        @getHeader()                
        @yield('content')               
        @getFooter()
        <script src="{{ asset('packages/larapress/public/front/default/js/bundle.min.js')}}" crossorigin="anonymous"></script>
    </body>
</html>