@extends('admin.layouts.master')

@section('content')
       <!-- Page Heading --> 

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <table class="table">
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
                                    <th scope="row">Password:</th>
                                    <td>**********</td>
                                    </tr>
                                     
                                    <tr>
                                    <th scope="row">Permission:</th>
                                    <td>
                                        <!-- {{ optional(auth()->user())->role == 111 ? 'Administrator':'Editor' }} -->
                                        @if(optional(auth()->user())->role == 111)
                                            Administrator
                                        @elseif(optional(auth()->user())->role == 1)
                                            Editor
                                        @elseif(optional(auth()->user())->role == 2)
                                            Author
                                        @elseif(optional(auth()->user())->role == 3)
                                            Subscriber
                                        @endif

                                    </td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Profile Photo:</th>
                                    <td><img src="" width="100"/></td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                       
                    </div>
                    <h5 class="h5 mb-2 text-gray-800 text-center"> 
                    <a href="{{ url('dashboard/user/'.optional(auth()->user())->id.'/edit') }}" class="text-white">
                        <button class="btn btn-primary btn-user">Update Profile</button></a></h5>
@endsection