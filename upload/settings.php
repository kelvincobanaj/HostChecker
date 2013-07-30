<?php require_once 'header.php';

	$myUser->notLogedin();

	if ( isset( $_POST['passupdate'] ) )
	{
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$passrep = $_POST['passrep'];

		if ( isset( $oldpass ) && !empty( $oldpass ) )
		{
			if ( isset( $newpass ) && !empty( $newpass ) )
			{
				if ( isset( $passrep ) && !empty( $passrep ) )
				{
					$myUser->passUpdate( $_SESSION['userid'], $oldpass, $newpass, $passrep );
				} else
				{
					Main::setMessage( "settings.php", "Please make sure to have the same password in both fields", "alert-error" );
				}
			} else
			{
				Main::setMessage( "settings.php", "Please Input the value on the New Password Field", "alert-error" );
			}
		} else
		{
			Main::setMessage( "settings.php", "Please input your old password!", "alert-error" );
		}
	}

	if ( isset( $_POST['emailupdate'] ) )
	{
		$oldemail = $_POST['oldemail'];
		$newemail = $_POST['newemail'];
		$inptpass = $_POST['inputpassword'];

		if ( isset( $oldemail ) && !empty( $oldemail ) )
		{
			if ( isset( $newemail ) && !empty( $newemail ) )
			{
				if ( isset( $inptpass ) && !empty( $inptpass ) )
				{
					$myUser->emailUpdate( $_SESSION['userid'], $oldemail, $newemail, $inptpass );
				} else
				{
					Main::setMessage( "settings.php", "Please make sure to have repeated the password", "alert-error" );
				}
			} else
			{
				Main::setMessage( "settings.php", "Please Input the values on the New Email Field", "alert-error" );
			}
		} else
		{
			Main::setMessage( "settings.php", "Please input your old Email!", "alert-error" );
		}

	}


?>
	<div class="row">
		<div class=".col-lg-12 col-offset-1">
			<h2>Password Update</h2>

			<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label class="col-lg-2 control-label" for="inputOldPassword">Old Password</label>

					<div class="col-lg-8">
						<input type="password" class="form-control" name="oldpass" id="inputOldPassword" placeholder="Old Password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" for="inputNewPassword">New Password</label>

					<div class="col-lg-8">
						<input type="password" class="form-control" name="newpass" id="inputNewPassword" placeholder="New Password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" for="inputRepeatPassword">Repeat Password</label>

					<div class="col-lg-8">
						<input type="password" class="form-control" name="passrep" id="inputRepeatPassword" placeholder="Repeat Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10">
						<button type="submit" name="passupdate" class="btn btn-default col-offset-11">Update</button>
					</div>
				</div>
			</form>
		</div>

		<div class=".col-lg-12 col-offset-1">
			<h2>Email Update</h2>

			<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label class="col-lg-2 control-label" for="inputOldEmail">Old Email</label>

					<div class="col-lg-8">
						<input type="text" class="form-control" name="oldemail" id="inputOldEmail" placeholder="Old Email">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" for="inputNewEmail">New Email</label>

					<div class="col-lg-8">
						<input type="text" class="form-control" name="newemail" id="inputNewEmail" placeholder="New Email">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" for="inputPassword">Password</label>

					<div class="col-lg-8">
						<input type="password" class="form-control" name="inputpassword" id="inputPassword" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10">
						<button type="submit" name="emailupdate" class="btn btn-default col-offset-11">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>


<?php require_once 'footer.php'; ?>