@extends('admin.layouts.master')

@section('content')
 <h5 class="h5 mb-2 text-gray-800"><a href="{{ url('/dashboard/') }}" class="text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> <a href="{{ url('dashboard/user/'.optional(auth()->user())->id.'/edit') }}" class="text-white"><button class="btn btn-primary btn-user">Update Profile</button></a></h5> 
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ optional(auth()->user())->name}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    <tr>
                    <th scope="row">Name:</th>
                    <td>
                        @auth()
                        Profile ({{ optional(auth()->user())->name}})
                        @endauth
                    </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Email</th>
                        <td>{{ optional(auth()->user())->email}}</td>
                    </tr>
                    
                    <tr>
                    <th scope="row">Password:</th>
                    <td>**********</td>
                    </tr>
                    <tr>
                    <th scope="row">Permission:</th>
                    <td>
                        <!-- {{ optional(auth()->user())->role == 111 ? 'Administrator':'Editor' }} -->
                        @if(optional(auth()->user())->role == 111)
                            Administrator
                        @elseif(optional(auth()->user())->role == 112)
                            Editor
                        @elseif(optional(auth()->user())->role == 2)
                            Author
                        @elseif(optional(auth()->user())->role == 3)
                            Subscriber
                        @endif

                    </td>
                    </tr>
                    <tr>
                     
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection