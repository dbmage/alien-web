<?php
session_start();
if ($_SESSION['a'] == "" and $_SESSION['b'] == "")
{
    $a = 0;
    $b = 0;
    $ar = 0;
    $ay = 0;
    $agr = 0;
    $abr = 0;
    $ablu = 0;
    $ap = 0;
    $abla = 0;
    $br = 0;
    $by = 0;
    $bgr = 0;
    $bbr = 0;
    $bblu = 0;
    $bp = 0;
    $bbla = 0;
} else {
    $a = $_SESSION['a'];
    $b = $_SESSION['b'];
    $ar = $_SESSION['ar'];
    $ay = $_SESSION['ay'];
    $agr = $_SESSION['agr'];
    $abr = $_SESSION['abr'];
    $ablu = $_SESSION['ablu'];
    $ap = $_SESSION['ap'];
    $abla = $_SESSION['abla'];
    $br = $_SESSION['br'];
    $by = $_SESSION['by'];
    $bgr = $_SESSION['bgr'];
    $bbr = $_SESSION['bbr'];
    $bblu = $_SESSION['bblu'];
    $bp = $_SESSION['bp'];
    $bbla = $_SESSION['bbla'];
    $red = $_SESSION['red'];
    $yellow = $_SESSION['yellow'];
    $green = $_SESSION['green'];
    $brown = $_SESSION['brown'];
    $blue = $_SESSION['blue'];
    $pink = $_SESSION['pink'];
    $black = $_SESSION['black'];
};

if ($black == "0") {
    if ($a > $b) {
        $wina = inline;
        $winb = none;
        $win = none;
    } elseif ($b > $a) {
        $winb = inline;
        $wina = none;
        $win = none;
    };
} else {
        $wina = none;
        $winb = none;
        $win = inline;
};
?>
<head>
<META HTTP-EQUIV="refresh" CONTENT="5">
<style type="text/css">
body
{
	background-color: black;
	color: white;
	font-style: bold;
}
table
{
	border: 1px solid white;
	text-align: center;
        display: <?php echo $win; ?>;
	}
td
{
	font-size: 120pt;
	padding: 10px;
	color: white;
}
th
{
	font-size: 41pt;
	padding: 10px;
}
img
{
width: 100%;
}
.awinner
{
display: <?php echo $wina; ?>;
width: 100%;
height: 100%;
font-size: 900%;
}
.bwinner
{
display: <?php echo $winb; ?>;
width: 100%;
height: 100%;
font-size: 900%;
}
</style>
</head>
<body>
<br><br>
<table>
<tr><th colspan="3"></th><th colspan="7">Balls Potted</th></tr>
<tr><th>Player</th><th>Score</th><th></th><th><img src="red.png"></th><th><img src="yellow.png"></th><th><img src="green.png"></th><th><img src="brown.png"></div></th><th><img src="blue.png"></th><th><img src="pink.png"></th><th><img src="black.png"></th></tr>
<tr style="outline: thin solid"><td>A</td><td><?php print $a; ?></td><th></th><td><?php print $ar; ?></td><td><?php print $ay; ?></td><td><?php print $agr; ?></td><td><?php print $abr; ?></td><td><?php print $ablu; ?></td><td><?php print $ap; ?></td><td><?php print $abla; ?></td></tr>
<tr style="outline: thin solid"><td>B</td><td><?php print $b; ?></td><th></th><td><?php print $br; ?></td><td><?php print $by; ?></td><td><?php print $bgr; ?></td><td><?php print $bbr; ?></td><td><?php print $bblu; ?></td><td><?php print $bp; ?></td><td><?php print $bbla; ?></td></tr>
</table>
<h1 class="awinner">PLAYER  A WINS!!!<br><?php echo $a; ?> points to <?php echo $b; ?>!</h1>
<h1 class="bwinner">PLAYER  B WINS!!!<br><?php echo $b; ?> points to <?php echo $a; ?>!</h1>
</body>
