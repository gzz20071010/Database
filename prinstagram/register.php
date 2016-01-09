<!DOCTYPE html>

<html>
<title>Register</title>
<body background="5779406_978535.jpg" bgcolor="#333333"> 

<?php

include "include.php";

//if the user is already logged in, redirect them back to homepage 
if(isset($_SESSION["username"])) {
  echo "You are already logged in. ";
  echo "You will be redirected in 3 seconds or click <a href=\"index.php\">here</a>.";
  header("refresh: 3; index.php");
}
else {
  //if the user have entered _all_ entries in the form, insert into database
  if(isset($_POST["username"]) && isset($_POST["password"])) {

    //check if username already exists in database
    if ($stmt = $mysqli->prepare("select username from person where username = ?")) {
      $stmt->bind_param("s", $_POST["username"]);
      $stmt->execute();
      $stmt->bind_result($username);
        if ($stmt->fetch()) {
          echo "That username already exists. ";
          echo "You will be redirected in 3 seconds or click <a href=\"register.php\">here</a>.";
          header("refresh: 3; register.php");
		  $stmt->close();
        }
		//if not then insert the entry into database, note that user_id is set by auto_increment
		else {
		    $stmt->close();
		    if ($stmt = $mysqli->prepare("insert into person (username, password, fname, lname) values (?, ?, ?, ?)")) {
              $stmt->bind_param("ssss", $_POST["username"], md5($_POST["password"]), $_POST["fname"], $_POST["lname"]);
              $stmt->execute();
              $stmt->close();
              echo "Registration complete, click <a href=\"index.php\">here</a> to return to homepage."; 
          }		  
        }	 
	}
  }
  //if not then display registration form
  else {
    echo "Enter your information below: <br /><br />\n";
    echo '<form action="register.php" method="POST">';
    echo "\n";	
    echo 'Username: <input type="text" name="username" /><br />';
    echo "\n";
	echo 'Password: <input type="password" name="password" /><br />';
    echo "\n";
	echo 'First name: <input type="text" name="fname" /><br />';
	echo "\n";
	echo 'Last name: <input type="text" name="lname" /><br />';
    echo "\n";
	echo '<input type="submit" value="Submit" />';
    echo "\n";
	echo '</form>';
	echo "\n";
	echo '<br /><a href="index.php">Go back</a>';

  }
}
$mysqli->close();


?>


</html>