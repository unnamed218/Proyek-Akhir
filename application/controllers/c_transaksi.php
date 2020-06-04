   <?php
class c_transaksi extends CI_controller{

	 function __construct(){
        parent:: __construct();
       if(empty($this->session->userdata('level'))){
            redirect('c_login/home');
        }
    }

 //PEMBELIAN BAHAN BAKU
   public function lihat_pemb(){
      $data['result'] = $this->db->get('pembelian_bb')->result_array();
        $this->template->load('template', 'pemb/view', $data);
   }

   public function isi_edit_pemb($id){
      $data['id'] = $id;
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('pembelian_bb')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('pembelian_bb')->row()->tgl_trans;
      $data['peternak'] = $this->db->get('peternak')->result_array();

      $this->db->where('no_trans', $id);
      $this->db->select('status');
      $data['cek'] = $this->db->get('pembelian_bb')->row()->status;

      //DETAIL
      $this->db->select('nama_bb, a.jumlah, harga,satuan,nama_peternak');
      $this->db->from('detail_pembelian_bb a');
      $this->db->join('peternak b', 'a.no_peternak = b.no_peternak');
      $this->db->join('bahan_baku c', 'a.no_bb = c.no_bb');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

      //CEK SELESAI BELANJA JADI NON KLIKK!

      // $data['cek_selesai'] = $this->db->query($query1)->num_rows();
      $this->db->where('no_trans', $id);
      $data['cek_selesai'] = $this->db->get('detail_pembelian_bb')->num_rows();

      //UPDATE TABEL PEMBELIAN_BB
      $this->db->where('no_trans', $id);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_pembelian_bb')->row()->subtotal;


   
      $this->template->load('template', 'pemb/update', $data);
      // var_dump($data['cek_selesai']);
   }

   public function form_pemb(){
          $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM pembelian_bb";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PMB_" . $kd;
         $data['id'] = $no_trans;

         $this->template->load('template', 'pemb/form', $data);
   }

   public function tambah_pemb(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'total' => '0');
      $this->db->insert('pembelian_bb', $data);

