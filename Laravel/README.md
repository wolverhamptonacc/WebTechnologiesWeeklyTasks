# Laravel Tutorial - Basic Concepts

This project demonstrates the fundamental concepts of Laravel framework including routing, middleware, CSRF protection, controllers, requests, responses, and views.

## What You'll Learn

### 1. Routing
- Basic routes with closures
- Routes with parameters (required and optional)
- Named routes
- Route groups and middleware
- Resource routes
- Route model binding

### 2. Middleware
- Creating custom middleware
- Applying middleware to routes
- Middleware parameters
- Before and after middleware

### 3. CSRF Protection
- Automatic CSRF token generation
- Form protection with @csrf directive
- CSRF token validation

### 4. Controllers
- Resource controllers
- Controller methods (index, create, store, show, edit, update, destroy)
- Dependency injection
- Request handling

### 5. Requests
- Accessing request data
- Request validation
- Form request validation
- File uploads (demonstrated concepts)

### 6. Responses
- View responses
- JSON responses
- Redirect responses
- Custom responses with headers
- HTTP status codes

### 7. Views (Blade Templates)
- Template inheritance with @extends
- Sections with @section and @yield
- Blade directives (@if, @foreach, @csrf, etc.)
- Component slots and stacks
- View data passing

## Project Structure

```
Laravel/
├── app/
│   └── Http/
│       ├── Controllers/
│       │   ├── Controller.php
│       │   ├── UserController.php
│       │   └── WelcomeController.php
│       └── Middleware/
│           ├── CheckAge.php
│           └── LogRequests.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── users/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── show.blade.php
│       │   └── edit.blade.php
│       ├── welcome.blade.php
│       └── about.blade.php
├── routes/
│   └── web.php
├── composer.json
└── README.md
```

## Key Features Demonstrated

### Routing Examples
- **Basic Route**: `Route::get('/', function () { return view('welcome'); });`
- **Parameter Route**: `Route::get('/user/{id}', function ($id) { return "User ID: " . $id; });`
- **Named Route**: `Route::get('/profile', function () { return "User Profile"; })->name('profile');`
- **Resource Route**: `Route::resource('users', UserController::class);`

### Middleware Examples
- **CheckAge Middleware**: Validates minimum age requirement
- **LogRequests Middleware**: Logs incoming requests and responses
- **Route Protection**: `Route::middleware(['auth', 'admin'])->group(...)`

### CSRF Protection
- All forms include `@csrf` directive
- Automatic token validation
- 419 error for missing/invalid tokens

### Controller Features
- RESTful resource controllers
- Request validation
- Response types (view, JSON, redirect)
- Flash messages and error handling

### Request Handling
- Form data access: `$request->get('field')`
- Validation: `$request->validate([...])`
- File uploads: `$request->file('upload')`
- Request information: `$request->method()`, `$request->fullUrl()`

### Response Types
- **View Response**: `return view('template', $data);`
- **JSON Response**: `return response()->json($data);`
- **Redirect Response**: `return redirect()->route('name');`
- **Custom Response**: `return response($content, 200)->header('X-Custom', 'value');`

### Blade Template Features
- Template inheritance
- Component sections (@section/@yield)
- Conditional rendering (@if/@else)
- Loops (@foreach)
- Form directives (@csrf, @method)
- Old input retention (old('field'))
- Error display (@error)

## Example Routes to Test

1. **Home Page**: `/` - Main welcome page
2. **User with Parameter**: `/user/123` - Route parameter example
3. **Named Route**: `/profile` - Named route demonstration
4. **Users Resource**: `/users` - RESTful resource controller
5. **Create User**: `/users/create` - CSRF protected form
6. **JSON Response**: `/welcome/json-response` - JSON response example
7. **About Page**: `/about` - View route with data

## Setup Instructions

1. **Install Dependencies** (in a real Laravel project):
   ```bash
   composer install
   ```

2. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Run Development Server**:
   ```bash
   php artisan serve
   ```

4. **Visit the Application**:
   Open `http://localhost:8000` in your browser

## Code Examples

### Custom Middleware
```php
class CheckAge
{
    public function handle(Request $request, Closure $next, int $minAge = 18)
    {
        if ($request->get('age') < $minAge) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        return $next($request);
    }
}
```

### Resource Controller
```php
class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        // Filter and return users
        return view('users.index', compact('users', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }
}
```

### Blade Template
```blade
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>{{ $title }}</h1>
    
    @if(count($items) > 0)
        @foreach($items as $item)
            <p>{{ $item }}</p>
        @endforeach
    @else
        <p>No items found.</p>
    @endif
    
    <form action="{{ route('submit') }}" method="POST">
        @csrf
        <input type="text" name="field" value="{{ old('field') }}">
        @error('field')
            <span class="error">{{ $message }}</span>
        @enderror
        <button type="submit">Submit</button>
    </form>
@endsection
```

## Learning Resources

- [Laravel Documentation](https://laravel.com/docs/12.x)
- [Laravel Routing](https://laravel.com/docs/12.x/routing)
- [Laravel Middleware](https://laravel.com/docs/12.x/middleware)
- [Laravel Controllers](https://laravel.com/docs/12.x/controllers)
- [Blade Templates](https://laravel.com/docs/12.x/blade)

## Notes

This is a tutorial project focusing on demonstrating Laravel concepts with working examples. In a production application, you would:

- Use actual database models and migrations
- Implement proper authentication and authorization
- Add comprehensive error handling
- Include unit and feature tests
- Use environment-specific configurations
- Implement proper logging and monitoring