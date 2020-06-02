<html>
	<!-- <head><center><h3><b>Master Data Produksi Pertama</b></h3></center></head>
	<hr> -->
	<body>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Laporan Biaya Produksi Olahan</b></h3>
  </div>
  	 <div class="x_content">
  	 		
  	 	 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
			<tr class="headings">
				<th style="width: 2px;">No</th>
				<th>ID Transaksi</th>
				<th>Tanggal Transaksi</th>
				<th>Total Transaksi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$total = 0;
			$totalbiaya = 0;
				foreach($result as $data){
					$total = $data['bbb'] + $data['btk'] + $data['bop'] + $data['bp'];
					echo "

						<tr><td>$no</td>
							<td>".$data['no_trans']."</td>
							<td>".$data['tgl_trans']."</td>
							<td align = 'right'>".format_rp($total)."</td>
							" ?>
							<td>
							<a href="detail_lap_bp_olahan0/<?php echo $data['no_trans']; ?>">
							
							<span class="fa-stack">
							  <i class="fa fa-square fa-stack-2x" style="color:#2A3F54;"></i>
							 <span class="glyphicon glyphicon-pencil fa-stack-1x" aria-hidden="true" style="color:white"></span>
							</span> </a>
							</td>
							<!--<td align="center">
							<a class="btn btn-warning" href="isi_edit_pemb/<?php echo $data['no_pemb']; ?>" onclick="return confirm('Yakin mau dihapus?')" class="btn btn-daner">Hapus</a>
					</td>-->

						</tr>
						
					<?php

					$no++;
					$totalbiaya = $totalbiaya + $total;
					
				}
			?>
			<tr>
			<td colspan="3" align='center'>Total</td>
			<td align ="right"><?php echo format_rp($totalbiaya) ; ?></td>
			<td></td>
		</tr>
			</tbody>
		</table>

	
	
	</body>
</html>