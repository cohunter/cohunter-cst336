<?php
session_start();

function require_login() {
    if ( !isset($_SESSION['username']) ) {
        header("Location: login.php");
        exit();
    }
}

$loggedIn = false;

if ( isset($_SESSION['user_id']) ) {
    $loggedIn = true;
}