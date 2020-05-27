<?php
include("db_connect.php");

$database = 'gallery';
$table = 'images';
// use the same name as SQL table

//$password = '123';
// simple upload restriction,
// to disallow uploading to everyone

if (!mysql_connect($dbhost, $dbuser, $dbpwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");

$dir = 'images';
$pictures = scandir($dir);
foreach($pictures as $image) {
    if ($image == '.' || $image == '..') {
        continue;
    }

    INSERT INTO `$database`.`$table` (
    `id` ,
    `filename`,
    )
    VALUES (
    NULL , '$image'
    );
    ";

}
echo "done";
?>

