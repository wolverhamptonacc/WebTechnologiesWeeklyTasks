@extends('layouts.app')

@section('title', 'About Laravel Tutorial')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="text-center mb-5">
            <h1 class="display-4">About This Laravel Tutorial</h1>
            <p class="lead">Welcome, {{ $name }}! Learn the fundamental concepts of Laravel framework.</p>
        </div>

        <!-- Tutorial Overview -->
        <div class="row">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h3>What You'll Learn</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Routing:</strong> Define web routes with parameters and middleware</li>
                            <li class="list-group-item"><strong>Middleware:</strong> Filter HTTP requests entering your application</li>
                            <li class="list-group-item"><strong>CSRF Protection:</strong> Protect against cross-site request forgery</li>
                            <li class="list-group-item"><strong>Controllers:</strong> Handle request logic and return responses</li>
                            <li class="list-group-item"><strong>Requests:</strong> Access and validate incoming HTTP data</li>
                            <li class="list-group-item"><strong>Responses:</strong> Return different types of HTTP responses</li>
                            <li class="list-group-item"><strong>Views:</strong> Present data using Blade templating</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h3>Key Features Demonstrated</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">RESTful resource controllers</li>
                            <li class="list-group-item">Form validation and error handling</li>
                            <li class="list-group-item">Blade templating with layouts</li>
                            <li class="list-group-item">Route model binding and parameters</li>
                            <li class="list-group-item">HTTP method spoofing (PUT, DELETE)</li>
                            <li class="list-group-item">Flash messages and session handling</li>
                            <li class="list-group-item">Custom middleware creation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Code Examples -->
        <div class="mt-5">
            <h2>Code Examples</h2>
            
            <div class="accordion" id="codeExamples">
                <!-- Routing Example -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#routingExample">
                            Routing Examples
                        </button>
                    </h2>
                    <div id="routingExample" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <pre><code class="language-php">// Basic route
Route::get('/', function () {
    return view('welcome');
});

// Route with parameter
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
});

// Named route
Route::get('/profile', function () {
    return "User Profile";
})->name('profile');

// Resource controller
Route::resource('users', UserController::class);</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Middleware Example -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#middlewareExample">
                            Middleware Examples
                        </button>
                    </h2>
                    <div id="middlewareExample" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <pre><code class="language-php">// Custom middleware
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

// Apply middleware to routes
Route::middleware(['auth', 'checkage:21'])->group(function () {
    Route::get('/admin', 'AdminController@index');
});</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Controller Example -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#controllerExample">
                            Controller Examples
                        </button>
                    </h2>
                    <div id="controllerExample" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <pre><code class="language-php">class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        // Logic to fetch and filter users
        return view('users.index', compact('users', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        // Create user logic
        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documentation Links -->
        <div class="mt-5">
            <div class="alert alert-info">
                <h4>Learn More</h4>
                <p>For comprehensive documentation, visit the official Laravel docs:</p>
                <ul class="mb-0">
                    <li><a href="https://laravel.com/docs/12.x/routing" target="_blank">Routing Documentation</a></li>
                    <li><a href="https://laravel.com/docs/12.x/middleware" target="_blank">Middleware Documentation</a></li>
                    <li><a href="https://laravel.com/docs/12.x/controllers" target="_blank">Controllers Documentation</a></li>
                    <li><a href="https://laravel.com/docs/12.x/blade" target="_blank">Blade Templates Documentation</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/components/prism-core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/autoloader/prism-autoloader.min.js"></script>
@endpush