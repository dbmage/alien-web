<?php include("pp.php"); ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="game.css">
<title>THE SONG GAME</title>
<body>
<h1>Upload songs here!!</h1>
<h1> Make sure the name is just the title, no Artists or Albums!!</h1>
<span>
<?php
$target_dir = "/var/www/game/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
if (empty($_POST['submit'])) {
echo "";
} else {
// Check if file already exists
if (file_exists($target_file)) {
    echo "<h2>File already exists!!</h2>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h2>Sorry, your file was not uploaded.</h2>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<h2>You're file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</h2>";
    } else {
        echo "<h2>Sorry, there was an error uploading your file.</h2>";
    }
}
}
?>
</span>
<fieldset class="input"><form action="index.php" method="post" enctype="multipart/form-data">
Select file:
    <input type="file" name="fileToUpload" id="fileToUpload"><input type="submit" value="UPLOAD!" name="submit">
</form></fieldset>

<fieldset class="dir">
<h2>Previously Uploaded Songs:</h2>
<iframe src="dir.php"></iframe>
</fieldset>
</body>
</html>
