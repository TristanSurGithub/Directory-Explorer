<?php
$directories = [];
if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry != "index.php") {
            $directories[] = $entry;
        }
    }
    closedir($handle);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Project</title>
</head>
<body>
<h1>Mes Projets</h1>
<table>
    <tbody>
    <?php foreach ($directories as $directory) :
        ?>
        <tr>
            <td>
                <a class="card" href=<?= $directory ?>><?= basename($directory, '.php') ?></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>

<style>
    html {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
    }

    body {
        color: #fff;
        background: #36393f;
    }

    h1 {
        text-align: center;
    }

    table {
        margin: 0 auto;
    }

    tr {
        display: block;
        margin: 3em;
    }

    .card {
        display: block;
        width: 10em;
        border-radius: 10px;
        padding: 20px 50px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        text-decoration: none;
        color: #fff;
        background: #535353;
    }

    .card:first-child {
        margin-top: initial;
    }

    .card:hover {
        transition-duration: 1s;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }
</style>