@extends('admin.layouts.master')

@section('content')
@if(optional(auth()->user())->role == 111 || optional(auth()->user())->feedbacks == 'feedbacks')
   <!-- Nested Row within Card Body -->
   <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit</h1>
            </div>
            {!! Form::open(['url' => '/dashboard/categories/'.$categories->id,'method'=>'patch']) !!}
<!-- 
            <form class="user" action="{{ url('/dashboard/categories') }}" method="post">
            {{ csrf_field() }} -->
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" name='name' value='{{ $categories->name }}' class="form-control form-control-user" id="exampleFirstName"
                            placeholder="First Name">
                    </div> 
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" name='slug' value='{{ $categories->slug }}' class="form-control form-control-user" id="exampleFirstName"
                            placeholder="slug">
                    </div> 
                </div>
               

                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                    <select class="form-control" class="form-select form-select-sm" aria-label=".form-select-sm example" name="status">
                     <option value="0" {{ $categories->status == 0 ? 'selected' : '' }}  >Unpublish</option>
                    <option value="1" {{ $categories->status == 1 ? 'selected' : '' }}  >Publish</option>
                    </select>
                    </div> 
                </div>
                
                <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                @foreach ($errors->all() as $message)
                {{ $message }}
                @endforeach
            <!-- </form> -->
             
            {!! Form::close() !!}

            <hr>
        </div>
    </div>
</div> 
@else
You can't access this page. Please contact admin.
@endif
@endsection