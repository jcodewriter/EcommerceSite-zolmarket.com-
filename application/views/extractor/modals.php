<div class="modal fade" id="selected-options-modal" tabindex="-1" role="dialog"
	 aria-labelledby="selected-options-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="selected-options-modal-label">Selected Options</h4>
			</div>
			<div class="modal-body" style="height: 300px;overflow-y: scroll;">
				<table class="table table-bordered table-condensed" id="selected-options-table">
					<thead>
					<th><input type="checkbox" id="select-all"></th>
					<th>#</th>
					<th>name</th>
					<th>english name</th>
					<th></th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" id="remove-all-options">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove All
				</button>
				<button type="button" class="btn btn-danger btn-sm" id="remove-selected-options">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove selected
				</button>
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog"
	 aria-labelledby="add-category-modal-label">
	<div class="modal-dialog modal-lg" role="document" style="width:90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="add-category-modal-label">Add Category<span></span></h4>
			</div>
			<div class="modal-body" style="height: 60vh; overflow-y: scroll;">
				<div class="row">
					<div class="col-md-6">
						<div id="categories-tree-view"></div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th colspan="100%">
										<button class="btn btn-success btn-xs add-to-selected-categories">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
											Add to selected categories
										</button>
									</th>
								</tr>
								<tr>
									<th>#</th>
									<th>Category</th>
									<th></th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-3 text-left">
						<p class="label label-success msg hidden"></p>
					</div>
					<div class="col-md-9 text-right">
						<button type="button" class="btn btn-primary btn-sm save hidden">Save</button>
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="add-category-modal-x" tabindex="-1" role="dialog"
	 aria-labelledby="add-category-modal-x-label">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="add-category-modal-x-label">Add Category</h4>
			</div>
			<div class="modal-body" style="height: 300px;">
				<div class="row">
					<div class="col-md-4">
						<form class="form-horizontal">
							<div class="form-group text-right btn-add-group">
								<div class="col-sm-12">
									<button type="button" class="btn btn-primary add">Add</button>
								</div>
							</div>
						</form>

					</div>
					<div class="col-md-8">
						<div class="panel panel-default" style="max-height: 280px; overflow-y: scroll;z-index: 1">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>#</th>
									<th>Category</th>
									<th></th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="selected-categories-modal" tabindex="-1" role="dialog"
	 aria-labelledby="selected-categories-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="selected-categories-modal-label">Category</h4>
			</div>
			<div class="modal-body" style="height: 300px;overflow-y: scroll;">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>#</th>
						<th>Category</th>
						<th></th>
					</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit-option-modal" tabindex="-1" role="dialog"
	 aria-labelledby="edit-option-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="edit-option-modal-label">Edit Option</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-right">
						<button class="btn btn-success btn-xs prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							Prev
						</button>
						<button class="btn btn-success btn-xs next">
							Next
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal">
							<input type="hidden" class="form-control" id="option_uuid">
							<div class="form-group">
								<label for="option_lang_1" class="col-sm-4 control-label">Option (English)</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="option_lang_1">
								</div>
							</div>
							<div class="form-group">
								<label for="option_lang_2" class="col-sm-4 control-label">Option (العربية)</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="option_lang_2">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<span class="text-danger pull-left msg"></span>
				<button type="button" class="btn btn-primary btn-sm save">Save</button>
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
