<?php include("../template_top.php");
$trycount = 0;
$locked = "";
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
if(file_exists("$ip.txt") == 1) {
	$trycount = file_get_contents("$ip.txt");
	$diff = time() - filemtime("$ip.txt");
	if ($trycount > 5 && $diff < 3600) {
		echo "<h2>Too many incorrect attempts</h2>";
		echo "<h2>Page locked for one hour</h2>";
		$locked = "none";
	}
};
?>
<title>Game account password reset</title>
<link rel="stylesheet" type="text/css" href="../dbmage.css">
<style type="text/css">
div {
display: <?php echo $locked ?>;
}
</style>
</head>
<body>
<div style="height: 100%; z-index: 2">
<h1 style="color: white;">Please enter your username and email:</h1><br>
<form  method="post" action="">
<a style="color: white;">Username:</a>&nbsp&nbsp<input type="text" size="20" name="user" placeholder="Between 5 & 20 characters"><br>
<a style="color: white;">Email:</a>&nbsp&nbsp<input type="text" size="40" name="email" placeholder="Please enter a valid email"><br>
<input type="submit" value="Submit" name="submit">
</form>
<?php
if(isset($_POST['submit']))
{
	$user = $_POST["user"];
	$email = $_POST["email"];
	$allusers = array();
	$allemail = array();
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
   		die("Connection failed: " . $conn->connect_error);
	}
	$all = "SELECT * FROM users";
	$result = $conn->query($all);
	while($row = $result->fetch_assoc()) {
		$data = $row["username"] . "," . $row["email"];
		array_push( $allusers, $data);
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
		echo "<h2>Please enter a valid email address</h2>";
	} elseif (! in_array("$user,$email", $allusers) ) {
		echo "<h2>Those details do not match any registered users.</h2>";
		if ($trycount > 0) {
		$trycount++;
		file_put_contents("$ip.txt", "$trycount");
		} else {
		file_put_contents("$ip.txt", "1");
		};
	} else {
		echo "<h2>Please check your email. Please note the email could take up to two hours.</h2>";
		shell_exec("rm $ip.txt; /scripts/gameforgot.pl $ip $user");
		shell_exec('echo "The below link is valid for two hours.\n http://dbmage.co.uk/game/reset{$ip}.php" | mail -s "Password Reset" {$email}');
	}
}
?>
</div>
<?php include("../template_bottom.php"); ?>
