<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DataTable</title>
    <style>
        body {
            background: mintcream;
        }

        h1{
            text-align: center;
            color: crimson;
        }
        
        .href{
            text-decoration: none;
            color: crimson;
            display: block;
            text-align: center;
            padding: 10px 20px;
        }

        table {
            width: 100%;
            border-spacing: inherit;
            border: 1px solid deepskyblue;
        }

        article {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: deepskyblue;
        }

        .title {
            width: 30%;
        }

        .article {
            width: 55%;
        }

        .author {
            width: 15%;
        }

        th, td {
            border: 1px solid deepskyblue;
            padding: 10px;
            background: silver;
        }
    </style>
</head>
<body>

<h1>News</h1>

<a class="href" href="admin.php">Вернуться на главную</a>

<table>
    <thead>
    <tr>
        <th class="title">Заголовок</th>
        <th class="article">Статья</th>
        <th class="author">Автор</th>
    </tr>
    </thead>
    <tbody>
        <?foreach ($table as $line): ?>
            <tr>
                <td><?= $line[0];?></td>
                <td><?= $line[1];?></td>
                <td><?= $line[2];?></td>
            </tr>
        <?endforeach; ?>
    </tbody>
</table>

</body>
</html>

