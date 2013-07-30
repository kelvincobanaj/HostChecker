<?php require_once 'header.php';

	$myUser->isLogedin();

	if ( isset( $_POST['submit'] ) )
	{

		$name     = $_POST['name'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$passrep  = $_POST['passrep'];
		$email    = $_POST['email'];

		if ( isset( $name ) && !empty( $name ) )
		{
			if ( isset( $lastname ) && !empty( $lastname ) )
			{
				if ( isset( $username ) && !empty( $username ) )
				{
					if ( ( isset( $password ) && isset( $passrep ) ) && ( !empty( $password ) && !empty( $passrep ) ) )
					{
						if ( isset( $email ) && !empty( $email ) )
						{
							$myUser->userRegister( $username, $password, $passrep, $email, $name, $lastname );
						} else
						{
							Main::setMessage( "register.php", "The email filed is empty!", "alert-error" );
						}
					} else
					{
						Main::setMessage( "register.php", "The password field is empty!", "alert-error" );
					}
				} else
				{
					Main::setMessage( "register.php", "The username field is empty!", "alert-error" );
				}
			} else
			{
				Main::setMessage( "register.php", "The lastname field is empty!", "alert-error" );
			}
		} else
		{
			Main::setMessage( "register.php", "The name field is empty!", "alert-error" );
		}

	}


?>

	<form class="form-horizontal col-offset-2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputName">Name</label>

			<div class="col-lg-5">
				<input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputLastname">Lastname</label>

			<div class="col-lg-5">
				<input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Lastname">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputUsername">Username</label>

			<div class="col-lg-5">
				<input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputPassword">Password</label>

			<div class="col-lg-5">
				<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputRPassword">Repeat Password</label>

			<div class="col-lg-5">
				<input type="password" name="passrep" class="form-control" id="inputRPassword"
					   placeholder="Repeat Password">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label" for="inputEmail">Email</label>

			<div class="col-lg-5">
				<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
			</div>
		</div>
		<div class="form-group">
				<button type="submit" name="submit" class="btn btn-default col-offset-6">Register</button>
		</div>
	</form>

<?php require_once 'footer.php'; ?>