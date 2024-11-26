@extends('admin.layouts.master')
@section('content')

@if(optional(auth()->user())->role == 111)
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">General</h1>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"> 

        @php $settingN = 0; @endphp
            @foreach($settings as $setting)
            <div class="form-group row">
                <div class="col-12">
                    <div class="p-2">Site Title: {{ $setting->site_title}}</div>
                    <div class="p-2" style="background-color: {{ $setting->dashboard_color}}; color: {{ $setting->text_color}}">Dashboard Color</div>
                    <div class="p-2" style="color: {{ $setting->text_color}}">Text Color</div>
                    <div class="p-2" style="color: {{ $setting->text_hover}}">Text Hover Color</div>
                    <div class="p-2 bg-primary text-white">Theme Name: {{ $setting->theme_url}}</div> 
                    <div class="p-2 bg-primary text-white">Set Home Page: {{ $setting->home_url}}</div> 
                    <div class="p-2">Theme Editor: {{ $setting->editor == "classic" ? 'Classic' : 'Visual'}}</div> 
                    <img class="p-2" src="{{ $settingsAdmin->site_logo ? url('/public/uploads/'.$settingsAdmin->site_logo) : asset('packages/larapress/src/Assets/admin/img/larapress.png') }}" width="100px"/>
                </div>              
            </div>  
            <div class="form-group">
                <a href="{{ url('dashboard/settings/'.$setting->id.'/edit') }}" class="btn btn-primary">Edit</a>
            </div>
            @php $settingN = 1; @endphp
            @endforeach
            
        
            @if($settingN == 0)
            <a class="collapse-item btn btn-primary" href="{{ url('/dashboard/settings/create') }}">Add New</a>
            @endif  
        </div>
    </div>
@else
You can't access this page. Please contact admin.
@endif
@endsection