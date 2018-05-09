<?php
session_start();

function require_login() {
    if ( !isset($_SESSION['username']) ) {
        header("Location: login.php");
        exit();
    }
}

function require_admin() {
    if ( !$_SESSION['is_admin'] ) {
        echo '<h1>Invalid access.</h1>';
        exit();
    }
}

$loggedIn = false;

if ( isset($_SESSION['user_id']) ) {
    $loggedIn = true;
}