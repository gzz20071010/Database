<?php
include ("include.php");

	//1.get 
   $query = 'SELECT pid, poster, caption FROM shared natural join ingroup natural join photo WHERE username = "'.$_SESSION['username'].'"';
   $result = mysqli_query($mysqli,$query);
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	} else{
		for ( $i = 0 ; $i < mysqli_num_rows($result) ; $i++ ) {
			$row = mysqli_fetch_assoc($result);//get pid each and then display
			$query2 = 'SELECT image FROM photo WHERE pid ="' .$row['pid'] . '"';
			$result2 = mysqli_query($mysqli,$query2);
			$image=mysqli_fetch_array($result2);
			$query3 = 'SELECT ctext, ctime, username FROM comment natural join commenton WHERE pid ="' .$row['pid'] . '"';
			$result3 = mysqli_query($mysqli,$query3);
			$query4 = 'SELECT taggee FROM tag WHERE pid ="' .$row['pid'] . '" and tstatus=1';
			$result4 = mysqli_query($mysqli,$query4);
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
				echo ''.$row1['username'] .''; 
				echo ' ';
				echo 'says:'.$row1['ctext'] .'';	
				echo  '   '.$row1['ctime'] .'';
				echo '<br />';		
			}
			echo "</fieldset>";
			//show taggee
			echo "<fieldset><legend>Taggee</legend>";
			for ($j = 0; $j < mysqli_num_rows($result4); $j++){
				$row2 =  mysqli_fetch_assoc($result4);
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