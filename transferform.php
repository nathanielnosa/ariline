<?php 
include('config.php');

$flightid = $_REQUEST['id'];

?>


					<div class="form-group">
						<input type="text" name="uname" class="form-control" placeholder="Recipient's name.." required=""  />
					</div>
					<input type="hidden" name="flightid" value="<?php echo $flightid ?>" />
					<div class="form-group">
							<button type="submit" class="btn btn-primary" name="traveldetailsbtn" style="width: 100%; padding: 1em;"><span class="fa fa-reply"></span> Transfer Ticket</button>
					</div>