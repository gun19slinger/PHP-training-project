<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
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
    </style>
</head>
<body>

    <h1>Наши пользователи</h1>

    <?php foreach ($users as $user): ?>

        <article>
            <h3 class="title"><?= $user->name;?></h3>
            <p class="mail"><?= $user->email;?></p>
        </article>
        <br>

    <?php endforeach; ?>

</body>
</html>