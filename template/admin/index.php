<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <link rel="stylesheet" href="/style/admin/index.css">
</head>
<body>
<div class="container">
        <h1>Админ панель</h1>
    <table class="admin-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Заголовок</th>
            <th>Текст</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?php echo $article->id; ?></td>
                <td><?php echo htmlspecialchars($article->title); ?></td>
                <td><?php echo htmlspecialchars($article->content); ?></td>
                <td>
                    <a href="/admin/?page=EditArticle&id=<?php echo $article->id; ?>" class="edit-button">Изменить</a>
                    <a href="/admin/?page=DeleteArticle&id=<?php echo $article->id; ?>" class="delete-button">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="buttons-wrapper">
        <div class="add-article">
            <a href="/admin/?page=AddArticle" class="article-button">Добавить новость</a>
        </div>
        <div class="back-to-home">
            <a href="/" class="back-button">Вернуться на главную</a>
        </div>
    </div>
</div>
</body>
</html>