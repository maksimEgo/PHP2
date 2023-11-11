<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование - <?php echo htmlspecialchars($article->title) ?></title>
    <link rel="stylesheet" href="/style/admin/action/edit.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Редактирование новости</h1>
    </header>
    <form method="post" action="">
        <table class="admin-table edit-form">
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td><input type="text" name="id" value="<?php echo htmlspecialchars($article->id); ?>" readonly></td>
            </tr>
            <tr>
                <td>Заголовок</td>
                <td><input type="text" name="title" value="<?php echo htmlspecialchars($article->title); ?>"></td>
            </tr>
            <tr>
                <td>Текст</td>
                <td><textarea name="content"><?php echo htmlspecialchars($article->content); ?></textarea></td>
            </tr>
            <tr>
                <td>Автор</td>
                <td>
                    <input type="hidden" name="author_id" value="<?php echo htmlspecialchars($article->author_id); ?>">
                    <?php echo htmlspecialchars($article->author->name); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Сохранить изменения" class="save-button">
                </td>
            </tr>
        </table>
    </form>
    <div class="back-to-home">
        <a href="/" class="back-button">Вернуться на главную</a>
    </div>
</div>
</body>
</html>
