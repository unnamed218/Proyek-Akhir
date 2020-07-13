<html>
	<head>
	</head>
		<?php  $namabulan = array(
      '0' => 'December',
      '01' => 'Januari',
      '02' => 'Februari',
      '03' => 'Maret',
      '04' => 'April',
      '05' => 'Mei',
      '06' => 'Juni',
      '07' => 'Juli',
      '08' => 'Agustus',
      '09' => 'September',
      '10' => 'Oktober',
      '11' => 'November',
      '12' => 'Desember',
      '1' => 'Januari',
      '2' => 'Februari',
      '3' => 'Maret',
      '4' => 'April',
      '5' => 'Mei',
      '6' => 'Juni',
      '7' => 'Juli',
      '8' => 'Agustus',
      '9' => 'September'
    );?>
	<!-- <center><h3><b>Buku Besar</h3></b></center> -->
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Buku Besar</b></h3>
  </div>
  	 <div class="x_content">
	<body>
  	 	<div class="row">
  	 		<div class="col-sm-8">
		<form class = 'form-inline' method = "POST" class = "form-inline" action = "<?php echo site_url().'/c_keuangan/view_bukubesar';?>">
		<label>Pilih Akun :</label> 
		  <select name = "no_akun" class = "form-control" >
			<option value="#" disabled selected>Pilih Akun</option>
			<?php
				foreach($akun as $data){
					echo "
						<option value = ".$data['no_coa'].">".$data['nama_coa']."</option>
					";
				}
			?>
		  </select>

		&nbsp&nbsp
				<label>Pilih Bulan :</label> 
				<select name="bulan" class="form-control">
					<option value="*" disabled selected>Pilih Bulan</option>
					<option value="1">Januari</option>
					<option value="2">Februari</option>
					<option value="3">Maret</option>
					<option value="4">April</option>
					<option value="5">Mei</option>
					<option value="6">Juni</option>
					<option value="7">Juli</option>
					<option value="8" >Agustus</option>
					<option value="9" >September</option>
					<option value="10" >Oktober</option>
					<option value="11" >November</option>
					<option value="12" >Desember</option>

					</select>
		
		&nbsp&nbsp
			<label>Pilih Tahun :</label>
			<select name="tahun" class="form-control">
				<option value="#" disabled selected>Pilih Tahun</option>
				<?php
				$now =date('Y');
				for ($a=2015;$a<=$now;$a++)

					{

     echo "<option value='".$a."'>".$a."</option>";

					}
				?>
				</select>
			&nbsp&nbsp
		
		  <button class = "btn btn-info btn-md" type = "submit">filter</button>
		</form>
	</div>
		<!-- <div class="col-sm-4">
	<?php if(isset($bulan, $tahun, $no_akun)):?>
	<a href="<?php echo site_url()."/c_keuangan/bukubesar_pdf_filter/$no_akun/$bulan/$tahun"?>"  target="_blank" rel="nofollow" class="btn btn-success" role="button">Print</a>
	<a href="<?php echo site_url()."/c_keuangan/bukubesar_excel_filter/$no_akun/$bulan/$tahun"?>" target="_blank" rel="nofollow"  class="btn btn-success" role="button">Excel</a>
<?php endif ?> -->
	<!-- <a href="<?php echo site_url()."/c_keuangan/bukubesar_pdf_all"?>"  target="_blank" rel="nofollow" class="btn btn-success" role="button">Print ALL</a>
	<a href="<?php echo site_url()."/c_keuangan/bukubesar_excel_all"?>" target="_blank" rel="nofollow"  class="btn btn-success" role="button">Excel ALL</a> -->
<!-- <?php if(isset($bulan, $tahun, $no_akun)):?>
	<a href="<?php echo site_url()."/c_keuangan/view_bukubesar"?>" class="btn btn-dark" role="button">Kembali</a>
	<?php endif ?>

</div> -->
</div>
<hr>
		<p>
  	 <center><b>
  	 	<div style="font-size: 25px">
  	 	KPSBU</div>
  	 <div style="font-size: 20px">Buku Besar <?php echo $dataakun['nama_coa']?></div>
  
  	 <div style="font-size: 15px">
  	 	Bulan <?php echo $namabulan[$bulan] ?> Tahun <?php echo $tahun; ?>
  	 </div>
</b>
</center>
</p>

<hr>
				 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		<thead>
			<tr class="headings">
				<th>Tanggal</th>
				<th>Keterangan</th>
				<th>Debit</th>
				<th>Kredit</th>
				<th>Saldo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			
				$saldo = ($saldoawal['debit'] - $saldoawal['kredit']);
				
				
				echo "
					<tr>
						<td>0000-00-00</td>
						<td>Saldo Awal</td>
						<td></td>
						<td></td>
						<td align = 'right'>".format_rp($saldo)."</td>
					</tr>
				";
				foreach($jurnal as $data){
					$header_akun = substr($data['no_coa'], 0,1);
					$header_akun2 = substr($data['no_coa'], 0,2);

					
					echo "
						<tr>
							<td>".$data['tgl_jurnal']."</td>
							<td>".$data['nama_coa']."</td>
						";
					if($data['posisi_dr_cr'] == 'd'){
							// $saldo = $saldo + $data['nominal'];
					
						if($header_akun == 1 or $header_akun == 5 or $header_akun == 6){
							$saldo = $saldo + $data['nominal'];
						}elseif($header_akun2 == 53){
							$saldo = $saldo - $data['nominal'];
						}else{
							$saldo = $saldo - $data['nominal'];
						}        
						echo "
							<td align = 'right'>".format_rp($data['nominal'])."</td>
							<td></td>
							<td align = 'right'>".format_rp($saldo)."</td>
						</tr>
						";
					}else{
							// if($saldoawal['debit'] == 0){
							// $saldo = $saldo + $data['nominal'];
							// }else{
							// $saldo = $saldo - $data['nominal'];
							// }
						if($header_akun == 1 or $header_akun == 5 or $header_akun == 6 ){
							$saldo = $saldo - $data['nominal'];
						}elseif($header_akun2 == 53){
							$saldo = $saldo + $data['nominal'];
						}else{
							$saldo = $saldo + $data['nominal'];
						}
						
						echo "
							<td></td>
							<td align = 'right'>".format_rp($data['nominal'])."</td>
							<td align = 'right'>".format_rp($saldo)."</td>
						</tr>
						";
					}
				}
				
			?>
		</tbody>
		<!-- <?php 
		echo "
					<tr>
						<td>0000-00-00</td>
						<td>Saldo Akhir</td>
						<td></td>
						<td></td>
						<td align = 'right'>".format_rp($saldo)."</td>
					</tr>
				";?>
		 --></table>
		
		<!--<a href = "<?php echo site_url().'/m_keuangan/view_jurnal';?>" class="btn btn-info" role="button">Lihat Jurnal Umum</a>
		<a href = "<?php echo site_url().'/c_transaksi/view_trans';?>" class="btn btn-info" role="button">Pembelian</a>-->
	</body>
</html>