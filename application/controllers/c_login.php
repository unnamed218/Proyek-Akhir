 <?php 
class c_login extends CI_Controller{
    
  function cek_login()
        {
            $query = $this->m_login->cek($_POST['username'],($_POST['password']));
            if($this->session->userdata('level') == TRUE){
                redirect('c_masterdata/beranda');
            }elseif($query->num_rows()<>0)
            {
                $data_session = array('status'=>"login");
                foreach($query->result_array() as $data)
                {
                    $sess_data['username'] = $data['username'];
                    $sess_data['password'] = $data['password'];
                    $sess_data['level']    = $data['level'];
                    $sess_data['nama_lengkap']    = $data['nama_lengkap'];
                    $this->session->set_userdata($sess_data);
                }
                $this->session->set_userdata($data_session);
                $level = $this->session->userdata('level');
                if($level == "admin")
                {
                    redirect('c_masterdata/beranda');
                }elseif ($level == "produksi") 
                {
                    redirect('c_masterdata/beranda');
                }elseif($level == "pembelian"){
                    redirect('c_masterdata/beranda');
                }elseif($level == "penjualan"){
                    redirect('c_masterdata/beranda');
                }elseif($level == "keuangan"){
                    redirect('c_masterdata/beranda');
                }
            
            }else{
                    $data['error'] = 'Username atau Password anda salah!';
                    $this->load->view('template1',$data);
                }
            }

        
    
    public function home(){
        if($this->session->userdata('level') == TRUE){
            redirect('c_masterdata/beranda');
        }else{
       $this->load->view('template1');
   }
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect ('c_login/home');
    }
}
 ?>

