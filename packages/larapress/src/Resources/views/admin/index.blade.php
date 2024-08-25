@extends('admin.layouts.master')

@section('content')
@if(session()->has('messageDestroy'))
    <div class="alert alert-danger" role="alert">
        {{session('messageDestroy')}}
    </div> 
    @endif
<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
    <div class="me-4 mb-3 mb-sm-0">
        <h4 class="mb-0">Hi <span class="text-info">@auth() {{ optional(auth()->user())->name}}, @endauth</span> Welcome back.</h4>
        <div class="small">
            <span>{{date('l jS \of F Y g:i a')}}</span> 
        </div>
    </div>
</div>

<!-- <div class="row mb-4">
    <div class="col-xl-12 col-lg-12">
    <a class="weatherwidget-io" href="https://forecast7.com/en/23d6890d36/bangladesh/" data-label_1="BANGLADESH" data-label_2="WEATHER" data-theme="original" >BANGLADESH WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
    </div>
</div> -->

<!-- Content Row -->
<div class="row">
@if(optional(auth()->user())->role == 111) 
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            All Page</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $posts->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-thumbtack fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Media</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $media->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-copy fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                            </div>
                            <!--<div class="col">-->
                            <!--    <div class="progress progress-sm mr-2">-->
                            <!--        <div class="progress-bar bg-info" role="progressbar"-->
                            <!--            style="width: 0%" aria-valuenow="50" aria-valuemin="0"-->
                            <!--            aria-valuemax="100"></div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
    <!-- dynamic posts type  -->
    @foreach($posttypes_inDash as $posttype)
        @if($posttype->in_menu_swh == '1')

        
        @if(optional(auth()->user())->role == 111) 

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-color shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-posttype-color text-uppercase mb-1">{{ $posttype->name }}</div>
                            @php $cont = 0; @endphp
                            @foreach($posts as $post)
                                @if($post->post_type == $posttype->slug)                                    
                                    @php $cont += 1 @endphp                                     
                                @endif
                            @endforeach
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cont}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="{{ $posttype->menu_icon != 0 ? $posttype->menu_icon : 'fas fa-thumbtack' }} fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @elseif(optional(auth()->user())->role == 112)
            <!-- role mang --> 
            @php $values = explode(',',optional(auth()->user())->posttypes_id); @endphp
            @foreach($values as $vid) 
                @if($vid)  
                
                    @if(optional(auth()->user())->role == 111 || $vid == $posttype->id)

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-color shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-posttype-color text-uppercase mb-1">{{ $posttype->name }}</div>
                                        @php $cont = 0; @endphp
                                        @foreach($posts as $post)
                                            @if($post->post_type == $posttype->slug)                                    
                                                @php $cont += 1 @endphp                                     
                                            @endif
                                        @endforeach
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cont}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="{{ $posttype->menu_icon != 0 ? $posttype->menu_icon : 'fas fa-thumbtack' }} fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
                                
                @endif
            @endforeach 

        @endif	


        
        @endif
    @endforeach
    <!-- End dynamic posts type  --> 

</div>

<!-- <form class="navbar-form navbar-left" method="GET" action="{{url('dashboard/search')}}">
{{ csrf_token() }}
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
            <button class="btn btn-default" type="submit">
              <i class="fa fa-search"></i>
            </button>
        </div>
      </form> -->


@endsection