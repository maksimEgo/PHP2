<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
    <link rel="stylesheet" href="/style/error.css">
</head>
<body>
<div class="container">
    <h1>Произошла ошибка</h1>
    <p><?php echo htmlspecialchars($errorMessage) ?></p>
    <a href="/">Вернуться на главную</a>
</div>
</body>
</html>

