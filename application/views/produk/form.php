<html>
	<head>
		<title>Master Data Produk</title>
	</head>
	<!-- <center><h3><b>Master Data Produk</h3></b></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Form Produk</b></h3>
  </div>
  	 <div class="x_content">
  	 	
	<body>
		<form method = "POST" action = "<?php echo site_url('c_masterdata/tambah_produk');?>">
			<div class="form-group">
			  <label>ID Produk</label>
			  <input type = "text" name = "no_produk" class = "form-control" value="<?php echo $id?>" readonly>
			
			</div>
			<div class="form-group">
			  <label>Nama Produk</label>
			  <input type = "text" name = "nama_produk" class = "form-control">
			  
			  <?php echo form_error('nama_produk'); ?>
			
			</div>
			
			<div class="form-group">
			  <label>Satuan</label>
			  <select name="satuan" class="form-control">
			  	<option disabled selected>Pilih Satuan</option>
			  	<option value="ton">ton</option>
			  	<option value="kg">kg</option>
			  	<option value="gram">gram</option>
			  	<option value="liter">liter</option>
			  	<option value="ml">ml</option>
			  	<option value="buah">buah</option>
			  	
			  </select>
			
			  <?php echo form_error('satuan'); ?>
			</div>
			
			  <hr>
			<button type="submit" class="btn btn-default btn-primary">Simpan</button>
			<a href = "<?php echo site_url()."/c_masterdata/lihat_produk"?>" type="button" class="btn btn-default">Kembali</a>
		</form>
	</body>
</html>