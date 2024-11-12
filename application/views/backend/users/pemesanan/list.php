<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Pemesanan Anda</h3>
					</div>
					<div class="card-body">
						<?php if (!empty($pemesanan)): ?>
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>No</th>
									<th>Studio</th>
									<th>Tanggal Pemesanan</th>
									<th>Waktu Pemesanan</th>
									<th>Total Harga</th>
									<th>Status Pembayaran</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 1; ?>
								<?php foreach ($pemesanan as $pesanan): ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $pesanan['nama_studio'] ?></td>
										<td><?= date('d-m-Y', strtotime($pesanan['tanggal_pemesanan'])) ?></td>
										<td><?= $pesanan['waktu_pemesanan'] ?></td>
										<td>Rp. <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
										<td>
											<?php if ($pesanan['status_pembayaran'] === 'pending'): ?>
												<span class="badge badge-warning">Pending</span>
											<?php else: ?>
												<span class="badge badge-success">Sukses</span>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($pesanan['status_pembayaran'] === 'pending'): ?>
												<button class="btn btn-primary btn-pay"
														onclick="payNow(this, <?= $pesanan['id_pemesanan'] ?>)">Bayar
													Sekarang
												</button>
											<?php else: ?>
												<button class="btn btn-success" disabled>Sudah Dibayar</button>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						<?php else: ?>
							<p>Tidak ada pemesanan yang ditemukan.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>

<!-- Tambahkan script untuk Midtrans Snap dan SweetAlert -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
		data-client-key="<?= $this->config->item('midtrans_client_key') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	function payNow(button, id_pemesanan) {
		$(button).attr('disabled', true).text('Loading...');

		$.ajax({
			url: '<?= site_url('pembayaran/get_snap_token/') ?>' + id_pemesanan,
			type: 'GET',
			dataType: 'json',
			success: function (response) {
				if (response.status === 'success') {
					snap.pay(response.snap_token, {
						onSuccess: function (result) {
							Swal.fire({
								icon: 'success',
								title: 'Pembayaran Berhasil!',
								text: 'Terima kasih, pembayaran Anda telah berhasil.',
								confirmButtonText: 'OK'
							}).then(() => {
								window.location.reload();
							});
						},
						onPending: function (result) {
							Swal.fire({
								icon: 'info',
								title: 'Pembayaran Pending',
								text: 'Pembayaran Anda dalam status pending, silakan cek kembali nanti.',
								confirmButtonText: 'OK'
							});
						},
						onError: function (result) {
							Swal.fire({
								icon: 'error',
								title: 'Pembayaran Gagal',
								text: 'Pembayaran gagal, silakan coba lagi.',
								confirmButtonText: 'OK'
							});
						},
						onClose: function () {
							$(button).removeAttr('disabled').text('Bayar Sekarang');
						}
					});
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: response.message,
						confirmButtonText: 'OK'
					});
					$(button).removeAttr('disabled').text('Bayar Sekarang');
				}
			},
			error: function () {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Gagal mendapatkan token pembayaran.',
					confirmButtonText: 'OK'
				});
				$(button).removeAttr('disabled').text('Bayar Sekarang');
			}
		});
	}
</script>
