<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление новости</title>
    <link rel="stylesheet" href="/style/admin/action/edit.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Добавление новости</h1>
    </header>
    <form method="post" action="">
        <table class="admin-table edit-form">
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>Заголовок</td>
                <td><input type="text" name="title" value=""></td>
            </tr>
            <tr>
                <td>Текст</td>
                <td><textarea name="content"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Добавить новость" class="save-button">
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
