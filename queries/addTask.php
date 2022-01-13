<!-- ajouter une tâche -->
<?php
//value is todolistID
$todolistID = 1;
//value is task name
$taskName = "do anything";
$databasename = 'todoList.sqlite3';

//vérifier qu'il est possible d'ouvrir la database (et l'ouvrir dcp)
try { $database = new SQLite3($databasename); } 
catch (SQLiteException $err) { die("Impossible d'ouvrir la database, erreur : ".$err->getMessage()); }

// Ajout de données dans la table
$sql = "INSERT INTO task ('name', 'isDone', 'listID') VALUES (:taskname, 0, :todolistID)";
$reponse = $database->prepare($sql);
$reponse->bindValue(':todolistID', $todolistID, SQLITE3_INTEGER);
$reponse->bindValue(':taskname', $taskName, SQLITE3_TEXT);
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