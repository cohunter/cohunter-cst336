<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$host = "localhost";
$user = "cohunter";
$password = "";
$database = "finalproject";

$env = getenv("CLEARDB_DATABASE_URL");
if ( !empty($env) ) {
    $url = parse_url(base64_decode("bXlzcWw6Ly9iYWRmOGIyOWYxMTY1Mjo2YWZlYzJmM0B1cy1jZGJyLWlyb24tZWFzdC0wNC5jbGVhcmRiLm5ldC9oZXJva3VfNzZjNjU4OTQyNzA5Y2FlP3JlY29ubmVjdD10cnVl"));
    
    $host = $url["host"];
    $user = $url["user"];
    $password = $url["pass"];
    $database = substr($url["path"], 1);
}

$db = new mysqli($host, $user, $password, $database);

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    exit();
}