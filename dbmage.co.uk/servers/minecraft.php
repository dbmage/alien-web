<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<title>Minecraft Rules and Info</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<style type="text/css">
body {
	background-color: grey;
	font-size:16;
}
.time {
	margin-left: auto;
	margin-right: auto;
	width: 80%;
	color: white;
}
.large {
	position: fixed;
	top: 0px;
}
.small {
	position: fixed;
	right: 50px;
	top: 0px;
}
td {
	padding: 10px;
}

</style>
</head>
<body>
<?php
$surpid = file_get_contents("/MCserver/Survival/mcpid.pid");
$surpid = rtrim($surpid);
$command = "sudo pmap ";
$command .= $surpid;
$command .= " | grep total | sed 's/\s\s*/ /g' | cut -d ' ' -f 3 | sed 's/k//i'";
$surmemory = shell_exec("$command") / 1024;
$surhumanmem = sprintf("%.2f %s", $surmemory, "MB");
$puzpid = file_get_contents("/MCserver/Puzzle/mcpid.pid");
$puzpid = rtrim($puzpid);
$command = "sudo pmap ";
$command .= $puzpid;
$command .= " | grep total | sed 's/\s\s*/ /g' | cut -d ' ' -f 3 | sed 's/k//i'";
$puzmemory = shell_exec("$command") / 1024;
$puzhumanmem = sprintf("%.2f %s", $puzmemory, "MB");
$surplayers = rtrim(shell_exec("/scripts/mcrcon/./mcrcon.pl --list | cut -d ' ' -f 3"));
//$puzplayers = rtrim(shell_exec("/scripts/mcrcon/./mcrcon.pl --list | cut -d ' ' -f 3"));
$puzplayers = "";
$suruptime = shell_exec("ps -p ".$surpid." -o etime= | sed 's/\s//g'");
$puzuptime = shell_exec("ps -p ".$puzpid." -o etime= | sed 's/\s//g'");
?>
<table>
	<tr>
		<th>Server</th>
		<th>Players</th>
		<th>Memory</th>
		<th>Uptime</th>
	</tr>
	<tr>
		<td>Puzzle</td>
		<td><?php print $surplayers; ?></td>
		<td><?php print $surhumanmem; ?></td>
		<td><?php print $suruptime; ?></td>
	</tr>
	<tr>
		<td>Survival</td>
		<td><?php print $puzplayers; ?></td>
		<td><?php print $puzhumanmem; ?></td>
		<td><?php print $puzuptime; ?></td>
	</tr>
</body>
</html>
