@extends('admin.layouts.master')

@section('content')
<!-- Page Heading -->
<h5 class="h5 mb-2 text-gray-800"><a href="{{ url('/dashboard/showUser/') }}" class="text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></h5> 
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Profile — {{ $user->name }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                <tr>
                <th scope="row">Name:</th>
                <td>{{ $user->name }}</td>
                </tr>
                <tr>
                <th scope="row">Password:</th>
                <td>**********</td>
                </tr>
                
                <tr>
                <th scope="row">Permission:</th>
                <td>
                    <!-- {{ $user->name == 111 ? 'Administrator':'Editor' }} -->
                    @if($user->role == 111)
                        Administrator
                    @elseif($user->role == 1)
                        Editor
                    @else
                        Pendding
                    @endif
                
                </td>
                </tr>
                
            </tbody>
         </table>
        </div>
    </div>
</div>

@if($activities->isEmpty())
    <p>No activity found for this user.</p>
@else
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Activity Log — {{ $user->name }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Action</th>
                    <th>Label</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $i => $activity)
                <tr>
                    <td>{{ ($activities->currentPage() - 1) * $activities->perPage() + $loop->iteration }}</td>
                    <td>{{ $activity['type'] }}</td>
                    <td>{{ $activity['action'] }}</td>
                    <td>{{ $activity['label'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($activity['created_at'])->format('d M Y, h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

{{-- Pagination links --}}
{{ $activities->withQueryString()->links('pagination::bootstrap-5') }}

@endif
@endsection