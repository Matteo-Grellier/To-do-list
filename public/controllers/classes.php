<?php
    session_start();
    include '../../models/utils.php';
?>
<?php

require("../../models/getinfos.php"); 

class User {
    public int $id;
    public string $name;
    public string $email;
    
    public $ownTodoList = [];
    public $sharedTodoList = [];

    function __construct($id, $name, $email) {

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;

        $this->separateTodoList();
    }

    function separateTodoList() {

        //get basic information of all todo : name, creator and id (id to get all tasks later)
        foreach(GetLists($this->id) as $information) { //$information : [$creator, $name, $idTodo]
            
            $idOfCreator = $information["creatorID"];
            $nameOfTodoList = $information["name"];
            $idOfTodoList = $information["ID"];
            
            if($this->id == $idOfCreator) {
                array_push($this->ownTodoList, new ToDoList($idOfTodoList, $nameOfTodoList, $idOfCreator));
            } else {
                array_push($this->sharedTodoList, new ToDoList($idOfTodoList, $nameOfTodoList, $idOfCreator));//changer idOfCreator par nameOfCreator
            }
        }
    }
}

class ToDoList {
    public int $id;
    public string $name;
    public int $creatorID;
    public string $creatorName;

    public $collaborators = [];

    public $tasks = [];

    function __construct($id, $name, $creatorID) {
        $this->id = $id;
        $this->name = $name;
        $this->creatorID = $creatorID;
        $creatorInfos=GetInfosUser(null, $this->creatorID);
        $this->creatorName = $creatorInfos[0]["name"];
        $this->collaborators = getCollabs($this->id);
    }

    function updateTasks($newTasks) {


        foreach($newTasks as $newTask) {
            
            $notExist = true;

            foreach($this->tasks as $task) {
                if($newTask["ID"] == $task->id) { //si l'id de la nouvelle tache est egal a celui de la tache actuelle alors :
                    
                    $task->name = $newTask["name"];
                    $task->isDone = $newTask["isDone"];
                    
                    $notExist = false;
                    break;
                } else {
                    $notExist = true;
                }
            }

            if($notExist) {
                array_push($this->tasks, new Task($newTask["ID"],$newTask["name"],$newTask["isDone"]));
            }
        }
    }
    
}

class Task {
    public int $id;
    public string $name;
    public bool $isDone;

    function __construct($id, $name, $isDone) {
        $this->id = $id;
        $this->name = $name;
        $this->isDone = $isDone;
    }
}