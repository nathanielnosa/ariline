<?php
include('config.php');
$id = $_REQUEST['id'];

$query = $airline->query("SELECT * FROm traveldetails WHERE id='".$id."'");
$loop = $query->fetch_object();

?>


	<input type="hidden" name="fullname" value="<?php echo $getfname. " ".$getlname; ?>" required="" class="form-control">

	<input type="hidden" name="email" value="<?php echo $getemail; ?>" required="" class="form-control">

	<input type="hidden" name="pnum" value="<?php echo $getpnum; ?>" required="" class="form-control">

	<input type="hidden" name="addr" value="<?php echo $getaddr; ?>" required="" class="form-control">

	<input type="hidden" name="uname" value="<?php echo $_SESSION['user']; ?>" required="" class="form-control">

	<input type="hidden" name="source" value="<?php echo $loop->sourceloc; ?>" required="" class="form-control">

	<input type="hidden" name="destination" value="<?php echo $loop->destinationloc; ?>" required="" class="form-control">

	<input type="hidden" name="flighttype" value="<?php echo $loop->flighttype; ?>" required="" class="form-control">

	<input type="hidden" name="flighttime" value="<?php echo $loop->flighttime; ?>" required="" class="form-control">

	<input type="hidden" name="flightamt" value="<?php echo $loop->flightamt; ?>" required="" class="form-control">


<div class="form-group">
	<label>Flight Options</label>
				<select name="flightoption" class="form-control" required="">
					
					<option value="" selected="selected">-- Choose flight options --</option>
					<?php viewflightoption($airline); ?>
				</select>
</div>
<div class="form-group">
	<label>Flight Condition</label>
				<select name="flightcondition" class="form-control" required="">
					
					<option value="" selected="selected">-- Choose flight options --</option>
					<?php viewflightconditionoption($airline); ?>
				</select>
</div>
<div class="form-group">
	<label>Sitting Position</label>
				<select name="flightsittingposition" class="form-control" required="">
					
					<option value="" selected="selected">-- Choose sitting position --</option>
					<?php viewsittingpositionoption($airline); ?>
				</select>
</div>
<div class="form-group">
	<label>Departure Date</label>
	<input type="date" name="departuredate" required="" placeholder="Departure Date" class="form-control">
</div>
<div>
	<label>Return Date</label>
	<input type="date" name="returndate" required="" placeholder="Return Date" class="form-control">
</div><br>
<input type="hidden" name="flightid" class="form-control" required="" style="background-color: transparent; color:white;" value="<?php $text = 'abcdefghijkmlonpqABCDEFGHIJKMLOMNPQRSUVWXYZrstuvwxyz12345098765432167890'; echo 'FLIGHT-ID'.substr(str_shuffle($text), 0,15); ?>">
<div class="form-group">
	<button class="btn btn-primary" type="submit" name="completefligttbtn"><span class="glyphicon glyphicon-check"></span> Complete Flight</button>
</div>