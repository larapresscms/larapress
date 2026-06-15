@extends('admin.layouts.master')
@section('content')
@if(optional(auth()->user())->role == 111)

<!-- DataTales Example -->
<h5 class="h5 mb-2 text-gray-800"><a href="{{ url('/dashboard/user-activity/') }}" class="text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></h5> 
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users Log — {{ $user->name }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Action</th>
                    <th>IP Address</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $i => $log)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($log['action'] === 'login')
                            <span class="badge badge-success">✅ Login</span>
                        @elseif($log['action'] === 'logout')
                            <span class="badge badge-warning">🚪 Logout</span>
                        @elseif($log['action'] === 'failed')
                            <span class="badge badge-danger">❌ Failed</span>
                        @elseif($log['action'] === 'attempt')
                            <span class="badge badge-info">🔄 Attempt</span>
                        @endif
                    </td>
                    <td>{{ $log['ip'] }}</td>
                    <td>{{ $log['time'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No activity found</td>
                </tr>
                @endforelse
            </tbody>
         </table>
        </div>
    </div>
</div>

@else
You can't access this page. Please contact admin.
@endif
@endsection