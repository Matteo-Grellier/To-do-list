<?php

    require("../controllers/classes.php");
    require("../../models/tasks.php");
    require("../../models/todolist.php"); 
?>
<?php
    if(isset($_SESSION['ID'])){
        $sessionUser = new User($_SESSION['ID'], $_SESSION['name'], $_SESSION['email']);
    } else{
        header("Location:./login");
        // $sessionUser = new User(1, "berber", "ber@gmail.com");
    }

    $getTodoList = function($id) use ($sessionUser) {

        //On recherche dans les todos de l'utilisateur, la todo qui correspond à celle que l'on veut récup.
        foreach($sessionUser -> ownTodoList as $todo) { //dans la liste perso, recup les todo
            if($todo->id == $id) {
                $todo->updateTasks(GetTasks($id)); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).

                return $todo;
            }
        }

        foreach($sessionUser -> sharedTodoList as $todo) { //dans la liste shared, recup les todo
            if($todo->id == $id) {
                $todo->updateTasks(GetTasks($id)); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).
                return $todo;
            }
        }
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST["nameOfTodoList"])) {
            addToDo($_POST["nameOfTodoList"], $sessionUser->id);
        } elseif(isset($_POST["deleteToDoList"])) {
            suppToDo($_POST["deleteToDoList"], $sessionUser->id);
        }



        if(isset($_POST["newTaskContent"])) {
            echo $_POST["newTaskContent"];
            AddTask($_GET["id"], $_POST["newTaskContent"]);
        } elseif(isset($_POST["delete"])) {
            DeleteTask($_POST["delete"]);
        } elseif(isset($_POST["isDone"])) {
            if($_POST["isDone"] == true) {
                TaskDone($_GET["id"]);
            } else {
                TaskNotDone($_GET["id"]);
            }
        }

        if(isset($_POST["emailCollaborator"])){
            addCollab($sessionUser->id, $_GET["id"], $_POST["emailCollaborator"]);
        }

        if(isset($_POST["suppCollab"])){
            suppCollab($sessionUser->id, $_GET["id"], $_POST["suppCollab"]);
        }

        header("Location:" . $_SERVER['HTTP_REFERER']);

    }

?>