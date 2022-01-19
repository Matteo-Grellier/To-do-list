<?php

    require("../controllers/classes.php");
    require("../../models/tasks.php");
    require("../../models/todolist.php"); 

    // require("../controllers/index.php"); 

    // $nameOfActualUser = "";


    // $ownTodoList = [];
    // $sharedTodoList = [[],[]];

    // $todoListsOfActualUser = [];

    // //$information : [$creator, $name, [$task, $task, etc...]]
    // foreach($todoListsOfActualUser as $information) { //peut-être changer pour $key, $val (pour $creator, $todo) (si jamais cest coder de cette manière avec BDD)
        
    //     $nameOfCreator = $information[0];

        
    //     if($nameOfActualUser == $nameOfCreator) {
    //         $ownTodoList = []
    //     } elseif() {
    
    //     }
    // }


    // $ownTodoList = []; //[[$nameOfTodoList, $idOfTodoList],[$nameOfTodoList, $idOfTodoList],...]
    // $sharedTodoList = []; //[[$nameOfCreator,$nameOfTodoList, $idOfTodoList],[$nameOfCreator,$nameOfTodoList, $idOfTodoList],...]
    // $nameOfActualUser = "";
    // $todoListsOfActualUser = [];

    // //get basic information of all todo : name, creator and id (id to get all tasks later)
    // foreach($todoListsOfActualUser as $information) { //$information : [$creator, $name, $idTodo]
        
    //     $nameOfCreator = $information[0];
    //     $nameOfTodoList = $information[1];
    //     $idOfTodoList = $information[2];
        
    //     if($nameOfActualUser == $nameOfCreator) {
    //         $ownTodoList = array_push([$nameOfTodoList, $idOfTodoList]);
    //     } else {
    //         $sharedTodoList = array_push([$nameOfCreator, $nameOfTodoList, $idOfTodoList]);
    //     }
    // }

    // require("./classes.php");

    // $sessionUser = new User(0, "Bernard", "berber@ymail.com");

    // function getTodoList($id): array {
    //     // require("./classes.php");
    //     // require("../controllers/classes.php");


    //    //tab de test :
    //     $allTodos = [["Courses", [[0, "lait", true], [1, "eau", false], [2, "chocolat", false]]],["Chose à payer", [3, "électricité", true]],["Chose à faire",[4, "vaisselle", false]]];
       
    //     foreach($sessionUser -> ownTodoList as $todo) { //dans la liste perso, recup les todo
    //         if($todo->id == $id) {
    //             // $todo->tasks = $allTodos[$id][1];
    //             // $todo->tasks = $allTodos[$id][1];
    //             $todo->updateTasks($allTodos[$id][1]); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).

    //             break;
    //         }
    //     }

    //     foreach($sessionUser -> sharedTodoList as $todo) { //dans la liste shared, recup les todo
    //         if($todo->id == $id) {
    //             // $todo->tasks = $allTodos[$id][1];
    //             // $todo->tasks = $allTodos[$id][1];
    //             $todo->updateTasks($allTodos[$id][1]); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).

    //             break;
    //         }
    //     }

    //     return $allTodos[$id];
    // }

    // require("../../models/getinfos.php");

    $sessionUser = new User(3, "Bernard", "berber@ymail.com");

    // $getTodoList = function($id) use ($sessionUser) {
    //     // require("./classes.php");
    //     // require("../controllers/classes.php");


    //     //tab de test :
    //     $allTodos = [["Courses", [[0, "lait", true], [1, "eau", false], [2, "chocolat", false]]],["Chose à payer", [[3, "électricité", true]]],["Chose à faire",[[4, "vaisselle", false]]]];
        
    //     //On recherche dans les todos de l'utilisateur, la todo qui correspond à celle que l'on veut récup.
    //     foreach($sessionUser -> ownTodoList as $todo) { //dans la liste perso, recup les todo
    //         if($todo->id == $id) {
    //             // $todo->tasks = $allTodos[$id][1];
    //             // $todo->tasks = $allTodos[$id][1];
    //             $todo->updateTasks($allTodos[$id][1]); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).

    //             return $todo;
    //         }
    //     }

    //     foreach($sessionUser -> sharedTodoList as $todo) { //dans la liste shared, recup les todo
    //         if($todo->id == $id) {
    //             // $todo->tasks = $allTodos[$id][1];
    //             // $todo->tasks = $allTodos[$id][1];
    //             $todo->updateTasks($allTodos[$id][1]); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).

    //             return $todo;
    //         }
    //     }

    //     // return $allTodos[$id];
    // }

    $getTodoList = function($id) use ($sessionUser) {
        // require("./classes.php");
        // require("../controllers/classes.php");


        //tab de test :
        $allTodos = [["Courses", [[0, "lait", true], [1, "eau", false], [2, "chocolat", false]]],["Chose à payer", [[3, "électricité", true]]],["Chose à faire",[[4, "vaisselle", false]]]];
        
        //On recherche dans les todos de l'utilisateur, la todo qui correspond à celle que l'on veut récup.
        foreach($sessionUser -> ownTodoList as $todo) { //dans la liste perso, recup les todo
            if($todo->id == $id) {
                // $todo->tasks = $allTodos[$id][1];
                // $todo->tasks = $allTodos[$id][1];
                $todo->updateTasks(GetTasks($id)); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).

                return $todo;
            }
        }

        foreach($sessionUser -> sharedTodoList as $todo) { //dans la liste shared, recup les todo
            if($todo->id == $id) {
                // $todo->tasks = $allTodos[$id][1];
                // $todo->tasks = $allTodos[$id][1];
                $todo->updateTasks(GetTasks($id)[1]); //a la place du tableau, il faudra mettre le tableau recup direct bdd (car la cest pas vrai).

                return $todo;
            }
        }

        // return $allTodos[$id];
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST["nameOfTodoList"])) {
            addToDo($_POST["nameOfTodoList"], $sessionUser->id);
        } elseif(isset($_POST["deleteToDoList"])) {
            suppToDo($_POST["deleteToDoList"], $sessionUser->id);
            // header("Location: ../../home");
        }



        if(isset($_POST["newTaskContent"])) {
            echo $_POST["newTaskContent"];
            // header("Location:../../home");
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

        header("Location:" . $_SERVER['HTTP_REFERER']);

    }

?>