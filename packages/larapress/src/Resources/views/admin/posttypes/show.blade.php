@extends('admin.layouts.master')
@section('content')
<!-- //current post type id -->
@foreach($posttypes as $posttype)
    @if( $posttype->slug ==  collect(request()->segments())->last() )
        @php $currnt_posttypeID = $posttype->id; @endphp 
        @break
    @endif
@endforeach
@php $currnt_posttypeID = $posttype->id ?? ''; @endphp

<!-- role mang editor--> 		
@php $values = explode(',',optional(auth()->user())->posttypes_id); @endphp
@foreach($values as $vid) 
    @if($vid)  							
        @if(optional(auth()->user())->role == 111 || $vid == $currnt_posttypeID)
            @php $result = $vid; @endphp
            @break
        @endif											   
    @endif
@endforeach 
@php $result = $vid ?? ''; @endphp
<!-- role mang editor--> 

@if(optional(auth()->user())->role == 111 || $result == $currnt_posttypeID)


<!-- Page Heading -->
<h5 class="h5 mb-2 text-gray-800"><a href="{{ url('/dashboard/posttypes/') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>    
    @foreach($posttypes as $posttype)
        @if( $posttype->slug ==  collect(request()->segments())->last() )
            {{ $posttype->name }}
        @endif
    @endforeach
</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-uppercase">     
        @foreach($posttypes as $posttype)
            @if( $posttype->slug ==  collect(request()->segments())->last() )
            All {{ $posttype->name }}
            @endif
        @endforeach
        <a href="{{ url('/dashboard/posttypes/create/') }}/{{ collect(request()->segments())->last() }}" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a>
        </h6>                    
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Title</th> 
                        <th>Slug</th> 
                        <th>Cate</th>
                        <th>P-Type</th>
                        <th>Position</th>
                        <th>Last Edit</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL.</th>
                        <th>Title</th> 
                        <th>Slug</th> 
                        <th>Cate</th>
                        <th>P-Type</th>
                        <th>Position</th>
                        <th>Last Edit</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php
                    $sl = 0;
                    @endphp
                    @foreach($posts as $post)

                    <!-- role mang admin--> 
                    @if(optional(auth()->user())->role == 111)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>
                        @auth()
                        @if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112")
                            <a href="{{ url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last()) }}">{!! Str::limit($post->title, 15, ' ...') !!}</a>
                        @else
                        {!! Str::limit($post->title, 15, ' ...') !!}
                        @endif
                        @endauth  
                        </td> 
                        <td>{{ $post->slug }}</td>
                        <td>
                            @foreach($categories as $categorie)
                                @if($post->category_id == $categorie->id)
                                    {{$categorie->name}}
                                @endif
                            @endforeach  
                        </td> 
                        <td>@foreach($posttypes as $posttype)
                            @if( $posttype->slug ==  collect(request()->segments())->last() )
                                {{ $posttype->name }}
                            @endif
                            @endforeach
                            <a href="{{url($post->post_type)}}" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
                        </td> 
                        
                        <td>{{ $post->position }}</td>
                        <td>
                           @foreach($users as $user)
                               @if($user->id == $post->user_id)
                               {{$user->name}}
                               @endif
                           @endforeach
                           at {{ $post->updated_at }}
                        </td> 

                        <td>{{ $post->status == 0 ? 'Unpublish' : 'Publish' }}</td> 
                        <td><a href="{{url($post->post_type, $post->slug)}}" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
                        <!-- <a href="{{ url('dashboard/posts/'.$post->id) }}" class="btn btn-success">Show</a> -->
                        @auth()
                            @if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112")
                                <!-- check user won post action -->
                                <a href="{{ url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last()) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                
                                <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $post->id }}"><i class="fas fa-trash"></i></a> 
                                    
                                <!-- Delete Modal-->
                                <div class="modal fade" id="logoutModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Select "Delete" below if you are ready to Permanently delete your current data.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>  
                                                <form action="{{ url('/dashboard/posts/posttype',$post->id) }}" method="POST">
                                                    @csrf     
                                                    @method('DELETE')         
                                                    <input class="d-none" name="post_type" type="text" value="{{$post->post_type}}">                                                 
                                                    <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                </form>                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!-- Delete Modal-->
                                
                            @endif
                        @endauth                        

                        </td>                                            
                    </tr>
                    @elseif(optional(auth()->user())->role == 112)					
                    <!-- role mang editor--> 
                        @php $values = explode(',',optional(auth()->user())->posts_id); @endphp
                        @foreach($values as $vid) 
                            @if($vid)  							
                                @if(optional(auth()->user())->role == 111 || $vid == $post->id)
                                <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td>
                                    @auth()
                                    @if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112")
                                        <a href="{{ url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last()) }}">{!! Str::limit($post->title, 15, ' ...') !!}</a>
                                    @else
                                    {!! Str::limit($post->title, 15, ' ...') !!}
                                    @endif
                                    @endauth  
                                    </td> 
                                    <td>
                                        @foreach($categories as $categorie)
                                            @if($post->category_id == $categorie->id)
                                                {{$categorie->name}}
                                            @endif
                                        @endforeach  
                                    </td> 
                                    <td>@foreach($posttypes as $posttype)
                                        @if( $posttype->slug ==  collect(request()->segments())->last() )
                                            {{ $posttype->name }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $post->more_option_1 }}</td>
                                    <td>
                                    @foreach($users as $user)
                                        @if($user->id == $post->user_id)
                                        {{$user->name}}
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td>{{ $post->status == 0 ? 'Unpublish' : 'Publish' }}</td> 
                                    <td>
                                    <!-- <a href="{{ url('dashboard/posts/'.$post->id) }}" class="btn btn-success">Show</a> -->
                                    @auth()
                                        @if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112")
                                            <!-- check user won post action -->
                                            <a href="{{ url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last()) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                            
                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $post->id }}"><i class="fas fa-trash"></i></a> 
                                                
                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="logoutModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Select "Delete" below if you are ready to Permanently delete your current data.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>                                                           

                                                            <form action="{{ url('/dashboard/posts/posttype',$post->id) }}" method="POST">
                                                                @csrf     
                                                                @method('DELETE')         
                                                                <input class="d-none" name="post_type" type="text" value="{{$post->post_type}}">                                                 
                                                                <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                            </form>  
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <!-- Delete Modal-->
                                            
                                        @endif
                                    @endauth                        

                                    </td>                                            
                                </tr>

                                @endif											   
                            @endif
                        @endforeach 				
                    @endif	
                    <!-- role mang editor--> 
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
You can't access this page. Please contact admin.
@endif
@endsection