<?php
include('conn.php');

if (isset($_SESSION['user'])) {
	$queryuserdetails = $airline->query("SELECT * FROM register WHERE uname='".$_SESSION['user']."'");
	if ($queryuserdetails->num_rows > 0) {
		$loopuserdetails = $queryuserdetails->fetch_object();
		$getfname = $loopuserdetails->fname;
		$getlname = $loopuserdetails->lname;
		$getpnum = $loopuserdetails->pnum;
		$getemail = $loopuserdetails->email;
		$getaddr = $loopuserdetails->addr;
		$getphoto = $loopuserdetails->photo;
	}
}

function register($airline, $fname, $lname, $email, $pnum, $addr, $uname, $psw, $photo){
	$queryusername = $airline->query("SELECT * FROM register WHERE uname='$uname'");
	$queryemail = $airline->query("SELECT * FROM register WHERE email='$email'");
	$querypnum =  $airline->query("SELECT * FROM register WHERE pnum='$pnum'");
	if ($queryusername->num_rows > 0) {
		echo "<div class='alert alert-danger text-center'>Username Already Exists</div>";
	}
	elseif($queryemail->num_rows > 0)
	{
			echo "<div class='alert alert-danger text-center'>Email Already Exists</div>";
	}
	elseif($querypnum->num_rows > 0)
	{
			echo "<div class='alert alert-danger text-center'>Phone Number Already Exists</div>";
	}
	else
	{
		$insert = $airline->query("INSERT INTO register VALUES(null, '$fname', '$lname', '$email', '$pnum', '$addr', '$uname', '$psw', CURRENT_TIMESTAMP, '$photo')");
		if ($insert == true) {
			echo "<div class='alert alert-success text-center'>Registration Successful!</div>";
		}
		else
		{
			echo "<div class='alert alert-danger text-center'>REGISTER QUERY ERROR</div>";
		}
	}
}

function login($airline, $uname, $psw){
	$queryuserlogin = $airline->query("SELECT * FROM register WHERE uname='$uname' && psw='$psw'");
	$queryadminlogin = $airline->query("SELECT * FROM admin WHERE adminuname='$uname' && adminpsw='$psw'");

	if ($queryuserlogin->num_rows > 0) {
		$_SESSION['user'] = strtoupper($uname);
		echo "<div class='alert alert-success text-center'>Login Successful!</div>";
		header('refresh:1; url=home.php');
	}
	elseif ($queryadminlogin->num_rows > 0) {
		$_SESSION['admin'] = strtoupper($uname);
		echo "<div class='alert alert-success text-center'>Admin Login Successful!</div>";
		header('refresh:1; url=admin-home.php');
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>Login Incorrect!</div>";
	}
}

