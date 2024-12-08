<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new AuthController();
    $controller->showRegisterForm();
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $controller->register();
} else {
    echo "404 Not Found";
}
