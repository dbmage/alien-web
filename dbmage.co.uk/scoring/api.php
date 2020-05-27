<?php
include "../config.php";
$gameid = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if ( isset($_GET['gameid']) ) {
    $gameid = $_GET['gameid'];
} else {
    $sql = "SELECT `game_id` FROM snooker ORDER BY `game_id` DESC LIMIT 1"; // create select
    $result = $conn->query($sql); // get data from table

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $gameid = $row["game_id"] + 1;
        }
    }
    if ( $gameid == "" ) {
        $gameid = 1;
    }
    print $gameid;
    exit;
}

print("GAMEID IS $gameid");

?>
