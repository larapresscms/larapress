@extends('admin.layouts.master')

@section('content')
@if(optional(auth()->user())->role == 111 || optional(auth()->user())->categories == 'categories')
       <!-- Page Heading -->
       <h5 class="h5 mb-2 text-gray-800">Add New Category <button class="btn btn-primary btn-user"><a href="{{ url('/dashboard/categories/create') }}" class="text-white">Add New</a></button></h5>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th> 
                                            <th>Slug</th>                                            
                                            <th>Posts</th>                                          
                                            <th>Menu</th>                                          
                                            <th>Posttype</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Categories</th> 
                                            <th>Slug</th>                                     
                                            <th>Posts</th>                                          
                                            <th>Menu</th>                                          
                                            <th>Posttype</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                        $sl = 0;
                                        @endphp
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ ++$sl }}</td>
                                            <td>{{ $category->name }}</td> 
                                            <td>{{ $category->slug }}</td>

                                            <td>
                                            <!-- how many post involved in this cat -->
                                            @php $countP = 0; @endphp
                                            @foreach($posts as $post)
                                                @php $values = explode(',',$post->category_id); @endphp                                                
                                                @foreach($values as $vid) 
                                                    @if($vid == $category->id)                               
                                                    @php ++$countP  @endphp           
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            {{ $countP }}
                                            <!-- how many post involved in this cat -->
                                            </td>
                                            <td>
                                            <!-- how many menus involved in this cat -->
                                            @php $countM = 0; @endphp
                                            @foreach($menus as $menu)
                                                @php $values = explode(',',$menu->category_id); @endphp                                                
                                                @foreach($values as $vid) 
                                                    @if($vid == $category->id)                               
                                                    @php ++$countM  @endphp           
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            {{ $countM }}
                                            <!-- how many menus involved in this cat -->
                                            </td> 
                                            <td>
                                            <!-- how many posttype involved in this cat -->
                                            @php $countT = 0; @endphp
                                            @foreach($posttypes as $posttype)
                                                @php $values = explode(',',$posttype->category_main_id); @endphp                                                
                                                @foreach($values as $vid) 
                                                    @if($vid == $category->id)                               
                                                    @php ++$countT  @endphp           
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            {{ $countT }}
                                            <!-- how many post posttype in this cat -->
                                            </td>  

                                            <td>{{ $category->status == 0 ? 'Unpublish' : 'Publish' }}</td>

                                            <td><a href="{{ url('dashboard/categories/'.$category->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                            <a href="{{ url('dashboard/categories/'.$category->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                            
                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $category->id }}"><i class="fas fa-trash"></i></a> 
                                    
                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="logoutModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                            <form action="{{ url('/dashboard/categories',$category->id) }}" method="POST">
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