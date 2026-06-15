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
                    <h1 class="h4 text-gray-900 mb-4">Enter OTP</h1>
                    <p class="text-gray-900 mb-4" id="timer"></p>
                    {{session('2fa_otp')}}
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
                
                <form method="POST" action="/verify-otp" class="user">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="otp" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="emailHelp"
                            placeholder="Enter OTP..." required>
                    </div> 
                    <button type="submit" class="btn btn-primary btn-user btn-block">Verify</button>
                </form>
                <p id="timer"></p>
            </div>
        </div>
    </div>

@php
    $expiresAt = session('2fa_expires_at');
    $remainingSeconds = $expiresAt ? max(0, $expiresAt - now()->timestamp) : 0;
@endphp

    <script>
    let seconds = {{ $remainingSeconds }}; // ✅ pure server-calculated, no Date.now()

    if (seconds <= 0) {
        window.location.href = "/login";
    }

    const timerEl = document.getElementById("timer");

    const countdown = setInterval(() => {
        seconds--;

        if (seconds <= 0) {
            clearInterval(countdown);
            timerEl.innerHTML = "OTP expired";
            window.location.href = "/login";
            return;
        }

        const minutes = Math.floor(seconds / 60);
        const secs = seconds % 60;

        timerEl.innerHTML = `Time left: ${minutes}m ${secs}s`;

    }, 1000);
</script>
@endsection




