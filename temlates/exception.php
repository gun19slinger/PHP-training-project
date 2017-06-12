<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <style>
        body{
            background: lightcyan;
        }
        h1{
            text-align: center;
            color: crimson;
        }
        .href{
            width: 500px;
            margin: 0 auto;
        }
        a{
            color: crimson;
            text-decoration: none;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php if (!empty($exceptions)) {
        foreach ($exceptions as $exception): ?>
            <h1><?= $exception->getMessage();?></h1>
        <?php endforeach;
    } elseif (!empty($operation)) { ?>
        <h1><?= $operation;?></h1>
    <?php } ?>

    <div class="href">
        <a href="<?= $_SERVER['HTTP_REFERER'];?>">Вернуться на страницу формы</a><br>
        <a href="index.php" >Вернуться на главную</a><br>
        <a href="admin.php">Вернуться на страницу администратора</a>
    </div>

</body>
</html>
