<?php
 require("../controllers/login.php");
?>
<?php ob_start(); 
?>
    <?php if(isset($_SESSION['ID'])):?>
        <form method="POST">
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
                    <input type="password" required id="myInput" name="Password">
                    <div class="placeholder">Mot de passe</div>
                    <span onclick="showPassword()">
                        <div class="show-password fas fa-eye-slash" id="slash"></div>
                        <div class="show-password fas fa-eye" id="eye"></div>
                    </span>
                </div>
                <a class="createAccount" href="./register">Créer un compte</a>
                <button type='submit' class="button_login">
                    <a class="btn">        
                            TEST
                            </a>
                        <i class='bx bxs-log-in'></i>
                </button>
                <!-- <div class="button_login">
                    <a class="btn" onclick="formSubmit()">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span> Login
                        <i class='bx bxs-log-in'></i>
                    </a>
                </div> -->

            </div>
        </div>
        <!-- <input type='submit'>LOGIN</input> -->


    </form>
    <?php if($_GET["Erreur"]==null):?>
            <p>pas d'erreur</p>
    <?php elseif($_GET["Erreur"]==1):?>
        <p>MOT DE PASSE INCORRECT</p>
    <?php elseif($_GET["Erreur"]==2):?>
        <p>MAIL NON TROUVÉ</p>
    <?php else: ?>
        <p><?=$_GET["Erreur"]?></p>
    <?php endif; ?>


    <?php endif;?>



<?php $mainContent = ob_get_clean(); ?>

<?php
    include "layout.php";
?>

