<!DOCTYPE html>
<!-- Example Blog written by Raymond Mui -->
<html>
<title>Post</title>
<form action="imageUpload.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Image Upload</legend>
<label for="userFile">Small image to upload: </label>
<input type="file" size="40" name="userFile" id="userFile"/><br />
<br />
<label for="altText">Description of image</label>
<input type="text" size="60" name="altText" id="altText"/><br />
<br />
<label for="lat">Latitude</label>
<input type="text" size="40" name="lat" id="lat"/><br />
<br />
<label for="lnge">Longitude</label>
<input type="text" size="40" name="lnge" id="lnge"/><br />
<br />
<label for="lname">Location name</label>
<input type="text" size="40" name="lname" id="lname"/><br />
<br />
Do you want it to be public:
<select name="publicity">
	<option value='1' id='publicity'>public</option>
	<option value='0' id='publicity'>private</option>
<input type="submit" value="Upload File" />
</fieldset>
</form>
</fieldset>
</form>
</html>
<?php

include "include.php";

//if the user is not logged in, redirect them back to homepage
if(!isset($_SESSION["username"])) {
  echo "You are not logged in. ";
  echo "You will be returned to the homepage in 3 seconds or click <a href=\"index.php\">here</a>.\n";
  header("refresh: 3; index.php");
}

$mysqli->close();
?>

</html>