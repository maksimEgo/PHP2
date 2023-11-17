<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <link rel="stylesheet" href="/style/articles.css">
</head>
<body>
<div class="container">
    <h1>Новости</h1>
    <ul class="news-list">
        <?php foreach ($articles as $item): ?>
            <li class="news-item">
                <a href="/?page=article&id=<?php echo $item->id; ?>" class="news-link">
                    <h2 class="news-title"><?php echo htmlspecialchars($item->title); ?></h2>
                </a>
                <p class="news-content"><?php echo nl2br(htmlspecialchars($item->content)); ?></p>
                <p>Автор: <?php echo htmlspecialchars($item->author->name); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>