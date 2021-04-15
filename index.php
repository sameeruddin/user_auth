<?php
session_start();
include 'db_config.php';
$msg='';
if(isset($_POST['signin']))
{
	$user_name = mysqli_real_escape_string($con,$_POST['user_name']);
	$passwd = mysqli_real_escape_string($con,$_POST['passwd']);
	$verify_user_query = "SELECT count(*) FROM `user_credentials` WHERE `user_name` = '".$user_name."'";
	$fetch_result = mysqli_query($con, $verify_user_query);
	$users_arry = mysqli_fetch_array($fetch_result);
	$user_count = $users_arry['count(*)'];
	if($user_count == 1)
	{
		$fetch_usr_password = "SELECT `user_passwd` FROM `user_credentials` WHERE `user_name` = '".$user_name."'";
		$fetch_hash_pass = mysqli_query($con, $fetch_usr_password);
		$results_arry = mysqli_fetch_array($fetch_hash_pass);
		$hash_password = $results_arry['user_passwd'];
		if(password_verify($passwd, $hash_password))
		{
			$_SESSION['user_name']= $user_name;
			$_SESSION['logged'] = TRUE;
			header("location:dashboard.php");
		}
		else
		{
			$msg = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" align=\"center\"> <strong> Error: </strong> Invalid password for this Username!! <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
		}
	}
	else
	{
		$msg = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" align=\"center\"> <strong> Error: </strong> No account found with the Username!! <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="POST">
					<span class="login100-form-title p-b-51">
						User Authentication
					</span>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="user_name" placeholder="Username">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="passwd" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
						</div>
						<div>
						</div>
					</div>
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" type="submit" name="signin">
							Sign In
						</button>
					</div>
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
						</div>
						<div>
						</div>
					</div>
					<div>
						<h5>
							Create an account: <a href='register.php'> <b>Register Here</b> </a>
						</h5>
					</div>
				</form>
				<div class="container">
					<div class="row">
						<?php echo $msg; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
