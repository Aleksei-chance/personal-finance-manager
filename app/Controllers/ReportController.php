<?php

namespace App\Controllers;

use App\Services\Database;
use PDO;

class ReportController
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

        $startDate = $_GET['start_date'] ?? null;
        $endDate = $_GET['end_date'] ?? null;
        $selectedCategory = $_GET['category_id'] ?? null;

        $query = "
            SELECT
                transactions.*,
                categories.name AS category_name
            FROM
                transactions
                JOIN
                    categories
                ON
                    transactions.category_id = categories.id
            WHERE
                transactions.user_id = :user_id
        ";

        $params = ['user_id' => $_SESSION['user_id']];

        if ($startDate) {
            $query .= " AND transactions.date >= :start_date";
            $params['start_date'] = $startDate;
        }

        if ($endDate) {
            $query .= " AND transactions.date <= :end_date";
            $params['end_date'] = $endDate;
        }

        if ($selectedCategory) {
            $query .= " AND transactions.category_id = :category_id";
            $params['category_id'] = $selectedCategory;
        }

        $query .= " ORDER BY transactions.date DESC";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $filteredTransactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("
            SELECT
                SUM(CASE WHEN categories.type = 'income' THEN transactions.amount ELSE 0 END) AS total_income,
                SUM(CASE WHEN categories.type = 'expense' THEN transactions.amount ELSE 0 END) AS total_expense
            FROM
                transactions
                JOIN
                    categories
                ON
                    transactions.category_id = categories.id
            WHERE
                transactions.user_id = :user_id
        ");

        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $totals = $stmt->fetch(PDO::FETCH_ASSOC);

        $totalIncome = $totals['total_income'] ?? 0;
        $totalExpense = $totals['total_expense'] ?? 0;
        $balance = $totalIncome - $totalExpense;

        require __DIR__ . '/../Views/reports/index.php';
    }
}
