<?php

    class Users
    {

        /**
         * User registration function, when is runned it will register the user into the database
         *
         * @param $username
         * @param $password
         * @param $passrep
         * @param $email
         * @param $name
         * @param $lastname
         *
         * @return redict
         */
        public function userRegister($username, $password, $passrep, $email, $name, $lastname)
        {
            $username = $this->dataEscape($username);
            $password = md5($this->dataEscape($password));
            $passrep = md5($this->dataEscape($passrep));
            $email = $this->dataEscape($email);
            $name = $this->dataEscape($name);
            $lastname = $this->dataEscape($lastname);


            if (!$this->checkUsername($username)) {
                if (!$this->checkPassRepetition($password, $passrep)) {
                    if (!$this->checkEmail($email)) {
                        $string = 'INSERT INTO users (isadmin,username,password,email,name,lastname)';
                        $string .= 'VALUES(0,"' . $username . '","' . $password . '","' . $email . '","' . $name . '","' . $lastname . '")';

                        if (mysql_query($string)) {
                            Main::setMessage("register.php", "You have successfully registered", "alert-success");
                        } else {
                            Main::setMessage("register.php", "The values can not be inserted", "alert-error");
                        }

                    } else {
                        return Main::setMessage("register.php", "Please input a correct Email Address", "alert-error");
                    }
                } else {
                    return Main::setMessage("register.php", "Please place the correct password in both fields", "alert-error");
                }
            } else {
                return Main::setMessage("register.php", "The username you added is already in the database", "alert-error");
            }

        }

        /**
         * It will check if a X username exists in the database
         *
         * @param $user
         *
         * @return bool
         */
        private function checkUsername($user)
        {
            $string = "SELECT * FROM users WHERE username='" . $user . "' ";
            $result = mysql_query($string);
            $check = mysql_num_rows($result);
            if ($check > 0) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * It will check if the first password is equal to the second pass
         *
         * @param $pass1
         * @param $pass2
         *
         * @return bool
         */
        private function checkPassRepetition($pass1, $pass2)
        {
            if ($pass1 != $pass2) {
                return true;
            } else {
                return false;
            }

        }

        /**
         * It will check if the email is a valid email
         *
         * @param $email
         *
         * @return bool
         */
        private function checkEmail($email)
        {
            if (!preg_match("/[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email)) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * It will escape bad datas for mysql
         *
         * @param $data
         *
         * @return string
         */
        public function dataEscape($data)
        {
            return mysql_real_escape_string($data);
        }

        /**
         * It will login the user and created a session variable with value true
         *
         * @param $username
         * @param $password
         *
         * @return bool
         */
        public function userLogin($username, $password)
        {
            $username = $this->dataEscape($username);
            $password = $this->dataEscape($password);

            $hashpass = md5($password);
            $string = "SELECT * FROM users WHERE (username = '" . $username . "') and (password ='" . $hashpass . "')";
            $userid = "SELECT id FROM users WHERE username='" . $username . "'";
            $login = mysql_query($string);
            $result = mysql_query($userid);

            while ($row = mysql_fetch_row($result)) {
                $_SESSION['userid'] = $row['0'];
            }

            if (mysql_num_rows($login) == 1) {
                $_SESSION[logedin] = true;
                return true;
            } else {
                return false;
            }

        }

        /**
         * It will check if an user is logged and redict to Index if its true
         */
        public function isLogedin()
        {
            if (isset($_SESSION['logedin']) && $_SESSION == true) {
                Main::setMessage("index.php", "You are logedin and so you can not view this page!", "alert-error");
            }
        }

        /**
         * It will check if a user is not logged in and it will redict to index if its true
         */
        public function notLogedin()
        {
            if (!(isset($_SESSION['logedin']) && $_SESSION == true)) {
                Main::setMessage("index.php", "You are not Logedin to view this page!", "alert-error");
            }
        }

        /**
         * It will check whether the user is logged in or not and a boolean value will be returned
         *
         * @return bool
         */
        public function LogedinBool()
        {
            if (isset($_SESSION['logedin']) && $_SESSION == true) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * It will update the password of the user
         *
         * @param $userid
         * @param $oldPassword
         * @param $newPassword
         * @param $passRep
         */
        public function passUpdate($userid, $oldPassword, $newPassword, $passRep)
        {
            $oldPassword = md5($this->dataEscape($oldPassword));
            $newPassword = md5($this->dataEscape($newPassword));
            $passRep = md5($this->dataEscape($passRep));
            $string = "SELECT password FROM users WHERE id='" . $userid . "'";
            $result = mysql_query($string);
            $check = mysql_fetch_row($result);

            if ($check[0] == $oldPassword) {
                if ($newPassword == $passRep) {
                    $string = "UPDATE users SET password='" . $newPassword . "' WHERE id='" . $userid . "'";
                    if (mysql_query($string)) {
                        Main::setMessage("settings.php", "Password Updated Successfully!", "alert-success");
                    } else {
                        Main::setMessage("settings.php", "Password could not be updated!", "alert-error");
                    }
                } else {
                    Main::setMessage("settings.php", "Please check if the repeated password correspond", "alert-error");
                }
            } else {
                Main::setMessage("settings.php", "Please input your old password correctly!", "alert-error");
            }


        }

        /**
         * It will update the email of the user
         *
         * @param $userid
         * @param $oldEmail
         * @param $newEmail
         * @param $password
         */
        public function emailUpdate($userid, $oldEmail, $newEmail, $password)
        {
            $oldEmail = $this->dataEscape($oldEmail);
            $newEmail = $this->dataEscape($newEmail);
            $password = md5($this->dataEscape($password));

            $string = "SELECT email,password FROM users WHERE id='" . $userid . "'";
            $result = mysql_query($string);
            $checke = mysql_fetch_row($result);

            if (($checke[0] == $oldEmail) && ($checke[1] == $password)) {
                $string = "UPDATE users SET email='" . $newEmail . "' WHERE id='" . $userid . "'";
                if (mysql_query($string)) {
                    Main::setMessage("settings.php", "Email Updated Successfully!", "alert-success");
                } else {
                    Main::setMessage("settings.php", "Password could not be Updated Successfully!", "alert-error");
                }
            } else {
                Main::setMessage("settings.php", "Please check if the old email and password are ok!", "alert-error");
            }

        }

        /**
         * If will add a host to the database
         *
         * @param $userid
         * @param $hostname
         * @param $host
         * @param $port
         * @param $ispublic
         */
        public function addHost($userid, $hostname, $host, $port, $ispublic)
        {
            $hostname = $this->dataEscape($hostname);
            $host = $this->dataEscape($host);
            $port = $this->dataEscape($port);

            if (!empty($hostname)) {
                if (!empty($host) && preg_match("/(?:[A-Za-z0-9-]+.?)+/", $host)) {
                    if (!empty($port)) {
                        $string = "INSERT INTO hosts (user_id, hostname, host, port, ispublic)";
                        $string .= "VALUES(" . $userid . ", '" . $hostname . "','" . $host . "'," . $port . ", " . $ispublic . ")";
                        if (mysql_query($string)) {
                            Main::setMessage("host.php", "The host was added successfully!", "alert-success");
                        } else {
                            Main::setMessage("host.php", mysql_error(), "alert-error");
                        }

                    } else {
                        Main::setMessage("host.php", "Please check the value of the port field!", "alert-error");
                    }
                } else {
                    Main::setMessage("host.php", "Please input correctly the domain or the IP of the Host!", "alert-error");
                }
            } else {
                Main::setMessage("host.php", "Please input the hostname correctly!", "alert-error");
            }

        }

        /**
         * It will select all public hosts
         */
        public function selectPublicHost()
        {
            $string = "SELECT * FROM hosts WHERE ispublic=1";

            if ($result = mysql_query($string)) {
                echo "<table class=\"table table-bordered table-hover\">
                        <thead>
                        <tr>
                            <th>Host Name</th>
                            <th>Domain or IP</th>
                            <th>Port</th>
                            <th>Status</th>
                        </tr>
                        </thead>";
                while ($row = mysql_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['hostname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['host']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['port']) . "</td>";
                    echo Check::checkServer($row['host'], $row['port']) ? "<td style=\"text-align: center;\"><i class=\"icon-ok\"></i></td>" : "<td style=\"text-align: center;\"><i class=\"icon-remove\"></i></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                Main::setMessage("index.php", mysql_error(), "alert-error");
            }

        }

        /**
         * It will select all private hosts
         *
         * @param $userid
         */
        public function selectPrivateHost($userid)
        {
            $string = "SELECT * FROM hosts WHERE user_id='" . $userid . "'";

            if ($result = mysql_query($string)) {
                echo "<table class=\"table table-bordered table-hover\">
                        <thead>
                        <tr>
                            <th>Host Name</th>
                            <th>Domain or IP</th>
                            <th>Port</th>
                            <th>Status</th>
                            <th>Ping</th>
                            <th>Delete</th>
                        </tr>
                        </thead>";
                while ($row = mysql_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['hostname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['host']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['port']) . "</td>";
                    echo Check::checkServer($row['host'], $row['port']) ? "<td style=\"text-align: center;\"><i class=\"icon-ok\"></i></td>" : "<td style=\"text-align: center;\"><i class=\"icon-remove\"></i></td>";
                    echo "<td style=\"text-align:center;\"><a class=\"btn btn-mini btn-info \" href=\"ping.php?host=" . $row['host'] . "&port=" . $row['port'] . "&count=4\"><i class=\"icon-signal\"></i> Ping</a></td>";
                    echo "<td style=\"text-align:center;\"><a class=\"btn btn-mini \" onclick=\"deleteFunction(" . $row['id'] . ")\"><i style=\"margin-top: 1px;\" class=\"icon-remove-circle\"></i></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                Main::setMessage("index.php", mysql_error(), "alert-error");
            }

        }

        /**
         * It will delete a specific host
         *
         * @param $userid
         * @param $hostid
         */
        public function hostDelete($userid, $hostid)
        {
            $string = "DELETE FROM hosts WHERE id=" . $hostid . " AND user_id=" . $userid . "";
            $validation = "SELECT user_id FROM hosts WHERE id=" . $hostid . "";
            $result = mysql_query($validation);
            $row = mysql_fetch_row($result);

            if ($row[0] == $userid) {
                if (mysql_query($string)) {
                    Main::setMessage("index.php", "The host was successfully deleted from the database!", "alert-success");
                } else {
                    Main::setMessage("index.php", mysql_error(), "alert-error");
                }
            } else {
                Main::setMessage("index.php", "There was an error, please retry again!", "alert-error");
            }

        }

    }
