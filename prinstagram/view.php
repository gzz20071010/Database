<!DOCTYPE html>
<html>

<?php

include ("include.php");

//check if the user exists and prints out username, if not redirects back to homepage
if ($stmt = $mysqli->prepare("select username from person where username = ?")) {
  $stmt->bind_param("s", $_GET["username"]);
  $stmt->execute();
  $stmt->bind_result($username);
  if($stmt->fetch()) {
	//$username = htmlspecialchars($username);
	echo "<title>$username's blog</title>\n";
	echo "$username's blog: <br />\n";
  }
  else {
    echo "public album is empty. \n";
    echo "click <a href=\"index.php\">here</a>.\n";
    //header("refresh: 3; index.php");
  }
  $stmt->close();
}

//check if the user is also the one who is logged in
if(($_SESSION["username"]) == $_GET["username"]) {
  
  echo 'This is your blog. You may click <a href="post1.php">here</a> to post.<br />';
  echo 'This is your blog. You may click <a href="showPrivPhoto.php">here</a> to view your pictures.<br />';
  echo "\n";
}else{
  echo 'please click <a href="showPubPhoto.php?username=';
  echo htmlspecialchars($_GET["username"]);
  echo '">here</a> to processed or';
  echo "\n";  
}

echo '<a href="index.php">Go back</a>.<br /><br />';
echo "\n";

//print out all the messages from this user in a pretty table
if ($stmt = $mysqli->prepare("select text, time from messages where user_id = ? order by time desc")) {
  $stmt->bind_param("i", $_GET["user_id"]);
  $stmt->execute();
  $stmt->bind_result($text,$time);
  while($stmt->fetch()) {
	$text = nl2br(htmlspecialchars($text)); //nl2br function replaces \n and \r with <br />
	$time = htmlspecialchars($time);
	echo '<table border="2" width="30%"><tr><td>';
	echo "\n";
	echo "$time, $username wrote:</td></tr><tr><td><br />$text<br /><br /></td></tr></table><br />\n";
  }
  $stmt->close();
}
$mysqli->close();
?>

</html>