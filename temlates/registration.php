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
            width: 400px;
            border: 2px solid deepskyblue;
            margin: 0 auto;
            padding: 10px;
            position: relative;
        }
        label{
            display: block;
            width: 200px;
        }
        button{
            margin-top: 10px;
        }
        input{
            width: 300px;
        }
        img{
            margin: 10px 0 0 0;
        }
    </style>
</head>
<body>

    <h1>Регистрация</h1>

    <form action="index.php?action=SaveUser" method="post">
        <label for="name">Имя <input type="text" id="name" name="name"></label><br>
        <label for="email">Email<input type="email" id="email" name="email" value=""></label>
        <img src="../inc/captcha.jpg" alt="captcha">
        <label for="captcha">Введите текст с картинки<input type="text" id="captcha" name="captcha" value=""></label>
        <button type="submit" name="submit">Добавить</button>
    </form>

</body>
</html>
