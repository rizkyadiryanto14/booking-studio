<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Tambah Studio</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Tambah Studio</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="row">
			<div class="col-md-8">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Form Tambah Studio</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<!-- Pastikan file upload berada di dalam form yang sama -->
					<form id="formTambahStudio" enctype="multipart/form-data">
						<div class="card-body">
							<div class="form-group">
								<label for="nama">Nama Studio</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Studio" required>
							</div>
							<div class="form-group">
								<label for="jenis_studio">Jenis Studio</label>
								<input type="text" class="form-control" id="jenis_studio" name="jenis_studio" placeholder="Masukkan Jenis Studio" required>
							</div>
							<div class="form-group">
								<label for="harga_per_jam">Harga per Jam</label>
								<input type="number" class="form-control" id="harga_per_jam" name="harga_per_jam" placeholder="Masukkan Harga per Jam" required>
							</div>
							<div class="form-group">
								<label for="ketersediaan">Ketersediaan</label>
								<select class="form-control" id="ketersediaan" name="ketersediaan" required>
									<option value="tersedia">Tersedia</option>
									<option value="tidak tersedia">Tidak Tersedia</option>
								</select>
							</div>
							<div class="form-group">
								<label for="foto_studio">Foto Studio</label>
								<input type="file" class="form-control-file" id="foto_studio" name="foto_studio" accept="image/*" onchange="previewImage(event)" required>
							</div>
							<div class="form-group">
								<img id="preview" src="#" alt="Preview Foto Studio" style="max-width: 100%; height: auto; display: none;" />
							</div>
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<a href="<?= base_url('admin/studio') ?>" class="btn btn-success">Kembali</a>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Loading Animation -->
<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); z-index: 9999;">
	<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;">
		<i class="fas fa-spinner fa-spin fa-3x"></i>
		<h3>Loading...</h3>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
	function previewImage(event) {
		var reader = new FileReader();
		reader.onload = function(){
			var output = document.getElementById('preview');
			output.src = reader.result;
			output.style.display = 'block';
		}
		reader.readAsDataURL(event.target.files[0]);
	}

	$(document).ready(function() {
		$('#formTambahStudio').on('submit', function(e) {
			e.preventDefault();

			var formData = new FormData(this);

			$('#loadingOverlay').show();

			$.ajax({
				url: "<?= base_url('admin/studio/insert') ?>",
				method: "POST",
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					$('#loadingOverlay').hide();
					var result = JSON.parse(response);

					if (result.status === 'success') {
						Swal.fire({
							title: 'Success!',
							text: result.message,
							icon: 'success',
							confirmButtonText: 'OK'
						}).then(() => {
							window.location.href = "<?= base_url('admin/studio') ?>";
						});
					} else {
						Swal.fire({
							title: 'Error!',
							text: result.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				},
				error: function() {
					$('#loadingOverlay').hide();
					alert('Terjadi kesalahan saat menambahkan data!');
				}
			});
		});
	});
</script>

<?php $this->load->view('templates/footer') ?>
