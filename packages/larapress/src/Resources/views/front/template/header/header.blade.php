<?php
/* Template Name: Header
    Version: 1.0
*/
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ getSetting('site_logo') == null ? asset('packages/larapress/src/Assets/admin/img/larapress.png') : asset('public/uploads/').'/'.getSetting('site_logo') }}" alt="@getSetting('site_title')" width="150px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @foreach(getMenus() as $menu)
                @if($menu->sub_menu_id == 0) 
                    <li class="nav-item">  
                        <!-- finddin dropdown for arraw  -->
                        <a href="{{ $menu->target == 'external_link' ? $menu->url : url('/') . $menu->url }}" target="{{$menu->target}}" class="nav-link">{{$menu->title}}</a>    
                    </li>
                @endif
                @endforeach                 
                @auth()
                <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard')}}">
                    Profile ({{ optional(auth()->user())->name}})
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/logout')}}">Logout</a></li>
                @endauth

                @guest()
                <li class="nav-item"><a class="nav-link" href="{{ url('/login')}}">login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/register')}}">Register</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>