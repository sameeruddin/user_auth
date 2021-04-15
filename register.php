<?php
session_start();
include 'db_config.php';
$msg='';
if(isset($_POST['register']))
{
	$user_name = mysqli_real_escape_string($con,$_POST['user_name']);
	$passwd = mysqli_real_escape_string($con,$_POST['passwd']);
	$confirm_passwd = mysqli_real_escape_string($con,$_POST['confirm_passwd']);
	$pass_result = strcmp($passwd, $confirm_passwd);
	if ($pass_result == 0)
	{
		$hash_passwd = password_hash($passwd, PASSWORD_DEFAULT);
		$verify_query = "SELECT count(*) FROM `user_credentials` WHERE `user_name` = '".$user_name."'";
		$fetch_result = mysqli_query($con, $verify_query);
		$users_arry = mysqli_fetch_array($fetch_result);
		$user_count = $users_arry['count(*)'];
		if($user_count == 0)
		{
			$first_name = mysqli_real_escape_string($con,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($con,$_POST['last_name']);
			$user_email = mysqli_real_escape_string($con,$_POST['user_email']);
			$insert_query = "INSERT INTO `user_credentials`(`first_name`, `last_name`, `user_name`, `user_email`, `user_passwd`) VALUES ('".$first_name."', '".$last_name."', '".$user_name."','".$user_email."', '".$hash_passwd."')";
			$insert_user = mysqli_query($con, $insert_query);
			if($insert_user)
			{
				$msg = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" align=\"center\"> <strong> Success: </strong> User registered successfully visit: <a href=\"index.php\"> Log In Page</a> <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			}
			else
			{
				$msg = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" align=\"center\"> <strong> Error: </strong> Insertion query error!! <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
			}
		}
		else
		{
			$msg = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" align=\"center\"> <strong> Error: </strong> Registered User!! <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		}
	}
	else
	{
		$msg = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" align=\"center\"> <strong> Error: </strong> password and confirm password does not match!! <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		User Registration
	</title>
	<link href="css/style_register.css" rel='stylesheet' type='text/css' />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<!--webfonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text.css'/>
	<!--//webfonts-->
</head>
<body>
	<div class="main">
		<div class="header" >
			<h1>User Registration</h1>
		</div>
		<p> Fill the below form and register for your account.</p>
			<form method="POST" name="form">
				<ul class="left-form">
					<h2>User Details:</h2>
					<li>
						<input type="text"   placeholder="First Name" name="first_name" required/>
						<div class="clear"> </div>
					</li>
					<li>
						<input type="text"   placeholder="Last Name" name="last_name" required/>
						<div class="clear"> </div>
					</li>
					<li>
						<input type="email"   placeholder="Email-id" name="user_email" required/>
						<div class="clear"> </div>
					</li>
						<div class="clear"> </div>
				</ul>
				<ul class="right-form">
					<h3>User Credentials:</h3>
						<li>
							<input type="text"  placeholder="User Name" name="user_name" required/>
							<div class="clear"> </div>
						</li>
						<li>
							<input type="password"  placeholder="Password" name="passwd" required/>
							<div class="clear"> </div>
						</li>
						<li>
							<input type="password"  placeholder="Confirm Password" name="confirm_passwd" required/>
							<div class="clear"> </div>
						</li>
					<br>
					<br>
					<input type="submit" value="Register" name="register">
					<div class="clear"> </div>
				</ul>
			</form>
			<div class="clear"> </div>
		</div>
		<br>
		<div class="container">
			<div class="row">
				<?php echo $msg; ?>
			</div>
		</div>
</body>
</html>
