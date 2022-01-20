
<?php ob_start(); ?>

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
            </div>
            <div class="LogReg">

                <a class="alreadyRegistered" href="./login">Déjà inscrit ? <br> Connecte-toi</a>
                <div class="button_login">
                <input class="btn" type="submit" name="submit" value="Register">
                        <i class='bx bxs-user-account'></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</form>
    

<?php $mainContent = ob_get_clean(); ?>

<?php
    include "layout.php";
?>