<?php 
include('config.php');
if (!isset($_SESSION['user'])) {
	echo "<script>alert('You must first login as a regstered user!'); window.location = 'index.php'</script>";
}
?>
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
			background-color: whitesmoke
		}
	</style>
</head>
<body>
<nav class="navbar navbar-static-top" style="border-bottom: 3px solid #242553; margin-bottom: 0;"><h3 class="navbar-text">Airline Reservation System</h3>

<div style="float:right; margin: 1%; ">

	<a href="logout.php">
		<button class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span> Logout</button> 
	</a>
		
</div>
<div style="clear: both"></div>
</nav>

<div class="container" style="background-color: white; padding:2em;">
	<div>
					<i class="fa fa-user-circle-o" style="font-size: 30px;color:#242553"></i> Welcome, <b><?php echo $_SESSION['user'] ?></b>
			</div>
		<hr>
		<div class="col-lg-12" style="max-height: 450px; overflow: auto">
		

			<div class="col-lg-4" style="max-height: 400px; overflow: auto;">
				<h3 class="text-center text-primary">Book Flight</h3>

				<form method="POST" action="#">
			<div class="form-group">
				<label>Source location</label>
				<select name="source" class="form-control" required="">
					
					<option value="" selected="selected" >-- Choose Source --</option>
					<?php viewsourcelist($airline); ?>
				</select>
			</div>
				<div class="form-group">
					<label>Destination location</label>
				<select name="destination" class="form-control" required="">
					<option value="" selected="selected">-- Choose Destination --</option>
					<?php viewdestinationlist($airline); ?>
				</select>
			</div>
			<br>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="checkflightbtn" style="width: 100%; padding: 1em;"><span class="fa fa-plane"></span> Check Flight</button>
			</div>
			</form>
			<?php 
			if (isset($_POST['completefligttbtn'])) {
					
					addflightdetails($airline, strtoupper($_POST['fullname']), strtoupper($_POST['email']), strtoupper($_POST['pnum']), strtoupper($_POST['addr']), strtoupper($_POST['uname']), strtoupper($_POST['source']), strtoupper($_POST['destination']), strtoupper($_POST['flighttype']), strtoupper($_POST['flighttime']), strtoupper($_POST['flightamt']), strtoupper($_POST['flightoption']), strtoupper($_POST['flightcondition']), strtoupper($_POST['flightsittingposition']), strtoupper($_POST['departuredate']), strtoupper($_POST['returndate']), strtoupper($_POST['flightid']));
				}
			?>
			</div>
			<div class="col-lg-4" style="max-height: 400px; overflow: auto;">
				<?php 
				if (isset($_POST['checkflightbtn'])) {
					
					checkflightdetails($airline, strtoupper($_POST['source']), strtoupper($_POST['destination']));
				}
				elseif (isset($_POST['traveldetailsbtn'])) {
					transferticket($airline, $_POST['uname'], $_POST['flightid']);
				}
				else
				{
				?>
				<div class="alert alert-info text-center">
					Check flight ticket availability
				</div>

				<?php
				}
				?>
				
			
			</div>
			<div class="col-lg-4" style="max-height: 400px; overflow: auto;">
				
				<!--  -->
				<?php viewbookedflightuser($airline, $_SESSION['user']); ?>
				
			</div>
		</div>
		
	
</div>
</body>
<div class="modal fade" tabindex="-1" id="bookflight" role="dialog" aria-label="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title text-primary text-center">Book Flight Form</h3>
			</div>
			<form method="POST" action="#">
				
			
			<div class="modal-body flightform">
				
			</div>
			</form>
			<div class="modal-footer">
				<b><small>Airline Reservation System 2020</small></b>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" id="transferticket" role="dialog" aria-label="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title text-primary text-center">Travel Details Form</h3>
			</div>
			
				<form method="POST" action="#">
					<div class="modal-body form-display"></div>
				</form>
			
			<div class="modal-footer">
				<b><small>Airline Reservation System 2020</small></b>
			</div>
		</div>
	</div>
</div>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('.bookflight').on('click', function(){
			$id = $(this).attr('name');
			$('.flightform').load('flightform.php?id='+$id);
		});
		$('.transferticket').on('click', function(){
			$id = $(this).attr('name');
			$('.form-display').load('transferform.php?id='+$id);
		});
	})
</script>