<!-- Shengxiang Guo -----Prinstagram -->
<?php
include ("include.php");
	if(isset($_POST['friendUsername'])){
		$query = 'DELETE FROM ingroup WHERE ownername="' .$_SESSION['username'] .'" and gname="' .$_POST['gname'] .'" and username="' .$_POST['friendUsername'] .'"';
		$result = mysqli_query($mysqli,$query);
	    if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
			}else{ echo "friend is deleted "; echo '<br /><a href="index.php">Go back</a>';	}
	}else{
		
		echo "delete a friend: <br />\n";
		echo '<form action="deFriend.php" method="POST">';			echo "\n";	
		echo 'friend username: <input type="text" name="friendUsername" /><br />';
		echo "\n";
		echo 'group name delete from: <input type="text" name="gname" /><br />';
		echo "\n";
		echo '<input type="submit" value="Submit" />';
		echo "\n";
		echo '</form>';
		echo "\n";
		echo '<br /><a href="index.php">Go back</a>';	
		}	
?>
		
		
		