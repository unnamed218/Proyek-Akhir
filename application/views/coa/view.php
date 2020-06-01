<html>
	<head><title>Master Data COA</title></head>
		<!-- <h3><center><b>Master Data COA</b></center></h3></head>
	
	<hr> -->
	
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar COA</b></h3>
  </div>
  	 <div class="x_content">

		<a href = "<?php echo site_url()."/c_masterdata/form_coa"?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
		 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
			<tr class="headings">
				<th>No COA</th>
				<th>Nama COA</th>
				<!-- <th>Jenis COA</th> -->
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
				foreach($result as $data){
					echo "
							<td>".$data['no_coa']."</td>
							<td>".$data['nama_coa']."</td>
							
							" ?>
							<!--<td align="center">
							<a class="btn btn-primary" href="isi_edit_COA/<?php echo $data['no_COA']; ?>">Ubah</a>
							</td>
							<td align="center">
							<a class="btn btn-warning" href="isi_edit_bb/<?php echo $data['no_bb']; ?>" onclick="return confirm('Yakin mau dihapus?')" class="btn btn-daner">Hapus</a>
					</td>-->
						</tr>
					<?php
					$no++;
				}
			?>
		</tbody>
		</table>


	</body>
</html>