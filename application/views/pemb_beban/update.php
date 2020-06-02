<html>
<head></head>

<body>
<?php
 if($cek  == '0')
{
	?>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Pembelian Bahan Baku</b></h3>
  </div>
  	 <div class="x_content">
<div>
	
		<div class="row">
	<div class="form-group">
			<div class="col-xs-6">
				<div class="form-group">
				<label>ID Transaksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans ; ?>"  >
			</div>
		</div>
		
	
			<div class="col-xs-6">
				<div class="form-group">
				<label>Tanggal Transaksi</label>
				<input type="text" class="form-control"  value="<?php echo $tgl ; ?>"readonly >
				</div>
			</div>
			
			</div>
	</div>
<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_pemb1');?>">
	<input readonly type="hidden" class="form-control"  value="<?php echo $no_trans ; ?>" name="no_trans">
	<input readonly type="hidden" class="form-control"  value="<?php echo $tgl ; ?>" name="tgl_trans">
	<div class="row">
	<div class="form-group">
			<div class="col-xs-5">
				<div class="form-group">
				<label>Bahan Baku</label>
				<input readonly type="text" class="form-control"  value="Susu Sapi"  >
				<input readonly type="hidden" class="form-control"  value="BB_001" name="no_bb">
			

			</div>
		</div>
		
	
			<div class="col-xs-2">
				<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" >
				</div>
			</div>
			
			<div class="col-xs-5">
				<div class="form-group">
				<label>Peternak</label>
						<select name = "no_peternak" class = "form-control">
							    <option value="#" disabled selected>Pilih Peternak</option>
								<?php				
								foreach($peternak as $data){				
								echo "<option value = ".$data['no_peternak'].">".$data['nama_peternak']."</option>";
															}
								?>
						</select>
	
				</div>
			</div>
			
	</div>
	</div>
<hr>
	<center>

	<button type="submit" class="btn btn-dark">Tambah Pembelian</button>
</form>
	
		<a class="btn btn-info" role="button" <?php if($cek_selesai > '0'){?> href = "<?php echo site_url()."/c_transaksi/selesai_pemb/$id/$total"?>" <?php }else{?> disabled="disabled" <?php } ?>>Selesai Pembelian</a>
	</center>

		
<!-- 		<div class="row" >

	<div class="col-md-12" >
		<table  class="table table-striped table-bordered table-hover jambo_table" >
		 	<thead>
			<tr class="headings">
				<th>Nama Bahan</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Subtotal</th>
				<th>Supplier</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
				foreach($result1 as $data){
					
					echo "
							<tr>
							<td>".$data['nama_bb']."</td>
							<td>".$data['jumlah']." ".$data['satuan']."</td>
							<td>".format_rp($data['harga'])."</td>
						
							
							<td>".format_rp($data['harga']*$data['jumlah'])."</td>"; ?>
							<td>


								<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_pemb1');?>">
								<input type="hidden" name="no_trans" value="<?php echo $id;?>">
								<input type="hidden" name="jumlah" value="<?php echo $data['jumlah']; ?>">
								<input type="hidden" name="no_bb" value="<?php echo $data['no_bbp']; ?>">
								<input type="hidden" name="harga" value="<?php echo $data['harga']; ?>">
								<select name = "no_peternak" class = "form-control">
								    <option value="#" disabled selected>Pilih Peternak</option>
									<?php
									
										foreach($peternak as $data){
										
											echo "<option value = ".$data['no_peternak'].">".$data['nama_peternak']."</option>";
										}
									?>
								  </select>
			
							</td>
							<td>
							
							<button type="submit" class="btn btn-default btn-success">Beli</button>
						</form>
					</td>

						</tr>
						
					<?php
					$no++;
				}
			?>
			</tbody>

		</table>
		
	</div>

	
		<a href="lihat_BOM" class="btn btn-default">Back</a>
		<input type="button" class="btn btn-default" value="Back" onClick=history.go(-1);>
	</div>
	<center>
		<a class="btn btn-primary" role="button" <?php if($cek_selesai == '0'){?> href = "<?php echo site_url()."/c_transaksi/selesai_pemb/$id/$total"?>" <?php }else{?> disabled="disabled" <?php } ?>>Selesai Belanja</a>
	</center> -->
 
	</div>
	</div>
</div>
<?php 
} 
?>

<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Detail Pembelian Bahan Baku</b></h3>
  </div>
  	 <div class="x_content">
<div>
	
		<div class="row">
	<div class="form-group">
			<div class="col-xs-6">
				<div class="form-group">
				<label>ID Transaksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans ; ?>"  >
			</div>
			
		</div>
		
	
			<div class="col-xs-6">
				<div class="form-group">
				<label>Tanggal Transaksi</label>
				<input type="text" class="form-control"  value="<?php echo $tgl ; ?>"readonly >
				</div>
			</div>
			
			</div>
	</div>
		
		<hr>
<br>
		<div class="row" >

	<div class="col-md-12" >
		<table  class="table table-striped table-bordered table-hover jambo_table" >
		 	<thead>
			<tr class="headings">
				<th>Nama Bahan</th>
				<th>Nama Peternak</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Subtotal</th>
			<!-- 	<th>Supplier</th>
				<th>Aksi</th> -->
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$total = 0;
				foreach($detail as $data){
					
					echo "
							<tr>
							<td>".$data['nama_bb']."</td>
							<td>".$data['nama_peternak']."</td>
							<td>".$data['jumlah']." ".$data['satuan']."</td>
							<td align='right'>".format_rp($data['harga'])."</td>
						
							
							<td align='right'>".format_rp($data['harga']*$data['jumlah'])."</td>"; ?>
							

						</tr>
						
					<?php
					$subtotal = $data['harga'] * $data['jumlah'];
					$total=$total+$subtotal;
					$no++;
				}
			?>
			<tr>
				<td colspan="4" align="center">Total</td>
				<td align="right"><?php echo format_rp($total) ?></td>
			</tr>
			</tbody>

		</table>
		
	</div>

	<!-- 
		<a href="lihat_BOM" class="btn btn-default">Back</a>
		<input type="button" class="btn btn-default" value="Back" onClick=history.go(-1);> -->
	</div>
	<a href = "<?php echo site_url()."/c_transaksi/lihat_pemb"?>" class="btn btn-default" role="button">Kembali</a>

	</div>
	</div>
</div>




</body>
</html>