<body>
<h1>Uploading Images to MySQL</h1><p>
<?php
include "include.php";
if ( !isset($_FILES['userFile']['type']) ) {
   die('<p>No image submitted</p></body></html>');
}
?>
You submitted this file:<br /><br />
Temporary name: <?php echo $_FILES['userFile']['tmp_name'] ?><br />
Original name: <?php echo $_FILES['userFile']['name'] ?><br />
Size: <?php echo $_FILES['userFile']['size'] ?> bytes<br />
Type: <?php echo $_FILES['userFile']['type'] ?></p>

<?php
// Validate uploaded image file
if(!isset($_SESSION["username"])) {
  echo "You are not logged in. ";
  echo "You will be returned to the homepage in 3 seconds or click <a href=\"index.php\">here</a>.\n";
  header("refresh: 3; index.php");
}
if ( !preg_match( '/gif|png|x-png|jpeg/', $_FILES['userFile']['type']) ) {
   die('<p>Only browser compatible images allowed</p></body></html>');
} else if ( strlen($_POST['altText']) < 1) {
   die('<p>Please provide meaningful alternate text</p></body></html>');
} else if ( $_FILES['userFile']['size'] > 1638400 ) {
   die('<p>Sorry file too large</p></body></html>');
}// Copy image file into a variable
  else if ( !($handle = fopen ($_FILES['userFile']['tmp_name'], "r")) ) {
   die('<p>Error opening temp file</p></body></html>');
} else if ( !($image = fread ($handle, filesize($_FILES['userFile']['tmp_name']))) ) {
   die('<p>Error reading temp file</p></body></html>');
} else {
   fclose ($handle);
   // Commit image to the database
   $image = $mysqli->real_escape_string($image);
   $alt = htmlentities($_POST['altText']);
   $publicity = htmlentities($_POST['publicity']);
   //$username = htmlspecialchars($username);
   $query = 'INSERT INTO photo (caption ,image, poster, pdate, is_pub) VALUES ("'.$alt  . '","' . $image . '","'. $_SESSION["username"] .'", NOW(),"'. $publicity .'")';
   $result = mysqli_query($mysqli,$query);
   /////////////=====================================get pid---------------------------
   	$query2 = "select pid from photo where pdate= NOW()";
	$result2 = mysqli_query($mysqli,$query2);
	$row = mysqli_fetch_assoc($result2);
	echo "==========================/"; echo $row['pid']; echo "/==========================";
	////get pid==========================================================
	$pid =  $row['pid']; 
	// Check result
	// This shows the actual query sent to MySQL, and the error. Useful for debugging.
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	} else{
		echo '<br /><a href="index.php">Go back</a>';	
		echo '<br />';
	echo('<p>Image successfully copied to database</p></body></html>');
	}
	if($publicity==0){
		
	    echo 'This is a private picture, click ';
		echo '<a href="share.php?pid=';
		echo htmlspecialchars($pid);
		$pid = htmlspecialchars($pid);
		echo "\">share</a>\n";
		//echo '<a href="share.php>share </a> ';	
		echo ' to share this picture with group.';
		}
}
?>
</body>