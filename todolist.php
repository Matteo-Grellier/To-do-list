<?php
// include 'openDataBase.php';
include 'utils.php';

function addToDo(string $nameEntry, int $creatorID){
    $bd = openDataBase();

    $statement = $bd->prepare("INSERT INTO todoList (name, creatorID)"."VALUES(:nameEntry, :creatorID)");
    
    $statement->bindValue(':nameEntry', $nameEntry);
    $statement->bindValue(':creatorID', $creatorID);
    $returned_set = $statement->execute();

    $statement->close();
    $bd=null;
    echo('La To Do List a bien été créée.');
}

// addToDo("Cuisine ", 1);

function suppToDo(int $todoListID, int $creatorID){
    $bd = openDataBase();
    $statement = $bd->prepare("SELECT creatorID FROM todoList WHERE ID = :todoListID");
    $statement->bindValue(':todoListID', $todoListID);
    $result = $statement->execute();
    if(($result->fetchArray())[0] == $creatorID){
        echo "Vous êtes bien le créateur de cette liste !\n";
        $statement = $bd->prepare("DELETE FROM todoList WHERE ID=:todoListID");
        $statement->bindValue(':todoListID', $todoListID);
        $returned_set = $statement->execute();
        echo("La ToDo list a été supprimée.");
        $statement->close();
    } else{
        echo "Vous ne pouvez pas supprimer cette todoList car vous n'êtes pas le créateur\n";
    }
    $bd=null;
}

// suppTodo(2, 1);

function addCollab(int $creatorID, int $todoListID, string $collabEmail,){
    $bd = openDataBase();
    $statement = $bd->prepare("SELECT creatorID FROM todoList WHERE ID = :todoListID");
    $statement->bindValue(':todoListID', $todoListID);
    $result = $statement->execute();
    if(($result->fetchArray())[0] == $creatorID){
        echo "Vous êtes bien le créateur de cette liste !\n";
        $collabID = checkEmail($collabEmail);
        if($collabID){
            $statement = $bd->prepare("INSERT INTO userID_todoID (todoID, userID)"." VALUES (:todoListID, :collabID)");
            $statement->bindValue(':todoListID', $todoListID);
            $statement->bindValue(':collabID', $collabID);
            $returned_set = $statement->execute();
            echo("j'ai ajouté mon collaborateur à ma to do list");
        } else{
            echo "l'utilisateur n'existe pas !";
        }
        $statement->close();
    } else{
        echo "Vous ne pouvez pas ajouter un utilisateur car vous n'êtes pas le créateur\n";
    }
    $bd=null;
}

// addCollab(1, 3, "renaud.jag@gmail.com");

function suppCollab(int $creatorID, string $collabEmail, int $todoListID){
    $bd = openDataBase();
    $statement = $bd->prepare("SELECT creatorID FROM todoList WHERE ID = :todoListID");
    $statement->bindValue(':todoListID', $todoListID);
    $result = $statement->execute();
    if(($result->fetchArray())[0] == $creatorID){
        echo "Vous êtes bien le créateur de cette liste !\n";
        $collabID = checkEmail($collabEmail);

        if($collabID){
            $statement = $bd->prepare("DELETE FROM userID_todoID WHERE userID = :collabID AND todoID = :todoListID");
            $statement->bindValue(':todoListID', $todoListID);
            $statement->bindValue(':collabID', $collabID);
            $returned_set = $statement->execute();
            echo("j'ai supprimé mon collaborateur de ma To Do list");
        } else{
            echo "l'utilisateur n'existe pas.";
        }
        $statement->close();
    } else{
        echo "Vous ne pouvez pas supprimer un utilisateur car vous n'êtes pas le créateur\n";
    }
    $bd=null;
}

// suppCollab(1, "renaud.jaguelin\@gmail.com", 3);

// checkEmail("renaud.jaguelin\@gmail.com")

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

// AddTask(1, "manger")
// TaskDone(8)
// DeleteTask(8)

?>