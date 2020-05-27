<?php
/*
Urt Admin Web Interface

Developed By: |ALPHA|mission
Read the README.txt file for copyrite info

Version: 1.1
Version Date: Oct 4, 2010

*/
preg_match("/[^\.\/]+\.[^\.\/]+$/", $_SERVER['HTTP_HOST'], $matches);
$domain = $matches[0];
define('INCLUDE_CHECK',true);
require("classes/ipcheck.php");
require 'classes/functions.php';
require 'classes/functions2.php';
require 'classes/q3status.php';
require 'classes/q3rcon.php';
require 'classes/config_inc.php';
$userIP = $_SERVER['REMOTE_ADDR'];


if(isset($_GET['logout']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php");
	exit;
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <?php include "classes/head.php" ?>
    <?php echo $script; ?>
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
</head>

<body class='flexcroll'>

<!-- Panel -->
<?php
include("ppur.php");
?>
<!--panel -->

<div class="pageContent">
	<div id="main" align="center">
	<?php
		echo "<table><tr><td valign='top' width='15%'>";
		//left panel content
		echo getmod(left);
		echo "</td><td valign='top'>
			  <div class='container2'>
			  <br><br></div>
			  <div class='container3'>
                <h1>Sky URT Admin</h1>
				</div>";
		//body content
		echo getmod(body);
		
		// User Content;
		echo "<table><tr><td valign='top' width='220px'>";
		echo getmod(user1);
		echo"</td><td valign='top' width='220px'>";
		echo getmod(user2);
		echo "</td><td valign='top' width='220px'>";
		echo getmod(user3);
		echo "</td></tr></table>";
				
		//footer
		echo getmod(footer);
		
		echo "</td></tr></table>";
			echo "<br><br><div align='center'><a href='admin/'><button class='nav'>Admin Backend</button></a></div>";
	echo "<br><br><div align='center'><font color='white'>{$domain}, Powered by UrtAdmin Web Interface v1.1</font></div>";
	?>
	</div>
</div>

</body>
</html>
