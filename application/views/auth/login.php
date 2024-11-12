<?php $this->load->view('templates/header') ?>

<div class="content">
	<div class="container">
		<div class="mt-5">
			<div class="row">
				<div class="col-12 col-md-6 text-center mt-3 mx-auto p-3">
					<img src="<?= base_url('assets/images/motomesa_logo.png') ?>" width="35%"  alt="" />
					<br>
					<h1 class="h2" style="font-size: 28px;">Selamat Datang Di Motomesa.Id</h1>
					<p class="lead">Masuk untuk mendapat akses ke sistem.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-md-5 mx-auto mt-6">
					<form action="<?= base_url('auth/login_proccess') ?>" method="post">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
									<i class="fa fa-user"></i>
								</span>
							</div>
							<input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text input-group-text-costum" id="inputGroup-sizing-default">
								  <i class="fa fa-lock"></i>
								</span>
							</div>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
							<div class="input-group-append">
								<span class="input-group-text" onclick="togglePasswordVisibility()">
								  <i class="fa fa-eye" id="togglePasswordIcon"></i>
								</span>
							</div>
						</div>
						<div class="input-group mb-3">
							<button type="submit" name="submit" value="login" class="btn btn-block btn-success">
								LOGIN
								<i class="fa fa-arrow-alt-circle-right"></i>
							</button>
						</div>
						<div class="input-group mb-3">
							<a href="<?= base_url('auth/registrasi') ?>" class="btn btn-success btn-block">
								REGISTRASI
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
							</script> - MOTOMESA.ID. All rights reserved.
						</p>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function togglePasswordVisibility() {
		const passwordInput = document.getElementById('password');
		const togglePasswordIcon = document.getElementById('togglePasswordIcon');
		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			togglePasswordIcon.classList.remove('fa-eye');
			togglePasswordIcon.classList.add('fa-eye-slash');
		} else {
			passwordInput.type = 'password';
			togglePasswordIcon.classList.remove('fa-eye-slash');
			togglePasswordIcon.classList.add('fa-eye');
		}
	}
</script>

<?php $this->load->view('templates/footer') ?>
