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
    $red = 10;
    $yellow = 1;
    $green = 1;
    $brown = 1;
    $blue = 1;
    $pink = 1;
    $black = 1;
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
if(isset($_POST['a1']))
{
        $a = $a + 1;
        $ar = $ar + 1;
        $red = $red - 1;
}
if(isset($_POST['a2']))
{
        $a = $a + 2;
        $ay = $ay + 1;
        if ($red < 1)
        {
            $yellow = $yellow - 1;
        }
}
if(isset($_POST['a3']))
{
        $a = $a + 3;
        $agr = $agr + 1;
        if ($red < 1)
        {
            $green = $green - 1;
        }
}
if(isset($_POST['a4']))
{
        $a = $a + 4;
        $abr = $abr + 1;
        if ($red < 1)
        {
            $brown = $brown - 1;
        }
}
if(isset($_POST['a5']))
{
        $a = $a + 5;
        $ablu = $ablu + 1;
        if ($red < 1)
        {
            $blue = $blue - 1;
        }
}
if(isset($_POST['a6']))
{
        $a = $a + 6;
        $ap = $ap + 1;
        if ($red < 1)
        {
            $pink = $pink - 1;
        }
}
if(isset($_POST['a7']))
{
        $a = $a + 7;
        $abla = $abla + 1;
        if ($red < 1)
        {
            $black = $black - 1;
        }
}
if(isset($_POST['b1']))
{
        $b = $b + 1;
        $br = $br + 1;
        $red = $red - 1;
}
if(isset($_POST['b2']))
{
        $b = $b + 2;
        $by = $by + 1;
        if ($red < 1)
        {
            $yellow = $yellow - 1;
        }
}
if(isset($_POST['b3']))
{
        $b = $b + 3;
        $bgr = $bgr + 1;
        if ($red < 1)
        {
            $green = $green - 1;
        }
}
if(isset($_POST['b4']))
{
        $b = $b + 4;
        $bbr = $bbr + 1;
        if ($red < 1)
        {
            $brown = $brown - 1;
        }
}
if(isset($_POST['b5']))
{
        $b = $b + 5;
        $bblu = $bblu + 1;
        if ($red < 1)
        {
            $blue = $blue - 1;
        }
}
if(isset($_POST['b6']))
{
        $b = $b + 6;
        $bp = $bp + 1;
        if ($red < 1)
        {
            $pink = $pink - 1;
        }
}
if(isset($_POST['b7']))
{
        $b = $b + 7;
        $bbla = $bbla + 1;
        if ($red < 1)
        {
            $black = $black - 1;
        }
}
if(isset($_POST['af']))
{
        $a = $a - 4;
}
if(isset($_POST['bf']))
{
        $b = $b - 4;
}
if(isset($_POST['clear']))
{
	session_unset();
	session_destroy();
}


if ($a < "0" ) {
$a = 0;
};
if ($b < "0" ) {
$b = 0;
};
?>
<style type="text/css">
body
{
	background-color: black;
	color: white;
	font-style: bold;
}
td
{
	font-size: 72;
	padding: 10px;
	text-align: center;
}
button
{
	font-size: 50;
	padding: 10px;
}
</style>
<body>
<table>
<form method="POST" action=''>
<tr><td>A</td><td><button type="submit" name="a1">Red</button></td><td><button type="submit" name="a2">Yellow</button></td><td><button type="submit" name="a3">Green</button></td><td><button type="submit" name="a4">Brown</button></td><td><button type="submit" name="a5">Blue</button></td><td><button type="submit" name="a6">Pink</button></td><td><button type="submit" name="a7">Black</button></td><td><button type="submit" name="af">Foul</button></td></tr><br>
<tr><td>B</td><td><button type="submit" name="b1">Red</button></td><td><button type="submit" name="b2">Yellow</button></td><td><button type="submit" name="b3">Green</button></td><td><button type="submit" name="b4">Brown</button></td><td><button type="submit" name="b5">Blue</button></td><td><button type="submit" name="b6">Pink</button></td><td><button type="submit" name="b7">Black</button></td><td><button type="submit" name="bf">Foul</button></td></tr>
<tr><td></td><td colspan="7"><button type="submit" name="clear" style="width:300px;">New game</button></td></tr>
</form>
</table>
<?php
print "A = $a";
print "<br>";
print "B = $b";
?>
</body>
<?php
$_SESSION['a'] = $a;
$_SESSION['ar'] = $ar;
$_SESSION['ay'] = $ay;
$_SESSION['agr'] = $agr;
$_SESSION['abr'] = $abr;
$_SESSION['ablu'] = $ablu;
$_SESSION['ap'] = $ap;
$_SESSION['abla'] = $abla;
$_SESSION['b'] = $b;
$_SESSION['br'] = $br;
$_SESSION['by'] = $by;
$_SESSION['bgr'] = $bgr;
$_SESSION['bbr'] = $bbr;
$_SESSION['bblu'] = $bblu;
$_SESSION['bp'] = $bp;
$_SESSION['bbla'] = $bbla;
$_SESSION['red'] = $red;
$_SESSION['yellow'] = $yellow;
$_SESSION['green'] = $green;
$_SESSION['brown'] = $brown;
$_SESSION['blue'] = $blue;
$_SESSION['pink'] = $pink;
$_SESSION['black'] = $black;
?>

