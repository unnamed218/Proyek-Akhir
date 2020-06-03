<?php
class c_masterdata extends CI_controller{
   
    function __construct(){
        parent:: __construct();
       if(empty($this->session->userdata('level'))){
            redirect('c_login/home');
        }
    }
    public function beranda()
   {
      
         
         $this->template->load('template', 'beranda');
       
   }
  public function lihat_coa()
   {
      
         $this->db->order_by('no_coa ASC');
         $data['result'] = $this->db->get('coa')->result_array();
         $this->template->load('template', 'coa/view', $data);
       
   }
   public function form_coa()
   {
        
         
         //  $data['bahan_baku'] = $this->db->get('bahan_baku')->result_array();
         $this->template->load('template', 'coa/form');
          
   }
   
   public function tambah_coa()
   {
        
         
         $config = array(
            
            array(
               'field' => 'no_coa',
               'label' => 'Nomor Akun',
               'rules' => 'required|is_natural|min_length[3]|max_length[11]|is_unique[coa.nama_coa]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 11 huruf!',
                  'is_natural' => '%s tidak boleh minus!',
                  'is_unique' => '%s sudah ada didatabase!'
               )
            ),
            array(
               'field' => 'nama_coa',
               'label' => 'Nama Akun',
               'rules' => 'required|min_length[3]|max_length[30]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_coa();
         } else {
            
            $data = array(
               'no_coa' => $_POST['no_coa'],
               'nama_coa' => $_POST['nama_coa'],
               'saldo_awal' => ''
            );
            
            $this->m_masterdata->tambah_data('coa', $data);
            redirect('c_masterdata/lihat_coa');
         }
          
   }

   //bahan baku

