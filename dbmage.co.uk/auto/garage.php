<?php
$thing = $_GET['a'];

$url = "192.168.0.102:5000/flip/garage/" . $thing;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
$action = curl_exec($curl);
?>
