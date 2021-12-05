<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_loadFirst extends CI_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('M_loadFirst');
    }

    //Menampilkan data kontak
    function index() {
    	if ($this->session->userdata('login')==false) {
    		redirect('Login');
    	}
    	$id=$this->session->userdata('id_user');
       
        
        $get_trnsaksiProses=$this->Madmin->get_Produk_diproses($id);
                  if($get_trnsaksiProses->num_rows() > 0){
                      foreach($get_trnsaksiProses->result() as $gidp){ 
                        $hdur=$gidp->durasi;
                        $dur = $this->M_time->durasi_ymd($hdur,5);
                          if ($dur!=0) {
                            // continue;
                          }

                        ECHO $gidp->idTransaksi ."---".$dur."penjual <br/>";
                        
                        $this->M_loadFirst->UpTransaksi($gidp->idTransaksi);
                        $this->M_loadFirst->UpTransaksiProses($gidp->idTransaksi);

                      }
                  }
        
        $this->index2();
        $this->index3();
         
        redirect ('C_uprevdb/');
    }
    
    function index2() {
        if ($this->session->userdata('login')==false) {
            redirect('Login');
        }
        $id=$this->session->userdata('id_user');
        
        $get_trnsaksiProses=$this->M_loadFirst->get_Produk_diproses_pembeli($id);
                  if($get_trnsaksiProses->num_rows() > 0){
                      foreach($get_trnsaksiProses->result() as $gidp){ 
                        $hdur=$gidp->durasi;
                        $dur = $this->M_time->durasi_ymd($hdur,5);
                          if ($dur!=0) {
                            // continue;
                          }

                        ECHO $gidp->idTransaksi ."---".$dur."pembeli <br/>";
                        
                        $this->M_loadFirst->UpTransaksi($gidp->idTransaksi);
                        $this->M_loadFirst->UpTransaksiProses($gidp->idTransaksi);

                      }
                    }

    }

function index3() {
        if ($this->session->userdata('login')==false) {
            redirect('Login');
        }
        $this->load->model('M_dompetKu');
        $id=$this->session->userdata('id_user');
        echo $id;

        $x=$this->M_dompetKu->getDataDompetPerakun($id);
        
        if($x['expired']==0){
            $this->M_loadFirst->UpTransaksi_dipesan($id);
            $this->M_loadFirst->saldo_expired($id);
            
        }
    }

    function informasi() {
       
        if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
		$data=$this->Muser->getDataProfil(); ///get masing masing id user
		///

		///rev 61017
        
        $data['view']='upresdb/form_job';

		$this->load->view('pages/admin/beranda',$data);
        ///

		} else { ///pengan login

                $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

        }
       
    }

    function fromnRev() {
        if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
		$data=$this->Muser->getDataProfil(); ///get masing masing id user
		///

		///rev 61017
        
        $data['view']='upresdb/form_uploadNBM';

		$this->load->view('pages/admin/beranda',$data);
        ///

		} else { ///pengan login

                $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

        }
       
    }

    function fromnRating() {
        if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
        $data=$this->Muser->getDataProfil(); ///get masing masing id user
        ///

        ///rev 61017
        
        $data['view']='upresdb/form_rating';

        $this->load->view('pages/admin/beranda',$data);
        ///

        } else { ///pengan login

                $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

        }
       
    }
    
    ///Jivcoba ilham
     function get_kd() {
         
       setcookie('ctoken',time(),time() + (30 * 30),'/'); //86400 * 30 = ihari
            
       echo "ANDA MASUK TIDAK SESUAI PROSEDUR ANDA AKAN DILAPORKAN KE POLISI. <br>
        <br/> ";
        $g=fopen('php://stdin','r');
        
        echo $line=fgets($g);
       
    }
    
   


    //Masukan function selanjutnya disini
}