      redirect('c_transaksi/lihat_pemb');
   }

   public function tambah_pemb1(){

      $this->db->where('no_bb', $_POST['no_bb']);
      $harga = $this->db->get('bahan_baku')->row()->harga;
       $data = array('no_trans' => $_POST['no_trans'],
                  'no_bb' => $_POST['no_bb'],
                  'jumlah' => $_POST['jumlah'],
                  'subtotal' => $_POST['jumlah']*$harga,
                  'no_peternak' => $_POST['no_peternak']);

       $subtotal = $_POST['jumlah'] * $harga;

      

       $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_bb' => $_POST['no_bb'], 'no_peternak' => $_POST['no_peternak']));
            $cek =  $this->db->get('detail_pembelian_bb')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_pembelian_bb', $data);

            

             
            }else{

            $this->db->set('subtotal', "subtotal + ".$subtotal."", FALSE);
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
             $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_bb' => $_POST['no_bb'], 'no_peternak' => $_POST['no_peternak']));
            $this->db->update('detail_pembelian_bb');



           
   }

    redirect('c_transaksi/isi_edit_pemb/'.$_POST['no_trans'].'');
}

   public function selesai_pemb($id,$total){
      $this->db->set('total', $total);
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('pembelian_bb');

      redirect('c_transaksi/isi_edit_pemb/'.$id.'');
   }

    //Cek kualitas
   public function lihat_ck(){
      $data['result'] = $this->db->get('cek_kualitas')->result_array();
        $this->template->load('template', 'ck/view', $data);
   }

   public function isi_edit_ck($id){
      $data['no_trans'] = $id;
     
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('cek_kualitas')->row()->tgl_trans;
   
      //jumlah bahan baku 
      $this->db->where('b.no_trans', $id);
      $this->db->select_sum('jumlah');
      $this->db->join('detail_pembelian_bb a', 'a.no_trans = b.no_trans_pembb');
      $data['jumlah'] = $this->db->get('cek_kualitas b')->row()->jumlah;

        //satuan bahan baku 
      $this->db->where('b.no_trans', $id);
      $this->db->join('detail_pembelian_bb a', 'a.no_trans = b.no_trans_pembb');
      $this->db->join('bahan_baku c', 'c.no_bb = a.no_bb');
      $data['satuan'] = $this->db->get('cek_kualitas b')->row()->satuan;

       // $data['cek_selesai'] = $this->db->query($query1)->num_rows();
      $this->db->where('no_trans', $id);
      $data['cek_selesai'] = $this->db->get('detail_cek_kualitas')->num_rows();

       $this->db->where('no_trans', $id);
      $this->db->select('status');
      $data['cek'] = $this->db->get('cek_kualitas')->row()->status;

      //-------------------------------------------------------------------------------//
      //detail
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get('detail_cek_kualitas')->result_array();


      $this->template->load('template', 'ck/update', $data);
 
   }

   public function form_ck(){
          $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM cek_kualitas";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "CK_" . $kd;
         $data['id'] = $no_trans;

         $this->db->where('status', '1');
         $this->db->order_by('no_trans');
         $data['pbb'] = $this->db->get('pembelian_bb')->result_array();

         $this->template->load('template', 'ck/form', $data);
   }

   public function tambah_ck(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'no_trans_pembb' => $_POST['no_trans_pembb']);
      $this->db->insert('cek_kualitas', $data);

      $this->db->where('no_trans', $_POST['no_trans_pembb']);
      $this->db->set('status', '2');
      $this->db->update('pembelian_bb');
      redirect('c_transaksi/lihat_ck');
   }

   public function selesai_ck(){
      $id = $_POST['no_trans'];
      $gagal = $_POST['jumlah'] - $_POST['lulus'];
      $data = array('no_trans' => $_POST['no_trans'],
               'lulus' => $_POST['lulus'],
               'gagal' => $gagal,
               'total' => $_POST['jumlah']);
      $this->db->insert('detail_cek_kualitas', $data);


      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('cek_kualitas');

      $this->db->where('no_bb', 'BB_001');
      $harga = $this->db->get('bahan_baku')->row()->harga;

       $this->db->set('stok', "stok +".$_POST['lulus']."",FALSE);
      $this->db->where('no_bb', 'BB_001');
      $this->db->update('bahan_baku');

      //kartu stok
      $this->db->where('no_trans', $id);
      $no_pemb = $this->db->get('cek_kualitas')->no_trans_pembb;

      $this->db->where('no_trans', $no_trans_pembb);
      $this->db->select_sum('jumlah');
      $jumlahbb = $this->db->get('detail_pembelian_bb')->row()->jumlah;

      
      $total = $harga * $_POST['lulus'];
       $this->m_keuangan->GenerateJurnal('1112', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('1111', $id, 'k', $total);


       //--------------------------------------------------------------------------//
      //kartu stok
       $data1 = array('no_trans' => $_POST['no_trans'],
                     'tgl_trans' => $_POST['tgl_trans'],
                     'no_bb' => 'BB_001',
                     'unit' => $_POST['lulus'],
                     'total' => $total);
       $this->db->insert('kartu_stok_bb', $data1);
      redirect('c_transaksi/isi_edit_ck/'.$id.'');
   }


   //MENENTUKAN TRANSAKSI PRODUKSI 1

   public function lihat_produksi_ke1(){
      $data['result'] = $this->db->get('produksi_ke1')->result_array();
      $this->template->load('template', 'prod1/view', $data);
   }

    public function isi_edit_produksi_ke1($id){
      $data['id'] = $id;
      $data['no_trans'] = $id; 
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('produksi_ke1')->row()->tgl_trans;

      $this->db->where('no_trans', $id);
      $id_ck = $this->db->get('produksi_ke1')->row()->no_trans_ck;
      $data['no_ck'] = $id_ck;

        //jumlah produksi

      $this->db->where('no_trans',  $data['no_ck']);
      $data['jmlprod'] = $this->db->get('detail_cek_kualitas')->row()->lulus;

      $this->db->where('no_trans', $id_ck);
      $pembb = $this->db->get('cek_kualitas')->row()->no_trans_pembb;
      $data['no_trans_pembb'] = $pembb;

      $data['peternak'] = $this->db->get('peternak')->result_array();

       $this->db->where('a.no_trans', $id);
       $this->db->join('cek_kualitas b', 'b.no_trans = a.no_trans_ck');
       $this->db->join('detail_pembelian_bb c', 'c.no_trans = b.no_trans_pembb');
       $this->db->join('bahan_baku d', 'd.no_bb = c.no_bb');
      $data['satuan'] = $this->db->get('produksi_ke1 a')->row()->satuan;


      
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
    
   

           //cek selesai produksi
      $this->db->where('no_trans', $id);
      $data['cek'] = $this->db->get('detail_produksi_ke1')->num_rows();


      
      $this->template->load('template', 'prod1/update', $data);
      // var_dump($data['cek_selesai']);
   }

   public function form_produksi_ke1(){
          $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM produksi_ke1";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PROD1_" . $kd;
         $data['id'] = $no_trans ;
         $this->db->where('status', '1');
         $this->db->order_by('no_trans');
         $data['ck'] = $this->db->get('cek_kualitas')->result_array();



         $this->template->load('template', 'prod1/form', $data);
   }

   public function tambah_produksi_ke1(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'no_trans_ck' => $_POST['no_trans_ck']);
      $this->db->insert('produksi_ke1', $data);

      $this->db->where('no_trans', $_POST['no_trans_ck']);
      $this->db->set('status', '2');
      $this->db->update('cek_kualitas');
      redirect('c_transaksi/lihat_produksi_ke1');
   }

   public function selesai_produksi_ke1($id,$bbb,$jumlah,$no_prod,$btk,$bop){
      
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('produksi_ke1');

      //input ke detail produksi ke 1
      $totalbiaya = $bbb+$btk+$bop;
      $data = array('no_trans' => $id,
               'no_produk' => $no_prod,
               'bbb' => $bbb,
               'btk' => $btk,
               'bop' => $bop,
               'jumlah' => $jumlah );
      $this->db->insert('detail_produksi_ke1', $data);

     

      //jurnal pemakaian
        $this->m_keuangan->GenerateJurnal('5111', $id, 'd', $bbb);
      $this->m_keuangan->GenerateJurnal('5112', $id, 'd', $btk);
       $this->m_keuangan->GenerateJurnal('5113', $id, 'd', $bop);
       $this->m_keuangan->GenerateJurnal('1112', $id, 'k', $bbb);
       $this->m_keuangan->GenerateJurnal('5311', $id, 'k', $btk);
       $this->m_keuangan->GenerateJurnal('5312', $id, 'k', $bop);

       //penambah stok di bahan dalam proses
      $this->db->set('stok', "stok + ".$jumlah."", FALSE);
      $this->db->where('no_bdp', 'BDP_001');
      $this->db->update('bahan_dalam_proses');

      //pengurang stok bahan baku belum cok!
       $this->db->set('stok', "stok - ".$jumlah."", FALSE);
      $this->db->where('no_bb', 'BB_001');
      $this->db->update('bahan_baku');


        //--------------kartu stok---------------------------------
      //----------------pengurang bahan baku dulu-----------------
      // $this->db->where('no_trans', $no_trans);
      // $this->db->select('a.no_trans, tgl_trans, no_bp');
      // $this->db->select_sum('subtotal as total, jumlah as unit');
      // $this->db->from('pembelian_bp a');
      // $this->db->join('detail_pembelian_bp b', 'a.no_trans = b.no_trans');
      // $this->db->group_by('no_bp');
      // $list = $this->db->get()->result_array();
    
         # code...
      $this->db->where('no_trans', $id);
      $tgl_trans = $this->db->get('produksi_ke1')->row()->tgl_trans;

      $this->db->where('no_bb', 'BB_001');
      $harga = $this->db->get('bahan_baku')->row()->harga;
      $total = $harga * $jumlah;
      $data1 = array('no_trans' => $id,
                     'tgl_trans' => $tgl_trans,
                     'no_bb' => 'BB_001',
                     'unit' => $jumlah,
                     'total' => $total);
       $this->db->insert('kartu_stok_bb', $data1);
      
   

      redirect('c_transaksi/isi_edit_produksi_ke1/'.$id.'');
   }


   //MENENTUKAN PEMBAGIAN BAHAN BAKU DALAM PROSES


   public function lihat_pembagian(){
      $data['result'] = $this->db->get('pembagian')->result_array();
      $this->template->load('template', 'pembagian/view', $data);
   }

    public function isi_edit_pembagian($id){
      $data['id'] = $id;
      $data['no_trans'] = $id; 
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('pembagian')->row()->tgl_trans;

      $this->db->where('no_trans', $id);
      $data['prod'] = $this->db->get('pembagian')->row()->no_trans_produksi1;

      $this->db->where('no_trans', $data['prod']);
      $data['jumlah'] = $this->db->get('detail_produksi_ke1')->row()->jumlah;

      //detail
      $this->db->select('jual,produksi,jumlah');
      $this->db->from('detail_pembagian a');
      $this->db->join('pembagian b', 'a.no_trans = b.no_trans');
      $this->db->join('detail_produksi_ke1 c', 'c.no_trans = b.no_trans_produksi1');
      $this->db->where('a.no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

      $this->db->where('no_trans', $id);
      $data['cek'] = $this->db->get('pembagian')->row()->status; 

        $this->db->where('e.no_trans', $id);
        $this->db->join('produksi_ke1 a', 'a.no_trans = e.no_trans_produksi1');
       $this->db->join('cek_kualitas b', 'b.no_trans = a.no_trans_ck');
       $this->db->join('detail_pembelian_bb c', 'c.no_trans = b.no_trans_pembb');
       $this->db->join('bahan_baku d', 'd.no_bb = c.no_bb');
      $data['satuan'] = $this->db->get('pembagian e')->row()->satuan;

      
      $this->template->load('template', 'pembagian/update', $data);
   }

   public function form_pembagian(){
          $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM pembagian";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PGB_" . $kd;
         $data['id'] = $no_trans ;


         $this->db->where('status', '1');
         $data['prod'] = $this->db->get('produksi_ke1')->result_array();



         $this->template->load('template', 'pembagian/form', $data);
   }

   public function tambah_pembagian(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'no_trans_produksi1' => $_POST['no_trans_produksi1']);
      $this->db->insert('pembagian', $data);

      $this->db->where('no_trans', $_POST['no_trans_produksi1']);
      $this->db->set('status', '2');
      $this->db->update('produksi_ke1');
      redirect('c_transaksi/lihat_pembagian');
   }

   public function selesai_pembagian(){
      $id = $_POST['no_trans'];
      $this->db->set('status', '1');
      $this->db->where('no_trans', $_POST['no_trans']);
      $this->db->update('pembagian');

      // $produksi = 100 - $_POST['jual'];
      $produksi = $_POST['jumlah'] - $_POST['jual']
;
      //input ke detail pembagian
      $data = array( 'no_trans' => $_POST['no_trans'],
                     'jual' => $_POST['jual'],
                     'produksi' => $produksi );
      $this->db->insert('detail_pembagian', $data);

      //update ke stok produk
      
      $this->db->set('stok', "stok - ".$_POST['jual']."", FALSE);
      $this->db->where('no_bdp', 'BDP_001');
      $this->db->update('bahan_dalam_proses');

      //update stok produk
      $this->db->set('stok', "stok + ".$_POST['jual']."", FALSE);
      $this->db->like('no_produk', 'Susu Sapi', 'none');
      $this->db->update('produk');


      /////
      $this->db->where('no_trans', $_POST['no_prod']);
      $bbb = $this->db->get('detail_produksi_ke1')->row()->bbb;

      $this->db->where('no_trans', $_POST['no_prod']);
      $btk = $this->db->get('detail_produksi_ke1')->row()->btk;

      $this->db->where('no_trans', $_POST['no_prod']);
      $bop = $this->db->get('detail_produksi_ke1')->row()->bop;

      ///bbb dalam proses
      $bbb1 = round(($produksi/$_POST['jumlah'])*$bbb);

      ///bbb jadi
      $bbb2 = round(($_POST['jual']/$_POST['jumlah'])*$bbb);

     ///bbb dalam proses
      $btk1 = round(($produksi/$_POST['jumlah'])*$btk);

      ///bbb jadi
      $btk2 = round(($_POST['jual']/$_POST['jumlah'])*$btk);

      ///bbb dalam proses
      $bop1 = round(($produksi/$_POST['jumlah'])*$bop);

      ///bbb jadi
      $bop2 = round(($_POST['jual']/$_POST['jumlah'])*$bop);

      //total dalam proses
      $pbdp = $bbb1 + $btk1 + $bop1;
      $pbj = $bbb2 + $btk2 + $bop2;

        //jurnal persediaan dalam proses
        $this->m_keuangan->GenerateJurnal('1114', $id, 'd', $pbdp);
      $this->m_keuangan->GenerateJurnal('5111', $id, 'k', $bbb1);
       $this->m_keuangan->GenerateJurnal('5112', $id, 'k', $btk1);
       $this->m_keuangan->GenerateJurnal('5113', $id, 'k', $bop1);

       //jurnal persediaan jadi
       $this->m_keuangan->GenerateJurnal('1115', $id, 'd', $pbj);
       $this->m_keuangan->GenerateJurnal('5111', $id, 'k', $bbb2);
       $this->m_keuangan->GenerateJurnal('5112', $id, 'k', $btk2);
       $this->m_keuangan->GenerateJurnal('5113', $id, 'k', $bop2);


      redirect('c_transaksi/isi_edit_pembagian/'.$id.'');
   }




  //MENENTUKAN TRANSAKSI TARGET PROYEKSI
	 public function lihat_tp()
   {
      	
         
         $data['result'] = $this->db->get('target_produksi')->result_array();
         $this->template->load('template', 'tp/view', $data);
       
   }


    
   public function form_tp()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_tp,3)) as kode FROM target_produksi";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "TP_" . $kd;
         $data['id'] = $no_trans;

         $this->db->where('status', '1');
         $data['pembagian'] = $this->db->get('pembagian')->result_array();
         $this->template->load('template', 'tp/form', $data);
       
   }
   
   public function tambah_tp()
   {
      
         
         $config = array(
            
            array(
               'field' => 'tgl_tp',
               'label' => 'Tanggal Target Produksi',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_tp();
         } else {
            $data = array(
               'no_tp' => $_POST['no_tp'],
               'tanggal' => date('Y-m-d'),
               'tgl_tp' => $_POST['tgl_tp'],
               'status' => '0',
               'no_trans_pembagian' => $_POST['no_trans_pembagian']
            );
            $this->db->insert('target_produksi', $data);

            //update status pembagian
         $this->db->set('status', "2", FALSE);
         $this->db->where('no_trans', $_POST['no_trans_pembagian']);
         $this->db->update('pembagian');

            redirect('c_transaksi/lihat_tp');
         }
       
      
   }
   
   public function isi_edit_tp($id)
   {
      	$this->db->where('no_tp', $id);
      	$this->db->select('status');
      	$x['status'] = $this->db->get('target_produksi')->row()->status;
         
         
         $x['data'] = $this->m_masterdata->edit_data('target_produksi', "no_tp = '$id'")->row_array();


         $query3 = "SELECT produksi as jumlah
                  FROM target_produksi a
                  JOIN pembagian b ON a.no_trans_pembagian = b.no_trans
                  JOIN detail_produksi_ke1 c ON c.no_trans = b.no_trans_produksi1
                  JOIN detail_pembagian d ON d.no_trans = b.no_trans
                  WHERE a.no_tp = '$id'";
          $x['jumlah'] = $this->db->query($query3)->row()->jumlah;
    
         $this->db->or_not_like('nama_produk', 'Susu Sapi', 'none');
         $x['result'] = $this->db->get('produk')->result_array(); 
         
         $this->db->where('a.no_tp', $id);
         $this->db->select('a.no_produk, nama_produk, jumlah, a.no_tp, satuan, c.status');
         $this->db->from('detail_target_produksi a');
         $this->db->join('produk b', 'a.no_produk = b.no_produk');
         $this->db->join('target_produksi c', 'a.no_tp = c.no_tp');
         $this->db->order_by('no');
         $x['result1'] = $this->db->get()->result_array();

         //ISI BOM 
      $query1 =   "SELECT nama_bb, sum(a.jumlah) * c.jumlah as jumlah_bom, d.harga, d.satuan, c.no_bbp
                  FROM detail_target_produksi a
                  JOIN produk b ON a.no_produk = b.no_produk
                  JOIN bom c ON c.no_produk = b.no_produk
                  JOIN bahan_baku d ON d.no_bb = c.no_bbp 
                  WHERE a.no_tp = '$id'
UNION
SELECT nama_bp, sum(a.jumlah) * c.jumlah as jumlah_bom, d.harga, d.satuan, c.no_bbp
FROM detail_target_produksi a
JOIN produk b ON a.no_produk = b.no_produk
JOIN bom c ON c.no_produk = b.no_produk
JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
WHERE a.no_tp = '$id' AND NOT c.no_bbp = 'BB_001'
group by no_bbp";
      $x['result2'] = $this->db->query($query1)->result_array();
         $x['id'] = $id;
         $this->template->load('template', 'tp/update', $x);
       
      
   }


   public function edit_tp()
   {
      
         $config = array(
            
            array(
               'field' => 'no_produk',
               'label' => 'Nama Produk',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_tp'];
            $this->isi_edit_tp($id);
         } else {
            $id = $_POST['no_tp'];
            $data = array(
               'no_tp' => $_POST['no_tp'],
               'no_produk' => $_POST['no_produk'],
               'jumlah' => $_POST['jumlah']
            );

            if($this->session->userdata('level') == 'produksi1'){
                $this->db->insert('detail_target_produksi', $data);

               $this->db->where('no_tp', $id);
               $this->db->set('status', '1');
               $this->db->update('target_produksi');

            redirect('c_transaksi/lihat_tp');
            }else{
            
            $this->db->where(array('no_tp' => $_POST['no_tp'], 'no_produk' => $_POST['no_produk']));
            $cek =  $this->db->get('detail_target_produksi')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_target_produksi', $data);
            $this->isi_edit_tp($id);
            }else{
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
            $this->db->where(array('no_tp' => $_POST['no_tp'], 'no_produk' => $_POST['no_produk']));
            $this->db->update('detail_target_produksi');
            redirect('c_transaksi/lihat_tp');
            
         }
      }
    }
 }

 	public function hapus_tp($id,$id2){
      $this->db->query("SET GLOBAL FOREIGN_KEY_CHECKS=0");
         $this->db->where('no_tp',$id);
         $this->db->where('no_produk', $id2);
         $this->db->delete('detail_target_produksi');
         $this->db->query("SET GLOBAL FOREIGN_KEY_CHECKS=1");
      	
            redirect('c_transaksi/isi_edit_tp/'.$id.'');
   }

   public function selesai_tp($id){

   	$this->db->where('no_tp', $id);
   	$this->db->set('status', '1');
   	$this->db->update('target_produksi');
   	redirect('c_transaksi/lihat_tp');
   }




    //PEMBELIAN BAHAN PENOLONG
   public function lihat_pembp(){
   	$data['result'] = $this->db->get('pembelian_bp')->result_array();
   	  $this->template->load('template', 'pembp/view', $data);
   }

   public function form_pembp(){
   		 $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM pembelian_bp";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PMBP_" . $kd;
         $data['id'] = $no_trans;

         $this->db->where('status', '1');
         $data['result'] = $this->db->get('target_produksi')->result_array();
         $this->template->load('template', 'pembp/form', $data);
   }

   public function tambah_pembp(){
   	$data = array('no_trans' => $_POST['no_trans'],
   				'tgl_trans' => $_POST['tgl_trans'],
   				'status' => '0',
   				'total' => '0',
   				'no_tp' => $_POST['no_tp']);
   	$this->db->insert('pembelian_bp', $data);

   	$this->db->where('no_tp', $_POST['no_tp']);
   	$this->db->set('status', '2');
   	$this->db->update('target_produksi');
   	redirect('c_transaksi/lihat_pembp');
   }

     public function tambah_pembp1(){
      $data = array('no_trans' => $_POST['no_trans'],
                  'no_bp' => $_POST['no_bp'],
                  'jumlah' => $_POST['jumlah'],
                  'subtotal' => $_POST['jumlah']*$_POST['harga'],
                  'no_supp_bp' => $_POST['no_supp_bp']);
      $this->db->insert('detail_pembelian_bp', $data);

    $this->db->set('stok', "stok +".$_POST['jumlah']."",FALSE);
    $this->db->where('no_bp', $_POST['no_bp']);
    $this->db->update('bahan_penolong');

    redirect('c_transaksi/isi_edit_pembp/'.$_POST['no_trans'].'');
   }

   public function selesai_pembp($id,$total){
      $this->db->set('total', $total);
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('pembelian_bp');

      $this->m_keuangan->GenerateJurnal('1113', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('1111', $id, 'k', $total);

      //--------------kartu stok----------------------------------
      $this->db->where('a.no_trans', $id);
      $this->db->select('a.no_trans, tgl_trans, no_bp,subtotal as total, jumlah as unit');
      $this->db->from('pembelian_bp a');
      $this->db->join('detail_pembelian_bp b', 'a.no_trans = b.no_trans');
      $this->db->group_by('no_bp');
      $list = $this->db->get()->result_array();
      foreach ($list as $data) {
         # code...

           $data1 = array('no_trans' => $data['no_trans'],
                     'tgl_trans' => $data['tgl_trans'],
                     'no_bp' => $data['no_bp'],
                     'unit' => $data['unit'],
                     'total' => $data['total']);
       $this->db->insert('kartu_stok_bp', $data1);
      }
    
      redirect('c_transaksi/isi_edit_pembp/'.$id.'');
   }

   public function isi_edit_pembp($id){
      $data['id'] = $id;
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('pembelian_bp')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('pembelian_bp')->row()->tgl_trans;

      //ISI PEMBELIAN 
      $query1 = "SELECT nama_bp, sum(b.jumlah)*(c.jumlah) as jumlah, harga,satuan, no_bbp
   FROM pembelian_bp a 
   JOIN detail_target_produksi b ON a.no_tp = b.no_tp
   JOIN bom c ON c.no_produk = b.no_produk
   JOIN bahan_penolong d ON d.no_bp = c.no_bbp
   WHERE a.no_trans = '$id' AND c.no_bbp NOT IN
   (SELECT no_bp FROM detail_pembelian_bp WHERE no_trans = '$id')
   GROUP BY nama_bp";
      $data['result1'] = $this->db->query($query1)->result_array();
      $this->db->where('no_trans', $id);
      $this->db->select('status');
      $data['cek'] = $this->db->get('pembelian_bp')->row()->status;

      //DETAIL
      $this->db->select('nama_bp, a.jumlah, harga,satuan,nama_supp_bp');
      $this->db->from('detail_pembelian_bp a');
      $this->db->join('supplier_bp b', 'a.no_supp_bp = b.no_supp_bp');
      $this->db->join('bahan_penolong c', 'a.no_bp = c.no_bp');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

      //CEK SELESAI BELANJA JADI NON KLIKK!

      $data['cek_selesai'] = $this->db->query($query1)->num_rows();

      //UPDATE TABEL PEMBELIAN_BB
      $this->db->where('no_trans', $id);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_pembelian_bp')->row()->subtotal;
      $data['supplier_bp'] = $this->db->get('supplier_bp')->result_array();
      $this->template->load('template', 'pembp/update', $data);
   }


 //MENENTUKAN TRANSAKSI PRODUKSI 2

   public function lihat_produksi_ke2(){
      $data['result'] = $this->db->get('produksi_ke2')->result_array();
      $this->template->load('template', 'prod2/view', $data);
   }

   public function isi_edit_produksi_ke21($id){
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

      $this->template->load('template', 'prod2/update0', $data);

   }


    public function isi_edit_produksi_ke2($id,$no_tp,$no_prod){
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


      
      $this->template->load('template', 'prod2/update', $data);
      // var_dump($data['btkperhari']);
      // var_dump( $presentase);
   }



   public function form_produksi_ke2(){
          $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM produksi_ke2";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PROD2_" . $kd;
         $data['id'] = $no_trans ;
         $this->db->where('status', '2');
         $this->db->order_by('no_tp');
         $data['tp'] = $this->db->get('target_produksi')->result_array();



         $this->template->load('template', 'prod2/form', $data);
   }

   public function tambah_produksi_ke2(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'no_tp' => $_POST['no_tp']);
      $this->db->insert('produksi_ke2', $data);

      $this->db->where('no_tp', $_POST['no_tp']);
      $this->db->set('status', '3');
      $this->db->update('target_produksi');
      redirect('c_transaksi/lihat_produksi_ke2');
   }

   public function selesai_produksi_ke2($bbb,$btk,$bop,$bp,$id,$no_tp,$no_prod,$jumlah){
      
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('produksi_ke2');


      //input ke detail produksi ke 1
   
      $data = array('no_trans' => $id,
               'no_produk' => $no_prod,
               'bbb' => $bbb,
               'btk' => $btk,
               'bop' => $bop,
               'bp'  => $bp,
               'jumlah' => $jumlah );
      $this->db->insert('detail_produksi_ke2', $data);

      //total bop + bp
      $bbop = $bp + $bop;
      //input ke stok produk

        $this->db->set('stok', "stok - ".$jumlah."", FALSE);
      $this->db->where('no_bdp', 'BDP_001');
      $this->db->update('bahan_dalam_proses');

      //jurnal pemakaian
      $this->m_keuangan->GenerateJurnal('5112', $id, 'd', $btk);
       $this->m_keuangan->GenerateJurnal('5113', $id, 'd', $bbop);
       $this->m_keuangan->GenerateJurnal('5311', $id, 'k', $btk);
       $this->m_keuangan->GenerateJurnal('5312', $id, 'k', $bbop);

       $pbj = $bbb + $btk + $bbop;
       //jurnal persediaan jadi
       $this->m_keuangan->GenerateJurnal('1115', $id, 'd', $pbj);
       $this->m_keuangan->GenerateJurnal('1114', $id, 'k', $bbb);
       $this->m_keuangan->GenerateJurnal('5112', $id, 'k', $btk);
       $this->m_keuangan->GenerateJurnal('5113', $id, 'k', $bbop);

      redirect('c_transaksi/isi_edit_produksi_ke2/'.$id.'');
   }

   //PENJUALAN

   public function lihat_penjs(){

   	$data['result'] = $this->db->get('penjualan_ips')->result_array();
   	$this->template->load('template', 'penjs/view', $data);
   }

   public function form_penjs(){
       $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM penjualan_ips";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PENJS_" . $kd;
         $data['id'] = $no_trans;
         $id = $no_trans;

         $this->db->where('status', '2');
         $this->db->select('jual, a.no_trans, status,tgl_trans');
         $this->db->from('pembagian a');
         $this->db->join('detail_pembagian b', 'a.no_trans = b.no_trans');
         $data['pembagian'] = $this->db->get()->result_array();
         $this->template->load('template','penjs/form', $data);
   }

   public function isi_edit_penjs($id,$id_pembg){
      $data['id'] = $id;
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('penjualan_ips')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('penjualan_ips')->row()->tgl_trans;
      $data['id_pembg'] = $id_pembg;

      $this->db->like('nama_produk', 'Susu Sapi', 'before');
      $data['satuan'] = $this->db->get('produk')->row()->satuan;

      //jumlah yg bisa dijual
      $this->db->where('no_trans', $id_pembg);
      $data['jumlah'] = $this->db->get('detail_pembagian')->row()->jual;

      //harga jual
      $this->db->where('no_trans', $id_pembg);
      $id_prod1 = $this->db->get('pembagian')->row()->no_trans_produksi1;

      $query = "SELECT (bbb + btk + bop) as biaya, jual, produksi
               FROM pembagian a
               JOIN detail_pembagian b ON a.no_trans = b.no_trans
               JOIN detail_produksi_ke1 c ON a.no_trans_produksi1 = c.no_trans
               WHERE a.no_trans = '$id_pembg'";
      $data['list'] = $this->db->query($query)->row_array();

      //nyari no produk di produksinyaaa
      $this->db->where('no_trans', $id_prod1);
      $data['no_produk'] = $this->db->get('detail_produksi_ke1')->row()->no_produk;

      //status
      $this->db->where('no_trans', $id);
      $data['status'] = $this->db->get('penjualan_ips')->row()->status;

      //ips
      $data['ips'] = $this->db->get('konsumen_ips')->result_array();

      //detail

      $this->db->where('no_trans',$id);
      $this->db->select('nama_ips, jumlah,subtotal,');
      $this->db->from('detail_penjualan_ips a');
      $this->db->join('konsumen_ips b', 'a.no_ips = b.no_ips');
      $data['detail'] = $this->db->get()->result_array();

     
  

    

    
      $this->template->load('template', 'penjs/update', $data);
      // var_dump($data['list']);
   }


   public function tambah_penjs0(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'total' => '0',
               'no_trans_pembg' => $_POST['no_trans_pembg']);
      $this->db->insert('penjualan_ips', $data);

      redirect('c_transaksi/lihat_penjs');
   }

  

   public function tambah_penjs(){
        $config = array(
            
            array(
               'field' => 'no_ips',
               'label' => 'Nama Konsumen IPS',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_trans'];
            $this->isi_edit_penjs($id);
         } else {
           $id = $_POST['no_trans'];
           $id_pembg = $_POST['id_pembg'];

            $_POST['subtotal'] = $_POST['harga'] * $_POST['jumlah'];
            $data = array(
               'no_trans' => $_POST['no_trans'],
               'no_produk' => $_POST['no_produk'],
               'jumlah' => $_POST['jumlah'],
               'subtotal' => $_POST['subtotal'],
               'no_ips' => $_POST['no_ips']
            );
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk'], 'no_ips' => $_POST['no_ips']));
            $cek =  $this->db->get('detail_penjualan_ips')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_penjualan_ips', $data);
            $this->isi_edit_penjs($id, $id_pembg);
            }else{
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
            $this->db->set('subtotal', "subtotal +".$_POST['subtotal']."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk'], 'no_ips' => $_POST['no_ips']));
            $this->db->update('detail_penjualan_ips');
            $this->isi_edit_penjs($id, $id_pembg);
            
         }
         
       
         }
   }

   public function selesai_penjs($id, $total, $jumlah){


      $this->db->set('status', "1", FALSE);
      $this->db->set('total', $total);
      $this->db->where('no_trans', $id);
      $this->db->update('penjualan_ips');

         

       $this->m_keuangan->GenerateJurnal('1111', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('4111', $id, 'k', $total);

      //ngurang produk
      $this->db->set('stok', "stok - ".$jumlah."", FALSE);
            $this->db->like('nama_produk', 'Susu Sapi', 'none');
            $this->db->update('produk');

      //kartu stok
      redirect('c_transaksi/lihat_penjs');   

   }

   

   //PENJUALAN toko

   public function lihat_penjt(){

      $data['result'] = $this->db->get('penjualan_toko')->result_array();
      $this->template->load('template', 'penjt/view', $data);
   }

   public function form_penjt(){
       $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM penjualan_toko";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PENJT_" . $kd;
         $data['id'] = $no_trans;
         $id = $no_trans;
      $this->db->where('no_trans', $id);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_penjualan_toko')->row()->subtotal;
      $data['barang'] = $this->db->get('produk')->result_array();
      $this->db->where('no_trans', $id);
      $this->db->select('nama_produk, a.jumlah, subtotal, harga, satuan');
      $this->db->from('detail_penjualan_toko a');
      $this->db->join('produk b', 'a.no_produk = b.no_produk');
      $data['detail'] = $this->db->get()->result_array();

      $this->template->load('template', 'penjt/form', $data);

   }

   public function tambah_penjt(){
        $config = array(
            
            
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
          
            $this->form_penjt();
         } else {
            $this->db->where('no_produk', $_POST['no_produk']);
            $this->db->select('harga');
            $harga = $this->db->get('produk')->row()->harga;
            $_POST['subtotal'] = $harga * $_POST['jumlah'];
            $data = array(
               'no_trans' => $_POST['no_trans'],
               'no_produk' => $_POST['no_produk'],
               'jumlah' => $_POST['jumlah'],
               'subtotal' => $_POST['subtotal']
            );
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk']));
            $cek =  $this->db->get('detail_penjualan_tp')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_penjualan_toko', $data);
            $this->form_penjt();
            }else{
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
             $this->db->set('subtotal', "subtotal +".$_POST['subtotal']."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk']));
            $this->db->update('detail_penjualan_toko');
            redirect('c_transaksi/form_penjt');
            
         }
         
       
         }
   }

   public function selesai_penjt($id, $total){
      $data =  array('no_trans' => $id,
                     'tgl_trans' => date('Y-m-d'),
                     'total' => $total,
                     'status' => '1' );
      $this->db->insert('penjualan_toko', $data);

       $this->m_keuangan->GenerateJurnal('111', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('411', $id, 'k', $total);
      redirect('c_transaksi/lihat_penjt');

   }

   public function isi_edit_penjt($id){
      $data['id'] = $id;
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('penjualan_toko')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('penjualan_toko')->row()->tgl_trans;

     
      //DETAIL
      $this->db->select('nama_produk, a.jumlah, harga,satuan');
      $this->db->from('detail_penjualan_toko a');
      $this->db->join('produk c', 'a.no_produk = c.no_produk');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

    

    
      $this->template->load('template', 'penjt/update', $data);
   }

   //---------------------------------------------------------------------------------- 
   
    public function lihat_pemby(){
      $data['result'] = $this->db->get('pembayaran')->result_array();
        $this->template->load('template', 'pemby/view', $data);
   }

   public function isi_edit_pemby($id){
      $data['id'] = $id;
      $data['no_trans'] = $id;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('pembayaran')->row()->tgl_trans;

      $this->db->where('no_trans', $id);
      $this->db->select('status');
      $data['cek'] = $this->db->get('pembayaran')->row()->status;

      //beban beban
      $this->db->like('no_coa', '522', 'AFTER');
      $data['beban'] = $this->db->get('coa')->result_array();

      //DETAIL
      $this->db->select('a.no_coa, nama_coa, subtotal');
      $this->db->from('detail_pembayaran a');
      $this->db->join('coa b', 'a.no_coa = b.no_coa');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

      //CEK SELESAI BELANJA JADI NON KLIKK!

      // $data['cek_selesai'] = $this->db->query($query1)->num_rows();
      $this->db->where('no_trans', $id);
      $data['cek_selesai'] = $this->db->get('detail_pembayaran')->num_rows();

      //UPDATE TABEL PEMBELIAN_BB
      $this->db->where('no_trans', $id);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_pembayaran')->row()->subtotal;


   
      $this->template->load('template', 'pemby/update', $data);
      // var_dump($data['cek_selesai']);
   }

   public function form_pemby(){
          $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM pembayaran";
         $abc      = $this->db->query($query1);
         $no_trans = "";
         if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
               $tmp = ((int) $k->kode) + 1;
               $kd  = sprintf("%03s", $tmp);
            }
         } else {
            $kd = "001";
         }
         $no_trans   = "PMBY_" . $kd;
         $data['id'] = $no_trans;

         $this->template->load('template', 'pemby/form', $data);
   }

   public function tambah_pemby(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'total' => '0');
      $this->db->insert('pembayaran', $data);

      redirect('c_transaksi/lihat_pemby');
   }

   public function tambah_pemby1(){
       $data = array('no_trans' => $_POST['no_trans'],
                     'no_coa' => $_POST['no_coa'],
                     'subtotal' => $_POST['jumlah']);

      

       $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_coa' => $_POST['no_coa']));
            $cek =  $this->db->get('detail_pembayaran')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_pembayaran', $data);

    
            
            }else{
            $this->db->set('subtotal', "subtotal + ".$_POST['jumlah']."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_coa' => $_POST['no_coa']));
            $this->db->update('detail_pembayaran');

             $this->db->set('subtotal', "subtotal + ".$_POST['jumlah']."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_coa' => $_POST['no_coa']));
            $this->db->update('detail_pembayaran');


           
   }

    redirect('c_transaksi/isi_edit_pemby/'.$_POST['no_trans'].'');
}

   public function selesai_pemby($id,$total){
      $this->db->set('total', $total);
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('pembayaran');


      $this->db->where('no_trans', $id);
      $list = $this->db->get('detail_pembayaran')->result_array();
      foreach ($list as $data) {
         # code...
         $id = $data['no_trans'];
         $total = $data['subtotal'];
         $no_coa = $data['no_coa'];
          $this->m_keuangan->GenerateJurnal($no_coa, $id, 'd', $total);
           $this->m_keuangan->GenerateJurnal('1111', $id, 'k', $total);

      }

      redirect('c_transaksi/isi_edit_pemby/'.$id.'');
   } 




 }