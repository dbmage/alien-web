<?php
/*
Urt Admin Web Interface

Developed By: |ALPHA|mission
Read the README.txt file for copyrite info

Version: 1.1
Version Date: Oct 4, 2010

*/

define("INCLUDE_CHECK", true);
include("../classes/config_inc.php");
include("ppad.php");
include("classes/ipcheck.php");
include("classes/usrmgr.php");
include("classes/srvmgr.php");
include("classes/modmgr.php");
include("classes/menumgr.php");
include("classes/stylemgr.php");
include("classes/settingsmgr.php");
$userIP = $_SERVER['REMOTE_ADDR'];
$act = $_POST['action'];
$id = $_POST['entID'];
preg_match("/[^\.\/]+\.[^\.\/]+$/", $_SERVER['HTTP_HOST'], $matches);
$domain = $matches[0];
if (file_exists("add.php")) {
	die("add.php exists, you cannot access this site when this file exists, please create your user then delete/rename this file!");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $CONFIG['title'];?></title>
<!--[if !IE 6]><!--><link rel="stylesheet" type="text/css" href="admin.css" /><!--<![endif]-->
</head>
<body>
<?php
echo "<div align='center'>";
echo "<table class='container3'><tr><td><div align='center'>";
echo "<table>";
echo "<tr><td><a href='../urtadmin/'><button class='nav'>Home</button></a></td><td><form action='' method='post'><button type='submit' class='nav' name='action' value='usrmgr'>User Manager</button></td><td><button type='submit' name='action' class='nav' value='srvmgr'>Server Manager</button></td><td><button type='submit' class='nav' name='action' value='modmgr'>Module Manager</button></td><td><button type='submit' class='nav' name='action' value='menumgr'>Menu Manager</button></td><td><button type='submit' class='nav' name='action' value='stylemgr'>Style Manager</button></td><td><button type='submit' class='nav' name='action' value='settingsmgr'>Settings Manager</button></form></td></tr>";
echo "</table><br><br><br>";

if ($act != '') {
	echo $act($id);
}
echo "<br><br><br><br><a href='?logout'>Logout</a><br><br>Your IP: {$_SERVER['REMOTE_ADDR']}</div></td></tr></table></div>";
echo "<br><br><div align='center'><font color='white'>{$domain}, Powered by UrtAdmin Web Interface v1.1</font></div>";
?>
</body>
</html>
