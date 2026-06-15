@extends('admin.layouts.master')
@section('content')

@if(optional(auth()->user())->role == 111)
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">General Settings</h1>
<div class="card shadow-sm mb-4">
    <div class="card-body">

        @php $settingN = 0; @endphp
        @foreach($settings as $setting)
        <div class="row g-4 align-items-start">
            <!-- Left: Info -->
            <div class="col-lg-6">
                <div class="h-100">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Website Information</h5>
                        <div class="mb-2">
                            <strong>Site Title:</strong>
                            <span class="text-muted">{{ $setting->site_title }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Theme Name:</strong>
                            <span class="badge">{{ $setting->theme_url }}</span>
                        </div>

                        <div class="mb-2">
                            <strong>Home Page:</strong>
                            <span class="badge">{{ $setting->home_url == 0 ? "Default":$setting->home_url }}</span>
                        </div>

                        <div class="mb-2">
                            <strong>Theme Editor:</strong>
                            <span class="badge">
                                {{ $setting->editor == "classic" ? 'Classic' : 'Visual' }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right: Colors + Logo -->
            <div class="col-lg-6">
                <div class="h-100">
                    <div class="card-body">

                        <h6 class="fw-bold mb-3">Appearance</h6>

                        <!-- Dashboard Color -->
                        <div class="mb-3">
                            <div class="small text-muted mb-1">Dashboard Color: {{ $setting->dashboard_color }}</div>
                        </div>

                        <!-- Text Color -->
                        <div class="mb-3">
                            <div class="small text-muted mb-1">Text Color: {{ $setting->text_color }}
                            </div>
                        </div>
                        <!-- Hover Color -->
                        <div class="mb-3">
                            <div class="small text-muted mb-1">Text Hover: {{ $setting->text_hover }}
                            </div>
                        </div>
                        <!-- Logo -->
                        <div class="mt-4">
                            <img
                                src="{{ $settingsAdmin->site_logo
                                    ? url('/public/uploads/'.$settingsAdmin->site_logo)
                                    : asset('packages/larapress/src/Assets/admin/img/larapress.png') }}"
                                class="img-fluid rounded shadow-sm"
                                style="max-width: 120px;">
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Actions -->
        <div class="mt-4 text-end">
            <a href="{{ url('dashboard/settings/'.$setting->id.'/edit') }}"
               class="btn btn-primary px-4">
                <i class="fas fa-edit me-1"></i> Edit Settings
            </a>
        </div>

        @php $settingN = 1; @endphp
        @endforeach

        @if($settingN == 0)
            <div class="text-center">
                <a href="{{ url('/dashboard/settings/create') }}"
                   class="btn btn-success px-5">
                    <i class="fas fa-plus me-1"></i> Add New Settings
                </a>
            </div>
        @endif

    </div>
</div>

@else
You can't access this page. Please contact admin.
@endif
@endsection