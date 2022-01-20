<?php
    session_start();
?>

<?php
require("../../models/registerConnexion.php");
require("../../models/getinfos.php"); 
include '../../models/utils.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["Email"])) {
        $Erreur = connexion($_POST["Email"], $_POST["Password"]);
        if($Erreur==0){
            $userInfos = GetInfosUser($_POST["Email"], null);
            $_SESSION['name'] = $userInfos[0]["name"];
            $_SESSION['ID'] = $userInfos[0]["ID"];
            $_SESSION['email'] = $userInfos[0]["email"];
            header("Location:../../home");

        } else{
            header("Location:./login". "?Erreur=" . $Erreur);
        }
    }

    if(isset($_POST["deconnexion"])) {
        $_SESSION['ID'] = null;
        session_destroy();
        header("Location:./login");
    }

}

?>