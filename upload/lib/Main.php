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
                    return '<div class="alert ' . $_REQUEST['status'] . '">' . $_REQUEST['msg'] . '</div>';
                } else {
                    return '<div class="alert">' . $_REQUEST['msg'] . '</div>';
                }
            }
        }

    }
