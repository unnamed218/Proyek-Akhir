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
				<input readonly type="text" class="form-control"  value="<?php echo number($jumlah); ?> liter"  >
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
				<th>Bahan Baku</th>
				<th>Kebutuhan</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Harga</th>
				<th>Subtotal</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php 
				$pbdp = 0;
				$harga = $bombbb['nominal'] / $jumlah_produksi;
				$pbdp = $harga * $jumlah;
				?>
				<td >Susu Sapi</td>
				<td>1</td>
				<td><?php echo number($jumlah);?></td>
				<td>buah</td>
				<td align='right'><?php echo format_rp(round($bombbb['nominal'] / $jumlah_produksi))?></td>
				<td align="right"><?php echo format_rp(round($pbdp)) ?></td>

			</tr>
			<?php
			$no=1;
			$total = 0;
					$subtotal = 0;
				foreach($result2 as $data){
					$pengurang = $data['jumlah_bom'];
            $kode_bahan = $data['no_bbp'];

         $query111 = "SELECT * FROM detail_pembelian_bp
               WHERE no_bp = '$kode_bahan' AND 
               jumlah_kartu_stok > 0 
               ORDER by no ASC";
         $row = $this->db->query($query111)->result_array();
         		$subtotal3 = 0;
         		$jumlah2 = 0;
          		foreach($row as $row) {

				          $tgl  = $row['no'];
				          $stok = $row['jumlah_kartu_stok'];
				          if($pengurang > 0) { 
				              $temp = $pengurang;
				              $pengurang = $pengurang - $stok;
				              if($pengurang > 0) {      
				                  $stok_update = 0;
				              }else{
				                  $stok_update = $stok - $temp;
				              }
				          }
				          $jumlah1 = $row['jumlah'] - $stok_update;
				          $subtotal =$row['harga'] * $jumlah1;
				          $jumlah2 = $jumlah2 + $jumlah1;
				          $subtotal3 = $subtotal3 + $subtotal;
				          // var_dump($subtotal3);
				      }
				     
					
					echo "
							<tr>
							<td>".$data['nama_bp']."</td>
							<td>".number($data['jumlah'])."</td>
							
						

							<td>".number($data['jumlah_bom'])."</td>
							
							<td>".$data['satuan']."</td>
							<td align='right'>-</td>
							<td align='right'>".format_rp($subtotal3)."</td>"; ?>
								

						</tr>
						
					<?php
					
					$total = $total + $subtotal3;
					$no++;
				}
				$totalast = $total + $pbdp;
			?>
			<tr>
				<td colspan="5" align="center">Total</td>
				<td align="right"><?php echo format_rp(round($totalast)) ?></td>
			</tr>
			</tbody>

		</table>
	</div>
		</div>
	</div>


	<div class="row" >

	<div class="col-md-12" >
		<hr>
		<h5><b>Harga Pokok Produksi</b></h5	>
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
				<td><?php echo $bombbb['nama_coa']?></td>
				<td align='right'><?php echo format_rp(round($pbdp)) ?></td>
				<td align='right'><?php echo format_rp(round($pbdp/$jumlah)) ?></td>
				<?php $bbbb = $pbdp ?>
			</tr>
			<!-- ///////////////////////////////////////////////////////////////////////////////-->
			<tr>
				<th colspan="3">Biaya Tenaga Kerja</th>
			</tr>
			<tr>
				<td>Biaya Tenaga Kerja</td>
				<td align='right'><?php echo format_rp(round($btk))?> </td>
				<td align='right'><?php echo format_rp(round($btk / $jumlah))?></td>
				<?php $bbtk = $btk; ?>
			</tr>
			<!-- ///////////////////////////////////////////////////////////////////////////////-->
			
			
			
			<!-- ////////////////////////////////////////////////////////////////////////////////////////  -->
			<tr>
				<th colspan="3">Biaya Overhead Pabrik Variabel</th>
			</tr>
			

					<?php

			$no=1;
			$bbop = 0;
				foreach($bop as $data){

					echo "
					<tr>
							<td>".$data['nama_jbop']."</td>
							

							<td align='right'>".format_rp(round($data['harga']))."</td>
							
							<td align='right'>".format_rp(round($data['harga']/$jumlah))."</td>
							</tr>"; 
							$bbop = $bbop + $data['harga']; 
							?>
					<?php
					$no++;
				}
			?>
			
			<tr>
				<td colspan="3">Bahan Penolong</td>
			</tr>
			
					<?php
			$no=1;
			$bbp = 0;
				foreach($result2 as $data){
			$pengurang = $data['jumlah_bom'];
            $kode_bahan = $data['no_bbp'];

         $query111 = "SELECT * FROM detail_pembelian_bp
               WHERE no_bp = '$kode_bahan' AND 
               jumlah_kartu_stok > 0 
               ORDER by no ASC";
         $row = $this->db->query($query111)->result_array();
         		$subtotal4 = 0;
         		$jumlah4 = 0;
          		foreach($row as $row) {

				          $tgl  = $row['no'];
				          $stok = $row['jumlah_kartu_stok'];
				          if($pengurang > 0) { 
				              $temp = $pengurang;
				              $pengurang = $pengurang - $stok;
				              if($pengurang > 0) {      
				                  $stok_update = 0;
				              }else{
				                  $stok_update = $stok - $temp;
				              }
				          }
				          $jumlah1 = $row['jumlah'] - $stok_update;
				          $subtotal =$row['harga'] * $jumlah1;
				          $jumlah4 = $jumlah4 + $jumlah1;
				          $subtotal4 = $subtotal4 + $subtotal;
				          // var_dump($subtotal3);
				      }
				     
					
					echo "
					<tr>
							<td>".$data['nama_bp']."</td>
							

							<td align='right'>".format_rp(round($subtotal4))."</td>
							<td align='right'>".format_rp(round($subtotal/$jumlah))."</td>
						
							</tr>"; 
							$bbp = $bbp + $subtotal4 ?>
					<?php
					$no++;
				}
			?>
			<!-- ///////////////////////////////////////////////////////////////////////////////-->
			<?php 
			//total Harga Pokok Produksi
			$biaya_produksi =($bbop)  + ($bbtk) + ($bbp) + ($bbbb);
			$biaya_produksi_satuan = $biaya_produksi / $jumlah; 
			?>
			<tr>
				<th>Harga Pokok Produksi</th>
				<td align='right'><b><?php echo format_rp(round($biaya_produksi))?></b></td>
				<td align='right'><b><?php echo format_rp(round($biaya_produksi_satuan)) ?></b></td>

			</tr>

			</tbody>

		</table>
		
	</div>
	</div>


<div class="row">
		<div class="col-md-11">
	<a href = "<?php echo site_url()."/c_transaksi/isi_edit_produksi_ke21/$no_trans"?>" class="btn btn-default" role="button">Kembali</a>
</div>
<div class="col-md-1">
  	 	<div style="align-items: : : right;">
	<!-- <a href = "<?php echo site_url()."/c_transaksi/selesai_produksi_ke2/$id/$total/$jumlah/$no_prod"?>" class="btn btn-dark" role="button">Produksi</a> -->
		<a class="btn btn-dark" role="button" <?php if($cek == NULL){?> href = "<?php echo site_url()."/c_transaksi/selesai_produksi_ke2/$bbbb/$bbtk/$bbop/$bbp/$no_trans/$no_tp/$no_prod/$jumlah "?>" <?php }else{?> hidden <?php } ?>>Produksi</a>
</div>
</div>

	</div>


</div>
</div>
</div>




</body>
</html>