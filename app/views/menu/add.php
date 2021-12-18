<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
			<div class="card">
				<div class="card-body">
					<form method="post" id="menuForm" data-plugin="parsley" data-option="{}">
						<div id="rootwizard" data-plugin="bootstrapWizard" data-option="{
tabClass: '',
nextSelector: '.button-next', 
previousSelector: '.button-previous', 
onTabClick: function(tab, navigation, index) {
return false;
},
onNext: function(tab, navigation, index, n) {
var instance = $('#menuForm').parsley();
instance.validate();
if(!instance.isValid()) {
return false;
}
},
onTabChange: function() {
if($('#tab3:visible').length) {
$('.button-next').hide();
$('.button-submit').show();
} else {
$('.button-next').show();
$('.button-submit').hide();
}
}
}">
							<ul class="nav mb-3">
								<li class="nav-item">
									<a class="nav-link text-center" href="#tab1" data-toggle="tab">
										<span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-success">1</span>
										<div class="mt-2">
											<div class="text-muted">Basic Info</div>
										</div>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-center" href="#tab2" data-toggle="tab">
										<span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-success">2</span>
										<div class="mt-2">
											<div class="text-muted">Theme</div>
										</div>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-center" href="#tab3" data-toggle="tab">
										<span class="w-32 d-inline-flex align-items-center justify-content-center circle bg-light active-bg-success">3</span>
										<div class="mt-2">
											<div class="text-muted">Review & Finish</div>
										</div>
									</a>
								</li>
							</ul>

							<!-- Front Page -->

							<div class="tab-content p-3">
								<div class="tab-pane active" id="tab1">
									<div class="md-form-group float-label" id="menuTitle">
										<input type="text" name="title" class="md-input" required value>
										<label for="menuTitle">Title</label>
									</div>
									<div class="md-form-group float-label" id="menuDescription">
										<textarea type="text" name="description" class="md-input" required value></textarea>
										<label for="menuDescription">Description</label>
									</div>
									<div class="md-form-group">
										<label class="md-check">
											<input type="checkbox" name="status" checked>
											<i class="blue"></i>
											 Active Menu
										</label>
									</div>
									<div class="md-form-group">
										By continuing you are agreeing to the <a href="#" class="text-info">Terms of Service</a>
									</div>
								</div>

								<!-- Page appeareance / Theme / Colour -->

								<div class="tab-pane" id="tab2">
									<div class="form-row">
									</div>
								</div>

								<!-- Review menu -->
								<div class="tab-pane" id="tab3">
									<div class="form-group">
										<p>
											<strong>Congratulations</strong>
										</p>
										<p>In lacinia velit sit imperdiet maecenas cursus nunc ut risus pulvinar tellus auctor nisl imperdiet natoque blandit porttitor sed consectetur purus neque odio sit sodales sem tempor, lacus mauris
											quis lectus sit duis netus venenatis sodales nisi, ac ut ut justo blandit euismod duis malesuada ac consectetur pellentesque rhoncus amet</p>
									</div>
								</div>

								<div class="row py-3 justify-content-end">
									<div class="col-md-2">
										<a href="#" class="btn btn-block btn-wave justify-content-between button-previous">
											<i data-feather="arrow-left"></i><span>Back</span><div></div>
										</a>
									</div>
									<div class="col-md-2">
										<a href="#" class="btn btn-primary btn-wave btn-block justify-content-between button-next">
											<div></div><span>Next</span><i data-feather="arrow-right" class="float-right"></i>
										</a>
										<button type="submit" class="btn btn-primary btn-wave btn-block justify-content-between button-submit" style="display: none;">
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