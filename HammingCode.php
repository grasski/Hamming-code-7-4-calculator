<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css.css">
</head>
<body>
</body>
</html>

<?php

class HammingCode
{
    /**
     * Function used to build matrix from multidimensional array.
     *
     * @param $matrix
     */
    public function showMatrix($matrix){
        echo "<table>";
        foreach ($matrix as $key => $value){
            echo "<tr>";
            foreach ($value as $item){
                echo "<td>". $item."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    /**
     * Function that make Hamming code (7,4) from 4 bits.
     * Makes 3 check bits which are inserted to the code at first, second and fourth index.
     *
     * @param $message
     * @return string
     */
    public function getCode($message) : string{
        $mess = str_split($message);
        $p1 = ($mess[0] + $mess[1] + $mess[3]) % 2;
        $p2 = ($mess[0] + $mess[2] + $mess[3]) % 2;
        $p3 = ($mess[1] + $mess[2] + $mess[3]) % 2;

        return ($p1 . $p2 . $mess[0] . $p3 . $mess[1] . $mess[2] . $mess[3]);
    }

    /**
     * Function made to convert code back to value that was sent to work with.
     *
     * @param $code
     * @return string
     */
    public function getValueFromCode($code) : string{
        $bits = $code[2]. $code[4] . $code[5] . $code[6];

        $char = array_search($bits, binaries());
        return ("$bits ($char)");
    }

    public function generatorMatrix() : array{
        $G = [[1, 1, 1, 0, 0, 0, 0],[1, 0, 0, 1, 1, 0, 0],[0, 1, 0, 1, 0, 1, 0], [1, 1, 0, 1, 0, 0, 1]];
        return $G;
    }
    public function chechMatrix() : array{
//        $H = [[1,0,0], [0,1,0], [1,1,0], [0,0,1], [1,0,1], [0,1,1], [1,1,1]];
        $H = [[0,0,1], [0,1,0], [0,1,1], [1,0,0], [1,0,1], [1,1,0], [1,1,1]];
        return $H;
    }

    /**
     * Makes syndrome of code.
     *
     * @param $code
     * @return string
     */
    public function syndrome($code) : string{
        $codes = str_split($code);
        $s = "";

        $H = $this->chechMatrix();
        $Ht = [];
        $t = 0;
        foreach ($H as $key => $item){
            $Ht[0][$t] = $item[0];
            $Ht[1][$t] = $item[1];
            $Ht[2][$t] = $item[2];

            $t++;
        }

        foreach ($Ht as $value){
            $xor = 0;
            $c = 0;
            foreach ($value as $item){
                $xor += $item * $codes[$c];
                $c++;
            }

            $s .= $xor % 2;
        }

        return $s;
    }

    /**
     * Function that generate wrong code by changing value of one index.
     *
     * @param $code
     * @return array
     */
    public function generateMistake($code) : array{
        $index = rand(0,6);

        $code[$index] = $code[$index] == 0 ? 1 : 0;

        return [$code, $index+1];
    }

    /**
     * Function return repaired string of code.
     *
     * @param $code
     * @param $syndrome
     * @return string
     */
    public function repairWrongCode($code, $syndrome) : string{
        $s = strrev($syndrome);
        $s = str_split($s);

        $bit = 0;
        $rIndex = null;    // Index of code to repair
        foreach ($s as $item){
            if ($item == 1){
                $rIndex += pow(2, $bit);
            }
            $bit++;
        }
        if ($rIndex == null) return $code;

        $code[$rIndex-1] = $code[$rIndex-1] == 0 ? 1 : 0;
        return $code;
    }

    /**
     * Main function which gives data to user via HTML page.
     *
     * @param $message
     * @param $char
     */
    public function processInput($message, $char){
        $code = $this->getCode($message);
        $syndrome = $this->syndrome($code);

        $generate = $this->generateMistake($code);
        $wrongCode = $generate[0];
        $mistakeIndex = $generate[1];
        $wrongSyndrome = $this->syndrome($wrongCode);
        $repairedCode = $this->repairWrongCode($wrongCode, $wrongSyndrome);

        echo "<div class='column'>";

        echo "<h1>Selected value: $message ($char)</h1>";

        echo "<p>Input message: <B>" . $message . "</B><BR>";
        echo "Code message: <B>" . $code . "</B><BR>";
        echo "Syndrome: <B>" . $syndrome . "</B><BR><BR>";
        echo "Mistake generated at position: <B>" . $mistakeIndex . "</B><BR>";
        echo "Wrong code message: <B>" . $wrongCode . "</B><BR>";
        echo "Wrong syndrome: <B>" . $wrongSyndrome . "</B><BR>";
        echo "Repaired code: <B>" . $repairedCode . "</B></p><BR>";

        echo "<h1>Value of repaired code: " . $this->getValueFromCode($repairedCode) . "</h1>";

        echo "</div>";
    }
}
