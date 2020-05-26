<html>
<head></head>

<body>


<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Detail Produksi Olahan</b></h3>
  </div>
  	 <div class="x_content">
<div>



		<div class="row">
		<div class="form-group">
			<div class="col-xs-3">
				<div class="form-group">
				<label>ID Produksi Olahan</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans ; ?>"  >
			</div>
		</div>

			<div class="col-xs-3">
				<div class="form-group">
				<label>ID Target Produksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_tp ; ?>"  >
			</div>
		</div>
		
	
			<div class="col-xs-2">
				<div class="form-group">
				<label>Tanggal Transaksi</label>
				<input type="text" class="form-control"  value="<?php echo $tgl ; ?>"readonly >
				</div>
			</div>

			<div class="col-xs-2">
				<div class="form-group">
				<label>Produk</label>
				<input readonly type="text" class="form-control"  value="<?php echo $nama_produk; ?>"  >
			</div>
		</div>

			<div class="col-xs-2">
				<div class="form-group">
				<label>Jumlah Produksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $jumlah; ?>"  >
			</div>
		</div>
			
			</div>
	</div>
		<hr>

<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label>Bill Of Materials</label>

			<table  class="table table-striped table-bordered table-hover jambo_table" >
		 	<thead>
			<tr class="headings">
				<th>Nama Bahan</th>
				<th>Jenis Bahan </th>
				<th>Jumlah</th>
				<th>Satuan</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
				foreach($result2 as $data){
					
					echo "
							<tr>
							<td>".$data['nama_bb']."</td>"; ?>
							<?php 
							$nama = substr($data['no_bbp'],0,2);
							if($nama == 'BB'){ echo "
							<td>Bahan Baku</td> ";
						}else{
							echo "<td>Bahan Penolong</td>";
						}
						echo "

							<td>".$data['jumlah_bom']."</td>
							
							<td>".$data['satuan']."</td>"; ?>
								

						</tr>
						
					<?php
					$no++;
				}
			?>
			</tbody>

		</table>
	</div>
		</div>
	</div>


	<div class="row" >

	<div class="col-md-12" >
		<hr>
		<h5><b>Biaya Produksi</b></h5	>
		<table  class="table table-striped table-bordered table-hover jambo_table" >
		 	<thead>
			<tr class="headings">
				<th>Keterangan</th>
				<th>Biaya</th>
				<th>Per buah</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="3">Biaya Bahan Baku</th>
			</tr>
			
			<tr>
				<th colspan="3">Biaya Bahan Penolong</th>
			</tr>
			<tr>
				<th colspan="3">Biaya Tenaga Kerja</th>
			</tr>
			<tr>
				<th colspan="3">Biaya Operasional Pabrik</th>
			</tr>
			<tr>
				<th colspan="3">Biaya Produksi</th>
			</tr>

			</tbody>

		</table>
		
	</div>
	</div>


<div class="row">
		<div class="col-md-11">
	<a href = "<?php echo site_url()."/c_transaksi/lihat_produksi_ke2"?>" class="btn btn-default" role="button">Kembali</a>
</div>
<div class="col-md-1">
  	 	<div style="align-items: : : right;">
	<!-- <a href = "<?php echo site_url()."/c_transaksi/selesai_produksi_ke2/$id/$total/$jumlah/$no_prod"?>" class="btn btn-dark" role="button">Produksi</a> -->
		<a class="btn btn-dark" role="button" <?php if($cek == '0'){?> href = "<?php echo site_url()."/c_transaksi/selesai_produksi_ke2"?>" <?php }else{?> hidden <?php } ?>>Produksi</a>
</div>
</div>

	</div>



</div>
</div>
</div>




</body>
</html>