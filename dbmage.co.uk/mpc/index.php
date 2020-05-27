<?php

  include('settings.conf'); # Include settings

  function nicep($array)
    {
    echo '<ul>';
    foreach($array as $key => $value)
      {
      echo '<li>' . $key . ' => ' . $array[$key] . "</li>\n";
      }
    echo '</ul>';
    }

  if ($_COOKIE["skin"] == "") # Check if the user's picked a skin before
    {
    $_COOKIE["skin"] = $defaultSkin; # If not we just lump'em with our default skin
    }
  foreach ($_POST as $key => $value)
    {
    $key = preg_replace('[_]', ' ', $key);
    exec('mpc ' . escapeshellcmd($key));
    header('Location: /' . $siteDir . '/');
    }
  if ($_GET["track"] != "")
    {
    exec('mpc play ' . escapeshellcmd($_GET["track"]));
    header('Location: /' . $siteDir . '/'); # Redirect user, this stops that annoying resend post data message that some browsers popup when reloading
    }
  $mpctrack = explode('<', exec("echo $(mpc --format '%track%<%title%<%artist%<%album%<%file%<')"));
  #nicep($mpctrack);
  $mpctrack[5] = ereg_replace('#', '', $mpctrack[5]);
  $mpcdetails = explode(' ', $mpctrack[5]);
  #nicep($mpcdetails);
  #print_r($mpcdetails);
  #print_r($_COOKIE);
  #echo '<br>';
  $nowPlaying["number"] = explode('/', $mpcdetails[2]);
  $nowPlaying["number"] = $nowPlaying["number"][0];
  $nowPlaying["track"] = $mpctrack[0];
  $nowPlaying["title"] = $mpctrack[1];
  $nowPlaying["artist"] = $mpctrack[2];
  $nowPlaying["album"] = $mpctrack[3];
  $nowPlaying["file"] = $mpctrack[4];
  $nowPlaying["length"] = explode('/', $mpcdetails[3]);
  $nowPlaying["tlength"] = $nowPlaying["length"][1];
  $nowPlaying["length"][0] = explode(':', $nowPlaying["length"][0]);
  $nowPlaying["length"][0] = ( $nowPlaying["length"][0][0] * 60 ) + $nowPlaying["length"][0][1];
  $nowPlaying["length"][1] = explode(':', $nowPlaying["length"][1]);
  $nowPlaying["length"][1] = ( $nowPlaying["length"][1][0] * 60 ) + $nowPlaying["length"][1][1];
  $nowPlaying["length"]["remaining"] = $nowPlaying["length"][1] - $nowPlaying["length"][0];
  #echo $nowPlaying["length"]["remaining"] . '<br>';
  $nowPlaying["full"] = $nowPlaying["title"] . ' <small>by</small> ' . $nowPlaying["artist"] . ' <small>on</small> ' . $nowPlaying["album"];
  exec('mpc playlist --format \':%track%:%title%:%artist%:%album%:%file%:\'', $playlist);
  if ($nowPlaying["length"]["remaining"] < 0) # Horrible hack to stop crazy reloading when mpd reports the wrong track length :(
    {
    $nowPlaying["length"]["remaining"] = 59;
    }

  if ($mpcdetails[1] == "[playing]")
    {
    if ($_GET["queue"] != "")
      {
      $metaReload = '<meta http-equiv="refresh" content="' . $nowPlaying["length"]["remaining"] . ';index.php?track=' . $_GET["queue"] . '">';
      }
    else
      {
      $metaReload = '<meta http-equiv="refresh" content="' . $nowPlaying["length"]["remaining"] . '">';
      }
    }
  if (!isset($_COOKIE["ypos"]))
    {
    $_COOKIE["ypos"] = '0';
    }

  echo
    (
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <title>
          ' . ereg_replace('<[A-Za-z]+>', '', ereg_replace('/', '', $nowPlaying["full"])) . '
        </title>
        <link rel="author" title="Adam Brightmore" href="mailto: (author) sinister.ray@gmail.com">
        <link rel="icon" type="image/png" href="play.png">
        <link rel="stylesheet" id="skin" type="text/css" href="' . $skinDir . '/' . $_COOKIE["skin"] . '/skin.css">
        ' . $metaReload . '
        <script type="text/javascript">
          function changeSkin(skin)
            {
            document.cookie=\'skin=\' +escape(skin);
            document.getElementById(\'skin\').href=\'skins/\'+skin+\'/skin.css\';
            }
        </script>
      </head>
      <body onload="timedCount();">
        <label for="skinpicker">Skin: </label>
        <select name="skinpicker" onchange="changeSkin(this.value)">
        <option value="None">None</option>'
    );
  foreach(glob('./' . $skinDir . '/*', GLOB_ONLYDIR) as $dir) {
      $dir = str_replace('./' . $skinDir . '/', '', $dir);
      if ($dir == $_COOKIE["skin"])
        {
        echo '<option value="' . $dir . '" selected="selected">' . $dir . '</option>';
        }
      else
        {
        echo '<option value="' . $dir . '">' . $dir . '</option>';
        }
  }
  echo
    (
    '   </select>
        <ol start="' . $nowPlaying["number"] . '" class="nowPlaying">
        <h2>Currently Playing...</h2>
        <li>
          <span>
            ' . $nowPlaying["full"] . ' <small id="remaining">' . $nowPlaying["tlength"] . '</small>
          </span>
        </li>
          <form action="index.php" method="post">
            <input type="submit" name="prev" id="prev" value="Prev">'
    );
  if ($mpcdetails[1] == "[playing]")
    {
    echo
      (
      '<script type="text/javascript">
        function PadDigits(n, totalDigits)
          {
          n = n.toString();
          var pd = \'\';
          if (totalDigits > n.length)
            {
            for (i=0; i < (totalDigits-n.length); i++)
              {
              pd += \'0\';
              }
            }
          return pd + n.toString();
          }
        var time;
        var mins;
        var secs;
        var count=' . $nowPlaying["length"]["remaining"] . ';
        function timedCount()
          {
          count=count-1;
          mins=count/60;
          mins=parseInt(mins);
          secs=count-(mins*60);
          document.getElementById(\'remaining\').innerHTML=PadDigits(mins, 2)+\':\'+PadDigits(secs, 2)+\'/\'+PadDigits(\'' . $nowPlaying["tlength"] . '\', 5);
          }
          setInterval("timedCount()",1000);
      </script>'
      );
    echo '<input type="submit" name="pause" id="pause" value="Pause">';
    }
  else
    {
    echo '<input type="submit" name="play" id="play" value="Play">';
    }
  echo
    (
    '<input type="submit" name="next" id="next" value="Next">
    <input type="submit" name="volume +5" id="volume +5" value="Vol +"><input type="submit" name="volume -5" id="volume -5" value="Vol -">
      </form>
      <a href="#current">Jump to current song!</a><br>
      <a href="javascript:sety();" onclick="sety();">Jump to last position!</a>
    </ol>
    <ol class="playlist">
      <h2>Playlist</h2>'
    );

  foreach($playlist as $key => $value)
    {
    $playlist[$key] = explode(':', $playlist[$key]);
    $playlist["number"] = $key + 1;
    if ($playlist["number"] == $nowPlaying["number"])
      {
      $state = ' id="current"';
      }
    else
      {
      $state = '';
      }
    if ($playlist[$key][2] == "")
      {
      $playlistLine = $playlist[$key][5];
      }
    else
      {
      $playlistLine = $playlist[$key][2] . ' <small>by</small> ' . $playlist[$key][3] . ' <small>on</small> ' . $playlist[$key][4];
      }
    echo
      (
      '<li' . $state . '>
          <span>
            <a class="' . $order . '" id="' . $playlist["number"] . '" href="index.php?track='. $playlist["number"] .'">' .
              $playlistLine
            . '</a> | <a href="index.php?queue='. $playlist["number"] .'">Queue!</a>
          </span>
      </li>'
      );
    }



  echo
    (
    '<script type="text/javascript">
    window.onload=window.scroll(0,' . $_COOKIE["ypos"] . ');
    function gety()
      {
      document.cookie=\'ypos=\' +window.pageYOffset;
      }
    setInterval("gety()",500);
    </script>
    </body>
    </html>'
    );

?>