function addtraveldetails($airline, $source, $destination, $flighttype, $flighttime, $flightamt){
		$query = $airline->query("SELECT * FROM traveldetails WHERE sourceloc='$source' && destinationloc='$destination' && flighttype='$flighttype'");
	if ($query->num_rows < 1) {
		$insert = $airline->query("INSERT INTO traveldetails VALUES(null,'$source', '$destination', '$flighttype', '$flighttime', '$flightamt', CURRENT_TIMESTAMP)");
		if ($insert == true) {
			echo "<div class='alert alert-success text-center'>Travel Details Saved Successfully!</div>";
		}
		else
		{
			echo "<div class='alert alert-danger text-center'>TRAVEL DETAILS QUERY ERROR</div>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>Travel Details with same information on <b>".$source."</b>, <b>".$destination."</b> and <b>".$flighttype."</b> Already Exists!</div>";
	}
}

function viewtraveldetails($airline){
	$query = $airline->query("SELECT * FROM traveldetails");
	if ($query->num_rows > 0) {
		while ($loop = $query->fetch_object()) {
			
			echo '<div class="alert alert-info">
					<div style="float: left"> <span class="fa fa-plane"></span> '.$loop->sourceloc.' - <span class="fa fa-plane"></span> '.$loop->destinationloc.'</div>
					<div style="clear: both;"></div>
					<div style="float: left"><b><u>'.$loop->flighttype.' </u></b></div><br>
				
					<div style="clear: both;"></div>

					<div style="float: left">
						<b>'.$loop->flighttime.'</b>
					</div>
					<div style="float: right">
						<b>'.$loop->flightamt.'</b>

					</div>
					<div style="clear: both"></div>
				</div>';
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>No travel records found</div>";
	}
}

function checkflightdetails($airline, $source, $destination){

	$query = $airline->query("SELECT * FROM traveldetails WHERE sourceloc='$source' && destinationloc='$destination'");
	if ($query->num_rows > 0) {
		echo '<h3 class="text-center text-primary">Flight Ticket Lists</h3>';
		while ($loop = $query->fetch_object()) {
			
			echo '<div class="alert alert-info">
					<div style="float: left"> <span class="fa fa-plane"></span> '.$loop->sourceloc.' - <span class="fa fa-plane"></span> '.$loop->destinationloc.'</div>
					<div style="clear: both;"></div>
					<div style="float: left"><b><u>'.$loop->flighttype.' </u></b></div><br>
				
					<div style="clear: both;"></div>

					<div style="float: left">
						<b>'.$loop->flighttime.'</b>
					</div>
					<div style="float: right">
						<b>'.$loop->flightamt.'</b>

					</div>
					<div style="clear: both"></div>
					<div align="center">
						<button class="btn btn-primary btn-sm bookflight" data-toggle="modal" data-target="#bookflight" name="'.$loop->id.'" style="border-radius: 10px;"><span class="glyphicon glyphicon-check"></span> Book flight</button>
					</div>
					<div style="clear: both"></div>
				</div>';
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>No travel records found</div>";
	}
}

function viewsourcelist($airline){
	$query = $airline->query("SELECT DISTINCT(sourceloc) FROM traveldetails");
	if ($query->num_rows > 0) {
		while($loop = $query->fetch_object()){
			echo "<option value='".$loop->sourceloc."'>".$loop->sourceloc."</option>";
		}
	}
	else
	{
		echo "<option value='' selected=''>-- NO SOURCE LOCATION RECORD FOUND --</option>";
	}
}
function viewdestinationlist($airline){
	$query = $airline->query("SELECT DISTINCT(destinationloc) FROM traveldetails");
	if ($query->num_rows > 0) {
		while($loop = $query->fetch_object()){
			echo "<option value='".$loop->destinationloc."'>".$loop->destinationloc."</option>";
		}
	}
	else
	{
		echo "<option value='' selected=''>-- NO SOURCE LOCATION RECORD FOUND --</option>";
	}
}

function addflightoption($airline, $flightdetails){
	$query = $airline->query("SELECT * FROM flightoption WHERE flightdetails='$flightdetails'");
	if ($query->num_rows < 1) {
		$insert = $airline->query("INSERT INTO flightoption VALUES(null,'$flightdetails', CURRENT_TIMESTAMP)");
		if ($insert == true) {
			echo "<div class='alert alert-success text-center'>Flight Option <b>(".$flightdetails.")</b> Saved Successfully!</div>";
		}
		else
		{
			echo "<div class='alert alert-danger text-center'>FLIGHT OPTION QUERY ERROR</div>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>Flight Option <b>(".$flightdetails.")</b> Exists!</div>";
	}
}
function viewflightoption($airline){
	$query = $airline->query("SELECT * FROM flightoption");
	if ($query->num_rows > 0) {
		while($loop = $query->fetch_object()){
			echo "<option value='".$loop->flightdetails."'>".$loop->flightdetails."</option>";
		}
	}
	else
	{
		echo "<option value='' selected=''>-- NO FLIGHT TYPE RECORD FOUND --</option>";
	}
}
function addflighttype($airline, $flightdetails){
	$query = $airline->query("SELECT * FROM flighttype WHERE flightdetails='$flightdetails'");
	if ($query->num_rows < 1) {
		$insert = $airline->query("INSERT INTO flighttype VALUES(null,'$flightdetails', CURRENT_TIMESTAMP)");
		if ($insert == true) {
			echo "<div class='alert alert-success text-center'>Flight Type <b>(".$flightdetails.")</b> Saved Successfully!</div>";
		}
		else
		{
			echo "<div class='alert alert-danger text-center'>FLIGHT TYPE QUERY ERROR</div>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>Flight Type <b>(".$flightdetails.")</b> Exists!</div>";
	}
}

function viewflighttypeoption($airline){
	$query = $airline->query("SELECT * FROM flighttype");
	if ($query->num_rows > 0) {
		while($loop = $query->fetch_object()){
			echo "<option value='".$loop->flightdetails."'>".$loop->flightdetails."</option>";
		}
	}
	else
	{
		echo "<option value='' selected=''>-- NO FLIGHT TYPE RECORD FOUND --</option>";
	}
}

function addflightcondition($airline, $flightdetails){
	$query = $airline->query("SELECT * FROM flightcondition WHERE flightdetails='$flightdetails'");
	if ($query->num_rows < 1) {
		$insert = $airline->query("INSERT INTO flightcondition VALUES(null,'$flightdetails', CURRENT_TIMESTAMP)");
		if ($insert == true) {
			echo "<div class='alert alert-success text-center'>Flight Condition <b>(".$flightdetails.")</b> Saved Successfully!</div>";
		}
		else
		{
			echo "<div class='alert alert-danger text-center'>FLIGHT CONDITION QUERY ERROR</div>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>Flight Condition <b>(".$flightdetails.")</b> Exists!</div>";
	}
}
function viewflightconditionoption($airline){
	$query = $airline->query("SELECT * FROM flightcondition");
	if ($query->num_rows > 0) {
		while($loop = $query->fetch_object()){
			echo "<option value='".$loop->flightdetails."'>".$loop->flightdetails."</option>";
		}
	}
	else
	{
		echo "<option value='' selected=''>-- NO FLIGHT CONDITION RECORD FOUND --</option>";
	}
}

function addsittingposition($airline, $flightdetails){
	$query = $airline->query("SELECT * FROM flightsittingposition WHERE flightdetails='$flightdetails'");
	if ($query->num_rows < 1) {
		$insert = $airline->query("INSERT INTO flightsittingposition VALUES(null,'$flightdetails', CURRENT_TIMESTAMP)");
		if ($insert == true) {
			echo "<div class='alert alert-success text-center'>Flight Sitting Position <b>(".$flightdetails.")</b> Saved Successfully!</div>";
		}
		else
		{
			echo "<div class='alert alert-danger text-center'>FLIGHT SITTING POSITION QUERY ERROR</div>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>Flight Sitting Position <b>(".$flightdetails.")</b> Exists!</div>";
	}
}
function viewsittingpositionoption($airline){
	$query = $airline->query("SELECT * FROM flightsittingposition");
	if ($query->num_rows > 0) {
		while($loop = $query->fetch_object()){
			echo "<option value='".$loop->flightdetails."'>".$loop->flightdetails."</option>";
		}
	}
	else
	{
		echo "<option value='' selected=''>-- NO FLIGHT TYPE RECORD FOUND --</option>";
	}
}

function viewusers($airline){
	$query = $airline->query("SELECT * FROM register");
	if ($query->num_rows > 0) {
		$sn = 0;
		echo '<h3 class="text-center text-primary">Registered Users Lists</h3>
				<table class="table table-condensed">';
		while ($loop = $query->fetch_object()) {
			# code...
			$sn += 1;
			echo "<tr><td>".$sn."</td><td><img src='".$loop->photo."' class='img-circle' style='width:50px; height:50px' /></td><td>".$loop->fname." ".$loop->lname."</td></tr>";
		}
		echo "</table>";
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>No records found</div>";
	}
}

function addflightdetails($airline, $fullname, $email, $pnum, $addr, $uname, $source, $destination, $flighttype, $flighttime, $flightamt, $flightoption, $flightcondition, $flightsittingposition, $departuredate, $returndate, $flightid)
{

	$query = $airline->query("SELECT * FROM flightdetails WHERE flightid='$flightid' || departuredate='$departuredate' && returndate='$returndate' && uname='$uname'");

		if ($query->num_rows > 0) {
			echo "<div class='alert alert-danger text-center'>Flight records already exists</div>";
		}
		else
		{
				$insert = $airline->query("INSERT INTO flightdetails VALUES(null,'$fullname', '$email', '$pnum', '$addr', '$uname', '$source', '$destination', '$flighttype', '$flighttime', '$flightamt','$flightoption', '$flightcondition', '$flightsittingposition', '$departuredate', '$returndate', '$flightid', CURRENT_TIMESTAMP, '')");
			if ($insert == true) {
				echo "<div class='alert alert-success text-center'>Flight Booking Saved Successfully!</div>";
			}
			else
			{
				echo "<div class='alert alert-danger text-center'>FLIGHT BOOKING QUERY ERROR</div>";
			}
		}
	
}

function viewbookedflightuser($airline, $uname){

	$query = $airline->query("SELECT * FROM flightdetails WHERE uname='$uname'");
	if ($query->num_rows > 0) {
		echo '<h3 class="text-center text-primary">Booked Flight Ticket Lists</h3>';
		while ($loop = $query->fetch_object()) {
			
			echo '<div class="alert alert-info">
					<div style="float: left"> <span class="fa fa-plane"></span> '.$loop->sourceloc.' - <span class="fa fa-plane"></span> '.$loop->destinationloc.'</div>
					<div style="clear: both"></div>
					<div style="float: left"><b><u>'.$loop->flighttype.' </u></b></div>
					<div style="clear: both"></div>
					<div style="float: left">
						<b><span class="glyphicon glyphicon-time"></span> '.$loop->flighttime.'</b>
					</div>
					
					<div style="float: right">
						<b>'.$loop->flightamt.'</b>

					</div>
					<div style="clear: both;"></div>

					<div style="float: left">
						<button class="btn btn-default btn-sm transferticket" data-toggle="modal" data-target="#transferticket" name="'.$loop->flightid.'"  style="border-radius: 10px;"><span class="fa fa-reply"></span> Transfer Ticket </button>
					</div>
					<div style="float: right;">
						<button class="btn btn-default btn-sm transferticket" data-toggle="modal" data-target="#viewdetails" name="'.$loop->flightid.'" style="border-radius: 10px;"><span class="fa fa-eye"></span> View Ticket Details</button>
					</div>
					<div style="clear: both"></div>
				</div>';
		}
	}
	else
	{
		echo "<div class='alert alert-danger text-center'>No travel records found</div>";
	}
}

function transferticket($airline, $uname, $flightid){

	$querycheckuname = $airline->query("SELECT * FROM register WHERE uname='$uname'");
	if ($querycheckuname->num_rows < 1) {
		echo "<div class='alert alert-danger text-center'>User records not found!</div>";
	}
	else
	{
		$query = $airline->query("SELECT * FROM flightdetails WHERE uname='$uname' and flightid='$flightid'");
		if ($query->num_rows > 0) {
			# code...
			echo "<div class='alert alert-danger text-center'>User with travel records already exists</div>";
		}
		else
		{
			//WRITE CODE TO UPDATE
			$queryuserdetails = $airline->query("SELECT * FROM register WHERE uname='$uname'");
			if ($queryuserdetails->num_rows > 0) {
				$loopuserdetails = $queryuserdetails->fetch_object();
				$getfname = $loopuserdetails->fname;
				$getlname = $loopuserdetails->lname;
				$getpnum = $loopuserdetails->pnum;
				$getemail = $loopuserdetails->email;
				$getaddr = $loopuserdetails->addr;
				$getphoto = $loopuserdetails->photo;
				$getfullname = $getfname." ".$getlname;
				$update = $airline->query("UPDATE flightdetails SET fullname='$getfullname', email='$getemail', pnum='$getpnum', addr='$getaddr', uname='$uname', transferuname='".$_SESSION['user']."' WHERE flightid='$flightid'");
				if ($update == true) {
					# code...
					echo "<div class='alert alert-success text-center'>Flight Ticket Transferred Successfully to ".$uname."!</div>";

				}
				else
				{
					echo "<div class='alert alert-danger text-center'>TICKET TRANSFER QUERY ERROR</div>";
				}
			}
		}
	}
	
}
?>