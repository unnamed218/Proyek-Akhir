<html>
	<body>
	<!-- 	
	<center><h3><b>Jurnal</b></h3></center>
	<hr> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Jurnal</b></h3>
  </div>
  	 <div class="x_content">
  	 	<div class="row">
  	 		<div class="col-sm-7">
  	 	<form method="post" action="<?php echo site_url().'/c_keuangan/view_jurnal' ?> " class="form-inline">
		<label>Tanggal Awal :</label>
		<input type = "date" name="tgl_awal" class = "form-control" required="">
		<label>Tanggal Akhir :</label>
		<input type = "date" name="tgl_akhir" class = "form-control" required="">&nbsp&nbsp
	<input type="submit" value="filter" class="btn btn-info">
	</form>
</div>
<!-- <div class="col-sm-5">
	<?php if(isset($awal, $akhir)):?>
	<a href="<?php echo site_url()."/c_keuangan/jurnal_pdf_filter/$awal/$akhir"?>"  target="_blank" rel="nofollow" class="btn btn-success" role="button">Print</a>
	<a href="<?php echo site_url()."/c_keuangan/jurnal_excel_filter/$awal/$akhir"?>" target="_blank" rel="nofollow"  class="btn btn-success" role="button">Excel</a>
<?php endif ?>
	<a href="<?php echo site_url()."/c_keuangan/jurnal_pdf_all"?>"  target="_blank" rel="nofollow" class="btn btn-success" role="button">Print ALL</a>
	

	<a href="<?php echo site_url()."/c_keuangan/jurnal_excel_all"?>" target="_blank" rel="nofollow"  class="btn btn-success" role="button">Excel ALL</a>
	<?php if(isset($awal, $akhir)):?>
	<a href="<?php echo site_url()."/c_keuangan/view_jurnal"?>" class="btn btn-dark" role="button">Kembali</a>
	<?php endif ?>

</div> -->
<hr>

</div>

<p>
  	 <center><b>
  	 	<div style="font-size: 25px">
  	 	KPSBU Lembang</div>
  	 <div style="font-size: 20px">Jurnal</div>
  	 <?php if(isset($awal, $akhir)){?>
  	 <div style="font-size: 15px">
  	 	Periode <?php echo $awal?> s/d <?php echo $akhir; }?>
  	 </div>
</b>


  	 </center>
</p>

	 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
			<tr class="headings">
			<th style="width:2px">No</th>
			<th>Tanggal</th>

			<th>Keterangan</th>
			<th style="width:2px">Ref</th>
			<th>Debit</th>
			<th>Kredit</th>
		</tr>
	</thead>
	<tbody>

		<?php 
		$no = 0;

		$total =0;
		$total2 =0;
			foreach ($jurnal as $data)
			{	
								$no++;
				$tgl_jurnal = substr($data['tgl_jurnal'], 0,10);
				if($data['posisi_dr_cr'] == 'd'){
				echo"<tr>

					<td>$no</td>
						<td>".$tgl_jurnal."</td>";
					}else{
						echo"<tr>
						<td>$no</td>
								<td></td>";
					}

						
				if ($data['posisi_dr_cr']=='d')
				{
					
					echo"
					
					
						<td>".$data['nama_coa']."</td>
						<td>".$data['no_coa']."</td>
						<td align = 'right'>".format_rp($data['nominal'])."</td>
						<td align = 'right'></td>";
						$total = $total+$data['nominal'];
				}else{
					echo"
						<td align='center'>".$data['nama_coa']."</td>
						<td>".$data['no_coa']."</td>
						<td align = 'right'></td>
						<td align = 'right'>".format_rp($data['nominal'])."</td>
					</tr>
					
				";
				$total2=$total2+$data['nominal'];
				}
			}
		?>
		</tbody>
		<tr>
			<td colspan="4" align='center'>Total</td>
			<td align ="right"><?php echo format_rp($total) ; ?></td>
			<td align ="right"><?php echo format_rp($total2) ;?></td>
		</tr>
	
	</table>

	
	</body>
	</html>