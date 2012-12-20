<?php

    require_once 'header.php';
    $myPing = new Check();

    echo "<form action=\"ping.php\" method=\"get\" style=\"text-align: center;\">";
    echo "<input type=\"text\" class=\"input-xxlarge\" name=\"host\" placeholder=\"Type the Domain or IP and press Enter\" />";
    echo "<input type=\"hidden\" name=\"port\" value=\"80\" />";
    echo "<input type=\"hidden\" name=\"count\" value=\"4\" />";
    echo "</form>";

    if (isset($_GET['host']))
    {
        $host = $_GET['host'];
        $port = $_GET['port'];
        $count = $_GET['count'];

        echo "<h2> Pinging: ".$host."</h2>";

        if (!($count > 12))
        {
            $result = $myPing->ping($host,$port,$count);

            echo "<div class=\"well\">";
            foreach ($result as $value)
            {
                echo $value . "<br />";
            }
            echo "</div>";
        }
    }


    require_once 'footer.php';

