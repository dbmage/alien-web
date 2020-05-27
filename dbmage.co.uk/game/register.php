<?php include("../template_top.php"); ?>
<title>Game account registration</title>
<link rel="stylesheet" type="text/css" href="../dbmage.css">
</head>
<body>
<div style="height: 100%; z-index: 2">
<h1 style="color: white;">Please fill out the following:</h1><br>
<form  method="post" action="">
<a style="color: white;">Username:</a>&nbsp&nbsp<input type="text" size="20" name="user" placeholder="Between 5 & 20 characters"><br>
<a style="color: white;">Password:</a>&nbsp&nbsp<input type="password" size="20" name="pass" placeholder="Between 5 & 20 characters"><br>
<a style="color: white;">Email:</a>&nbsp&nbsp<input type="text" size="40" name="email" placeholder="Please enter a valid email"><br>
<input type="submit" value="Submit" name="submit">
</form>
<?php
if(isset($_POST['submit']))
{
	$user = $_POST["user"];
	$pass = $_POST["pass"];
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
		array_push( $allusers, $row["username"]);
		array_push( $allemail, $row["email"]);
	}
	if( strlen($user) < 5 ) {
		echo "<h2>The username '$user' is not long enough.</h2>";
	} elseif( strlen($pass) < 5 ) {
		echo "<h2>That password is not long enough.</h2>";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
		echo "<h2>Please enter a valid email address</h2>";
	} elseif ( in_array("$user", $allusers) ) {
		echo "<h2>The username '$user' is already taken.</h2>";
	} elseif ( in_array("$email", $allemail) ) {
		echo "<h2>Someone has already registered with '$email'.</h2>";
		echo "<a>Have you </a>";
		echo "<a href='";
		echo "?forgot='yes'";
		echo '">forgotten your password</a><a>?</a>';
	} else {
		$pass = md5($pass);
		$sql = "INSERT INTO game (username, password, email)
		VALUES ('$user', '$pass', '$email')";

		if ($conn->query($sql) === TRUE) {
    			echo "<h2>Registration successful</h2>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		shell_exec('echo -e "Thank you for registering for the game!\nYour account is currently still subject to removal, if the administrator deems it necessary." | mail -s "Welcome!" {$email}');
		shell_exec('echo "Username: ${user} email: ${email}" | mail -s "New user" joe');
	}
}
?>
</div>
<?php include("../template_bottom.php"); ?>
