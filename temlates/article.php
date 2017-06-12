<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <style>
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
            color: crimson;
        }
        .article{
            text-align: justify;
        }
        .author{
            text-align: right;
        }
        a{
            text-align: left;
            color: crimson;
        }
    </style>
</head>
<body>
    <h1>One news</h1>

    <article>
        <h3 class="title"><?= $oneNews->title;?></h3>
        <p class="article"><?= $oneNews->article;?></p>
        <? if (!empty($oneNews->author_id)): ?>
            <p class="author"><?= $oneNews->getAuthorName();?></p>
        <? endif; ?>
        <a href="index.php">Вернуться на главную</a>
    </article>

</body>
</html>
