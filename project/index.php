<?php
require_once('session.php');
require_once('database.php');

$res = $db->query("select username, image_id, user_id, added, url FROM images JOIN users ON users.id = images.user_id ORDER BY RAND() LIMIT 6");

$imageOutput = "";

while ( $row = $res->fetch_assoc() ) {
    $imageOutput = $imageOutput . "<img class='ref' src='{$row['url']}'>";
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Final Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        img.ref {
            max-width: 300px;
            max-height: 400px;
            border-radius: 15px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <a class="btn btn-primary" href="login.php">Login</a>
    <a class="btn btn-primary" href="search.php">See more pictures</a>
    <?=$imageOutput?>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>