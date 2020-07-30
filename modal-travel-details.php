<div class="modal fade" tabindex="-1" id="traveldetails" role="dialog" aria-label="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title text-primary text-center">Travel Details Form</h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="#">
					<div class="form-group">
						<input type="text" name="source" class="form-control" placeholder="Source.." required=""  />
					</div>
					<div class="form-group">
						<input type="text" name="destination" class="form-control" placeholder="Destination.." required=""  />
					</div>
					<div class="form-group">
						<select name="flighttype" class="form-control" required="" >
							<option value="" selected="selected">-- CHOOSE FLIGHT TYPE --</option>
						<?php viewflighttypeoption($airline); ?>
						</select>
						
					</div>
					<div class="form-group">
						<input type="text" name="flighttime" class="form-control" placeholder="Flight Time.." required=""  />
					</div>
					<div class="form-group">
						<input type="number" name="flightamt" class="form-control" placeholder="Amount.." required=""  />
					</div>
					<div class="form-group">
							<button type="submit" class="btn btn-primary" name="traveldetailsbtn" style="width: 100%; padding: 1em;"><span class="fa fa-plane"></span> Save Travel Details</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<b><small>Airline Reservation System 2020</small></b>
			</div>
		</div>
	</div>
</div>