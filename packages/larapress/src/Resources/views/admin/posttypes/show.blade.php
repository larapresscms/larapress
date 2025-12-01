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
            All {!! Str::limit($posttype->name, 15, ' ...') !!} 
            @endif
        @endforeach
        <a href="{{ url('/dashboard/posttypes/create/') }}/{{ collect(request()->segments())->last() }}" class="text-white"><button class="btn btn-primary btn-user"><i class="fa fa-plus"></i></button></a>
        </h6>                    
    </div>
    <div class="card-body">


        <div class="row">
            <div class="col-6">
                <div class="d-flex gap-2 mb-3 align-items-center">
                
                    <select id="bulkAction" class="form-select w-auto form-control w-25 d-inline">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete</option>
                        <option value="publish">Publish</option>
                        <option value="unpublish">Unpublish</option>
                        <option value="change_type">Change Type</option>
                    </select>
                    <select class="form-select form-control w-auto d-none w-25" name="post_type" id="bulkType">                                
                        <option value disabled selected>Select</option>
                        @foreach($posttypes as $posttype)
                            <option value="{{ $posttype->slug }}">{!! Str::limit($posttype->name, 25, ' ...') !!} </option>
                        @endforeach
                    </select>  
                    
                     <input type="hidden" name="old_type" value="{{ collect(request()->segments())->last() }}" id="old_Type">
                     <input type="hidden" name="user_id" value="@auth(){{ optional(auth()->user())->id}}@endauth" id="user_ID">
                    <!-- <input type="text" id="bulkType" class="form-control w-auto d-none w-25" placeholder="Enter new post type"> -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#logoutModalBulkAction"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>  
                                                   
                    <!-- BulkAction Modal-->
                    <div class="modal fade" id="logoutModalBulkAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Action?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Are you sure you want to apply this action to the selected items? This change may affect their visibility or type and cannot be undone.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>  
                                    <button type="button" id="applyBulkAction" class="btn btn-outline-success" >Yes, Continue</button>                                   
                                </div>
                            </div>
                        </div>
                    </div>  
                    <!-- BulkAction Modal-->
                </div>
            </div>
            <div class="col-3"></div>

            <div class="col-3">
                <form method="GET" action="{{ url('/dashboard/posttypes/search',collect(request()->segments())->last()) }}" class="mb-3 text-right input-group">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search {{ collect(request()->segments())->last() }}..." class="form-control w-25 d-inline">
                    <input type="hidden" name="post_type" value="{{collect(request()->segments())->last()}}">    
                    <div class="input-group-prepend"> 
                        <button class="btn btn-outline-success my-2 my-sm-0 input-group-text" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>  


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="selectAll"></th>
                        <th>SL/ID</th>
                        <th>Title</th> 
                        <th>Slug</th> 
                        <th>Cate</th>
                        <th>Post Type</th>
                        <th>Position</th>
                        <th>Last Edit</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><input type="checkbox" class="selectAll"></th>
                        <th>SL/ID</th>
                        <th>Title</th> 
                        <th>Slug</th> 
                        <th>Cate</th>
                        <th>Post Type</th>
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
                    @forelse($posts as $post)

                    <!-- role mang admin--> 
                    @if(optional(auth()->user())->role == 111)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $post->id }}" class="checkbox-item"></td>
                        <td>SL: {{ ++$sl }}<br>ID: {{ $post->id }}</td>
                        <td>
                        @auth()
                        @if(optional(auth()->user())->id == $post->user_id || optional(auth()->user())->role == "111" || optional(auth()->user())->role == "112")
                            <a href="{{ url('dashboard/posts/posttype/'.$post->id.'/edit/'.collect(request()->segments())->last()) }}">{!! Str::limit($post->title, 15, ' ...') !!}</a>
                        @else
                        {!! Str::limit($post->title, 15, ' ...') !!}
                        @endif
                        @endauth  
                        </td> 
                        <td >{{ $post->slug }}</td>
                        <td>
                            @foreach($categories as $categorie)
                                @if($post->category_id == $categorie->id)
                                    {{$categorie->name}}
                                @endif
                            @endforeach  
                        </td> 
                        <td>                            
                            <form class="user" action="{{ url('/dashboard/posts/posttype',$post->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method('PATCH')

                                @foreach($posttypes as $posttype)
                                @if( $posttype->slug ==  collect(request()->segments())->last() )
                                    <span class="w-25">{!! Str::limit($posttype->name, 15, ' ...') !!}</span>
                                @endif
                                @endforeach
                                <a href="{{url($post->post_type)}}" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
                                <i class="fas fa-arrow-right"></i>

                                <input type="hidden" name='user_id' value="@auth(){{ optional(auth()->user())->id}}@endauth">
                                <select class="form-select w-25" name="post_type">                                
                                    <option value disabled selected>Select</option>
                                    @foreach($posttypes as $posttype)
                                        <option value="{{ $posttype->slug }}">{{ $posttype->name }}</option>
                                    @endforeach
                                </select>  
                                 <button type="submit" class="btn badge-success">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </form>                        

                        </td> 
                        
                        <td>{{ $post->position }}</td>
                        <td>
                           @foreach($users as $user)
                               @if($user->id == $post->user_id)
                               {{$user->name}}
                               @endif
                           @endforeach
                           <br>{{ \Carbon\Carbon::parse($post->updated_at)->timezone(session('user_timezone', 'UTC'))->format('h:ia. d M, Y') }}
                        </td> 

                        <td>{{ $post->status == 0 ? 'Unpublish' : 'Publish' }}</td> 
                        <td style="width: 12%;"><a href="{{url($post->post_type, $post->slug)}}" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
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
                    
                    @empty
                        <tr>
                            <td colspan="5">No {{collect(request()->segments())->last()}} found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {!! $posts->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
<script>
    // Select all checkboxes
   let selectAllBoxes = document.getElementsByClassName('selectAll');
    Array.from(selectAllBoxes).forEach(selectAll => {
        selectAll.addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.checkbox-item');
            checkboxes.forEach(ch => ch.checked = this.checked);
        });
    });
