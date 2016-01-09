<!DOCTYPE html>

<html>
<title>Prinstagram ffg</title>

<?php

include ("include.php");
if(!isset($_SESSION["username"])) {
  echo "Welcome to the prinstagram example, you are not logged in. <br /><br >\n";
  echo 'You may view the pictures listed below, <a href="login.php">login</a> to post on your blog or <a href="register.php">register</a> if you don\'t have an account yet.';
  echo "\n";
}
else {
  $username = htmlspecialchars($_SESSION["username"]);
  echo "Welcome $username. You are logged in.<br /><br />\n";
  echo 'You may view the picture listed below, <a href="showPrivPhoto.php?username=';
  echo htmlspecialchars($_SESSION["username"]);
  echo '">go to your pictures</a>, or <a href="post1.php">post on your blog</a>, or <a href="addFriend.php">add a friend</a>, or <a href="createFriendGroup.php">create a friend group</a>, or <a href="tagRequest.php">check pending request, </a>or <a href="changePassword.php">change password </a>,or <a href="deFriend.php">delete a friend</a>, </a>or <a href="logout.php">logout</a>.';
  echo "\n";
}
echo "<br /><br />\n";
if ($stmt = $mysqli->prepare("select username, fname, lname from person order by username")) {
  $stmt->execute();
  $stmt->bind_result($username, $fname, $lname);
  while ($stmt->fetch()) {
    echo '<a href="view.php?username=';
	echo htmlspecialchars($username);
	$username = htmlspecialchars($username);
	echo "\">$username's public pictures</a><br />\n";
  }
  $stmt->close();
  $mysqli->close();
}

?>

</html>