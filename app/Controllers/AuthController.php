<?php

namespace App\Controllers;

use App\Services\Database;
use PDO;
use Exception;

class AuthController
{
    public function showRegisterForm(): void
    {
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function register(): void
    {
        try {
            $db = Database::connect();

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);

            if ($stmt->fetch()) {
                die('Email уже используется!');
            }

            $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            echo "Регистрация успешна! <a href='/login'>Войти</a>";
        } catch (Exception $e) {
            die("Ошибка регистрации: " . $e->getMessage());
        }
    }

    public function showLoginForm(): void
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {
        try {
            $db = Database::connect();

            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$user || !password_verify($password, $user['password'])) {
                die("Неверный email или пароль.");
            }

            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            echo "Добро пожаловать, {$user['name']}! <a href='/logout'>Выйти</a>";
        } catch (Exception $e) {
            die("Ошибка авторизации: " . $e->getMessage());
        }
    }
}
