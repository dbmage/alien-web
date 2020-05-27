<?php
$host = $_GET['host'];
$ip = shell_exec("dig +short $host");
print $ip;
?>

