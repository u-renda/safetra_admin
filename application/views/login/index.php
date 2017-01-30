<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="K3, Keselamatan dan Kesehatan Kerja" />
		<meta name="description" content="Safetra - Training Keselamatan dan Kesehatan Kerja">
		<meta name="author" content="safetra.co.id">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css').'/bootstrap.css'; ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css').'/font-awesome.css'; ?>">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css').'/theme.css'; ?>">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css').'/default.css'; ?>">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/css').'/style.css'; ?>">

		<!-- Head Libs -->
		<script src="<?php echo base_url('assets/js').'/modernizr.js'; ?>"></script>

	</head>
	<body id="login_page">
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="<?php echo base_url(); ?>" class="logo pull-left">
					<img src="<?php echo base_url('assets/images').'/logo.png'; ?>" height="54" alt="Safetra Indonesia" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
                        <?php if (isset($error) == TRUE) { 
                        echo '<div class="well danger">'.$error.'</div>';
                        } ?>
						<form action="<?php echo $this->config->item('link_login'); ?>" method="post">
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<a href="<?php echo $this->config->item('link_forget_password'); ?>" class="pull-right">Lost Password?</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4 col-md-offset-8 text-right">
									<input type="submit" class="btn btn-primary hidden-xs" name="submit" value="Sign In" />
									<input type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" name="submit" value="Sign In" />
								</div>
							</div>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright <?php echo date('Y'); ?>. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo base_url('assets/js').'/jquery.js'; ?>"></script>
		<script src="<?php echo base_url('assets/js').'/bootstrap.js'; ?>"></script>
		<script src="<?php echo base_url('assets/js').'/nanoscroller.js'; ?>"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url('assets/js').'/theme.js'; ?>"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url('assets/js').'/app.js'; ?>"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url('assets/js').'/theme.init.js'; ?>"></script>

	</body>
</html>