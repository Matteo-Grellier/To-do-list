<?php
    session_start();
?>
<?php
    require("includes/headerView.php");
    require("includes/footerView.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <!-- <link type="text/css" rel="stylesheet" href="../static/css/style.css"/> -->
        <link type="text/css" rel="stylesheet" href="public/static/css/style.css"/>
        <link href="public\static\css\index.css" rel="stylesheet" type="text/css">
        <link href="public\static\css\connexion.css" rel="stylesheet" type="text/css">

    </head>
        
    <body>
        <header>
            <?= $headerContent ?>
        </header>
        <main>
            <?= $mainContent ?>
        </main>
        <footer>
            <?= $footerContent ?>
        </footer>
    </body>
</html>