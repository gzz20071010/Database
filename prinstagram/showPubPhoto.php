<!-- Shengxiang Guo -----Prinstagram -->
<?php

include ("include.php");

	
   $query = 'SELECT image,poster,caption ,pid FROM photo WHERE is_pub=1 and poster="'.$_GET['username'].'"';
   $result = mysqli_query($mysqli,$query);
	// Check result
	// This shows the actual query sent to MySQL, and the error. Useful for debugging.
    echo "click <a href=\"comment.php\">here</a> to comment on photos."; 
	echo '<br />';
    echo "click <a href=\"tag.php\">here</a> to tag someone."; 
	echo '<br />';
    echo "click <a href=\"sharedPhoto.php\">here</a> to see private photo shared by group."; 

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	} else{
		for ( $i = 0 ; $i < mysqli_num_rows($result) ; $i++ ) {
			$row = mysqli_fetch_assoc($result);
			//mysqli_connect("localhost","root","","prinstagram")or die("Cannot connect to database"); //keep your db name
			//$sql = "SELECT image FROM photo where pid = 42"; // manipulate id ok 
			$query2 = 'SELECT image FROM photo WHERE pid ="' .$row['pid'] . '"';
			$result2 = mysqli_query($mysqli,$query2);
			$image=mysqli_fetch_array($result2);
			$query3 = 'SELECT ctext, ctime, username FROM comment natural join commenton WHERE pid ="' .$row['pid'] . '"';
			$result3 = mysqli_query($mysqli,$query3);
			$query4 = 'SELECT taggee, fname, lname FROM tag inner join person WHERE pid ="' .$row['pid'] . '" and tstatus= true and taggee= username';
			$result4 = mysqli_query($mysqli,$query4);
			if (!$result4) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			echo($message);
			}else{ }
	
			//$comment=mysqli_fetch_array($result3);
			echo "<fieldset><legend>Image</legend>";
			echo 'photo ID: '.$row['pid'] .'';
			echo '<br />';
			echo 'Poster: '.$row['poster'] .'';
			echo '<br />';		
			echo 'Capation: '.$row['caption'] .'';
			echo '<br />';
			echo "<fieldset><legend>Comment</legend>";
			for ($j = 0; $j < mysqli_num_rows($result3); $j++){
				$row1 =  mysqli_fetch_assoc($result3);
				echo ''.$row1['username']  . ''; 
				
				echo ' says:'.$row1['ctext'] .'';	
				echo  '   '.$row1['ctime'] .'';
				echo '<br />';		
			}
			echo "</fieldset>";
			//show taggee
			echo "<fieldset><legend>Taggee</legend>";
			for ($g = 0; $g < mysqli_num_rows($result4); $g++){
			//	$row2 =  mysqli_fetch_assoc($result4);
			//echo print_r($result4);
				$row2 =  mysqli_fetch_assoc($result4);
				ECHO '(';
				echo ''.$row2['fname'] .''; 
				ECHO 	' ';
				echo ''.$row2['lname'] .''; 
				echo ' ';
				echo ')';
				echo ' @ ';
				echo ''.$row2['taggee'] .''; 
				echo ' is tagged in this photo';
				echo '<br />';		
			}
			echo "</fieldset>";

			// this is code to display 
			echo '<img src="data:image/jpeg;base64,'.base64_encode( $image['image'] ).'"/>';
			echo "</fieldset>";
			echo '<br />';
		
		//echo '=========================================================';
		}
	}
?>