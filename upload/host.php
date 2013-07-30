<?php
	require_once 'header.php';

	$myUser->notLogedin();

	if ( isset( $_POST['addhost'] ) )
	{

		$hostname   = $_POST['hostname'];
		$domainorip = $_POST['domainorip'];
		$port       = $_POST['port'];
		$ispublic   = $_POST['ispublic'];
		$userid     = $_SESSION['userid'];

		if ( !isset( $hostname ) && empty( $hostname ) )
		{
			Main::setMessage( "host.php", "Please make sure to have putted the correct Host Name!", "alert-error" );
		}
		if ( !isset( $domainorip ) && empty( $domainorip ) )
		{
			Main::setMessage( "host.php", "Please make sure to have putted the correct Hostname or IP", "alert-error" );
		}
		if ( !isset( $port ) && empty( $port ) )
		{
			Main::setMessage( "host.php", "Please make sure you have inputted the correct port number!", "alert-error" );
		} else
		{
			$myUser->addHost( $userid, $hostname, $domainorip, $port, $ispublic );
		}
	}

?>
	<form class="form-horizontal col-offset-2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputHostname">Host Name</label>

			<div class="col-lg-5">
				<input type="text" name="hostname" class="form-control" id="inputHostname" placeholder="Host Name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputDomainOrIP">Domain or IP</label>

			<div class="col-lg-5">
				<input type="text" name="domainorip" class="form-control" id="inputDomainOrIP" placeholder="Domain or IP">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputPort">Port</label>

			<div class="col-lg-5">
				<input type="text" name="port" class="form-control" id="inputPort" placeholder="Port">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="isPublic">Is Public Host?</label>
			<div class="col-lg-4">
				<div class="radio">
					<label>
						<input type="radio" name="ispublic" value="1" id="isPublic"> Yes
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="ispublic" value="0" id="isPublic" checked> No
					</label>
				</div>
			</div>
			<div class="controls">
				<button type="submit" name="addhost" class="btn btn-default">Add Host</button>
			</div>
		</div>
	</form>
<?php require_once 'footer.php'; ?>