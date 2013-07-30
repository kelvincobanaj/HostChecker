<?php
	require_once 'header.php';

	$myUser->isLogedin();

	if ( isset( $_POST['submit'] ) )
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if ( !$myUser->userLogin( $username, $password ) )
		{
			Main::setMessage( "login.php", "Please try to login again!", "alert-error" );
		} else
		{
			Main::setMessage( "index.php", "Welcome in " . $scriptName, "alert-success" );
		}
	}

?>
	<form class="form-horizontal col-offset-2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<fieldset>
			<div class="form-group">
				<label class="col-lg-2 control-label" for="inputUsername">Username</label>

				<div class="col-lg-5">
					<input type="text" class="form-control" name="username" id="inputUsername" placeholder="Username">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label" for="inputPassword">Password</label>

				<div class="col-lg-5">
					<input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" name="submit" class="btn btn-default col-offset-4">Login</button>
				</div>
			</div>
		</fieldset>
	</form>

<?php require_once 'footer.php'; ?>