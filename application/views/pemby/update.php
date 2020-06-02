<html>
<head></head>

<body>
<?php
 if($cek  == '0')
{
	?>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Pembayaran Beban</b></h3>
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
<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_pemby1');?>">
	<input readonly type="hidden" class="form-control"  value="<?php echo $no_trans ; ?>" name="no_trans">
	<input readonly type="hidden" class="form-control"  value="<?php echo $tgl ; ?>" name="tgl_trans">
	<div class="row">
	<div class="form-group">
				<div class="col-xs-6">
				<div class="form-group">
				<label>Beban</label>
						<select name = "no_coa" class = "form-control">
							    <option value="#" disabled selected>Pilih Beban</option>
								<?php				
								foreach($beban as $data){				
								echo "<option value = ".$data['no_coa'].">".$data['nama_coa']."</option>";
															}
								?>
						</select>
	
				</div>
			</div>
		
	
			<div class="col-xs-6">
				<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" >
				</div>
			</div>
			
		
			
	</div>
	</div>
<hr>
	<center>

	<button type="submit" class="btn btn-dark">Tambah Pembayaran</button>
</form>
	
		<a class="btn btn-info" role="button" <?php if($cek_selesai > '0'){?> href = "<?php echo site_url()."/c_transaksi/selesai_pemby/$id/$total"?>" <?php }else{?> disabled="disabled" <?php } ?>>Selesai Pembayaran</a>
	</center>

	
 
	</div>
	</div>
</div>
<?php 
} 
?>

<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Detail Pembayaran Beban</b></h3>
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
				<th>No</th>
				<th>Nama Beban</th>
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
							<td>".$no."</td>
							<td>".$data['nama_coa']."</td>
							<td align='right'>".format_rp($data['subtotal'])."</td>"; ?>
							

						</tr>
						
					<?php
					$total=$total+$data['subtotal'];
					$no++;
				}
			?>
			<tr>
				<td colspan="2" align="center">Total</td>
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