<?php
    require_once 'config.php';

    $query = "SELECT * FROM hosts";
    $result = mysql_query($query);

    while ($row = mysql_fetch_assoc($result)) {
        if (!Check::checkServer($row['host'], $row['port'])) {
            sendEmail($row['user_id'], $row['hostname']);
        }
    }

    /**
     * Function for sending emails to the users whos host is down!
     *
     * @param $userid
     * @param $hostname
     */
    function sendEmail($userid, $hostname)
    {
        $string = "SELECT * FROM users WHERE id='" . $userid . "'";
        $query = mysql_query($string);
        $result = mysql_fetch_row($query);

        $email = $result['4'];
        $name = $result['5'];
        $lastname = $result['6'];

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $emailsubject = $hostname . " is Down!";
        $emailcontent = <<<EOF
<html>
  <body>
    Hello $name $lastname, <br /><br />

    The Host name <b>$hostname</b> is DOWN! <br /><br />

    Thank you, and have a good day <br />
  </body>
</html>
EOF;
        if (mail($email, $emailsubject, $emailcontent, $headers)) {
            echo "Email Sent Successfully <br />";
        } else {
            echo "There was an error sending the email <br />";
        }
    }