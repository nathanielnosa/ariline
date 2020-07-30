<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Airline</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=-1">
	<meta http-equiv="x-ua-compactible" content="ie-edge">
	<link rel="shortcut icon" href="img/logopng.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="font4.7/css/font-awesome.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.innerfade.js"></script>
	<style type="text/css">
		body{
			font-family: verdana;

		}
	</style>
</head>
<body>
<nav class="navbar navbar-static-top" style="border-bottom: 3px solid #242553; margin-bottom: 0;"><h3 class="navbar-text">Airline Reservation System</h3></nav>

<div class="container" style="background-image: url(img/img1.jpg); background-size: cover; height:600px; background-position: left; width:100%; padding-top:100px;">

		<div class="col-lg-12">
			<div class="col-lg-4"></div>
			<div class="col-lg-4" style="background-image: url('img/px2.png'); padding:3em;">
				<form method="POST" action="#">
			<div class="form-group">
				<input type="text" name="uname" class="form-control" placeholder="Enter Email" required="" style="background-color: transparent; color:#ffffff;" />
			</div>
		<br>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="loginbtn" style="width: 100%; padding: 1em;"><span class="glyphicon glyphicon-lock"></span> Get Password</button>
			</div>
			</form>
			<center>
				<a href="index.php" class="btn btn-default" style="background-color: transparent;  color: white; float: left"><span class="glyphicon glyphicon-log-in"></span> Login</a>
					<a href="register.php" class="btn btn-default" style="background-color: transparent;  color: white; float: right"><span class="glyphicon glyphicon-user"></span> Register</a>
					<div style="clear: both;"></div>
			</center>
			</div>
			<div class="col-lg-4"></div>
		</div>
		
	
</div>
</body>
</html>