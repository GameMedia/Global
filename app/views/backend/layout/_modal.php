	<!-- Modal Delete -->
	<div id="formDelete" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Delete Confirmation</h3>
				</div>
				<div class="modal-body">
					<p>Are you sure want to delete this data?</p>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn">Cancel</button>
					<button type="button" data-dismiss="modal" class="btn blue" onClick="deleteData()">Delete</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Clone -->
	<div id="formClone" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Clone Confirmation</h3>
				</div>
				<div class="modal-body">
					<p>Are you sure want to Clone this data?</p>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn">Cancel</button>
					<button type="button" data-dismiss="modal" class="btn blue" onClick="cloneData()">Clone</button>
				</div>
			</div>
		</div>
	</div>
