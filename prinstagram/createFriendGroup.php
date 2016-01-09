<!-- Shengxiang Guo -----Prinstagram -->
<!DOCTYPE html>
<html>
<title>Prinstagram Create Friend Group</title>

<?php

include ("include.php");
if(!isset($_SESSION["username"])) { //check logged in
  echo "Welcome to the prinstagram example, you are not logged in. <br /><br >\n";
  echo 'You may view the pictures listed below, <a href="login.php">login</a> to post on your blog or <a href="register.php">register</a> if you don\'t have an account yet.';
  echo "\n";
}
else {
  $username = htmlspecialchars($_SESSION["username"]); //greeting
  echo "Dear $username,\n";

}
	echo "<br /><br />\n";  //html stuff 
	echo "Enter your new Friend Group information below: <br /><br />\n";
    echo '<form action="createFriendGroup.php" method="POST">';
	echo "\n";
    echo 'Friend Group Name: <input type="text" name="gname" /><br />';
	echo "\n";
    echo 'Description: <input type="text" name="descr" /><br />';
	echo "\n";
    echo '<input type="submit" value="Submit" />';
	echo "\n";
    echo '</form>';
	echo "\n";
	echo '<br /><a href="index.php">Go back</a>';
if(isset($_POST["gname"]) && isset($_POST["descr"])) { //check see if group names already existed.
	if ($stmt = $mysqli->prepare("select gname, ownername from friendgroup where gname = ? and ownername = ?")) {
		$tempText = "ss";
		$stmt->bind_param($tempText, $_POST["gname"], $_SESSION["username"]);
		$stmt->execute();
		$stmt->bind_result($gname , $username);
        if ($stmt->fetch()) {
          echo "<br /><br />Opps, That group name already exists. ";
		  $stmt->close(); //WARNNING: it worked but still need to check if different user can have same group name.
        }
		//if not then insert the new friend group into database.
		else {
		    $stmt->close();
		    if ($stmt = $mysqli->prepare("insert into friendgroup (gname, descr, ownername) values (?, ?, ?)")) {
			$tempText1 = "sss";
			$tempText2 = $_POST["gname"];
			$tempText3 =$_POST["descr"];
			$tempText4 = $_SESSION["username"];
              $stmt->bind_param($tempText1, $tempText2, $tempText3, $tempText4);
              $stmt->execute();
              $stmt->close();
              echo "<br /><br />Registration complete, click go back to return to homepage."; 
			$query = '  insert into ingroup (gname, ownername, username) values ("' .$_POST['gname'] .'" ,"' .$_SESSION['username'] .'","' .$_SESSION['username'] .'")';
			$result = mysqli_query($mysqli,$query);
          }		  
        }	 
	}
}

?>

</html>