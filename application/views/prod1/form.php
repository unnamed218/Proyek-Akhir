<html>
	<head>
		<title>Transaksi Produksi Pertama</title>
	</head>
	<!-- <center><h3><b>Transaksi Produksi Pertama</h3></b></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Form Produksi Pertama</b></h3>
  </div>
  	 <div class="x_content">
  	 	
	<body>
		<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_produksi_ke1');?>">
			<div class="form-group">
			  <label>ID Produksi Pertama</label>
			  <input type = "text" name = "no_trans" class = "form-control" value="<?php echo $id?>" readonly>
			
			</div>
			<div class="form-group">
			  <label>Tanggal</label>
			  <input type = "text" name = "tgl_trans" class = "form-control" readonly value="<?php echo date('Y-m-d')?>">
			</div>

			  <div class="form-group">
				<label>ID Transaksi Pembelian Bahan Baku</label>
						<select name = "no_trans_pembb" class = "form-control">
							    <option value="#" disabled selected>Pilih Pembelian</option>
								<?php				
								foreach($pbb as $data){				
								echo "<option value = ".$data['no_trans'].">".$data['no_trans']."</option>";
															}
								?>
						</select>
	
				</div>
			
			  <hr>
			<button type="submit" class="btn btn-default btn-primary">Simpan</button>
			<a href = "<?php echo site_url()."/c_transaksi/lihat_produksi_ke1"?>" type="button" class="btn btn-default">Kembali</a>
		</form>
	</body>
</html>