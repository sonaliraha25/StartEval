@extends('layouts.app') <!-- Or your actual layout file like 'admin.layout' -->

@section('content')
<div class="container my-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User Profile: {{ $user->name }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> 
                <span class="badge 
                    {{ $user->role === 'Investor' ? 'bg-info text-dark' : ($user->role === 'Entrepreneur' ? 'bg-warning text-dark' : 'bg-secondary text-white') }}">
                    {{ $user->role }}
                </span>
            </p>
            <p><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
