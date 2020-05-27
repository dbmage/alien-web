<?php
$dadip = file_get_contents("/media/dad/dadextip.txt");
$dadip = preg_replace('/\s+/', '', $dadip);
header("location: http://{$dadip}");
?>
