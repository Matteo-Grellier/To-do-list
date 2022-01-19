<?php

// include 'utils.php';

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

register("olivia@gmail.com", "olivia", "Olivia Jaguelin");

function connexion(string $emailConnexion, string $passwordConnexion){
    $bd = openDataBase();

    if(checkEmail($emailConnexion)){
        echo "Compte trouvé !\n";
        $statement = $bd->prepare("SELECT password FROM user WHERE email = :emailConnexion");
        $statement->bindValue(':emailConnexion', $emailConnexion);
        $result = $statement->execute();
    
        if(($result->fetchArray())[0] == $passwordConnexion){
            echo "Vous êtes connectés\n";
        } else{
            echo "MOT DE PASSE INCORRECT\n";
        }
        $statement->close();
    
    } else{
        echo "Error: Ce mail est introuvable\n";
    }
    $bd =null;
}

// connexion("olivia@gmail.com", "1234");


?>