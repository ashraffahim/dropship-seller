<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Blank | Basik - Bootstrap 4 Web Application</title>
		<meta name="description" content="Responsive, Bootstrap, BS4" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!-- style -->
		<!-- build:css /assets/css/site.min.css -->
		<link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="/assets/css/theme.css" type="text/css" />
		<link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
		<!-- endbuild -->
		<link rel="manifest" href="/manifest.json">
	</head>
<body>

	<!-- Header start -->
	<header>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h1><?php echo $data['data'][0]->restaurant; ?></h1>
					<h3><?php echo $data['data'][0]->title; ?></h3>
					<h6><?php echo $data['data'][0]->description; ?></h6>
				</div>
			</div>
		</div>
	</header>
	<!-- Header end -->

	<!-- Main content start -->
	<main class="layout-column flex">
		<div class="container-fluid">
			<div class="row">
				<?php
				foreach ($data['data'][1] as $i => $p) {
					$img = glob(DATADIR.DS.'product'.DS.$p->id.DS.'*');
					$img = DATA.DS.'product'.DS.$p->id.DS.basename($img[0]);
				?>
					<div class="col-12 col-sm-4 col-md-3 col-lg-2">
						<div class="card shadow-0">
							<img src="<?php echo $img; ?>" alt="<?php echo $p->p_name; ?>" class="card-img-top rounded">
							<div class="card-body">
								<h6><?php echo $p->p_name; ?></h6>
								<small><?php echo $p->p_description; ?></small>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</main>
	<!-- Main content end -->
	
	<!-- ############ Footer START-->
	<footer class="page-footer">
	<div class="d-flex p-3">
		<span class="text-sm text-muted flex">&copy; Copyright. Pandora</span>
		<div class="text-sm text-muted">Version 1.0</div>
	</footer>
	<!-- ############ Footer END-->
	
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