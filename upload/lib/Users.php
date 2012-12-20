<?php

    class Users
    {

        /**
         * This function is the registration function which allows the system to register its users online
         *
         * @param $username
         * @param $password
         * @param $passrep
         * @param $email
         * @param $name
         * @param $lastname
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
         * @param $user
         * @return bool
         */
        public function checkUsername($user)
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
         * @param $pass1
         * @param $pass2
         * @return bool
         */
        public function checkPassRepetition($pass1, $pass2)
        {
            if ($pass1 != $pass2) {
                return true;
            } else {
                return false;
            }

        }

        /**
         * @param $email
         * @return bool
         */
        public function checkEmail($email)
        {
            if (!preg_match("/[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email)) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * @param $data
         * @return string
         */
        public function dataEscape($data)
        {
            return mysql_real_escape_string($data);
        }

        /**
         * @param $username
         * @param $password
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
                $_SESSION[logedin] = false;
                return false;
            }

        }

        /**
         *
         */
        public function isLogedin()
        {
            if (isset($_SESSION['logedin']) && $_SESSION == true) {
                Main::setMessage("index.php", "You are logedin and so you can not view this page!", "alert-error");
            }
        }

        /**
         *
         */
        public function notLogedin()
        {
            if (!(isset($_SESSION['logedin']) && $_SESSION == true)) {
                Main::setMessage("index.php", "You are not Logedin to view this page!", "alert-error");
            }
        }

        /**
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
                    echo "<td>" . $row['hostname'] . "</td>";
                    echo "<td>" . $row['host'] . "</td>";
                    echo "<td>" . $row['port'] . "</td>";
                    echo Check::checkServer($row['host'], $row['port']) ? "<td style=\"text-align: center;\"><i class=\"icon-ok\"></i></td>" : "<td style=\"text-align: center;\"><i class=\"icon-remove\"></i></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                Main::setMessage("host.php", mysql_error(), "alert-error");
            }

        }

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
                            <th>Delete</th>
                        </tr>
                        </thead>";
                while ($row = mysql_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['hostname'] . "</td>";
                    echo "<td>" . $row['host'] . "</td>";
                    echo "<td>" . $row['port'] . "</td>";
                    echo Check::checkServer($row['host'], $row['port']) ? "<td style=\"text-align: center;\"><i class=\"icon-ok\"></i></td>" : "<td style=\"text-align: center;\"><i class=\"icon-remove\"></i></td>";
                    echo "<td style=\"text-align:center;\"><a class=\"btn btn-mini \" onclick=\"deleteFunction(" . $row['id'] . ")\"><i class=\"icon-remove-sign\"></i> Delete</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                Main::setMessage("host.php", mysql_error(), "alert-error");
            }

        }

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
