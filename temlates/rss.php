<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <style>
        body{
            background: mintcream;
        }
        h1{
            text-align: center;
            color: crimson;
        }
        article{
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: deepskyblue;
        }
        .title{
            text-align: center;
        }
        .title a{
            color: crimson;
            text-decoration: none;
            width: 100%;
            height: 100%;
        }
        .article{
            text-align: justify;
        }
        .return{
            display: block;
            padding: 0 0 10px 0;
            text-align: center;
            color: crimson;
        }
    </style>
</head>
<body>

    <h1><?= $rss_data['title'];?></h1>

    <a href="index.php" class="return">Вернуться на главную</a>

    <?php foreach ($rss_data['items'] as $item): ?>

        <article>
            <h3 class="title"><a href="<?= $item['link'];?>"><?= $item['title'];?></a></h3>
            <p><?= $item['pubDate'];?></p>
            <p class="article"><?= $item['description'];?></p>
        </article>
        <br>

    <?php endforeach;?>

</body>
</html>
