<?php
    require_once 'config.php';

    $query = "SELECT * FROM hosts";
    $result = mysql_query($query);

    while ($row = mysql_fetch_assoc($result)) {
        if (!Check::checkServer($row['host'], $row['port'])) {
            Main::sendEmail($row['user_id'], $row['hostname']);
        }
    }

