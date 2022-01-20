<?php 
$title= "TooDoux List";
// require("../controllers/classes.php"); 
require("../controllers/index.php"); 

$choosenTodo = null;
    if(isset($_GET['id'])) {
        $choosenTodo = $getTodoList($_GET['id']);
    }
?>

<?php ob_start(); ?>
    <div class="coller">
        <div class="to-do-lists scroller">
            <form action="./public/controllers/index.php" method="post" class="form-btn-create-todolist">
                <input type="text" name="nameOfTodoList" placeholder="Create TodoList">
                <button type="submit" class="btn-create-todolist">Create</button>
            </form>
            <div class="by-you">
                <h3>By You</h3>
                <ul class="by-you-list-content todolist-tab">
                    <?php for($i = 0; $i < count($sessionUser->ownTodoList); ++$i): ?>
                        <li id=<?= $sessionUser->ownTodoList[$i]->id ?>>
                            <a href="home?id=<?= $sessionUser->ownTodoList[$i]->id?>">↳<?=$sessionUser->ownTodoList[$i]->name ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- <li>↳Coffee</li>
                    <li>↳Tea</li>
                    <li>↳Milk</li> -->
                </ul>
            </div>
            <div class="shared">
                <h3>Shared with you</h3>
                <ul class="shared-list-content todolist-tab">
                        
                    <?php for($i = 0; $i < count($sessionUser->sharedTodoList); ++$i): ?>
                        <li id=<?= $sessionUser->sharedTodoList[$i]->id ?>>
                            <a href="home?id=<?= $sessionUser->sharedTodoList[$i]->id?>">↳<?=$sessionUser->sharedTodoList[$i]->name ?></a>
                            <span class="shared-owner">by <?=$sessionUser->sharedTodoList[$i]->creatorName //il faudra mettre creatorName?></span>
                        </li>
                    <?php endfor; ?>
                    
                    <!-- <li><span>↳Coffee<span><span class="shared-owner">by Other</span></li>
                    <li><span>↳Tea</span><span class="shared-owner">by Name</span></li>
                    <li><span>↳Milk</span><span class="shared-owner">by Other</span></li> -->
                </ul> 
            </div>
        </div>


        <div id="UsersList" class="overlay">
            <div class="mainPage">
                <h3 class="close" onclick="off()">&times;</h3>
                <div class="header">
                    <h1>USERS</h1>
                </div>
                <div class="AddUserContainer">
                    <div>
                    <form method="POST">
                        <input placeholder="Email" class="emailInput" name="emailCollaborator" >
                        </input>
                    </div>
                    <div>
                        <button class="addUser" type="submit">Add User</button>
                    </div>
                    </form>
                </div>
                <div class="AllUsers">
                    <?php foreach($choosenTodo->collaborators as $collaborator): ?>

                        <form method="POST">
                        <div class="eachUser">
                        <div class="userPseudo"><?=$collaborator["name"]?></div>
                            <input name="suppCollab" value="<?=$collaborator["email"]?>" hidden>
                        <div class="deleteUser">
                            <button type="submit" class="delete-button">
                            <img src="public\static\img\cross.png" width="50px">
                            </button>
                        </div>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="one-todo-list">
            <?php if($choosenTodo != null): ?>
                <h1 class="list-title"><?=$choosenTodo->name?></h1>
            <?php else: ?>
                <h1 class="list-title">Choisissez une Liste</h1>
            <?php endif; ?>
            <div class="tasks-lists">
                
                <?php if($choosenTodo != null): ?>
                    <H3><?= count($choosenTodo->tasks) ?></H3>
                    <?php foreach($choosenTodo->tasks as $task): ?>
                        <div class="one-task">
                            <div class="one-task-comp">
                            <form action="./public/controllers/index.php?id=<?=$task->id?>" method="post">
                                <button class="checkbox" type="submit" name="isDone" value="<?=!$task->isDone?>">
                                    <?php if($task->isDone): ?>
                                        <span>✔</span>
                                    <?php endif; ?>
                                </button>
                            </form>

                            <h3><?=$task->name?></h3>
                            </div>
                            <form action="./public/controllers/index.php" method="post" class="delete">
                                <button class="delete-button" type="submit" name="delete" value="<?=$task->id?>">
                                    <img src="public\static\img\bin-light-red.png" width="40px"></img>
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if($choosenTodo != null): ?>
                <form action="./public/controllers/index.php?id=<?=$choosenTodo->id?>" method="post" class="add-task">
                    <input class="content-new-task" type="text" name="newTaskContent">
                    <input class="submit-task" type="submit" name="newTask" value="+">
                </form>
                <?php endif; ?>
            </div>

        </div>
        <div class="tools">
            <?php if($choosenTodo != null): ?>
            <h3 class="tools-title">Tools</h3>
            <div class="users tools-btn" onclick="on()">
                <img src="public\static\img\share-dark-blue.png" width="30px"></img>
                <span>User</span>
            </div>
            
            <form action="./public/controllers/index.php" method="post" class="list-delete tools-btn">
                <button type="submit" name="deleteToDoList" value="<?=$choosenTodo->id?>">
                    <img src="public\static\img\bin-dark-blue.png" width="30px"></img>
                    <span>Delete</span>
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>

<script>
function on() {
  document.getElementById("UsersList").style.display = "block";
}

function off() {
  document.getElementById("UsersList").style.display = "none";
}
</script>

<?php $mainContent = ob_get_clean(); ?>

<?php
    include "layout.php";
?>
