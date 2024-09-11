@extends('admin.layouts.master')
@section('content')
<!-- Page Heading -->
<h5 class="h5 mb-2 text-gray-800">Add New Post type <a href="{{ url('/dashboard/posttypes/create') }}" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a></h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Post type</h6>  
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Post type</th> 
                        <th>Slug</th>
						<th>Last Edit</th>
						<th>Edit Date</th>
                        <th>Status</th>
                        <th>Menu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL.</th>
                        <th>Post type</th> 
                        <th>Slug</th>
						<th>Last Edit</th>
						<th>Edit Date</th>
                        <th>Status</th>
                        <th>Menu</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php
                    $sl = 0;
                    @endphp
                    @foreach($posttypes as $posttype)
                    
                    <!-- role mang admin--> 
					@if(optional(auth()->user())->role == 111)
						 
						 <tr>
							<td>{{ ++$sl }}</td>
							<td><a class="badge sizetext" href="{{ url('dashboard/posttypes/'.$posttype->slug) }}">{{ $posttype->name }}</a></td> 
							<td>{{ $posttype->slug }}  
							@foreach($categories as $category)
								@if($category->id == $posttype->category_main_id)
								<a href="{{ url('/posts/'.$posttype->slug.'/'.$category->slug) }}" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
								@endif
							@endforeach
							</td>
							<td>
							   @foreach($users as $user)
							       @if($user->id == $posttype->user_id)
							       {{$user->name}}
							       @endif
							   @endforeach
							</td>
							<td>{{ $posttype->updated_at }}</td>
							<td>{{ $posttype->status == 0 ? 'Unpublish' : 'Publish' }}</td>

							<td> 
								@if($posttype->in_menu_swh == '0')
								<span class="btn badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
								@else
								<span class="btn badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>
								@endif 
							</td> 

							<td><a href="{{ url($posttype->slug) }}" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
							<a href="{{ url('dashboard/posttypes/'.$posttype->slug) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a> 
							<a href="{{ url('dashboard/posttypes/'.$posttype->id.'/edit') }}" class="btn btn-success"><i class="fas fa-edit"></i></a> 
							
							<a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $posttype->id }}"><i class="fas fa-trash"></i></a> 
										
							<!-- Delete Modal-->
							<div class="modal fade" id="logoutModal{{ $posttype->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
								aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
											<button class="close" type="button" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
										<div class="modal-body">To permanently delete your current data and all related posts, please confirm by selecting 'Delete' below.</div>
										<div class="modal-footer">
											<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
											<form action="{{ url('/dashboard/posttypes',$posttype->id) }}" method="POST">
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
						 
					@elseif(optional(auth()->user())->role == 112)					
						<!-- role mang editor--> 
						@php $values = explode(',',optional(auth()->user())->posttypes_id); @endphp
						@foreach($values as $vid) 
							@if($vid)  							
								@if(optional(auth()->user())->role == 111 || $vid == $posttype->id)
									
									<tr>
										<td>{{ ++$sl }}</td>
										<td><a class="badge sizetext" href="{{ url('dashboard/posttypes/'.$posttype->slug) }}">{{ $posttype->name }}</a></td> 
										<td>{{ $posttype->slug }}  
										@foreach($categories as $category)
											@if($category->id == $posttype->category_main_id)
											<a href="{{ url('/posts/'.$posttype->slug.'/'.$category->slug) }}" target="_blank"> <span class="btn badge-success"><i class="fas fa-link"></i></span></a>
											@endif
										@endforeach
										</td>
										<td>
										@foreach($users as $user)
											@if($user->id == $posttype->user_id)
											{{$user->name}}
											@endif
										@endforeach
										</td>
										<td>{{ $posttype->updated_at }}</td>
										<td>{{ $posttype->status == 0 ? 'Unpublish' : 'Publish' }}</td>

										<td> 
											@if($posttype->in_menu_swh == '0')
											<span class="btn badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
											@else
											<span class="btn badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>
											@endif 
										</td> 
										
										<td>
										@if(optional(auth()->user())->role == 111)
										<a href="{{ url('dashboard/posttypes/'.$posttype->slug) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a> 
										<a href="{{ url('dashboard/posttypes/'.$posttype->id.'/edit') }}" class="btn btn-success"><i class="fas fa-edit"></i></a> 
										
										<a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $posttype->id }}"><i class="fas fa-trash"></i></a> 
										@else
										Not Allow
										@endif
													
										<!-- Delete Modal-->
										<div class="modal fade" id="logoutModal{{ $posttype->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
											aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
														<button class="close" type="button" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													<div class="modal-body">To permanently delete your current data and all related posts, please confirm by selecting 'Delete' below</div>
													<div class="modal-footer">
														<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
														<form action="{{ url('/dashboard/posttypes',$posttype->id) }}" method="POST">
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
@endsection