    public function lihat_bb()
   {
      
         
         $data['result'] = $this->db->get('bahan_baku')->result_array();
         $this->template->load('template', 'bb/view', $data);
       
   }
   public function form_bb()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_bb,3)) as kode FROM bahan_baku";
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
         $no_trans   = "BB_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'bb/form', $data);
       
   }
   
   public function tambah_bb()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_bb',
               'label' => 'Nama Bahan Baku',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]|is_unique[bahan_baku.nama_bb]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
            array(
               'field' => 'harga',
               'label' => 'Harga',
               'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[11]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!'
               )
            ),
            
            array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_bb();
         } else {
            $data = array(
               'no_bb' => $_POST['no_bb'],
               'nama_bb' => $_POST['nama_bb'],
               'harga' => $_POST['harga'],
               'stok' => 0,
               'satuan' => $_POST['satuan']
            );
            $this->db->insert('bahan_baku', $data);
           
            redirect('c_masterdata/lihat_bb');
         }
       
      
   }
   
   public function isi_edit_bb($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('bahan_baku', "no_bb = '$id'")->row_array();
         $this->template->load('template', 'bb/update', $x);
       
      
   }
   public function edit_bb()
   {
      
         $config = array(
            
            array(
               'field' => 'nama_bb',
               'label' => 'Nama Bahan Baku',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!'
               )
            ),
            array(
               'field' => 'harga',
               'label' => 'Harga',
               'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[11]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!'
               )
            ),
            
            array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah',
                  'in_list' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_bb'];
            $this->isi_edit_bb($id);
         } else {
            $no_bb   = $_POST['no_bb'];
            $nama_bb = $_POST['nama_bb'];
            $harga   = $_POST['harga'];
            $stok    = $_POST['stok'];
            $satuan  = $_POST['satuan'];
            
            $data = array(
               'nama_bb' => $nama_bb,
               'harga' => $harga,
               'stok' => $stok,
               'satuan' => $satuan
            );
            
            $this->db->where('no_bb', $no_bb);
            $this->m_masterdata->update_data('bahan_baku', $data);
            redirect('c_masterdata/lihat_bb');
            
         }
         
       
   }

   //bahan dalam proses


    public function lihat_bdp()
   {
      
         
         $data['result'] = $this->db->get('bahan_dalam_proses')->result_array();
         $this->template->load('template', 'bdp/view', $data);
       
   }
   public function form_bdp()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_bdp,3)) as kode FROM bahan_dalam_proses";
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
         $no_trans   = "BDP_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'bdp/form', $data);
       
   }
   
   public function tambah_bdp()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_bdp',
               'label' => 'Nama Bahan Dalam Proses',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]|is_unique[bahan_dalam_proses.nama_bdp]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
            
            array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_bdp();
         } else {
            $data = array(
               'no_bdp' => $_POST['no_bdp'],
               'nama_bdp' => $_POST['nama_bdp'],
               'stok' => 0,
               'satuan' => $_POST['satuan']
            );
            $this->db->insert('bahan_dalam_proses', $data);
           
            redirect('c_masterdata/lihat_bdp');
         }
       
      
   }
   
   public function isi_edit_bdp($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('bahan_dalam_proses', "no_bdp = '$id'")->row_array();
         $this->template->load('template', 'bdp/update', $x);
       
      
   }
   public function edit_bdp()
   {
      
         $config = array(
            
            array(
               'field' => 'nama_bdp',
               'label' => 'Nama Bahan Dalam Proses',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!'
               )
            ),

            array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah',
                  'in_list' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_bdp'];
            $this->isi_edit_bdp($id);
         } else {
            $no_bdp   = $_POST['no_bdp'];
            $nama_bdp = $_POST['nama_bdp'];
            $stok    = $_POST['stok'];
            $satuan  = $_POST['satuan'];
            
            $data = array(
               'nama_bdp' => $nama_bdp,
               'stok' => $stok,
               'satuan' => $satuan
            );
            
            $this->db->where('no_bdp', $no_bdp);
            $this->m_masterdata->update_data('bahan_dalam_proses', $data);
            redirect('c_masterdata/lihat_bdp');
            
         }
         
       
   }




   //bahan penolong

    public function lihat_bp()
   {
      
         
         $data['result'] = $this->db->get('bahan_penolong')->result_array();
         $this->template->load('template', 'bp/view', $data);
       
   }
   public function form_bp()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_bp,3)) as kode FROM bahan_penolong";
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
         $no_trans   = "BP_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'bp/form', $data);
       
   }
   
   public function tambah_bp()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_bp',
               'label' => 'Nama Bahan Penolong',
               'rules' => 'required|min_length[3]|max_length[30]|is_unique[bahan_penolong.nama_bp]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
            array(
               'field' => 'harga',
               'label' => 'Harga',
               'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[11]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!'
               )
            ),
            
            array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_bp();
         } else {
            $data = array(
               'no_bp' => $_POST['no_bp'],
               'nama_bp' => $_POST['nama_bp'],
               'harga' => $_POST['harga'],
               'stok' => 0,
               'satuan' => $_POST['satuan']
            );
            $this->db->insert('bahan_penolong', $data);
           
            redirect('c_masterdata/lihat_bp');
         }
       
      
   }
   
   public function isi_edit_bp($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('bahan_penolong', "no_bp = '$id'")->row_array();
         $this->template->load('template', 'bp/update', $x);
       
      
   }
   public function edit_bp()
   {
      
         $config = array(
            
            array(
               'field' => 'nama_bp',
               'label' => 'Nama Bahan Penolong',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[50]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!'
               )
            ),
            array(
               'field' => 'harga',
               'label' => 'Harga',
               'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[11]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!'
               )
            ),
            
            array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_bp'];
            $this->isi_edit_bp($id);
         } else {
            $no_bp   = $_POST['no_bp'];
            $nama_bp = $_POST['nama_bp'];
            $harga   = $_POST['harga'];
            $stok    = $_POST['stok'];
            $satuan  = $_POST['satuan'];
            
            $data = array(
               'nama_bp' => $nama_bp,
               'harga' => $harga,
               'stok' => $stok,
               'satuan' => $satuan
            );
            
            $this->db->where('no_bp', $no_bp);
            $this->m_masterdata->update_data('bahan_penolong', $data);
            redirect('c_masterdata/lihat_bp');
            
         }
         
       
   }


   //PRODUK

    public function lihat_produk()
   {
      
         
         $data['result'] = $this->db->get('produk')->result_array();
         $this->template->load('template', 'produk/view', $data);
       
   }
   public function form_produk()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_produk,3)) as kode FROM produk";
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
         $no_trans   = "PR_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'produk/form', $data);
       
   }
   
   public function tambah_produk()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_produk',
               'label' => 'Nama Produk',
               'rules' => 'required|min_length[3]|max_length[30]|is_unique[produk.nama_produk]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
             array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_produk();
         } else {
            $data = array(
               'no_produk' => $_POST['no_produk'],
               'nama_produk' => $_POST['nama_produk'],
               'stok' => 0,
               'satuan' => $_POST['satuan']
            );
            $this->db->insert('produk', $data);
          
            redirect('c_masterdata/lihat_produk');
         }
       
      
   }
   
   public function isi_edit_produk($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('produk', "no_produk = '$id'")->row_array();
         $this->template->load('template', 'produk/update', $x);
       
      
   }
   public function edit_produk()
   {
      
         $config = array(
            
            array(
               'field' => 'nama_produk',
               'label' => 'Nama Produk',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]|is_unique[produk.nama_produk]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
             array(
               'field' => 'satuan',
               'label' => 'Satuan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
       
            
         
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_produk'];
            $this->isi_edit_produk($id);
         } else {
            $no_bb   = $_POST['no_produk'];
            $nama_bb = $_POST['nama_produk'];
          
            
            $data = array(
               'nama_produk' => $nama_bb,
               'stok' => $stok,
               'satuan' => $_POST['satuan']
            );
            
            $this->db->where('no_produk', $no_bb);
            $this->m_masterdata->update_data('produk', $data);
            redirect('c_masterdata/lihat_produk');
            
         }
         
       
   }


     //PETERNAK

    public function lihat_peternak()
   {
      
         
         $data['result'] = $this->db->get('peternak')->result_array();
         $this->template->load('template', 'peternak/view', $data);
       
   }
   public function form_peternak()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_peternak,3)) as kode FROM peternak";
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
         $no_trans   = "PTRNK_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'peternak/form', $data);
       
   }
   
   public function tambah_peternak()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_peternak',
               'label' => 'Nama Peternak',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]|is_unique[peternak.nama_peternak]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
            array(
               'field' => 'notel',
               'label' => 'No. Telepon',
               'rules' => 'required|is_natural',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural' => '%s harus angka!'
               )
            ),
            array(
               'field' => 'alamat',
               'label' => 'Alamat',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_peternak();
         } else {
            $data = array(
               'no_peternak' => $_POST['no_peternak'],
               'nama_peternak' => $_POST['nama_peternak'],
               'notel' => $_POST['notel'],
               'alamat' => $_POST['alamat']

            );
            $this->db->insert('peternak', $data);
          
            redirect('c_masterdata/lihat_peternak');
         }
       
      
   }
   
   public function isi_edit_peternak($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('peternak', "no_peternak = '$id'")->row_array();
         $this->template->load('template', 'peternak/update', $x);
       
      
   }
   public function edit_peternak()
   {
      
         $config = array(
            
            array(
               'field' => 'nama_peternak',
               'label' => 'Nama Peternak',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!'
               )
            ),
            array(
               'field' => 'notel',
               'label' => 'No. Telepon',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural' => '%s harus angka!'
               )
            ),
            array(
               'field' => 'alamat',
               'label' => 'Alamat',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
       
            
         
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_peternak'];
            $this->isi_edit_peternak($id);
         } else {
            $no_peternak   = $_POST['no_peternak'];
            $nama_peternak = $_POST['nama_peternak'];
            
            $data = array(
               'nama_peternak' => $nama_peternak,
               'notel' => $_POST['notel'],
               'alamat' => $_POST['alamat']
            );
            
            $this->db->where('no_peternak', $no_peternak);
            $this->m_masterdata->update_data('peternak', $data);
            redirect('c_masterdata/lihat_peternak');
            
         }
         
       
   }


    //SUPPLIER BP

    public function lihat_supp_bp()
   {
      
         
         $data['result'] = $this->db->get('supplier_bp')->result_array();
         $this->template->load('template', 'supplier/view', $data);
       
   }
   public function form_supp_bp()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_supp_bp,3)) as kode FROM supplier_bp";
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
         $no_trans   = "SBP_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'supplier/form', $data);
       
   }
   
   public function tambah_supp_bp()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_supp_bp',
               'label' => 'Nama Supplier',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]|is_unique[supplier_bp.nama_supp_bp]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
            array(
               'field' => 'notel',
               'label' => 'No. Telepon',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'alamat',
               'label' => 'Alamat',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_supp_bp();
         } else {
            $data = array(
               'no_supp_bp' => $_POST['no_supp_bp'],
               'nama_supp_bp' => $_POST['nama_supp_bp'],
               'notel'        => $_POST['notel'],
               'alamat' => $_POST['alamat']
            );
            $this->db->insert('supplier_bp', $data);
          
            redirect('c_masterdata/lihat_supp_bp');
         }
       
      
   }
   
   public function isi_edit_supp_bp($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('supplier_bp', "no_supp_bp = '$id'")->row_array();
         $this->template->load('template', 'supplier/update', $x);
       
      
   }
   public function edit_supp_bp()
   {
      
         $config = array(
            
            array(
               'field' => 'nama_supp_bp',
               'label' => 'Nama Supplier',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!'
               )
            ),
            array(
               'field' => 'notel',
               'label' => 'No. Telepon',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'alamat',
               'label' => 'Alamat',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
       
            
         
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_supp_bp'];
            $this->isi_edit_supp_bp($id);
         } else {
            $no_supp_bp   = $_POST['no_supp_bp'];
            $nama_supp_bp = $_POST['nama_supp_bp'];
            $notel        = $_POST['notel'];
            $alamat       = $_POST['alamat'];
            
            $data = array(
               'nama_supp_bp' => $nama_supp_bp,
               'notel' => $notel,
               'alamat' => $alamat
            );
            
            $this->db->where('no_supp_bp', $no_supp_bp);
            $this->m_masterdata->update_data('supplier_bp', $data);
            redirect('c_masterdata/lihat_supp_bp');
            
         }
         
       
   }

   //bop

    public function lihat_bop()
   {
      
         
         $data['result'] = $this->db->get('bop')->result_array();
         $this->template->load('template', 'bop/view', $data);
       
   }
   public function form_bop()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_bop,3)) as kode FROM bop";
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
         $no_trans   = "BOP_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'bop/form', $data);
       
   }
   
   public function tambah_bop()
   {
      
         
         $config = array(
            
            array(
               'field' => 'bulan',
               'label' => 'Bulan',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'tahun',
               'label' => 'Harga',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_bop();
         } else {
            $data = array(
               'no_bop' => $_POST['no_bop'],
               'bulan' => $_POST['bulan'],
               'tahun' => $_POST['tahun']
            );
            $this->db->insert('bop', $data);
           
            redirect('c_masterdata/lihat_bop');
         }
       
      
   }
   
   public function isi_edit_bop($id)
   {


         $x['jenis_bop'] = $this->db->get('jenis_bop')->result_array();
         $this->db->where('no_bop', $id);
         $tahun = $this->db->get('bop')->row()->tahun; //Mengambil tahun saat ini



         $this->db->where('no_bop', $id);
         $bulan = $this->db->get('bop')->row()->bulan; //Mengambil bulan saat ini
         $tgl_hari = $tahun."-".$bulan."-01";
         
        $query = "SELECT b.no_jbop, a.no_bop, c.nama_jbop, harga, DAY(LAST_DAY(CONCAT(tahun,'-',bulan,'-01'))) as hari
         FROM bop a 
         JOIN detail_bop b ON b.no_bop = a.no_bop
         JOIN jenis_bop c ON c.no_jbop = b.no_jbop
         WHERE a.no_bop LIKE '".$id."'
         ORDER BY b.no_jbop ASC
      ";
         $x['result'] = $this->db->query($query)->result_array();
         
         $x['data'] = $this->m_masterdata->edit_data('bop', "no_bop = '$id'")->row_array();
         $this->template->load('template', 'bop/update', $x);
         // var_dump($x['result']);
       
      
   }
   public function edit_bop()
   {
      
         $config = array(
            
            array(
               'field' => 'no_jbop',
               'label' => 'Nama BOP',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
            // ,
            // array(
            //    'field' => 'harga',
            //    'label' => 'Harga (bulanan)',
            //    'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[11]',
            //    'errors' => array(
            //       'required' => '%s tidak boleh kosong!',
            //       'is_natural_no_zero' => '%s hanya berupa angka 1-9!',
            //       'min_length' => '%s minimal 3 huruf!',
            //       'max_length' => '%s maksimal 11 huruf!'
            //    )
            // )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_bop'];
            $this->isi_edit_bop($id);
         } else {
            $no_bop   = $_POST['no_bop'];
            $no_jbop = $_POST['no_jbop'];
            $harga   = $_POST['harga'];
            
            $data = array(
               'no_bop' => $no_bop,
               'harga' => $harga,
               'no_jbop' => $no_jbop
            );

            $this->db->where(array('no_bop' => $_POST['no_bop'], 'no_jbop' => $_POST['no_jbop']));
            $cek =  $this->db->get('detail_bop')->num_rows();
            if($cek == 0 ){
            $this->db->insert('detail_bop', $data);
            }else{
            $this->db->set('harga', $_POST['harga'], FALSE);
            $this->db->where(array('no_bop' => $_POST['no_bop'], 'no_jbop' => $_POST['no_jbop']));
            $this->db->update('detail_bop');
            }
            redirect('c_masterdata/isi_edit_bop/'.$no_bop.'');
            
         }
         
         
   }

   public function hapus_bop($id,$id2){
      $this->db->query("SET GLOBAL FOREIGN_KEY_CHECKS=0");
         $this->db->where('no_bop',$id);
         $this->db->where('no_jbop', $id2);
         $this->db->delete('detail_bop');
         $this->db->query("SET GLOBAL FOREIGN_KEY_CHECKS=1");
      
            redirect('c_masterdata/isi_edit_bop/'.$id.'');
   }


 //btk

    public function lihat_btk()
   {
      
         
         $data['result'] = $this->db->get('btk')->result_array();
         $this->template->load('template', 'btk/view', $data);
       
   }
   public function form_btk()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_btk,3)) as kode FROM   btk";
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
         $no_trans   = "BTK_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'btk/form', $data);
       
   }
   
   public function tambah_btk()
   {
      
         
         $config = array(
            
            array(
               'field' => 'bulan',
               'label' => 'Bulan',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'tahun',
               'label' => 'Tahun',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
            )
            ),
            array(
               'field' => 'jumlah_pgw',
               'label' => 'Jumlah Pegawai',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            ),
            array(
               'field' => 'tarif',
               'label' => 'Tarif Harga',
               'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[11]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 11 huruf!'
               )
            )

         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_btk();
         } else {
            $data = array(
               'no_btk' => $_POST['no_btk'],
               'bulan' => $_POST['bulan'],
               'tahun' => $_POST['tahun'],
               'jumlah_pgw' => $_POST['jumlah_pgw'],
               'tarif' => $_POST['tarif']
            );
            $this->db->insert('btk', $data);
           
            redirect('c_masterdata/lihat_btk');
         }
       
      
   }
   
   public function isi_edit_btk($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('btk', "no_btk = '$id'")->row_array();
         $this->template->load('template', 'btk/update', $x);
       
      
   }
   public function edit_btk()
   {
      
         $config = array(
            
            
            array(
               'field' => 'jumlah_pgw',
               'label' => 'Jumlah Pegawai',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            ),
            array(
               'field' => 'tarif',
               'label' => 'Tarif Harga',
               'rules' => 'required|is_natural_no_zero|min_length[1]|max_length[11]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'is_natural_no_zero' => '%s hanya berupa angka 1-9!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 11 huruf!'
               )
            )

         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_btk'];
            $this->isi_edit_btk($id);
         } else {
          
            $data = array(
               'jumlah_pgw' => $_POST['jumlah_pgw'],
               'tarif' => $_POST['tarif']
            );
            
            $this->db->where('no_btk', $_POST['no_btk']);
            $this->m_masterdata->update_data('btk', $data);
            redirect('c_masterdata/lihat_btk');
            
         }
         
       
   }


    //Konsumen IPS

    public function lihat_ips()
   {
      
         
         $data['result'] = $this->db->get('konsumen_ips')->result_array();
         $this->template->load('template', 'ips/view', $data);
       
   }
   public function form_ips()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_ips,3)) as kode FROM konsumen_ips";
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
         $no_trans   = "IPS_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'ips/form', $data);
       
   }
   
   public function tambah_ips()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_ips',
               'label' => 'Nama Konsumen IPS',
               'rules' => 'required|min_length[3]|max_length[30]|is_unique[konsumen_ips.nama_ips]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
            array(
               'field' => 'notel',
               'label' => 'No. Telepon',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'alamat',
               'label' => 'Alamat',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_ips();
         } else {
            $data = array(
               'no_ips' => $_POST['no_ips'],
               'nama_ips' => $_POST['nama_ips'],
               'notel' => $_POST['notel'],
               'alamat' => $_POST['alamat']
            );
            $this->db->insert('konsumen_ips', $data);
           
            redirect('c_masterdata/lihat_ips');
         }
       
      
   }
   
   public function isi_edit_ips($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('konsumen_ips', "no_ips = '$id'")->row_array();
         $this->template->load('template', 'ips/update', $x);
       
      
   }
   public function edit_ips()
   {
      
         $config = array(
            
           array(
               'field' => 'nama_ips',
               'label' => 'Nama Konsumen IPS',
               'rules' => 'required|min_length[3]|max_length[30]|is_unique[konsumen_ips.nama_ips]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            ),
            array(
               'field' => 'notel',
               'label' => 'No. Telepon',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            array(
               'field' => 'alamat',
               'label' => 'Alamat',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_ips'];
            $this->isi_edit_ips($id);
         } else {
            $no_bp   = $_POST['no_ips'];
            $nama_bp = $_POST['nama_ips'];
            $notel   = $_POST['notel'];
            $alamat  = $_POST['alamat'];
            
            $data = array(
               'nama_ips' => $nama_bp,
               'notel' => $notel,
               'alamat' => $alamat
            );
            
            $this->db->where('no_ips', $no_bp);
            $this->m_masterdata->update_data('konsumen_ips', $data);
            redirect('c_masterdata/lihat_ips');
            
         }
         
       
   }

     //BOM

    public function lihat_bom()
   {
      
         
         $data['result'] = $this->db->get('produk')->result_array();
         $this->template->load('template', 'bom/view', $data);
       
   }
   
   
   public function isi_edit_bom($id)
   {
      
         $query = "(SELECT no_bb as no_bbp, nama_bb as nama_bbp, satuan FROM bahan_baku)
                  UNION
                  (SELECT no_bp, nama_bp, satuan FROM bahan_penolong)
                  ORDER BY no_bbp";
         $x['result'] = $this->db->query($query)->result_array();
         $query1 = "SELECT no_produk, no_bb as no_bbp, nama_bb as nama_bbp, satuan, jumlah
                     FROM bahan_baku a
                     JOIN bom b
                     ON a.no_bb = b.no_bbp
                     WHERE no_produk LIKE '".$id."'
                     UNION
                     SELECT no_produk, no_bp, nama_bp, satuan , jumlah
                     FROM bahan_penolong a
                     JOIN bom b
                     ON a.no_bp = b.no_bbp
                     WHERE no_produk LIKE '".$id."'
                     ORDER BY no_bbp";
         $x['result1'] = $this->db->query($query1)->result_array();
         
         $x['data'] = $this->m_masterdata->edit_data('produk', "no_produk = '$id'")->row_array();
         $this->template->load('template', 'bom/update', $x);
       
      
   }
   public function edit_bom()
   {
      
         $config = array(
            
            array(
               'field' => 'no_bbp',
               'label' => 'Nama Bahan Baku / Penolong',
               'rules' => 'required',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!'
               )
            ),
            
            array(
               'field' => 'jumlah',
               'label' => 'Jumlah Bahan',
               'rules' => 'required',
               'errors' => array(
                  'required' => 'Inputan Salah'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_produk'];
            $this->isi_edit_bom($id);
         } else {
            $no_produk   = $_POST['no_produk'];
            $no_bbp = $_POST['no_bbp'];
            $jumlah   = $_POST['jumlah'];
            
            $data = array(
               'no_produk' => $no_produk,
               'no_bbp' => $no_bbp,
               'jumlah' => $jumlah
            );


            $this->db->where(array('no_bbp' => $_POST['no_bbp'], 'no_produk' => $_POST['no_produk']));
            $cek =  $this->db->get('bom')->num_rows();
            if($cek == 0 ){
            $this->db->insert('bom', $data);
            }else{
            $this->db->set('jumlah', "jumlah + ".$_POST['jumlah']."", FALSE);
            $this->db->where(array('no_bbp' => $_POST['no_bbp'], 'no_produk' => $_POST['no_produk']));
            $this->db->update('bom');

           
            
         }
         
        redirect('c_masterdata/isi_edit_bom/'.$no_produk.'');
   }
}


   
      public function hapus_bom($id,$id2){
      $this->db->query("SET GLOBAL FOREIGN_KEY_CHECKS=0");
         $this->db->where('no_produk',$id);
         $this->db->where('no_bbp', $id2);
         $this->db->delete('bom');
         $this->db->query("SET GLOBAL FOREIGN_KEY_CHECKS=1");
      
            redirect('c_masterdata/isi_edit_bom/'.$id.'');
   }


   //Jenis BOP

    public function lihat_jbop()
   {
      
         
         $data['result'] = $this->db->get('jenis_bop')->result_array();
         $this->template->load('template', 'jenis_bop/view', $data);
       
   }
   public function form_jbop()
   {
      
         
         $query1   = "SELECT  MAX(RIGHT(no_jbop,3)) as kode FROM jenis_bop";
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
         $no_trans   = "JBOP_" . $kd;
         $data['id'] = $no_trans;
         $this->template->load('template', 'jenis_bop/form', $data);
       
   }
   
   public function tambah_jbop()
   {
      
         
         $config = array(
            
            array(
               'field' => 'nama_jbop',
               'label' => 'Nama Bahan Baku',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]|is_unique[jenis_bop.nama_jbop]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $this->form_jbop();
         } else {
            $data = array(
               'no_jbop' => $_POST['no_jbop'],
               'nama_jbop' => $_POST['nama_jbop']
            );
            $this->db->insert('jenis_bop', $data);
           
            redirect('c_masterdata/lihat_jbop');
         }
       
      
   }
   
   public function isi_edit_jbop($id)
   {
      
         
         
         $x['data'] = $this->m_masterdata->edit_data('jenis_bop', "no_jbop = '$id'")->row_array();
         $this->template->load('template', 'jenis_bop/update', $x);
       
      
   }
   public function edit_jbop()
   {
      
         $config = array(
            
            array(
               'field' => 'nama_jbop',
               'label' => 'Nama Bahan Baku',
               'rules' => 'required|callback_customAlpha|min_length[3]|max_length[30]|is_unique[jenis_bop.nama_jbop]',
               'errors' => array(
                  'required' => '%s tidak boleh kosong!',
                  'min_length' => '%s minimal 3 huruf!',
                  'max_length' => '%s maksimal 30 huruf!',
                  'customAlpha' => '%s hanya boleh berupa huruf!',
                  'is_unique' => '%s sudah ada di database!'
               )
            )
         );
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>  ', '</div>');
         $this->form_validation->set_rules($config);
         
         if ($this->form_validation->run() == FALSE) {
            $id = $_POST['no_jbop'];
            $this->isi_edit_jbop($id);
         } else {
            $no_jbop   = $_POST['no_jbop'];
            $nama_jbop = $_POST['nama_jbop'];
            
            
            $data = array(
               'nama_jbop' => $nama_jbop
            );
            
            $this->db->where('no_jbop', $no_jbop);
            $this->m_masterdata->update_data('jenis_bop', $data);
            redirect('c_masterdata/lihat_jbop');
            
         }
         
       
   }






   public function customAlpha($str)
   {
      return (!preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
   }
}