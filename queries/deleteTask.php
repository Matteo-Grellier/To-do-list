<!-- supprimer une tâche -->
<?php
//value is task ID
$taskID = 7;
$databasename = 'todoList.sqlite3';

//vérifier qu'il est possible d'ouvrir la database (et l'ouvrir dcp)
try { $database = new SQLite3($databasename); } 
catch (SQLiteException $err) { die("Impossible d'ouvrir la database, erreur : ".$err->getMessage()); }

// Ajout de données dans la table
$sql = "DELETE FROM task WHERE ID=:taskID;";
$reponse = $database->prepare($sql);
$reponse->bindValue(':taskID', $taskID, SQLITE3_INTEGER);
// $reponse->bindValue(':taskname', $taskName, SQLITE3_INTEGER);
$result = $reponse->execute();

//vérif de si ça à marché
if ($reponse === FALSE) {
    echo "echec de la request";
} else {
    echo "grosso modo ça à marché";
}

// Deconnexion de la bdd
$database = null;
?>