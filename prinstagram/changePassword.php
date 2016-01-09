<?php
include ("include.php");
	if(isset($_POST['newPassword'])&&isset($_POST['oldPassword'])){
		$query = 'UPDATE person SET password = "' .md5($_POST['newPassword']).'" WHERE username="' .$_SESSION['username'] .'" and  password="' .md5($_POST['oldPassword'] ).'"';
		$result = mysqli_query($mysqli,$query);
	    if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
			}else{ echo "password is changed "; echo '<br /><a href="logout.php">Go back</a>';	}
	}else{
		
		echo "change password: <br />\n";
		echo '<form action="changePassword.php" method="POST">';			echo "\n";	
		echo 'old password: <input type="text" name="oldPassword" /><br />';
		echo "\n";
		echo 'new password: <input type="text" name="newPassword" /><br />';
		echo '<input type="submit" value="Submit" />';
		echo "\n";
		echo '</form>';
		echo "\n";
		echo '<br /><a href="index.php">Go back</a>';	
		}	
?>
		
		
		
	