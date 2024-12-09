<?php

namespace App\Controllers;

use App\Services\Database;
use PDO;

class CategoryController
{
    public function index(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM categories WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../Views/categories/index.php';
    }

    public function create(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO categories (user_id, name, type) VALUES (:user_id, :name, :type)");
        $stmt->execute([
            'user_id' => $_SESSION['user_id'],
            'name' => $_POST['name'],
            'type' => $_POST['type'],
        ]);

        header("Location: /categories");
    }

    public function edit(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $categoryId = $_GET['id'] ?? null;
        if (!$categoryId) {
            header("Location: /categories");
            exit;
        }

        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['id' => $categoryId, 'user_id' => $_SESSION['user_id']]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$category) {
            header("Location: /categories");
            exit;
        }

        require __DIR__ . '/../Views/categories/edit.php';
    }

    public function update(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $db = Database::connect();
        $stmt = $db->prepare("
            UPDATE
                categories
            SET
                name = :name,
                type = :type
            WHERE
                id = :id
              AND user_id = :user_id
        ");

        $stmt->execute([
            'id' => $_POST['id'],
            'user_id' => $_SESSION['user_id'],
            'name' => $_POST['name'],
            'type' => $_POST['type'],
        ]);

        header("Location: /categories");
    }

    public function delete(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM categories WHERE id = :id AND user_id = :user_id");
        $stmt->execute([
            'id' => $_GET['id'],
            'user_id' => $_SESSION['user_id'],
        ]);

        header("Location: /categories");
    }
}
