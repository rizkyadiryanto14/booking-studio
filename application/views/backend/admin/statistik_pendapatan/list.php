<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Statistik Pendapatan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Statistik Pendapatan</li>
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
							Jumlah Pendapatan
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<h1>Grafik Pendapatan Bulanan untuk Tahun <?= $year ?></h1>
								<form action="<?= base_url('statistik_pendapatan/index') ?>" method="get">
									<label for="year">Tahun:</label>
									<input type="number" id="year" name="year" value="<?= $year ?>" min="2000"
										   max="2100">
									<button type="submit">Tampilkan</button>
								</form>
								<canvas id="revenueChart" width="800" height="400"></canvas>
							</div>
							<div class="col-md-6">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
										<tr>
											<th>Bulan</th>
											<th>Jumlah Pendapatan (IDR)</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$months = [
											'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
											'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
										];
										foreach ($monthly_revenue as $index => $revenue) {
											echo "<tr>
                                                        <td>{$months[$index - 1]}</td>
                                                        <td>Rp. " . number_format($revenue, 2) . "</td>
                                                      </tr>";
										}
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	const ctx = document.getElementById('revenueChart').getContext('2d');
	const revenueData = <?= json_encode(array_values($monthly_revenue)) ?>;

	new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
			datasets: [{
				label: 'Pendapatan (IDR)',
				data: revenueData,
				backgroundColor: 'rgba(54, 162, 235, 0.2)',
				borderColor: 'rgba(54, 162, 235, 1)',
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>

<?php $this->load->view('templates/footer') ?>
