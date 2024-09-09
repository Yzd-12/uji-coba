 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
		  $id = $_SESSION['admin']['id_member'];
		  $hasil = $lihat -> member_edit($id);
      ?>
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Keranjang Penjualan</h3>
						<br>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						<div class="col-sm-4">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4><i class="fa fa-search"></i> Cari Barang</h4>
								</div>
								<div class="panel-body">
									<input type="text" id="cari" class="form-control" name="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
								</div>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4><i class="fa fa-list"></i> Hasil Pencarian</h4>
								</div>
								<div class="panel-body">
									<div id="hasil_cari"></div>
									<div id="tunggu"></div>
									
								</div>
							</div>
						</div>
						

						<div class="col-sm-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4><i class="fa fa-shopping-cart"></i> KASIR
									<a class="btn btn-danger pull-right" style="margin-top:-0.5pc;" href="fungsi/hapus/hapus.php?penjualan=jual">
										<b>RESET KERANJANG</b></a>
									</h4>
								</div>
								<div class="panel-body">
									<div id="keranjang">
										<table class="table table-bordered">
											<tr>
												<td><b>Tanggal</b></td>
												<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
										</table>
										<table class="table table-bordered" id="example1">
											<thead>
												<tr>
													<td> No</td>
													<td> Nama Barang</td>
													<td style="width:10%;"> Jumlah</td>
													<td style="width:20%;"> Total</td>
													<td> Kasir</td>
													<td> Aksi</td>
												</tr>
											</thead>
											<tbody>
												<?php $total_bayar=0; $no=1; $hasil_penjualan = $lihat -> penjualan();?>
												<?php foreach($hasil_penjualan  as $isi){;?>
												<tr>
													<td><?php echo $no;?></td>
													<td><?php echo $isi['nama_barang'];?></td>
													<td>
														<form method="POST" action="fungsi/edit/edit.php?jual=jual">
															<input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control">
															<input type="hidden" name="id" value="<?php echo $isi['id_penjualan'];?>" class="form-control">
															<input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
													</td>
													<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
													<td><?php echo $isi['nm_member'];?></td>
													<td>
															<button type="submit" class="btn btn-warning">Update</button>
														</form>
														<a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan'];?>&brg=<?php echo $isi['id_barang'];?>
														&jml=<?php echo $isi['jumlah']; ?>"  class="btn btn-danger"><i class="fa fa-times"></i>
														</a>
													</td>
												</tr>
												<?php $no++; $total_bayar += $isi['total'];}?>
											</tbody>
									</table>
									<br/>
									<?php $hasil = $lihat -> jumlah(); ?>
									<div id="kasirnya">
										<table class="table table-stripped">
											<?php
											// proses bayar dan ke nota
											if(!empty($_GET['nota'] == 'yes')) {
												$total = $_POST['total'];
												$bayar = $_POST['bayar'];
												if(!empty($bayar))
												{
													$hitung = $bayar - $total;
													if($bayar >= $total)
													{
														$id_barang = $_POST['id_barang'];
														$id_member = $_POST['id_member'];
														$jumlah = $_POST['jumlah'];
														$total = $_POST['total1'];
														$tgl_input = $_POST['tgl_input'];
														$periode = $_POST['periode'];
														$jumlah_dipilih = count($id_barang);
														$tgl = $_POST['tanggal'];

														$sql = "SELECT max(id_nota) AS last FROM nota WHERE tanggal_input LIKE '$tgl%'";
														$row = $config-> prepare($sql);
														$row -> execute();
														$hasil = $row -> fetch();
														$date = date('Y-m-d');
														$lastNoTransaksi = $hasil['last'];
														$lastNoUrut = substr($lastNoTransaksi, 13, 4); 
														var_dump($string_variable); // Memeriksa tipe data dan nilai
var_dump($integer_variable);

$result = intval($string_variable) + $integer_variable; // Konversi dan penjumlahan


														$nextNoTransaksi = 'TAA'.$date.sprintf('%04s', $nextNoUrut);
														$d = array($nextNoTransaksi,$id_member[0],$tgl,$periode);
														$sql = "INSERT INTO nota (id_nota,id_member,tanggal_input,periode) VALUES(?,?,?,?)";
														$row = $config->prepare($sql);
													// Contoh membuat primary key dengan timestamp
$timestamp = date('Y-m-d H:i:s');
$primary_key = 'TAA' . $timestamp; // Pastikan format ini unik

														
														for($x=0;$x<$jumlah_dipilih;$x++){

															$e = array($id_barang[$x],$nextNoTransaksi,$jumlah[$x],$total[$x]);
															$sql = "INSERT INTO detail_nota (id_barang,id_nota,jumlah,total) VALUES(?,?,?,?)";
															$row = $config->prepare($sql);
															try {
		// config.php
$pdo = new PDO('mysql:host=localhost;dbname=toko', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Memulai transaksi
    $pdo->beginTransaction();

    // Insert ke tabel nota terlebih dahulu
    $stmt1 = $pdo->prepare("INSERT INTO nota (tanggal_input, total) VALUES (:tanggal_input, :total)");
    $stmt1->execute(['tanggal_input' => '2024-09-09', 'total' => 10000000]);

    // Ambil id_nota terakhir yang baru saja dimasukkan
    $id_nota = $pdo->lastInsertId();

    // Pastikan id_nota tidak null
    if ($id_nota !== NULL && $id_nota !== '') {
        // Insert ke tabel detail_nota
        $stmt2 = $pdo->prepare("INSERT INTO detail_nota (id_nota, jumlah) VALUES (:id_nota, :jumlah)");
        $stmt2->execute(['id_nota' => $id_nota, 'jumlah' => $jumlah]);

        // Commit transaksi
        $pdo->commit();
    } else {
        // Rollback transaksi jika id_nota null
        $pdo->rollBack();
        echo "Error: id_nota is NULL. Insert to detail_nota aborted.";
    }
} catch (Exception $e) {
    // Rollback jika terjadi error
    $pdo->rollBack();
    echo "Failed: " . $e->getMessage();
}

														}
														echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
													}else{
														echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
													}
												}
											}
											?>
											<form method="POST" action="index.php?page=jual&nota=yes#kasirnya">

												<?php foreach($hasil_penjualan as $isi){;?>
													<input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
													<input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
													<input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
													<input type="hidden" name="total1[]" value="<?php echo $isi['total'];?>">
												<?php $no++; }?>
												<input type="hidden" name="periode" value="<?php echo date('m-Y');?>">
												<input type="hidden" name="tanggal" value="<?php echo date("j F Y");?>" >

												<tr>
													<td>Total Semua  </td>
													<td><input type="text" class="form-control" name="total" value="<?php echo $total_bayar;?>"></td>
												
													<td>Bayar  </td>
													<td><input type="text" class="form-control" name="bayar" value="<?php echo $bayar;?>"></td>
													<td><button class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button>
													<?php  if(!empty($_GET['nota'] == 'yes')) {?>
													 <a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
														<b>RESET</b></a></td><?php }?></td>
												</tr>
											</form>
											<tr>
												<td>Kembali</td>
												<td><input type="text" class="form-control" value="<?php echo $hitung;?>"></td>
												<td></td>
												<td>
													<a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member'];?>
													&bayar=<?php echo $bayar;?>&kembali=<?php echo $hitung;?>" target="_blank">
													<button class="btn btn-default">
														<i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
													</button></a>
												</td>

											</tr>
										</table>
										<br/>
										<br/>
									</div>
								</div>
							</div>
						</div>
				  </div>
              </div>
          </section>
      </section>
	

<script>
// AJAX call for autocomplete 
$(document).ready(function(){
	$("#cari").change(function(){
		$.ajax({
		type: "POST",
		url: "fungsi/edit/edit.php?cari_barang=yes",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
            $("#hasil_cari").hide();
			$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
		},
          success: function(html){
			$("#tunggu").html('');
            $("#hasil_cari").show();
            $("#hasil_cari").html(html);
		}
	});
	});
});
//To select country name
</script>