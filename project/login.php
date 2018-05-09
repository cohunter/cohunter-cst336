<?php
require_once('session.php');
require_once('database.php');

if ( isset($_SESSION['user_id']) ) {
    header('Location: search.php');
} else if ( $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['username']) && !empty($_POST['password']) ) {
    $query = $db->prepare("SELECT id, username, password, is_admin FROM users WHERE username = ?");
    $query->bind_param("s", $_POST['username']);
    $query->execute();
    
    $res = $query->get_result();
    
    $data = $res->fetch_assoc();
    
    if ( $data == NULL ) {
        $errorMessage = "Username does not exist.";
    } else {
        
        // Verify the password using the BCRYPT algorithm.
        if ( !password_verify($_POST['password'], $data['password']) ) {
            $errorMessage = "Password not valid.";
        } else {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['is_admin'] = $data['is_admin'];
            
            header('Location: search.php');
            exit();
        }
    }
    
    // var_dump($res->fetch_assoc());
    // Do login
}
?><!doctype html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php
    if ( isset($errorMessage) ) {
        echo $errorMessage;
    }
    ?>
    <form action="" method="POST">
        <label for="username">Username: <input type="text" name="username" /></label>
        <label for="password">Password: <input type="password" name="password" /></label>
        <button type="submit">Login</button>
    </form>
</body>
</html>