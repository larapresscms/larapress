@extends('admin.user.front.master')

@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row justify-content-md-center">
        
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 mb-4">Create an Account!</h1>
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

                <form action="{{ url('/register') }}" method="post" class="user">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="First Name" value="{{ old('name') }}">
                     </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                            placeholder="Email Address" value="{{ old('email') }}">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user"
                                id="exampleInputPassword" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                id="exampleRepeatPassword" placeholder="Repeat Password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block"> Register Account</button>
                </form>
                <hr>
                <div class="text-center">
                    <!--<a class="small" href="forgot-password.html">Forgot Password?</a>-->
                </div>
                <div class="text-center">
                    <a class="small text-decoration-none" href="{{ url('/login') }}">Already have an account? Login!</a>
                </div>
            </div>
        </div>
    </div>
@endsection