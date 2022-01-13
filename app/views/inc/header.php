<!DOCTYPE html>
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
	<body class="layout-row">
		<!-- ############ Aside START-->
		<div id="aside" class="page-sidenav no-shrink bg-light nav-dropdown fade" aria-hidden="true">
			<div class="sidenav h-100 modal-dialog bg-light">
				<!-- sidenav top -->
				<div class="navbar">
					<!-- brand -->
					<a href="/" class="navbar-brand ">
						<img src="<?php echo LOGO; ?>" alt="<?php echo SITENAME; ?>" height="34">
						<!-- <img src="/assets/img/logo.png" alt="."> -->
						<span class="hidden-folded d-inline l-s-n-1x ">Seller</span>
					</a>
					<!-- / brand -->
				</div>
				<!-- Flex nav content -->
				<div class="flex scrollable hover">
					<div class="nav-active-text-primary" data-nav>
						<ul class="nav bg">
							<li class="nav-header hidden-folded">
								<span class="text-muted">Main</span>
							</li>
							<li>
								<a href="dashboard.html">
									<span class="nav-icon text-primary"><i data-feather='home'></i></span>
									<span class="nav-text">Dashboard</span>
								</a>
							</li>
							<li class="nav-header hidden-folded">
								<span class="text-muted">Applications</span>
							</li>
							<li>
								<a href="#">
									<span class="nav-icon text-success"><i data-feather="coffee"></i></span>
									<span class="nav-text">Products</span>
									<span class="nav-caret"></span>
								</a>
								<ul class="nav-sub nav-mega">
									<li>
										<a href="/product/index" class="">
											<span class="nav-text">Index</span>
										</a>
									</li>
									<li>
										<a href="/product/add" class="">
											<span class="nav-text">Add</span>
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="app.message.html">
									<span class="nav-icon text-warning"><i data-feather='message-circle'></i></span>
									<span class="nav-text">Messages</span>
									<span class="nav-badge"><b class="badge-circle xs text-warning"></b></span>
								</a>
							</li>
							<li>
								<a href="app.mail.html">
									<span class="nav-icon text-danger"><i data-feather='mail'></i></span>
									<span class="nav-text">Email</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- sidenav bottom -->
				<div class="no-shrink ">
					<div class="p-3 d-flex align-items-center">
						<div class="text-sm hidden-folded text-muted">
							Trial: 35%
						</div>
						<div class="progress mx-2 flex" style="height:4px;">
							<div class="progress-bar gd-success" style="width: 35%"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ############ Aside END-->
		<div id="main" class="layout-column flex">
			<!-- ############ Header START-->
			<div id="header" class="page-header ">
				<div class="navbar navbar-expand-lg">
					<!-- brand -->
					<a href="/" class="navbar-brand d-lg-none">
						<img src="/assets/img/agit-logo.png" alt="Al Ghaim IT" height="34">
						<!-- <img src="/assets/img/logo.png" alt="."> -->
						<span class="hidden-folded d-inline l-s-n-1x ">Seller</span>
					</a>
					<!-- / brand -->
					<!-- Navbar collapse -->
					<div class="collapse navbar-collapse order-2 order-lg-1" id="navbarToggler">
						<form class="input-group m-2 my-lg-0 ">
							<div class="input-group-prepend">
								<button type="button" class="btn no-shadow no-bg px-0 text-inherit">
									<i data-feather="search"></i>
								</button>
							</div>
							<input type="text" class="form-control no-border no-shadow no-bg typeahead" placeholder="Search components." data-plugin="typeahead" data-api="/assets/api/menu.json">
						</form>
					</div>
					<ul class="nav navbar-menu order-1 order-lg-2">
						<li class="nav-item d-none d-sm-block">
							<a class="nav-link px-2" data-toggle="fullscreen" data-plugin="fullscreen">
								<i data-feather="maximize"></i>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link px-2" data-toggle="dropdown">
								<i data-feather="settings"></i>
							</a>
							<!-- ############ Setting START-->
							<div class="dropdown-menu dropdown-menu-center mt-3 w-md animate fadeIn">
								<div class="setting px-3">
									<div class="mb-2 text-muted">
										<strong>Setting:</strong>
									</div>
									<div class="mb-3" id="settingLayout">
										<label class="ui-check ui-check-rounded my-1 d-block">
											<input type="checkbox" name="stickyHeader">
											<i></i>
											<small>Sticky header</small>
										</label>
										<label class="ui-check ui-check-rounded my-1 d-block">
											<input type="checkbox" name="stickyAside">
											<i></i>
											<small>Sticky aside</small>
										</label>
										<label class="ui-check ui-check-rounded my-1 d-block">
											<input type="checkbox" name="foldedAside">
											<i></i>
											<small>Folded Aside</small>
										</label>
										<label class="ui-check ui-check-rounded my-1 d-block">
											<input type="checkbox" name="hideAside">
											<i></i>
											<small>Hide Aside</small>
										</label>
									</div>
									<div class="mb-2 text-muted">
										<strong>Color:</strong>
									</div>
									<div class="mb-2">
										<label class="radio radio-inline ui-check ui-check-md">
											<input type="radio" name="bg" value="">
											<i></i>
										</label>
										<label class="radio radio-inline ui-check ui-check-color ui-check-md">
											<input type="radio" name="bg" value="bg-dark">
											<i class="bg-dark"></i>
										</label>
									</div>
								</div>
							</div>
							<!-- ############ Setting END-->
						</li>
						<!-- Notification -->
						<li class="nav-item dropdown">
							<a class="nav-link px-2 mr-lg-2" data-toggle="dropdown">
								<i data-feather="bell"></i>
							</a>
							<!-- dropdown -->
							<div class="dropdown-menu dropdown-menu-right mt-3 w-md animate fadeIn p-0">
								<div class="scrollable hover" style="max-height: 250px">
									<div class="list list-row">
									</div>
								</div>
								<div class="d-flex px-3 py-2 b-t">
									<div class="flex">
										<span>0 Notifications</span>
									</div>
									<a href="page.setting.html">See all
										<i class="fa fa-angle-right text-muted"></i>
									</a>
								</div>
							</div>
							<!-- / dropdown -->
						</li>
						<!-- User dropdown menu -->
						<li class="nav-item dropdown">
							<a href="#" data-toggle="dropdown" class="nav-link d-flex align-items-center px-2 text-color">
								<span class="avatar w-24" style="margin: -2px;"><img src="/assets/img/a1.jpg" alt="."></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right w mt-3 animate fadeIn">
								
								<?php
								if (isset($_SESSION['uid'])) {
								?>
								<a class="dropdown-item" href="#">
									<span><?php echo $_SESSION['un']; ?></span>
								</a>
								<a class="dropdown-item" href="#">
									<span class="badge bg-success text-uppercase">Upgrade</span>
									<span>to Pro</span>
								</a>
								<?php
								} else {
								?>
								<a class="dropdown-item" href="/login">
									<span>Login</span>
								</a>
								<a class="dropdown-item" href="/signup">
									<span>Sign Up</span>
								</a>
								<?php } ?>
								<a class="dropdown-item" href="/logout">Logout</a>
							</div>
						</li>
						<!-- Navarbar toggle btn -->
						<li class="nav-item d-lg-none">
							<a href="#" class="nav-link px-2" data-toggle="collapse" data-toggle-class data-target="#navbarToggler">
								<i data-feather="search"></i>
							</a>
						</li>
						<li class="nav-item d-lg-none">
							<a class="nav-link px-1" data-toggle="modal" data-target="#aside">
								<i data-feather="menu"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- ############ Footer END-->