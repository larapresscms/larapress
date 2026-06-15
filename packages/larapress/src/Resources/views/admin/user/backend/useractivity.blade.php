@extends('admin.layouts.master')
@section('content')

@if(optional(auth()->user())->role == 111)
        <!-- DataTales Example -->
      <h5 class="h5 mb-2 text-gray-800"><a href="{{ url('/dashboard/showUser/') }}" class="text-decoration-none"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></h5>  
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users log</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Attempts</th>
                    <th>Logins</th>
                    <th>Logouts</th>
                    <th>Failed</th>
                    <th>Last IP</th>
                    <th>Last Activity</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td><span class="badge badge-info">{{ $user['attempt'] }}</span></td>
                    <td><span class="badge badge-success">{{ $user['login'] }}</span></td>
                    <td><span class="badge badge-warning">{{ $user['logout'] }}</span></td>
                    <td><span class="badge badge-danger">{{ $user['failed'] }}</span></td>
                    <td>{{ $user['last_ip'] }}</td>
                    <td>{{ $user['last_act'] }}</td>
                    <td>
                        <a href="{{ route('admin.user.backend.activity-details', $user['id']) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
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