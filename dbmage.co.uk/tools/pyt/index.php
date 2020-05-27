<html>
<title>Youtube downloader</title>
<head>
<style tpye="text/css">
body
{
background-color: black;
color: cornflowerblue;
font-size: 20px;
}
a:link    {color:cornflowerblue; background-color:transparent; text-decoration:none}
a:visited {color:cornflowerblue; background-color:transparent; text-decoration:none}
a:hover   {color:cornflowerblue; background-color:transparent; text-decoration:none}
h1
{
font-size: 50px;
    margin-left: auto;
    margin-right: auto;
    width: 450px;
}
div
{
display: block;
margin-left: auto;
margin-right: auto;
width: 775px;
}
.dow
{
font-size: 20px;
display: block;
margin-left: auto;
margin-right: auto;
width: 120px;
}
</style>
</head>
<body>
<h1>Youtube downloader</h1>
<br>
<?php
$ytdl = shell_exec('youtube-dl -x --add-metadata --write-thumbnail --audio-format mp3 -a ytdl.txt');
$ytdlp = shell_exec('youtube-dl -x --add-metadata --write-thumbnail --audio-format mp3 --yes-playlist -a ytdl.txt');
$url = $_POST["ytur"];
fclose(STDOUT);
?>
<div>
<form method="post" action="<?php echo $PHP_SELF;?>" id="ytu">
<textarea rows="10" cols="100" name="ytur" form="ytu">
</textarea><br>
Playlist<input type="checkbox" name="play" value="1">
<input class="dow" type="submit" value="Download" name="ytdl">
</form>
</div>
<?php
if(isset($_POST['ytdl']))
{$done = "none";
file_put_contents('ytdl.txt', $url, FILE_APPEND | LOCK_EX);
        if($_POST["play"] == '1')
	shell_exec('youtube-dl -x --add-metadata --write-thumbnail --audio-format mp3 --yes-playlist -a ytdl.txt');
	else
	shell_exec('youtube-dl -x --add-metadata --write-thumbnail --audio-format mp3 -a ytdl.txt');
shell_exec('mv *.mp3 /media/1.5tb/Music/youtube/');
shell_exec('mv *.jpg /media/1.5tb/Music/youtube/albumart/');
shell_exec('rm ytdl.txt');
header( "Location: http://192.168.0.40/mpcupdate.php" );}
fi
?>
<style type="text/css">
a.h
{
font-size: 30px;
display: <?php echo"$done"; ?>;
}
</style>
<a class="h">Paste individual Youtube video URLs or playlist URLs into the box.<br>
Select whether you pasted individual URLs or a playlist URL.<br>
Click download!</a>

</body>
</html>
