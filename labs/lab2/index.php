<!DOCTYPE html>
<html>
    <head>
        <title>Lab 2: 777 Slot Machine</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        $fruits = array('seven', 'grapes', 'cherry', 'orange', 'lemon');
        
        for ( $i = 0; $i < 3; $i++ ) {
            $values[] = array_rand($fruits);
        }
        foreach ( $values as $value ) {
            $symbol = $fruits[$value];
            echo "<img src='img/${symbol}.png' alt='${symbol}'>";
        }
        
        $points = 0;
        
        if ( array_sum($values) === 0 ) {
            $points = 1000;
        } else if ( $values[0] === 2 && $values[1] === 2 && $values[2] === 2 ) {
            $points = 500;
        } else if ( $values[0] === 4 && $values[1] === 4 && $values[2] === 4 ) {
            $points = 250;
        }
        
        echo "<hr><h3>Points: ${points}</h3>";
        ?>
    </body>
</html>