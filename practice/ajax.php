<?php
if ( isset($_GET['username']) ) {
    try {
        $dbl = new PDO('mysql:host=127.0.0.1;dbname=project1;charset=latin1', 'cohunter', '',
                array(
                      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                      PDO::ATTR_PERSISTENT => false)
                );
        
        $query = $dbl->prepare("SELECT `lastLogin`, `lastLoginStatus` FROM `fp_login` WHERE `username` = ?");
        $query->execute([$_GET['username']]);
        
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode($row);
    }
    catch ( PDOException $e ) {
        $exceptionMessage = $e->getMessage();
        echo json_encode(
            array(
                'error' => $exceptionMessage
                ));
    }
}