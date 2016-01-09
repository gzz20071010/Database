<?php
include ("include.php");
// get pending tag info
   $query = 'SELECT pid,tagger FROM tag WHERE tstatus =false and taggee="' .$_SESSION['username'] .'"';
   $result = mysqli_query($mysqli,$query);
   if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	} else{
		echo "<fieldset><legend>pending request list</legend>";
		for ( $i = 0 ; $i < mysqli_num_rows($result) ; $i++ ) {
			$row = mysqli_fetch_assoc($result);
			
			echo 'photo ID: '.$row['pid'] .'';
			echo '<br />';
			echo 'tagger: '.$row['tagger'] .'';
			echo '<br />';		
		}
		echo "</fieldset>";		
	}
	if(isset($_POST["pidd"])){
	    $query1 = 'UPDATE tag SET tstatus = true WHERE pid="' .$_POST['pidd'] .'" and  taggee="' .$_SESSION['username'] .'"';
	    $result1 = mysqli_query($mysqli,$query1);
	    if (!$result1) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query1;
			die($message);
			}else{ echo "request approved"; echo '<br /><a href="index.php">Go back</a>';	}
	}else{
		echo "Enter your photo id you want to approve tag below: <br />\n";
		echo '<form action="tagRequest.php" method="POST">';			echo "\n";	
		echo 'photo id: <input type="text" name="pidd" /><br />';
		echo "\n";
		echo '<input type="submit" value="Submit" />';
		echo "\n";
		echo '</form>';
		echo "\n";
		echo '<br /><a href="index.php">Go back</a>';	
		}		
?>