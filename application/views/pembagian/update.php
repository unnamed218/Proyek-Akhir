<html>
<head></head>

<body>
<?php
 if($cek  == '0')
{
	?>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Pembagian</b></h3>
  </div>
  	 <div class="x_content">
<div>
	
		<div class="row">
	<div class="form-group">
			<div class="col-xs-2">
				<div class="form-group">
				<label>ID Transaksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans ; ?>"  >
			</div>
		</div>
		
		<div class="col-xs-2">
				<div class="form-group">
				<label>ID Produksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $prod ; ?>"  >
			</div>
		</div>
	
			<div class="col-xs-2">
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
				<label>Jumlah Tersedia</label>
				<input readonly type="text" class="form-control"  value="<?php echo $jumlah?>"  >
			</div>
		</div>
	</div>
	</div>
<form method = "POST" action = "<?php echo site_url('c_transaksi/selesai_pembagian');?>">
	<div class="row">
	<div class="form-group">
			<input readonly type="hidden" class="form-control"  name ="no_trans" value="<?php echo $no_trans ; ?>"  >
			<input readonly type="hidden" class="form-control"  name = "jumlah" value="<?php echo $jumlah?>"  >
			<div class="col-xs-6">
				<div class="form-group">
				<label>Jual (0-100%)</label>
				<input type="number" class="form-control"  name="jual" >
			</div>
		</div>

		<div class="col-xs-6">
				<div class="form-group">
				<label>Produksi (0-100%)</label>
				<input type="number" class="form-control"  name="produksi"  >
			</div>
		</div>
	</div>
</div>
<hr>
	<center>

	<button type="submit" class="btn btn-dark">Selesai Pembagian</button>
</form>
	
		
	</center>

		

 
	</div>
	</div>
</div>
<?php 
} 
?>


<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Detail Pembagian</b></h3>
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
				<label>Jumlah Tersedia</label>
				<input readonly type="text" class="form-control"  value="<?php echo $jumlah?>"  >
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
				<th>Jual</th>
				<th>Jumlah</th>
				<th>Produksi</th>
				<th>Jumlah</th>
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
							<td>".$data['jual']." %</td>
							<td>".($data['jual'] / 100) * $data['jumlah']."</td>
							<td>".$data['produksi']." %</td>
							<td>".($data['produksi'] / 100) * $data['jumlah']."</td>"; ?>
							

						</tr>
						
					<?php

					$no++;
				}
			?>
			
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