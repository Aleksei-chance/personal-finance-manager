<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\TransactionController;
use App\Controllers\ReportController;

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
} else if ($uri === '/reports' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ReportController();
    $controller->index();
} else if ($uri === '/categories/edit' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new CategoryController();
    $controller->edit();
} elseif ($uri === '/categories/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new CategoryController();
    $controller->update();
} elseif ($uri === '/categories/delete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new CategoryController();
    $controller->delete();
} else {
    echo "404 Not Found";
}
