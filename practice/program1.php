<?php
session_start();

if (isset($_POST['username']) ) {
    try {
        $dbl = new PDO('mysql:host=127.0.0.1;dbname=project1;charset=latin1', 'cohunter', '',
                array(
                      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                      PDO::ATTR_PERSISTENT => false)
                );
        
        $query = $dbl->prepare("SELECT `username`, `password` FROM `fp_login` WHERE `username` = ?");
        $query->execute([$_POST['username']]);
        
        
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        $status = 'U';
        if ( sha1($_POST['password']) == $row['password'] ) {
            // Login successful.
            $status = 'S';
            $_SESSION['username'] = $row['username'];
        } else {
            $loginErrorMessage = 'Incorrect username or password.';
        }
        $query = $dbl->prepare("UPDATE `fp_login` SET `lastLogin` = NOW(), `lastLoginStatus` = ? WHERE `username` = ?");
        $query->execute([$status, $row['username']]);
        
        if ( $status === 'S' ) {
            header("Location: " . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('program1.php', 'welcome.php', $_SERVER['REQUEST_URI']));
            exit();
        }
    }
    catch ( PDOException $e ) {
        $exceptionMessage = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    /*global $*/
        $(document).ready(function(){
            $('#username').on("keyup change", function() {
                $.getJSON('ajax.php?username=' + $('#username').val(), function(data) {
                    if ( data['lastLogin'] ) {
                        if ( data['lastLoginStatus'] == 'S' ) {
                            data['lastLoginStatus'] = 'Successful';
                        } else {
                            data['lastLoginStatus'] = 'Unsuccessful';
                        }
                        
                        $('#lastLoginInfo').html(
                            '<span class="time">' + data['lastLogin'] + '</span>' +
                            '<span class="status">' + data['lastLoginStatus'] + '</span>');
                    } else {
                        $('#lastLoginInfo').html('');
                    }
                    console.log(data);
                });
                console.log($('#username').val());
            })
        });
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        table {
            margin: 10px auto;
        }
        .time {
            color: green;
        }
        .time:before {
            content: "Time: ";
        }
        .status {
            float: right;
            color: blue;
        }
        .status:before {
            content: "Status: ";
        }
        
        div:empty {
            display: none;
        }
        
        .container {
            margin-top: 25px;
        }
        
        .completed {
            background-color: #99E999;
        }
    </style>
</head>
<body>
    <div class="container">
    <table border="1" width="600">
    <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
    <tr class="completed">
      <td>1</td>
      <td>There is a Login form with all appropriate HTML elements</td>
      <td width="20" align="center">5</td>
    </tr>
    <tr class="completed">
      <td>2</td>
      <td>When changing the username, an AJAX call is executed, displaying the last date/time the user logged in and the last login status (Successful, Unsuccessful)</td>
      <td align="center">15</td>
    </tr>  
    <tr class="completed">
      <td>3</td>
      <td>When submitting the Login form, the last date/time is updated correctly </td>
      <td align="center">15</td>
    </tr>  
     <tr class="completed">
       <td>4</td>
       <td> When submitting the Login form, the Login Status is updated accordingly, whether it was Successulf (S) or Unsuccessful (U) </td>
       <td align="center">20</td>
     </tr> 
     <tr class="completed">
       <td>5</td>
       <td>When submitting the Login form, if the credentials are wrong, the user is taking back to the login screen. </td>
       <td align="center">5</td>
     </tr> 
      <tr class="completed">
       <td>6</td>
       <td>When submitting the Login form, if the credentials are correct, a "username" session variable is set and it is displayed in a new page called <strong>"welcome.php"</strong> </td>
       <td align="center">10</td>
     </tr> 
     <tr class="completed">
      <td>7</td>
      <td>This rubric is properly included AND UPDATED (BONUS)</td>
      <td width="20" align="center">2</td>
    </tr>     
     <tr>
      <td></td>
      <td>T O T A L </td>
      <td width="20" align="center"><b></b></td>
    </tr> 
  </tbody></table>
    <?php
    if ( isset($exceptionMessage) ) {
        echo '<div class="alert alert-danger" role="alert">', $exceptionMessage, '</div>';
    }
    if ( isset($loginErrorMessage) ) {
        echo '<div class="alert alert-danger" role="alert">', $loginErrorMessage, '</div>';
    }
    ?>
    <div class="alert alert-info" role="alert" id="lastLoginInfo"></div>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" id="username" class="form-control" type="text" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" class="form-control" type="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    </div>
</body>
</html>