<?php

//Obtiens les ID de toutes les listes créées et partagées avec l'utilisateur
function GetListsID(int $userID){
    $database = openDatabase();

    // récuperer les to do lists créées 
    $sql = "SELECT ID FROM todoList WHERE creatorID=:id ;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':id', $userID, SQLITE3_TEXT);
    $result = $reponse->execute();

    // récuperer les to do lists partagées
    $sql = "SELECT todoID  FROM userID_todoID WHERE userID=:id ;";
    $reponse2 = $database->prepare($sql);
    $reponse2->bindValue(':id', $userID, SQLITE3_TEXT);
    $result2 = $reponse2->execute();

    //si la request à fonctionné, remplir un tableau avec les resultats
    if ($reponse === FALSE && $reponse2 === FALSE) {
        echo "echec de la requet";

    } else {
        echo "Listes obtenues";
        $data = array();

        while($test = $result->fetchArray(1)) {
            array_push($data, $test);
        }
        while($test = $result2->fetchArray(1)) {
            array_push($data, $test);
        }
    }

    // Deconnexion de la bdd
    $database = null;
}

//Récupère les tâches (et leur status) contenues dans une liste
function GetTasks(int $todolistID){
    $database = openDatabase();

    // récuperer les données 
    $sql = "SELECT name, isDone  FROM task WHERE listID=:id;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':id', $todolistID, SQLITE3_TEXT);
    $result = $reponse->execute();

    //si la request à fonctionné, remplir un tableau avec les resultats
    if ($reponse === FALSE) {
        echo "echec de la request";
    } else {
        echo "tâches obtenues";
        
        $data = array();

        while($test = $result->fetchArray(1)) {
            array_push($data, $test);
        }
    }

    // Deconnexion de la bdd
    $database = null;
}

//Ajoute une tâche dans une liste
function AddTask(int $todolistID, string $taskName){
    $database = openDatabase();

    // Ajout de données dans la table
    $sql = "INSERT INTO task ('name', 'isDone', 'listID') VALUES (:taskname, 0, :todolistID)";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':todolistID', $todolistID, SQLITE3_INTEGER);
    $reponse->bindValue(':taskname', $taskName, SQLITE3_TEXT);
    $result = $reponse->execute();

    //vérification du fonctionnement
    if ($reponse === FALSE) {
        echo "echec de la request";
    } else {
        echo "tâche ajoutée";
    }

    // Deconnexion de la bdd
    $database = null;
}

//Marque une tâche comme fait
function TaskDone(int $taskID){
    $database = openDatabase();

    //Modification de données dans la table
    $sql = "UPDATE task SET isDone = 1 WHERE ID =:taskID ";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':taskID', $taskID, SQLITE3_INTEGER);
    $result = $reponse->execute();

    //vérification du fonctionnement
    if ($reponse === FALSE) {
        echo "echec de la request";
    } else {
        echo "tâche mise à jour";
    }

    // Deconnexion de la bdd
    $database = null;
}

//Supprime une tâche de sa liste
function DeleteTask(int $taskID){
    $database = openDatabase();

    //Suppression de données dans la table
    $sql = "DELETE FROM task WHERE ID=:taskID;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':taskID', $taskID, SQLITE3_INTEGER);
    $result = $reponse->execute();

    //vérification du fonctionnement
    if ($reponse === FALSE) {
        echo "echec de la request";
    } else {
        echo "tâche supprimée";
    }

    // Deconnexion de la bdd
    $database = null;
}

?>