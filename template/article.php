<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article->title) ?></title>
    <link rel="stylesheet" href="/style/article.css">
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Новости</h1>
    </header>
    <div class="news-item">
        <h2 class="news-title"><?php echo htmlspecialchars($article->title) ?></h2>
        <p class="news-content"><?php echo nl2br(htmlspecialchars($article->content)); ?></p>
    </div>
    <div class="back-to-home">
        <a href="/" class="back-button">Вернуться на главную</a>
    </div>
</div>
</body>
</html>

