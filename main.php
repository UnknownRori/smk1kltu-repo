<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content="ArchaentNakasaki">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php

    echo "<p>Halo Dunia!</p>";
    $name = "PHP on XAMPP";
    $adminname = "Archaent";
    $webport = 80;

    echo "<p>$adminname: $name</p>";
    echo "<p>Listen on Port: $webport</p>";

    if ($webport <= 1024) {
        echo "<p style='color:red'>Listening on privileged port</p>";
    }

    $fns = function ($arg0, $arg1) {
        echo "<p>$arg0 and $arg1</p>";
        return $arg0 + $arg1;
    };
    $cnst = [];
    $cnst["Python"] = "60%";
    $cnst["CLang"] = "25%";
    $cnst["Java"] = "1%";
    $cnst["C++"] = "1.52%";
    $cnst["PHP"] = "1.12%";
    $cnst["public class Main {<br>&nbsp;&nbsp;&nbsp;&nbsp;public static void main(String args[])<br>}"] = "NOOOO";
    echo "<ul>";
    foreach ($cnst as $key => $value) {
        echo "  <li>$key -> $value</li>";
    }

    echo "</ul><br>";

    echo "<span>";
    for ($i = 0; $i <= 10; $i++) {
        echo "$i";
        if ($i != 10) {
            echo ", ";
        }
    }
    echo "</span>";

    // Uncomment to make a chaos.
    //while (true){
    //  echo "<span style='display:none'>None</span>"
    //}

    if ($php_errormsg != "") {
        echo "<p>$php_errormsg</p>";
    }
    ?>
</body>

</html>