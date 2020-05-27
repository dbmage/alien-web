<?php include("pp.php");
include("../template_top.php");
$dir = "/var/www/game/music/*";
$songcount = shell_exec("ls -R $dir | egrep -i 'mp3|wma|wav' | wc -l");
$files = explode("\n", shell_exec("find -L -iname '*mp3' -o -iname '*wma' -o -iname '*wav'")); // -o -iname '*flac'
$current = rand (0,$songcount);
if ( preg_match("/\?/", $_SERVER[REQUEST_URI])) {
$playing = "none";
} else {
$playing = "";
};
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="game.css">
<head>
<style type="text/css">
h2 {
display: <?php echo $playing; ?>;
}
/*audio
{
display: none;
}*/
</style>
</head>
<title>THE SONG GAME</title>
<body>
<h2>Each level contains a 10 second clip from a song, and you have to guess the artist or title from the clip</h2>
<h2>Each time you get it right you get a point, each time you get it wrong you lose a point.</h2>
<h2>The leader table will be displayed on the right. This game has as many levels as I have songs in the directory</h2>
<h2>There are currently <?php echo $songcount; ?> levels!</h2>
<audio id="sample" src="<?php echo preg_replace('/\.\/music/', 'http://dbmage.co.uk/game/music', $files[$current]);?>" controls preload></audio>
</body>
</html>
<?php
include("../template_bottom.php");
?>