<?php
    require_once 'header.php';

    $login = new Users();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (isset($username) && !empty($username)) {
            if (isset($password) && !empty($password)) {
                if ($login->userLogin($username, $password)) {
                    Main::setMessage("index.php", "Welcome in Hostchecker", "alert-success");
                } else {
                    Main::setMessage("login.php", "Please try to login again!", "alert-error");
                }
            }
        }
    }

?>

<form class="form-horizontal offset1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="control-group">
        <label class="control-label" for="inputUsername">Username</label>

        <div class="controls">
            <input type="text" name="username" id="inputUsername" placeholder="Username">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>

        <div class="controls">
            <input type="password" name="password" id="inputPassword" placeholder="Password">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" name="submit" class="btn">Sign in</button>
        </div>
    </div>
</form>

<?php require_once 'footer.php'; ?>