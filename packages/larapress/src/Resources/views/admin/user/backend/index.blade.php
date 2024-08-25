@extends('admin.layouts.master')

@section('content')
@if(optional(auth()->user())->role == 111)
       <!-- Page Heading --> 
    <h5 class="h5 mb-2 text-gray-800">Add New Users <a href="{{ url('/dashboard/user/create') }}" class="text-white"><button class="btn btn-primary btn-user">Add New</button></a></h5>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>User Name</th> 
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>SL.</th>
                            <th>User Name</th> 
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                        $sl = 0;
                        @endphp
                        @foreach($users as $user)
                        <tr class="@if(session()->has('message'.$user->id)) alert alert-{{session('message'.$user->id)}} @endif">
                            <td>{{ ++$sl }}</td>
                            <td>{{ $user->name }}</td> 
                            <td>{{ $user->email }}</td>
                            <td>
                                <!-- {{ $user->role == 111 ? 'Administrator':'Editor' }} -->
                                @if($user->role == 111)
                                    Administrator
                                @elseif($user->role == 112)
                                    Editor
                                @elseif($user->role == 2)
                                    Author
                                @elseif($user->role == 3)
                                    Subscriber
                                @else
                                    Pendding
                                @endif

                            </td>
                            <td>
                            @if(optional(auth()->user())->role == 1) 
                            @else 
                                <a href="{{ url('dashboard/singleUser/'.$user->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a> 
                                <a href="{{ url('dashboard/user/'.$user->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                @if(optional(auth()->user())->id == $user->id && optional(auth()->user())->role == 111) 
                                @else 
                                <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $user->id }}"><i class="fas fa-trash"></i></a> 
                    
                                <!-- Delete Modal-->
                                <div class="modal fade" id="logoutModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Select "Delete - {{ $user->name }}" below if you are ready to Permanently delete your current data.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <form action="{{ url('/dashboard/delete',$user->id) }}" method="POST">
                                                    @csrf     
                                                    @method('DELETE')                                                           
                                                    <button class="btn btn-danger bbtn" type="submit">Delete</button>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!-- Delete Modal--> 
                                @endif
                            @endif
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