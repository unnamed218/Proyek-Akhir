<html>
	<head>
		<title>Transaksi Pembelian Bahan Baku</title>
	</head>
	<!-- <center><h3><b>Transaksi Pembelian Bahan Baku</h3></b></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Form Pembelian Bahan Baku</b></h3>
  </div>
  	 <div class="x_content">
  	 	
	<body>
		<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_pemb');?>">
			<div class="form-group">
			  <label>ID Pembelian Bahan Baku</label>
			  <input type = "text" name = "no_trans" class = "form-control" value="<?php echo $id?>" readonly>
			
			</div>
			<div class="form-group">
			  <label>Tanggal</label>
			  <input type = "text" name = "tgl_trans" class = "form-control" readonly value="<?php echo date('Y-m-d')?>">
			</div>

			  
			
			  <hr>
			<button type="submit" class="btn btn-default btn-primary">Simpan</button>
			<a href = "<?php echo site_url()."/c_transaksi/lihat_pemb"?>" type="button" class="btn btn-default">Kembali</a>
		</form>
	</body>
</html>