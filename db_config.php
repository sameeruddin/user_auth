<?php
$con = mysqli_connect("localhost","root","","user_auth"); //connecting to the database
if (!$con)
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
