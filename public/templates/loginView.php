<?php
$title= "Login";
 require("../controllers/login.php");
?>
<?php ob_start(); 
?>
<?php if(isset($_SESSION['ID'])):?>
        <form class="deconnexion-btn" method="POST">
        <button type="submit" name="deconnexion">Déconnexion</button>
        </form>
        
<?php else:?>
    <form method="POST" id="form">
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

                <?php if(isset($_GET["Erreur"])): ?>
                    <?php if($_GET["Erreur"]==1):?>
                        <div class="errors" >MOT DE PASSE INCORRECT</div>
                    <?php elseif($_GET["Erreur"]==2):?>
                        <div class="errors">MAIL NON TROUVÉ</div>
                    <?php else: ?>
                        <div class="errors">Il y a une erreur</div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>

    </form>
    


<?php endif;?>



<?php $mainContent = ob_get_clean(); ?>

<?php

    include "layout.php";
?>

