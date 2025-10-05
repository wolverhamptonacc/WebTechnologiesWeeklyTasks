@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- User Details Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">User Details</h2>
                <div class="btn-group">
                    <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-primary btn-sm">
                        Edit User
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">
                        Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $user['id'] }}</dd>
                    
                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9">{{ $user['name'] }}</dd>
                    
                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9">
                        <a href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a>
                    </dd>
                    
                    <dt class="col-sm-3">Created:</dt>
                    <dd class="col-sm-9">{{ $user['created_at'] }}</dd>
                </dl>
            </div>
        </div>

        <!-- Response Format Examples -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Response Format Examples</h5>
            </div>
            <div class="card-body">
                <p>This user data can be accessed in different formats:</p>
                <div class="list-group">
                    <a href="{{ route('users.show', $user['id']) }}" 
                       class="list-group-item list-group-item-action">
                        <strong>HTML Format</strong> (current view)
                        <br><small class="text-muted">Default view using Blade templates</small>
                    </a>
                    <a href="{{ route('users.show', $user['id']) }}?format=json" 
                       class="list-group-item list-group-item-action">
                        <strong>JSON Format</strong>
                        <br><small class="text-muted">Returns user data as JSON response</small>
                    </a>
                </div>
            </div>
        </div>

        <!-- Request Information -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Request Information</h5>
            </div>
            <div class="card-body">
                <p>Current request details:</p>
                <ul class="list-unstyled">
                    <li><strong>Route:</strong> <code>users.show</code></li>
                    <li><strong>Method:</strong> <code>GET</code></li>
                    <li><strong>Parameters:</strong> <code>id = {{ $user['id'] }}</code></li>
                    <li><strong>URL:</strong> <code>{{ request()->fullUrl() }}</code></li>
                </ul>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="card mt-4 border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Danger Zone</h5>
            </div>
            <div class="card-body">
                <p class="text-danger mb-3">
                    <strong>Delete User:</strong> This action cannot be undone.
                </p>
                <form action="{{ route('users.destroy', $user['id']) }}" 
                      method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete User
                    </button>
                </form>
                <small class="text-muted d-block mt-2">
                    This form uses the DELETE HTTP method via Laravel's method spoofing
                </small>
            </div>
        </div>
    </div>
</div>
@endsection