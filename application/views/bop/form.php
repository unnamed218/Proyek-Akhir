<html>
	<head>
		<title>Master Data BOP</title>
	</head>
	<!-- <center><h3><b>Master Data BOP</h3></b></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Form BOP</b></h3>
  </div>
  	 <div class="x_content">
  	 	
	<body>
		<form method = "POST" action = "<?php echo site_url('c_masterdata/tambah_bop');?>">
			<div class="form-group">
			  <label>ID BOP</label>
			  <input type = "text" name = "no_bop" class = "form-control" value="<?php echo $id?>" readonly>
			
			</div>
			<div class="form-group">
			  <label>Bulan</label>
			  <select name="bulan" class="form-control">
					<option value="*" disabled selected>Pilih Bulan</option>
					<option value="1">Januari</option>
					<option value="2">Februari</option>
					<option value="3">Maret</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">Juni</option>
					<option value="7">Juli</option>
					<option value="8" >Agustus</option>
					<option value="9" >September</option>
					<option value="10" >Oktober</option>
					<option value="11" >November</option>
					<option value="12" >Desember</option>

					</select>
			  
			  <?php echo form_error('bulan'); ?>
			
			</div>
			<div class="form-group">
			  <label>Tahun</label>
			<select name="tahun" class="form-control">
				<option value="#" disabled selected>Pilih Tahun</option>
				<?php
				$now =date('Y');
				for ($a=2018;$a<=$now;$a++)

					{

     echo "<option value='".$a."'>".$a."</option>";

					}
				?>
				</select>
			  
			  <?php echo form_error('tahun'); ?>
			
			</div>
			
				
			  <hr>
			<button type="submit" class="btn btn-default btn-primary">Simpan</button>
			<a href = "<?php echo site_url()."/c_masterdata/lihat_bop"?>" type="button" class="btn btn-default">Kembali</a>
		</form>
	</body>
</html>