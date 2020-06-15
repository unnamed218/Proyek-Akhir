<html>
	<body>
	<!-- 	
	<center><h3><b>Jurnal</b></h3></center>
	<hr> --><?php  $namabulan = array(
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
      '9' => 'September',
    );?>
		<div class="x_panel">
 <div class="x_title">
    <h3 class="panel-title"><b>Daftar Laba Rugi</b></h3>
  </div>
  	 <div class="x_content">
  	 	<div class="row">
  	 		<div class="col-sm-8">
		<form class = 'form-inline' method = "POST" class = "form-inline" action = "<?php echo site_url().'/c_keuangan/lr';?>">
		
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

<p>
  	 <center><b>
  	 	<div style="font-size: 25px">
  	 	KPSBU Lembang
  	 </div>

  	 <div style="font-size: 20px">Laba Rugi</div>
  	 
  	
  	 
  	 	<center>
  	 	<div style="font-size: 20px">
  	 		<?php echo $namabulan[$bulan]?> <?php echo $tahun ; ?>

  	 </div>
  	</center>
</b>


  	 </center>
</p>

	 <table id="datatable" class="table table-striped table-bordered table-hover jambo_table">
		 	<thead>
			<tr class="headings">
			<th>Keterangan</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		<?php 
		$penj = 0;
		$hp = 0;
		$bbn = 0;
		$labakotor = 0;
		$lababersih = 0;

		foreach ($penjualan as $data) {
			# code...
			echo "
					<tr>
					<td colspan='2'><b>".$data['nama_coa']."</b></td>
					
					<td align='right'><b>".format_rp($data['nominal'])."</b></td>
					</tr>
					";
					$penj = $data['nominal'];
		}
		?>

		<?php 
		foreach ($hpp as $data) {
			# code...
			echo "
					<tr>
					<td><b>".$data['nama_coa']."</b></td>
					<td align='right'><b>".format_rp($data['nominal'])."</b></td>
					<td></td>
					</tr>
					";
					$hp = $data['nominal'];
					$labakotor = $penj - $hp;
		}
		?>
		<tr>
			<td><b>Laba Kotor</b></td>
			<td></td>
			<td align="right"><b><?php echo format_rp($labakotor)?></b></td>
		</tr>
		<tr>
			<td>Beban-beban</td>
			<td></td>
			<td></td>
		</tr>
		 <?php 
		foreach ($beban as $data) {
			# code...
			echo "
					<tr>
					<td>".$data['nama_coa']."</td>
					<td align='right'>".format_rp($data['nominal'])."</td>
					<td></td>
					</tr>
					";
					$bbn = $bbn + $data['nominal'];
		}
		$lababersih = $labakotor - $bbn;
		?> 
		<tr>
			<td><b>Total Beban</b></td>
			<td></td>
			<td align="right"><b><?php echo format_rp($bbn); ?></b></td>
		</tr>
		<tr>
			<td><b>Laba Bersih</b></td>
			<td></td>
			<td align="right"><b><?php echo format_rp($lababersih) ?></b></td>
		</tr>
		</tbody>
	
	</table>

	
	</body>
	</html>