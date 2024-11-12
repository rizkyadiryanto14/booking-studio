<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Halaman Profile</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Halaman Profile</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<form action="<?= base_url('admin/update_profile') ?>" method="POST">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Halaman Profile <?= $this->session->userdata('nama') ?></h2>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="nama">Nama Lengkap</label>
										<input type="text" name="nama" id="nama" class="form-control"
											   value="<?= $users['nama'] ?>">
									</div>
									<div class="form-group">
										<label for="email">Email</label>
										<input type="text" name="email" id="email" class="form-control"
											   value="<?= $users['email'] ?>">
									</div>
									<div class="form-group">
										<label for="no_telepon">No.Telepon</label>
										<input type="text" name="no_telepon" id="no_telepon" class="form-control"
											   value="<?= $users['no_telepon'] ?>">
									</div>
									<div class="form-group">
										<label for="alamat">Alamat</label>
										<input type="text" name="alamat" id="alamat" class="form-control"
											   value="<?= $users['alamat'] ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary btn-block">Update Profile</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h2 class="card-title">Halaman Mengganti Password <?= $this->session->userdata('nama') ?></h2>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="nama">Password Sekarang</label>
									<input type="password" name="nama" id="nama" class="form-control">
								</div>
								<div class="form-group">
									<label for="email">Password Baru</label>
									<input type="password_baru" name="email" id="email" class="form-control">
								</div>
								<div class="form-group">
									<label for="no_telepon">Konfirmasi Password</label>
									<input type="konfirmasi_password" name="no_telepon" id="no_telepon"
										   class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary btn-block">Update Password</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>
