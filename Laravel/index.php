<?php

// Simple router for testing Laravel concepts without full Laravel installation
// This simulates Laravel routing behavior for educational purposes

class SimpleRouter {
    private $routes = [];
    
    public function get($path, $handler) {
        $this->routes['GET'][$path] = $handler;
    }
    
    public function post($path, $handler) {
        $this->routes['POST'][$path] = $handler;
    }
    
    public function handle($method, $path) {
        // Handle route parameters
        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';
            
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // Remove full match
                return $this->executeHandler($handler, $matches);
            }
        }
        
        return null;
    }
    
    private function executeHandler($handler, $params = []) {
        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }
        return $handler;
    }
}

// Simple view renderer
function view($template, $data = []) {
    extract($data);
    ob_start();
    
    $templatePath = __DIR__ . "/resources/views/{$template}.php";
    if (file_exists($templatePath)) {
        include $templatePath;
    } else {
        echo "<h1>View not found: {$template}</h1>";
    }
    
    return ob_get_clean();
}

// Simple response helpers
function response($content = '', $status = 200) {
    http_response_code($status);
    return $content;
}

function json($data) {
    header('Content-Type: application/json');
    return json_encode($data);
}

function redirect($url) {
    header("Location: {$url}");
    exit;
}

// CSRF token simulation
function csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        session_start();
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Initialize router
$router = new SimpleRouter();

// Define routes (simulating Laravel routes)
$router->get('/', function() {
    return view('welcome', [
        'title' => 'Welcome to Laravel Tutorial',
        'message' => 'This is a simplified Laravel tutorial running on basic PHP.',
        'features' => ['Routing', 'Middleware', 'CSRF', 'Controllers', 'Requests', 'Responses', 'Views']
    ]);
});

$router->get('/user/{id}', function($id) {
    return "User ID: " . htmlspecialchars($id);
});

$router->get('/users', function() {
    $users = [
        ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
        ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
        ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com'],
    ];
    
    return view('users/index', [
        'users' => $users,
        'search' => $_GET['search'] ?? '',
        'page' => $_GET['page'] ?? 1
    ]);
});

$router->get('/users/{id}', function($id) {
    $user = [
        'id' => $id,
        'name' => 'User ' . $id,
        'email' => 'user' . $id . '@example.com',
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    if (isset($_GET['format']) && $_GET['format'] === 'json') {
        return json($user);
    }
    
    return view('users/show', ['user' => $user]);
});

$router->get('/about', function() {
    return view('about', ['name' => 'Laravel Tutorial']);
});

$router->get('/json-example', function() {
    return json([
        'message' => 'This is a JSON response',
        'status' => 'success',
        'data' => [
            'framework' => 'Laravel (Simulated)',
            'version' => '11.x',
            'timestamp' => date('c')
        ]
    ]);
});

// Handle the request
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$response = $router->handle($method, $path);

if ($response === null) {
    http_response_code(404);
    echo "<h1>404 Not Found</h1><p>Route not found: {$method} {$path}</p>";
} else {
    echo $response;
}
?>