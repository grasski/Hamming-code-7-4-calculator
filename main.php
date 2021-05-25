<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css.css">
</head>
<body>
</body>
</html>

<?php
echo "<h1>Hamming code (7,4) calculator</h1>";

require "input.php";
class main
{
    function getText(): string{
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            return $code = $_POST["values"];
        } else{
            echo "<BR>Zadejte text ve formuláři.";
            header("Location:input.php");
        }
    }
}
$main = new main();
$text = $main->getText();
if ($text != null){
    include "HammingCode.php";
    $hamming = new HammingCode();

    $char = array_search($text, binaries());

    echo "<div class='container'>";

    echo "<div>" . $hamming->processInput($text, $char) ."<h1>Generator matrix</h1>";
    echo "</div><div> " . $hamming->showMatrix($hamming->generatorMatrix()) . "<h1>Parity-check matrix</h1>";
    echo "</div>" . $hamming->showMatrix($hamming->chechMatrix());

    echo "</div>";
}
