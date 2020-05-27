<?php
include("config.php");
$table = $_GET['table'];
$action = $_GET['action'];
$tables = array(); //'Diana', 'Becky', 'Zephrine', 'Xena', 'Tiffany', 'Kawasaki', 'BMW');

$conn = new mysqli($servername, $username, $password, "vehicles");
$sql = "show tables";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($tables, $row['Tables_in_vehicles']);
    }
}
$date = date("d/m/Y - G:i");
shell_exec("echo '" . $date . " - " . $_SERVER['REMOTE_ADDR'] . " - " . $table . " - " . $action . "' >> /var/log/app.log");

if ( in_array($table, $tables) ) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ( $action == 'select' ) {
        $sql = "SELECT Date, Mileage, Miles, Litres, Cost FROM $table";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $output .= $value.",";
//                    $output .= "$value|";
                }
                $output = rtrim($output, ",")."\n";
//                $output = $output.",";
            }
        }
    } elseif ( $action == 'insert' ) {
        $date = $_GET['date'];
        $mileage = $_GET['mileage'];
        $miles = $_GET['miles'];
        $litres = $_GET['litres'];
        $cost = $_GET['cost'];
        shell_exec("echo '" . $date . " - " . $mileage . " - " . $miles . " - " . $litres . " - " . $cost . "' >> /var/log/app.log");

        $sql = "INSERT INTO $table (Date, Mileage, Miles, Litres, Cost) VALUES ('$date', '$mileage', '$miles', '$litres', '$cost')";
        $conn->query($sql);

    } elseif ( $action == 'getlast' ) {
        $sql = "SELECT Mileage, Miles, Litres, Cost FROM $table ORDER BY `Date` DESC limit 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $output .= $value.",";
                }
                $output = rtrim($output, ",");
            }
        }

    } else {
        mysqli_close($conn);
        die("Unknown");
    }
}
if ( $output ) {
    print($output);
};
mysqli_close($conn);

?>
