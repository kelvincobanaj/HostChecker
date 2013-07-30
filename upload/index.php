<?php
	require_once 'header.php';

	if ( isset( $_GET['delete'] ) )
	{
		$myUser->hostDelete( $_SESSION['userid'], $_GET['delete'] );
	}

	if ( $myUser->LogedinBool() )
	{
		echo "<h3>Private Hosts</h3>";
		$myUser->selectPrivateHost( $_SESSION['userid'] );
	}

	echo "<h3>Public Hosts</h3>";

	$myUser->selectPublicHost();

	require_once 'footer.php';