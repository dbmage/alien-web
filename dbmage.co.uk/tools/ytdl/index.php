<?php
include("../template_top.php");
include("../config.php");
?>
<?php
$done = "";
$download = "";
$url = "";
if(isset($_POST['ytdl'])) {
   $done = "none";
   $loading = "";
   $url = $_POST["ytur"];
   $submittime = date("d/m/Y H:i:s");
   $submitip = $_SERVER['REMOTE_ADDR'];
   file_put_contents('ytdl.txt', $url, FILE_APPEND | LOCK_EX);
   $start = time();
   if($_POST["play"] == '1') {
       //shell_exec('youtube-dl -x --output "%(title)s-%(artist)s.%(ext)s" --write-thumbnail --audio-quality 0 --audio-format mp3 --yes-playlist -a ytdl.txt');
       shell_exec('youtube-dl -x --output "%(title)s.%(ext)s" --write-thumbnail --audio-format mp3 --yes-playlist -a ytdl.txt');
   } else {
       //shell_exec('youtube-dl -x --output "%(title)s-%(artist)s.%(ext)s" --write-thumbnail --audio-quality 0 --audio-format mp3 -a ytdl.txt');
       shell_exec('youtube-dl -x --output "%(title)s.%(ext)s" --write-thumbnail --audio-format mp3 -a ytdl.txt');
   }
   $end = time();
   $duration = $end - $start;
   if ( $duration < 10 ) {
      echo "<h2>The tool did not take very long to complete. If the song is not in the folder please report the issue to dbmage666@gmail.com</h2>";
      shell_exec("echo 'We may need to update the youtube-dl tool. Execution time was " . $difference . " seconds' | mail -s 'youtube tool potential error' dbmage666@gmail.com");
   };
   shell_exec('rename -v "s/\^\s/ /g" *');
   shell_exec('rename -v "s/\_/ /g" *');
   shell_exec('rename -v "s/[^a-zA-Z0-9.-]/ /g" *');
   shell_exec('mv *.mp3 /media/2tb/1.5tb/Music/youtube/');
   shell_exec('mv *.jpg /media/2tb/1.5tb/Music/youtube/albumart/');
   shell_exec('rm ytdl.txt');
   $download = "<a style='font-size:30px; color:red' href='../music/youtube'>Downloaded file/files</a>";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
   $sql = "INSERT INTO youtube (Time, URL, IP)
   VALUES ('$submittime', '$url', '$submitip')";
   $conn->query($sql);
   $conn->close();
}
?>
<title>Youtube downloader</title>
<style type="text/css">
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
a.h
{
font-size: 30px;
display: <?php echo"$done"; ?>;
}
</style>
</head>
<body>
<h1>Youtube downloader</h1>
<br>
<a class="h" style="display: block; margin-left: auto; margin-right: auto; width: 650px;">1. Paste Youtube video or playlist URLs into the box.<br>
2. If your downloading a playlist tick the box.<br>
3. Click download!<br></a>
<div>
<form method="post" action="" id="ytu">
<textarea rows="10" cols="100" name="ytur">
</textarea><br>
<a style="font-size:30px;">Playlist</a><input type="checkbox" name="play" value="1">
<input class="dow" type="submit" value="Download" name="ytdl">
</form>
</div>
<?php
echo $download;
?>
<a class="h">A link to the download folder will appear once the downloading is done!</a><br><br>
<a>The downloads folder gets emptied daily, songs get moved to </a><a style="color: red; font-weight: bold;" href="../music/?dir=new%20%28unsorted%29">this</a><a> folder</a><br>
<?php include("../template_bottom.php"); ?>
