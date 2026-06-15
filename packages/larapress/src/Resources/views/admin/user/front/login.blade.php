@extends('admin.user.front.master')
@section('content')
   <!-- Nested Row within Card Body -->
   <div class="row justify-content-md-center">         
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">  
                    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-4" href="{{ url('/') }}">
                        <div class="sidebar-brand-icon rotate-n-15">
                        </div>
                        <div class="sidebar-brand-text mx-3">
                            <div>
                                <img src="{{ $settingsAdmin->site_logo ? url('public/uploads/'.$settingsAdmin->site_logo) : asset('packages/larapress/src/Assets/admin/img/larapress.png') }}" class="img-fluid" width="100%" alt="Logo">
                             </div>
                        </div>
                    </a> 
                    <!--<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>-->
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                 
                @if(session()->has('message'))
                    <div class="alert alert-{{ session('type') }}">
                    {!! session('message') !!}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="post" class="user">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="emailHelp" value="{{ old('email') }}"
                            placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group input-group">
                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password" id="password">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-light border" onclick="togglePassword()" id="toggleBtn" style="border-radius: 0rem 10rem 10rem 0rem;"><i class="fa fa-eye-slash"></i></button>
                        </div>
                        <script>
                            function togglePassword() {
                            
                                let password = document.getElementById("password");
                                let toggleBtn = document.getElementById("toggleBtn");
                            
                                if (password.type === "password") {
                                    password.type = "text";
                                    toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
                                } else {
                                    password.type = "password";
                                    toggleBtn.innerHTML = '<i class="fa fa-eye-slash"></i>';
                                }
                            }
                        </script>
                            
                    </div>
                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Remember
                                Me</label>
                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                </form>
                <hr>
                <div class="text-center">
                    <!--<a class="small" href="forgot-password.html">Forgot Password?</a>-->
                </div>
                <div class="text-center">
                    <a class="small text-decoration-none" href="{{ url('/register') }}">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>
@endsection