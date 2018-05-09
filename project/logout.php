<?php
require_once('session.php');
require_once('database.php');

$_SESSION = array(); // Clear session data

/*
    Code via http://php.net/manual/en/function.session-destroy.php
    Used under CC-BY 3.0
*/
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

header('Location: index.php');