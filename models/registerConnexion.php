<?php

function register(string $emailEntry, string $passwordEntry, string $nameEntry):int{

    $bd = openDataBase();

    if(checkEmail($emailEntry)){
        return 2;
        // echo "ERREUR : L'EMAIL EST DÉJÀ PRÉSENT DANS LA BASE DE DONNÉES.\n";
    } else{
        $statement = $bd->prepare('INSERT INTO user (email, password, name) VALUES (:emailEntry, :passwordEntry, :nameEntry)');
    
        $statement->bindValue(':emailEntry', $emailEntry);
        $statement->bindValue(':passwordEntry',$passwordEntry);
        $statement->bindValue(':nameEntry',$nameEntry);

        $result = $statement->execute();

        if($result ===FALSE){
            return 1;
            // echo "la requête n'a pas fonctionné\n";
        } else{
            return 0;
            // echo "L'utilisateur a bien été ajouté\n";
        }
        $statement->close();
    }

    $bd=null;
}


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

?>