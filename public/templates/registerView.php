<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\static\css\register.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>Inscription</title>
</head>

<body>




    <?php
        require('../controllers/register.php');
        if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
            register($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password']);
        }
    ?>




    <form action="/to-do-list/register" method="POST" id="form">
        <div class="connexion">
            <div class="login-form">
                <h1>Inscription</h1>
                <div class="textb">

                    <input type="text" name="username" required>

                    <div class="placeholder">Pseudo</div>
                </div>
                <div class="textb">
                    <input type="text" name="email" required value=> 

                    <div class="placeholder">Email</div>
                </div>
                <div class="textb">
                    <input type="password" required id="myInput" name="password">
                    <div class="placeholder">Mot de passe</div>
                    <span onclick="showPassword()">
                        <div class="show-password fas fa-eye-slash" id="slash"></div>
                        <div class="show-password fas fa-eye" id="eye"></div>
                    </span>
                </div>
                <div class="textb">
                    <input type="password" required id="myInput2" name="ConfirmPassword">
                    <div class="placeholder">Confirmation du mot de passe</div>
                    <span onclick="showPasswordConfirm()">
                        <div class="show-password fas fa-eye-slash" id="slash2"></div>
                        <div class="show-password fas fa-eye" id="eye2"></div>
                    </span>
                </div>

                <div class="LogReg">

                    <a class="alreadyRegistered" href="/To-do-list/login">Déjà inscrit ? <br> Connecte-toi</a>
                    <div class="button_login">
                    <input class="btn" type="submit" name="submit" value="Register">
                            <i class='bx bxs-user-account'></i>
                        </a>
                    </div>
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