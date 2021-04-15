<?php
session_start();
$msg='';
if(!$_SESSION['logged'])
{
	header("Location: index.php");
	exit;
}
else
{
	$user_name = $_SESSION['user_name'];
	$msg = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" align=\"center\"> Welcome <strong> ".$user_name." </strong> <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";
}
if(isset($_POST['logout']))
{
	header("Location: logout.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		User Authentication
	</title>
	<link href="css/style_register.css" rel='stylesheet' type='text/css' />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="main">
		<div class="header" >
			<h1>User Authentication</h1>
		</div>
		<p> User details matched with the registered credentails </p>
			<form method="POST" name="form">
				<div class="container">
					<div class="row">
						<div class="col-sm-5"></div>
						<div class="col-sm-4">
							<input type="submit" class="btn btn-info btn-lg" value="Sign Out" name="logout">
							<div class="clear"> </div>
						</div>
					</div>
				</div>
			</form>
			<div class="clear"> </div>
		</div>
		<br />
		<div class="container">
			<div class="row">
				<?php echo $msg; ?>
			</div>
		</div>
</body>
</html>
