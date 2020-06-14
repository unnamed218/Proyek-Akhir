<html>
	<head>
	</head>
	<body>
		<!-- <center><h3>Pembelian</h3></center>
	 -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Kartu Persediaan</b></h3>
  </div>
  	 <div class="x_content">
  	 	<div class="row">
  	 		<!-- <div class="col-md-3">
  	 <a href = "<?php echo site_url()."/c_transaksi/form_pemb1"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Pembelian</a>&nbsp <a href = "<?php echo site_url()."/c_transaksi/form_pemakaian"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Pemakaian</a>
  	</div>   -->            
  	
  	 	<form method="post" action="<?php echo site_url().'/c_keuangan/lap_ks_prod' ?> " class="form-inline">
  	 		
		<div class="col-md-9">
			  <!-- <label>Nama Produk &nbsp&nbsp&nbsp</label> -->
			   <label>Produk :</label>
			  <select name="no_produk" class="form-control">
			  	<option value="#" disabled selected>Pilih Produk</option>
			 	 <?php
				foreach($produk as $data){
				echo "<option value = ".$data['no_produk'].">".$data['nama_produk']."</option>";
					}
				?>
			  </select>
			  <label>Tanggal Awal :</label>
		<input type = "date" name="tgl_awal" class = "form-control" required="">
		<label>Tanggal Akhir :</label>
		<input type = "date" name="tgl_akhir" class = "form-control" required="">&nbsp&nbsp
	
		
	<input type="submit" value="Cari" class="btn btn-info">
</div>
	</form>
</div>
<!-- <div class="row" style="margin-top: 10px; margin-left: 180px">
	<div class="col-md-9">
	</div>
	<div class="col-md-3">
		<?php if(isset($awal, $akhir,$no)):?>
	<a href="<?php echo site_url()."/c_transaksi/view_pemb_pdf/$awal/$akhir/$no"?>"  target="_blank" rel="nofollow" class="btn btn-success" role="button">Print</a>
	<a href="<?php echo site_url()."/c_transaksi/view_pemb_excel/$awal/$akhir/$no"?>" target="_blank" rel="nofollow"  class="btn btn-success" role="button">Excel</a>
<?php endif ?>
	
	<?php if(isset($awal, $akhir,$no)):?>
	<a href="<?php echo site_url()."/c_transaksi/view_trans"?>" class="btn btn-dark" role="button">Kembali</a>
	<?php endif ?> 
	</div>
</div> -->
<hr>
<p>
  	 <center><b>
  	 	<div style="font-size: 25px">
  	 	KPSBU Lembang</div>
  	 <div style="font-size: 20px">Kartu Persediaan</div>
  
  	  <?php if(isset($awal, $akhir)){?>
  	 <div style="font-size: 15px">
  	 	Periode <?php echo $awal?> s/d <?php echo $akhir; }?>
  	 </div>
</b>
</center>
</p>
<hr>
<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			<label>Nama Produk</label>
			<input type="text" class="form-control" value="<?php echo $produk1['nama_produk']?>" readonly>
		</div>
	</div>
	<div class="col-sm-6">
			<div class="form-group">
			<label>Satuan Produk</label>
			<input type="text" class="form-control" value="<?php echo $produk1['satuan']?>" readonly>
		</div>
	</div>
</div>

		 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
			<tr class="headings">
				<th rowspan="2"> <center>No</center></th>
				<th rowspan="2">Tanggal</th>
				<th rowspan="2">ID Trans</th>
				<th rowspan="2">Keterangan</th>
				<th colspan="3">Produksi</th>
				<th colspan="3">Penjualan</th>
				<th colspan="3">Saldo</th>
				
						</tr>
			
			<tr>
				<th>Unit</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Unit</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Unit</th>
				<th>Harga</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<tr>

			<?php 
			$no = 0;
			foreach($result as $data){
				
				$no++;
				$cek = substr($data['no_trans'],0,5);
				if($cek == 'PROD2'){
				$maka = 'Produksi Toko';
				}else{
				$maka = 'Penjualan Toko';
				}
			
			


				echo "
			<td>$no</td>
			<td>".$data['tgl_trans']."</td>
			<td>".$data['no_trans']."</td>
			<td>".$maka."</td>
			<td>".$data['jumlah']."</td>
			<td align='right'>".format_rp($data['rata'])."</td>
			<td align='right'>".format_rp($data['total_pmb'])."</td>
			<td>".$data['jumlah_bahan_baku']."</td>
			<td align='right'>".format_rp($data['harga_satuan'])."</td>
			<td align='right'>".format_rp($data['subtotal_pmk'])."</td>
			<td>".$data['unit']."</td>
			<td align='right'>".format_rp($data['ratatotal'])."</td>
			<td align='right'>".format_rp($data['total'])."</td>

			";
			$totalpmb =0;
			$totalpmk = 0;
			$total = 0;
			$unit = 0;
			$unitpmb = 0;
			$unitpmk = 0 ;
	echo "
	</tr>
		";	}
		?>
		
		</tbody>
	</table>
		
		
	</div>
</div>

	</body>
</html>

