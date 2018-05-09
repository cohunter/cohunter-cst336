<?php
require_once('session.php');
require_once('database.php');
require_login();
require_admin();

if ( isset($_GET['id']) && is_numeric($_GET['id']) ) {
    $query = $db->prepare("DELETE FROM images WHERE image_id = ?");
    $query->bind_param("i", $_GET['id']);
    $res = $query->execute();
}

header("Location: search.php");