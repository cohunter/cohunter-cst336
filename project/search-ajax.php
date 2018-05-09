<?php
require_once('session.php');
require_once('database.php');

if ( isset($_GET['username']) && !empty($_GET['username']) ) {
    $username = $_GET['username'];
} else {
    $username = '%';
}

if ( isset($_GET['sort']) && $_GET['sort'] == 'random' ) {
    $sort = 'RAND()';
} else {
    $sort = 'added';
}

$query = $db->prepare("SELECT image_id, user_id, url FROM images JOIN users ON users.id = images.user_id WHERE username LIKE ? ORDER BY $sort");
//echo $db->get_warnings();
$query->bind_param('s', $username);
$query->execute();
$res = $query->get_result();

$rows = [];

while ( $row = $res->fetch_assoc() ) {
    $rows[] = $row;
}

echo json_encode($rows);