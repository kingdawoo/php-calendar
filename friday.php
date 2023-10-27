<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Friday</title>
    <style>
        body {
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgb(244, 253, 255);
}
    </style>
</head>
<body>
    <form action="#" method="post">
        <input type="text" id="date" name="date" placeholder="yyyy-mm-dd">
        <input type="submit" id=submit-date name="submit-date" value="Search">
    </form>

    <?php
    if(isset($_POST['submit-date'])) {
        $date1 = $_POST["date"];
        $date2 = date('Y-m-d',strtotime("next Friday", strtotime($date1)));

        $date1 = strtotime($date1);
        $date2 = strtotime($date2);

        // beräkna skillnad mellan de två tidstämplen, floor() rundar ner till exakt antal dagar
        $diff = $date2 - $date1;
        $days = floor($diff / (60 * 60 * 24));
        if ($days == 7) {
            echo '<img src="./img/happy-friday-dance.gif" alt="Duck Dancing">';
        } else {
            echo '<br><p>'. $days . ' day(s) left til friday!</p>';
        }
    }
    ?>
        <br><a href="index.php" style="text-decoration: none;">Calendar</a>

</body>
</html>