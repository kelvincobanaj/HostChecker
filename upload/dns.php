<?php

	require_once 'header.php';


	echo "<form action=\"dns.php\" method=\"get\" class=\"clearfix\">";
	echo "<div class=\"form-group col-lg-9\">";
	echo "<input type=\"text\" class=\"form-control input-large\" name=\"host\" placeholder=\"Type the Domain or IP and press Enter\" />";
	echo "</div>";
	echo "<div class=\"form-group col-lg-3\">";
	echo "<select name=\"type\" class=\"form-control input-large col-lg-3\">
								<option value=\"A\">A</option>
								<option value=\"AAAA\">AAAA</option>
								<option value=\"CNAME\">CNAME</option>
								<option value=\"MX\">MX</option>
								<option value=\"NS\">NS</option>
								<option value=\"TXT\">TXT</option>
		  </select>";
	echo "</div>";
	echo "</form>";

	if ( isset( $_GET['host'] ) )
	{
		$host  = $_GET['host'];
		$type  = $_GET['type'];

		echo "<h2> Checking: " . $host . "</h2>";

		$result = $myPing->dnsLookup( $host, $type);

		echo "<div class=\"panel panel-primary\">";
		echo "<div class=\"panel-heading\">";
		echo "<h3 class=\"panel-title\">DNS Result</h3>";
		echo "</div>";
		foreach ( $result as $value )
		{
			echo $value . "<br />";
		}
		echo "</div>";
	}


	require_once 'footer.php';