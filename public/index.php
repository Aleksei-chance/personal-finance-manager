<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\TransactionController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new AuthController();
    $controller->showRegisterForm();
} else if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $controller->register();
} else if ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new AuthController();
    $controller->showLoginForm();
} else if ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $controller->login();
} else if ($uri === '/categories' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new CategoryController();
    $controller->index();
} else if ($uri === '/categories/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new CategoryController();
    $controller->create();
} else if ($uri === '/transactions' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new TransactionController();
    $controller->index();
} else if ($uri === '/transactions/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TransactionController();
    $controller->create();
} else {
    echo "404 Not Found";
}
