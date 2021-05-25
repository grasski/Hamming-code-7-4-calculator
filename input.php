<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="stylesheet" href="css.css">

</head>
<body>
<form action="main.php" METHOD="post">
    <label for="values" style="font-size: 20px">Choose binary number to encode:</label>
        <?php
        $bins = binaries();

        echo '<select name="values" id="binaries" onchange="this.form.submit()">';
        echo "<option>";

        foreach ($bins as $key => $item){
            echo "<option value=$item>$key: $item";
        }

        echo "</select>";
        ?>
    <BR><BR>
</form>
</body>
</html>

<?php

/**
 * Function that create associated array containing keys of alphabet char with value of binary numbers 0 - 15.
 *
 * @return array
 */
function binaries() : array{
    $chars = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P"];
    $bin = "";
    $array["A"] = "0000";
    for ($x = 1; $x != 16; $x++){
        $i = $x;
        while ($i > 0){
            $bin .= $i%2;
            $i = floor($i / 2);
        }
        while (strlen($bin) < 4){
            $bin .= "0";
        }
        $array[$chars[$x]] = strrev($bin);
        $bin = "";
    }
    return $array;
}
?>
