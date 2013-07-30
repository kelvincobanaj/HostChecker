<?php

	require_once 'header.php';


	echo "<form action=\"traceroute.php\" method=\"get\">";
	echo "<input type=\"text\" class=\"form-control input-large\" name=\"host\" placeholder=\"Type the Domain or IP and press Enter\" />";
	echo "</form>";

	if ( isset( $_GET['host'] ) )
	{
		$host  = $_GET['host'];

		echo "<h2> Tracing: " . $host . "</h2>";
		$result = $myPing->traceRoute( $host );

		echo "<div class=\"panel panel-primary\">";
		echo "<div class=\"panel-heading\">";
		echo "<h3 class=\"panel-title\">Trace Route Result</h3>";
		echo "</div>";
		foreach ( $result as $value )
		{
			echo $value . "<br />";
		}
		echo "</div>";
	}


	require_once 'footer.php';