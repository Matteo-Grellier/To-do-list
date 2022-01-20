<?php
 require("../controllers/login.php");
?>
<?php ob_start(); 
?>
<?php if(isset($_SESSION['ID'])):?>
        <form class="deconnexion-btn" method="POST">
        <button type="submit" name="deconnexion">Déconnexion</button>
        </form>
        
<?php else:?>
    <form action="./public/controllers/login.php" method="POST" id="form">
        <div class="connexion">
            <div class="login-form">
                <h1>Connexion</h1>

                <div class="textb">
                    <input type="email" name="Email" required>
                    <div class="placeholder">Email</div>
                </div>
                <div class="textb">
                    <label for="Password"></label>
                    <input type="password" id="myInput" name="Password" required>
                    <div class="placeholder">Mot de passe</div>
                </div>
                <a class="createAccount" href="./register">Créer un compte</a>
                <button type='submit' class="button_login">
                    Login
                </button>
            </div>
        </div>

    </form>
    <?php if(isset($_GET["Erreur"])): ?>
        <?php if($_GET["Erreur"]==null):?>
                <p>pas d'erreur</p>
        <?php elseif($_GET["Erreur"]==1):?>
            <p>MOT DE PASSE INCORRECT</p>
        <?php elseif($_GET["Erreur"]==2):?>
            <p>MAIL NON TROUVÉ</p>
        <?php else: ?>
            <p><?=$_GET["Erreur"]?></p>
        <?php endif; ?>
    <?php endif; ?>


<?php endif;?>



<?php $mainContent = ob_get_clean(); ?>

<?php

    include "layout.php";
?>

