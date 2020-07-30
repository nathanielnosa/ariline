<?php 
include('config.php');
if (!isset($_SESSION['admin'])) {
	echo "<script>alert('You must first login as an Administrator!'); window.location = 'index.php'</script>";
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
<a href="logout.php" class="btn btn-danger" style="float: right; margin:1%">Logout</a>
<div style="clear: both"></div>
</nav>

<div class="container" style="background-color: white; padding:2em;">
<div>
					<i class="fa fa-user-circle-o" style="font-size: 30px;color:#242553"></i> Welcome, <b><?php echo $_SESSION['admin']; ?></b>
			</div>
		<hr>
		<div class="col-lg-12" style="max-height: 450px; overflow: auto">
			<div class="col-lg-4" style=" max-height: 400px; overflow: auto;">
				<h3 class="text-center text-primary"><i class="fa fa-gear"></i> Flight Management</h3>
				<center>
					<?php 
					if (isset($_POST['flightoptionbtn'])) {
						addflightoption($airline, strtoupper($_POST['flightoption']));
					}
					elseif (isset($_POST['flighttypebtn'])) {
						addflighttype($airline, strtoupper($_POST['flighttype']));
					}
					elseif (isset($_POST['flightconditionbtn'])) {
						addflightcondition($airline, strtoupper($_POST['flightcondition']));
					}
					elseif (isset($_POST['sittingpositionbtn'])) {
						
						addsittingposition($airline, strtoupper($_POST['sittingposition']));
					}
					elseif (isset($_POST['traveldetailsbtn'])) {

						addtraveldetails($airline, strtoupper($_POST['source']), strtoupper($_POST['destination']), strtoupper($_POST['flighttype']), strtolower($_POST['flighttime']), strtoupper($_POST['flightamt']));
					}
					
					?>
					<button class="btn btn-primary" style="padding: 1em; width: 100%; " type="button" data-toggle="modal" data-target="#traveldetails">Travel Details</button> <br><br>
					<button class="btn btn-info" style="padding: 1em; width: 100%; " type="button" data-toggle="modal" data-target="#flightoption">Flight Options</button> <br><br>
				<button class="btn btn-primary" style="padding: 1em; width: 100%; " type="button" data-toggle="modal" data-target="#flighttype">Flight type</button> <br><br>
				<button class="btn btn-info" style="padding: 1em; width: 100%; " type="button" data-toggle="modal" data-target="#flightcondition">Flight Condition</button> <br><br>
				<button class="btn btn-primary" style="padding: 1em; width: 100%; " type="button" data-toggle="modal" data-target="#sittingposition">Sitting Position</button> <br>
				</center>
				
			</div>
			<div class="col-lg-4" style="max-height: 400px; overflow: auto;">
				
			
			<?php viewusers($airline); ?>
				
			</div>
				
					
		
			<div class="col-lg-4" style="border-left:3px solid whitesmoke; max-height: 400px; overflow: auto;">
				<h3 class="text-primary text-center">View Flight Information</h3>
				<!-- <div class="alert alert-info">
					<div style="float: left"> <span class="fa fa-plane"></span> Mexico - <span class="fa fa-plane"></span> Dubai</div>
					
					<div style="float: right"><b><u>First Class </u></b></div><br>
					<b>6 Hrs</b><br>
					<div style="clear: both;"></div>

					<div style="float: left">
						<button class="btn btn-default btn-sm transferticket" data-toggle="modal" data-target="#bookflight"  style="border-radius: 10px;"><span class="fa fa-eye"></span> View Ticket Details</button>
					</div>
					<div style="float: right">
						<b>&#8358;250,000</b>

					</div>
					<div style="clear: both"></div>
				</div> -->
				<?php viewtraveldetails($airline); ?>
			</div>
		</div>
		
	
</div>
</body>
<!-- TRAVEL DETAILS -->
<?php include('modal-travel-details.php') ?>
<!-- END OF TRAVEL DETAILS -->
<!-- FLIGHT OPTIONS -->
<?php include('modal-flight-option.php') ?>
<!-- END OF FLIGHT OPTION -->
<!-- FLIGHT TYPE -->
<?php include('modal-flight-type.php') ?>
<!-- END OF FLIGHT TYPE -->
<!-- FLIGHT CONDITION -->
<?php include('modal-flight-condition.php') ?>
<!-- END OF FLIGHT CONDITION -->
<!-- SITTING POSITION DETAILS -->
<?php include('modal-sitting-position.php') ?>
<!-- END OF SITTING POSITION DETAILS -->

</html>
