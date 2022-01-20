<?php

include 'utils.php';

function register(string $emailEntry, string $passwordEntry, string $nameEntry){

    $bd = openDataBase();

    if(checkEmail($emailEntry)){
        echo "ERREUR : L'EMAIL EST DÉJÀ PRÉSENT DANS LA BASE DE DONNÉES.\n";
    } else{
        $statement = $bd->prepare('INSERT INTO user (email, password, name) VALUES (:emailEntry, :passwordEntry, :nameEntry)');
    
        $statement->bindValue(':emailEntry', $emailEntry);
        $statement->bindValue(':passwordEntry',$passwordEntry);
        $statement->bindValue(':nameEntry',$nameEntry);

        $result = $statement->execute();

        if($result ===FALSE){
            echo "la requête n'a pas fonctionné\n";
        } else{
            echo "L'utilisateur a bien été ajouté\n";
        }
        $statement->close();
    }

    $bd=null;
}

// register("olivia@gmail.com", "olivia", "Olivia Jaguelin");

function connexion(string $emailConnexion, string $passwordConnexion):int{
    $bd = openDataBase();

    if(checkEmail($emailConnexion)){
        $statement = $bd->prepare("SELECT password FROM user WHERE email = :emailConnexion");
        $statement->bindValue(':emailConnexion', $emailConnexion);
        $result = $statement->execute();
    
        if(($result->fetchArray())[0] == $passwordConnexion){
            //Connecté
            return 0;
        } else{
            //Mot de passe incorrect
            return 1;
        }
        $statement->close();
    
    } else{
        // Email incorrect
        return 2;
    }
    $bd =null;
}
function GetInfosUser(string $emailUser){
    $database = openDatabase();

    // récuperer les données 
    $sql = "SELECT ID, email, name FROM user WHERE email=:emailUser;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':emailUser', $emailUser, SQLITE3_TEXT);
    $result = $reponse->execute();

    //si la request a fonctionné, remplir un tableau avec les resultats
    if ($reponse === FALSE) {
        echo "echec de la request";
    } else {
        // echo "tâches obtenues";
        
        $data = array();

        while($test = $result->fetchArray(1)) {
            array_push($data, $test);
        }
    }

    // Deconnexion de la bdd
    $database = null;

    return $data;
}
// connexion("olivia@gmail.com", "1234");


?>