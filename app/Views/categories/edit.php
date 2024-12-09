<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Редактировать категорию</title>
</head>
<body>
<div class="container mt-5">
    <h2>Редактировать категорию</h2>

    <form action="/categories/update" method="POST">
        <input type="hidden" name="id" value="<?= $category['id'] ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Название категории</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($category['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Тип</label>
            <select name="type" id="type" class="form-select" required>
                <option value="income" <?= $category['type'] === 'income' ? 'selected' : '' ?>>Доход</option>
                <option value="expense" <?= $category['type'] === 'expense' ? 'selected' : '' ?>>Расход</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="/categories" class="btn btn-secondary">Отмена</a>
    </form>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>

