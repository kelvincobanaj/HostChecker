<?php
	require_once 'config.php';

	session_destroy();

	Main::setMessage( "index.php", "You have logged out!", "alert-info" );
