<?php 	
		//echo '==========================================================';
	include "include.php";	
	if(!isset($_SESSION["username"])) {
	echo "You are not logged in. ";
	echo "click <a href=\"login.php\">here</a>.";
 // header("refresh: 3; index.php");
	}else{
		///////////////////////////////////echo tagger taggee pid tstatus ttime ////////////////////////////////////////////////////////
		//echo "we are logged in...";
		if(isset($_POST["taggee"])&&isset($_POST["pid"])) {
			echo "got information";
			echo '<br />';
			if ($_SESSION['username']==$_POST['taggee']){
				$query = 'insert into tag (tagger, taggee, pid, ttime, tstatus) values( "'. $_SESSION["username"] .'","'. $_POST["taggee"] .'","'. $_POST["pid"] .'", NOW(),true)';
				$result = mysqli_query($mysqli,$query);
				if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
				} else{
					echo '<a href="index.php">Go back</a>.<br /><br />';	
					die('<p>self tag successful</p></body></html>');
				}	
			}else {
				$query = 'insert into tag (tagger, taggee, pid, ttime, tstatus) values( "'. $_SESSION["username"] .'","'. $_POST["taggee"] .'","'. $_POST["pid"] .'", NOW(),false)';
				$result = mysqli_query($mysqli,$query);
				if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
				} else{
					echo '<a href="index.php">Go back</a>.<br /><br />';	
					die('<p>tag request successfully send to tagee</p></body></html>');
				}	
			}
		}

		else{
			echo "Enter tag information below:<br />\n";
			echo '<form action="tag.php" method="POST">';
		
			echo 'taggee: <input type="text" name="taggee" /><br />';
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