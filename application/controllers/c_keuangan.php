<?php
class c_keuangan extends CI_Controller
{

	  function __construct(){
        parent:: __construct();
           date_default_timezone_set('Asia/Jakarta');
       if(empty($this->session->userdata('level'))){
            redirect('c_login/home');
        }
    }
	public function view_jurnal(){	   
		// if(!empty($this->session->userdata('level'))){
   
		if(isset($_POST['tgl_awal'], $_POST['tgl_akhir'])){
			
		$data['awal'] = $_POST['tgl_awal'];
		$data['akhir'] = $_POST['tgl_akhir'];
		$data['jurnal'] = $this->m_keuangan->GetDataJurnal();
		$this->template->load('template','jurnal', $data);
	}else{
		$data['jurnal'] = $this->m_keuangan->GetDataJurnal();
		$this->template->load('template','jurnal', $data);
		
	// }
	// 	 }else{
 //      redirect('c_login/home');
 //    }
	}
}

	public function jurnal_pdf_all(){
		$data['jurnal'] = $this->m_keuangan->getdatajurnalall();
		$this->template->load('template_pdf','jurnal_pdf', $data);
	}

	public function jurnal_pdf_filter($awal, $akhir){
		$data['jurnal'] = $this->m_keuangan->GetDataJurnalfilter($awal, $akhir);
		$this->template->load('template_pdf','jurnal_pdf', $data);
		//var_dump($awal);
	}

	public function jurnal_excel_all(){
		header("Content-type=application/vnd.ms.excel");
		header("Content-disposition: attachment; filename=Jurnal.xls");
		$data['jurnal']=$this->m_keuangan->getdatajurnalall();
		$this->load->view('jurnal_excel',$data);
		//$this->template->load('template','laporan_penj',$data);
	}
	public function jurnal_excel_filter($awal, $akhir){
		header("Content-type=application/vnd.ms.excel");
		header("Content-disposition: attachment; filename=Jurnal.xls");
		$data['jurnal'] = $this->m_keuangan->GetDataJurnalfilter($awal, $akhir);
		$this->load->view('jurnal_excel',$data);
		//$this->template->load('template','laporan_penj',$data);
	}

	
	public function view_bukubesar()
	{	
		   // if(!empty($this->session->userdata('level'))){
   
	if(isset($_POST['no_akun'], $_POST['bulan'])){
		date_default_timezone_set('Asia/Jakarta');
				$no_akun = $_POST['no_akun'];
				$bulan1 = $_POST['bulan'];
				$tahun1 = date("Y",strtotime($_POST['tahun']));;
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan = substr($cek, 3,2);
				$tahun = substr($cek, 6,5);
				$data['bulan'] = $_POST['bulan'];
				$data['tahun'] = $_POST['tahun'];
				$data['no_akun'] = $no_akun;
				$query = "SELECT sum(nominal) as debit , (SELECT sum(nominal) FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'k' order by no) AS kredit FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'd' 
					ORDER BY no";
				$data['saldoawal'] = $this->db->query($query)->row_array();
				$data['akun'] = $this->m_keuangan->GetDataAkun();
				$data['dataakun'] = $this->m_keuangan->GetSaldoAkun($no_akun);
				$data['jurnal'] = $this->m_keuangan->getdatabukubesar($no_akun, $bulan1, $tahun1);
				$this->template->load('template','bukubesar',$data);
				// var_dump($cek);
			}else{
				date_default_timezone_set('Asia/Jakarta');
				$no_akun = '1111';
				$bulan1 = date('m');
				$tahun1 = date('Y');
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan = substr($cek, 3,2);
				$tahun = substr($cek, 6,5);
				$query = "SELECT sum(nominal) as debit , (SELECT sum(nominal) FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'k' ) AS kredit FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'd' ";
				$data['bulan'] = date('m');
				$data['tahun'] = date('Y');
				$data['saldoawal'] = $this->db->query($query)->row_array();
				$data['akun'] = $this->m_keuangan->GetDataAkun();
				$data['dataakun'] = $this->m_keuangan->GetSaldoAkun($no_akun);
				$data['jurnal'] = $this->m_keuangan->getdatabukubesar($no_akun, $bulan1, $tahun1);
				$this->template->load('template','bukubesar',$data);
				// var_dump($data['saldoawal']);
			}
			 // }else{
    //   redirect('c_login/home');
    // }
	}

	// public function bukubesar_pdf_all(){
	// 	$data['jurnal'] = $this->m_keuangan->getdatajurnalall();
	// 	$this->template->load('template_pdf','jurnal_pdf', $data);
	// }

	public function bukubesar_pdf_filter($no_akun, $bulan5, $tahun5){

				$bulan1 = $bulan5;
				$tahun1 = date("Y",strtotime($tahun5));;
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan = substr($cek, 3,2);
				$tahun = substr($cek, 6,5);
				$data['bulan'] = $bulan5;
				$data['tahun'] = $tahun5;
				$query = "SELECT sum(nominal) as debit , (SELECT sum(nominal) FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'K' ) AS kredit FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'd' ";
				$data['saldoawal'] = $this->db->query($query)->row_array();
				$data['akun'] = $this->m_keuangan->GetDataAkun();
				$data['dataakun'] = $this->m_keuangan->GetSaldoAkun($no_akun);
				$data['jurnal'] = $this->m_keuangan->getdatabukubesar($no_akun, $bulan5, $tahun5);
		$this->template->load('template_pdf','bukubesar_pdf', $data);
		//var_dump($awal);
	}

	// public function bukubesar_excel_all(){
	// 	header("Content-type=application/vnd.ms.excel");
	// 	header("Content-disposition: attachment; filename=Jurnal.xls");
	// 	$data['jurnal']=$this->m_keuangan->getdatajurnalall();
	// 	$this->load->view('jurnal_excel',$data);
	// 	//$this->template->load('template','laporan_penj',$data);
	// }
	public function bukubesar_excel_filter($no_akun, $bulan5, $tahun5){
		header("Content-type=application/vnd.ms.excel");
		header("Content-disposition: attachment; filename=Buku Besar.xls");
				$bulan1 = $bulan5;
				$tahun1 = date("Y",strtotime($tahun5));;
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan = substr($cek, 3,2);
				$tahun = substr($cek, 6,5);
				$query = "SELECT sum(nominal) as debit , (SELECT sum(nominal) FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'K' ) AS kredit FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'd' ";
				$data['saldoawal'] = $this->db->query($query)->row_array();
				$data['akun'] = $this->m_keuangan->GetDataAkun();
				$data['dataakun'] = $this->m_keuangan->GetSaldoAkun($no_akun);
				$data['jurnal'] = $this->m_keuangan->getdatabukubesar($no_akun, $bulan5, $tahun5);
		$this->load->view('bukubesar_excel',$data);
		//$this->template->load('template','laporan_penj',$data);
	}


	//laporan pembelihan bahan baku
	public function lap_pemb(){
		 
   		if(isset($_POST['bulan'], $_POST['tahun'])){
   			$this->db->where('MONTH(tgl_trans)', $_POST['bulan']);
   			$this->db->where('YEAR(tgl_trans)', $_POST['tahun']);
   			$data['bulan'] = $_POST['bulan'];
   			$data['tahun'] = $_POST['tahun'];
   		}
		$data['result'] = $this->db->get('pembelian_bb')->result_array();
		$this->template->load('template','pemb/report', $data);
		
	}
	
	public function lap_pdf_all(){
		$data['result'] = $this->db->get('pembelian')->result_array();
		$this->template->load('template_pdf','laporan_pembelian_pdf', $data);
	}

	public function lap_pdf_filter($bulan, $tahun){
		$this->db->where('MONTH(tgl_trans)', $bulan);
   			$this->db->where('YEAR(tgl_trans)', $tahun);
   			$data['bulan'] = $bulan;
   			$data['tahun'] = $tahun;
		$data['result'] = $this->db->get('pembelian')->result_array();
		$this->template->load('template_pdf','laporan_pembelian_pdf', $data);
		//var_dump($awal);
	}

	public function lap_excel_all(){
		header("Content-type=application/vnd.ms.excel");
		header("Content-disposition: attachment; filename=Laporan Pembelian.xls");
		$data['result'] = $this->db->get('pembelian')->result_array();
		$this->load->view('laporan_pembelian_excel',$data);
	}
	public function lap_excel_filter($bulan, $tahun){
		header("Content-type=application/vnd.ms.excel");
		header("Content-disposition: attachment; filename=Laporan Pembelian.xls");
		$data['bulan'] = $bulan;
   		$data['tahun'] = $tahun;
		$this->db->where('MONTH(tgl_trans)', $bulan);
   		$this->db->where('YEAR(tgl_trans)', $tahun);
		$data['result'] = $this->db->get('pembelian')->result_array();
		// $this->template->load('template','laporan_pembelian', $data);
		$this->load->view('laporan_pembelian_excel', $data);
		//$this->template->load('template','laporan_penj',$data);
	}


	//laporan pembelian bahan penolong
	public function lap_pembp(){
		 
   		if(isset($_POST['bulan'], $_POST['tahun'])){
   			$this->db->where('MONTH(tgl_trans)', $_POST['bulan']);
   			$this->db->where('YEAR(tgl_trans)', $_POST['tahun']);
   			$data['bulan'] = $_POST['bulan'];
   			$data['tahun'] = $_POST['tahun'];
   		}
		$data['result'] = $this->db->get('pembelian_bp')->result_array();
		$this->template->load('template','pembp/report', $data);
		
	}


