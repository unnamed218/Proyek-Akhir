<html>
	<head>
		<title>Master Data Peternak</title>
	</head>
	<!-- <center><h3><b>Master Data Peternak</h3></b></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Form Peternak</b></h3>
  </div>
  	 <div class="x_content">
  	 	
	<body>
		<form method = "POST" action = "<?php echo site_url('c_masterdata/tambah_peternak');?>">
			<div class="form-group">
			  <label>ID Peternak</label>
			  <input type = "text" name = "no_peternak" class = "form-control" value="<?php echo $id?>" readonly>
			
			</div>
			<div class="form-group">
			  <label>Nama Peternak</label>
			  <input type = "text" name = "nama_peternak" class = "form-control">
			  
			  <?php echo form_error('nama_peternak'); ?>
			
			</div>
		
			
			  <hr>
			<button type="submit" class="btn btn-default btn-primary">Simpan</button>
			<a href = "<?php echo site_url()."/c_masterdata/lihat_peternak"?>" type="button" class="btn btn-default">Kembali</a>
		</form>
	</body>
</html>