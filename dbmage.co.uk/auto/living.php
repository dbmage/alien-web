<?php
$thing = $_GET['a'];



//if ( $thing eq ") {

//} else if ( ) {

//}
$url = "192.168.0.102:5000/flip/living/" . $thing;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
$action = curl_exec($curl);
?>
