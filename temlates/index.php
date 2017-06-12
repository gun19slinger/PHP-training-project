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
        .registration{
            display: block;
            text-align: center;
            text-decoration: none;
            color: deepskyblue;
        }
        .rss-block{
            width: 400px;
            margin: 10px auto;
            border: 1px solid crimson;
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
        .author{
            text-align: right;
        }
        .rss{
            display: block;
            width: 200px;
            text-align: center;
            padding: 10px 0;
            margin: 0 auto;
            color: orangered;
        }
    </style>
</head>
<body>
    <h1>News</h1>

    <a href="index.php?action=Registration" class="registration">Зарегистрироваться</a>

    <div class="rss-block">
        <a href="../admin/rss/rss.xml" class="rss">RSS</a>
        <form action="index.php?action=RSS" method="post">
            <label for="url" class="rss">Введите ссылку на сторонний RSS<input type="text" id="url" name="url" value=""></label><br>
        </form>
    </div>

    <?php foreach ($news as $val) {?>

        <article>
            <h3 class="title"><a href="index.php?action=OneNews&id=<?= $val->id;?>"><?= $val->title;?></a></h3>
            <p class="article"><?= mb_substr($val->article, 0, 200) . '...';?></p>
            <? if (!empty($val->author_id)): ?>
                <p class="author"><?= $val->getAuthorName();?></p>
            <? endif; ?>
        </article>
        <br>

    <? }?>

</body>
</html>
