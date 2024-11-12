<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Download Laporan Pembayaran</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			color: #333;
		}

		h1 {
			text-align: center;
			font-size: 24px;
			margin-bottom: 10px;
		}

		.download-date {
			text-align: center;
			font-size: 14px;
			margin-bottom: 20px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 10px;
		}

		table, th, td {
			border: 1px solid #000;
			padding: 8px;
			text-align: center;
		}

		th {
			background-color: #f2f2f2;
		}

		.btn-download {
			display: block;
			margin: 20px auto;
			padding: 10px 20px;
			font-size: 16px;
			background-color: #28a745;
			color: #fff;
			border: none;
			cursor: pointer;
			border-radius: 5px;
			text-align: center;
		}

		.btn-download:hover {
			background-color: #218838;
		}
	</style>
</head>
<body>
<h1>Laporan Pembayaran</h1>
<p class="download-date">Tanggal Download: <?php echo date('d-m-Y'); ?></p>

<table>
	<thead>
	<tr>
		<th>No</th>
		<th>Nama Pengguna</th>
		<th>No.Pemesanan</th>
		<th>Tipe Pembayaran</th>
		<th>Status Transaksi</th>
		<th>Total</th>
		<th>Waktu</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<?php
		$no = 1;
		if (isset($laporan_pembayaran)) {
			foreach ($laporan_pembayaran as $item) { ?>
				<td><?= $no++ ?></td>
				<td><?= $item->nama_pengguna ?></td>
				<td><?= $item->id_pemesanan ?></td>
				<td><?= $item->payment_type ?></td>
				<td><?= $item->transaction_status ?></td>
				<td><?= $item->gross_amount ?></td>
				<td><?= $item->transaction_time ?></td>
			<?php }
		} ?>
	</tr>
	</tbody>
</table>

<button class="btn-download" onclick="downloadPDF()">Download PDF</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
	function downloadPDF() {
		const element = document.body;

		const now = new Date();
		const formattedDate = now.getFullYear() + "_" + (now.getMonth() + 1).toString().padStart(2, '0') + "_" + now.getDate().toString().padStart(2, '0');
		const formattedTime = now.getHours().toString().padStart(2, '0') + "_" + now.getMinutes().toString().padStart(2, '0') + "_" + now.getSeconds().toString().padStart(2, '0');

		const fileName = `Laporan_Pembayaran_${formattedDate}_${formattedTime}.pdf`;

		html2pdf().from(element).save(fileName);
	}
</script>
</body>
</html>
