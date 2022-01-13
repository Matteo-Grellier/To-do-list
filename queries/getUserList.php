
<!-- recuperer les listes de l'utilisateur & partagées avec lui -->
<?php
//we are gonna need to get the name before
//value is userID
$value = 1;
$databasename = 'todoList.sqlite3';

//vérifier qu'il est possible d'ouvrir la database (et l'ouvrir dcp)
try { $database = new SQLite3($databasename); }
catch (SQLiteException $err) { die("Impossible d'ouvrir la database, erreur : ".$err->getMessage()); }

// récuperer les to do lists créées 
$sql = "SELECT ID FROM todoList WHERE creatorID=:id  ;";
// $sql = "SELECT ID, todoID  FROM todoList INNER JOIN userID_todoID ON todoList.creatorID = userID_todoID.userID WHERE creatorID=:id  ;"; //WHERE creatorID=:id 
// $reponse = $database->exec($sql);
$reponse = $database->prepare($sql);
$reponse->bindValue(':id', $value, SQLITE3_TEXT);
$result = $reponse->execute();

// récuperer les to do lists partagées
$sql = "SELECT todoID  FROM userID_todoID WHERE userID=:id ;"; 
// $reponse = $database->exec($sql);
$reponse2 = $database->prepare($sql);
$reponse2->bindValue(':id', $value, SQLITE3_TEXT);
$result2 = $reponse2->execute();

//vérif de si ça à marché
if ($reponse === FALSE && $reponse2 === FALSE) {
    echo "echec de la request";
} else {
    echo "grosso modo ça à marché \n";

    $data = array();

    while($test = $result->fetchArray(1)) {
        array_push($data, $test);
    }

    while($test = $result2->fetchArray(1)) {
        array_push($data, $test);
    }
    print_r($data);
}



// Deconnexion de la bdd
$database = null;
?>