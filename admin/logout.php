<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("location: ../Auth/login.php");
}
else
{
	session_destroy();
	header("location: ../Auth/login.php");
}

?>