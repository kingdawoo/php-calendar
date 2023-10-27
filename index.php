<?php
session_start();
include 'namnsdag.php';
if (!isset($_SESSION["getMonth"])) {
    $_SESSION["getMonth"] = date('n');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- ACTION ATTR phpself gör att den redirects till sin egna sida efter click (syfte: undvika echo extra tabell)-->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="previous" id="previous" value="Previous">
        <input type="submit" name="next" id="next" value="Next">
    </form>
    <?php
    if (isset($_POST['next'])) {
        $_SESSION["getMonth"]++;
        if ($_SESSION["getMonth"] > 12) {
            $_SESSION["getMonth"] = 1;
        }
        $dayAmount = cal_days_in_month(CAL_GREGORIAN, $_SESSION["getMonth"], 2023);
        $table = '<table><tr><th>'.date("F", mktime(0, 0, 0, $_SESSION["getMonth"], 1)).' '.'2023'.'</th><th>Day</th><th>Week</th><th>Name</th></tr>';
            for ($i=1;$i<=$dayAmount;$i++) {
                // str_pad lägger bara till 0 på ena digit för att passa formatet
                $date = '2023-' . str_pad($_SESSION["getMonth"], 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $dayName = date('l', strtotime($date));
                $dayNum = date("z", strtotime($date)) + 1;
                $dayColor = $dayName == "Sunday" ? 'red;' : 'black;';
                $weekNum = $dayName == "Monday" ? 'W.'.date("W", strtotime('2023-'.$_SESSION["getMonth"].'-'.$i)) : null;
                $name = isset($namnsdag[$dayNum][0]) ? $namnsdag[$dayNum][0] : null;
                $table .= '<tr><td style="color: '.$dayColor.'">'.$i.' '.$dayName.'</td><td>'.$dayNum.'</td><td>'.$weekNum.'</td><td>'.$name.'</td></tr>';
            }
        $table .= '</table>';
        echo $table; 
        echo '<img src="./img/'.date("F", mktime(0, 0, 0, $_SESSION["getMonth"], 1)).'.jpg" alt="Month Visual Representation">';
    }

    if (isset($_POST['previous'])) {
        $_SESSION["getMonth"]--;
        if ($_SESSION["getMonth"] < 1) {
            $_SESSION["getMonth"] = 12;
        }
        $dayAmount = cal_days_in_month(CAL_GREGORIAN, $_SESSION["getMonth"], 2023);
        $table = '<table><tr><th>'.date("F", mktime(0, 0, 0, $_SESSION["getMonth"], 1)).' '.'2023'.'</th><th>Day</th><th>Week</th><th>Name</th></tr>';
        for ($i=1;$i<=$dayAmount;$i++) {
                // str_pad lägger bara till 0 på ena digit för att passa formatet
                $date = '2023-' . str_pad($_SESSION["getMonth"], 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $dayName = date('l', strtotime($date));
                $dayNum = date("z", strtotime($date)) + 1;
                $dayColor = $dayName == "Sunday" ? 'red;' : 'black;';
                $weekNum = $dayName == "Monday" ? 'W.'.date("W", strtotime('2023-'.$_SESSION["getMonth"].'-'.$i)) : null;
                $name = isset($namnsdag[$dayNum][0]) ? $namnsdag[$dayNum][0] : null;
                $table .= '<tr><td style="color: '.$dayColor.'">'.$i.' '.$dayName.'</td><td>'.$dayNum.'</td><td>'.$weekNum.'</td><td>'.$name.'</td></tr>';
            }
        $table .= '</table>';
        echo $table; 
        echo '<img src="./img/'.date("F", mktime(0, 0, 0, $_SESSION["getMonth"], 1)).'.jpg" alt="Month Visual Representation">';
    }

    if(isset($_GET["date"])) {
        $userInput = htmlspecialchars($_GET["date"]);
        $monthNum = substr($userInput, -5, 2);
        $_SESSION["getMonth"] = $monthNum;
        $dayAmount = cal_days_in_month(CAL_GREGORIAN, $monthNum, 2023);
        $table = '<table><tr><th>'.date("F", mktime(0, 0, 0, $monthNum, 1)).' '.'2023'.'</th><th>Day</th><th>Week</th><th>Name</th></tr>';
            for ($i=1;$i<=$dayAmount;$i++) {
                // str_pad lägger bara till 0 på ena digit för att passa formatet
                $date = '2023-' . str_pad($monthNum, 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $dayName = date('l', strtotime($date));
                $dayNum = date("z", strtotime($date)) + 1;
                $dayColor = $dayName == "Sunday" ? 'red;' : 'black;';
                $weekNum = $dayName == "Monday" ? 'W.'.date("W", strtotime('2023-'.$monthNum.'-'.$i)) : null;
                $name = isset($namnsdag[$dayNum][0]) ? $namnsdag[$dayNum][0] : null;
                $table .= '<tr><td style="color: '.$dayColor.'">'.$i.' '.$dayName.'</td><td>'.$dayNum.'</td><td>'.$weekNum.'</td><td>'.$name.'</td></tr>';                
            }
        $table .= '</table>';
        echo $table; 
        echo '<img src="./img/'.date("F", mktime(0, 0, 0, $_SESSION["getMonth"], 1)).'.jpg" alt="Month Visual Representation">';
    }
    ?>
    <a href="friday.php" style="text-decoration: none;">Friday</a>
</body>
</html>
