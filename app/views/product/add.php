<?php echo pageTitle(['Add', 'Product', 'fa fa-plus fa-lg']); ?>

<div class="row">
	<div class="col-md-6">
		<form method="post" enctype="multipart/form-data">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="pname">Name</label>
								<input type="text" name="name" class="form-control" id="pname">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="pdescription">Summary</label>
								<textarea type="text" name="description" class="form-control" id="pdescription"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="pcategory">Category</label>
								<input type="text" name="category" class="form-control" id="pcategory">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="pprice">Price</label>
								<input type="text" name="price" class="form-control" id="pprice">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="pbrand">Brand</label>
								<input type="text" name="brand" class="form-control" id="pbrand">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="pmodel">Model</label>
								<input type="text" name="model" class="form-control" id="pmodel">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="file-input-wrapper">
						<div class="file-preview"></div>
						<div class="file-placeholder"></div>
						<input type="file" name="images[]" accept="image/*" multiple>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<table class="table table-sm table-input">
						<thead>
							<tr>
								<th>Term</th>
								<th>Value</th>
							</tr>
						</thead>
						<tr>
							<th><input type="text" name="cft[]" placeholder="e.g. Type"></th>
							<td><input type="text" name="cfv[]" placeholder="e.g. New"></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-end">
						<div class="col-4">
							<a class="btn btn-light btn-block">Cancel</a>
						</div>
						<div class="col-4">
							<button class="btn btn-theme btn-block">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>