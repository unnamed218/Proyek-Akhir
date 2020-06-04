<html>
<head></head>

<body>


<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Transaksi Produksi IPS</b></h3>
  </div>
  	 <div class="x_content">
<div>
	
		<div class="row">
		<div class="form-group">
			<div class="col-xs-2">
				<div class="form-group">
				<label>ID Produksi Pertama</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans ; ?>"  >
			</div>
		</div>
		<div class="col-xs-2">
				<div class="form-group">
				<label>ID Cek Kualitas</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_ck ; ?>"  >
			</div>
		</div>

			<div class="col-xs-2">
				<div class="form-group">
				<label>ID Pembelian Bahan Baku</label>
				<input readonly type="text" class="form-control"  value="<?php echo $no_trans_pembb ; ?>"  >
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
				<input readonly type="text" class="form-control"  value="Susu Sapi"  >
			</div>
		</div>

			<div class="col-xs-2">
				<div class="form-group">
				<label>Jumlah Produksi</label>
				<input readonly type="text" class="form-control"  value="<?php echo $jmlprod; ?> <?php echo $satuan?>"  >
			</div>
		</div>
			
			</div>
	</div>
		

		<div class="row" >

	<div class="col-md-12" >
		<hr>
		<h5><b>Bill Of Material</b></h5	>
		<table  class="table table-striped table-bordered table-hover jambo_table" >
		 	<thead>
			<tr class="headings">
				<th>Bahan Baku</th>
				<th>Kebutuhan</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Harga</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$total = 0;
				foreach($bom as $data){
					
					echo "
							<tr>
							<td>".$data['nama_bb']."</td>
							<td>".$data['jumlah']."</td>
							<td>".$data['jumlah']*$jmlprod."</td>
							<td>".$data['satuan']."</td>
							<td align='right'>".format_rp($data['harga'])."</td>
						
							
							<td align='right'>".format_rp($data['harga']*$data['jumlah'])."</td>"; ?>
							

						</tr>
						
					<?php
					$subtotal = $data['harga'] * $data['jumlah'] * $data['jumlahbb'];
					$total=$total+$subtotal;
					$no++;
				}
			?>
			<tr>
				<td colspan="5" align="center">Total</td>
				<td align="right"><?php echo format_rp($total) ?></td>
			</tr>
			</tbody>

		</table>
		
	</div>
	</div>

	<?php //end of tabel ?>
	<?php // tabel biaya produksi atau harga pokok produksinya ?>
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
			<?php
			$no=1;
			$total = 0;
				foreach($bom as $data){
					
					echo "
							<tr>
							<td>".$data['nama_bb']."</td>
							<td>".format_rp(round(($data['jumlahbb']*$data['jumlah'])*$data['harga']))."</td>
							<td>".format_rp(round($data['harga']))."</td>"; ?>
							

						</tr>
						
					<?php
					$subtotal = $data['harga'] * $data['jumlah'];
					$total= round(($data['jumlahbb']*$data['jumlah'])*$data['harga']);
					$no++;
				}
				$id = $no_trans;
				$jumlah = $data['jumlah'];
				$no_prod = 'PR_001';
			?>
			
			<tr>
				<th colspan="3">Biaya Tenaga Kerja</th>
			</tr>
			<tr>
				<td>Biaya Tenaga Kerja</td>
				<td><?php echo format_rp(round($btk))?> </td>
				<td><?php echo format_rp(round($btk / $jumlah))?></td>
				<?php $bbtk = round($btk); ?>
			</tr>
			<tr>
				<th colspan="3">Biaya Operasional Pabrik</th>
			</tr>
			<tr>
				<td colspan="3">Biaya Operasional Pabrik</td>
			</tr>
			<tr>

					<?php

			$no=1;
			$bbop = 0;
				foreach($bop as $data){

					echo "
					<tr>
							<td>".$data['nama_jbop']."</td>
							

							<td>".format_rp(ROUND($data['harga'] / $hari))."</td>
							
							<td>".format_rp(ROUND(($data['harga']/ $hari)/$jumlah))."</td>
							<tr>"; 
							$bbop = round($bbop + ($data['harga'] / $hari)); ?>
					<?php
					$no++;
				}
			?>
			</tr>
			<?php 
			$biaya_produksi = round($bbop + $bbtk + $total);
			?>
			<tr>
				<th>Biaya Produksi</th>
				<th><?php echo format_rp($biaya_produksi) ?></th>
				<th><?php echo format_rp(round($biaya_produksi / $jmlprod)) ?> </th> 
			</tr>

			</tbody>

		</table>
		
	</div>
	</div>

	<div class="row">
		<div class="col-md-11">
	<a href = "<?php echo site_url()."/c_transaksi/lihat_produksi_ke1"?>" class="btn btn-default" role="button">Kembali</a>
</div>
<div class="col-md-1">
  	 	<div style="align-items: : : right;">
	<!-- <a href = "<?php echo site_url()."/c_transaksi/selesai_produksi_ke1/$id/$total/$jumlah/$no_prod"?>" class="btn btn-dark" role="button">Produksi</a> -->
		<a class="btn btn-dark" role="button" <?php if($cek == '0'){?> href = "<?php echo site_url()."/c_transaksi/selesai_produksi_ke1/$id/$total/$jmlprod/$no_prod/$bbtk/$bbop"?>" <?php }else{?> hidden <?php } ?>>Produksi</a>
</div>
</div>

	</div>
	</div>
</div>




</body>
</html>