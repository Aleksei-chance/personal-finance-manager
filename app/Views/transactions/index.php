<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Финансовые операции</title>
</head>
<body>
<div class="container mt-5">
    <h2>Финансовые операции</h2>

    <form action="/transactions/create" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select name="category_id" id="category" class="form-select" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>">
                        <?= htmlspecialchars($category['name']) ?> (<?= $category['type'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Сумма</label>
            <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Дата</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить операцию</button>
    </form>

    <h3>Ваши операции</h3>
    <ul class="list-group">
        <?php foreach ($transactions as $transaction): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($transaction['description']) ?> - <?= $transaction['amount'] ?> (<?= $transaction['date'] ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
