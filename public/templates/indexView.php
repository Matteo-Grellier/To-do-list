<?php
    session_start();
?>
<?php 
$title= "TooDoux List";
require("../controllers/classes.php"); 
require("../controllers/index.php"); 

$choosenTodo = null;
    if(isset($_GET['id'])) {
        $choosenTodo = $getTodoList($_GET['id']);
    }
?>

<?php ob_start(); ?>
    <div class="coller">
        <div class="to-do-lists scroller">
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
                            <span class="shared-owner">by <?=$sessionUser->sharedTodoList[$i]->creatorID //il faudra mettre creatorName?></span>
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
                        <input class="emailInput" name="Adresse Email">
                        
                        </input>
                    </div>
                    <div>
                        <button class="addUser" type="submit">Add User</button>
                    </div>
                </div>
                <div class="AllUsers">
                    <div class="eachUser">
                        <div class="userPseudo">BOB</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">JHON</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">BOB</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">BOB</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">BOB</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">BOB</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">BOB</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">BOB</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">JHON</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
                    <div class="eachUser">
                        <div class="userPseudo">DEDE</div>
                        <div class="deleteUser"><button class="delete-button"><img src="public\static\img\cross.png" width="50px"></button></div>
                        
                    </div>
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
                            <div class="checkbox">
                                <?php if($task->isDone): ?>
                                    <span>✔</span>
                                <?php endif; ?>
                            </div>
                            <h3><?=$task->name?></h3>
                            <div class="delete"><button class="delete-button"><img src="public\static\img\bin-light-red.png" width="40px"></img></button></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


                <div class="add-task">
                    <input type="text">
                    <h3>+</h3>
                </div>

            </div>

        </div>
        <div class="tools">
            <h3 class="tools-title">Tools</h3>
            <div class="users tools-btn" onclick="on()">
                <img src="public\static\img\share-dark-blue.png" width="30px"></img>
                <span>User</span>
            </div>
            <div class="list-delete tools-btn">
                <img src="public\static\img\bin-dark-blue.png" width="30px"></img>
                <span>Delete</span>
            </div>
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
