<?php include "../config.php"?>
<html>
<title>Food choice for <?php echo date("l");?></title>
<link rel="stylesheet" type="text/css" href="<?php $SRV['WEBROOT']?>/dbmage.css">
<style type="text/css">
h1, tr
{
	color: white;
}
input
{
	width: 20%;
	height: 15%;
	font-size: 30px;
}
</style>
<body>
<?php
if(isset($_POST['no']))
{
	echo "<h1>OK what about</h1>";
	$output = shell_exec("/usr/bin/perl /usr/sbin/tools/food.pl no");
	echo $output;
	echo "no";
	echo "<br>";
	echo "<form method='post' action='index.php'>";
	echo "<input type='submit' value='No Thanks' name='no'>";
} else {
	echo "<h1>Todays choice is</h2>";
	$output = shell_exec("/usr/bin/perl /usr/sbin/tools/food.pl");
	echo $output;
	echo "<br>";
	echo "<form method='post' action='index.php'>";
	echo "<input type='submit' value='No thanks' name='no'>";
}
?>
</form>
<br><br>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM Food";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
//     echo "<table><tr><th>Food</th></tr>";
     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "<tr><td>" . $row["Food"]. "</td></tr>";
     }
//     echo "</table>";
//} else {
//     echo "0 results";
//}

$conn->close();
?>

<table>

</body>
</html>
