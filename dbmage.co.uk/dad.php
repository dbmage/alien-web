<?php
$update = date ("F d Y H:i:s.", fileatime("/media/dad/atq.txt"));
$dadip = exec('cat /media/dad/dadextip.txt');
include '/var/www/default.php';
?>
<style type="text/css">
h2
{
color: #A0A0A0
}
</style>
<body>
<?php
echo "<h2>IP address is: " . $dadip . "</h2><br>";
echo "<h2>Last communication with HeatingPi: " . $update . "</h2>";
?>
</body>
