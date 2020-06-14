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
      $this->db->select('a.jumlah, b.nama_bb, b.harga, b.satuan, c.jumlah as jumlahbb');
      $this->db->from('bom a');
      $this->db->join('bahan_baku b', 'a.no_bbp = b. no_bb');
      $this->db->join('detail_pembelian_bb c', 'b.no_bb = c.no_bb');
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

      $this->db->where('no_trans', $data['no_trans_pembb']);
      $data['jmlprod'] = $this->db->get('detail_pembelian_bb')->row()->jumlah;

           //cek selesai produksi
      $this->db->where('no_trans', $id);
      $data['cek'] = $this->db->get('detail_produksi_ke1')->num_rows();


      
      $this->template->load('template', 'biaya_prod_ips/update', $data);

	}

		public function lap_bp_olahan(){

			
		$query = "SELECT a.no_trans, a.tgl_trans, sum(bbb) as bbb, sum(btk) as btk, sum(bop) as bop, sum(bp) as bp
				FROM produksi_ke2 a
				JOIN detail_produksi_ke2 b ON a.no_trans = b.no_trans
				GROUP BY a.no_trans";
		$data['result'] = $this->db->query($query)->result_array();
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
        $data['produk'] = $this->db->get('produk')->result_array();
     $query1 = "SELECT a.tgl_trans, a.no_trans, ifnull((z.jumlah), '0') as jumlah, 
                    ifnull(round((z.bbb+z.btk+z.bop+z.bp)/z.jumlah), '0') as rata, 
                    ifnull(((z.bbb+z.btk+z.bop+z.bp)),'0') as total_pmb,  
                    ifnull((c.jumlah),'0') as jumlah_bahan_baku, 
                    ifnull((c.harga),'0') as harga_satuan, 
                    ifnull((c.subtotal),'0') as subtotal_pmk, 
                    ifnull((a.unit),'0') as unit, 
                    ifnull((a.total),'0') as total, 
                    ifnull(round(a.total/a.unit), '0') as ratatotal 
                    FROM kartu_stok_penj a 
LEFT JOIN detail_produksi_ke2 z ON z.no_trans = a.no_trans
RIGHT JOIN produk x ON x.no_produk = a.no_produk
LEFT JOIN detail_penjualan_toko c ON c.no_trans = a.no_trans

WHERE a.no_produk = '$no_produk' AND tgl_trans >= '$awal' AND tgl_trans <= '$akhir'
GROUP BY a.no, a.no_produk, a.no_trans";

        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','penjt/stock_card',$data);
      }else{
        $no = 'PR_002';
      
        $this->db->where('no_produk', $no);
        $data['produk1'] = $this->db->get('produk')->row_array();
        $data['produk'] = $this->db->get('produk')->result_array();
     $query1 = "SELECT a.tgl_trans, a.no_trans, ifnull((z.jumlah), '0') as jumlah, 
                    ifnull(round((z.bbb+z.btk+z.bop+z.bp)/z.jumlah), '0') as rata, 
                    ifnull(((z.bbb+z.btk+z.bop+z.bp)),'0') as total_pmb,  
                    ifnull((c.jumlah),'0') as jumlah_bahan_baku, 
                    ifnull((c.harga),'0') as harga_satuan, 
                    ifnull((c.subtotal),'0') as subtotal_pmk, 
                    ifnull((a.unit),'0') as unit, 
                    ifnull((a.total),'0') as total, 
                    ifnull(round(a.total/a.unit), '0') as ratatotal 
                    FROM kartu_stok_penj a 
LEFT JOIN detail_produksi_ke2 z ON z.no_trans = a.no_trans
RIGHT JOIN produk x ON x.no_produk = a.no_produk
LEFT JOIN detail_penjualan_toko c ON c.no_trans = a.no_trans

WHERE a.no_produk = 'PR_002' 
GROUP BY a.no, a.no_produk, a.no_trans";


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
WHERE a.no_produk = 'PR_001' AND tgl_trans >= '$awal' AND tgl_trans <= '$akhir'
GROUP BY a.no, a.no_produk, a.no_trans";

        $data['result'] = $this->db->query($query1)->result_array();
        $this->template->load('template','penjs/stock_card',$data);
      }else{
        $no = 'PR_002';
      
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

WHERE a.no_bb = '$no' AND tgl_trans >= '$awal' AND tgl_trans <= '$akhir'
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

	
}