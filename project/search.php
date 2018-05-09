<?php
require_once('session.php');
require_once('database.php');

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Final Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .image-container {
            text-align: center;
        }
        img.ref {
            max-width: 100%;
            max-height: 400px;
            border-radius: 15px;
            margin: 20px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        var is_admin = <?php if ( $_SESSION['is_admin'] ) { echo "true"; } else { echo "false"; } ?>
        /* global $ */
        $(document).ready(function() {
            $('#submitBtn').on('click', function(e) {
                e.preventDefault();
                
                var username    = $('input[name=username]').val();
                var tag         = $('input[name=tag]').val();
                var filterDate  = $('input[name=filterDate]').val();
                var sort        = $('select[name=sort]').val();

                $.getJSON('search-ajax.php', {
                    username:   username,
                    tag:        tag,
                    filterDate: filterDate,
                    sort:       sort
                }).done(function(data) {
                    // alert(2);
                    
                    var imageContainer = $('.image-container');

                    if ( data.length == 0 ) {
                        imageContainer.html("<h1>No results, please try a different search.");
                        return;
                    }
                    
                    var toAppend = '<div class="row">'
                    $.each(data, function(i, image) {
                        console.log(image);
                        
                        toAppend += '<div class="col-md-5"><img data-i=' + i + ' class="ref" src="' + image['url'] + '">';
                        if ( is_admin ) {
                            toAppend += '<a class="btn btn-primary" href="delete.php?id=' + image['image_id'] + '">Delete this record</a>';
                        }
                        toAppend += '</div>';
                        if ( i % 2 == 1 ) {
                            toAppend += '</div><div class="row">';
                        }
                    });
                    
                    imageContainer.html(toAppend);
                });
            });
            
            $('#submitBtn').click();
        });
    </script>
</head>
<body>
    <div class="container">
    <div class="row justify-content-md-center" style="margin-top: 20px;">
    <div class="col-sm-auto">
    <?php
    if ( $loggedIn ) {
        ?><a class="btn btn-primary" href="logout.php">Logout</a><?php
    } else {
        ?><a class="btn btn-primary" href="login.php">Login</a><?php
    }
    ?>
    </div>
    <div class="col-sm-auto">
        <a class="btn btn-primary" href="upload.php">Add Image</a>
    </div>
    </div>
    <div class="row">
    <div class="col-md-2">
    <h3>Filter By</h3>
    <form name="searchForm" action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" type="text" class="form-control" placeholder="Enter a username to view...">
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <input name="tag" type="text" class="form-control" placeholder="Enter a single tag to view...">
        </div>
        <div class="form-group">
            <label for="filterDate">Added After</label>
            <input name="filterDate" class="form-control" type="datetime-local" value="2018-05-08T14:45:00">
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <select name="sort" class="form-control">
                <option value="date">Date</option>
                <option value="random">Random</option>
            </select>
        </div>
        <button id="submitBtn" type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <div class="col-md-10 image-container"></div>
    </div>
    </div>
</body>
</html>