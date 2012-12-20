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

        /**
         * @param $host
         * @param $port
         * @param int $count
         * @return array
         */
        public static function ping($host, $port, $count = 4)
        {
            $ping_exec_result = self::ping_exec($host, $count);

            if (!empty($ping_exec_result))
            {
                return $ping_exec_result;
            }
            else
            {
                $array_result = array();
                for ($i = 0; $i < $count; $i++)
                {
                    $array_result[] = self::ping_socket($host,$port,$count);
                }
                return $array_result;
            }

        }

        /**
         * @param $host
         * @param $count
         * @return mixed
         */
        private function ping_exec($host, $count)
        {
             $host = preg_replace("/[^A-Za-z0-9.-]/","",$host);
             $host = escapeshellarg($host);
             $count= preg_replace ("/[^0-9]/","",$count);

             exec("ping -c $count $host",$return_array);
             return $return_array;
        }

        /**
         * @param $host
         * @param int $port
         * @param $count
         * @return bool|float
         */
        private function ping_socket($host, $port = 80, $count)
        {
            $timeA = microtime(true);
            $con = @fsockopen($host, $port, $errno, $errstr);
            $timeB = microtime(true);

            if ($con)
            {
                return "Reply from $host: bytes=32 time=".round((($timeB - $timeA) * 1000), 0)."ms TTL=NULL";
            }
            else
            {
                return false;
            }
        }


    }
