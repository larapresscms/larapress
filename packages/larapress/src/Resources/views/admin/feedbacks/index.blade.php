@extends('admin.layouts.master')

@section('content')

@if(optional(auth()->user())->role == 111)
<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="h5 mb-2 text-gray-800">
            @foreach($fbFnames as $fbFname)
                @if($fbFname->fname != '' && $fbFname->fname != null)
                <a href="{{url('/dashboard/feedbacks')}}/{{$fbFname->fname}}" class="text-white"><button class="btn btn-primary btn-user mb-2">{{$fbFname->fname}}</button></a>
                @endif
            @endforeach
            </h5>
            
            @if(session()->has('message'))
            <br/>
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
            @endif

            @if(session()->has('messageDestroy'))<br/>
            <div class="alert alert-danger" role="alert">
                {{session('messageDestroy')}}
            </div>
            @endif
           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example12" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!--<th>Name</th>-->
                                @if(isset($feedbacks) && count($feedbacks))

                                    @foreach($feedbacks as $feedback)
                                
                                        @php
                                            $data = $feedback->decoded_message;
                                        @endphp
                                
                                        @if(isset($data['form_name']) && $data['form_name'] == collect(request()->segments())->last())
                                
                                            @foreach($data as $key => $value)
                                            
                                            @if($key == 'skip_part')
                                                @continue
                                            @endif
                                                
                                            <th>{{ ucfirst(str_replace('-', ' ', $key)) }}</th>
                                                
                                
                                            @endforeach
                                
                                            @break
                                
                                        @endif
                                
                                    @endforeach
                                
                                @endif
                             <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $fb)
                        @if($fb->fname == collect(request()->segments())->last())
                            <tr>
                                <!--<td>{{ $fb->fname }}</td>-->
                                @foreach($fb->decoded_message as $key => $value)
                                
                                @if($key == 'skip_part')
                                    @continue
                                @endif
                                    <td>{{ $value }}</td>
                                @endforeach
                                <td>{{ $fb->created_at }}</td>
                                
                                <td>
                                    <a class="btn btn-danger bbtn">                                            
                                        <form action="{{ url('/dashboard/feedbacks',$fb->id) }}" method="POST">
                                            @csrf     
                                            @method('DELETE')                                                           
                                            <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                        </form>
                                    </a> 
                                </td>
                                
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Feedbacks end-->
@elseif(optional(auth()->user())->role == 112 && optional(auth()->user())->feedbacks == 'feedbacks')
<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="h5 mb-2 text-gray-800">
            @foreach($fbFnames as $fbFname)
                @if($fbFname->fname != '' && $fbFname->fname != null)
                <a href="{{url('/dashboard/feedbacks')}}/{{$fbFname->fname}}" class="text-white"><button class="btn btn-primary btn-user mb-2">{{$fbFname->fname}}</button></a>
                @endif
            @endforeach
            </h5>
            
            @if(session()->has('message'))
            <br/>
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
            @endif

            @if(session()->has('messageDestroy'))<br/>
            <div class="alert alert-danger" role="alert">
                {{session('messageDestroy')}}
            </div>
            @endif
           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example12" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!--<th>Name</th>-->
                                @if(isset($feedbacks) && count($feedbacks))

                                    @foreach($feedbacks as $feedback)
                                
                                        @php
                                            $data = $feedback->decoded_message;
                                        @endphp
                                
                                        @if(isset($data['form_name']) && $data['form_name'] == collect(request()->segments())->last())
                                
                                            @foreach($data as $key => $value)
                                            
                                            @if($key == 'skip_part')
                                                @continue
                                            @endif
                                
                                            <th>{{ ucfirst(str_replace('-', ' ', $key)) }}</th>
                                                
                                
                                            @endforeach
                                
                                            @break
                                
                                        @endif
                                
                                    @endforeach
                                
                                @endif
                             <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $fb)
                        @if($fb->fname == collect(request()->segments())->last())
                            <tr>
                                <!--<td>{{ $fb->fname }}</td>-->
                                @php
                                    $hasDealerPoint = collect($fb->decoded_message)->has('skip_part'); 
                                    
                                    $dealerValue = $fb->decoded_message['skip_part'] ?? null;
                                    $content = $dealerValue ? getContentBySlug($dealerValue) : null;
                                    
                                @endphp
                                
                                @if($content &&  auth()->check() && in_array($content->id, explode(',', auth()->user()->posts_id)))
                                
                                    @foreach($fb->decoded_message as $key => $value)
                                        @if($key == 'skip_part')
                                            @continue
                                        @endif
                                        
                                        <td>{{ $value }}</td>
                                        
                                    @endforeach
                                    <td>{{ $fb->created_at }}</td>
                                    
                                    <td>
                                        <a class="btn btn-danger bbtn">                                            
                                            <form action="{{ url('/dashboard/feedbacks',$fb->id) }}" method="POST">
                                                @csrf     
                                                @method('DELETE')                                                           
                                                <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                            </form>
                                        </a> 
                                    </td>
                                @endif
                                
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Feedbacks end-->
@else
You can't access this page. Please contact admin.
@endif 
@endsection
