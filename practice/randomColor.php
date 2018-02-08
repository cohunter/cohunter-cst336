<?php
function randomRGBAOutput(){
    return rand(0,255) . ', ' . rand(0,255) . ', ' . rand(0,255) . ', ' . rand(0,100)/100;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Random Color </title>
        <meta http-equiv="refresh" content="1">
        <style>
        body {
            background-color: rgba(<?=randomRGBAOutput()?>);
        }
        h1 {
            background-color: rgba(<?=randomRGBAOutput()?>);
        }
        h2 {
            color: rgba(<?=randomRGBAOutput()?>);
        }
        </style>
    </head>
    <body>
        <h1> Welcome! </h1>
        <h2> Random Background Color </h2>
    </body>
</html>