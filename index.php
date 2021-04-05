<?php
$msg = null;
$error = null;
$directories = [];
if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
            $directories[] = $entry;
        }
    }
    closedir($handle);
}

if (!empty($_POST['ipt-git']) && isset($_POST['ipt-git'])) {
    $value_ipt_git = $_POST['ipt-git'];
    exec('git clone "' . $value_ipt_git . '" 2>&1', $output);
    $name_with_git = substr(strrchr($value_ipt_git, "/"), 1);
    $name_not_git = substr($name_with_git, 0, -4);
    $errors = [
        'already_exists' => 'fatal: destination path \'' . $name_not_git . '\' already exists and is not an empty directory.'
    ];
    switch ($output[0]) {
        case $errors['already_exists']:
            $error = $errors['already_exists'];
            break;
        default :
            $error = null;
            echo $output;
            break;
    }
}
if (!empty($_POST['delete_folder']) && !empty($_POST['name_folder'])){
    $name_folder = $_POST['name_folder'];
    exec('rm -r "' . $name_folder . '" 2>&1', $output_deletion);
    $msg = 'Le dossier "' . $_POST['name_folder'] . '" a été supprimé';
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes Projets</title>
</head>
<body>
<h1>Mes Projets</h1>
<p><?= $msg ?></p>
<table>
    <tbody>
    <?php foreach ($directories as $directory) :
        ?>
        <tr>
            <td>
                <div class="card-folder">
                    <a href=<?= $directory ?>><?= basename($directory, '.php') ?></a>
                    <form action="index.php" method="post">
                        <input type="hidden" name="name_folder" value="<?= $directory ?>">
                        <input type="submit" name="delete_folder" value="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer le dossier <?= $directory ?> ?')">
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="widget-command-git">
    <p class="error"><?= $error ?></p>
    <form action="index.php" method="post">
        <label for="ipt-git">Cloner un projet git :</label>
        <input type="text" name="ipt-git" placeholder="https://github.com/TristanSurGithub/mon-projet.git">
        <input type="submit" value="valider">
    </form>
</div>
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

    .card-folder {
        width: 150px;
        height: 105px;
        margin: 0 auto;
        margin-top: 50px;
        padding: 16px;
        position: relative;
        background-color: #708090;
        border-radius: 0 6px 6px 6px;
        box-shadow: 4px 4px 7px rgba(0, 0, 0, 0.59);
    }

    .card-folder:before {
        content: '';
        width: 50%;
        height: 12px;
        border-radius: 20px 20px 0 0;
        background-color: #708090;
        position: absolute;
        top: -12px;
        left: 0px;
    }

    .card-folder a {
        text-decoration: none;
        color: #fff;
    }

    .card-folder:first-child {
        margin-top: initial;
    }

    .card-folder:hover {
        transition-duration: 1s;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    .widget-command-git {
        position: fixed;
        padding: 10px;
        width: 300px;
        right: 10px;
        bottom: 0;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        background: #000;
    }
</style>