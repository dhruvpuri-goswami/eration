<?php
session_start();

if(!isset($_SESSION['rationcard_no']))
{
	header("location: ../Auth/login.php");
}
else
{
	session_destroy();
	header("location: ../Auth/login.php");
}