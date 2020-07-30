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

<div class="container" style="background-image: url(img/img1.jpg); background-size: cover; height:600px; background-position: left; width:100%; padding-top:20px;">

		<div class="col-lg-12">
			<div class="col-lg-4"></div>
			<div class="col-lg-4" style="background-image: url('img/px2.png'); padding:2em;">
				<?php 
				if (isset($_POST['registerbtn'])) {
					$picname = $_FILES['photo']['name'];
					$pictemploc = $_FILES['photo']['tmp_name'];
					$loc = 'uploads/'.$picname;
					move_uploaded_file($pictemploc, $loc);

					register($airline, $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['pnum'], $_POST['addr'], $_POST['uname'], $_POST['psw'], $loc);
				}
				?>
				<form method="POST" action="#" enctype="multipart/form-data">
			<div class="form-group">

				<input type="text" name="fname" class="form-control" placeholder="First name" required="" style="background-color: transparent; color:#ffffff;" />
			</div>
			<div class="form-group">
				<input type="text" name="lname" class="form-control" placeholder="Last name" required="" style="background-color: transparent; color:#ffffff;" />
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="Email" required="" style="background-color: transparent; color:#ffffff;" />
			</div>
			<div class="form-group">
				<input type="number" name="pnum" class="form-control" placeholder="Phone number" required="" style="background-color: transparent; color:#ffffff;">
			</div>
			<div class="form-group">
				<textarea class="form-control" name="addr" required="" placeholder="Address" style="background-color: transparent; color:#ffffff;"></textarea>
				
			</div>
			<div class="form-group">
				<input type="text" name="uname" class="form-control" placeholder="Username" required="" style="background-color: transparent; color:#ffffff;">
			</div>
			<div class="form-group">

				<input type="password" name="psw" class="form-control" placeholder="Password" required="" style="background-color: transparent; color:#ffffff;">
			</div>
			<div class="form-group">

				<input type="file" name="photo" class="form-control" required="" style="background-color: transparent; color:#ffffff;">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="registerbtn" style="width: 100%; padding: 1em;"><span class="glyphicon glyphicon-user"></span> Register</button>
			</div>
			</form>
			<center>
				<a href="index.php" class="btn btn-default" style="background-color: transparent;  color: white; float: left"><span class="glyphicon glyphicon-log-in"></span> Login</a>
					<a href="forgot.php" class="btn btn-default" style="background-color: transparent;  color: white; float: right"><span class="glyphicon glyphicon-question-sign"></span> Forgot Password?</a>
					<div style="clear: both;"></div>
			</center>
			</div>
			<div class="col-lg-4"></div>
		</div>
		
	
</div>
</body>
</html>