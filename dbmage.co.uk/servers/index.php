<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<?php
$data = array();
$servers = array(
    "mcp" => array("minecraft", "MC.png", "Puzzle World", "4001"),
    "mcs" => array("minecraft", "MC.png", "Survival World", "4002"),
    "ttdl" => array("openttd", "ttd.png", "Large Map (Hard)", "4011"),
    "ttds" => array("openttd", "ttd.png", "Small Map (Easy)", "4012"),
    "urt" => array("Urban Terror (Sky Clan)", "urt.png", "27960"),
    "sts" => array("Starbound", "sts.png", "21025")
);
$host = "192.168.0.2";
$exthost = "dbmage.co.uk";
$prev = 0;
//get server online/offline states by querying port
//$ttdl = shell_exec('nc -z 192.168.0.2 4011; echo $?');
//$ttds = shell_exec('nc -z 192.168.0.2 4012; echo $?');
//$mcp = shell_exec('nc -z 192.168.0.2 4001; echo $?');
//$mcs = shell_exec('nc -z 192.168.0.2 4002; echo $?');
//$urt = shell_exec('nc -zu 192.168.0.2 27960; echo $?');
//$sts = shell_exec('nc -z 192.168.0.2 21025; echo $?');

foreach ($servers as $server => $values) {
    $port = end($values);
    $lhost = "192.168.0.2";
    $xhost = "dbmage.co.uk";
    if ( $server == "urt" ) {
        $lhost = "udp://192.168.0.2";
    }
    $connection = @fsockopen($lhost, $port);
    $data[$server]['status'] = 'Offline';
    $data[$server]['css'] = 'red';
    $data[$server]['extstatus'] = 'Offline';
    $data[$server]['extcss'] = 'red';
    if ( ! is_resource($connection) ) {
        continue;
    }
    $data[$server]['status'] = 'Online';
    $data[$server]['css'] = 'lime';
    fclose($connection);

    if ( $server == "urt" ) {
        $xhost = "udp://dbmage.co.uk";
    }

    $connection = @fsockopen($xhost, $port);
    $data[$server]['extstatus'] = 'Private';
    if ( ! is_resource($connection) ) {
        continue;
    }
    $data[$server]['extstatus'] = 'Public';
    $data[$server]['extcss'] = 'lime';
    fclose($connection);
}


//get server online users
foreach ($servers as $server => $values) {
    if ( $data[$server]['status'] == "Offline" ) {
        $data[$server]['users'] = 0;
        continue;
    }
//    $data[$server]['users'] = 
    if ( $server == "urt" ) {
        $data[$server]['users'] = shell_exec('/scripts/kkrcon-2.11/./kkrcon.pl -gurt status | tail -n +5 | wc -l');
    }
}
include('urtadmin/classes/q3rcon.php');
?>
<head>
<title>Hosted Game Servers</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<style type="text/css">
body {
background-color: black;
    color: #A0A0A0;
}

a {
    text-decoration: none;
    font-size: 30;
    padding: 10px;
}

a:visited {
    color: red;
}

a:hover {
    color: blue;
}

td {
    border: 1px solid grey;
    padding: 5px;
}

.game {
    border: none;
}

.adam {
    position: absolute;
    top; 0px;
    right: 0px;
    text-decoration: none;
}

a.head {
    text-decoration: none;
    font-size: 30;
    padding: 10px;
}

<?php
foreach ($data as $server => $items) {
    echo "." . $server . " {\n";
    echo "    color: " . $data[$server]['css'] . ";\n";
    echo "}\n";
    echo "." . $server . "ext {\n";
    echo "    color: " . $data[$server]['extcss'] . ";\n";
    echo "}\n";

}
?>
a.ext {
    color: green;
    text-decoration: none;
}
a.ext:visited {
    color: green;
}

a.ext:hover
{
    color: yellow;
}

</style>
</head>
<body>
<a class="head">Hosted game servers</a><div class="adam"><a>You should also check out </a><a class="ext" href="http://gamemage.org/"><img src="../img/gm.svg" width="40px"> Game Mage</a></div><br><br><br>
<table>
<tr><th></th><th><a>Game Type</a></th><th><a>Server Port</a></th><th><a>Status</a></th><th>Server Type</th><th><a>Users Online</a></th></tr>
<?php
foreach ( $servers as $server => $items) {
    $count = count($items);
    $port = end($items);
    echo "<tr>\n";
    if ( $count > 3) {
        if ( $prev == 0 ) {
            echo "    <td rowspan='2' class='game'><a href='" . $items[0] . ".php'><img src='../img/" . $items[1] . "' width='400px'></a></td>\n";
            $prev = 1;
        } elseif ( $prev == 1 ) {
            $prev = 0;
        }
        echo "    <td><a>" . $items[2] . "</a></td>\n    <td><a>" . $exthost . ":" . $port . "</a></td>\n";
        echo "    <td><a class='" . $server . "' href='" . $server . "t.php'>" . $data[$server]['status'] . "</a></td>\n";
        echo "    <td><a class='" . $server . "ext'>" . $data[$server]['extstatus'] . "</a></td>\n";
        echo "    <td><a>" . $data[$server]['users'] . "</a></td>\n";
    } else {
        echo "    <td class='game'><a><img src='../img/" . $items[1] . "' width='400px'></a></td>\n";
        echo "    <td><a>" . $items[0] . "</a></td>\n    <td><a>" . $exthost . ":" . $port . "</a></td>\n";
        echo "    <td><a class='" . $server . "' href='" . $server . "t.php'>" . $data[$server]['status'] . "</a></td>\n";
        echo "    <td><a class='" . $server . "ext'>" . $data[$server]['extstatus'] . "</a></td>\n";
        echo "    <td><a>" . $data[$server]['users'] . "</a></td>\n";
    }
    echo "</tr>\n";
}
?>
</table>

</body>
</html>
