<?php

    class Check
    {
        /**
         * This function will check if the server with a specific host is online or not
         *
         * @param $host the domain or ip of the server
         * @param int $port the port of the server, default 80
         * @return bool the return is a boolean
         */
        static public function checkServer($host, $port = 80)
        {
            $connection = @fsockopen($host, $port, $errno, $errstr, 1);

            if (!$connection) {
                return false;
            } else {
                return true;
            }

        }
    }
