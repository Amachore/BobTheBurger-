<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bob_the_burger_inventory";

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully!";
?>