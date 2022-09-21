<?php

if (!$data['data']) {
	?>
	<div class="alert alert-secondary d-flex border-dotted">
		<div class="mr-2">
			<span class="icon-stack icon-stack-3x">
				<i class="fa fa-circle fa-3x text-theme-darker"></i>
				<i class="fa fa-circle fa-2x text-theme"></i>
				<i class="fa fa-user-slash fa-lg text-light"></i>
			</span>
		</div>
		<div class="flex-fill">
			<span class="h6 text-theme-darker">Invalid arguments</span>
			<p class="text-muted">User, <i><b>Id: </b><?php echo $data['id']; ?></i>, does not exists</p>
		</div>
	</div>
	<?php
	exit;
}

?>
<div class="row mb-4">
	<div class="col-lg-8">
		<div class="card shadow h-100">
			<form method="post" enctype="multipart/form-data" class="silent">
				<div class="card-body profile">
					<div class="card-tags"></div>
					<div class="row">

						<div class="col-md-3">
							<?php
							$dp = DATA . '/seller/' . $data['data']->id . '.jpg';
							if(file_exists(DATADIR . DS . 'operator' . DS . $data['data']->id . '.jpg')) {
								echo '<span class="profile-image d-inline-block rounded-circle shadow"><img src="' . $dp . '" style="height: 100px; width: 100px"></span>';
							} else {
								echo '<span class="d-inline-flex align-items-center justify-content-center bg-theme text-light display-4 rounded-circle shadow m-0 pb-2" style="height: 100px; width: 100px">'
								. substr($data['data']->s_first_name, 0, 1) . '</span>';
							}
							?>
						</div>

						<div class="col-md-9">
							<div class="h3">
								<?php
								echo $data['data']->s_first_name . ' ' . $data['data']->s_last_name;
								?>
								<span class="text-muted">#<?php echo $data['data']->id; ?></span>
								<a href="/user/profile&edit" class="btn btn-icon text-muted" data-toggle="load-host" data-target="#content"><i class="fa fa-pen"></i></a>
							</div>
							<div><a href="mailto:<?php echo $data['data']->s_email; ?>"><?php echo $data['data']->s_email; ?></a></div>
						</div>

					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card shadow h-100">
			<div class="card-body">
				<div class="row">
					<div class="col d-inline-flex lead align-items-center">Google Account</div>
					<div class="col d-inline-flex lead justify-content-end align-items-center">
						<img src="/dopamine/images/illustration/google-g.png" height="20">
						<img src="/dopamine/images/illustration/google-mail.png" height="24" class="ml-2">
						<img src="/dopamine/images/illustration/google-drive.png" height="24" class="ml-2">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">

	<?php if ($data['data']->id == $data['uid']) : ?>

		<div class="col-lg-5">
			<div class="card shadow">
				<div class="card-lock" onclick="$(this).remove()"></div>
				<div class="card-body">

					<span class="icon-stack icon-stack-3x float-right">
						<i class="fa fa-circle fa-3x text-theme"></i>
						<i class="fa fa-sync-alt fa-3x text-theme-darker"></i>
						<i class="fa fa-lock fa-1x text-light"></i>
					</span>
					<div class="display-4 mb-4">Change Password</div>

					<form method="post" action="/user/profile/change-password" class="silent">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="new-password">New Password</label>
									<input type="password" name="new_password" id="new-password" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="confirm-password">Confirm Password</label>
									<input type="password" name="confirm_password" id="confirm-password" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="old-password">Old Password</label>
									<input type="password" name="old_password" id="old-password" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
							</div>
							<div class="col-md-12">
								<label class="checkbox"><input type="checkbox" class="show-password"><span> Show password</span></label>
								<button type="submit" class="btn btn-theme float-right">Change password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	<?php endif; ?>

	<div class="col-lg-7">
		<div class="card shadow">
			<div class="card-body">
				<span class="icon-stack icon-stack-3x float-right">
					<i class="fa fa-circle fa-3x text-theme-dark"></i>
					<i class="fa fa-circle fa-2x text-theme"></i>
					<i class="far fa-user fa-lg text-light"></i>
				</span>
				<div class="display-4">Pesonalize</div>
				<span class="lead">Lorem ipsum</span>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">

	$('.show-password').change(function() {
		if ($(this).is(':checked')) {
			$('#new-password, #confirm-password').attr('type', 'text');
		} else {
			$('#new-password, #confirm-password').attr('type', 'password');
		}
	});

</script>