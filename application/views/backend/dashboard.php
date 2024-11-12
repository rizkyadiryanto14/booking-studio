<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<!-- Content Wrapper. Contains page content -->
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

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">

				<!-- Dashboard for Admin (role 1) -->
				<?php if($this->session->userdata('role') == 1): ?>
					<!-- Stats Boxes for Admin -->
					<div class="col-lg-3 col-6">
						<div class="small-box bg-info">
							<div class="inner">
								<h3>150</h3>
								<p>Users</p>
							</div>
							<div class="icon">
								<i class="ion ion-person"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3>53</h3>
								<p>Jumlah Pemesanan</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-warning">
							<div class="inner">
								<h3>Rp. 5.000.000</h3>
								<p>Total Pendapatan</p>
							</div>
							<div class="icon">
								<i class="ion ion-cash"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3>20</h3>
								<p>Pembayaran Pending</p>
							</div>
							<div class="icon">
								<i class="ion ion-alert"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<!-- Grafik Bar: Pendapatan per Bulan -->
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Pendapatan per Bulan (Dummy)</h3>
							</div>
							<div class="card-body">
								<canvas id="pendapatanChart"></canvas>
							</div>
						</div>
					</div>

					<!-- Grafik Pie: Status Pembayaran -->
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Status Pembayaran (Dummy)</h3>
							</div>
							<div class="card-body">
								<canvas id="pembayaranChart"></canvas>
							</div>
						</div>
					</div>

					<!-- Dashboard for User (role 2) -->
				<?php elseif($this->session->userdata('role') == 2): ?>
					<!-- Stats Boxes for User -->
					<div class="col-lg-3 col-6">
						<div class="small-box bg-primary">
							<div class="inner">
								<h3>3</h3>
								<p>Riwayat Pemesanan Saya</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3>2</h3>
								<p>Pembayaran Sukses</p>
							</div>
							<div class="icon">
								<i class="ion ion-checkmark"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-warning">
							<div class="inner">
								<h3>1</h3>
								<p>Pembayaran Pending</p>
							</div>
							<div class="icon">
								<i class="ion ion-alert"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3>5</h3>
								<p>Studio Terpesan</p>
							</div>
							<div class="icon">
								<i class="ion ion-calendar"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

				<?php endif; ?>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<?php $this->load->view('templates/footer') ?>

<!-- Script untuk Grafik dengan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	// Data untuk Grafik Bar: Pendapatan per Bulan (Admin)
	var ctx = document.getElementById('pendapatanChart').getContext('2d');
	var pendapatanChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
			datasets: [{
				label: 'Pendapatan (Rp)',
				data: [1000000, 1200000, 900000, 1500000, 1700000, 1300000],
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

	// Data untuk Grafik Pie: Status Pembayaran (Admin)
	var ctx2 = document.getElementById('pembayaranChart').getContext('2d');
	var pembayaranChart = new Chart(ctx2, {
		type: 'pie',
		data: {
			labels: ['Sukses', 'Pending', 'Gagal'],
			datasets: [{
				label: 'Status Pembayaran',
				data: [60, 30, 10], // Dummy data
				backgroundColor: [
					'rgba(75, 192, 192, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(255, 99, 132, 0.2)'
				],
				borderColor: [
					'rgba(75, 192, 192, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(255, 99, 132, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true
		}
	});

</script>
