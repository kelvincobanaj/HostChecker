<?php
	require_once 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo Main::pageTitle( $scriptName ); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">

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
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="navbar-brand" href="index.php"><?php echo $scriptName; ?></a>
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li><a href="ping.php"><span class="glyphicon glyphicon-globe"></span> Ping</a></li>
					<li><a href="traceroute.php"><span class="glyphicon glyphicon-retweet"></span> Trace Route</a></li>
					<li><a href="dns.php"><span class="glyphicon glyphicon-refresh"></span> DNS</a></li>
					<li><a href="whois.php"><span class="glyphicon glyphicon-signal"></span> Whois</a></li>
					<?php if ( $myUser->LogedinBool() )
					{
						?>
						<li><a href="host.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Host</a></li> <?php } ?>
					<?php if ( $myUser->LogedinBool() )
					{
						?>
						<li><a href="settings.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li> <?php } ?>
					<?php if ( !$myUser->LogedinBool() )
					{
						?>
						<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li> <?php } ?>
					<?php if ( !$myUser->LogedinBool() )
					{
						?>
						<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Login</a></li> <?php } ?>
					<?php if ( $myUser->LogedinBool() )
					{
						?>
						<li><a href="logout.php"><span class="glyphicon glyphicon-share"></span> Logout</a></li> <?php } ?>
				</ul>
			</div>
		</div>
	</div>
<?php echo Main::handleMessages(); ?>

