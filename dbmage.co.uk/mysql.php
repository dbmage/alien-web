<?php
if (! isset($_GET['password']) ) {
    exit();
};
include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password, "Stuff");
$pass = $_GET['password'];

$pass = shell_exec('perl /usr/sbin/tools/process.pl ' . $pass);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT u.username, ac.appconfig FROM Users AS u
LEFT JOIN housecontrolapp AS ac ON u.id = ac.userid
WHERE u.password = '" . $pass . "'"; // create select
$result = $conn->query($sql); // get data from table
if ( $conn->error ) {
    die($conn->error);
};
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array( "username" => $row['username'] );
    $userconfig = json_decode($row['appconfig']);
    foreach ($userconfig as $key => $item) {
        $data[$key] = $item;
    }
    print(json_encode($data));
    return;
};
print(0);
?>
