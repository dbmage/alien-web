<?php
$playlist = shell_exec('mpc playlist');
?>
<html>
<body style="color:blue; background-color:black; font-size:25px;">
<marquee direction="up" bgcolor="black" scrollamount="2">
<?php echo"<pre>$playlist</pre>"; ?>
</marquee>
</body>
</html>