	//laporan penjualan ips
	public function lap_penjs(){
		 
   		if(isset($_POST['bulan'], $_POST['tahun'])){
   			$this->db->where('MONTH(tgl_trans)', $_POST['bulan']);
   			$this->db->where('YEAR(tgl_trans)', $_POST['tahun']);
   			$data['bulan'] = $_POST['bulan'];
   			$data['tahun'] = $_POST['tahun'];
   		}
		$data['result'] = $this->db->get('penjualan_ips')->result_array();
		$this->template->load('template','penjs/report', $data);
		
	}

	public function lap_penjt(){
		 
   		if(isset($_POST['bulan'], $_POST['tahun'])){
   			$this->db->where('MONTH(tgl_trans)', $_POST['bulan']);
   			$this->db->where('YEAR(tgl_trans)', $_POST['tahun']);
   			$data['bulan'] = $_POST['bulan'];
   			$data['tahun'] = $_POST['tahun'];
   		}
		$data['result'] = $this->db->get('penjualan_toko')->result_array();
		$this->template->load('template','penjt/report', $data);
		
	}


	//laporan biaya produksi IPS

	public function lap_bp_ips(){


			if(isset($_POST['bulan'], $_POST['tahun'])){
				$bulan1 = $_POST['bulan'];
				$tahun1 = $_POST['tahun'];
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);
				$bulan = $_POST['bulan'];
				// $bulan = '07';
				$tahun = $_POST['tahun'];
				$data['bulan'] = $bulan;
				$data['tahun'] = $tahun;
				$query1 = "SELECT ifnull(sum(bbb),0) as bbb, ifnull(sum(btk),0) as btk, ifnull(sum(jumlah),0) as jumlah, ifnull(sum(stok_jual),0) as jual
							FROM detail_produksi_ke1 a
							JOIN produksi_ke1 b ON a.no_trans = b.no_trans
							WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'";
				
				$bb = $this->db->query($query1)->row()->bbb;
				$data['bb'] = $bb;

				$btk = $this->db->query($query1)->row()->btk;
				$data['btk'] = $btk;

				$jml1 = $this->db->query($query1)->row()->jumlah;
				$data['jml'] = $jml1;

				$jual1 = $this->db->query($query1)->row()->jual;
				$totalbp = 0;
				$totalbp = $bb + $btk;
				$data['totalbp'] = $totalbp;
				

				$this->db->select_sum('produksi');
				$this->db->from('pembagian a');
				$this->db->join('detail_pembagian b', 'a.no_trans = b.no_trans');
				$this->db->join('detail_produksi_ke1 c', 'c.no_trans = a.no_trans_produksi1');
				$this->db->where('MONTH(a.tgl_trans)', $bulan);
				$this->db->where('YEAR(a.tgl_trans)', $tahun);
				$query111 = "SELECT IFNULL(SUM(produksi),0) as produksi
							FROM pembagian a
							JOIN detail_pembagian b ON a.no_trans = b.no_trans
							JOIN detail_produksi_ke1 c ON c.no_trans = a.no_trans_produksi1
							WHERE MONTH(a.tgl_trans) = '$bulan' AND YEAR(a.tgl_trans) = '$tahun'";
				// $akhir = $this->db->get()->row()->produksi;
					$akhir = $this->db->query($query111)->row()->produksi;
					$data['last'] = $akhir;
				
				if($akhir == TRUE){
					$totalakhir = ($akhir / $jml1) * $data['totalbp'];
					$data['jmlakhir'] = $akhir;
				}else{
					$totalakhir = 0;
					$data['jmlakhir'] = 0;
				}
				
				
				$data['akhir'] = $totalakhir;
				if($totalbp == TRUE){
					$data['hpprod'] = $data['totalbp'] - $data['akhir'];
					$data['hpprod1'] = $data['hpprod'] / ($jml1 - $akhir);
				}else{
					$data['hpprod'] = 0;
					$data['hpprod1'] = 0;
				}
					$query34 = "SELECT ifnull(sum(bbb+btk) * (sum(jual) / sum(jumlah)), 0) as nominal, sum(jual), sum(jumlah)
					FROM detail_produksi_ke1 a 
					JOIN produksi_ke1 b ON a.no_trans = b.no_trans
					JOIN pembagian c ON a.no_trans = c.no_trans_produksi1
					JOIN detail_pembagian d ON c.no_trans = d.no_trans
					WHERE no_produk = 'PR_001' AND MONTH(b.tgl_trans) = '$bulan11' AND YEAR(b.tgl_trans) = '$tahun11'
					
					group by no_produk";
					$cekawald1 = $this->db->query($query34)->row_array();
					$cekawald = $cekawald1['nominal'];
					
					

					$query35 = "SELECT ifnull(SUM(hpp), 0) as nominal
								FROM detail_penjualan_ips a 
								JOIN penjualan_ips b ON a.no_trans = b.no_trans
								WHERE no_produk = 'PR_001' AND MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11'
								
								group by no_produk";
					$cekawalk1 = $this->db->query($query35)->row_array();
					$cekawalk = $cekawalk1['nominal'];
					$data['cekawald'] = $cekawald;
					$data['cekawalk'] = $cekawalk;


					$query23 = "SELECT ifnull(SUM(hpp),0) as nominal, ifnull(sum(jumlah),0) as jumlah
								FROM detail_penjualan_ips a 
								JOIN penjualan_ips b ON a.no_trans = b.no_trans
								WHERE no_produk = 'PR_001' AND MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'
								";
					$cekakhir = $this->db->query($query23)->row_array();
					$filterakhir = $cekakhir['nominal'];
					$data['filterakhir'] = $filterakhir;
					$data['jumlahterjual'] = $cekakhir['jumlah'];
					if($filterakhir == TRUE){
						$data['hargasatuanterjual'] = $filterakhir / $cekakhir['jumlah'];
					}else{
						$data['hargasatuanterjual'] = 0;
					}
					// var_dump($data['jml']);

			}else{
			$bulan1 = date('m');
				$tahun1 = date('Y');
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);
				$bulan = date('m');
				// $bulan = '07';
				$tahun = date('Y');
				$data['bulan'] = $bulan;
				$data['tahun'] = $tahun;
				$query1 = "SELECT ifnull(sum(bbb),0) as bbb, ifnull(sum(btk),0) as btk,ifnull(sum(bop),0) as bop, ifnull(sum(jumlah),0) as jumlah
							FROM detail_produksi_ke1 a
							JOIN produksi_ke1 b ON a.no_trans = b.no_trans
							WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'";
				
				$bb = $this->db->query($query1)->row()->bbb;
				$data['bb'] = $bb;

				$btk = $this->db->query($query1)->row()->btk;
				$data['btk'] = $btk;

				$bop = $this->db->query($query1)->row()->bop;
				$data['bop'] = $bop;

				$jml1 = $this->db->query($query1)->row()->jumlah;
				$data['jml'] = $jml1;
				$totalbp = 0;
				$totalbp = $bb + $btk + $bop;
				$data['totalbp'] = $totalbp;
				if($totalbp == TRUE){
				$data['hargasatuan'] = $totalbp / $jml1	;
				}else{
				$data['hargasatuan'] = 0;
				}

				$this->db->select_sum('produksi');
				$this->db->from('pembagian a');
				$this->db->join('detail_pembagian b', 'a.no_trans = b.no_trans');
				$this->db->join('detail_produksi_ke1 c', 'c.no_trans = a.no_trans_produksi1');
				$this->db->where('MONTH(a.tgl_trans)', $bulan);
				$this->db->where('YEAR(a.tgl_trans)', $tahun);
				$akhir = $this->db->get()->row()->produksi;
				if($akhir == TRUE){
					$totalakhir = ($akhir / $jml1) * $data['totalbp'];
					$data['jmlakhir'] = $akhir;
				}else{
					$totalakhir = 0;
					$data['jmlakhir'] = $akhir;
				}
				
				
				$data['akhir'] = $totalakhir;
				if($totalbp == TRUE){
					$data['hpprod'] = $data['totalbp'] - $data['akhir'];
					$data['hpprod1'] = $data['hpprod'] / ($jml1 - $akhir);
				}else{
					$data['hpprod'] = 0;
					$data['hpprod1'] = 0;
				}

			$query34 = "SELECT ifnull(sum(bbb+btk) * (sum(jual) / sum(jumlah)), 0) as nominal
					FROM detail_produksi_ke1 a 
					JOIN produksi_ke1 b ON a.no_trans = b.no_trans
					JOIN pembagian c ON a.no_trans = c.no_trans_produksi1
					JOIN detail_pembagian d ON c.no_trans = d.no_trans
					WHERE no_produk = 'PR_001' AND MONTH(b.tgl_trans) = '$bulan11' AND YEAR(b.tgl_trans) = '$tahun11'
					
					group by no_produk";
					$cekawald1 = $this->db->query($query34)->row_array();
					$cekawald = $cekawald1['nominal'];
					
					
$query35 = "SELECT ifnull(SUM(hpp), 0) as nominal
								FROM detail_penjualan_ips a 
								JOIN penjualan_ips b ON a.no_trans = b.no_trans
								WHERE no_produk = 'PR_001' AND MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11'
								
								group by no_produk";
					$cekawalk1 = $this->db->query($query35)->row_array();
					$cekawalk = $cekawalk1['nominal'];
					$data['cekawald'] = $cekawald;
					$data['cekawalk'] = $cekawalk;


