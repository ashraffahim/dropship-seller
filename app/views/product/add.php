<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-body">
					<form id="productForm" method="post" enctype="multipart/form-data">
						<div id="wizard">
							<ul class="nav mb-3">
								<li class="nav-item">
									<a class="nav-link text-center active" href="#tab1" data-toggle="tab">
										<span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">1</span>
										<div class="mt-2">
											<div class="text-muted">Basic Info</div>
										</div>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-center" href="#tab2" data-toggle="tab">
										<span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">2</span>
										<div class="mt-2">
											<div class="text-muted">Media</div>
										</div>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-center" href="#tab3" data-toggle="tab">
										<span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-primary">3</span>
										<div class="mt-2">
											<div class="text-muted">Specifications</div>
										</div>
									</a>
								</li>
							</ul>
							<div class="tab-content p-3">

								<!-- Basic Info -->

								<div class="tab-pane active" id="tab1">
									<div class="md-form-group float-label" id="productName">
										<input type="text" name="name" class="md-input" maxlength="100" required>
										<label for="productName">Name <code>*</code></label>
									</div>
									<div class="md-form-group float-label" id="productHandle">
										<input type="text" name="handle" class="md-input" maxlength="50" required>
										<label for="productHandle">Handle <code>*</code></label>
									</div>
									<div class="md-form-group float-label" id="productCategory">
										<input type="text" name="category" class="md-input" maxlength="50" required>
										<label for="productCategory">Category <code>*</code></label>
									</div>
									<div class="md-form-group float-label" id="productBrand">
										<input type="text" name="brand" class="md-input" maxlength="50">
										<label for="productBrand">Brand</label>
									</div>
									<div class="md-form-group float-label" id="productModel">
										<input type="text" name="model" class="md-input" maxlength="50">
										<label for="productModel">Model</label>
									</div>
									<div class="md-form-group float-label" id="productDescription">
										<textarea name="description" class="md-input"></textarea>
										<label for="productDescription">Description</label>
									</div>
									<div class="md-form-group float-label" id="productPrice">
										<input type="text" name="price" class="md-input" required>
										<label for="productPrice">Price <code>*</code></label>
									</div>
									<div id="categorySpec"></div>
									<div class="md-form-group">
										<label class="md-check">
											<input type="checkbox" name="status" checked>
											<i class="blue"></i>
											 Launch immediately
										</label>
									</div>
									<div class="md-form-group">
										By continuing you agree to the <a href="#" class="text-info">Terms of Service</a>
									</div>
								</div>


								<!-- Photo upload -->

								<div class="tab-pane" id="tab2">
									
									<div class="row mb-3 position-relative" data-plugin="product" data-option="{}">
										<div class="col-12 d-flex text-muted dropzone" style="border: 2px dashed #eee;">
											<div class="py-3 w-100">
												<div class="row justify-content-center vsp">
													<div class="col-12">
														<div class="row align-items-center justify-content-center" style="min-height: 100px;">
															<i data-feather="image"></i> <span class="ml-1 dropzone-placeholder">Select / Drag & Drop</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<input type="file" name="photos[]" class="form-control position-absolute h-100 w-100 select-file" style="opacity: 0;" onchange="previewMultipleInputImages(this, '.vsp')" accept="image/*" multiple required>
									</div>
								</div>

								<!-- Custom Fields -->

								<div class="tab-pane" id="tab3">
									<div class="row">
										<div class="col-12">
											<table class="table table-theme table-sm custom-field-table">
												<tr>
													<td class="pl-3">Terms</th>
													<td class="pl-3">Description</th>
													<td></th>
												</tr>
												<tr>
													<td>
														<input type="text" name="custom_field[]" class="form-control form-control-xs border-0" placeholder="Field">
													</td>
													<td>
														<input type="text" name="custom_value[]" class="form-control form-control-xs border-0" placeholder="Value">
													</td>
													<td style="width: 36px">
														<a class="btn btn-icon btn-xs bg-danger-lt btn-wave rounded-circle border-0 tr-h-v remove-custom-field">
															<i data-feather="x" height="12" width="12"></i>
														</a>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col-12"><br></div>
									</div>
									<div class="row">
										<div class="col-12">
											<a class="btn btn-light btn-wave btn-block btn-sm add-custom-field">
												<i data-feather="plus"></i> Add field
											</a>
										</div>
									</div>
								</div>

								<div class="row py-3 justify-content-end">
									<div class="col-md-4">
										<a href="#" class="btn btn-block btn-wave justify-content-between button-prev">
											<i data-feather="arrow-left"></i><span>Back</span><div></div>
										</a>
									</div>
									<div class="col-md-4">
										<a href="#" class="btn btn-primary btn-wave btn-block justify-content-between button-next">
											<div></div><span>Next</span><i data-feather="arrow-right" class="float-right"></i>
										</a>
										<button type="submit" class="btn btn-primary btn-wave btn-block mt-0 justify-content-between button-submit" style="display: none;">
											<div></div><span>Finish</span><i data-feather="check" class="float-right"></i>
										</button>
									</div>
								</div>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>