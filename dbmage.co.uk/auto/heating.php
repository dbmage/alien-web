<?php
$thing = $_GET['a'];
if (!empty($_GET['timer'])) {
    $timer = $_GET['timer'];
    $url = "192.168.0.100:5000/" . $timer . "/" . $thing;
} else {
    $url = "192.168.0.100:5000/" . $thing;
};
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
$action = curl_exec($curl);
?>
