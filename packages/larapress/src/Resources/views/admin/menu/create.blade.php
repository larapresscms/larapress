@extends('admin.layouts.master')

@section('content')
@if(optional(auth()->user())->role == 111 || optional(auth()->user())->menus == 'menus')
<!-- DataTales Example --> 
   <!-- Nested Row within Card Body -->
   <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create a Menu!</h1>
            </div>            
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="table-responsive mb-5">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>All Pages</th> 
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>All Pages</th> 
                                </tr>
                            </tfoot>
                            <tbody class="list-group d-contents" style="height: 300px; overflow-y: scroll;">
                                <!--//posts-->
                                @foreach($posts as $post) 
                                    @foreach($categories as $category)
                                        @if($post->category_id == $category->id)
                                            @php $category_name = $category->slug @endphp
                                        @endif
                                    @endforeach   
                                    <tr>
                                        <td><button onclick="changemenu('{{$post->title}}','/{{$post->post_type}}/{{$post->slug}}')" class="list-group-item list-group-item-action">{{$post->title}}</button></td>
                                    </tr>                          
                                @endforeach  

                                <!--//posts type-->
                                @foreach($posttypes as $posttype)                                          
                                    <tr>
                                        <td><button onclick="changemenu('{{$posttype->name}}','/{{$posttype->slug}}')" class="list-group-item list-group-item-action">{{$posttype->name}}</button></td>
                                    </tr>                          
                                @endforeach 
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- form start -->
                    <form class="user" action="{{ url('/dashboard/menu') }}" method="post">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name='title' id="menutitle" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="Menu name" value="">
                                    <input type="hidden" name='user_id' class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="user" value="@auth(){{ optional(auth()->user())->id}}@endauth">
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name='url' class="form-control form-control-user" id="menuurl"
                                    placeholder="URL" value=""> 
                            </div> 
                        </div>
                        <div class="form-group"> 
                            <input type="text" name='position' value="" class="form-control form-select-sm" placeholder="Position"> 
                        </div> 
                        <div class="form-group">
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_id">
                                <option value="0" selected>No Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="sub_menu_id">
                            <option value="0">No Parent</option>
                                @foreach($menus as $menu)
                                    <!-- finding categories  -->
                                    @foreach($categories as $category)
                                        @if($menu->category_id == $category->id)
                                            @php $category_n = $category->name; @endphp
                                        @break
                                        @else 
                                            @php $category_n = ''; @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $menu->id }}">{{$category_n ?? ''}}_{{ $menu->title }}</option>
                                @endforeach
                            </select>
                            </div> 
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="target">
                            <option value="_self">_self</option>
                            <option value="_blank">_blank</option>
                            <option value="_parent">_parent</option>
                            <option value="_top">_top</option>  
                            <option value="external_link">External Link</option>
                            </select>
                            </div> 
                        </div> 

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                            <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="status">
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                            </select>
                            </div> 
                        </div> 
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-user btn-block">Create</button>
                        </div>
                    </form>
                    <!-- form end  -->
                </div>
                <div class="col-md-4">
                    @foreach($menus as $menu)
                        @if($menu->sub_menu_id == 0)
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between @if(session()->has('message'.$menu->id)) alert-{{session('message'.$menu->id)}} @endif">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $menu->title }}</h6>
                                    <div class="dropdown no-arrow"><span class="btn badge badge-primary">{{ $menu->position }}</span>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="{{ url('dashboard/menu/'.$menu->id.'/edit') }}">Edit</a>
                                            @if(optional(auth()->user())->role == 111)
                                            <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal{{ $menu->id }}">Delete</a> 
                                            @endif
                                        </div>
                                    </div>
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
                                </div> 
                            </div>  
                            @foreach($menus as $submenu)
                                @if($menu->id == $submenu->sub_menu_id && $submenu->sub_menu_id != 0)                  
                                    <div class="card shadow ml-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between @if(session()->has('message'.$submenu->id)) alert-{{session('message'.$submenu->id)}} @endif">
                                            <h6 class="m-0 font-weight-bold text-primary">{{ $submenu->title }}</h6>
                                            <div class="dropdown no-arrow"><span class="btn badge badge-primary">{{ $submenu->position }}</span>
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                    <div class="dropdown-header">Action:</div>
                                                    <a class="dropdown-item" href="{{ url('dashboard/menu/'.$submenu->id.'/edit') }}">Edit</a>
                                                    @if(optional(auth()->user())->role == 111)
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal{{ $submenu->id }}">Delete</a> 
                                                    @endif
                                                </div>
                                            </div>
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

                                                            <form action="{{ url('/dashboard/menu',$submenu->id) }}" method="POST">
                                                                @csrf     
                                                                @method('DELETE')                                                           
                                                                <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                            </form>  
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <!-- Delete Modal-->
                                        </div> 
                                    </div>
                                    @foreach($menus as $submenu2)
                                        @if($submenu->id == $submenu2->sub_menu_id && $submenu2->sub_menu_id != 0)
                                        <div class="card shadow ml-5">
                                            <!-- Card Header - Dropdown -->
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between @if(session()->has('message'.$submenu2->id)) alert-{{session('message'.$submenu2->id)}} @endif">
                                                <h6 class="m-0 font-weight-bold text-primary">{{ $submenu2->title }}</h6>
                                                <div class="dropdown no-arrow"><span class="btn badge badge-primary">{{ $submenu2->position }}</span>
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                        <div class="dropdown-header">Action:</div>
                                                        <a class="dropdown-item" href="{{ url('dashboard/menu/'.$submenu2->id.'/edit') }}">Edit</a>
                                                        @if(optional(auth()->user())->role == 111)
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal{{ $submenu2->id }}">Delete</a> 
                                                        @endif
                                                    </div>
                                                </div>
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
                                                                 
                                                                <form action="{{ url('/dashboard/menu',$submenu2->id) }}" method="POST">
                                                                    @csrf     
                                                                    @method('DELETE')                                                           
                                                                    <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                                </form>  
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <!-- Delete Modal-->
                                            </div> 
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach            
                        @endif
                    @endforeach
                </div>
            </div>            
            <hr>
        </div>
    </div>
</div> 
<style>
    .dataTables_filter {
    	/* width: -2%; */
    	float: left;
    	text-align: left;
    	margin-left: -170px;
    }
</style>

<script>
    function changemenu(value, value2){
        document.getElementById("menutitle").value= value; 
        document.getElementById("menuurl").value= value2; 
    }  
    
    // datatable entries off
    $(document).ready(function() {
    $('#dataTable').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": true });
    });
</script>
@else
You can't access this page. Please contact admin.
@endif
@endsection