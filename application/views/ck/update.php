<html>
<head></head>

<body>
<?php
 if($cek  == '0')
{
	?>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Cek Kualitas</b></h3>
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


<form method = "POST" action = "<?php echo site_url('c_transaksi/selesai_ck');?>">
	<input readonly type="hidden" class="form-control"  value="<?php echo $no_trans ; ?>" name="no_trans">
	<div class="row">
	<div class="form-group">
			<div class="col-xs-6">
				<div class="form-group">
				<label>Bahan Baku</label>
				<input type="text" class="form-control"  value="Susu Sapi"readonly >
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
				<label>Lulus Uji Lab</label>
				<input type="number" class="form-control" name="lulus">
			</div>
		</div>
			<div class="col-xs-3">
				<div class="form-group">
				<label>Dari</label>
				<input readonly type="text" class="form-control" value="<?php echo $jumlah; ?> <?php echo $satuan; ?>  ">
				<input readonly type="hidden" class="form-control" value="<?php echo $jumlah; ?>" name="jumlah">
			</div>
		</div>
	
	
	</div>
	</div>
<hr>
	<center>

	<button type="submit" class="btn btn-dark">Selesai Cek Kualitas</button>
</form>
	<!-- 
		<a class="btn btn-info" role="button" <?php if($cek_selesai > '0'){?> href = "<?php echo site_url()."/c_transaksi/selesai_pemb/$id/$total"?>" <?php }else{?> disabled="disabled" <?php } ?>>Selesai Pembelian</a> -->
	</center>

 
	</div>
	</div>
</div>
<?php 
}elseif($cek == '1' OR $cek =='2'){
?>

<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Detail Cek Kualitas</b></h3>
  </div>
  	 <div class="x_content">
<div>
	
		<div class="row">
	<div class="form-group">
			<div class="col-xs-3">
				<div class="form-group">
				<label>ID Transaksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans ; ?>"  >
			</div>
		</div>
		
	
			<div class="col-xs-3">
				<div class="form-group">
				<label>Tanggal Transaksi</label>
				<input type="text" class="form-control"  value="<?php echo $tgl ; ?>"readonly >
				</div>
			</div>
			

			<div class="col-xs-3">
				<div class="form-group">
				<label>Bahan Baku</label>
				<input readonly type="text" class="form-control"  value="Susu Sapi"  >
			</div>
		</div>

		<div class="col-xs-3">
				<div class="form-group">
				<label>Satuan</label>
				<input readonly type="text" class="form-control"  value="liter"  >
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
				<th>Lulus</th>
				<th>Gagal</th>
				<th>Total</th>
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
							<td>".$data['lulus']."</td>
							<td>".($data['total'] - $data['lulus'])."</td>
							<td>".$data['total']."</td>"; ?>
							

						</tr>
						
					<?php

					$no++;
				}
			?>
			
			</tbody>

		</table>
		
	</div>
	</div>
	<a href = "<?php echo site_url()."/c_transaksi/lihat_ck"?>" class="btn btn-default" role="button">Kembali</a>

	</div>
	</div>
</div>



</body>
</html>
<?php 
	}
?>
</body>
</html>