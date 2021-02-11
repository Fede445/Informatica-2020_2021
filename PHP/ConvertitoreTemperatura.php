<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport">
    <title>Temp. converter</title>
</head>

<body>
    <?php
        //Fahrenheit to celsius
        function fahrenheit_to_celsius($temp)
        {
            $celsius=5/9*($temp-32);
            return $celsius ;
        }
        function celsius_to_fahrenheit($temp)
        {
            $fahrenheit=$temp*9/5+32;
            return $fahrenheit ;
        }
    ?>

    <form action="" method="post">
        <table>

            <tr>
                <td>
                    <select name="temp1">
                        <option value="fahrenheit">Fahrenheit</option>
                        <option value="celsius">Celsius</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="temp">
                </td>
            </tr>
            <tr>
                <td>
                    <select name="temp2">
                        <option value="fahrenheit">Fahrenheit</option>
                        <option value="celsius">Celsius</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="btn" value="Convert">
                </td>
            </tr>
            <tr>
                <td>

                    <?php
if (isset($_POST['btn'])) {
        $temp1=$_POST['temp1'];
        $temp2=$_POST['temp2'];
        $temp=$_POST['temp'];
    
        //Fahrenheit to celsius
        if ($temp1=='fahrenheit') {
            if ($temp2=='celsius') {
                $celsius=fahrenheit_to_celsius($temp);
                echo "$temp Fahrenheit = $celsius Celsius";
            } else {
                echo "$temp Fahrenheit";
            }
        }
        //Celsius to fahrenheit
        if ($temp1=='celsius') {
            if ($temp2=='fahrenheit') {
                $fahrenheit=celsius_to_fahrenheit($temp);
                echo "$temp Celsius  = $fahrenheit Fahrenheit";
            } else {
                echo "$temp Celsius";
            }
        }
    }

?>
                </td>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>