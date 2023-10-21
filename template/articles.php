<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .header {
            padding: 20px 0;
        }
        .news-list {
            list-style: none;
            padding: 0;
        }
        .news-item {
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
        .news-item:last-child {
            border-bottom: none;
        }
        .news-title {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .news-content {
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Новости</h1>
    </header>
    <ul class="news-list">
        <?php foreach ($articles as $item): ?>
            <li class="news-item">
                <a href="/article.php?id=<?php echo $item->id; ?>">
                    <h2 class="news-title"><?php echo htmlspecialchars($item->title); ?></h2>
                </a>
                <p class="news-content"><?php echo nl2br(htmlspecialchars($item->content)); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>

