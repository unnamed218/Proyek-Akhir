<html>
	<head>
		<title>Transaksi Pembayaran Beban Variabel</title>
	</head>
	<body>
	<!-- <center><h3><b>Transaksi Pembayaran Beban</h3></b></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Pembayaran Beban Variabel</b></h3>
  </div>
  	 <div class="x_content">
<div>
		<div class="row">
	<div class="form-group">
			<div class="col-xs-6">
				<div class="form-group">
				<label>ID Transaksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $id ;?>" name="no_trans"  >
			</div>
		</div>
		
	
			<div class="col-xs-6">
				<div class="form-group">
				<label>Tanggal Transaksi</label>
				<input type="text" class="form-control"  value="<?php echo date('Y-m-d') ; ?>"readonly name="tgl_trans">
				</div>
			</div>
			
	</div>
	</div>
<div class="row">
	<div class="form-group">
<form method = "POST" action = "<?php echo site_url('c_transaksi/tambah_pembyv1');?>">
				<input readonly type="hidden" class="form-control"  value="<?php echo $id ; ?>"  name="no_trans">
				<input readonly type="hidden" class="form-control"  value="<?php echo date('Y-m-d') ; ?>"  name="tgl_trans">
	
			<div class="col-xs-4">
				<div class="form-group">
				<label>Jenis Beban Variabel</label>
						<select name = "no_coa" class = "form-control">
							    <option value="#" disabled selected>Pilih Beban Variabel</option>
								<?php				
								foreach($bebanv as $data){				
								echo "<option value = ".$data['no_coa'].">".$data['nama_coa']."</option>";
															}
								?>
								
						</select>

			  <?php echo form_error('no_coa'); ?>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
				<label>Tarif</label>
				<input type="text" class="form-control" name='tarif' >
			  <?php echo form_error('tarif'); ?>

				</div>
			</div>


			<div class="col-xs-4">
				<div class="form-group">
				<label>Produk</label>
						<select name = "no_produk" class = "form-control">
							    <option value="#" disabled selected>Pilih Produk</option>
								<?php				
								foreach($produk as $data){				
								echo "<option value = ".$data['no_produk'].">".$data['nama_produk']."</option>";
															}
								?>
								
						</select>

			  <?php echo form_error('no_produk'); ?>
				</div>
			</div>
			<center>
	<button type="submit" class="btn btn-dark">Tambah</button>
</center>
		
		</form>	
		</div>
	</div>
	
<hr>
<div class="row" >

	<div class="col-md-12" >
		<table  class="table table-striped table-bordered table-hover jambo_table" >
		 	<thead>
			<tr class="headings">
				<th>Nama Beban</th>
				<th>Nama Produk</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$total = 0;
				foreach($detail as $data){
				
					echo "
							<tr>
							<td>".$data['nama_coa']."</td>
							<td>".$data['nama_produk']."</td>
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
		<center>
	<a href = "<?php echo site_url()."/c_transaksi/lihat_pembyv"?>" class="btn btn-default" role="button">Kembali</a>
		<a href = "<?php echo site_url()."/c_transaksi/selesai_pembyv/$id/$total "?>" class="btn btn-info" role="button">Selesai</a>
	</center>
	</div>
	
	</div>
	
</div>
</div>
</div>
		
	</body>
</html>