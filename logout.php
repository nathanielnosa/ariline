<?php
session_start();
ob_start();

if(isset($_SESSION['user'])){
	unset($_SESSION['user']);
	header('location:index.php');
}
elseif(isset($_SESSION['admin'])){
	unset($_SESSION['user']);
	header('location:index.php');
}
else
{
	header('location:index.php');
}
session_destroy();
?>