</script>

<form id="bulkForm" method="POST" action="{{ route('posts.bulkAction') }}" style="display: none;">
    @csrf
    <input type="hidden" name="action" id="hiddenAction">
    <input type="hidden" name="new_type" id="hiddenNewType">
    <input type="hidden" name="old_type" value="2" id="hiddenOldType">
    <input type="hidden" name="user_id" value="1" id="hiddenUserID">
    <div id="hiddenIdsContainer"></div>
</form>
<script>

document.getElementById('bulkAction').addEventListener('change', function() {
    const input = document.getElementById('bulkType');
    if (this.value === 'change_type') {
        input.classList.remove('d-none');
        input.required = true;
    } else {
        input.classList.add('d-none');
        input.required = false;
    }
});

document.getElementById('applyBulkAction').addEventListener('click', function() {
    const selectedIds = Array.from(document.querySelectorAll('.checkbox-item:checked')).map(ch => ch.value);
    const action = document.getElementById('bulkAction').value;
    const newType = document.getElementById('bulkType').value;
    const oldType = document.getElementById('old_Type').value;
    const userID = document.getElementById('user_ID').value;

    if (!action) {
        alert('Please select an action.');
        return;
    }
    if (selectedIds.length === 0) {
        alert('Please select at least one post.');
        return;
    }

    // Build hidden form data
    const form = document.getElementById('bulkForm');
    document.getElementById('hiddenAction').value = action;
    document.getElementById('hiddenNewType').value = newType;
    document.getElementById('hiddenOldType').value = oldType;
    document.getElementById('hiddenUserID').value = userID;

    const container = document.getElementById('hiddenIdsContainer');
    container.innerHTML = ''; // clear
    selectedIds.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        container.appendChild(input);
    });

    // Submit the hidden form
    form.submit();
});
</script>



@else
You can't access this page. Please contact admin.
@endif
@endsection