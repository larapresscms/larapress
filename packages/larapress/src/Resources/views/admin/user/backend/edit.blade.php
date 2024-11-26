@extends('admin.layouts.master')

@section('content')
  <!-- Nested Row within Card Body -->
  <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit an Account!</h1>
                </div>               
                

                <form action="{{ url('/dashboard/user/') }}/{{ $user->id }}" method="post" class="user">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                                placeholder="First Name" value='{{ $user->name }}'>
                     </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                            placeholder="Email Address" value="{{ $user->email }}">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user"
                                id="exampleInputPassword" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                id="exampleRepeatPassword" placeholder="Repeat Password">
                        </div>
                    </div>
                    @auth() 
                    @if(optional(auth()->user())->role == 111)
                    <div class="form-group">
                        <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="role" onchange="changeFunc(value);">
                            <option value="111" {{ $user->role == 111 ? 'selected':'' }}>Administrator</option>
                            <option value="112" {{ $user->role == 112 ? 'selected':'' }}>Editor</option>	

                            <!-- <option value="2" {{ $user->role == 2 ? 'selected':'' }}>Author</option>
                            <option value="3" {{ $user->role == 3 ? 'selected':'' }}>Subscriber</option> -->

                        </select>
                    </div>

                    <!-- // for editor role  -->
                    <div class="{{ $user->role == 112 ? 'd-block':'d-none' }}" id="permission_id"> 
						<div class="row mb-2">
							<aside class="col-sm-4">
								<p>Post Permission</p>
								<div class="card">
									<article class="card-group-item">
										<header class="card-header">
											<h6 class="title">Post Type</h6>
										</header>
										<div class="filter-content">
											<div class="card-body">
												@foreach($posttypes as $posttype)
												
												<div class="custom-control custom-checkbox mb-1">
													<span class="float-right badge badge-light round"></span>
													<input class="custom-control-input" name="posttypes_id[]" type="checkbox" value="{{$posttype->id}}" id="Check{{$posttype->id}}"										
													@php $ptvalues = explode(',',$user->posttypes_id); @endphp
													@foreach($ptvalues as $vid) 
														@if($vid)                                                
															{{$vid == $posttype->id ? 'checked':''}}               
														@endif
													@endforeach                                            
													> 
													<label class="custom-control-label" for="Check{{$posttype->id}}">{{$posttype->name}}</label>
													
													<!--all post -->
														<div class="card-body">
														@foreach($posts as $post)
														@if($post->post_type == $posttype->slug)
														
														
														
														<label class="form-check">
															<input class="form-check-input checkchild{{$posttype->id}}" name="posts_id[]" type="checkbox" value="{{$post->id}}" 
															
															@php $values = explode(',',$user->posts_id); @endphp
															@foreach($values as $vid) 
																@if($vid)                                                
																	{{$vid == $post->id ? 'checked':''}}               
																@endif
															@endforeach                                            
															>
															<span class="form-check-label  ">
																{{$post->title}}
															</span>
														</label> <!-- form-check.// -->
														@endif
														@endforeach
													</div> <!-- card-body.// -->
													
													
												</div> <!-- form-check.// -->
												
												<script>
														$("#Check{{$posttype->id}}").click(function () {
															$('.checkchild{{$posttype->id}}').not(this).prop('checked', this.checked);
														});
												</script>
												
												@endforeach
											</div> <!-- card-body.// -->
										</div>
									</article> <!-- card-group-item.// -->						

								</div> <!-- card.// -->
							</aside> <!-- col.// -->
							
							<aside class="col-sm-4">
								<p>Others Permission</p>
								<div class="card">
									<article class="card-group-item">
										<header class="card-header"><h6 class="title">Check Others</h6></header>
										<div class="filter-content">
											<div class="card-body">
												<label class="btn btn-danger">
												<input class="" type="checkbox" name="categories" value="categories" {{$user->categories == 'categories' ? 'checked':''}} >
												<span class="form-check-label">Category</span>
												</label>
												<label class="btn btn-success">
												<input class="" type="checkbox" name="menus" value="menus" {{$user->menus == 'menus' ? 'checked':''}} >
												<span class="form-check-label">Menu</span>
												</label>
												<label class="btn btn-primary">
												<input class="" type="checkbox" name="media" value="media" {{$user->media == 'media' ? 'checked':''}}>
												<span class="form-check-label">Media</span>
												</label>

												<label class="btn btn-primary">
													<input class="" type="checkbox" name="feedbacks" value="feedbacks" {{$user->feedbacks == 'feedbacks' ? 'checked':''}}>
													<span class="form-check-label">Feedback</span>
												</label>

												<label class="btn btn-primary">
													<input class="" type="checkbox" name="create" value="create" {{$user->create == 'create' ? 'checked':''}}>
													<span class="form-check-label">Create</span>
												</label>
												<label class="btn btn-primary">
													<input class="" type="checkbox" name="update" value="update" {{$user->update == 'update' ? 'checked':''}}>
													<span class="form-check-label">Update</span>
												</label>
												<label class="btn btn-primary">
													<input class="" type="checkbox" name="delete" value="delete" {{$user->delete == 'delete' ? 'checked':''}}>
													<span class="form-check-label">Delete</span>
												</label>

											</div> <!-- card-body.// -->
										</div>
									</article> <!-- card-group-item.// -->	
								</div> <!-- card.// -->
							</aside> <!-- col.// -->   
							<aside class="col-sm-4">
								<p>Menu Permission</p>
								<div class="card"> 
									<article class="card-group-item">
										<header class="card-header">
											<h6 class="title">Menu</h6>
										</header>
										<div class="filter-content">
											<div class="card-body">
												@foreach($posttypesD as $posttypeD)
												@if($posttypeD->menu_icon != '' && $posttypeD->menu_icon != null) 
												<div class="custom-control custom-checkbox">
													<span class="float-right badge badge-light round"></span>
													<input class="custom-control-input" name="admin_pt_menu[]" type="checkbox" value="{{$posttypeD->menu_icon}}" id="Check{{$posttypeD->menu_icon}}"										
													@php $ptvalues = explode(',',$user->admin_pt_menu); @endphp
													@foreach($ptvalues as $vid) 
														@if($vid)                                                
															{{$vid == $posttypeD->menu_icon ? 'checked':''}}               
														@endif
													@endforeach                                            
													> 
													<label class="custom-control-label" for="Check{{$posttypeD->menu_icon}}">{{$posttypeD->menu_icon}}</label>
												</div> <!-- form-check.// -->
												@endif
												@endforeach
											</div> <!-- card-body.// -->
										</div>
									</article> <!-- card-group-item.// -->                                  
								</div> <!-- card.// -->
							</aside> <!-- col.// -->                     
						</div> <!-- row.// -->
                    </div>
                    <script>
                    function changeFunc(i) {
						if(i == '112'){ 
							$('#permission_id').addClass('d-block'); 
						}else if(i == '111'){						
							$('#permission_id').removeClass('d-block'); 
							$('#permission_id').addClass('d-none'); 
						}
					}
                    </script>


                    @else
                    <input name="role" type="hidden" value="{{$user->role}}"/>
                    @endif
                    @endauth
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
