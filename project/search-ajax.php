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

$query = "SELECT image_id, user_id, url FROM images JOIN users ON users.id = images.user_id WHERE username LIKE ? ORDER BY $sort";
$tag = false;

if ( isset($_GET['tag']) && !empty($_GET['tag']) ) {
    $tag = true;
    $query = "SELECT images.image_id, user_id, url FROM images JOIN users ON users.id = images.user_id JOIN images_tags ON images.image_id = images_tags.image_id WHERE username LIKE ? AND tag = ? ORDER BY $sort";
}

$query = $db->prepare($query);

if ( $tag ) {
    $query->bind_param('ss', $username, $_GET['tag']);
} else {
    $query->bind_param('s', $username);
}

$query->execute();
$res = $query->get_result();

$rows = [];

while ( $row = $res->fetch_assoc() ) {
    $rows[] = $row;
}

echo json_encode($rows);