<?php

	require_once 'header.php';


	echo "<form action=\"whois.php\" method=\"get\">";
	echo "<input type=\"text\" class=\"form-control input-large\" name=\"host\" placeholder=\"Type the Domain and press Enter\" />";
	echo "</form>";

	if ( isset( $_GET['host'] ) )
	{
		$host  = $_GET['host'];

		echo "<h2> Whois: " . $host . "</h2>";
		$result = $myPing->whois( $host );

		echo "<div class=\"panel panel-primary\">";
		echo "<div class=\"panel-heading\">";
		echo "<h3 class=\"panel-title\">Whois Result</h3>";
		echo "</div>";
		foreach ( $result as $value )
		{
			echo $value . "<br />";
		}
		echo "</div>";
	}


	require_once 'footer.php';