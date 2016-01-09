<?php
include ("include.php");


   $query = 'SELECT image,poster,caption ,pid FROM photo WHERE poster="'.$_SESSION["username"].'"';
      $result = mysqli_query($mysqli,$query);
	// Check result
	// This shows the actual query sent to MySQL, and the error. Useful for debugging.
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	} else{
		for ( $i = 0 ; $i < mysqli_num_rows($result) ; $i++ ) {
        $row = mysqli_fetch_assoc($result);
		mysqli_connect("localhost","root","","prinstagram")or die("Cannot connect to database"); //keep your db name
		//$sql = "SELECT image FROM photo where pid = 42"; // manipulate id ok 
		$query2 = 'SELECT image FROM photo WHERE pid ="' .$row['pid'] . '"';
		$result2 = mysqli_query($mysqli,$query2);
		$image=mysqli_fetch_array($result2);
		echo 'photo ID: '.$row['pid'] .'';
		echo '<br />';
		echo 'Poster: '.$row['poster'] .'';
		echo '<br />';		
		echo 'Capation: '.$row['caption'] .'';
		echo '<br />';
		// this is code to display 
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $image['image'] ).'"/>';
		echo '<br /><br />';
		}
	}

?>