@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Edit User</h2>
            </div>
            <div class="card-body">
                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user['name']) }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user['email']) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('users.show', $user['id']) }}" class="btn btn-secondary me-md-2">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- HTTP Method Spoofing Info -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">HTTP Method Spoofing</h5>
            </div>
            <div class="card-body">
                <p><strong>This form demonstrates Laravel's method spoofing:</strong></p>
                <ul class="mb-2">
                    <li>HTML forms only support GET and POST methods</li>
                    <li>Laravel uses <code>@method('PUT')</code> to simulate a PUT request</li>
                    <li>This allows RESTful routing with proper HTTP verbs</li>
                    <li>The actual form method is POST, but Laravel treats it as PUT</li>
                </ul>
                <p class="mb-0">
                    <small class="text-muted">
                        Form method: POST | Laravel method: PUT | Route: <code>users.update</code>
                    </small>
                </p>
            </div>
        </div>

        <!-- Request Validation Info -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Request Validation</h5>
            </div>
            <div class="card-body">
                <p><strong>This form includes server-side validation:</strong></p>
                <ul class="mb-0">
                    <li><strong>Name:</strong> Required, string, max 255 characters</li>
                    <li><strong>Email:</strong> Required, valid email format, max 255 characters</li>
                    <li><strong>CSRF:</strong> Automatically validated by Laravel</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection