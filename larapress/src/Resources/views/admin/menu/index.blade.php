@extends('admin.layouts.master')

@section('content')
@if(optional(auth()->user())->role == 111 || optional(auth()->user())->menus == 'menus')
       <!-- Page Heading -->
       <h5 class="h5 mb-2 text-gray-800">Add New Menu <a href="{{ url('/dashboard/menu/create') }}" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a></h5>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Menus</h6> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th>  
                                            <th>Menu Name</th> 
                                            <th>Last Edit</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th>  
                                            <th>Menu Name</th> 
                                            <th>Last Edit</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                        $sl = 0;
                                        @endphp
                                        @foreach($menus as $menu)
                                            @if($menu->sub_menu_id == 0)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>
                                                @foreach($categories as $categorie)
                                                    @if($menu->category_id == $categorie->id)
                                                        {{$categorie->name}}
                                                    @endif
                                                @endforeach  
                                                </td>
                                                <td>{{ $menu->title }}</td>  

                                                <td>
                                                   @foreach($users as $user)
                                                       @if($user->id == $menu->user_id)
                                                       {{$user->name}}
                                                       @endif
                                                   @endforeach
                                                   at {{ $menu->updated_at }}
                                                </td> 

                                                <td>{{ $menu->status == 0 ? 'Unpublish' : 'Publish' }}</td>

                                                <td><a href="{{ url('dashboard/menu/'.$menu->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                                <a href="{{ url('dashboard/menu/'.$menu->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                                @if(optional(auth()->user())->role == 111)
                                                <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $menu->id }}"><i class="fas fa-trash"></i></a> 
                                                @endif
                                        
                                                <!-- Delete Modal-->
                                                <div class="modal fade" id="logoutModal{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Select "Delete - {{ $menu->title }}" below if you are ready to Permanently delete your current data.</div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <form action="{{ url('/dashboard/menu',$menu->id) }}" method="POST">
                                                                    @csrf     
                                                                    @method('DELETE')                                                           
                                                                    <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <!-- Delete Modal-->
                                                
                                                </td>
                                            </tr>
                                        
                                            <!-- //find sub menu -->
                                            @foreach($menus as $submenu)
                                                @if($menu->id == $submenu->sub_menu_id && $submenu->sub_menu_id != 0)
                                                <tr>
                                                    <td>{{ ++$sl }}</td>
                                                    <td>
                                                    @foreach($categories as $categorie)
                                                        @if($submenu->category_id == $categorie->id)
                                                            {{$categorie->name}}
                                                        @endif
                                                    @endforeach  
                                                    </td>
                                                    <td> _{{ $submenu->title }}</td>  

                                                    <td>
                                                    @foreach($users as $user)
                                                        @if($user->id == $submenu->user_id)
                                                        {{$user->name}}
                                                        @endif
                                                    @endforeach
                                                    at {{ $submenu->updated_at }}
                                                    </td> 

                                                    <td>{{ $submenu->status == 0 ? 'Unpublish' : 'Publish' }}</td>

                                                    <td><a href="{{ url('dashboard/menu/'.$submenu->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                                    <a href="{{ url('dashboard/menu/'.$submenu->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                                    @if(optional(auth()->user())->role == 111)
                                                    <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $submenu->id }}"><i class="fas fa-trash"></i></a> 
                                                    @endif
                                                    <!-- Delete Modal-->
                                                    <div class="modal fade" id="logoutModal{{ $submenu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Select "Delete - {{ $submenu->title }}" below if you are ready to Permanently delete your current data.</div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                    <a  class="btn btn-danger bbtn">
                                                                    {!! Form::open(['url' => 'dashboard/menu/'.$submenu->id, 'method'=>'delete']) !!}
                                                                    {!! Form::submit('Delete') !!}
                                                                    {!! Form::close() !!}
                                                                    </a>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <!-- Delete Modal-->
                                                    
                                                    </td>
                                                </tr>

                                                    <!-- //find sub menu -->
                                                    @foreach($menus as $submenu2)
                                                        @if($submenu->id == $submenu2->sub_menu_id && $submenu2->sub_menu_id != 0)
                                                        <tr>
                                                            <td>{{ ++$sl }}</td>
                                                            <td>
                                                            @foreach($categories as $categorie)
                                                                @if($submenu2->category_id == $categorie->id)
                                                                    {{$categorie->name}}
                                                                @endif
                                                            @endforeach  
                                                            </td>
                                                            <td>  __{{ $submenu2->title }}</td>  

                                                            <td>
                                                            @foreach($users as $user)
                                                                @if($user->id == $submenu2->user_id)
                                                                {{$user->name}}
                                                                @endif
                                                            @endforeach
                                                            at {{ $submenu2->updated_at }}
                                                            </td> 

                                                            <td>{{ $submenu2->status == 0 ? 'Unpublish' : 'Publish' }}</td>

                                                            <td><a href="{{ url('dashboard/menu/'.$submenu2->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                                            <a href="{{ url('dashboard/menu/'.$submenu2->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                                            @if(optional(auth()->user())->role == 111)
                                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $submenu2->id }}"><i class="fas fa-trash"></i></a> 
                                                            @endif
                                                            <!-- Delete Modal-->
                                                            <div class="modal fade" id="logoutModal{{ $submenu2->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">Select "Delete - {{ $submenu2->title }}" below if you are ready to Permanently delete your current data.</div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                            <a  class="btn btn-danger bbtn">
                                                                            {!! Form::open(['url' => 'dashboard/menu/'.$submenu2->id, 'method'=>'delete']) !!}
                                                                            {!! Form::submit('Delete') !!}
                                                                            {!! Form::close() !!}
                                                                            </a>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            <!-- Delete Modal-->
                                                            
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endforeach



                                                @endif
                                            @endforeach

                                        
                                            @endif
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