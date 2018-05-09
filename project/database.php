<?php
$host = "localhost";
$user = "cohunter";
$password = "";
$database = "finalproject";

$db = new mysqli($host, $user, $password, $database);

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    exit();
}