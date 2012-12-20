<?php
    require_once 'config.php';
    $myUser = new Users();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo Main::pageTitle(); ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script>
        function deleteFunction(postid) {
            var r = confirm("Are you sure you want to delete this host?");
            if (r == true) {
                window.location = "index.php?delete=" + postid;
            }
        }
    </script>
</head>
<body>
<div class="container">
    <div class="span9 offset1">
        <div class="navbar" style="padding-top: 25px;">
            <div class="navbar-inner">
                <a class="brand" href="index.php"><?php echo $scriptName; ?></a>
                <ul class="nav">
                    <li><a href="index.php"><i class="icon-home"></i> Home</a></li>
                    <li><a href="ping.php"><i class="icon-signal"></i> Ping</a></li>
                    <?php if ($myUser->LogedinBool()) { ?>
                    <li><a href="host.php"><i class="icon-plus-sign"></i> Add Host</a></li> <?php } ?>
                    <?php if ($myUser->LogedinBool()) { ?>
                    <li><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li> <?php } ?>
                    <?php if (!$myUser->LogedinBool()) { ?>
                    <li><a href="register.php"><i class="icon-user"></i> Register</a></li> <?php } ?>
                    <?php if (!$myUser->LogedinBool()) { ?>
                    <li><a href="login.php"><i class="icon-check"></i> Login</a></li> <?php } ?>
                    <?php if ($myUser->LogedinBool()) { ?>
                    <li><a href="logout.php"><i class="icon-share"></i> Logout</a></li> <?php } ?>
                </ul>
            </div>
        </div>
        <?php echo Main::handleMessages(); ?>