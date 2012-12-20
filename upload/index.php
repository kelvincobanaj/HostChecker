<?php
    require_once 'header.php';

    $user = new Users();

    if (isset($_GET['delete'])) {
        $user->hostDelete($_SESSION['userid'], $_GET['delete']);
    }

    if ($user->LogedinBool()) {
        echo "<h3>Private Hosts</h3>";
        $user->selectPrivateHost($_SESSION['userid']);
    }

    echo "<h3>Public Hosts</h3>";
    $user->selectPublicHost();

    require_once 'footer.php';
?>