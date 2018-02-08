<?php
session_start();

if ( isset($_POST['logout']) ) {
    unset($_SESSION['username']);
}

if ( !isset($_SESSION['username']) ) {
    header("Location: " . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('welcome.php', 'program1.php', $_SERVER['REQUEST_URI']));
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome, <?=$_SESSION['username']?></title>
</head>
<body>
    <h1>Welcome, <?=$_SESSION['username']?></h1>
    <form action="" method="POST">
        <input type="hidden" name="logout" value="logout">
        <input type="submit" value="Logout">
    </form>
</body>
</html>