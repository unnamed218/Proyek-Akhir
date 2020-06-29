   <?php
class c_transaksi extends CI_controller{

	 // function __construct(){
  //       parent:: __construct();
  //      if(empty($this->session->userdata('level'))){
  //           redirect('c_login/home');
  //       }
  //   }
      function __construct(){
        parent:: __construct();
         date_default_timezone_set('Asia/Jakarta');
       if(empty($this->session->userdata('level'))){
            redirect('c_login/home');
        }
    }
 //PEMBELIAN BAHAN BAKU
   public function lihat_pemb(){
   
    $this->db->where('tgl_trans', date('Y-m-d'));
    $cek_kualitas = $this->db->get('cek_kualitas')->result();
    $data['cek'] = $cek_kualitas;
    $data['error'] = "Pembelian hari ini sudah selesai!";
      $data['result'] = $this->db->get('pembelian_bb')->result_array();
        $this->template->load('template', 'pemb/view', $data);
      // var_dump($cek1);
   }

   public function isi_edit_pemb($id){
      $data['id'] = $id;
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('pembelian_bb')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('pembelian_bb')->row()->tgl_trans;
     

      $this->db->where('no_trans', $id);
      $this->db->select('status');
      $data['cek'] = $this->db->get('pembelian_bb')->row()->status;

      //DETAIL
      $this->db->select('nama_bb, a.jumlah, harga,satuan,nama_peternak, a.no_peternak');
      $this->db->from('detail_pembelian_bb a');
      $this->db->join('peternak b', 'a.no_peternak = b.no_peternak');
      $this->db->join('bahan_baku c', 'a.no_bb = c.no_bb');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

      //CEK SELESAI BELANJA JADI NON KLIKK!

     

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


      //UPDATE TABEL PEMBELIAN_BB
      $this->db->where('no_trans', $no_trans);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_pembelian_bb')->row()->subtotal;

      //kondisi di tambah pembeliannya
      $this->db->where('no_trans', $no_trans);
      $this->db->select_sum('jumlah');
      $data['cek_jml_pmb'] = $this->db->get('detail_pembelian_bb')->row()->jumlah;


       // $data['cek_selesai'] = $this->db->query($query1)->num_rows();
      $this->db->where('no_trans', $no_trans);
      $data['cek_selesai'] = $this->db->get('detail_pembelian_bb')->num_rows();
       $data['peternak'] = $this->db->get('peternak')->result_array();

       $this->db->select_sum('subtotal');
       $this->db->where('no_trans', $no_trans);
       $data['total'] = $this->db->get('detail_pembelian_bb')->row()->subtotal;


      $this->db->select('nama_bb, a.jumlah, harga,satuan,nama_peternak, a.no_peternak');
      $this->db->from('detail_pembelian_bb a');
      $this->db->join('peternak b', 'a.no_peternak = b.no_peternak');
      $this->db->join('bahan_baku c', 'a.no_bb = c.no_bb');
      $this->db->where('no_trans', $no_trans);
      $data['detail'] = $this->db->get()->result_array();

         $this->template->load('template', 'pemb/form', $data);
      // var_dump($data['cek_jml_pmb']);
   }

