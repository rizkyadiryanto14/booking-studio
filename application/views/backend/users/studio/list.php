<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Studio</h1>
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
		<div class="container-fluid">
			<div class="row">
				<!-- Tampilkan Studio Yang Tersedia dalam Grid -->
				<?php if (!empty($list_studio)): ?>
					<?php foreach ($list_studio as $studio): ?>
						<?php if ($studio->status_ketersediaan === 'tersedia'): ?>
							<div class="col-md-4">
								<div class="card">
									<!-- Menampilkan Gambar Studio -->
									<img src="<?= base_url('uploads/foto_studio/' . $studio->foto_studio) ?>"
										 class="card-img-top" alt="<?= $studio->nama_studio ?>"
										 style="height: 200px; object-fit: cover;">

									<div class="card-body">
										<!-- Nama Studio -->
										<h5 class="card-title"><?= $studio->nama_studio ?></h5>

										<!-- Jenis Studio -->
										<p class="card-text">Jenis: <?= $studio->jenis_studio ?></p>

										<!-- Harga Studio -->
										<p class="card-text">Harga per Jam:
											Rp. <?= number_format($studio->harga_per_jam, 0, ',', '.') ?></p>

										<!-- Tombol Detail -->
										<a href="<?= site_url('users/studio_detail/' . $studio->id_studio) ?>"
										   class="btn btn-primary">Lihat Jadwal</a>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-md-12">
						<p>Tidak ada studio yang tersedia saat ini.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>
