<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="#" class="brand-link">
		<img src="<?= base_url() ?>assets/images/motomesa_logo.png" alt="AdminLTE Logo"
			 class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
		<span class="brand-text font-weight-light">Motomesa.id</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
					 alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= $this->session->userdata('nama') ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<!-- Dashboard - Accessible by both Admin and User -->
				<li class="nav-item">
					<a href="<?= base_url('dashboard') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt text-primary"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>

				<!-- Sidebar for Admin (role 1) -->
				<?php if ($this->session->userdata('role') == 1): ?>

					<!-- Master Data Section -->
					<li class="nav-header">Master Data</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/studio') ?>" class="nav-link">
							<i class="nav-icon fas fa-microphone-alt text-teal"></i>
							<p>
								Studio
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/jadwal_studio') ?>" class="nav-link">
							<i class="nav-icon fas fa-calendar-alt text-danger"></i>
							<p>
								Jadwal
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/users') ?>" class="nav-link">
							<i class="nav-icon fas fa-users text-navy"></i>
							<p>
								Users
							</p>
						</a>
					</li>

					<!-- Reports Section -->
					<li class="nav-header">Reports</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/laporan_pemesanan') ?>" class="nav-link">
							<i class="nav-icon fas fa-file-alt text-success"></i>
							<p>
								Laporan Pemesanan
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/laporan_pembayaran') ?>" class="nav-link">
							<i class="nav-icon fas fa-credit-card text-warning"></i>
							<p>
								Laporan Pembayaran
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/statistik_pendapatan') ?>" class="nav-link">
							<i class="nav-icon fas fa-chart-pie text-info"></i>
							<p>
								Statistik Pendapatan
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin/studio_terpopuler') ?>" class="nav-link">
							<i class="nav-icon fas fa-star text-yellow"></i>
							<p>
								Studio Terpopuler
							</p>
						</a>
					</li>

					<!-- Sidebar for User (role 2) -->
				<?php elseif ($this->session->userdata('role') == 2): ?>

					<!-- User-Specific Features -->
					<li class="nav-header">My Booking</li>
					<li class="nav-item">
						<a href="<?= base_url('users/pemesanan') ?>" class="nav-link">
							<i class="nav-icon fas fa-history text-info"></i>
							<p>
								Riwayat Pemesanan
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('users/studio_tersedia') ?>" class="nav-link">
							<i class="nav-icon fas fa-calendar-check text-success"></i>
							<p>
								Ketersediaan Studio
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('user/pembayaran_saya') ?>" class="nav-link">
							<i class="nav-icon fas fa-credit-card text-warning"></i>
							<p>
								Pembayaran Saya
							</p>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
