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

  

    <form action="/to-do-list/login" method="POST" id="form" name="login">
        <div class="connexion">
            <div class="login-form">
                <h1>Connexion</h1>

                <div class="textb">
                    <input type="username" name="username" required>
                    <div class="placeholder">Pseudo</div>
                </div>
                <div class="textb">
                    <label for="Password"></label>
                    <input type="password" id="myInput" name="Password" required>
                    <div class="placeholder">Mot de passe</div>
                    <span onclick="showPassword()">
                        <div class="show-password fas fa-eye-slash" id="slash"></div>
                        <div class="show-password fas fa-eye" id="eye"></div>
                    </span>
                </div>
                <a class="createAccount" href="/To-do-list/register">Créer un compte</a>
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
    <script src="public\static\js\login.js"></script>

</body>



</html>

<?php $mainContent = ob_get_clean(); ?>

<?php

    include "layout.php";
?>

