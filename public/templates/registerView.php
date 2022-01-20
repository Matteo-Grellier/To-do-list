
<?php ob_start(); ?>

<?php
    $title= "Register";
    require('../controllers/register.php');
    if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
        $response = register($_REQUEST['email'], $_REQUEST['password'], $_REQUEST['username']);
        if($response==0){
            header("Location:./login");
        } else{
            header("Location:./register". "?registered=" . $response);
        }
    }
?>

<form method="POST" id="form">
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
                </div>
            </div>

            <?php if(isset($_GET["registered"])): ?>
                    <?php if($_GET["registered"]==1):?>
                        <div class="errors" >Problème lié au serveur, l'inscription n'a pas fonctionné.</div>
                    <?php elseif($_GET["registered"]==2):?>
                        <div class="errors">Cet email existe déjà.</div>
                    <?php else: ?>
                        <div class="registered">Vous avez bien été enregistré.</div>
                    <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</form>
    

<?php $mainContent = ob_get_clean(); ?>

<?php
    include "layout.php";
?>