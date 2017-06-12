<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <style>
        body{
            background: mintcream;
        }
        h1, h2{
            text-align: center;
            color: crimson;
        }
        nav{
            text-align: center;
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
        .href{
            text-decoration: none;
            color: crimson;
            display: inline-block;
            padding: 10px 20px;
        }
        .change{
            text-decoration: none;
            color: mintcream;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>News</h1>

    <nav>
        <a class="href" href="admin.php?action=Users">Посмотреть пользователей сайта</a>
        <a class="href" href="admin.php?action=DataTable">Показать в виде таблицы</a>
        <a class="href insert" href="admin.php?action=Edit">Добавить статью</a>
    </nav>


    <?php foreach ($news as $val) {?>

        <article>
            <h3 class="title"><?= $val->title;?></h3>
            <p class="article"><?= $val->article;?></p>
            <? if (!empty($val->author_id)): ?>
                <p class="author"><?= $val->getAuthorName();?></p>
            <? endif; ?>
            <a class="change" href="admin.php?action=Edit&idForChange=<?= $val->id;?>">Править статью</a>
            <a class="change" href="admin.php?action=Save&idForDelete=<?= $val->id;?>">Удалить статью</a>
        </article>
        <br>

    <? }?>

</body>
</html>

