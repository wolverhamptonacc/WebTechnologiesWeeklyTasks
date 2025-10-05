<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Laravel Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Laravel Tutorial</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/users">Users</a>
                <a class="nav-link active" href="/about">About</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h1 class="display-4">About This Laravel Tutorial</h1>
                    <p class="lead">Welcome, <?= htmlspecialchars($name) ?>! Learn the fundamental concepts of Laravel framework.</p>
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
                                    <li class="list-group-item"><strong>Views:</strong> Present data using templating</li>
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
                                    <li class="list-group-item">Template inheritance and layouts</li>
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

    public function show(Request $request, string $id)
    {
        $format = $request->get('format', 'html');
        $user = User::findOrFail($id);
        
        if ($format === 'json') {
            return response()->json($user);
        }
        
        return view('users.show', compact('user'));
    }
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Test URLs -->
                <div class="mt-5">
                    <div class="alert alert-primary">
                        <h4>Test These URLs:</h4>
                        <ul class="mb-0">
                            <li><a href="/" target="_blank">/ - Home page</a></li>
                            <li><a href="/users" target="_blank">/users - Users list</a></li>
                            <li><a href="/user/123" target="_blank">/user/123 - Route parameter</a></li>
                            <li><a href="/users/1?format=json" target="_blank">/users/1?format=json - JSON response</a></li>
                            <li><a href="/json-example" target="_blank">/json-example - Pure JSON response</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/autoloader/prism-autoloader.min.js"></script>
</body>
</html>