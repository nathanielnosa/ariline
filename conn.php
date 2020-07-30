<?php
session_start();
ob_start();
$airline = mysqli_connect('localhost', 'root', '');

if ($airline == true) 
{
	mysqli_select_db($airline, 'airline');
}
else
{
	die(mysqli_error());
}
?>