<?php

include 'utils.php';

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

//tests

// AddTask(1, "manger")
// TaskDone(8)
// DeleteTask(8)




?>