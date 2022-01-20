<?php

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

        //Supprimer les tâches liées
        $statement = $bd->prepare("DELETE FROM task WHERE listID=:todoListID");
        $statement->bindValue(':todoListID', $todoListID);
        $returned_set = $statement->execute();
        $statement->close();
    } else{
        echo "Vous ne pouvez pas supprimer cette todoList car vous n'êtes pas le créateur\n";
    }
    $bd=null;
}

function addCollab(int $creatorID, int $todoListID, string $collabEmail){
    $bd = openDataBase();
    $statement = $bd->prepare("SELECT creatorID FROM todoList WHERE ID = :todoListID");
    $statement->bindValue(':todoListID', $todoListID);
    $result = $statement->execute();
    if(($result->fetchArray())[0] == $creatorID){
        echo "Vous êtes bien le créateur de cette liste !\n";
        $collabID = checkEmail($collabEmail);
        if($collabID==$creatorID){
            echo("Vous ne pouvez pas vous ajouter vous même.");
        }elseif($collabID){
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


function suppCollab(int $creatorID, int $todoListID, string $collabEmail){
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


?>