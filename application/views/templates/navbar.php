<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Messages Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="fa fa-user"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<a href="<?= base_url('auth/logout') ?>" class="dropdown-item">
					<i class="fas fa-sign-out-alt text-danger"></i>
					logout
				</a>
				<a href="<?= base_url('admin/profile') ?>" class="dropdown-item">
					<i class="fas fa-user text-primary"></i>
					Profile
				</a>
			</div>
		</li>

	</ul>
</nav>
<!-- /.navbar -->