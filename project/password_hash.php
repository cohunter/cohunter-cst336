<?php
if ( !isset($argv[1]) ) {
    exit();
}

echo password_hash($argv[1], PASSWORD_BCRYPT), "\n";