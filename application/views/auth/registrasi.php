<?php $this->load->view('templates/header') ?>

<div class="content">
	<div class="container">
		<div class="mt-5">
			<div class="row">
				<div class="col-12 col-md-6 text-center mt-3 mx-auto p-3">
					<img src="<?= base_url('assets/images/motomesa_logo.png') ?>" width="35%" class="mb-4" alt="" />
					<br>
					<h1 class="h2" style="font-size: 28px;">Motomesa.id</h1>
					<p class="lead">Daftar untuk mendapat akses ke sistem.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-md-5 mx-auto mt-6">
					<form action="<?= base_url('auth/register') ?>" method="post" onsubmit="return validatePassword()">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
									<i class="fa fa-user"></i>
								</span>
							</div>
							<input type="text" name="email" class="form-control" placeholder="Masukan E-Mail" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
									<i class="fa fa-home"></i>
								</span>
							</div>
							<input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
									<i class="fa fa-home"></i>
								</span>
							</div>
							<input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
									<i class="fa fa-home"></i>
								</span>
							</div>
							<input type="text" name="no_telepon" class="form-control" placeholder="Nomor Telepon" required>
						</div>
						<!-- Kolom Password -->
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
								  <i class="fa fa-lock"></i>
								</span>
							</div>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
							<div class="input-group-append">
								<span class="input-group-text" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
								  <i class="fa fa-eye" id="togglePasswordIcon"></i>
								</span>
							</div>
						</div>
						<!-- Kolom Konfirmasi Password -->
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
								  <i class="fa fa-lock"></i>
								</span>
							</div>
							<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
							<div class="input-group-append">
								<span class="input-group-text" onclick="togglePasswordVisibility('confirm_password', 'toggleConfirmPasswordIcon')">
								  <i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
								</span>
							</div>
						</div>

						<p id="error-message" style="color:red; display:none;">Password dan Konfirmasi Password tidak sama!</p>
						<div class="input-group mb-3">
							<button type="submit" name="submit" value="login" class="btn btn-block btn-success">
								Register
								<i class="fa fa-arrow-alt-circle-right"></i>
							</button>
						</div>
						<div class="input-group mb-3">
							<a href="<?= base_url('auth/login') ?>" class="btn btn-success btn-block">
								Login
								<i class="fa fa-arrow-alt-circle-right"></i>
							</a>
						</div>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="col-12 mx-auto mt-3 mb-3">
					<span>
						<p style="vertical-align: middle;" class="text-muted text-center">Copyright &copy;
							<script>
								document.write(new Date().getFullYear());
							</script> - Motomesa.id. All rights reserved.
						</p>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

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
</script>

<?php $this->load->view('templates/footer') ?>
