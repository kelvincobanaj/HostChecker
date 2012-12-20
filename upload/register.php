<?php require_once 'header.php';

    $myUser->isLogedin();

    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passrep = $_POST['passrep'];
        $email = $_POST['email'];

        if (isset($name) && !empty($name)) {
            if (isset($lastname) && !empty($lastname)) {
                if (isset($username) && !empty($username)) {
                    if ((isset($password) && isset($passrep)) && (!empty($password) && !empty($passrep))) {
                        if (isset($email) && !empty($email)) {
                            $myUser->userRegister($username, $password, $passrep, $email, $name, $lastname);
                        } else {
                            Main::setMessage("register.php", "The email filed is empty!", "alert-error");
                        }
                    } else {
                        Main::setMessage("register.php", "The password field is empty!", "alert-error");
                    }
                } else {
                    Main::setMessage("register.php", "The username field is empty!", "alert-error");
                }
            } else {
                Main::setMessage("register.php", "The lastname field is empty!", "alert-error");
            }
        } else {
            Main::setMessage("register.php", "The name field is empty!", "alert-error");
        }

    }


?>

<form class="form-horizontal" style="padding-left: 30px;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="control-group">
        <label class="control-label" for="inputName">Name</label>

        <div class="controls">
            <input type="text" name="name" class="input-xlarge" id="inputName" placeholder="Name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputLastname">Lastname</label>

        <div class="controls">
            <input type="text" name="lastname" class="input-xlarge" id="inputLastname" placeholder="Lastname">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputUsername">Username</label>

        <div class="controls">
            <input type="text" name="username" class="input-xlarge" id="inputUsername" placeholder="Username">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>

        <div class="controls">
            <input type="password" name="password" class="input-xlarge" id="inputPassword" placeholder="Password">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputRPassword">Repeat Password</label>

        <div class="controls">
            <input type="password" name="passrep" class="input-xlarge" id="inputRPassword"
                   placeholder="Repeat Password">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputEmail">Email</label>

        <div class="controls">
            <input type="text" name="email" class="input-xlarge" id="inputEmail" placeholder="Email">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" name="submit" class="btn input-xlarge">Register</button>
        </div>
    </div>
</form>

<?php require_once 'footer.php'; ?>