<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<button class="btn btn-primary" data-toggle="modal" data-target="#tambahusers">
								Tambah Users
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="users_data" class="table table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Email</th>
										<th>No. Telepon</th>
										<th>Alamat</th>
										<th>Role</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="tambahusers">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">
					Form Tambah Users
				</div>
			</div>
			<form action="<?= base_url('admin/users/insert') ?>" method="post" onsubmit="return validatePassword()">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" name="nama" id="nama" class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="no_telepon">No.Telepon</label>
						<input type="number" name="no_telepon" id="no_telepon" class="form-control">
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control">
					</div>
					<div class="form-group">
						<label for="role">Role</label>
						<select name="role" id="role" class="form-control">
							<option selected disabled> Pilih Role</option>
							<option value="1">Admin</option>
							<option value="2">Users</option>
						</select>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<div style="position: relative;">
							<input type="password" name="password" id="password" class="form-control" style="padding-right: 30px;">
							<span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
								<i class="fa fa-eye" id="togglePasswordIcon"></i>
							</span>
						</div>
					</div>
					<p id="error-message" style="color:red; display:none;">Password dan Konfirmasi Password tidak
						sama!</p>
					<div class="form-group">
						<label for="confirm_password">Konfirmasi Password</label>
						<div style="position: relative;">
							<input type="password" name="confirm_password" id="confirm_password" class="form-control" style="padding-right: 30px;">
							<span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePasswordVisibility('confirm_password', 'toggleConfirmPasswordIcon')">
								<i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editUsersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Users Studio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Form untuk mengedit data jadwal -->
				<form id="editJadwalForm" method="post" action="<?php echo site_url('admin/jadwal/update_jadwal'); ?>">
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" name="nama" id="nama" class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="no_telepon">No.Telepon</label>
						<input type="number" name="no_telepon" id="no_telepon" class="form-control">
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control">
					</div>
					<div class="form-group">
						<label for="role">Role</label>
						<select name="role" id="role" class="form-control">
							<option selected disabled> Pilih Role</option>
							<option value="1">Admin</option>
							<option value="2">Users</option>
						</select>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<div style="position: relative;">
							<input type="password" name="password" id="password" class="form-control" style="padding-right: 30px;">
							<span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
								<i class="fa fa-eye" id="togglePasswordIcon"></i>
							</span>
						</div>
					</div>
					<p id="error-message" style="color:red; display:none;">Password dan Konfirmasi Password tidak
						sama!</p>
					<div class="form-group">
						<label for="confirm_password">Konfirmasi Password</label>
						<div style="position: relative;">
							<input type="password" name="confirm_password" id="confirm_password" class="form-control" style="padding-right: 30px;">
							<span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePasswordVisibility('confirm_password', 'toggleConfirmPasswordIcon')">
								<i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
							</span>
						</div>
						<!-- Hidden Field untuk ID Jadwal -->
						<input type="hidden" id="edit_id_pengguna" name="id_pengguna">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<!-- Tombol submit diubah dari button biasa menjadi submit button -->
				<button type="submit" form="editJadwalForm" class="btn btn-primary">Simpan Perubahan</button>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
	function togglePasswordVisibility(inputId, iconId) {
		const passwordInput = document.getElementById(inputId);
		const toggleIcon = document.getElementById(iconId);
		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			toggleIcon.classList.remove('fa-eye');
			toggleIcon.classList.add('fa-eye-slash');
		} else {
			passwordInput.type = 'password';
			toggleIcon.classList.remove('fa-eye-slash');
			toggleIcon.classList.add('fa-eye');
		}
	}

	function validatePassword() {
		const password = document.getElementById('password').value;
		const confirmPassword = document.getElementById('confirm_password').value;
		const errorMessage = document.getElementById('error-message');

		if (password !== confirmPassword) {
			errorMessage.style.display = 'block';
			return false;
		}
		errorMessage.style.display = 'none';
		return true;
	}

	$(document).ready(function() {
		var dataTable = $('#users_data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo site_url('admin/users/get_data_users'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 5, 6],
				"orderable": false,
			}],
		});

		$(document).on('click', '.btn-edit', function() {
			var id_pengguna = $(this).data('id');

			// Lakukan AJAX request untuk mengambil data user berdasarkan ID
			$.ajax({
				url: "<?php echo site_url('admin/users/get_pengguna_by_id'); ?>", // Sesuaikan dengan URL yang digunakan
				method: "POST",
				data: {
					id_pengguna: id_pengguna
				},
				dataType: "json",
				success: function(data) {
					// Isi modal dengan data user yang diterima dari server
					$('#editUsersModal [name=id_pengguna]').val(data.id_pengguna);
					$('#editUsersModal [name=nama]').val(data.nama);
					$('#editUsersModal [name=email]').val(data.email);
					$('#editUsersModal [name=no_telepon]').val(data.no_telepon);
					$('#editUsersModal [name=alamat]').val(data.alamat);
					$('#editUsersModal [name=role]').val(data.role);

					// Tampilkan modal edit
					$('#editUsersModal').modal('show');
				},
				error: function(xhr, status, error) {
					console.error("Gagal mengambil data:", error);
				}
			});
		});

	});
</script>
<?php $this->load->view('templates/footer') ?>