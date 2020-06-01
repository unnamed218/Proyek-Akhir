<?php
class c_keuangan extends CI_Controller
{
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
				$query = "SELECT sum(nominal) as debit , (SELECT sum(nominal) FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'k' ) AS kredit FROM jurnal WHERE no_coa = '$no_akun' AND MONTH(tgl_jurnal) <= '$bulan' AND YEAR(tgl_jurnal) <= '$tahun' and posisi_dr_cr = 'd' ";
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


	//laporan pembelian bahan penolong
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

	
	
	


	
	
}