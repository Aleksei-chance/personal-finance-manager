<?php

namespace App\Controllers;

use App\Services\Database;
use PDO;
use Exception;

class AuthController
{
    public function showRegisterForm()
    {
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function register()
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
}
