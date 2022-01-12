<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\static\css\connexion.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>Connexion</title>
</head>

<body>
    {{template "sidebar"}} {{template "header"}}

    
    <form action="/connexion" method="POST" id="form">
        <div class="connexion">
            <div class="login-form">
                <h1>Connexion</h1>

                <div class="textb">
                    <input type="username" name="Pseudo" required>
                    <div class="placeholder">Pseudo</div>
                </div>
                <div class="textb">
                    <label for="Password"></label>
                    <input type="password" required id="myInput" name="Password">
                    <div class="placeholder">Mot de passe</div>
                    <span onclick="showPassword()">
                        <div class="show-password fas fa-eye-slash" id="slash"></div>
                        <div class="show-password fas fa-eye" id="eye"></div>
                    </span>
                </div>
                <a class="createAccount" href="/register">Créer un compte</a>
                <div class="button_login">
                    <a class="btn" onclick="formSubmit()">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span> Login
                        <i class='bx bxs-log-in'></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</body>

</html>

<?php $mainContent = ob_get_clean(); ?>

<?php
    include "layout.php";
?>

