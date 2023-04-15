<?php
session_start();

if(!isset($_SESSION['rationcard_no']))
{
	header("location: ../login/login.php");
}
else
{
	session_destroy();
	header("location: ../login/login.php");
}

?>