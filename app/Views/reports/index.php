<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Аналитика</title>
</head>
<body>
<div class="container mt-5">
    <h2>Аналитика</h2>

    <div class="mb-4">
        <h4>Общая информация</h4>
        <p><strong>Общий доход:</strong> <?= number_format($totalIncome, 2) ?> руб.</p>
        <p><strong>Общий расход:</strong> <?= number_format($totalExpense, 2) ?> руб.</p>
        <p><strong>Баланс:</strong> <?= number_format($balance, 2) ?> руб.</p>
    </div>

    <form method="GET" action="/reports" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Начальная дата</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= htmlspecialchars($startDate) ?>">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Конечная дата</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="<?= htmlspecialchars($endDate) ?>">
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label">Категория</label>
                <select name="category_id" id="category" class="form-select">
                    <option value="">Все</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $selectedCategory ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Применить фильтр</button>
    </form>

    <h4>Операции</h4>
    <ul class="list-group">
        <?php foreach ($filteredTransactions as $transaction): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($transaction['description']) ?> - <?= $transaction['amount'] ?> руб.
                (<?= $transaction['date'] ?>, <?= htmlspecialchars($transaction['category_name']) ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
