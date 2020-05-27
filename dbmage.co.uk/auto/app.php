<?php
$where = $_GET['a'];
$thing = $_GET['b'];
$timer = $_GET['c'];
$action = "";

if (! isset( $thing ) ) {
    return;
} else if ( $where == 'perry' || $where == 'garage' || $where == 'living' ) { 

    $url = "http://192.168.0.102:5000/flip/$where/" . $thing;
    
} else if ( $where == 'heating' || $where == 'joe' ) {

    if ( isset( $timer ) ) {
        $url = "http://192.168.0.100:5000/timer/" . $timer;
    } else {
        $url = "http://192.168.0.100:5000/" . $thing;
    };
    
} else if ( $where == 'loft' || $where == 'dale' || $where == 'shaun' ) {

    $url = "http://192.168.0.101/flip/" . $thing;
    
};

if ( isset( $url ) ) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    $action = curl_exec($curl);
};

