@extends('admin.layouts.master')

@section('content')

@if(optional(auth()->user())->role == 111 || optional(auth()->user())->feedbacks == 'feedbacks')
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Category Show</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category</h6> <br/>
                            Name: {{ $categories->name }} <br/><hr/>
                            Slug: {{ $categories->slug }} <br/><hr/>
                            Status: {{ $categories->status == 0 ? 'Unpublish' : 'Publish' }}
                        </div>
                       
                    </div>
@else
You can't access this page. Please contact admin.
@endif
@endsection