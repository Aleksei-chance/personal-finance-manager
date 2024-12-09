<?php

namespace App\Controllers;

use App\Services\Database;
use PDO;

class TransactionController
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

        $stmt = $db->prepare("
            SELECT
                transactions.*,
                categories.name AS category_name,
                categories.type AS category_type
            FROM
                transactions
                JOIN
                    categories
                ON transactions.category_id = categories.id
            WHERE
                transactions.user_id = :user_id
            ORDER BY
                transactions.date DESC
        ");
        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../Views/transactions/index.php';
    }

    public function create(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $db = Database::connect();

        $stmt = $db->prepare("
            INSERT INTO
                transactions (user_id, category_id, amount, description, date)
            VALUES
                (:user_id, :category_id, :amount, :description, :date)
        ");
        $stmt->execute([
            'user_id' => $_SESSION['user_id'],
            'category_id' => $_POST['category_id'],
            'amount' => $_POST['amount'],
            'description' => $_POST['description'] ?? null,
            'date' => $_POST['date'],
        ]);

        header("Location: /transactions");
    }
}
