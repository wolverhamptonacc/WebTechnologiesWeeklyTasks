@extends('layouts.app')

@section('title', 'Users List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
</div>

<!-- Search Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('users.index') }}">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search users by name or email..." 
                           value="{{ $search }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                    @if($search)
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Users Table -->
@if(count($users) > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('users.show', $user['id']) }}" 
                                           class="btn btn-sm btn-outline-primary">View</a>
                                        <a href="{{ route('users.edit', $user['id']) }}" 
                                           class="btn btn-sm btn-outline-secondary">Edit</a>
                                        
                                        <!-- Delete Form with CSRF -->
                                        <form action="{{ route('users.destroy', $user['id']) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info">
        <h4>No users found</h4>
        @if($search)
            <p>No users match your search criteria: "{{ $search }}"</p>
            <a href="{{ route('users.index') }}" class="btn btn-outline-primary">View All Users</a>
        @else
            <p>There are no users in the system yet.</p>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add First User</a>
        @endif
    </div>
@endif

<!-- Pagination Info -->
<div class="mt-3">
    <small class="text-muted">
        Page {{ $page }} | Total users: {{ count($users) }}
        @if($search)
            | Filtered by: "{{ $search }}"
        @endif
    </small>
</div>
@endsection