<?php

	require_once 'header.php';


	echo "<form action=\"ping.php\" method=\"get\">";
	echo "<input type=\"text\" class=\"form-control input-large\" name=\"host\" placeholder=\"Type the Domain or IP and press Enter\" />";
	echo "<input type=\"hidden\" name=\"port\" value=\"80\" />";
	echo "<input type=\"hidden\" name=\"count\" value=\"4\" />";
	echo "</form>";

	if ( isset( $_GET['host'] ) )
	{
		$host  = $_GET['host'];
		$port  = $_GET['port'];
		$count = $_GET['count'];

		echo "<h2> Pinging: " . $host . "</h2>";

		if ( !( $count > 12 ) )
		{
			$result = $myPing->ping( $host, $port, $count );

			echo "<div class=\"panel panel-primary\">";
				echo "<div class=\"panel-heading\">";
					echo "<h3 class=\"panel-title\">Host Ping Result</h3>";
				echo "</div>";
					foreach ( $result as $value )
					{
						echo $value . "<br />";
					}
			echo "</div>";
		}
	}


	require_once 'footer.php';

