<?php

//Obtiens les ID et le nom de toutes les listes créées et partagées avec l'utilisateur
//retourne un tableau qui contient un tableau pour chaque liste avec son ID et son nom
function GetLists(int $userID){
    $database = openDatabase();

    // récuperer les to do lists créées 
    $sql = "SELECT ID, name, creatorID FROM todoList WHERE creatorID=:id ;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':id', $userID, SQLITE3_TEXT);
    $result = $reponse->execute();

    // récuperer les to do lists partagées
    $sql = "SELECT ID, name, creatorID FROM todoList 
    INNER JOIN userID_todoID
    ON todoList.ID = userID_todoID.todoID
    WHERE userID_todoID.userID = :id;";

    $reponse2 = $database->prepare($sql);
    $reponse2->bindValue(':id', $userID, SQLITE3_TEXT);
    $result2 = $reponse2->execute();

    //si la request à fonctionné, remplir un tableau avec les resultats
    if ($reponse === FALSE && $reponse2 === FALSE) {
        echo "echec de la requet";

    } else {
        // echo "Listes obtenues";
        $data = array();

        while($test = $result->fetchArray(1)) {
            array_push($data, $test);
        }
        while($test = $result2->fetchArray(1)) {
            array_push($data, $test);
        }

        // echo var_dump($data[0]["name"]);
    }

    // Deconnexion de la bdd
    $database = null;
    
    return $data;
}

//Récupère les tâches, leur ID et leur status, contenues dans une liste
//retourne un tableau qui contient un tableau pour chaque tâche avec son nom, son isDone et son ID
function GetTasks(int $todolistID){
    $database = openDatabase();

    // récuperer les données 
    $sql = "SELECT ID, name, isDone FROM task WHERE listID=:id;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':id', $todolistID, SQLITE3_TEXT);
    $result = $reponse->execute();

    //si la request à fonctionné, remplir un tableau avec les resultats
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

function getCollabs(int $todoID){
    $database = openDatabase();

    // récuperer les données 
    $sql = "SELECT userID FROM userID_todoID WHERE todoID=:todoID;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':todoID', $todoID, SQLITE3_TEXT);
    $result = $reponse->execute();

    //si la request à fonctionné, remplir un tableau avec les resultats
    if ($reponse === FALSE) {
        echo "echec de la request";
    } else {       
        $data = array();
        while($test = $result->fetchArray(1)) {
            array_push($data, $test);
        }
    }
    
    $allNames = array();
    for($i = 0; $i < count($data);++$i){
        $sql = "SELECT name, email FROM user WHERE ID=:userID;";
        $reponse = $database->prepare($sql);
        $reponse->bindValue(':userID', $data[$i]["userID"], SQLITE3_TEXT);
        $result = $reponse->execute();
        array_push($allNames, $result->fetchArray());
    }

    // Deconnexion de la bdd
    $database = null;

    return $allNames;
}

// Choisir avec quoi on va récupérer nos infos : avec l'ID ou avec le mail
function GetInfosUser(string $emailUser = null, int $userID = null){
    $database = openDatabase();

    if($emailUser==null){
        $sql = "SELECT ID, email, name FROM user WHERE ID=:userID;";
        $reponse = $database->prepare($sql);
        $reponse->bindValue(':userID', $userID, SQLITE3_TEXT);
    } else {
        $sql = "SELECT ID, email, name FROM user WHERE email=:emailUser;";
        $reponse = $database->prepare($sql);
        $reponse->bindValue(':emailUser', $emailUser, SQLITE3_TEXT);
    }
    
    $result = $reponse->execute();

    if ($reponse === FALSE) {
        echo "echec de la request";
    } else {        
        $data = array();

        while($test = $result->fetchArray(1)) {
            array_push($data, $test);
        }
    }

    // Deconnexion de la bdd
    $database = null;

    return $data;
}


?>