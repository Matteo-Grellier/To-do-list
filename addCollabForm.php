<!DOCTYPE HTML>  
<html>
<head>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>  

<?php
// require($_SERVER['DOCUMENT_ROOT'].'/../models/todolist.php');
require('../models/todolist.php');

// define variables and set to empty values
// $emailErr = "";
$email = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["emailForm"])) {
    if (empty($_POST["email"])) {
      // $emailErr = "email is required";
      $message = "email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // $emailErr = "Invalid email format";
        $message = "Invalid email format";
      } else {
        // addCollab(1, 2, $email);
        debug_to_console("ta maman la chouette");
        addCollab(1, 2, "matheo.leger@ynov.com");
        // $message = "added $email to the to-do-list !";

      }
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>

<h2>Share your to-do-list with another user !</h2>

<!-- <form method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> "> -->
<form method="post">

  User email : <input type="text" name="email" value="<?php echo $email;?>">
  <!-- <span class="error"> <?php echo $emailErr;?></span> -->
  <br><br>

  <input type="submit" name="emailForm" value="Add User">
</form>

<?php
// echo "<h2>Your Input:</h2>";
// echo $email;
echo $message
?>

</body>
</html>