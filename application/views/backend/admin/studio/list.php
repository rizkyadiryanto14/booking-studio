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
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<a href="<?= base_url('admin/tambah_studio') ?>" class="btn btn-primary">
							<i class="fas fa-plus"></i>
							Tambah Studio
						</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="studio_data" class="table table-hover">
								<thead>
								<tr>
									<th>No</th>
									<th>Nama Studio</th>
									<th>Jenis Studio</th>
									<th>Harga per Jam</th>
									<th>Ketersediaan</th>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
	$(document).ready(function () {
		var dataTable = $('#studio_data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo site_url('admin/get_data_studio'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 5, 6],
				"orderable": false,
			}],
		});
	});
</script>
<?php $this->load->view('templates/footer') ?>
