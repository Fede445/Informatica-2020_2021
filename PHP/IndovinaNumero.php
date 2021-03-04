<?php

session_start();
if ((!isset($_SESSION["reset"])) || $_SESSION["reset"] === true) {
    $_SESSION["attempts"] = 3;
    $_SESSION["n"] = rand(1, 10);
    $_SESSION["reset"] = false;
}

echo "Indovina il numero. Hai ". $_SESSION["attempts"] ." tentativi su 3. <br />";

if (isset($_POST["submit"])) {
    $number = $_POST["number"];
    if (!is_numeric($number)) {
        echo "Non hai inserito nessun numero! <br />";
    } else {
        if ($_SESSION["attempts"] == 0) {
            echo "Hai finito i tentativi. Ritenta la prossima volta. <br />";
            $_SESSION["reset"] = true;
        } else {
            switch ($number) {
        case ($number < $_SESSION["n"]):
        echo " Il numero da indovinare è maggiore di ". $number .". <br />";
        $_SESSION["attempts"]--;
        break;
        case ($number > $_SESSION["n"]):
        echo " Il numero da indovinare è minore di ". $number .". <br />";
        $_SESSION["attempts"]--;
        break;
        case ($number == $_SESSION["n"]):
        echo " Congratulazioni! Hai indovinato il numero. <br />";
        $_SESSION["reset"] = true;
        break;
        case "":
        echo " Non hai inserito un numero! <br />";
        break;
        }
        }
    }
} elseif (isset($_POST["reset"])) {
    $_SESSION["reset"] = true;
}
?>
<p>
<form method="post">
<input type="text" name="number">
<input type="submit" value="Indovina" name="submit"></input>
<input type="submit" value="Resetta" name="reset"></input>
</form>
</p>