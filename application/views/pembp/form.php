<html>
	<head>
		<title>Transaksi Pembelian Bahan Penolong</title>
	</head>
	<!-- <center><h3><b>Transaksi Pembelian Bahan Penolong</h3></b></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Form Pembelian Bahan Penolong</b></h3>
  </div>
  	 <div class="x_content">
  	 	
	<body>
		<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_pembp');?>">
			<div class="form-group">
			  <label>ID Pembelian Bahan Penolong</label>
			  <input type = "text" name = "no_trans" class = "form-control" value="<?php echo $id?>" readonly>
			
			</div>
			<div class="form-group">
			  <label>Tanggal</label>
			  <input type = "text" name = "tgl_trans" class = "form-control" readonly value="<?php echo date('Y-m-d')?>">
			</div>

			<div class="form-group">
			  <label>No Target Produksi</label>
			    <select name = "no_tp" class = "form-control">
			    <option value="#" disabled selected>Pilih Target Produksi</option>
				<?php
				
					foreach($result as $data){
						echo "<option value = ".$data['no_tp'].">".$data['no_tp']."</option>";
				
				}
				?>
			  </select>
			  
			  <?php echo form_error('no_tp'); ?>
			
			</div>
			  
			
			  <hr>
			<button type="submit" class="btn btn-default btn-primary">Simpan</button>
			<a href = "<?php echo site_url()."/c_transaksi/lihat_pembp"?>" type="button" class="btn btn-default">Kembali</a>
		</form>
	</body>
</html>