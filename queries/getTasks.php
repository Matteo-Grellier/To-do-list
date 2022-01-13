<!-- recuperer les tâches de la liste (et si elles sont faites ou pas) -->
<?php
//we are gonna need to get the name before
//value is todolistID
$value = 1;
$databasename = 'todoList.sqlite3';

//vérifier qu'il est possible d'ouvrir la database (et l'ouvrir dcp)
try { $database = new SQLite3($databasename); } 
catch (SQLiteException $err) { die("Impossible d'ouvrir la database, erreur : ".$err->getMessage()); }

// récuperer les données 
$sql = "SELECT name, isDone  FROM task WHERE listID=:id;";
// $reponse = $database->exec($sql);
$reponse = $database->prepare($sql);
$reponse->bindValue(':id', $value, SQLITE3_TEXT);
$result = $reponse->execute();

//vérif de si ça à marché
if ($reponse === FALSE) {
    echo "echec de la request";
} else {
    echo "grosso modo ça à marché";
    
    $data = array();

    while($test = $result->fetchArray(1)) {
        array_push($data, $test);
    }
    print_r($data);
}

// Deconnexion de la bdd
$database = null;
?>