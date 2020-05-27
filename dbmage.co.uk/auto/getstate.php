<?php
include("config.php");

$thing = $_GET['a'];

if (! $setup[$thing] ) {
    return;
};

$pi = $setup[$thing];

if ( $pi == "sakura" ) {
    $url = "http://192.168.0.102:5000/getstateapp/" . $thing;
} else if ( $pi == "sasuke" ) {
    $url = "http://192.168.0.100:5000/getstateapp/" . $thing;
} else if ( $pi == "naruto" ) {
    $url = "http://192.168.0.101/getstateapp.php?a=" . $thing;
}

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$action = curl_exec($curl);
print $action;
?>
