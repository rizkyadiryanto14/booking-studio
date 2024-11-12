<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Jadwal Studio</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Jadwal Studio</li>
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
						<a href="#" data-toggle="modal" data-target="#tambahjadwal" class="btn btn-primary">
							<i class="fas fa-plus"></i>
							Tambah Jadwal
						</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="jadwal_data" class="table table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Studio</th>
										<th>Jenis</th>
										<th>Harga</th>
										<th>Status</th>
										<th>Jadwal</th>
										<th>Foto Studio</th>
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

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="tambahjadwal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">
					Form Tambah Jadwal
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/jadwal/insert') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="id_studio">Pilih Studio</label>
						<select name="id_studio" id="id_studio" class="form-control" required>
							<option selected disabled>-- Pilih Studio --</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tanggal_jadwal">Tanggal</label>
						<input type="date" name="tanggal_jadwal" id="tanggal_jadwal" class="form-control">
					</div>
					<div class="form-group">
						<label for="waktu_mulai">Waktu Mulai</label>
						<input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control">
					</div>
					<div class="form-group">
						<label for="waktu_selesai">Waktu Selesai</label>
						<input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control">
					</div>
					<div class="form-group">
						<label for="status_ketersediaan">Status Ketersediaan</label>
						<select name="status_ketersediaan" id="status_ketersediaan" class="form-control">
							<option selected disabled>Pilih Opsi</option>
							<option value="tersedia">Tersedia</option>
							<option value="terpakai">Terpakai</option>
						</select>
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

<!-- Modal Edit Jadwal Studio -->
<div class="modal fade" id="editJadwalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Jadwal Studio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Form untuk mengedit data jadwal -->
				<form id="editJadwalForm" method="post" action="<?php echo site_url('admin/jadwal/update_jadwal'); ?>">
					<div class="form-group">
						<label for="edit_id_studio">Pilih Studio</label>
						<select name="id_studio" id="edit_id_studio" class="form-control" required>
							<option selected disabled>-- Pilih Studio --</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tanggal_jadwal">Tanggal</label>
						<input type="date" name="tanggal_jadwal" id="tanggal_jadwal" class="form-control">
					</div>
					<div class="form-group">
						<label for="waktu_mulai">Waktu Mulai</label>
						<input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control">
					</div>
					<div class="form-group">
						<label for="waktu_selesai">Waktu Selesai</label>
						<input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control">
					</div>
					<div class="form-group">
						<label for="status_ketersediaan">Status Ketersediaan</label>
						<select name="status_ketersediaan" id="status_ketersediaan" class="form-control">
							<option selected disabled>Pilih Opsi</option>
							<option value="tersedia">Tersedia</option>
							<option value="terpakai">Terpakai</option>
						</select>
					</div>
					<!-- Hidden Field untuk ID Jadwal -->
					<input type="hidden" id="edit_id_jadwal" name="id_jadwal">
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
	$(document).ready(function() {
		// Inisialisasi DataTables
		var dataTable = $('#jadwal_data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo site_url('admin/get_data_jadwal'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 5, 6],
				"orderable": false,
			}],
		});

		$('#tambahjadwal').on('shown.bs.modal', function() {
			$.ajax({
				url: "<?php echo base_url('admin/api/jadwal'); ?>",
				method: 'GET',
				dataType: 'json',
				success: function(response) {
					var $selectStudio = $('#id_studio');
					$selectStudio.empty();
					$selectStudio.append('<option selected disabled>-- Pilih Studio --</option>');
					response.forEach(function(studio) {
						var $option = $('<option>', {
							value: studio.id_studio,
							text: studio.nama
						});
						$selectStudio.append($option);
					});
				},
				error: function(xhr, status, error) {
					console.error('Gagal mengambil data studio:', status, error);
				}
			});
		});

		$(document).on('click', '.update', function() {
			var id_jadwal = $(this).data('id');

			$.ajax({
				url: "<?php echo base_url('admin/api/jadwal'); ?>",
				method: 'GET',
				dataType: 'json',
				success: function(response) {
					var $selectStudio = $('#edit_id_studio');
					$selectStudio.empty();
					$selectStudio.append('<option selected disabled>-- Pilih Studio --</option>');
					response.forEach(function(studio) {
						var $option = $('<option>', {
							value: studio.id_studio,
							text: studio.nama
						});
						$selectStudio.append($option);
					});

					$.ajax({
						url: "<?php echo site_url('admin/jadwal/get_jadwal_by_id'); ?>", // URL untuk mendapatkan jadwal berdasarkan ID
						method: "POST",
						data: {
							id_jadwal: id_jadwal
						},
						dataType: "json",
						success: function(data) {
							$('#edit_id_studio').val(data.id_studio);
							$('#tanggal_jadwal').val(data.tanggal_jadwal);
							$('#waktu_mulai').val(data.waktu_mulai);
							$('#waktu_selesai').val(data.waktu_selesai);
							$('#status_ketersediaan').val(data.status_ketersediaan);

							$('#edit_id_jadwal').val(data.id_jadwal);

							$('#editJadwalModal').modal('show');
						},
						error: function(xhr, status, error) {
							console.error("Gagal mengambil data:", status, error);
						}
					});
				},
				error: function(xhr, status, error) {
					console.error('Gagal mengambil data studio:', status, error);
				}
			});
		});
	});
</script>


<?php $this->load->view('templates/footer') ?>