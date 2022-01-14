<?php

include 'utils.php';

//Obtiens les ID et le nom de toutes les listes créées et partagées avec l'utilisateur
//retourne un tableau qui contient un tableau pour chaque liste avec son ID et son nom
function GetLists(int $userID){
    $database = openDatabase();

    // récuperer les to do lists créées 
    $sql = "SELECT ID, name FROM todoList WHERE creatorID=:id ;";
    $reponse = $database->prepare($sql);
    $reponse->bindValue(':id', $userID, SQLITE3_TEXT);
    $result = $reponse->execute();

    // récuperer les to do lists partagées
    $sql = "SELECT ID, name FROM todoList WHERE ID = ( SELECT todoID  FROM userID_todoID WHERE userID=:id ) ;";
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
    
    return $data;
}

//Récupère les tâches, leur ID et leur status, contenues dans une liste
//retourne un tableau qui contient un tableau pour chaque tâche avec son nom, son isDone et son ID
function GetTasks(int $todolistID){
    $database = openDatabase();

    // récuperer les données 
    $sql = "SELECT name, isDone, ID  FROM task WHERE listID=:id;";
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

    return $data;
}

// foreach (GetLists(2) as $row) {
//     foreach ($row as $yes) {
//         echo "\n" . $yes;
//     }
// }

// foreach (GetTasks(1) as $row) {
//     foreach ($row as $yes) {
//         echo "\n" . $yes;
//     }
// }

?>