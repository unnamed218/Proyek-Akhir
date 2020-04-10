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



      //ISI PEMBELIAN 
   //    $query1 = "SELECT nama_bb, b.jumlah*c.jumlah as jumlah, harga,satuan,no_bbp
   // FROM pembelian_bb a 
   // JOIN detail_target_produksi b ON a.no_tp = b.no_tp
   // JOIN bom c ON c.no_produk = b.no_produk
   // JOIN bahan_baku d ON d.no_bb = c.no_bbp
   // WHERE a.no_trans = '$id' AND c.no_bbp NOT IN
   // (SELECT no_bb FROM detail_pembelian_bb WHERE no_trans = '$id')";
   //    $data['result1'] = $this->db->query($query1)->result_array();
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

         // $this->db->select('a.no_tp, status, no_bbp');
         // $this->db->from('target_produksi a');
         // $this->db->join('detail_target_produksi b', 'a.no_tp = b.no_tp');
         // $this->db->join('bom c', 'c.no_produk = b.no_produk');
         // $this->db->where('status', '1');
         // $this->db->group_by('a.no_tp');
         // $data['result'] = $this->db->get()->result_array();
         $this->template->load('template', 'pemb/form', $data);
   }

   public function tambah_pemb(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'total' => '0');
      $this->db->insert('pembelian_bb', $data);

      // $this->db->where('no_tp', $_POST['no_tp']);
      // $this->db->set('status', '2');
      // $this->db->update('target_produksi');
      redirect('c_transaksi/lihat_pemb');
   }

   public function tambah_pemb1(){
      $data = array('no_trans' => $_POST['no_trans'],
                  'no_bb' => $_POST['no_bb'],
                  'jumlah' => $_POST['jumlah'],
                  'subtotal' => $_POST['jumlah']*$_POST['harga'],
                  'no_peternak' => $_POST['no_peternak']);
      $this->db->insert('detail_pembelian_bb', $data);

    $this->db->set('stok', "stok +".$_POST['jumlah']."",FALSE);
    $this->db->where('no_bb', $_POST['no_bb']);
    $this->db->update('bahan_baku');

    redirect('c_transaksi/isi_edit_pemb/'.$_POST['no_trans'].'');
   }

   public function selesai_pemb($id,$total){
      $this->db->set('total', $total);
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('pembelian_bb');

       $this->m_keuangan->GenerateJurnal('112', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('111', $id, 'k', $total);
      redirect('c_transaksi/isi_edit_pemb/'.$id.'');
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
      $data['no_trans_pembb'] = $this->db->get('produksi_ke1')->row()->no_trans_pembb;
      $data['peternak'] = $this->db->get('peternak')->result_array();

      
      //bom
      $this->db->select('a.jumlah, b.nama_bb, b.harga, b.satuan, c.jumlah as jumlahbb');
      $this->db->from('bom a');
      $this->db->join('bahan_baku b', 'a.no_bbp = b. no_bb');
      $this->db->join('detail_pembelian_bb c', 'b.no_bb = c.no_bb');
      $this->db->where('c.no_trans', $data['no_trans_pembb']);
      $this->db->group_by('b.no_bb');

      $data['bom'] = $this->db->get()->result_array();  
    
     //jumlah produksi

      $this->db->where('no_trans', $data['no_trans_pembb']);
      $data['jmlprod'] = $this->db->get('detail_pembelian_bb')->row()->jumlah;

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
         $data['pbb'] = $this->db->get('pembelian_bb')->result_array();



         $this->template->load('template', 'prod1/form', $data);
   }

   public function tambah_produksi_ke1(){
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'no_trans_pembb' => $_POST['no_trans_pembb']);
      $this->db->insert('produksi_ke1', $data);

      $this->db->where('no_trans', $_POST['no_trans_pembb']);
      $this->db->set('status', '2');
      $this->db->update('pembelian_bb');
      redirect('c_transaksi/lihat_produksi_ke1');
   }

   public function selesai_produksi_ke1($id,$bbb,$jumlah,$no_prod){
      
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('produksi_ke1');

      //input ke detail produksi ke 1
      $data = array('no_trans' => $id,
               'no_produk' => $no_prod,
               'bbb' => $bbb,
               'btk' => '0',
               'bop' => '0',
               'jumlah' => $jumlah );
      $this->db->insert('detail_produksi_ke1', $data);

      //input ke stok produk

        $this->db->set('stok', "stok + ".$jumlah."", FALSE);
      $this->db->where('no_bdp', 'BDP_001');
      $this->db->update('bahan_dalam_proses');


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

      $data['cek'] = $this->db->get('pembagian')->row()->status; 

      
      $this->template->load('template', 'pembagian/update', $data);
      // var_dump($data['cek_selesai']);
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

      //input ke detail pembagian
      $data = array( 'no_trans' => $_POST['no_trans'],
                     'jual' => $_POST['jual'],
                     'produksi' => $_POST['produksi'] );
      $this->db->insert('detail_pembagian', $data);

      //update ke stok produk
      $jual = 0;
      $jual = $_POST['jumlah'] * ($_POST['jual'] / 100);
      $this->db->set('stok', "stok - ".$jual."", FALSE);
      $this->db->where('no_bdp', 'BDP_001');
      $this->db->update('bahan_dalam_proses');

      //update stok produk
      $this->db->set('stok', "stok + ".$jual."", FALSE);
      $this->db->where('no_produk', 'PR_005');
      $this->db->update('produk');


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

         $this->db->select('jumlah');
         $this->db->from('target_produksi a');
         $this->db->join('pembagian b', 'a.no_trans_pembagian = b.no_trans');
         $this->db->join('detail_produksi_ke1 c', 'c.no_trans = b.no_trans_produksi1');
         $this->db->where('a.no_tp', $id);
         $x['jumlah'] = $this->db->get()->row()->jumlah;

         $x['result'] = $this->db->get('produk')->result_array(); 
         
         $this->db->where('a.no_tp', $id);
         $this->db->select('a.no_produk, nama_produk, jumlah, a.no_tp, satuan,status');
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
                  WHERE a.no_tp = 'TP_018'
UNION
SELECT nama_bp, sum(a.jumlah) * c.jumlah as jumlah_bom, d.harga, d.satuan, c.no_bbp
FROM detail_target_produksi a
JOIN produk b ON a.no_produk = b.no_produk
JOIN bom c ON c.no_produk = b.no_produk
JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
WHERE a.no_tp = 'TP_018' AND NOT c.no_bbp = 'BB_001'
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

      $this->m_keuangan->GenerateJurnal('113', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('111', $id, 'k', $total);
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


    public function isi_edit_produksi_ke2($id){
      $data['id'] = $id;

      //nyari produk
      $this->db->select('no_produk');
      $this->db->from('detail_target_produksi a');
      $this->db->join('produksi_ke2 b', 'a.no_tp = b.no_tp');
      $this->db->where('no_trans', $id);
      $data['no_produk'] = $this->db->get()->row()->no_produk;


      $data['no_trans'] = $id; 
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('produksi_ke1')->row()->tgl_trans;
      $this->db->where('no_trans', $id);
      $data['no_trans_pembb'] = $this->db->get('produksi_ke1')->row()->no_trans_pembb;
      $data['peternak'] = $this->db->get('peternak')->result_array();

      
      //bom
      $this->db->select('a.jumlah, b.nama_bb, b.harga, b.satuan, c.jumlah as jumlahbb');
      $this->db->from('bom a');
      $this->db->join('bahan_baku b', 'a.no_bbp = b. no_bb');
      $this->db->join('detail_pembelian_bb c', 'b.no_bb = c.no_bb');
      $this->db->where('c.no_trans', $data['no_trans_pembb']);
      $this->db->group_by('b.no_bb');

      $data['bom'] = $this->db->get()->result_array();  
    
     //jumlah produksi

      $this->db->where('no_trans', $data['no_trans_pembb']);
      $data['jmlprod'] = $this->db->get('detail_pembelian_bb')->row()->jumlah;

           //cek selesai produksi
      $this->db->where('no_trans', $id);
      $data['cek'] = $this->db->get('detail_produksi_ke1')->num_rows();


      
      $this->template->load('template', 'prod1/update', $data);
      // var_dump($data['cek_selesai']);
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

   public function selesai_produksi_ke2($id,$bbb,$jumlah,$no_prod){
      
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('produksi_ke1');

      //input ke detail produksi ke 1
      $data = array('no_trans' => $id,
               'no_produk' => $no_prod,
               'bbb' => $bbb,
               'btk' => '0',
               'bop' => '0',
               'jumlah' => $jumlah );
      $this->db->insert('detail_produksi_ke1', $data);

      //input ke stok produk

        $this->db->set('stok', "stok + ".$jumlah."", FALSE);
      $this->db->where('no_bdp', 'BDP_001');
      $this->db->update('bahan_dalam_proses');


      redirect('c_transaksi/isi_edit_produksi_ke1/'.$id.'');
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
      $this->db->where('no_trans', $id);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_penjualan_ips')->row()->subtotal;
      $data['ips'] = $this->db->get('konsumen_ips')->result_array();

      $this->db->where('no_trans', $id);
      $this->db->select('nama_produk, a.jumlah, subtotal, nama_ips, harga, satuan');
      $this->db->from('detail_penjualan_ips a');
      $this->db->join('produk b', 'a.no_produk = b.no_produk');
      $this->db->join('konsumen_ips c', 'c.no_ips = a.no_ips');
      $data['detail'] = $this->db->get()->result_array();

   	$this->template->load('template', 'penjs/form', $data);

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
          
            $this->form_penjs();
         } else {
            $this->db->where('no_produk', $_POST['no_produk']);
            $this->db->select('harga');
            $harga = $this->db->get('produk')->row()->harga;
            $_POST['subtotal'] = $harga * $_POST['jumlah'];
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
            $this->form_penjs();
            }else{
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk'], 'no_ips' => $_POST['no_ips']));
            $this->db->update('detail_penjualan_ips');
            redirect('c_transaksi/form_penjs');
            
         }
         
       
         }
   }

   public function selesai_penjs($id, $total){
      $data =  array('no_trans' => $id,
                     'tgl_trans' => date('Y-m-d'),
                     'total' => $total,
                     'status' => '1' );
      $this->db->insert('penjualan_ips', $data);

       $this->m_keuangan->GenerateJurnal('111', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('411', $id, 'k', $total);
      redirect('c_transaksi/lihat_penjs');

   }

   public function isi_edit_penjs($id){
      $data['id'] = $id;
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('penjualan_ips')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('penjualan_ips')->row()->tgl_trans;

     
      //DETAIL
      $this->db->select('nama_produk, a.jumlah, harga,satuan,nama_ips');
      $this->db->from('detail_penjualan_ips a');
      $this->db->join('konsumen_ips b', 'a.no_ips = b.no_ips');
      $this->db->join('produk c', 'a.no_produk = c.no_produk');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

    

    
      $this->template->load('template', 'penjs/update', $data);
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



 }