@extends('admin.layouts.master')
@section('content')

@if(optional(auth()->user())->role == 111 || optional(auth()->user())->media == 'media')

       <!-- Page Heading -->
       <h5 class="h5 mb-2 text-gray-800">Add New Media <a href="{{ url('/dashboard/media/create') }}" class="text-white"><button class="btn btn-primary btn-user"><i class="fa fa-plus"></i></button></a> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Media Library</button> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalGallery">Media Gallery</button></h5>                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Media</h6>  
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex gap-2 mb-3 align-items-center">                                
                                        <select id="bulkAction" class="form-select w-auto form-control w-25 d-inline">
                                            <option value="">Bulk Actions</option>
                                            <option value="delete">Delete</option> 
                                        </select>
                                        
                                        <input type="hidden" name="user_id" value="@auth(){{ optional(auth()->user())->id}}@endauth" id="user_ID">
                                        <!-- <input type="text" id="bulkType" class="form-control w-auto d-none w-25" placeholder="Enter new post type"> -->
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#logoutModalBulkAction"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>  
                                                                    
                                        <!-- BulkAction Modal-->
                                        <div class="modal fade" id="logoutModalBulkAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Action?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Are you sure you want to apply this action to the selected items? This change may affect their visibility or type and cannot be undone.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>  
                                                        <button type="button" id="applyBulkAction" class="btn btn-outline-success" >Yes, Continue</button>                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <!-- BulkAction Modal-->
                                    </div>
                                </div> 
                            </div>  
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="selectAll"></th>
                                            <th>SL/ID</th> 
                                            <th>Image</th> 
                                            <th>Permalink</th>
                                            <th>Auth.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" class="selectAll"></th>
                                            <th>SL/ID</th> 
                                            <th>Image</th> 
                                            <th>Permalink</th>
                                            <th>Auth.</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                        $sl = 0;
                                        @endphp
                                        @forelse($medies as $media)
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" value="{{ $media->id }}" class="checkbox-item"></td>
                                            <td>SL: {{ ++$sl }}<br>ID: {{ $media->id }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('public/uploads/') }}/{{$media->img_name }}">
                                                @php
                                                $link = "asset('public/uploads/')/$media->img_name";
                                                $file_extension = pathinfo($link, PATHINFO_EXTENSION);
                                                if ($file_extension == "pdf" || $file_extension == "xlsx") {
                                                @endphp
                                                <a class="btn btn-info bbtn"><i class="fas fa-file"></i></a>
                                                @php
                                                } else {
                                                @endphp
                                                    <img src="{{ asset('public/uploads/') }}/{{$media->img_name }}" width="100" alt="Image"/>
                                                @php 
                                                }
                                                @endphp
                                                </a>
                                            </td>
                                            <td>{{ asset('public/uploads/') }}/{{$media->img_name }}</td> 
                                            <td>
                                                @foreach($users as $user)
                                                    @if($user->id == $media->uploaded_by)
                                                        {{$user->name}}
                                                    @endif
                                                @endforeach
                                            </td> 
                                            <td> 
                                            @if(optional(auth()->user())->role == 111)
                                            <a href="{{ url('/dashboard/media/'.$media->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                            <a  class="btn btn-danger bbtn" data-toggle="modal" data-target="#logoutModal{{ $media->id }}"><i class="fas fa-trash"></i></a> 
                                            @endif
                                    
                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="logoutModal{{ $media->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                            <form action="{{ url('/dashboard/media',$media->id) }}" method="POST">
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
                                       @empty
                                            <tr>
                                                <td colspan="5">No media found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {!! $medies->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div> 
    <!-- Insert Image from library -->
    @include('admin.media.medialibrary')
    @include('admin.media.mediauploads')
    <!-- Modal -->
<script>
// Select all checkboxes
let selectAllBoxes = document.getElementsByClassName('selectAll');
Array.from(selectAllBoxes).forEach(selectAll => {
selectAll.addEventListener('change', function() {
    let checkboxes = document.querySelectorAll('.checkbox-item');
    checkboxes.forEach(ch => ch.checked = this.checked);
});
});
</script>

<form id="bulkForm" method="POST" action="{{ route('media.bulkActionMedia') }}" style="display: none;">
    @csrf
    <input type="hidden" name="action" id="hiddenAction"> 
    <input type="hidden" name="user_id" value="1" id="hiddenUserID">
    <div id="hiddenIdsContainer"></div>
</form>
<script> 

document.getElementById('applyBulkAction').addEventListener('click', function() {
    const selectedIds = Array.from(document.querySelectorAll('.checkbox-item:checked')).map(ch => ch.value);
    const action = document.getElementById('bulkAction').value; 
    const userID = document.getElementById('user_ID').value;

    if (!action) {
        alert('Please select an action.');
        return;
    }
    if (selectedIds.length === 0) {
        alert('Please select at least one post.');
        return;
    }

    // Build hidden form data
    const form = document.getElementById('bulkForm');
    document.getElementById('hiddenAction').value = action; 
    document.getElementById('hiddenUserID').value = userID;

    const container = document.getElementById('hiddenIdsContainer');
    container.innerHTML = ''; // clear
    selectedIds.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        container.appendChild(input);
    });

    // Submit the hidden form
    form.submit();
});
</script>
@else
You can't access this page. Please contact admin.
@endif
@endsection