					$query23 = "SELECT ifnull(SUM(hpp),0) as nominal, ifnull(sum(jumlah),0) as jumlah
								FROM detail_penjualan_ips a 
								JOIN penjualan_ips b ON a.no_trans = b.no_trans
								WHERE no_produk = 'PR_001' AND MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'
								";
					$cekakhir = $this->db->query($query23)->row_array();
					$filterakhir = $cekakhir['nominal'];
					$data['filterakhir'] = $filterakhir;
					$data['jumlahterjual'] = $cekakhir['jumlah'];
					if($filterakhir == TRUE){
						$data['hargasatuanterjual'] = $filterakhir / $cekakhir['jumlah'];
					}else{
						$data['hargasatuanterjual'] = 0;
					}
			}
	// var_dump($cekawald);
      $this->template->load('template', 'biaya_prod_ips/view1', $data);



		

	}

	public function lap_bap_ips1(){

		if(isset($_POST['bulan'], $_POST['tahun'])){
   			$this->db->where('MONTH(tgl_trans)', $_POST['bulan']);
   			$this->db->where('YEAR(tgl_trans)', $_POST['tahun']);
   			$data['bulan'] = $_POST['bulan'];
   			$data['tahun'] = $_POST['tahun'];
   		}
		$this->db->select('a.no_trans, tgl_trans, bbb,btk,bop');
		$this->db->from('produksi_ke1 a');
		$this->db->join('detail_produksi_ke1 b', 'a.no_trans = b.no_trans');
		$this->db->order_by('a.no_trans');
		$data['result'] = $this->db->get()->result_array();
		$this->template->load('template', 'biaya_prod_ips/view', $data);
	
	}

	public function detail_lap_bp_ips($id){

		 $data['id'] = $id;
      $data['no_trans'] = $id; 
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('produksi_ke1')->row()->tgl_trans;


       $this->db->where('a.no_trans', $id);
       $this->db->join('cek_kualitas b', 'b.no_trans = a.no_trans_ck');
       $this->db->join('detail_pembelian_bb c', 'c.no_trans = b.no_trans_pembb');
       $this->db->join('bahan_baku d', 'd.no_bb = c.no_bb');
      $data['satuan'] = $this->db->get('produksi_ke1 a')->row()->satuan;

         $this->db->where('no_trans', $id);
      $id_ck = $this->db->get('produksi_ke1')->row()->no_trans_ck;
      $data['no_ck'] = $id_ck;

      $this->db->where('no_trans', $id_ck);
      $pembb = $this->db->get('cek_kualitas')->row()->no_trans_pembb;
      $data['no_trans_pembb'] = $pembb;
      
      //bom
      $this->db->select('a.jumlah, b.nama_bb, b.harga, b.satuan, e.lulus as jumlahbb');
      $this->db->from('bom a');
      $this->db->join('bahan_baku b', 'a.no_bbp = b. no_bb');
      $this->db->join('detail_pembelian_bb c', 'b.no_bb = c.no_bb');
      $this->db->join('cek_kualitas d', 'd.no_trans_pembb = c.no_trans ');
      $this->db->join('detail_cek_kualitas e', 'e.no_trans = d.no_trans');
      $this->db->where('c.no_trans', $pembb);
      $this->db->group_by('b.no_bb');

      $data['bom'] = $this->db->get()->result_array();  

        //biaya tenaga kerja
      $this->db->where('no_trans', $id);
      $tgl = $this->db->get('produksi_ke1')->row()->tgl_trans;
      $bulan1 = substr($tgl, 5,2);
      $tahun1 = substr($tgl, 0,4);

      $this->db->where('bulan', $bulan1);
      $this->db->where('tahun', $tahun1);
      $btk = $this->db->get('btk')->row()->tarif;
      $kalender = CAL_GREGORIAN;
      $hari = cal_days_in_month($kalender, $bulan1, $tahun1);
      $data['hari'] = $hari;
      $data['btk'] = $btk / $hari;

     
     //BIAYA BOP
      $this->db->where('bulan', $bulan1);
      $this->db->where('tahun', $tahun1);
      $this->db->select('a.no_bop,nama_jbop, harga');
      $this->db->from('bop a');
      $this->db->join('detail_bop b', 'a.no_bop = b.no_bop');
      $this->db->join('jenis_bop c', 'c.no_jbop = b.no_jbop');
      $data['bop'] = $this->db->get()->result_array();
    
     //jumlah produksi

      $this->db->where('no_trans',  $data['no_ck']);
      $data['jmlprod'] = $this->db->get('detail_cek_kualitas')->row()->lulus;

           //cek selesai produksi
      $this->db->where('no_trans', $id);
      $data['cek'] = $this->db->get('detail_produksi_ke1')->num_rows();


      
      $this->template->load('template', 'biaya_prod_ips/update', $data);

	}

		public function lap_bp_olahan(){
			$bulan1 = date('m');
				$tahun1 = date('Y');
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);
				$bulan = date('m');
				// $bulan = '07';
				$tahun = date('Y');
				$no_produk = 'PR_002';
 				$data['bulan'] = $bulan;
				$data['tahun'] = $tahun;
				$query1 = "SELECT ifnull(sum(bbb),0) as bbb, ifnull(sum(btk),0) as btk, ifnull(sum(jumlah),0) as jumlah
							FROM detail_produksi_ke2 a
							JOIN produksi_ke2 b ON a.no_trans = b.no_trans
							WHERE MONTH(a.tgl_trans) = '$bulan' AND YEAR(a.tgl_trans) = '$tahun' AND no_produk = '$no_produk'";
				
				$bb = $this->db->query($query1)->row()->bbb;
				$data['bb'] = $bb;

				$btk = $this->db->query($query1)->row()->btk;
				$data['btk'] = $btk;

				$query2 = "SELECT nama_bp, ifnull(sum(a.jumlah) * c.jumlah, 0) as jumlah, c.no_bbp, ifnull((sum(a.jumlah) * c.jumlah)*e.harga, 0) as biaya , a.no_produk
                  FROM detail_produksi_ke2 a
                  JOIN produk b ON a.no_produk = b.no_produk
                  JOIN bom c ON c.no_produk = b.no_produk
                  JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
                  JOIN detail_pembelian_bp e ON d.no_bp =  e.no_bp
                  WHERE NOT c.no_bbp = 'BB_001' AND a.no_produk = '$no_produk'
                  group by no_bbp";
                 $data['bp'] = $this->db->query($query2)->result_array();

				$jml1 = $this->db->query($query1)->row()->jumlah;
				$data['jml'] = $jml1;
				
				

			
		
      $this->template->load('template', 'biaya_prod_olahan/view1', $data);

		}

		public function lap_bp_olahan1(){


			if(isset($_POST['bulan'], $_POST['tahun'])){
   			$this->db->where('MONTH(b.tgl_trans)', $_POST['bulan']);
   			$this->db->where('YEAR(b.tgl_trans)', $_POST['tahun']);
   			$data['bulan'] = $_POST['bulan'];
   			$data['tahun'] = $_POST['tahun'];
   		}
   		$this->db->select_sum('bbb');
   		$this->db->select_sum('btk');
   		$this->db->select_sum('bop');
   		$this->db->select_sum('bp');
   		$this->db->select('a.no_trans, a.tgl_trans');
   		$this->db->from('produksi_ke2 a');
   		$this->db->join('detail_produksi_ke2 b', 'a.no_trans = b.no_trans');
   		$this->db->group_by('a.no_trans');
   		$data['result'] = $this->db->get()->result_array();
		// $query = "SELECT a.no_trans, a.tgl_trans, sum(bbb) as bbb, sum(btk) as btk, sum(bop) as bop, sum(bp) as bp
		// 		FROM produksi_ke2 a
		// 		JOIN detail_produksi_ke2 b ON a.no_trans = b.no_trans
		// 		GROUP BY a.no_trans";
		// $data['result'] = $this->db->query($query)->result_array();
      $this->template->load('template', 'biaya_prod_olahan/view', $data);
		}

		public function detail_lap_bp_olahan0($id){
			$data['id'] = $id;
      $data['no_trans'] = $id; 
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('produksi_ke2')->row()->tgl_trans;
      $this->db->where('no_trans', $id);
      $data['no_tp'] = $this->db->get('produksi_ke2')->row()->no_tp;

      $query = "SELECT COUNT(jumlah) as jumlah
               FROM produksi_ke2 a
               JOIN detail_target_produksi b ON a.no_tp = b.no_tp
               WHERE a.no_trans = '$id'";
      $data['jml_produk'] = $this->db->query($query)->row()->jumlah;


      $this->db->where('no_trans', $id);
      $this->db->from('produksi_ke2 a');
      $this->db->join('detail_target_produksi b', 'a.no_tp = b.no_tp');
      $this->db->join('produk c', 'c.no_produk = b.no_produk');
      $data['detail'] = $this->db->get()->result_array();

      $this->template->load('template', 'biaya_prod_olahan/update0', $data);
		}

	public function detail_bp_olahan($id,$no_tp,$no_prod){
		$data['id'] = $id;
      $data['no_trans'] = $id; 
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('produksi_ke2')->row()->tgl_trans;
      $data['no_tp'] = $no_tp;
      $data['no_prod'] = $no_prod;

   

      //nama produk
      $this->db->where('no_produk', $no_prod);
      $data['nama_produk'] = $this->db->get('produk')->row()->nama_produk;

      //jumlah produksi
      $this->db->where('no_tp', $no_tp);
      $this->db->where('no_produk', $no_prod);
      $data['jumlah'] = $this->db->get('detail_target_produksi')->row()->jumlah;

      //jumlah produk yang di produksi
       $query = "SELECT COUNT(jumlah) as jumlah, sum(jumlah) as total
               FROM produksi_ke2 a
               JOIN detail_target_produksi b ON a.no_tp = b.no_tp
               WHERE a.no_trans = '$id'";
       $jml_produk = $this->db->query($query)->row()->total;
       $data['jml_produk'] = $jml_produk;
       $presentase = ((($data['jumlah'] / $jml_produk) * 100) / 100);
       $data['presentase'] = $presentase;

       //bom bbb
       $this->db->where('no_tp', $no_tp);
       $id_pembagian = $this->db->get('target_produksi')->row()->no_trans_pembagian;

       $this->db->where('id_jurnal', $id_pembagian);
       $this->db->where('a.no_coa', '1114');
       $this->db->select('nama_coa, nominal');
       $this->db->from('jurnal a');
       $this->db->join('coa b', 'a.no_coa = b.no_coa');
       $data['bombbb'] = $this->db->get()->row_array();
      
      //bom
      
       $query1 =   "
                  SELECT nama_bp, sum(a.jumlah) * c.jumlah as jumlah_bom, d.harga, d.satuan, c.no_bbp,c.jumlah
                  FROM detail_target_produksi a
                  JOIN produk b ON a.no_produk = b.no_produk
                  JOIN bom c ON c.no_produk = b.no_produk
                  JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
                  WHERE a.no_tp = '$no_tp' AND NOT c.no_bbp = 'BB_001' AND a.no_produk = '$no_prod'
                  group by no_bbp";
      $data['result2'] = $this->db->query($query1)->result_array();
    
      
      //biaya biaya
      //bahan baku
     
      //bahan penolong
      $query3 = "SELECT nama_bp, sum(a.jumlah) * c.jumlah * d.harga as biaya, d.harga, d.satuan, c.no_bbp
                  FROM detail_target_produksi a
                  JOIN produk b ON a.no_produk = b.no_produk
                  JOIN bom c ON c.no_produk = b.no_produk
                  JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
                  WHERE a.no_tp = '$no_tp' AND NOT c.no_bbp = 'BB_001' AND a.no_produk = '$no_prod'
                  group by no_bbp";
      $data['bp'] = $this->db->query($query3)->result_array();


      //biaya tenaga kerja
      $this->db->where('no_trans', $id);
      $tgl = $this->db->get('produksi_ke2')->row()->tgl_trans;
      $bulan1 = substr($tgl, 5,2);
      $tahun1 = substr($tgl, 0,4);

      $this->db->where('bulan', $bulan1);
      $this->db->where('tahun', $tahun1);
      $btk = $this->db->get('btk')->row()->tarif;
      $kalender = CAL_GREGORIAN;
      $hari = cal_days_in_month($kalender, $bulan1, $tahun1);
      $data['hari'] = $hari;
      $data['btk'] = ($btk / $hari) *$presentase;

     
     //BIAYA BOP
      $this->db->where('bulan', $bulan1);
      $this->db->where('tahun', $tahun1);
      $this->db->select('a.no_bop,nama_jbop, harga');
      $this->db->from('bop a');
      $this->db->join('detail_bop b', 'a.no_bop = b.no_bop');
      $this->db->join('jenis_bop c', 'c.no_jbop = b.no_jbop');
      $data['bop'] = $this->db->get()->result_array();



      //cek selesai produksi
      $this->db->where('no_trans', $id);
      $data['cek'] = $this->db->get('detail_produksi_ke2')->num_rows();


      
      $this->template->load('template', 'biaya_prod_olahan/update', $data);

	}

	
	public function lap_pemby(){

		if(isset($_POST['bulan'], $_POST['tahun'])){
   			$this->db->where('MONTH(tgl_trans)', $_POST['bulan']);
   			$this->db->where('YEAR(tgl_trans)', $_POST['tahun']);
   			$data['bulan'] = $_POST['bulan'];
   			$data['tahun'] = $_POST['tahun'];
   		}
		$data['result'] = $this->db->get('pembayaran')->result_array();
		$this->template->load('template','pemby/report', $data);
	}
	


	public function lap_ks_prod(){
		 if(isset($_POST['no_produk'])){
       $no = $_POST['no_produk'];
       $awal = $_POST['tgl_awal'];
       $akhir = $_POST['tgl_akhir'];
        $data['no'] = $no;
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
     
        $this->db->where('no_produk', $no);
        $data['produk1'] = $this->db->get('produk')->row_array();
        $query = "SELECT * FROM produk WHERE stok > 0";
      $data['produk'] = $this->db->query($query)->result_array();
        // $data['produk'] = $this->db->get('produk')->result_array();
     $query1 = "SELECT no_trans, a.no_produk, nama_produk, tgl_trans, 
     			ifnull(unit1,0) as unit1,
     			ifnull(unit2,0) as unit2,
     			ifnull(unit3,0) as unit3,
     			ifnull(harga1,0) as harga1,
     			ifnull(harga2,0) as harga2,
     			ifnull(harga3,0) as harga3,
     			ifnull(total1,0) as total1,
     			ifnull(total2,0) as total2,
     			ifnull(total3,0) as total3
     			FROM kartu_stok_penj a 
     			JOIN produk b ON a.no_produk = b.no_produk

WHERE a.no_produk = '$no' AND a.tgl_trans >= '$awal' AND a.tgl_trans <= '$akhir'
GROUP BY a.no
ORDER BY a.no ASC";

        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','penjt/stock_card',$data);
      }else{
        $no = 'PR_002';
      
        $this->db->where('no_produk', $no);
        $data['produk1'] = $this->db->get('produk')->row_array();
         $query = "SELECT * FROM produk WHERE stok > 0";
      $data['produk'] = $this->db->query($query)->result_array();
     $query1 = "SELECT no_trans, a.no_produk, nama_produk, tgl_trans, 
     			ifnull(unit1,0) as unit1,
     			ifnull(unit2,0) as unit2,
     			ifnull(unit3,0) as unit3,
     			ifnull(harga1,0) as harga1,
     			ifnull(harga2,0) as harga2,
     			ifnull(harga3,0) as harga3,
     			ifnull(total1,0) as total1,
     			ifnull(total2,0) as total2,
     			ifnull(total3,0) as total3
     			FROM kartu_stok_penj a 
     			JOIN produk b ON a.no_produk = b.no_produk

WHERE a.no_produk = 'PR_002' 
GROUP BY a.no
ORDER BY a.no ASC";


        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','penjt/stock_card',$data);
      }
	}

	

	public function lap_ks_prod1(){
		 if(isset($_POST['tgl_awal'], $_POST['tgl_akhir'])){
       $no = 'PR_001';
       $awal = $_POST['tgl_awal'];
       $akhir = $_POST['tgl_akhir'];
        $data['no'] = $no;
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
     
        $this->db->where('no_produk', $no);
        $data['produk1'] = $this->db->get('produk')->row_array();
        $data['produk'] = $this->db->get('produk')->result_array();
     $query1 = "SELECT a.tgl_trans, a.no_trans, ifnull((z.stok_jual), '0') as jumlah, 
                    ifnull(round(((z.bbb+z.btk+z.bop)* (z.stok_jual /z.jumlah))/z.stok_jual), '0') as rata, 
                    ifnull(round(((z.bbb+z.btk+z.bop)* (z.stok_jual /z.jumlah))),'0') as total_pmb,  
                    ifnull(sum(c.jumlah),'0') as jumlah_bahan_baku, 
                    ifnull(sum(c.subtotal)/sum(c.jumlah),'0') as harga_satuan, 
                    ifnull(sum(c.subtotal),'0') as subtotal_pmk, 
                    ifnull((a.unit),'0') as unit, 
                    ifnull((a.total),'0') as total, 
                    ifnull(round(a.total/a.unit), '0') as ratatotal 
                    FROM kartu_stok_penj_ips a 
LEFT JOIN pembagian e ON e.no_trans = a.no_trans
LEFT JOIN detail_produksi_ke1 z ON z.no_trans = e.no_trans_produksi1
RIGHT JOIN produk x ON x.no_produk = a.no_produk
LEFT JOIN detail_penjualan_ips c ON c.no_trans = a.no_trans
LEFT JOIN pembagian d ON d.no_trans_produksi1 = z.no_trans
WHERE a.no_produk = 'PR_001' AND a.tgl_trans >= '$awal' AND a.tgl_trans <= '$akhir'
GROUP BY a.no, a.no_produk, a.no_trans";

        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','penjs/stock_card',$data);
      }else{
        $no = 'PR_001';
      
        $this->db->where('no_produk', $no);
        $data['produk1'] = $this->db->get('produk')->row_array();
        $data['produk'] = $this->db->get('produk')->result_array();
     $query1 = "SELECT a.tgl_trans, a.no_trans, ifnull((z.stok_jual), '0') as jumlah, 
                    ifnull(round(((z.bbb+z.btk+z.bop)* (z.stok_jual /z.jumlah))/z.stok_jual), '0') as rata, 
                    ifnull(round(((z.bbb+z.btk+z.bop)* (z.stok_jual /z.jumlah))),'0') as total_pmb,  
                    ifnull(c.jumlah,'0') as jumlah_bahan_baku, 
                    ifnull(c.subtotal/c.jumlah,'0') as harga_satuan, 
                    ifnull(c.subtotal,'0') as subtotal_pmk, 
                    ifnull((a.unit),'0') as unit, 
                    ifnull((a.total),'0') as total, 
                    ifnull(round(a.total/a.unit), '0') as ratatotal 
                    FROM kartu_stok_penj_ips a 
LEFT JOIN pembagian e ON e.no_trans = a.no_trans
LEFT JOIN detail_produksi_ke1 z ON z.no_trans = e.no_trans_produksi1
RIGHT JOIN produk x ON x.no_produk = a.no_produk
LEFT JOIN detail_penjualan_ips c ON c.no_trans = a.no_trans
LEFT JOIN pembagian d ON d.no_trans_produksi1 = z.no_trans

WHERE a.no_produk = 'PR_001'
GROUP BY a.no";


        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','penjs/stock_card',$data);
      }
	}

	public function lap_ks_bb(){
		 if(isset($_POST['no_bb'])){
       $no = $_POST['no_bb'];
       $awal = $_POST['tgl_awal'];
       $akhir = $_POST['tgl_akhir'];
        $data['no'] = $no;
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
     
        $this->db->where('no_bb', $no);
        $data['bahan_baku1'] = $this->db->get('bahan_baku')->row_array();
        $data['bahan_baku'] = $this->db->get('bahan_baku')->result_array();
     $query1 = "SELECT a.tgl_trans, a.no_trans, ifnull((d.lulus), '0') as jumlah, 
                    ifnull((z.subtotal)*(d.lulus/z.jumlah) / d.lulus, '0') as rata, 
                    ifnull((z.subtotal)*(d.lulus/z.jumlah),'0') as total_pmb,  
                    ifnull((c.jumlah),'0') as jumlah_bahan_baku, 
                    ifnull((c.bbb)/c.jumlah,'0') as harga_satuan, 
                    ifnull((c.bbb),'0') as subtotal_pmk, 
                    ifnull((a.unit),'0') as unit, 
                    ifnull((a.total),'0') as total, 
                    ifnull(round(a.total/a.unit), '0') as ratatotal 
                    FROM kartu_stok_bb a 
LEFT JOIN cek_kualitas e ON e.no_trans = a.no_trans
LEFT JOIN detail_pembelian_bb z ON z.no_trans = e.no_trans_pembb
RIGHT JOIN bahan_baku x ON x.no_bb = a.no_bb
LEFT JOIN detail_produksi_ke1 c ON c.no_trans = a.no_trans
LEFT JOIN detail_cek_kualitas d ON d.no_trans = e.no_trans

WHERE a.no_bb = '$no' AND a.tgl_trans >= '$awal' AND a.tgl_trans <= '$akhir'
GROUP BY a.no";

        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','bb/stock_card',$data);
      }else{
        $no = 'BB_001';
      
        $this->db->where('no_bb', $no);
        $data['bahan_baku1'] = $this->db->get('bahan_baku')->row_array();
        $data['bahan_baku'] = $this->db->get('bahan_baku')->result_array();
     $query1 = "SELECT a.tgl_trans, a.no_trans, ifnull((d.lulus), '0') as jumlah, 
                    ifnull((z.subtotal)*(d.lulus/z.jumlah) / d.lulus, '0') as rata, 
                    ifnull((z.subtotal)*(d.lulus/z.jumlah),'0') as total_pmb,  
                    ifnull((c.jumlah),'0') as jumlah_bahan_baku, 
                    ifnull((c.bbb)/c.jumlah,'0') as harga_satuan, 
                    ifnull((c.bbb),'0') as subtotal_pmk, 
                    ifnull((a.unit),'0') as unit, 
                    ifnull((a.total),'0') as total, 
                    ifnull(round(a.total/a.unit), '0') as ratatotal 
                    FROM kartu_stok_bb a 
LEFT JOIN cek_kualitas e ON e.no_trans = a.no_trans
LEFT JOIN detail_pembelian_bb z ON z.no_trans = e.no_trans_pembb
RIGHT JOIN bahan_baku x ON x.no_bb = a.no_bb
LEFT JOIN detail_produksi_ke1 c ON c.no_trans = a.no_trans
LEFT JOIN detail_cek_kualitas d ON d.no_trans = e.no_trans

WHERE a.no_bb = '$no'
GROUP BY a.no";


        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','bb/stock_card',$data);
      }
	}

	public function lap_ks_bp(){
		 if(isset($_POST['no_bp'])){
       $no = $_POST['no_bp'];
       $awal = $_POST['tgl_awal'];
       $akhir = $_POST['tgl_akhir'];
        $data['no'] = $no;
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
     
        $this->db->where('no_bp', $no);
        $data['bahan_penolong1'] = $this->db->get('bahan_penolong')->row_array();
        $data['bahan_penolong'] = $this->db->get('bahan_penolong')->result_array();
     $query1 = "SELECT no_trans, a.no_bp, nama_bp, tgl_trans, 
     			ifnull(unit1,0) as unit1,
     			ifnull(unit2,0) as unit2,
     			ifnull(unit3,0) as unit3,
     			ifnull(harga1,0) as harga1,
     			ifnull(harga2,0) as harga2,
     			ifnull(harga3,0) as harga3,
     			ifnull(total1,0) as total1,
     			ifnull(total2,0) as total2,
     			ifnull(total3,0) as total3
     			FROM kartu_stok_bp a 
     			JOIN bahan_penolong b ON a.no_bp = b.no_bp

WHERE a.no_bp = '$no' AND a.tgl_trans >= '$awal' AND a.tgl_trans <= '$akhir'
GROUP BY a.no
ORDER BY a.no ASC";

        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','bp/stock_card',$data);
      }else{
        $no = 'BP_001';
      
      $this->db->where('no_bp', $no);
        $data['bahan_penolong1'] = $this->db->get('bahan_penolong')->row_array();
        $data['bahan_penolong'] = $this->db->get('bahan_penolong')->result_array();
     $query1 = "SELECT no_trans, a.no_bp, nama_bp, tgl_trans, 
     			ifnull(unit1,0) as unit1,
     			ifnull(unit2,0) as unit2,
     			ifnull(unit3,0) as unit3,
     			ifnull(harga1,0) as harga1,
     			ifnull(harga2,0) as harga2,
     			ifnull(harga3,0) as harga3,
     			ifnull(total1,0) as total1,
     			ifnull(total2,0) as total2,
     			ifnull(total3,0) as total3
     			FROM kartu_stok_bp a 
     			JOIN bahan_penolong b ON a.no_bp = b.no_bp

WHERE a.no_bp = 'BP_001'
GROUP BY a.no
ORDER BY a.no ASC";


        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','bp/stock_card',$data);
      }
	}

	public function lr1(){

		if(isset($_POST['bulan'],$_POST['tahun'])){
			$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		//baris produk
		$this->db->or_not_like('no_produk', 'PR_001');
		$data['list_produk'] = $this->db->get('produk')->result_array();

		////////////IPS IPS IPS IPS
		$qpenj0 = "SELECT ifnull(sum(nominal),0) as nominal
					FROM jurnal
					WHERE posisi_dr_cr = 'k' AND no_coa = '4111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$penjs = $this->db->query($qpenj0)->row_array()['nominal'];
		$data['penjs'] = $penjs;

		$qhpp0 =  "SELECT ifnull(sum(nominal),0) as hpp
					FROM jurnal
					WHERE posisi_dr_cr = 'd' AND no_coa = '6111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$hppips = $this->db->query($qhpp0)->row_array()['hpp'];
		$data['hppips'] = $hppips;
		$data['laba_kotor_ips'] = $data['penjs'] - $data['hppips'];

		$qbebanips = "SELECT ifnull(sum(subtotal),0) as subtotal, c.no_coa, nama_coa
					FROM (SELECT * FROM pembayaran WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun')as a 
					JOIN (SELECT * FROM detail_pembayaran WHERE jenis_penjualan = 'ips')as b ON a.no_trans = b.no_trans
					RIGHT JOIN coa c ON c.no_coa = b.no_coa
					GROUP BY no_coa
					ORDER BY no_coa ASC
                    ";
		$ibbn = $this->db->query($qbebanips)->result_array();
		$data['ipsbeban'] = $ibbn;

		//TOTAL TOKOOOO
		$qpenjt = "SELECT ifnull(sum(subtotal), 0) as penjualan, ifnull(sum(hpp), 0) as hpp
					FROM detail_penjualan_toko a 
					JOIN penjualan_toko b ON  a.no_trans = b.no_trans 
					WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'";

		$data['penj_toko'] = $this->db->query($qpenjt)->row_array()['penjualan'];
		$data['hpp_toko'] = $this->db->query($qpenjt)->row_array()['hpp'];
		$data['laba_kotor_toko'] = $data['penj_toko'] - $data['hpp_toko'];

		
		//list tokooooooooooooooooooooooooooooooooooo

		$qpenj1 = "SELECT ifnull(sum(subtotal), 0) as nominal, b.no_produk, ifnull(sum(hpp),0) as hpp, ifnull((sum(subtotal) - sum(hpp)), 0) as laba_kotor
					FROM (SELECT * FROM penjualan_toko WHERE month(tgl_trans) ='$bulan' AND YEAR(tgl_trans) = '$tahun') as ab
                    JOIN detail_penjualan_toko c ON ab.no_trans = c.no_trans
                    RIGHT JOIN produk b ON c.no_produk = b.no_produk 
                    WHERE b.no_produk NOT LIKE 'PR_001'
					GROUP BY b.no_produk 
					ORDER BY b.no_produk ASC";
		$penjt = $this->db->query($qpenj1)->result_array();
		$data['penjt'] = $penjt;

		$qbebantoko = "SELECT ifnull(sum(subtotal),0) as subtotal, c.no_coa, nama_coa
					FROM (SELECT * FROM pembayaran WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun')as a 
					JOIN (SELECT * FROM detail_pembayaran WHERE jenis_penjualan = 'toko')as b ON a.no_trans = b.no_trans
					RIGHT JOIN coa c ON c.no_coa = b.no_coa
					GROUP BY no_coa
					ORDER BY no_coa ASC
                    ";
		$tbbn = $this->db->query($qbebantoko)->result_array();
		$data['tokobeban'] = $tbbn;



		}else{
		$bulan = date('m');
		$tahun = date('Y');
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		//baris produk
		$this->db->or_not_like('no_produk', 'PR_001');
		$data['list_produk'] = $this->db->get('produk')->result_array();

		////////////IPS IPS IPS IPS
		$qpenj0 = "SELECT ifnull(sum(nominal),0) as nominal
					FROM jurnal
					WHERE posisi_dr_cr = 'k' AND no_coa = '4111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$penjs = $this->db->query($qpenj0)->row_array()['nominal'];
		$data['penjs'] = $penjs;

		$qhpp0 =  "SELECT ifnull(sum(nominal),0) as hpp
					FROM jurnal
					WHERE posisi_dr_cr = 'd' AND no_coa = '6111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$hppips = $this->db->query($qhpp0)->row_array()['hpp'];
		$data['hppips'] = $hppips;
		$data['laba_kotor_ips'] = $data['penjs'] - $data['hppips'];

		$qbebanips = "SELECT ifnull(sum(subtotal),0) as subtotal, c.no_coa, nama_coa
					FROM (SELECT * FROM pembayaran WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun')as a 
					JOIN (SELECT * FROM detail_pembayaran WHERE jenis_penjualan = 'ips')as b ON a.no_trans = b.no_trans
					RIGHT JOIN coa c ON c.no_coa = b.no_coa
					GROUP BY no_coa
					ORDER BY no_coa ASC
                    ";
		$ibbn = $this->db->query($qbebanips)->result_array();
		$data['ipsbeban'] = $ibbn;

		//TOTAL TOKOOOO
		$qpenjt = "SELECT ifnull(sum(subtotal), 0) as penjualan, ifnull(sum(hpp), 0) as hpp
					FROM detail_penjualan_toko a 
					JOIN penjualan_toko b ON  a.no_trans = b.no_trans 
					WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'";

		$data['penj_toko'] = $this->db->query($qpenjt)->row_array()['penjualan'];
		$data['hpp_toko'] = $this->db->query($qpenjt)->row_array()['hpp'];
		$data['laba_kotor_toko'] = $data['penj_toko'] - $data['hpp_toko'];

		
		//list tokooooooooooooooooooooooooooooooooooo

		$qpenj1 = "SELECT ifnull(sum(subtotal), 0) as nominal, b.no_produk, ifnull(sum(hpp),0) as hpp, ifnull((sum(subtotal) - sum(hpp)), 0) as laba_kotor
					FROM (SELECT * FROM penjualan_toko WHERE month(tgl_trans) ='$bulan' AND YEAR(tgl_trans) = '$tahun') as ab
                    JOIN detail_penjualan_toko c ON ab.no_trans = c.no_trans
                    RIGHT JOIN produk b ON c.no_produk = b.no_produk 
                    WHERE b.no_produk NOT LIKE 'PR_001'
					GROUP BY b.no_produk 
					ORDER BY b.no_produk ASC";
		$penjt = $this->db->query($qpenj1)->result_array();
		$data['penjt'] = $penjt;

		$qbebantoko = "SELECT ifnull(sum(subtotal),0) as subtotal, c.no_coa, nama_coa
					FROM (SELECT * FROM pembayaran WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun')as a 
					JOIN (SELECT * FROM detail_pembayaran WHERE jenis_penjualan = 'toko')as b ON a.no_trans = b.no_trans
					RIGHT JOIN coa c ON c.no_coa = b.no_coa
					GROUP BY no_coa
					ORDER BY no_coa ASC
                    ";
		$tbbn = $this->db->query($qbebantoko)->result_array();
		$data['tokobeban'] = $tbbn;
	}



		$this->template->load('template', 'laba_rugi1',$data);
			}

	public function hpp_ips(){

		if(isset($_POST['bulan'], $_POST['tahun'])){
			$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$cek = date('m-d-Y', mktime(0,0,0,1,$bulan-1,$tahun));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);

		$qhpp0 =  "SELECT ifnull(sum(nominal),0) as hpp
					FROM jurnal
					WHERE posisi_dr_cr = 'd' AND no_coa = '6111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$hppips = $this->db->query($qhpp0)->row_array()['hpp'];
		$data['hppips'] = $hppips;

		$qprodukjadi = "SELECT ifnull(sum(subtotal) * (sum(stok_jual) / sum(jumlah)), 0) as total_jadi
						FROM detail_produksi_ke1 a 
						JOIN produksi_ke1 b ON a.no_trans = b.no_trans
						WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'";
		$produk_jadi = $this->db->query($qprodukjadi)->row_array()['total_jadi'];
		$data['produk_jadi'] = $produk_jadi;

		$qprodukawal = "SELECT ifnull(sum(nominal),0) as hpp_kurang,
						(SELECT ifnull(sum(subtotal) * (sum(stok_jual) / sum(jumlah)), 0)
						FROM detail_produksi_ke1 a 
						JOIN produksi_ke1 b ON a.no_trans = b.no_trans
						WHERE MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11') as hpp_tambah
							FROM jurnal
							WHERE posisi_dr_cr = 'd' AND no_coa = '6111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11'";
		$hitungawaltambah = $this->db->query($qprodukawal)->row_array()['hpp_tambah'];
		$hitungawalkurang = $this->db->query($qprodukawal)->row_array()['hpp_kurang'];

		$awal_hpp = $hitungawaltambah - $hitungawalkurang;
		$data['awal_hpp'] = $awal_hpp;

		$produk_siap_dijual = $produk_jadi + $awal_hpp;
		$data['produk_siap_dijual'] = $produk_siap_dijual;

		$akhir_hpp = $produk_siap_dijual - $hppips;
		$data['akhir_hpp'] = $akhir_hpp;

		}else{


		$bulan = date('m');
		$tahun = date('Y');
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$cek = date('m-d-Y', mktime(0,0,0,1,$bulan-1,$tahun));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);

		$qhpp0 =  "SELECT ifnull(sum(nominal),0) as hpp
					FROM jurnal
					WHERE posisi_dr_cr = 'd' AND no_coa = '6111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$hppips = $this->db->query($qhpp0)->row_array()['hpp'];
		$data['hppips'] = $hppips;

		$qprodukjadi = "SELECT ifnull(sum(subtotal) * (sum(stok_jual) / sum(jumlah)), 0) as total_jadi
						FROM detail_produksi_ke1 a 
						JOIN produksi_ke1 b ON a.no_trans = b.no_trans
						WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'";
		$produk_jadi = $this->db->query($qprodukjadi)->row_array()['total_jadi'];
		$data['produk_jadi'] = $produk_jadi;

		$qprodukawal = "SELECT ifnull(sum(nominal),0) as hpp_kurang,
						(SELECT ifnull(sum(subtotal) * (sum(stok_jual) / sum(jumlah)), 0)
						FROM detail_produksi_ke1 a 
						JOIN produksi_ke1 b ON a.no_trans = b.no_trans
						WHERE MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11') as hpp_tambah
							FROM jurnal
							WHERE posisi_dr_cr = 'd' AND no_coa = '6111' AND id_jurnal LIKE 'PENJS%' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11'";
		$hitungawaltambah = $this->db->query($qprodukawal)->row_array()['hpp_tambah'];
		$hitungawalkurang = $this->db->query($qprodukawal)->row_array()['hpp_kurang'];

		$awal_hpp = $hitungawaltambah - $hitungawalkurang;
		$data['awal_hpp'] = $awal_hpp;

		$produk_siap_dijual = $produk_jadi + $awal_hpp;
		$data['produk_siap_dijual'] = $produk_siap_dijual;

		$akhir_hpp = $produk_siap_dijual - $hppips;
		$data['akhir_hpp'] = $akhir_hpp;
	}



		$this->template->load('template', 'hpp/view_ips', $data);
	}

	public function hpp_toko(){

		if(isset($_POST['bulan'], $_POST['tahun'])){
			$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$produk = $_POST['produk'];
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$cek = date('m-d-Y', mktime(0,0,0,1,$bulan-1,$tahun));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);

		$this->db->or_not_like('no_produk', 'PR_001');
		$list_produk = $this->db->get('produk')->result_array();
		$data['list_produk'] = $list_produk;

		$this->db->where('no_produk', $produk);
		$nama_produk = $this->db->get('produk')->row_array()['nama_produk'];
		$data['nama_produk'] = $nama_produk;

				//
		$qhpp0 =  "SELECT ifnull(sum(hpp),0) as hpp
					FROM detail_penjualan_toko a 
					JOIN penjualan_toko b ON a.no_trans = b.no_trans
					WHERE  MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun' AND no_produk = '$produk'";
		$hpptoko = $this->db->query($qhpp0)->row_array()['hpp'];
		$data['hpptoko'] = $hpptoko;
			//

		$qprodukjadi = "SELECT ifnull(sum(subtotal), 0) as total_jadi
						FROM detail_produksi_ke2 a 
						WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun' AND no_produk = '$produk'";
		$produk_jadi = $this->db->query($qprodukjadi)->row_array()['total_jadi'];
		$data['produk_jadi'] = $produk_jadi;

		$qprodukawal = "SELECT ifnull(sum(hpp),0) as hpp_kurang,
						(SELECT ifnull(sum(subtotal), 0)
						FROM detail_produksi_ke2 a 
						WHERE MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11' AND no_produk = '$produk') as hpp_tambah
							FROM detail_penjualan_toko a 
					JOIN penjualan_toko b ON a.no_trans = b.no_trans
					WHERE  MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11' AND no_produk = '$produk'";
		$hitungawaltambah = $this->db->query($qprodukawal)->row_array()['hpp_tambah'];
		$hitungawalkurang = $this->db->query($qprodukawal)->row_array()['hpp_kurang'];

		$awal_hpp = $hitungawaltambah - $hitungawalkurang;
		$data['awal_hpp'] = $awal_hpp;

		$produk_siap_dijual = $produk_jadi + $awal_hpp;
		$data['produk_siap_dijual'] = $produk_siap_dijual;

		$akhir_hpp = $produk_siap_dijual - $hpptoko;
		$data['akhir_hpp'] = $akhir_hpp;

		}else{


		$bulan = date('m');
		$tahun = date('Y');
		$produk = 'PR_002';
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$cek = date('m-d-Y', mktime(0,0,0,1,$bulan-1,$tahun));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);

		$this->db->or_not_like('no_produk', 'PR_001');
		$list_produk = $this->db->get('produk')->result_array();
		$data['list_produk'] = $list_produk;

		$this->db->where('no_produk', $produk);
		$nama_produk = $this->db->get('produk')->row_array()['nama_produk'];
		$data['nama_produk'] = $nama_produk;

				//
		$qhpp0 =  "SELECT ifnull(sum(hpp),0) as hpp
					FROM detail_penjualan_toko a 
					JOIN penjualan_toko b ON a.no_trans = b.no_trans
					WHERE  MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun' AND no_produk = '$produk'";
		$hpptoko = $this->db->query($qhpp0)->row_array()['hpp'];
		$data['hpptoko'] = $hpptoko;
			//

		$qprodukjadi = "SELECT ifnull(sum(subtotal), 0) as total_jadi
						FROM detail_produksi_ke2 a 
						WHERE MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun' AND no_produk = '$produk'";
		$produk_jadi = $this->db->query($qprodukjadi)->row_array()['total_jadi'];
		$data['produk_jadi'] = $produk_jadi;

		$qprodukawal = "SELECT ifnull(sum(hpp),0) as hpp_kurang,
						(SELECT ifnull(sum(subtotal), 0)
						FROM detail_produksi_ke2 a 
						WHERE MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11' AND no_produk = '$produk') as hpp_tambah
							FROM detail_penjualan_toko a 
					JOIN penjualan_toko b ON a.no_trans = b.no_trans
					WHERE  MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11' AND no_produk = '$produk'";
		$hitungawaltambah = $this->db->query($qprodukawal)->row_array()['hpp_tambah'];
		$hitungawalkurang = $this->db->query($qprodukawal)->row_array()['hpp_kurang'];

		$awal_hpp = $hitungawaltambah - $hitungawalkurang;
		$data['awal_hpp'] = $awal_hpp;

		$produk_siap_dijual = $produk_jadi + $awal_hpp;
		$data['produk_siap_dijual'] = $produk_siap_dijual;

		$akhir_hpp = $produk_siap_dijual - $hpptoko;
		$data['akhir_hpp'] = $akhir_hpp;
	}



		$this->template->load('template', 'hpp/view_toko', $data);
	}




	public function lr(){
		date_default_timezone_set('Asia/Jakarta');
				


				if(isset($_POST['bulan'], $_POST['tahun'])){
					if($_POST['no_produk'] == 'all'){
						$bulan1 = $_POST['bulan'];
				$tahun1 = $_POST['tahun'];
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);
				$bulan = $_POST['bulan'];
				// $bulan = '07';
				$tahun = $_POST['tahun'];
				
		$query1 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, ifnull(SUM(nominal), 0) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa = '4111' AND 
							MONTH(tgl_jurnal) = '$bulan' AND 
							YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		//pennjualan
		$penjualan = $this->db->query($query1)->result_array();
		$penj = 0;
		foreach ($penjualan as $data) {
			# code...
			$penj = $penj + $data['nominal'];
		}
		$data['penjualan'] = $penj;

		
		//hpp
		$query2 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun') as debit,
							sum(nominal) as kredit
					FROM jurnal
					WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$jadid = $this->db->query($query2)->row()->debit;
		$jadik = $this->db->query($query2)->row()->kredit;
		// $jadi = $jadid - $jadik;
		$data['jadi'] = $jadid ;
		$akhir = $jadid - $jadik;
		$data['akhir'] = $akhir;

		$query21 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11') as debit,
							sum(nominal) as kredit
					FROM jurnal
					WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11'";
		$awald = $this->db->query($query21)->row()->debit;
		$awalk = $this->db->query($query21)->row()->kredit;
		$awal = $awald - $awalk;
		$data['awal'] = $awal;	
		//barang siap dijual
		$jumlahjual = $awal + $jadid;
		$hpp = $jumlahjual - $akhir;
		$data['jumlahjual'] = $jumlahjual; //jumlah siap dijual
		$data['hpp'] = $hpp;
		////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//beban usaha
		$query3 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa LIKE '522%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		$data['beban'] = $this->db->query($query3)->result_array();

		//beban overhead pabrik tetap
		$query31 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa LIKE '5134' AND
							posisi_dr_cr = 'd' AND 
							MONTH(tgl_jurnal) = '$bulan' AND 
							YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		$data['boptetap'] = $this->db->query($query31)->result_array();

		//beban usaha
		$query32 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa LIKE '521%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		$data['bopvar'] = $this->db->query($query32)->result_array();

		$data['produk'] = $this->db->get('produk')->result_array();
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$this->template->load('template','laba_rugi', $data);
					}elseif($_POST['no_produk'] == 'PR_001'){
							$no_produk = $_POST['no_produk'];
					$bulan1 = $_POST['bulan'];
				$tahun1 = $_POST['tahun'];
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);
				$bulan = $_POST['bulan'];
				// $bulan = '07';
				$tahun = $_POST['tahun'];

					$query12 = "SELECT sum(subtotal) as nominal, no_produk
					FROM detail_penjualan_ips a 
					JOIN jurnal b ON a.no_trans = b.id_jurnal
					where b.no_coa ='4111' AND posisi_dr_cr = 'k' AND no_produk = '$no_produk' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
					$cekpenj = $this->db->query($query12)->result_array();
					$filterpenj = $cekpenj;
					
					

					$query22 = "SELECT ifnull(sum(bbb + btk) *(sum(stok_jual) / sum(jumlah)),0)as nominal, no_produk
					FROM detail_produksi_ke1 a 
					JOIN produksi_ke1 b ON a.no_trans = b.no_trans
					WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'
					";
					$cekjadi = $this->db->query($query22)->result_array();
					$filterjadi = $cekjadi;
					
					

					$query23 = "SELECT SUM(hpp) as nominal , no_produk 
								FROM detail_penjualan_ips a 
								JOIN penjualan_ips b ON a.no_trans = b.no_trans
								WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'
								";
					$cekakhir = $this->db->query($query23)->result_array();
					$filterakhir = $cekakhir;

					//beda kondisi bulannya 2 bawah
					$query24 = "SELECT sum((bbb + btk))as nominal, no_produk
					FROM detail_produksi_ke1 a 
					JOIN produksi_ke1 b ON a.no_trans = b.no_trans
					WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11'";
					$cekawald1 = $this->db->query($query24)->result_array();
					$cekawald = $cekawald1;
					
					

					$query25 = "SELECT SUM(hpp) as nominal , no_produk 
								FROM detail_penjualan_ips a 
								JOIN penjualan_ips b ON a.no_trans = b.no_trans
								WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11'
								UNION 
								SELECT SUM(hpp) as nominal , no_produk 
								FROM detail_penjualan_toko a 
								JOIN penjualan_toko b ON a.no_trans = b.no_trans
								WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11'
								group by no_produk";
					$cekawalk1 = $this->db->query($query25)->result_array();
					$cekawalk = $cekawalk1;

					//beban usaha
					$query3 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
								FROM jurnal a 
								JOIN coa b ON a.no_coa = b.no_coa
								WHERE a.no_coa LIKE '522%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
								GROUP BY no_coa, posisi_dr_cr
								ORDER BY a.no_coa ASC";
					

					//beban overhead pabrik tetap
					$query31 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
								FROM jurnal a 
								JOIN coa b ON a.no_coa = b.no_coa
								WHERE a.no_coa LIKE '5134' AND
										posisi_dr_cr = 'd' AND 
										MONTH(tgl_jurnal) = '$bulan' AND 
										YEAR(tgl_jurnal) = '$tahun'
								GROUP BY no_coa, posisi_dr_cr
								ORDER BY a.no_coa ASC";
					

					//beban usaha
					$query32 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
								FROM jurnal a 
								JOIN coa b ON a.no_coa = b.no_coa
								WHERE a.no_coa LIKE '521%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
								GROUP BY no_coa, posisi_dr_cr
								ORDER BY a.no_coa ASC";
					

						$query1 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, ifnull(SUM(nominal), 0) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa = '4111' AND 
							MONTH(tgl_jurnal) = '$bulan' AND 
							YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
						//pennjualan
						$penjualan = $this->db->query($query1)->result_array();
						$penj = 0;
						foreach ($penjualan as $data) {
							# code...
							$penj = $penj + $data['nominal'];
						}
						$data['penjualan'] = $penj;

						
						//hpp
						$query2 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun') as debit,
											sum(nominal) as kredit
									FROM jurnal
									WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
						$jadid = $this->db->query($query2)->row()->debit;
						$jadik = $this->db->query($query2)->row()->kredit;
						// $jadi = $jadid - $jadik;
						$data['jadi'] = $jadid ;
						$akhir = $jadid - $jadik;
						$data['akhir'] = $akhir;

						$query02 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11') as debit,
											sum(nominal) as kredit
									FROM jurnal
									WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11'";
						$awald = $this->db->query($query02)->row()->debit;
						$awalk = $this->db->query($query02)->row()->kredit;
						$awal = $awald - $awalk;
						$data['awal'] = $awal;	
						//barang siap dijual
						$jumlahjual = $awal + $jadid;
						$hpp = $jumlahjual - $akhir;
						$data['jumlahjual'] = $jumlahjual; //jumlah siap dijual
						$data['hpp'] = $hpp;
					
				$data['labakotor1'] = $penj - $hpp ;
				$data['beban'] = $this->db->query($query3)->result_array();
				$data['boptetap'] = $this->db->query($query31)->result_array();
				$data['bopvar'] = $this->db->query($query32)->result_array();
				$data['penjualan'] = $filterpenj;
				$data['akhir'] = $filterakhir;
				$data['jadi'] = $filterjadi;
				$data['cekawald'] = $cekawald;
				$data['cekawalk'] = $cekawalk;

				$data['produk'] = $this->db->get('produk')->result_array();
				$data['bulan'] = $bulan;
				$data['tahun'] = $tahun;
				$this->db->where('no_produk', $_POST['no_produk']);
				$data['namaprod'] = $this->db->get('produk')->row()->nama_produk;
				$this->template->load('template','laba_rugi', $data);
					}else{
					$no_produk = $_POST['no_produk'];
					$bulan1 = $_POST['bulan'];
				$tahun1 = $_POST['tahun'];
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);
				$bulan = $_POST['bulan'];
				// $bulan = '07';
				$tahun = $_POST['tahun'];

					$query12 = "
					SELECT sum(subtotal) as nominal , no_produk
					FROM detail_penjualan_toko a 
					JOIN jurnal b ON a.no_trans = b.id_jurnal
					where b.no_coa ='4111' AND posisi_dr_cr = 'k' AND no_produk = '$no_produk' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
					$cekpenj = $this->db->query($query12)->result_array();
					$filterpenj = $cekpenj;
					
					

					$query22 = "
					SELECT sum((bbb + btk + bp))as nominal, no_produk
					FROM detail_produksi_ke2
					WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'
					group by no_produk";
					$cekjadi = $this->db->query($query22)->result_array();
					$filterjadi = $cekjadi;
					
					

					$query23 = "
								SELECT SUM(hpp) as nominal , no_produk 
								FROM detail_penjualan_toko a 
								JOIN penjualan_toko b ON a.no_trans = b.no_trans
								WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan' AND YEAR(tgl_trans) = '$tahun'
								group by no_produk";
					$cekakhir = $this->db->query($query23)->result_array();
					$filterakhir = $cekakhir;

					//beda kondisi bulannya 2 bawah
					$query24 = "
					SELECT sum((bbb + btk + bp))as nominal, no_produk
					FROM detail_produksi_ke2
					WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11'
					group by no_produk";
					$cekawald1 = $this->db->query($query24)->result_array();
					$cekawald = $cekawald1;
					
					

					$query25 = "
								SELECT SUM(hpp) as nominal , no_produk 
								FROM detail_penjualan_toko a 
								JOIN penjualan_toko b ON a.no_trans = b.no_trans
								WHERE no_produk = '$no_produk' AND MONTH(tgl_trans) = '$bulan11' AND YEAR(tgl_trans) = '$tahun11'
								group by no_produk";
					$cekawalk1 = $this->db->query($query25)->result_array();
					$cekawalk = $cekawalk1;

					//beban usaha
					$query3 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
								FROM jurnal a 
								JOIN coa b ON a.no_coa = b.no_coa
								WHERE a.no_coa LIKE '522%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
								GROUP BY no_coa, posisi_dr_cr
								ORDER BY a.no_coa ASC";
					

					//beban overhead pabrik tetap
					$query31 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
								FROM jurnal a 
								JOIN coa b ON a.no_coa = b.no_coa
								WHERE a.no_coa LIKE '5134' AND
										posisi_dr_cr = 'd' AND 
										MONTH(tgl_jurnal) = '$bulan' AND 
										YEAR(tgl_jurnal) = '$tahun'
								GROUP BY no_coa, posisi_dr_cr
								ORDER BY a.no_coa ASC";
					

					//beban usaha
					$query32 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
								FROM jurnal a 
								JOIN coa b ON a.no_coa = b.no_coa
								WHERE a.no_coa LIKE '521%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
								GROUP BY no_coa, posisi_dr_cr
								ORDER BY a.no_coa ASC";
					

						$query1 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, ifnull(SUM(nominal), 0) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa = '4111' AND 
							MONTH(tgl_jurnal) = '$bulan' AND 
							YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
						//pennjualan
						$penjualan = $this->db->query($query1)->result_array();
						$penj = 0;
						foreach ($penjualan as $data) {
							# code...
							$penj = $penj + $data['nominal'];
						}
						$data['penjualan'] = $penj;

						
						//hpp
						$query2 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun') as debit,
											sum(nominal) as kredit
									FROM jurnal
									WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
						$jadid = $this->db->query($query2)->row()->debit;
						$jadik = $this->db->query($query2)->row()->kredit;
						// $jadi = $jadid - $jadik;
						$data['jadi'] = $jadid ;
						$akhir = $jadid - $jadik;
						$data['akhir'] = $akhir;

						$query02 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11') as debit,
											sum(nominal) as kredit
									FROM jurnal
									WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11'";
						$awald = $this->db->query($query02)->row()->debit;
						$awalk = $this->db->query($query02)->row()->kredit;
						$awal = $awald - $awalk;
						$data['awal'] = $awal;	
						//barang siap dijual
						$jumlahjual = $awal + $jadid;
						$hpp = $jumlahjual - $akhir;
						$data['jumlahjual'] = $jumlahjual; //jumlah siap dijual
						$data['hpp'] = $hpp;
					
				$data['labakotor1'] = $penj - $hpp ;
				$data['beban'] = $this->db->query($query3)->result_array();
				$data['boptetap'] = $this->db->query($query31)->result_array();
				$data['bopvar'] = $this->db->query($query32)->result_array();
				$data['penjualan'] = $filterpenj;
				$data['akhir'] = $filterakhir;
				$data['jadi'] = $filterjadi;
				$data['cekawald'] = $cekawald;
				$data['cekawalk'] = $cekawalk;

				$data['produk'] = $this->db->get('produk')->result_array();
				$data['bulan'] = $bulan;
				$data['tahun'] = $tahun;
				$this->db->where('no_produk', $_POST['no_produk']);
				$data['namaprod'] = $this->db->get('produk')->row()->nama_produk;
				$this->template->load('template','laba_rugi', $data);
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			}
				}else{
				$bulan1 = date('m');
				$tahun1 = date('Y');
				$cek = date('m-d-Y', mktime(0,0,0,1,$bulan1-1,$tahun1));
				$bulan11 = substr($cek, 3,2);
				$tahun11 = substr($cek, 6,5);
				$bulan = date('m');
				// $bulan = '07';
				$tahun = date('Y');
				
		$query1 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, ifnull(SUM(nominal), 0) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa = '4111' AND 
							MONTH(tgl_jurnal) = '$bulan' AND 
							YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		//pennjualan
		$penjualan = $this->db->query($query1)->result_array();
		$penj = 0;
		foreach ($penjualan as $data) {
			# code...
			$penj = $penj + $data['nominal'];
		}
		$data['penjualan'] = $penj;

		
		//hpp
		$query2 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun') as debit,
							sum(nominal) as kredit
					FROM jurnal
					WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'";
		$jadid = $this->db->query($query2)->row()->debit;
		$jadik = $this->db->query($query2)->row()->kredit;
		// $jadi = $jadid - $jadik;
		$data['jadi'] = $jadid ;
		$akhir = $jadid - $jadik;
		$data['akhir'] = $akhir;

		$query21 = "SELECT (SELECT SUM(nominal) FROM jurnal WHERE no_coa ='1115' AND posisi_dr_cr = 'd' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11') as debit,
							sum(nominal) as kredit
					FROM jurnal
					WHERE no_coa = '1115' AND posisi_dr_cr = 'k' AND MONTH(tgl_jurnal) = '$bulan11' AND YEAR(tgl_jurnal) = '$tahun11'";
		$awald = $this->db->query($query21)->row()->debit;
		$awalk = $this->db->query($query21)->row()->kredit;
		$awal = $awald - $awalk;
		$data['awal'] = $awal;	
		//barang siap dijual
		$jumlahjual = $awal + $jadid;
		$hpp = $jumlahjual - $akhir;
		$data['jumlahjual'] = $jumlahjual; //jumlah siap dijual
		$data['hpp'] = $hpp;
		////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//beban usaha
		$query3 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa LIKE '522%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		$data['beban'] = $this->db->query($query3)->result_array();

		//beban overhead pabrik tetap
		$query31 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa LIKE '5134' AND
							posisi_dr_cr = 'd' AND 
							MONTH(tgl_jurnal) = '$bulan' AND 
							YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		$data['boptetap'] = $this->db->query($query31)->result_array();

		//beban usaha
		$query32 = "SELECT id_jurnal, tgl_jurnal, a.no_coa,nama_coa, posisi_dr_cr, SUM(nominal) as nominal
					FROM jurnal a 
					JOIN coa b ON a.no_coa = b.no_coa
					WHERE a.no_coa LIKE '521%' AND MONTH(tgl_jurnal) = '$bulan' AND YEAR(tgl_jurnal) = '$tahun'
					GROUP BY no_coa, posisi_dr_cr
					ORDER BY a.no_coa ASC";
		$data['bopvar'] = $this->db->query($query32)->result_array();

		$data['produk'] = $this->db->get('produk')->result_array();
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$this->template->load('template','laba_rugi', $data);
		
				}
		
		// var_dump($tahun11);
		

	}


	
}