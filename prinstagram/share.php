<?php
include ("include.php");
	if(isset($_POST['gname'])){
		$query = 'INSERT INTO shared (gname ,ownername, pid) VALUES ("'. $_POST["gname"] .'","'.$_SESSION['username']. '","'.$_GET['pid']  . '")';
		$result = mysqli_query($mysqli,$query);
	    if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
			}else{ echo "Picture is shared "; echo '<br /><a href="index.php">Go back</a>';	}
	}else{
		
		echo "Enter the group name you want to share this picture below: <br />\n";
		echo '<form action="share.php?pid='.$_GET['pid']  . '" method="POST">';			echo "\n";	
		echo 'group name: <input type="text" name="gname" /><br />';
		echo "\n";
		echo '<input type="submit" value="Submit" />';
		echo "\n";
		echo '</form>';
		echo "\n";
		echo '<br /><a href="index.php">Go back</a>';	
		}	
?>
		
		
		
	