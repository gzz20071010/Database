<!DOCTYPE html>
<html>
<title>addFriend</title>
<body background="kobe.jpg" bgcolor="#333333"> 

<?php

include "include.php";

//if the user is already logged in, redirect them back to homepage 
if(!isset($_SESSION["username"])) {
  echo "You are not logged in. ";
  echo "click <a href=\"login.php\">here</a>.";
 // header("refresh: 3; index.php");
}
else {
  //if the user have entered _all_ entries in the form, insert into database
  if(isset($_POST["gname"]) && isset($_POST["friendName"])) {

    //check if username already exists in gname
    if ($stmt = $mysqli->prepare("select username from ingroup where ownername = ? and gname = ? and username= ?")) {
      $stmt->bind_param("sss", $_SESSION["username"], $_POST["gname"], $_POST["friendName"]);
      $stmt->execute();
      $stmt->bind_result($username);
        if ($stmt->fetch()) {
          echo "That username already exists. ";
          echo " click <a href=\"index.php\">here</a>.";
         // header("refresh: 3; register.php");
		  $stmt->close();
        }
		//if not then insert the entry into database
		else {
		    $stmt->close();
		    if ($stmt = $mysqli->prepare("insert into ingroup (username, ownername, gname) values (?, ?, ?)")) {
              $stmt->bind_param("sss", $_POST["friendName"], ($_SESSION["username"]), $_POST["gname"]);
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
    echo '<form action="addFriend.php" method="POST">';
    echo "\n";	
    echo 'friend name: <input type="text" name="friendName" /><br />';
    echo "\n";
	echo 'group name: <input type="text" name="gname" /><br />';
    echo "\n";
	echo '<input type="submit" value="Submit" />';
    echo "\n";
	echo '</form>';
	echo "\n";
	echo '<br /><a href="index.php">Go back</a>';

  }
}
$mysqli->close();


?></body>


</html>