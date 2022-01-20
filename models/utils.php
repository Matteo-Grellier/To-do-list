<?php

function openDatabase():SQLite3 {
    $base = '../../models/todoDatabase.sqlite3';
    try{
        $bd = new SQLite3($base);
    } catch(SQLiteException $e){
        die("Could not connect to database ");
    }
    return $bd;
}

function checkEmail(string $emailUser){
    $bd = openDataBase();

    /*on vérifie si l'email est bien valide*/
    $statement = $bd->prepare("SELECT ID FROM user WHERE email = :emailUser");
    $statement->bindValue(':emailUser', $emailUser);
    $result = $statement->execute();
    $result = ($result->fetchArray());
    if($result){
        return $result['ID'];
    }
    $statement->close();
    $bd=null;
}
?>