   public function tambah_pemb(){
      $config = array(
            
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah',
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            ),
            array(
               'field' => 'no_peternak',
               'label' => 'Nama Peternak',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'harga',
               'label' => 'Harga',
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_pemb();
         } else {
            // $id = $_POST['no_trans'];
            // $this->db->where('no_trans', $id);
            // $this->db->select_sum('jumlah');
            // $cek = $this->db->get('detail_pembelian_bb')->row()->jumlah;
            // $total = $cek + $_POST['jumlah'];
            // $jumlah_total = 150000;
            // if($total <= $jumlah_total){
               $this->db->where('no_bb', $_POST['no_bb']);
      $harga = $_POST['harga'];
       $data = array('no_trans' => $_POST['no_trans'],
                  'no_bb' => $_POST['no_bb'],
                  'jumlah' => $_POST['jumlah'],
                  'harga' => $harga,
                  'subtotal' => $_POST['jumlah']*$harga,
                  'no_peternak' => $_POST['no_peternak']);

       $subtotal = $_POST['jumlah'] * $harga;

      

       $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_peternak' => $_POST['no_peternak'], 'harga' => $_POST['harga']));
            $cek =  $this->db->get('detail_pembelian_bb')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_pembelian_bb', $data);
             
            }else{

            $this->db->set('subtotal', "subtotal + ".$subtotal."", FALSE);
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
             $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_peternak' => $_POST['no_peternak'], 'harga' => $_POST['harga']));
            $this->db->update('detail_pembelian_bb');   
           
                 }
                  redirect('c_transaksi/form_pemb');

                  ////////////////////////////////////////////////////////////
                  ///////////////////////////////////////////////////////////
   //          }else{
   //              $data['error'] = 'Jumlah pembelian melebihi batasan pembelian!';
   //               $query1   = "SELECT  MAX(RIGHT(no_trans,3)) as kode FROM pembelian_bb";
   //       $abc      = $this->db->query($query1);
   //       $no_trans = "";
   //       if ($abc->num_rows() > 0) {
   //          foreach ($abc->result() as $k) {
   //             $tmp = ((int) $k->kode) + 1;
   //             $kd  = sprintf("%03s", $tmp);
   //          }
   //       } else {
   //          $kd = "001";
   //       }
   //       $no_trans   = "PMB_" . $kd;
   //       $data['id'] = $no_trans;


   //    //UPDATE TABEL PEMBELIAN_BB
   //    $this->db->where('no_trans', $no_trans);
   //    $this->db->select_sum('subtotal');
   //    $data['total'] = $this->db->get('detail_pembelian_bb')->row()->subtotal;

   //    //kondisi di tambah pembeliannya
   //    $this->db->where('no_trans', $no_trans);
   //    $this->db->select_sum('jumlah');
   //    $data['cek_jml_pmb'] = $this->db->get('detail_pembelian_bb')->row()->jumlah;


   //     // $data['cek_selesai'] = $this->db->query($query1)->num_rows();
   //    $this->db->where('no_trans', $no_trans);
   //    $data['cek_selesai'] = $this->db->get('detail_pembelian_bb')->num_rows();
   //     $data['peternak'] = $this->db->get('peternak')->result_array();

   //     $this->db->select_sum('subtotal');
   //     $this->db->where('no_trans', $no_trans);
   //     $data['total'] = $this->db->get('detail_pembelian_bb')->row()->subtotal;


   //    $this->db->select('nama_bb, a.jumlah, harga,satuan,nama_peternak, a.no_peternak');
   //    $this->db->from('detail_pembelian_bb a');
   //    $this->db->join('peternak b', 'a.no_peternak = b.no_peternak');
   //    $this->db->join('bahan_baku c', 'a.no_bb = c.no_bb');
   //    $this->db->where('no_trans', $no_trans);
   //    $data['detail'] = $this->db->get()->result_array();

   //       $this->template->load('template', 'pemb/form', $data);
               
   // }
 }
}

  
   public function selesai_pemb($id,$total){
      $data = array('no_trans' => $id, 
                    'tgl_trans' => date('Y-m-d'),
                    'total' => $total,
                    'status' => '1');
      $this->db->insert('pembelian_bb', $data);

      redirect('c_transaksi/lihat_pemb');
   }

    //Cek kualitas
   public function lihat_ck(){
     $this->db->where('tgl_trans', date('Y-m-d'));
    $cek = $this->db->get('cek_kualitas')->result();
    $date = date('Y-m-d');
     $query1   = "SELECT  MAX(no_trans) as kode FROM cek_kualitas";
     $cek_trans = $this->db->query($query1)->row_array();
     $cek_trans1 = $cek_trans['kode'];
     $query2 = "SELECT * FROM cek_kualitas
                WHERE no_trans = '$cek_trans1' AND status > 0";
      $cek1 = $this->db->query($query2)->result();
    $data['cek'] = $cek;
    $data['cek1'] = $cek1;  
    if($cek1 == TRUE){
       $data['error'] = 'Cek Kualitas untuk hari ini sudah dilakukan!';
    }

      $data['result'] = $this->db->get('cek_kualitas')->result_array();
        $this->template->load('template', 'ck/view', $data);
      // var_dump($query2);
   }

   public function isi_edit_ck($id){
      $data['no_trans'] = $id;
     
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('cek_kualitas')->row()->tgl_trans;
   
     


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
         $this->db->select('a.no_trans, a.tgl_trans');
         $this->db->select_sum('jumlah');
         $this->db->from('pembelian_bb a');
         $this->db->join('detail_pembelian_bb b', 'a.no_trans = b.no_trans');
         $this->db->group_by('a.no_trans');
         $data['pbb'] = $this->db->get()->result_array();

         //detail
         $this->db->where('no_trans', $no_trans);
         $data['detail'] = $this->db->get('detail_cek_kualitas')->result_array();

         //cek total lulus
         $this->db->select_sum('lulus');
         $this->db->where('no_trans', $no_trans);
         $data['cek_lulus'] = $this->db->get('detail_cek_kualitas')->row_array()['lulus'];

         $this->template->load('template', 'ck/form', $data);
         // var_dump($data['cek_lulus']);
   }

   public function tambah_ck(){
       $config = array(
         
            array(
               'field' => 'pbb',
               'label' => 'ID Pembelian Bahan baku',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
             array(
               'field' => 'lulus',
               'label' => 'Lulus Uji Lab',
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_ck();
         } else {
           $id_pmb = $_POST['pbb'];
          $id = $_POST['no_trans'];
          $this->db->where('no_trans', $id);
          $this->db->select_sum('lulus');
          $cek_lulus = $this->db->get('detail_cek_kualitas')->row_array()['lulus'];
          $total_lulus = $cek_lulus + $_POST['lulus'];
            if($total_lulus <= 140000){
         
        $this->db->where('no_trans', $id_pmb);
        $this->db->select_sum('jumlah');
        $jumlah = $this->db->get('detail_pembelian_bb')->row_array()['jumlah'];
        $gagal = $jumlah - $_POST['lulus'];

        $this->db->where('no_trans', $id_pmb);
        $this->db->select_sum('subtotal');
        $subtotal = $this->db->get('detail_pembelian_bb')->row_array()['subtotal'];
        
       $data = array('no_trans' => $id,
                  'no_trans_pmb' => $id_pmb,
                  'lulus' => $_POST['lulus'],
                  'gagal' => $gagal,
                  'total' => $jumlah,
                  'subtotal' => $subtotal);

        $this->db->insert('detail_cek_kualitas', $data);


           $this->db->set('status', '2',FALSE);
            $this->db->where('no_trans', $id_pmb);
            $this->db->update('pembelian_bb');
        
       redirect('c_transaksi/form_ck');
     }else{
      $data['error'] = 'Jumlah lulus melebihi batasan (140.000 Liter)!';
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
         $this->db->select('a.no_trans, a.tgl_trans');
         $this->db->select_sum('jumlah');
         $this->db->from('pembelian_bb a');
         $this->db->join('detail_pembelian_bb b', 'a.no_trans = b.no_trans');
         $this->db->group_by('a.no_trans');
         $data['pbb'] = $this->db->get()->result_array();

         //detail
         $this->db->where('no_trans', $no_trans);
         $data['detail'] = $this->db->get('detail_cek_kualitas')->result_array();

         //cek total lulus
         $this->db->select_sum('lulus');
         $this->db->where('no_trans', $no_trans);
         $data['cek_lulus'] = $this->db->get('detail_cek_kualitas')->row_array()['lulus'];


         $this->template->load('template', 'ck/form', $data);
     }
   }
   }

   public function selesai_ck($id){
      

      $data = array('no_trans' => $id,
                    'tgl_trans' => date('Y-m-d'),
                    'status' => '1');
      $this->db->insert('cek_kualitas', $data);

      $this->db->where('no_trans', $id);
      $this->db->select_sum('lulus');
      $lulus = $this->db->get('detail_cek_kualitas')->row_array()['lulus'];

      $this->db->set('stok', "stok +".$lulus."",FALSE);
      $this->db->where('no_bb', 'BB_001');
      $this->db->update('bahan_baku');

      //kartu stok
     
      $this->db->where('no_trans', $id);
      $this->db->select_sum('subtotal');
      $subtotal = $this->db->get('detail_cek_kualitas')->row_array()['subtotal'];

      $this->db->where('no_trans', $id);
      $this->db->select_sum('total');
      $ttl = $this->db->get('detail_cek_kualitas')->row_array()['total'];
      
      $total = ($lulus / $ttl) * $subtotal;
       $this->m_keuangan->GenerateJurnal('1112', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('1111', $id, 'k', $total);


       //--------------------------------------------------------------------------//
      // kartu stok
       $data1 = array('no_trans' => $id,
                     'tgl_trans' => date('Y-m-d'),
                     'no_bb' => 'BB_001',
                     'unit' => $lulus,
                     'total' => $total);
       $this->db->insert('kartu_stok_bb', $data1);
      redirect('c_transaksi/lihat_ck');
  
   
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

         $data['bp'] = $this->db->get('bahan_penolong')->result_array();
         $data['supp'] = $this->db->get('supplier_bp')->result_array();

         $this->db->where('no_trans', $no_trans);
         $this->db->select_sum('subtotal');
         $data['total'] = $this->db->get('detail_pembelian_bp')->row_array()['subtotal'];

         $this->db->where('no_trans', $no_trans);
         $this->db->select('no_trans, nama_bp,satuan,harga, jumlah, a.no_supp_bp, nama_supp_bp');
         $this->db->from('detail_pembelian_bp a');
         $this->db->join('bahan_penolong b', 'a.no_bp = b.no_bp');
         $this->db->join('supplier_bp c', 'a.no_supp_bp = c.no_supp_bp');
         $data['detail'] = $this->db->get()->result_array();


         $this->template->load('template', 'pembp/form', $data);
   }

   public function tambah_pembp(){
       $config = array(
            
            array(
               'field' => 'no_bp',
               'label' => 'Bahan Penolong',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah',
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            ),
            array(
               'field' => 'harga',
               'label' => 'Harga',
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            ),
            array(
               'field' => 'no_supp_bp',
               'label' => 'Supplier',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_pembp();
         } else {
        $subtotal =0;
        $subtotal = $_POST['jumlah'] * $_POST['harga'];
        $data = array('no_trans' => $_POST['no_trans'],
                    'no_bp' => $_POST['no_bp'],
                    'jumlah' => $_POST['jumlah'],
                    'harga' => $_POST['harga'],
                    'subtotal' => $subtotal,
                    'no_supp_bp' => $_POST['no_supp_bp'],
                    'jumlah_kartu_stok' => $_POST['jumlah']);

         $this->db->set('stok', "stok + ".$_POST['jumlah']."", FALSE);
          $this->db->where('no_bp', $_POST['no_bp']);
          $this->db->update('bahan_penolong');  

         $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_supp_bp' => $_POST['no_supp_bp'], 'no_bp' => $_POST['no_bp'], 'harga' => $_POST['harga']));
            $cek =  $this->db->get('detail_pembelian_bp')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_pembelian_bp', $data);

            }else{

            $this->db->set('subtotal', "subtotal + ".$subtotal."", FALSE);
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
            $this->db->set('jumlah_kartu_stok', "jumlah_kartu_stok + ".$_POST['jumlah']."", FALSE);
             $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_supp_bp' => $_POST['no_supp_bp'], 'no_bp' => $_POST['no_bp'], 'harga' => $_POST['harga']));
            $this->db->update('detail_pembelian_bp');   
           
                 }

    redirect('c_transaksi/form_pembp');
   }
   }

     
   public function selesai_pembp($id,$total){
    $data = array('no_trans' => $id,
                  'tgl_trans' => date('Y-m-d'),
                  'total' => $total,
                  'status' => '1');
    $this->db->insert('pembelian_bp', $data);
    

      $this->m_keuangan->GenerateJurnal('1113', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('1111', $id, 'k', $total);

      //--------------kartu stok----------------------------------
      // $this->db->where('a.no_trans', $id);
      // $this->db->select('a.no_trans, tgl_trans, no_bp,subtotal as total, jumlah as unit, harga');
      // $this->db->from('pembelian_bp a');
      // $this->db->join('detail_pembelian_bp b', 'a.no_trans = b.no_trans');
      // $this->db->group_by('no_bp');
      // $list = $this->db->get()->result_array();
      // foreach ($list as $data) {
      //    # code...
      //    $harga = $data['total'] / $data['unit'];
      //   if($harga == 0){
      //     $harga1 = 0;
      //   }else{
      //     $harga1 = $harga;
      //   }
      //      $data1 = array('no_trans' => $data['no_trans'],
      //                'tgl_trans' => $data['tgl_trans'],
      //                'no_bp' => $data['no_bp'],
      //                'unit1' => $data['unit'],
      //                'harga1' => $harga,
      //                'total1' => $data['total'],
      //                'unit3' => $data['unit'],
      //                'harga3' => $harga1,
      //                'total3' => $data['total'],);
      //  $this->db->insert('kartu_stok_bp', $data1);
      // }
    
      redirect('c_transaksi/lihat_pembp');
   }

   public function isi_edit_pembp($id){
      $data['id'] = $id;   
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('pembelian_bp')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('pembelian_bp')->row()->tgl_trans;

      $this->db->where('no_trans', $id);
         $this->db->select('no_trans, nama_bp,satuan,harga, jumlah, a.no_supp_bp, nama_supp_bp');
         $this->db->from('detail_pembelian_bp a');
         $this->db->join('bahan_penolong b', 'a.no_bp = b.no_bp');
         $this->db->join('supplier_bp c', 'a.no_supp_bp = c.no_supp_bp');
         $data['detail'] = $this->db->get()->result_array();
      $this->template->load('template', 'pembp/update', $data);
   }




   //MENENTUKAN TRANSAKSI PRODUKSI 1

   public function lihat_produksi_ke1(){
     $this->db->where('tgl_btk', date('Y-m-d'));
      $data['cek1'] = $this->db->get('btk')->result();
      //
      $this->db->where('tgl_bop', date('Y-m-d'));
      $data['cek2'] = $this->db->get('bop')->result();
      //
      $this->db->where('tgl_trans', date('Y-m-d'));
      $data['cek3'] = $this->db->get('produksi_ke1')->result();

      //
     $date = date('Y-m-d');
     
     $query2 = "SELECT * FROM produksi_ke1
                WHERE tgl_trans = '$date' AND status > 0";
      $cek4 = $this->db->query($query2)->result();

      
      if($data['cek1'] == FALSE OR $data['cek2'] == FALSE){
        $data['error'] = 'Master Data BOP atau BTK untuk hari ini masih kosong!';
      }

      if($cek4 == TRUE){
        $data['clear'] = 'Produksi IPS untuk hari ini sudah dilakukan!';
      }
      // $this->db->select('a.no_trans, a.tgl_trans, a.status');
      // $this->db->select_sum('jumlah');
      // $this->db->from('produksi_ke1 a');
      // $this->db->join('detail_produksi_ke1 b', 'a.no_trans = b.no_trans');
      // $data['result'] = $this->db->get()->result_array();
      $query = "SELECT a.no_trans, a.tgl_trans, a.status, ifnull(sum(jumlah),0) as jumlah
                FROM produksi_ke1 a
                LEFT JOIN detail_produksi_ke1 b ON a.no_trans = b.no_trans";
      $data['result'] = $this->db->query($query)->result_array();
      $this->template->load('template', 'prod1/view', $data);
      // var_dump($data['result']);
   }

    public function isi_edit_produksi_ke1($id){
         date_default_timezone_set('Asia/Jakarta');
         $kalender = CAL_GREGORIAN;
         $bulan = date('m');
         $tahun = date('Y');
         $hari = cal_days_in_month($kalender, $bulan, $tahun);
         $data['hari'] = $hari;
         $date = date('Y-m-d');
      $data['id'] = $id;
      $data['no_trans'] = $id; 
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('produksi_ke1')->row()->tgl_trans;

      $this->db->where('no_trans', $id);
      $id_ck = $this->db->get('produksi_ke1')->row()->no_trans_ck;
      $data['no_ck'] = $id_ck;

        //jumlah produksi

      $this->db->where('no_trans',  $data['no_ck']);
      $this->db->select_sum('lulus');
      $data['jmlprod'] = $this->db->get('detail_cek_kualitas')->row_array()['lulus'];

     

      $data['peternak'] = $this->db->get('peternak')->result_array();

    

      
      //bom
      $query = "SELECT ifnull(sum(lulus),0) as lulus, ifnull(sum(subtotal),0) as subtotal, ifnull(sum(total),0) as total
                FROM cek_kualitas a 
                JOIN detail_cek_kualitas b ON a.no_trans = b.no_trans
                WHERE a.no_trans = '$id_ck'";
                                                      
                                            
      $data['bom'] = $this->db->query($query)->result_array();  


      //bop
      $query2 = "SELECT a.no_jbop, nama_jbop, ifnull(harga,0) as harga
                FROM jenis_bop a 
                LEFT JOIN detail_bop b ON a.no_jbop = b.no_jbop
                left JOIN bop c ON c.no_bop = b.no_bop
                WHERE tgl_bop = '$date'";
      $data['bopv'] = $this->db->query($query2)->result_array();

        //biaya tenaga kerja
      $this->db->where('no_trans', $id);
      $tgl = $this->db->get('produksi_ke1')->row()->tgl_trans;
      $bulan1 = substr($tgl, 5,2);
      $tahun1 = substr($tgl, 0,4);

      $this->db->where('no_trans', $id);
      $cek = $this->db->get('produksi_ke1')->row()->status;

      if($cek == 0){
         $this->db->where('tgl_btk', date('Y-m-d'));
      $btk = $this->db->get('btk')->row()->tarif;
      }else{
        $this->db->where('no_trans', $id);
        $btk = $this->db->get('detail_produksi_ke1')->row()->btk;
      }
   
      $data['btk'] = $btk;

     
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
      // var_dump(date('Y-m-d'));
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
       $config = array(
         
            array(
               'field' => 'no_trans_ck',
               'label' => 'ID Transaksi Cek Kualitas',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_produksi_ke1();
         } else {
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
   }

   public function selesai_produksi_ke1($id,$bbb,$jumlah,$no_prod,$btk,$bop){
      date_default_timezone_set('Asia/Jakarta');
      $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('produksi_ke1');

      //input ke detail produksi ke 1
      $totalbiaya = $bbb+$btk + $bop;
      $data = array('no_trans' => $id,
               'no_produk' => $no_prod,
               'bbb' => $bbb,
               'btk' => $btk,
               'bop' => $bop,
               'jumlah' => $jumlah,
               'subtotal' => $totalbiaya );
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

      //update harga jual PR_001 / susu sapi dijual

      // $this->db->where('no_trans', $id);
      // $tgl_trans = $this->db->get('produksi_ke1')->row()->tgl_trans;

      // $data2 = array('no_trans' => $id,
      //                'tgl_trans' => $tgl_trans,
      //                'no_bb' => 'BB_001',
      //                'unit' => $jumlah,
      //                'total' => $bbb);
      //  $this->db->insert('detail_pemakaian_bb', $data2);
      //  //
      // $this->db->where('no_bb', 'BB_001');
      // $harga = $this->db->get('bahan_baku')->row()->harga;
      // $total = $harga * $jumlah;
      // $data1 = array('no_trans' => $id,
      //                'tgl_trans' => $tgl_trans,
      //                'no_bb' => 'BB_001',
      //                'unit' => 0,
      //                'total' => 0);
      //  $this->db->insert('kartu_stok_bb', $data1);
      
   

      redirect('c_transaksi/lihat_produksi_ke1');
   }


   //MENENTUKAN PEMBAGIAN BAHAN BAKU DALAM PROSES


   public function lihat_pembagian(){
    $this->db->where('tgl_trans', date('Y-m-d'));
    $cek = $this->db->get('pembagian')->result();
    $this->db->where('tgl_trans', date('Y-m-d'));
    $this->db->where('status >', '0');
    $cek1 = $this->db->get('pembagian')->result();
    $data['cek'] = $cek;
    $data['cek1'] = $cek1;
    if($cek1 == TRUE){
       $data['error'] = 'Pembagian untuk hari ini sudah dilakukan!';
    }
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

       
      $data['satuan'] = 'liter';

      
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
    

      $config = array(
            array(
               'field' => 'no_trans_produksi1',
               'label' => 'ID Transaksi Produksi IPS',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_pembagian();
         } else {
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
   }

   public function selesai_pembagian(){

        $config = array(
            array(
               'field' => 'jual',
               'label' => 'Penjualan ke IPS',
               'rules' => 'required|is_natural',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural' => '%s hanya boleh angka!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_trans'];
            $tgl = $_POST['tgl_trans'];
            $no_produk = $_POST['no_prod'];
            $this->isi_edit_pembagian($id);
         } else {
      $id = $_POST['no_trans'];
      $tgl = $_POST['tgl_trans'];
      $no_produk = $_POST['no_prod'];
      if($_POST['jual'] <= $_POST['jumlah']){
      $this->db->set('status', '1');
      $this->db->where('no_trans', $_POST['no_trans']);
      $this->db->update('pembagian');

      // $produksi = 100 - $_POST['jual'];
      $produksi = $_POST['jumlah'] - $_POST['jual'];
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
      $this->db->like('no_produk', 'PR_001', 'none');
      $this->db->update('produk');

      //update kartu stok jual
      $this->db->set('stok_jual', $_POST['jual'] , FALSE);
      $this->db->set('jumlah_kartu_stok', $_POST['jual'] , FALSE);
      $this->db->where('no_trans', $_POST['no_prod']);
      $this->db->update('detail_produksi_ke1');

      //update harga jual di masterdata produk
       $this->db->select_sum('subtotal');
      $this->db->select_sum('stok_jual');
      $query = $this->db->get('detail_produksi_ke1')->row_array();
      $totaljumlah = $query['stok_jual'];
      $totalsubtotal = $query['subtotal'];
      $harga = ((($totalsubtotal * ($totaljumlah / $_POST['jumlah'])) *1.3) / $totaljumlah);
      
       $this->db->set('harga_jual', $harga, FALSE);
      $this->db->where('no_produk', 'PR_001');
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
      $pbdp = $bbb1 + $btk1;
      $pbj = $bbb2 + $btk2;

        //jurnal persediaan dalam proses
        $this->m_keuangan->GenerateJurnal('1114', $id, 'd', $pbdp);
      $this->m_keuangan->GenerateJurnal('5111', $id, 'k', $bbb1);
       $this->m_keuangan->GenerateJurnal('5112', $id, 'k', $btk1);
       // $this->m_keuangan->GenerateJurnal('5113', $id, 'k', $qbop1);

       //jurnal persediaan jadi
       $this->m_keuangan->GenerateJurnal('1115', $id, 'd', $pbj);
       $this->m_keuangan->GenerateJurnal('5111', $id, 'k', $bbb2);
       $this->m_keuangan->GenerateJurnal('5112', $id, 'k', $btk2);
       // $this->m_keuangan->GenerateJurnal('5113', $id, 'k', $bop2);


      //tambah stok di kartu stok penjualan ips
       // $data1 = array('no_trans' => $id,
       //               'tgl_trans' => $tgl,
       //               'no_produk' => 'PR_001',
       //               'unit' => $_POST['jual'],
       //               'total' => $pbj);
       //   $this->db->insert('kartu_stok_penj_ips', $data1);


      redirect('c_transaksi/lihat_pembagian');
   }else{
      $data['error'] = 'Penjualan ke IPS telah melebihi batasan!';
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

       
      $data['satuan'] = 'liter';

      
      $this->template->load('template', 'pembagian/update', $data);
   }
   } 
   }




  //MENENTUKAN TRANSAKSI TARGET PROYEKSI
	 public function lihat_tp()
   {
      	
          $this->db->where('tgl_tp', date('Y-m-d'));
    $cek = $this->db->get('target_produksi')->result();
    $this->db->where('tgl_tp', date('Y-m-d'));
    $this->db->where('status >', '0');
    $cek1 = $this->db->get('target_produksi')->result();
    $data['cek'] = $cek;
    $data['cek1'] = $cek1;
    if($cek1 == TRUE){
       $data['error'] = 'Target Produksi untuk hari ini sudah dilakukan!';
    }
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
            ),
            array(
               'field' => 'no_trans_pembagian',
               'label' => 'ID Transaksi Pembagian',
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
      	$x['status'] = $this->db->get('target_produksi')->row()->status;
         
         
         $x['data'] = $this->m_masterdata->edit_data('target_produksi', "no_tp = '$id'")->row_array();


         $query3 = "SELECT ifnull(produksi,0) as jumlah
                  FROM target_produksi a
                  JOIN pembagian b ON a.no_trans_pembagian = b.no_trans
                  JOIN detail_produksi_ke1 c ON c.no_trans = b.no_trans_produksi1
                  JOIN detail_pembagian d ON d.no_trans = b.no_trans
                  WHERE a.no_tp = '$id'";
          $x['jumlah'] = $this->db->query($query3)->row()->jumlah;
    
         $this->db->or_not_like('nama_produk', 'Susu Sapi', 'none');
         $this->db->select('a.no_produk, a.nama_produk, satuan');
         $this->db->from('produk a');
         $this->db->join('bom b', 'a.no_produk = b.no_produk');
         $this->db->group_by('a.no_produk');
         $x['result'] = $this->db->get()->result_array(); 
         
         $this->db->where('a.no_tp', $id);
         $this->db->select('a.no_produk, nama_produk, jumlah, a.no_tp, satuan, c.status');
         $this->db->from('detail_target_produksi a');
         $this->db->join('produk b', 'a.no_produk = b.no_produk');
         $this->db->join('target_produksi c', 'a.no_tp = c.no_tp');
         $this->db->order_by('no');
         $x['result1'] = $this->db->get()->result_array();

         //ISI BOM 
      $query1 =   "
SELECT nama_bb, sum(a.jumlah) * c.jumlah as jumlah_bom, d.satuan, c.no_bbp
FROM detail_target_produksi a
JOIN produk b ON a.no_produk = b.no_produk
JOIN bom c ON c.no_produk = b.no_produk
JOIN bahan_baku d ON d.no_bb = c.no_bbp 
WHERE a.no_tp = '$id'
UNION
SELECT nama_bp, sum(a.jumlah) * c.jumlah as jumlah_bom, d.satuan, c.no_bbp
FROM detail_target_produksi a
JOIN produk b ON a.no_produk = b.no_produk
JOIN bom c ON c.no_produk = b.no_produk
JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
WHERE a.no_tp = '$id' AND NOT c.no_bbp = 'BB_001'
group by no_bbp";
      $x['result2'] = $this->db->query($query1)->result_array();
         $x['id'] = $id;
         $query = "SELECT ifnull(sum(jumlah),0) as jumlah
                  FROM detail_target_produksi
                  WHERE no_tp = '$id'";
         $x['cek'] = $this->db->query($query)->row_array()['jumlah'];
         $this->template->load('template', 'tp/update', $x);
       
      
   }


   public function edit_tp(){
      
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
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                   'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
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
            $this->db->where('no_tp', $id);
            $this->db->select_sum('jumlah');
            $jml = $this->db->get('detail_target_produksi')->row()->jumlah;
            $cek_jml = $jml + $_POST['jumlah'];
             

              if($cek_jml <= $_POST['produksi']){
            $data = array(
               'no_tp' => $_POST['no_tp'],
               'no_produk' => $_POST['no_produk'],
               'jumlah' => $_POST['jumlah']
            );
            $this->db->where(array('no_tp' => $_POST['no_tp'], 'no_produk' => $_POST['no_produk']));
            $cek =  $this->db->get('detail_target_produksi')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_target_produksi', $data);
          
            }else{
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
            $this->db->where(array('no_tp' => $_POST['no_tp'], 'no_produk' => $_POST['no_produk']));
            $this->db->update('detail_target_produksi');
            
         }
           $this->isi_edit_tp($id);
        }else{
         $id = $_POST['no_tp'];
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
         $this->db->select('a.no_produk, a.nama_produk, satuan');
         $this->db->from('produk a');
         $this->db->join('bom b', 'a.no_produk = b.no_produk');
         $this->db->group_by('a.no_produk');
         $x['result'] = $this->db->get()->result_array(); 
         
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
         $this->db->where('no_tp', $id);
         $this->db->select_sum('jumlah');
         $x['cek'] = $this->db->get('detail_target_produksi')->row()->jumlah;
         $x['error'] = 'Jumlah Target Produksi melebihi jumlah produksi!';
         $this->template->load('template', 'tp/update', $x);
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




   
 //MENENTUKAN TRANSAKSI PRODUKSI 2

   public function lihat_produksi_ke2(){
    $this->db->where('tgl_btk', date('Y-m-d'));
      $data['cek1'] = $this->db->get('btk')->result();
      //
      $this->db->where('tgl_bop', date('Y-m-d'));
      $data['cek2'] = $this->db->get('bop')->result();
      //
      $this->db->where('tgl_trans', date('Y-m-d'));
      $data['cek3'] = $this->db->get('produksi_ke2')->result();

      //
     $date = date('Y-m-d');
     
     $query2 = "SELECT * FROM produksi_ke2
                WHERE tgl_trans = '$date' AND status > 0";
      $cek4 = $this->db->query($query2)->result();

      
      if($data['cek1'] == FALSE OR $data['cek2'] == FALSE){
        $data['error'] = 'Master Data BOP atau BTK untuk hari ini masih kosong!';
      }

      if($cek4 == TRUE){
        $data['clear'] = 'Produksi Olahan untuk hari ini sudah dilakukan!';
      }
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
      date_default_timezone_set('Asia/Jakarta');
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
       
       //bom bbb
       $this->db->where('no_tp', $no_tp);
       $id_pembagian = $this->db->get('target_produksi')->row()->no_trans_pembagian;

       $this->db->where('no_trans', $id_pembagian);
       $jml_produksi = $this->db->get('detail_pembagian')->row()->produksi;
       $data['jumlah_produksi'] = $jml_produksi;

       $this->db->where('id_jurnal', $id_pembagian);
       $this->db->where('a.no_coa', '1114');
       $this->db->select('nama_coa, nominal');
       $this->db->from('jurnal a');
       $this->db->join('coa b', 'a.no_coa = b.no_coa');
       $data['bombbb'] = $this->db->get()->row_array();
      
      //bom
      
       $query1 =   "
                  SELECT nama_bp, sum(a.jumlah) * c.jumlah as jumlah_bom, d.satuan, c.no_bbp,c.jumlah
                  FROM detail_target_produksi a
                  JOIN produk b ON a.no_produk = b.no_produk
                  JOIN bom c ON c.no_produk = b.no_produk
                  JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
                  WHERE a.no_tp = '$no_tp' AND NOT c.no_bbp = 'BB_001' AND a.no_produk = '$no_prod'
                  group by no_bbp";
      $data['result2'] = $this->db->query($query1)->result_array();
      $result2 = $this->db->query($query1)->result_array();
    
    


      //biaya tenaga kerja
      $this->db->where('no_trans', $id);
      $tgl = $this->db->get('produksi_ke2')->row()->tgl_trans;
      $bulan1 = substr($tgl, 5,2);
      $tahun1 = substr($tgl, 0,4);

       $this->db->where('no_trans', $id);
      $cek = $this->db->get('produksi_ke2')->row()->status;

      if($cek == 0){
         $this->db->where('tgl_btk', date('Y-m-d'));
      $btk = $this->db->get('btk')->row()->tarif;
      }else{
        $this->db->where('no_trans', $id);
        $btk = $this->db->get('detail_produksi_ke2')->row()->btk;
      }
     
     
      $data['btk']  = $btk * ($data['jumlah'] / $jml_produksi);
     
     //BIAYA BOP
      $this->db->where('tgl_bop', date('Y-m-d'));
      $this->db->select('a.no_bop,nama_jbop, harga');
      $this->db->from('bop a');
      $this->db->join('detail_bop b', 'a.no_bop = b.no_bop');
      $this->db->join('jenis_bop c', 'c.no_jbop = b.no_jbop');
      $data['bop'] = $this->db->get()->result_array();



      //cek selesai produksi
      $this->db->where('no_tp', $no_tp);
      $this->db->where('no_produk', $no_prod);
      $data['cek'] = $this->db->get('detail_target_produksi')->row()->status;


    
        


      
      $this->template->load('template', 'prod2/update', $data);
        // var_dump($data['btkperhari']);
      // var_dump(date('Y-m-d'));
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
         $this->db->where('status', '1');
         $this->db->order_by('no_tp');
         $data['tp'] = $this->db->get('target_produksi')->result_array();



         $this->template->load('template', 'prod2/form', $data);
   }

   public function tambah_produksi_ke2(){
       $config = array(
            
            array(
               'field' => 'no_tp',
               'label' => 'ID Target Produksi',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            
            $this->form_produksi_ke2();
         } else {
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'no_tp' => $_POST['no_tp']);
      $this->db->insert('produksi_ke2', $data);

      $this->db->where('no_tp', $_POST['no_tp']);
      $this->db->set('status', '2');
      $this->db->update('target_produksi');
      redirect('c_transaksi/lihat_produksi_ke2');
   }
   }

   public function selesai_produksi_ke2($bbb,$btk,$bop,$bp,$id,$no_tp,$no_prod,$jumlah){
      date_default_timezone_set('Asia/Jakarta');
      $this->db->set('status', '1');
      $this->db->where('no_tp', $no_tp);
      $this->db->where('no_produk', $no_prod);
      $this->db->update('detail_target_produksi');

      $query4 = "SELECT * FROM detail_target_produksi
                  WHERE status IS NULL AND no_tp = '$no_tp'";
      $cektp = $this->db->query($query4)->num_rows();

      if($cektp == 0){
          $this->db->set('status', '1');
      $this->db->where('no_trans', $id);
      $this->db->update('produksi_ke2');
      }
      
         $this->db->where('no_trans', $id);
       $tgl =$this->db->get('produksi_ke2')->row()->tgl_trans;


      //input ke detail produksi ke 2
      $subtotal = $bbb +$btk + $bop + $bp;
      $data = array('no_trans' => $id,
               'tgl_trans' => $tgl,
               'no_produk' => $no_prod,
               'bbb' => $bbb,
               'btk' => $btk,
               'bop' => $bop,
               'bp'  => $bp,
               'jumlah' => $jumlah,
               'subtotal' => $subtotal,
               'jumlah_kartu_stok' => $jumlah );
      $this->db->insert('detail_produksi_ke2', $data);

      //update harga jual produk
      $this->db->where('no_produk', $no_prod);
      $this->db->select_sum('subtotal');
      $nominal = $this->db->get('detail_produksi_ke2')->row_array()['subtotal'];

      $this->db->where('no_produk', $no_prod);
      $this->db->select_sum('jumlah');
      $jumlah_total = $this->db->get('detail_produksi_ke2')->row_array()['jumlah'];

      $harga_jual = (($nominal * 1.3) / $jumlah_total);
      $this->db->where('no_produk', $no_prod);
      $this->db->set('harga_jual', $harga_jual);
      $this->db->update('produk');

      //total bop + bp
      $bbop = $bop + $bp;
      //input ke stok produk

        $this->db->set('stok', "stok - ".$jumlah."", FALSE);
      $this->db->where('no_bdp', 'BDP_001');
      $this->db->update('bahan_dalam_proses');

      //update stok di produk

      $this->db->set('stok', "stok + ".$jumlah."", FALSE);
      $this->db->where('no_produk', $no_prod );
      $this->db->update('produk');

      //update stok bahan penolong
        $query3 = " SELECT nama_bp, sum(a.jumlah) * c.jumlah as jumlah, d.satuan, c.no_bbp,c.jumlah
                  FROM detail_target_produksi a
                  JOIN produk b ON a.no_produk = b.no_produk
                  JOIN bom c ON c.no_produk = b.no_produk
                  JOIN bahan_penolong d ON d.no_bp = c.no_bbp 
                  WHERE a.no_tp = '$no_tp' AND NOT c.no_bbp = 'BB_001' AND a.no_produk = '$no_prod'
                  group by no_bbp";
      $cekbp = $this->db->query($query3)->result_array();
      foreach ($cekbp as $data) {
        
         # code...
      $this->db->set('stok', "stok - ".$data['jumlah']."", FALSE);
      $this->db->where('no_bp', $data['no_bbp'] );
      $this->db->update('bahan_penolong');
      $pengurang = $data['jumlah'];
      $jumlah11 = $data['jumlah'];
      $biaya = $data['biaya'];
      $no_bp = $data['no_bbp'];
      $query4 = "SELECT * FROM detail_pembelian_bp a
                  WHERE jumlah_kartu_stok > 0 AND
                  no_bp = '$no_bp'
                  ORDER BY no ASC";
      $row = $this->db->query($query4)->result_array();

          foreach($row as $row) {

          $no  = $row['no'];
          $stok = $row['jumlah_kartu_stok'];
          $harga = $row['subtotal'] / $row['jumlah'];
          if($pengurang > 0) { 
              $temp = $pengurang;
              $pengurang = $pengurang - $stok;
              if($pengurang > 0) {      
                  $stok_update = 0;
              }else{
                  $stok_update = $stok - $temp;
              }


            $this->db->set('jumlah_kartu_stok', $stok_update);
            $this->db->where('no_bp', $no_bp);
            $this->db->where('no', $no);
            $this->db->update('detail_pembelian_bp');

      

       //kartu stok bp
       // $harga11 = $biaya /$jumlah11;
       // $harga12 = $harga11 * $stok_update;
       // $total_stok_bp = ($biaya / $jumlah11) * $stok_update;
       // $data6 = array('no_trans' => $id,
       //               'tgl_trans' => $tgl,
       //               'no_bp' => $no_bp,
       //               'unit2' => $jumlah11,
       //               'harga2' => $harga11,
       //               'total2' => $biaya,
       //               'unit3' => $stok_update,
       //               'harga3' => $harga11,
       //               'total3' => $total_stok_bp);
       // $this->db->insert('kartu_stok_bp', $data6);
       }
      }
     
      }

      //jurnal pemakaian
      $this->m_keuangan->GenerateJurnal('5112', $id, 'd', $btk);
       $this->m_keuangan->GenerateJurnal('5311', $id, 'k', $btk);
       $this->m_keuangan->GenerateJurnal('5113', $id, 'd', $bbop);//Produk Dalam Proses - BOP
       $this->m_keuangan->GenerateJurnal('5312', $id, 'k', $bbop);//BOP Dibebankan

      $this->m_keuangan->GenerateJurnal('5135', $id, 'd', $bp);
       $this->m_keuangan->GenerateJurnal('1113', $id, 'k', $bp);


     
     

       $pbj = $bbb + $btk + $bbop;
       //jurnal persediaan jadi
       $this->m_keuangan->GenerateJurnal('1115', $id, 'd', $pbj);
       $this->m_keuangan->GenerateJurnal('1114', $id, 'k', $bbb);
       $this->m_keuangan->GenerateJurnal('5112', $id, 'k', $btk);
       $this->m_keuangan->GenerateJurnal('5113', $id, 'k', $bbop);

        
      // $this->db->where('no_tp', $no_tp);
      // $cektp = $this->db->get('detail_target_produksi')->num_rows();

      // $this->db->where('no_trans', $id);
      // $cektrans = $this->db->get('detail_produksi_ke2')->num_rows();
      //  if($cektp == $cektrans){
      //  $this->db->where('tgl_bop' , date('Y-m-d'));
      //  $this->db->select_sum('harga');
      //  $this->db->from('bop a');
      //  $this->db->join('detail_bop b', 'a.no_bop = b.no_bop');
      //  $biayabop = $this->db->get()->row()->harga;
      //  $this->m_keuangan->GenerateJurnal('5134', $id, 'd', $biayabop);
      //  $this->m_keuangan->GenerateJurnal('5135', $id, 'k', $biayabop);
      //  }

      //   //kartu stok penj toko
      //  $harga13 = $pbj / $jumlah;
      //  $data1 = array('no_trans' => $id,
      //                'tgl_trans' => $tgl,
      //                'no_produk' => $no_prod,
      //                'unit1' => $jumlah,
      //                'harga1' => $harga13,
      //                'total1' => $pbj,
      //                'unit3' => $jumlah,
      //                'harga3' => $harga13,
      //                'total3' => $pbj);
      //  $this->db->insert('kartu_stok_penj', $data1);

     

      redirect('c_transaksi/isi_edit_produksi_ke21/'.$id.'');
   }

   //PENJUALAN

   public function lihat_penjs(){
    $this->db->select('a.no_trans, tgl_trans, total,no_trans_pembg');
    $this->db->select_sum('jumlah');
    $this->db->from('penjualan_ips a');
    $this->db->join('detail_penjualan_ips b', 'a.no_trans = b.no_trans');
   	$data['result'] = $this->db->get()->result_array();
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

         $this->db->where('status_penjs', NULL);
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
      $data['jumlah'] = $this->db->get('detail_pembagian')->row_array()['jual'];

      $this->db->where('no_trans', $id);
      $this->db->select_sum('jumlah');
      $data['cek_jml'] = $this->db->get('detail_penjualan_ips')->row()->jumlah;

      //harga jual
      
      $this->db->where('no_produk', 'PR_001');
      $data['harga'] = $this->db->get('produk')->row()->harga_jual;

      //nyari no produk di produksinyaaa
      $data['no_produk'] = 'PR_001';

      //status
      $this->db->where('no_trans', $id);
      $data['status'] = $this->db->get('penjualan_ips')->row()->status;

      //ips
      $data['ips'] = $this->db->get('konsumen_ips')->result_array();

      //detail

      $this->db->where('no_trans',$id);
      $this->db->select('nama_ips, jumlah,subtotal');
      $this->db->from('detail_penjualan_ips a');
      $this->db->join('konsumen_ips b', 'a.no_ips = b.no_ips');
      $data['detail'] = $this->db->get()->result_array();

      $this->template->load('template', 'penjs/update', $data);
      // var_dump($data['list']);
   }


   public function tambah_penjs0(){
       $config = array(
            
            array(
               'field' => 'no_trans_pembg',
               'label' => 'ID Pembagian',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            
            $this->form_penjs();
         } else {
      $data = array('no_trans' => $_POST['no_trans'],
               'tgl_trans' => $_POST['tgl_trans'],
               'status' => '0',
               'total' => '0',
               'no_trans_pembg' => $_POST['no_trans_pembg']);
      $this->db->insert('penjualan_ips', $data);

            $this->db->set('status_penjs', '1');
            $this->db->where('no_trans', $_POST['no_trans_pembg']);
            $this->db->update('pembagian');

      redirect('c_transaksi/lihat_penjs');
   }
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
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                   'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {

           $id_pembg = $_POST['id_pembg'];
            $id = $_POST['no_trans'];
            $this->isi_edit_penjs($id,$id_pembg);
         } else {
            $id = $_POST['no_trans'];
        
            $this->db->where('no_trans', $id);
            $this->db->select_sum('jumlah');
            $cekk = $this->db->get('detail_penjualan_ips')->row()->jumlah;

            $total_jml = $cekk + $_POST['jumlah'];

         if($total_jml <= $_POST['jumlah1']){


           $id_pembg = $_POST['id_pembg'];
            $id = $_POST['no_trans'];

            //get hpp
            $this->db->where('no_trans', $id_pembg);
            $id_prod = $this->db->get('pembagian')->row_array()['no_trans_produksi1'];

            $query = "SELECT jumlah, subtotal
                    FROM detail_produksi_ke1
                    WHERE no_trans = '$id_prod'";
            $jumlah_produksi = $this->db->query($query)->row_array()['jumlah'];
            $subtotal_produksi = $this->db->query($query)->row_array()['subtotal'];
            $hpp = ($_POST['jumlah'] / $jumlah_produksi) * $subtotal_produksi;

               $pengurang = $_POST['jumlah'];
            $kode_bahan = 'PR_001';
            $hargafix = $_POST['harga'];
            // $hpp = ($_POST['jumlah'] * $_POST['harga']) * 100/130;
            $subtotal = $_POST['jumlah'] * $_POST['harga'];
          $data = array('no_trans' => $_POST['no_trans'],
                        'no_produk' => 'PR_001',
                        'jumlah' => $_POST['jumlah'],
                        'harga' => $_POST['harga'],
                        'subtotal' => $subtotal,
                        'no_ips' => $_POST['no_ips'],
                        'jumlah_kartu_stok' => 0,
                        'hpp' => $hpp);

            $this->db->where('no_trans', $id);
            $this->db->where('no_ips', $_POST['no_ips']);
            $cekcek = $this->db->get('detail_penjualan_ips')->num_rows();
            if($cekcek == 0){
               $this->db->insert('detail_penjualan_ips', $data);
            }else{
              $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
             $this->db->set('subtotal', "subtotal +".$subtotal."", FALSE);
             $this->db->set('hpp', "hpp +".$hpp."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_ips' => $_POST['no_ips']));
            $this->db->update('detail_penjualan_ips');
            }

             $this->db->set('stok', "stok -".$_POST['jumlah']."", FALSE);
            $this->db->where('no_produk', 'PR_001');
            $this->db->update('produk');


        

              $this->isi_edit_penjs($id, $id_pembg);
          

      

           }else{
            $data['error'] = 'Jumlah penjualan melebihi stok!';
            $id_pembg = $_POST['id_pembg'];
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

      $this->db->where('no_trans', $id);
      $this->db->select_sum('jumlah');
      $data['cek_jml'] = $this->db->get('detail_penjualan_ips')->row()->jumlah;

      //harga jual
      
      $this->db->where('no_produk', 'PR_001');
      $data['harga'] = $this->db->get('produk')->row()->harga_jual;

      //nyari no produk di produksinyaaa
      $data['no_produk'] = 'PR_001';

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

           }
       
         }
   }

   public function selesai_penjs($id, $total, $jumlah, $tgl){

      $this->db->set('status', "1", FALSE);
      $this->db->set('total', $total);
      $this->db->where('no_trans', $id);
      $this->db->update('penjualan_ips');

      $bebanadm = 0;
      $bebanpms = 0;
      $ttlbbn = 0;
       $fix_total = $total * (100/130);  
       $this->m_keuangan->GenerateJurnal('1111', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('4111', $id, 'k', $total);

       $this->m_keuangan->GenerateJurnal('6111', $id, 'd', $fix_total);
      $this->m_keuangan->GenerateJurnal('1115', $id, 'k', $fix_total);





      // $this->db->where('no_trans', $id);
      // $list = $this->db->get('detail_penjualan_ips')->result_array();
      // foreach ($list as $data) {
      //    # code...
      //    $total = ($data['subtotal'] *(100/130) ) *($data['jumlah_kartu_stok'] / $data['jumlah']);

      //    $data1 = array('no_trans' => $id,
      //                   'tgl_trans' => $tgl,
      //                   'no_produk' => $data['no_produk'],
      //                   'unit' => $data['jumlah_kartu_stok'],
      //                   'total' => $total);
      //    $this->db->insert('kartu_stok_penj_ips', $data1);
      // }

    
      redirect('c_transaksi/lihat_penjs');   

   }

   

   //PENJUALAN toko

   public function lihat_penjt(){
       $this->db->select('a.no_trans, tgl_trans, total');
    $this->db->select_sum('jumlah');
    $this->db->from('penjualan_toko a');
    $this->db->join('detail_penjualan_toko b', 'a.no_trans = b.no_trans');
    $data['result'] = $this->db->get()->result_array();
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

      $query = "SELECT * FROM produk WHERE stok > 0";
      $data['barang'] = $this->db->query($query)->result_array();
      $this->db->where('no_trans', $id);
      $this->db->select('nama_produk, a.jumlah,harga, subtotal, satuan');
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
 
            
               $pengurang = $_POST['jumlah'];
            $kode_bahan = $_POST['no_produk'];

      //    $query111 = "SELECT * FROM detail_produksi_ke2 
      //          WHERE no_produk = '$kode_bahan' AND 
      //          jumlah_kartu_stok > 0 
      //          ORDER by no ASC";
      //    $row = $this->db->query($query111)->result_array();

      //     foreach($row as $row) {

      //     $tgl  = $row['no'];
      //     $stok = $row['jumlah_kartu_stok'];
      //     $biaya = $row['bbb'] + $row['btk'] + $row['bp'];
      //     $harga = $biaya / $row['jumlah'];
      //     $margin = ($biaya * 1.3) / $row['jumlah'];
      //     if($pengurang > 0) { 
      //         $temp = $pengurang;
      //         $pengurang = $pengurang - $stok;
      //         if($pengurang > 0) {      
      //             $stok_update = 0;
      //         }else{
      //             $stok_update = $stok - $temp;
      //         }
      //         // $sql = "UPDATE detail_penjualan SET stok = $stok_update WHERE kode_bahan = '$kode_bahan' AND tgl_masuk = '$tgl'";
      //          // $sql = "UPDATE barang SET stok = $stok_update WHERE nama = '$barang' AND tgl = '$tgl'";
      //       $this->db->set('jumlah_kartu_stok', $stok_update);
      //       $this->db->where('no_produk', $kode_bahan);
      //       $this->db->where('no', $tgl);
      //       $this->db->update('detail_produksi_ke2');

         
      //       $jumlah1 = $row['jumlah'] - $stok_update;
      //       $_POST['subtotal'] = $margin * $julmah1;
      //       $hpp = $_POST['subtotal'] * (100/130);
      //       $data = array(
      //          'no_trans' => $_POST['no_trans'],
      //          'no_produk' => $_POST['no_produk'],
      //          'jumlah' => $jumlah1,
      //          'harga' => $margin,
      //          'subtotal' => $_POST['subtotal'],
      //          'cek_stok_penj' => $stok_update,
      //          'hpp' => $hpp
      //       );   
          

      //       $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk'], 'harga' => $margin));
      //       $cek =  $this->db->get('detail_penjualan_toko')->num_rows();
      //       if($cek == 0 ){
      //       $this->db->insert('detail_penjualan_toko', $data);
      //       }else{
      //       $this->db->set('jumlah', "jumlah + ".$stok_update."", FALSE);
      //        $this->db->set('subtotal', "subtotal +".$_POST['subtotal']."", FALSE);
      //        $this->db->set('hpp', "hpp +".$hpp."", FALSE);
      //       $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk'], 'harga' => $margin));
      //       $this->db->update('detail_penjualan_toko');

            
      //    }
        
      //     }

      // }
            $this->db->where('no_produk', $_POST['no_produk']);
            $harga = $this->db->get('produk')->row_array()['harga_jual'];
            $subtotal = $harga * $_POST['jumlah'];
            $hpp = $subtotal * 100/130;
            $data = array(
               'no_trans' => $_POST['no_trans'],
               'no_produk' => $_POST['no_produk'],
               'jumlah' => $_POST['jumlah'],
               'harga' => $harga,
               'subtotal' => $subtotal,
               'cek_stok_penj' => 0,
               'hpp' => $hpp
            );   
          

            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk']));
            $cek =  $this->db->get('detail_penjualan_toko')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_penjualan_toko', $data);
            }else{
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
             $this->db->set('subtotal', "subtotal +".$subtotal."", FALSE);
             $this->db->set('hpp', "hpp +".$hpp."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_produk' => $_POST['no_produk']));
            $this->db->update('detail_penjualan_toko');
          }
             //pengurang stok produk
             $this->db->set('stok', "stok -".$_POST['jumlah']."", FALSE);
            $this->db->where('no_produk', $_POST['no_produk']);
            $this->db->update('produk');
                 redirect('c_transaksi/form_penjt');    
       
         }
   }

   public function selesai_penjt($id, $total){
      $data =  array('no_trans' => $id,
                     'tgl_trans' => date('Y-m-d'),
                     'total' => $total,
                     'status' => '1' );
      $this->db->insert('penjualan_toko', $data);
      $fix_total = 0;
      $fix_total = $total * (100/130);
       $this->m_keuangan->GenerateJurnal('1111', $id, 'd', $total);
      $this->m_keuangan->GenerateJurnal('4111', $id, 'k', $total);
       $this->m_keuangan->GenerateJurnal('6111', $id, 'd', $fix_total);
      $this->m_keuangan->GenerateJurnal('1115', $id, 'k', $fix_total);



      // $this->db->where('b.no_trans', $id);
      // $this->db->from('penjualan_toko a');
      // $this->db->join('detail_penjualan_toko b', 'a.no_trans = b.no_trans');
      // $this->db->or_not_like('status', '1', 'none');
      // $list = $this->db->get()->result_array();

      // foreach ($list as $data) {
      //    # code...
         
      //    $tgl = $data['tgl_trans'];
      //    $no_produk = $data['no_produk'];
      //    $harga2 = $data['subtotal'] / $data['jumlah'];
      //    $harga3 = ($data['harga'] * (100/130)) / $data['cek_stok_penj'];
      //    $total2 = $data['subtotal'];
      //    if($data['cek_stok_penj'] == 0){
      //       $total3 = 0;
      //    }else{    
      //       $total3 = $data['harga'] * (100/130);;
      //    }
      //    $data = array('no_trans' => $id,
      //                'tgl_trans' =>$tgl,   
      //                'no_produk' => $no_produk,
      //                'unit2' => $data['jumlah'],
      //                'harga2' => $harga2,
      //                'total2' => $total2,
      //                'unit3' => $data['cek_stok_penj'],
      //                'harga3' => $harga3,
      //                'total3' => $total3
      //             );
      //    $this->db->insert('kartu_stok_penj', $data);

      // }

      redirect('c_transaksi/lihat_penjt');

   }

   public function isi_edit_penjt($id){
      $data['id'] = $id;
      $this->db->where('no_trans', $id);
      $data['no_trans'] = $this->db->get('penjualan_toko')->row()->no_trans;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('penjualan_toko')->row()->tgl_trans;

     
      //DETAIL
      $this->db->select('nama_produk, a.jumlah, harga,satuan,subtotal');
      $this->db->from('detail_penjualan_toko a');
      $this->db->join('produk c', 'a.no_produk = c.no_produk');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

    

    
      $this->template->load('template', 'penjt/update', $data);
   }

   //---------------------------------------------------------------------------------- 
   
    public function lihat_pemby(){
    $this->db->where('tgl_trans', date('Y-m-d'));
    $cek = $this->db->get('pembayaran')->result();
    $this->db->where('tgl_trans', date('Y-m-d'));
    $this->db->where('status >', '0');
    $cek1 = $this->db->get('pembayaran')->result();
    $data['cek'] = $cek;
    $data['cek1'] = $cek1;
    if($cek1 == TRUE){
       $data['error'] = 'Pembayaran untuk hari ini sudah dilakukan!';
    }
      $data['result'] = $this->db->get('pembayaran')->result_array();
        $this->template->load('template', 'pemby/view', $data);
   }

   public function isi_edit_pemby($id){
      $data['id'] = $id;
      $data['no_trans'] = $id;
      $this->db->where('no_trans', $id);
      $data['tgl'] = $this->db->get('pembayaran')->row()->tgl_trans;

      //detailnya cok
      $this->db->where('no_trans', $id);
      $this->db->where('jenis_penjualan', 'ips');
      $this->db->from('detail_pembayaran a');
      $this->db->join('coa b', 'a.no_coa = b.no_coa');
      $data['detailips'] = $this->db->get()->result_array();

      $this->db->where('no_trans', $id);
      $this->db->where('jenis_penjualan', 'toko');
      $this->db->from('detail_pembayaran a');
      $this->db->join('coa b', 'a.no_coa = b.no_coa');
      $data['detailtoko'] = $this->db->get()->result_array();

      //CEK SELESAI BELANJA JADI NON KLIKK!

   
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

      $this->db->where('no_trans', $no_trans);
      $data['cek'] = $this->db->get('pembayaran')->row_array()['status'];

      //beban beban
      $this->db->like('no_coa', '522', 'AFTER');
      $data['bebant'] = $this->db->get('coa')->result_array();

      $this->db->like('no_coa', '521', 'AFTER');
      $data['bebanv'] = $this->db->get('coa')->result_array();



      // $data['cek_selesai'] = $this->db->query($query1)->num_rows();
      $this->db->where('no_trans', $no_trans);
      $data['cek_selesai'] = $this->db->get('detail_pembayaran')->num_rows();

      //UPDATE TABEL PEMBELIAN_BB
      $this->db->where('no_trans', $no_trans);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_pembayaran')->row()->subtotal;

      //detailnya cok
      $this->db->where('no_trans', $no_trans);
      $this->db->where('jenis_penjualan', 'ips');
      $this->db->from('detail_pembayaran a');
      $this->db->join('coa b', 'a.no_coa = b.no_coa');
      $data['detailips'] = $this->db->get()->result_array();

      $this->db->where('no_trans', $no_trans);
      $this->db->where('jenis_penjualan', 'toko');
      $this->db->from('detail_pembayaran a');
      $this->db->join('coa b', 'a.no_coa = b.no_coa');
      $data['detailtoko'] = $this->db->get()->result_array();



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
     $config = array(
            
            
            array(
               'field' => 'no_coa',
               'label' => 'Beban',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            ),
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah',
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => 'Inputan Salah',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            ),
            array(
               'field' => 'jenis_penjualan',
               'label' => 'Jenis Penjualan',
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
       $data = array('no_trans' => $_POST['no_trans'],
                     'no_coa' => $_POST['no_coa'],
                     'subtotal' => $_POST['jumlah'],
                    'jenis_penjualan' => $_POST['jenis_penjualan']);

      

       $this->db->where(array('no_trans' => $_POST['no_trans'],'jenis_penjualan' => $_POST['jenis_penjualan'], 'no_coa' => $_POST['no_coa']));
            $cek =  $this->db->get('detail_pembayaran')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_pembayaran', $data);

    
            
            }else{

             $this->db->set('subtotal', "subtotal + ".$_POST['jumlah']."", FALSE);
            $this->db->where(array('no_trans' => $_POST['no_trans'] ,'jenis_penjualan' => $_POST['jenis_penjualan'] ,'no_coa' => $_POST['no_coa']));
            $this->db->update('detail_pembayaran');


           
   }

    redirect('c_transaksi/form_pemby');
}
}

   public function selesai_pemby($id,$total){
     $data = array('no_trans' => $id,
                    'tgl_trans' => date('Y-m-d'),
                    'status' => '1',
                    'total' => $total);
     $this->db->insert('pembayaran', $data);


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

      redirect('c_transaksi/lihat_pemby');
   } 

    public function tambah_pemb1(){
          $config = array(
            
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah',
               'rules' => 'required|is_natural_no_zero',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!'
               )
            ),
            array(
               'field' => 'no_peternak',
               'label' => 'Nama Peternak',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_trans'];
            $this->isi_edit_pemb($id);
         } else {
            $id = $_POST['no_trans'];
            $this->db->where('no_trans', $id);
            $this->db->select_sum('jumlah');
            $cek = $this->db->get('detail_pembelian_bb')->row()->jumlah;
            $total = $cek + $_POST['jumlah'];
            $jumlah_total = 150000;
            if($total <= $jumlah_total){
               $this->db->where('no_bb', $_POST['no_bb']);
      $harga = $this->db->get('bahan_baku')->row()->harga;
       $data = array('no_trans' => $_POST['no_trans'],
                  'no_bb' => $_POST['no_bb'],
                  'jumlah' => $_POST['jumlah'],
                  'subtotal' => $_POST['jumlah']*$harga,
                  'no_peternak' => $_POST['no_peternak']);

       $subtotal = $_POST['jumlah'] * $harga;

      

       $this->db->where(array('no_trans' => $_POST['no_trans'], 'no_bb' => $_POST, 'no_peternak' => $_POST['no_peternak']));
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

                  ////////////////////////////////////////////////////////////
                  ///////////////////////////////////////////////////////////
            }else{
                $data['error'] = 'Jumlah pembelian melebihi batasan pembelian!';
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
      $this->db->select('nama_bb, a.jumlah, harga,satuan,nama_peternak, a.no_peternak');
      $this->db->from('detail_pembelian_bb a');
      $this->db->join('peternak b', 'a.no_peternak = b.no_peternak');
      $this->db->join('bahan_baku c', 'a.no_bb = c.no_bb');
      $this->db->where('no_trans', $id);
      $data['detail'] = $this->db->get()->result_array();

      //CEK SELESAI BELANJA JADI NON KLIKK!

     

      //UPDATE TABEL PEMBELIAN_BB
      $this->db->where('no_trans', $id);
      $this->db->select_sum('subtotal');
      $data['total'] = $this->db->get('detail_pembelian_bb')->row()->subtotal;

      //kondisi di tambah pembeliannya
      $this->db->where('no_trans', $id);
      $this->db->select_sum('jumlah');
      $data['cek_jml_pmb'] = $this->db->get('detail_pembelian_bb')->row()->jumlah;


       // $data['cek_selesai'] = $this->db->query($query1)->num_rows();
      $this->db->where('no_trans', $id);
      $data['cek_selesai'] = $this->db->get('detail_pembelian_bb')->num_rows();



   
      $this->template->load('template', 'pemb/update', $data);
            }

     

   
 }
}

public function tambah_pembp1(){
       $config = array(
            
            array(
               'field' => 'no_supp_bp',
               'label' => 'Nama Supplier',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_trans'];
            $this->isi_edit_pembp($id);
         } else {
      $data = array('no_trans' => $_POST['no_trans'],
                  'no_bp' => $_POST['no_bp'],
                  'jumlah' => $_POST['jumlah'],
                  'subtotal' => $_POST['jumlah']*$_POST['harga'],
                  'no_supp_bp' => $_POST['no_supp_bp'],
                  'jumlah_kartu_stok' => $_POST['jumlah']);
      $this->db->insert('detail_pembelian_bp', $data);

    $this->db->set('stok', "stok +".$_POST['jumlah']."",FALSE);
    $this->db->where('no_bp', $_POST['no_bp']);
    $this->db->update('bahan_penolong');

    redirect('c_transaksi/isi_edit_pembp/'.$_POST['no_trans'].'');
 }
   }



 }//end