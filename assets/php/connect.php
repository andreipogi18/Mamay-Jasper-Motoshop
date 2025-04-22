<?php
$serverName = "localhost";
$userName = "root";
$serverPassword = "";
$databaseName = "se";

$conn = mysqli_connect($serverName, $userName, $serverPassword, $databaseName);
if ($conn->connect_errno) {
    echo '<script>alert("Connection Failed")</script>';
}

?>