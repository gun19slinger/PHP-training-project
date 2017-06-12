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
        form{
            width: 500px;
            border: 2px solid deepskyblue;
            margin: 0 auto;
            padding: 10px;
            position: relative;
        }
        label{
            display: block;
            width: 100px;
        }
        button{
            position: absolute;
            right: 20px;
            bottom: 10px;
        }
        input, textarea{
            width: 300px;
        }
    </style>
</head>
<body>

    <h1><?= $headline;?> запись</h1>
    
    <form action="admin.php?action=Save" method="post">
        <label for="title">Заголовок <input type="text" id="title" name="title" value="<?= $news->title;?>" placeholder="" maxlength="255"></label><br>
        <label for="article">Статья <textarea id="article" name="article" placeholder="" cols="30" rows="10"><?= $news->article;?></textarea></label><br>
        <label for="author">Автор <input type="text" id="author" name="author_name" value="<?= (!empty($news->author_id)) ? $news->getAuthorName() : '';?>" placeholder="" maxlength="100"></label>
        <input type="hidden" name="id" value="<?= $news->id;?>">        
        <button type="submit" name="submit">Добавить</button>
    </form>

</body>
</html>
