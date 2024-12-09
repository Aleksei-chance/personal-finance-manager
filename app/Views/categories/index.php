<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Категории</title>
</head>
<body>
<div class="container mt-5">
    <h2>Управление категориями</h2>

    <form action="/categories/create" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="name" class="form-label">Название категории</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Тип</label>
            <select name="type" id="type" class="form-select" required>
                <option value="income">Доход</option>
                <option value="expense">Расход</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Добавить категорию</button>
    </form>

    <h3>Ваши категории</h3>
    <ul class="list-group">
        <?php foreach ($categories as $category): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($category['name']) ?>
                <span class="badge bg-secondary"><?= $category['type'] === 'income' ? 'Доход' : 'Расход' ?></span>
                <div>
                    <a href="/categories/edit?id=<?= $category['id'] ?>" class="btn btn-sm btn-warning">Редактировать</a>
                    <a href="/categories/delete?id=<?= $category['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
