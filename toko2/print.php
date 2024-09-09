<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
?>
<html>
	<head>
		<title>print</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
						<p><?php echo $toko[''];?>SRC Abdul</p>
						<p><?php echo $toko[''];?>JL Panawangn- Cikijing</p>
						<p>Tanggal : <?php  echo date("j F Y, G:i");?></p>
						<p>Kasir : <?php  echo $_GET[''];?>Andrea</p>
					</center>
					<table class="table table-bordered" style="width:100%;">
						<tr>
							<td>No.</td>
							<td>Barang</td>
							<td>Jumlah</td>
							<td>Total</td>
						</tr>
						<?php $no=1; foreach($hsl as $isi){?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $isi['nama_barang'];?></td>
							<td><?php echo $isi['jumlah'];?></td>
							<td><?php echo $isi['total'];?></td>
						</tr>
						<?php $no++; }?>
					</table>
					<div class="pull-right">
						<?php $hasil = $lihat -> jumlah(); ?>
						Total : Rp.<?php echo number_format($hasil['total']);?>,-
						<br/>
						Bayar : <?phpRp.$price = isset($price) ? floatval($price) : 0;
echo number_format($price, 2); // Format 2 desimal
?>
						<br/>
						Kembali : Rp.<?php $total = isset($total) ? floatval($total) : 0; // Set 0 jika variabel tidak valid
echo number_format($total, 2); // Format dengan 2 desimal
?>
					</div>
					<div class="clearfix"></div>
					<center>
						<p>Terima Kasih Telah berbelanja di toko kami !</p>
					</center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</body>
</html>
