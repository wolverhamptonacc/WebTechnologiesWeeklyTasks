@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Create New User</h2>
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

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
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
                               value="{{ old('email') }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Password must be at least 8 characters long.</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary me-md-2">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- CSRF Information Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">CSRF Protection Info</h5>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>This form demonstrates CSRF protection:</strong></p>
                <ul class="mb-2">
                    <li>The <code>@csrf</code> directive automatically includes a CSRF token</li>
                    <li>Laravel validates this token on form submission</li>
                    <li>Without the token, the request would be rejected with a 419 error</li>
                </ul>
                <p class="mb-0 text-muted">
                    <small>CSRF token: <code>{{ csrf_token() }}</code></small>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form enhancement - show password strength
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const strength = this.value.length >= 8 ? 'Good' : 'Too short';
            const color = strength === 'Good' ? 'text-success' : 'text-warning';
            
            let strengthIndicator = document.getElementById('password-strength');
            if (!strengthIndicator) {
                strengthIndicator = document.createElement('small');
                strengthIndicator.id = 'password-strength';
                strengthIndicator.className = 'form-text';
                this.parentNode.appendChild(strengthIndicator);
            }
            
            strengthIndicator.className = `form-text ${color}`;
            strengthIndicator.textContent = `Password strength: ${strength}`;
        });
    }
});
</script>
@endpush