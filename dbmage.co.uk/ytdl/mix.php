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
}
.dow
{
font-size: 27px;
height: 35px;
}
textarea
{
   resize: none;
}
</style>
</head>
<body>
<h1>Youtube Mix & Compilation downloader</h1>
<br>
<?php
$url = $_POST["ytur"];
fclose(STDOUT);
?>
<div>
<form method="post" action="<?php echo $PHP_SELF;?>" id="ytu">
<textarea rows="2" cols="60" name="ytur" form="ytu">
</textarea>
<input class="dow" type="submit" value="Download" name="ytdl">
</form>
</div>
<?php
if(isset($_POST['ytdl']))
{$done = "none";
$loading = "";
file_put_contents('mix.txt', $url, FILE_APPEND | LOCK_EX);
	shell_exec('youtube-dl -x --audio-format mp3 -a mix.txt');
shell_exec('mv *.mp3 /media/1.5tb/Music/youtube/');
shell_exec('mv *.jpg /media/1.5tb/Music/youtube/albumart/');
shell_exec('rm mix.txt');
echo "<a style='font-size:30px; color:red' href='../media/music/youtube'>Downloaded file/files</a>";}
fi
?>
<style type="text/css">
a.h
{
font-size: 30px;
display: <?php echo"$done"; ?>;
}
</style>
</body>
</html>
