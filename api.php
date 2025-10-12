<?php
/**
 * Laravel-style API Backend
 * Complete CRUD API for Users with JSON responses
 */

// Enable CORS for frontend requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header('Content-Type: application/json');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Simple database simulation using JSON file
$db_file = 'users_db.json';

// Initialize database if it doesn't exist
if (!file_exists($db_file)) {
    $initial_data = [
        ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'admin', 'created_at' => date('Y-m-d H:i:s')],
        ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'user', 'created_at' => date('Y-m-d H:i:s')],
        ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'user', 'created_at' => date('Y-m-d H:i:s')]
    ];
    file_put_contents($db_file, json_encode($initial_data, JSON_PRETTY_PRINT));
}

// Helper functions
function loadUsers() {
    global $db_file;
    $data = file_get_contents($db_file);
    return json_decode($data, true) ?: [];
}

function saveUsers($users) {
    global $db_file;
    file_put_contents($db_file, json_encode($users, JSON_PRETTY_PRINT));
}

function findUserById($id) {
    $users = loadUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

function validateUser($data) {
    $errors = [];
    
    if (empty($data['name'])) {
        $errors['name'] = 'Name is required';
    } elseif (strlen($data['name']) > 255) {
        $errors['name'] = 'Name must not exceed 255 characters';
    }
    
    if (empty($data['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please provide a valid email address';
    }
    
    if (empty($data['role'])) {
        $errors['role'] = 'Role is required';
    } elseif (!in_array($data['role'], ['admin', 'user', 'moderator'])) {
        $errors['role'] = 'Role must be admin, user, or moderator';
    }
    
    return $errors;
}

function jsonResponse($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit();
}

// Parse request
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/api.php', '', $path);

// Route handling
switch ($method) {
    case 'GET':
        if ($path === '' || $path === '/') {
            // GET /api/users - List all users
            $users = loadUsers();
            jsonResponse([
                'status' => 'success',
                'message' => 'Users retrieved successfully',
                'data' => $users,
                'total' => count($users)
            ]);
        } elseif (preg_match('/^\/(\d+)$/', $path, $matches)) {
            // GET /api/users/{id} - Get specific user
            $id = (int)$matches[1];
            $user = findUserById($id);
            
            if ($user) {
                jsonResponse([
                    'status' => 'success',
                    'message' => 'User retrieved successfully',
                    'data' => $user
                ]);
            } else {
                jsonResponse([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }
        }
        break;
        
    case 'POST':
        if ($path === '' || $path === '/') {
            // POST /api/users - Create new user
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                jsonResponse([
                    'status' => 'error',
                    'message' => 'Invalid JSON data'
                ], 400);
            }
            
            $errors = validateUser($input);
            if (!empty($errors)) {
                jsonResponse([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $errors
                ], 422);
            }
            
            // Check if email already exists
            $users = loadUsers();
            foreach ($users as $user) {
                if ($user['email'] === $input['email']) {
                    jsonResponse([
                        'status' => 'error',
                        'message' => 'Email already exists'
                    ], 409);
                }
            }
            
            // Create new user
            $newUser = [
                'id' => count($users) > 0 ? max(array_column($users, 'id')) + 1 : 1,
                'name' => $input['name'],
                'email' => $input['email'],
                'role' => $input['role'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $users[] = $newUser;
            saveUsers($users);
            
            jsonResponse([
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $newUser
            ], 201);
        }
        break;
        
    case 'PUT':
        if (preg_match('/^\/(\d+)$/', $path, $matches)) {
            // PUT /api/users/{id} - Update user
            $id = (int)$matches[1];
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                jsonResponse([
                    'status' => 'error',
                    'message' => 'Invalid JSON data'
                ], 400);
            }
            
            $users = loadUsers();
            $userIndex = -1;
            
            foreach ($users as $index => $user) {
                if ($user['id'] == $id) {
                    $userIndex = $index;
                    break;
                }
            }
            
            if ($userIndex === -1) {
                jsonResponse([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }
            
            $errors = validateUser($input);
            if (!empty($errors)) {
                jsonResponse([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $errors
                ], 422);
            }
            
            // Check if email already exists (excluding current user)
            foreach ($users as $user) {
                if ($user['email'] === $input['email'] && $user['id'] != $id) {
                    jsonResponse([
                        'status' => 'error',
                        'message' => 'Email already exists'
                    ], 409);
                }
            }
            
            // Update user
            $users[$userIndex]['name'] = $input['name'];
            $users[$userIndex]['email'] = $input['email'];
            $users[$userIndex]['role'] = $input['role'];
            $users[$userIndex]['updated_at'] = date('Y-m-d H:i:s');
            
            saveUsers($users);
            
            jsonResponse([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $users[$userIndex]
            ]);
        }
        break;
        
    case 'DELETE':
        if (preg_match('/^\/(\d+)$/', $path, $matches)) {
            // DELETE /api/users/{id} - Delete user
            $id = (int)$matches[1];
            $users = loadUsers();
            
            $userIndex = -1;
            foreach ($users as $index => $user) {
                if ($user['id'] == $id) {
                    $userIndex = $index;
                    break;
                }
            }
            
            if ($userIndex === -1) {
                jsonResponse([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }
            
            $deletedUser = $users[$userIndex];
            array_splice($users, $userIndex, 1);
            saveUsers($users);
            
            jsonResponse([
                'status' => 'success',
                'message' => 'User deleted successfully',
                'data' => $deletedUser
            ]);
        }
        break;
        
    default:
        jsonResponse([
            'status' => 'error',
            'message' => 'Method not allowed'
        ], 405);
}

// If no route matched
jsonResponse([
    'status' => 'error',
    'message' => 'Route not found'
], 404);
?>