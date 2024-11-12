<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Detail Studio: <?= $studio['nama'] ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Studio</li>
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
						<div class="card-title">Detail Studio: <?= $studio['nama'] ?></div>
					</div>
					<div class="card-body">
						<!-- Menampilkan Detail Studio -->
						<div class="row">
							<div class="col-md-4">
								<!-- Menampilkan Gambar Studio -->
								<img src="<?= base_url('uploads/foto_studio/' . $studio['foto_studio']) ?>"
									 class="img-fluid" alt="<?= $studio['nama'] ?>" style="width:100%; height:auto;">
							</div>
							<div class="col-md-8">
								<!-- Menampilkan Informasi Studio -->
								<h3><?= $studio['nama'] ?></h3>
								<p>Jenis: <?= $studio['jenis_studio'] ?></p>
								<p>Harga per Jam: Rp. <?= number_format($studio['harga_per_jam'], 0, ',', '.') ?></p>
							</div>
						</div>

						<hr>

						<h4>Slot Waktu Tersedia</h4>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>Waktu</th>
									<th>Status</th>
								</tr>
								</thead>
								<tbody>
								<?php if (!empty($slots)): ?>
									<?php foreach ($slots as $slot): ?>
										<tr>
											<td><?= $slot['time'] ?></td>
											<td>
												<?php if ($slot['is_booked']): ?>
													<button class="btn btn-danger" disabled>Sudah Dipesan</button>
												<?php else: ?>
													<a href="javascript:void(0);"
													   onclick="confirmBooking('<?= site_url('booking/pesan_slot/' . $studio['id_studio'] . '/' . urlencode($slot['time'])) ?>')"
													   class="btn btn-success">Pesan Sekarang</a>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="2">Tidak ada slot waktu yang tersedia saat ini.</td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>

<!-- SweetAlert Konfirmasi Pemesanan -->
<script>
	function confirmBooking(url) {
		Swal.fire({
			title: 'Konfirmasi Pemesanan',
			text: "Apakah Anda yakin ingin memesan slot ini?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, pesan sekarang!'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = url;
			}
		})
	}
</script>
