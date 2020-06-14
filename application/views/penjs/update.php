<html>
<head></head>

<body>

		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Penjualan IPS</b></h3>
  </div>
  	 <div class="x_content">
<div>
	<?php if (isset($error)){ echo "<div class='alert alert-danger'><li>".$error."</li></div>"; }?>
		<div class="row">
	<div class="form-group">
			<div class="col-xs-3">
				<div class="form-group">
				<label>ID Penjualan IPS</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans ; ?>"  >
			</div>
		</div>
		
	
			<div class="col-xs-3">
				<div class="form-group">
				<label>Tanggal Penjualan IPS</label>
				<input type="text" class="form-control"  value="<?php echo $tgl ; ?>"readonly >
				</div>
			</div>
	
			<div class="col-xs-3">
				<div class="form-group">
				<label>Jumlah</label>
				<input type="text" class="form-control"  value="<?php echo $jumlah; ?> <?php echo $satuan?>"readonly >
				</div>
			</div>

			<?php 
			$jumlah_produksi = 0;
			$harga = 0;
			$harga_satuan = 0;
			$jumlah_produksi = $list['jual'] + $list['produksi'];
			$harga = round(($list['biaya'] * ($list['jual'] / $jumlah_produksi))*1.3);
			$harga_satuan = ($harga / $jumlah);
			?>
				<div class="col-xs-3">
				<div class="form-group">
				<label>Total Harga</label>
				<input readonly type="text" class="form-control"  value="<?php echo format_rp($harga)?> (<?php echo format_rp($harga_satuan); ?>/pcs)"  >
			</div>
		</div>
		
			
			</div>
	</div>
	
		<div class="row">
			<?php 
	if($status == '0'){
		?>
			<form method="POST" action="<?php echo site_url().'/c_transaksi/tambah_penjs'; ?>">
			<input readonly type="hidden" class="form-control" name="no_trans" value="<?php echo $no_trans ; ?>"  >
			<input readonly type="hidden" class="form-control" name="id_pembg" value="<?php echo $id_pembg ; ?>"  >
			<input readonly type="hidden" class="form-control" name="tgl_trans" value="<?php echo $tgl ; ?>"  >
			<input readonly type="hidden" class="form-control" name="harga" value="<?php echo $harga_satuan ; ?>"  >
			<input readonly type="hidden" class="form-control" name="no_produk" value="<?php echo $no_produk?>"  >
			<input readonly type="hidden" class="form-control" name="jumlah1" value="<?php echo $jumlah?>"  >



	<div class="form-group">
			<div class="col-xs-4">
				<div class="form-group">
			  <label>Nama Produk</label>
			    <input type="text" readonly="" value="Susu Sapi" class="form-control">
			
			</div>
		</div>

			<div class="col-xs-4">
				<div class="form-group">
			  <label>Nama Konsumen IPS</label>
			    <select name = "no_ips" class = "form-control">
			    <option value="#" disabled selected>Pilih Konsumen</option>
				<?php
				
					foreach($ips as $data){
					
						echo "<option value = ".$data['no_ips'].">".$data['nama_ips']."</option>";
					}
				?>
			  </select>
			  
			  <?php echo form_error('no_ips'); ?>
			
			</div>
		</div>
		
	
			<div class="col-xs-4">
				<div class="form-group">
			  <label>Jumlah</label>
			  <input type = "text" name = "jumlah" class = "form-control" >
			  
			  <?php echo form_error('jumlah'); ?>
			
			</div>
			</div>
			<!-- <div class="col-xs-4">
				<label>Tahun</label>
				<input type="text" class="form-control" name="harga" value="<?php echo $data['tahun'] ; ?>" readonly> 
			</div> -->
			</div>
	</div>
	<div class="form-group">
		<center>
	<a href = "<?php echo site_url()."/c_transaksi/lihat_penjs"?>" class="btn btn-default" role="button">Kembali</a>
	<?php if($cek_jml == $jumlah){?>

	<a href = "#" class="btn btn-primary" role="button" disabled="disabled">Simpan</a>
<?php }else { ?>
<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
<?php }?>
</center>

	</form>
		<hr>
<?php 
} 
?>
	
</div>

<br>
</div>
</div>
</div>

<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Detail Penjualan IPS</b></h3>
  </div>
  	 <div class="x_content">
<div>
		<div class="row" >

	<div class="col-md-12" >
		<div class="form-group">
			

		<table  class="table table-striped table-bordered table-hover jambo_table" >
		 	<thead>
			<tr class="headings">
				<th>Nama Konsumen IPS</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$total = 0;
			$total_jml = 0;
				foreach($detail as $data){
					
					echo "
							<tr>
							<td>".$data['nama_ips']."</td>
							<td>".$data['jumlah']."</td>
						
							
							<td>".format_rp($data['subtotal'])."</td>"; ?>
								

						</tr>
						
					<?php
					$no++;

				$total = $total + $data['subtotal'];
				$total_jml = $total_jml + $data['jumlah'];
				}
			?>
			<tr>
				<td>Total</td>
				<td><?php echo $total_jml; ?></td>
				<td><?php echo format_rp($total); ?></td>
			</tr>
			</tbody>

		</table>
		
	</div>
</div>
	</div>


	


	<?php if($status == '0'){ ?>
		
	<center>
		
		<a <?php if($cek_jml == $jumlah){?>href = "<?php echo site_url()."/c_transaksi/selesai_penjs/$id/$total/$jumlah/$tgl "?>" <?php }else{?> disabled="disabled" <?php }?> class="btn btn-info" role="button">Selesai</a>
	</center>
<?php 
		}else{ ?>

	<a href = "<?php echo site_url()."/c_transaksi/lihat_penjs"?>" class="btn btn-default" role="button">Kembali</a>
<?php } ?>
	</div>
	

</body>
</html>