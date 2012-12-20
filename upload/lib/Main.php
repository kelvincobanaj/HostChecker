<?php

    class Main
    {
        /**
         * The function will return the page title depends on the file name
         *
         * @return string
         */
        static public function pageTitle()
        {
            $page = $_SERVER['PHP_SELF'];
            $string = strrchr($page, '/');
            $length = strlen($string) - 1;
            @$page = substr($string, 1, $length);

            switch ($page) {
                case "index.php":
                    return "HostChecker - Homepage";
                    break;
                case "host.php":
                    return "HostChecker - Add Host";
                    break;
                case "settings.php":
                    return "HostChecker - Member Settings";
                    break;
                case "register.php":
                    return "HostChecker - Register";
                    break;
                case "login.php":
                    return "HostChecker - Login";
                    break;
            }
        }

        /**
         * Function send an error to handleMessages, depends on the configuration
         *
         * @param $page
         * @param $errString
         * @param $status
         * @return redict
         */
        static public function setMessage($page, $errString, $status = "")
        {
            return header('Location: ' . $page . '?msg=' . urlencode($errString) . '&status=' . urlencode($status));
        }

        /**
         * The function will handle the error sent by the setMessage
         *
         * @return string
         */
        static public function handleMessages()
        {
            if (isset($_REQUEST['msg'])) {
                if (!empty($_REQUEST['status'])) {
                    return '<div class="alert ' . htmlspecialchars($_REQUEST['status']) . '">' . $_REQUEST['msg'] . '</div>';
                } else {
                    return '<div class="alert">' . htmlspecialchars($_REQUEST['msg']) . '</div>';
                }
            }
        }

        /**
         * Function for sending emails to the users whos host is down!
         *
         * @param $userid
         * @param $hostname
         */
        static public function sendEmail($userid, $hostname)
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

    }
