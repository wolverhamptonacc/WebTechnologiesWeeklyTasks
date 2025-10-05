@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="text-center mb-5">
            <h1 class="display-4">{{ $title }}</h1>
            <p class="lead">{{ $message }}</p>
        </div>

        <!-- Laravel Concepts Overview -->
        <div class="row">
            <div class="col-md-12">
                <h2>Laravel Concepts Covered</h2>
                <div class="row">
                    @foreach($features as $feature)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $feature }}</h5>
                                    <p class="card-text">
                                        @switch($feature)
                                            @case('Routing')
                                                Define web routes with parameters, middleware, and naming.
                                                @break
                                            @case('Middleware')
                                                Filter HTTP requests entering your application.
                                                @break
                                            @case('CSRF Protection')
                                                Protect against cross-site request forgery attacks.
                                                @break
                                            @case('Controllers')
                                                Handle request logic and return responses.
                                                @break
                                            @case('Requests')
                                                Access and validate incoming HTTP request data.
                                                @break
                                            @case('Responses')
                                                Return different types of HTTP responses.
                                                @break
                                            @case('Views')
                                                Present data using Blade templating engine.
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Example Routes Section -->
        <div class="mt-5">
            <h2>Try These Example Routes</h2>
            <div class="list-group">
                <a href="/user/123" class="list-group-item list-group-item-action">
                    <strong>/user/123</strong> - Route with parameter
                </a>
                <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">
                    <strong>/profile</strong> - Named route example
                </a>
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">
                    <strong>/users</strong> - Resource controller index
                </a>
                <a href="{{ route('users.create') }}" class="list-group-item list-group-item-action">
                    <strong>/users/create</strong> - Create form with CSRF protection
                </a>
                <a href="/welcome/json-response" class="list-group-item list-group-item-action">
                    <strong>/welcome/json-response</strong> - JSON response example
                </a>
            </div>
        </div>

        <!-- CSRF Example Form -->
        <div class="mt-5">
            <h2>CSRF Protection Example</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('submit.form') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" 
                                placeholder="Enter your message here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Submit (with CSRF protection)
                        </button>
                    </form>
                    <small class="text-muted mt-2 d-block">
                        This form includes CSRF token automatically via @csrf directive
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .list-group-item-action:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush