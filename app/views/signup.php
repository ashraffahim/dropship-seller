<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Signup | Basik - Bootstrap 4 Web Application</title>
		<meta name="description" content="Responsive, Bootstrap, BS4" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!-- style -->
		<!-- build:css /assets/css/site.min.css -->
		<link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="/assets/css/theme.css" type="text/css" />
		<link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
		<!-- endbuild -->
	</head>
	<body class="layout-row">
		<div class="d-flex flex-column flex">
			<div class="row no-gutters h-100">
				<div class="col-md-6 bg-primary" style="">
					<div class="p-3 p-md-5 d-flex flex-column h-100">
						<h4 class="mb-3 text-white">Basik</h4>
						<div class="text-fade">Bootstrap 4 Web Application</div>
						<div class="d-flex flex align-items-center justify-content-center">
						</div>
						<div class="d-flex text-sm text-fade">
							<a href="index.html" class="text-white">About</a>
							<span class="flex"></span>
							<a href="#" class="text-white mx-1">Terms</a>
							<a href="#" class="text-white mx-1">Policy</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div id="content-body">
						<div class="p-3 p-md-5">
							<h5>Welcome to Basik</h5>
							<p>
								<small class="text-muted">Sign up with your social network</small>
							</p>
							<div class="">
								<form method="post">
									<!-- Sign up with socual network -->
									<div>
										<a href="#" class="btn btn-outline-primary btn-block btn-rounded mb-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 264 512">
												<path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229" class=""></path>
											</svg>
											<span>
												 Facebook
											</span>
										</a>
										<a href="#" class="btn btn-outline-dark btn-block btn-rounded">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 640 512">
												<path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" class=""></path>
											</svg>
											<span>
												 Google
											</span>
										</a>
									</div>
									<!-- End sign up with social network -->
									<div class="my-3 text-muted text-sm text-muted">
										OR
									</div>
									<?php
									if (!$data['verify']) :
									?>
									<!-- Sign up information -->
									<div class="row">
										<div class="col-md-6">
											<div class="md-form-group float-label">
												<input type="text" name="first_name" class="md-input" id="signupFirstName" required value>
												<label for="signupFirstName">First Name</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="md-form-group float-label">
												<input type="text" name="last_name" class="md-input" id="signupLastName" required value>
												<label for="signupLastName">Last Name</label>
											</div>
										</div>
									</div>
									<div class="md-form-group float-label">
										<input type="email" name="email" class="md-input" id="signupEmail" required value>
										<label for="signupEmail">Email</label>
									</div>
									<div class="md-form-group float-label">
										<input type="text" name="password" class="md-input" id="signupPassword" required value>
										<label for="signupPassword">Password</label>
									</div>
									<div class="row">
										<div class="col-6">
											<div class="md-form-group float-label">
												<select name="country" class="md-input" id="signupCountry" required>
													<option disabled selected></option>
													<?php
													foreach ($data['country'] as $c => $n) {
														echo '<option value="' . $c . '">' . $n[0] . ' - ' . $n[1] . ' - ' . $n[2] . ' - ' . $n[3] . '</option>';
													}
													?>
												</select>
												<label for="signupCountry">Country</label>
											</div>
										</div>
										<div class="col-6 d-flex">
											<div class="md-form-group">
												<div class="md-input-prepend">+971</div>
											</div>
											<div class="md-form-group float-label flex">
												<input type="text" name="phone" class="md-input" id="signupPhone" required value>
												<label for="signupPhone">Phone</label>
											</div>
										</div>
									</div>
									<div class="mb-3 text-sm">
										<span class="text-muted">By clicking Sign Up, I agree to the</span>
										<a href="#">Terms of service</a>
									</div>
									<!-- End signup information -->
									<?php
									else :
									?>
									<!-- Sign up information -->
									<?php
									if (isset($data['status']['alrt'])) :
									?>
									<div class="alert alert-<?php echo $data['status']['alrt']['t']; ?>" role="alert">
										<?php echo $data['status']['alrt']['b']; ?>
									</div>
									<?php
									endif;
									?>
									<div class="md-form-group float-label">
										<input type="text" name="vcode" class="md-input" id="signupVcode" required value>
										<label for="signupVcode">Verificaion Code</label>
									</div>
									<!-- End signup information -->
									<?php
									endif;
									?>
									<a href="/signup/clear" class="btn btn-md mb-4">Clear</a>
									<button type="submit" class="btn btn-wave btn-md gd-primary text-white mb-4 ml-3">Sign Up</button>
									<div>Already have an account?
										<a href="/login" class="text-primary _600">Login</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- build:js /assets/js/site.min.js -->
		<!-- jQuery -->
		<script src="/libs/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="/libs/popper.js/dist/umd/popper.min.js"></script>
		<script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- ajax page -->
		<script src="/libs/pjax/pjax.min.js"></script>
		<script src="/assets/js/ajax.js"></script>
		<!-- lazyload plugin -->
		<script src="/assets/js/lazyload.config.js"></script>
		<script src="/assets/js/lazyload.js"></script>
		<script src="/assets/js/plugin.js"></script>
		<!-- scrollreveal -->
		<script src="/libs/scrollreveal/dist/scrollreveal.min.js"></script>
		<!-- feathericon -->
		<script src="/libs/feather-icons/dist/feather.min.js"></script>
		<script src="/assets/js/plugins/feathericon.js"></script>
		<!-- theme -->
		<script src="/assets/js/theme.js"></script>
		<script src="/assets/js/utils.js"></script>
		<!-- endbuild -->
	</body>
</html>