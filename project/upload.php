<?php
require_once('session.php');
require_once('database.php');
require_login();

$message = "";
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    // Process upload...
    
    if ( isset($_POST['url']) && !empty($_POST['url']) ) {
        
        $query = $db->prepare("INSERT INTO images (user_id, url) VALUES (?, ?)");
        $query->bind_param("is", $_SESSION['user_id'], $_POST['url']);
        $res = $query->execute();
        
        $imageId = $db->insert_id;
        
        if ( isset($_POST['tags']) && !empty($_POST['tags']) ) {
            $tags = explode(',', $_POST['tags']);
            
            foreach ( $tags as $tag ) {
                $query = $db->prepare("INSERT INTO images_tags (image_id, tag) VALUES (?, ?)");
                $query->bind_param("is", $imageId, trim($tag));
                $res = $query->execute();
            }
        }
    }
    
    $message = "Uploaded successfully.";
}

?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Add Image</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top: 20px;">
            <div class="col-sm-auto">
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
            <div class="col-sm-auto">
                <a class="btn btn-primary" href="search.php">View Images</a>
            </div>
        </div>
        
        <div style="text-align: center;">
            <h2>
                <?=$message?>
            </h2>
        </div>
        <form name="uploadForm" action="" method="POST">
        <div class="form-group">
            <label for="url">URL</label>
            <input name="url" type="text" class="form-control" placeholder="https://www.example.com/image.jpg">
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input name="tags" type="text" class="form-control" placeholder="tag1, tag2, tag3">
        </div>
        <button id="submitBtn" type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>
</html>