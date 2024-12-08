<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Регистрация</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Регистрация</h2>
        <form action="/register" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>

