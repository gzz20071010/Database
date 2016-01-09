<?php 	
		//echo '==========================================================';
	include "include.php";	
	if(!isset($_SESSION["username"])) {
	echo "You are not logged in. ";
	echo "click <a href=\"login.php\">here</a>.";
 // header("refresh: 3; index.php");
	}else{
		
		//echo "we are logged in...";
		if(isset($_POST["comment"])&&isset($_POST["pid"])) {
			echo "got information";
			echo '<br />';
		//insert intoo comment table
			/*if ($stmt = $mysqli->prepare("insert into comment (ctext, ctime) values( ?, ?)")){ 
			  $now = 'NOW()';
			  $stmt->bind_param("ss", $_POST['comment'], '"$now"');
			  $stmt->execute();
			  echo "commented.";*/
			//retrive cid insert into commenton  
			$query = 'insert into comment (ctext, ctime) values( "'. $_POST["comment"] .'", NOW())';
			$result = mysqli_query($mysqli,$query);
			echo "commented";
			echo '<br />';

	// Check result
			$query = "select cid from comment where ctime= NOW()";
			$result = mysqli_query($mysqli,$query);
			//get cid
			$row = $result->fetch_array(MYSQLI_NUM);
			// echo $row[0];
		    // echo '<br />';
		//insert commenton
			$query = 'insert into commenton (cid, pid, username) values( "'. $row[0] .'","'. $_POST["pid"] .'","'. $_SESSION["username"] .'")';
			$result = mysqli_query($mysqli,$query);
			echo "commenton added";
			echo '<br />';
			echo '<a href="index.php">Go back</a>.<br /><br />';

		
		}else{
			echo "Enter your comment below: <br /><br />\n";
			echo '<form action="comment.php" method="POST">';
			echo "\n";	
			echo 'comment: <input type="text" name="comment" /><br />';
			echo "\n";
			echo 'picture id: <input type="text" name="pid" /><br />';
			echo "\n";
			echo '<input type="submit" value="Submit" />';
			echo "\n";
			echo '</form>';
			echo "\n";
			echo '<br /><a href="index.php">Go back</a>';	
		}
	}
?>