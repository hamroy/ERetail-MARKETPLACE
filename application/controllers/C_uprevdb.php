<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_uprevdb extends CI_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //Menampilkan data kontak
    function index() {

    	if ($this->session->userdata('login')==false) {
    		redirect('Login');
    	}
    	$id=$this->session->userdata('id_user');
        $a=$this->db->get_where('tbl_cekakunrev',array('id_user'=>$id)); //1 revnip
        $g_id=$this->Muser->get_id_pass(); ///get masing masing id user
        // print_r($g_id->result());
        if ($a->num_rows()==0) {
        	$this->db->insert('tbl_cekakunrev',array('id_user'=>$id,'status'=>1));
        	$this->db->insert('tbl_cekakunrev',array('id_user'=>$id,'status'=>2));
        }

        $c=$this->db->get_where('tbl_cekakunrev',array('id_user'=>$id,'status'=>1)); //1 revnip
        $c1=$this->db->get_where('tbl_cekakunrev',array('id_user'=>$id,'status'=>2));// revFotoNBM

        if ($g_id->row()->job==3) {
        	if ($c1->num_rows()>0) {
        		return $this->fromnRev();
        	}
        }	

        if($c->num_rows()>0 and $g_id->row()->job!=3 and $g_id->row()->job!=1001){
           return $this->fromni();    
        }

        
        
        // redirect ('C_dompet/'); /// pemeriksaan akhir
        redirect ('User_admin/');
        
        
    }

    function fromni() {
       
        if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
		$data=$this->Muser->getDataProfil(); ///get masing masing id user
		///

		///rev 61017
        
        $data['view']='upresdb/form_job';

		$this->load->view('pages/admin/beranda',$data);
        ///
        $this->session->set_userdata('login',false);

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
    
    ///Jivcoba ilham
     function get_kd() {
         
       setcookie('ctoken',time(),time() + (30 * 30),'/'); //86400 * 30 = ihari
            
       echo "ANDA MASUK TIDAK SESUAI PROSEDUR ANDA AKAN DILAPORKAN. <br>
        <br/> ";
        $g=fopen('php://stdin','r');
        
        echo $line=fgets($g);
       
    }
    
    function rubah_data_profil($id){
		$id=$this->session->userdata('id_user');
        $d=array(

		//'job'=>$this->input->post('job'),

		'ni'=>$this->input->post('ni'),

		);

		///
        
         
         if(!isset($_COOKIE['Clogin'])){
             
             $this->get_kd();
             $this->finish();
             
         }
        
        if(is_numeric($this->input->post('ni')) and ($_COOKIE['Clogin']==true)){
        $this->Madmin_master->block_penjual_model($id,$d);    
        $this->session->set_flashdata('pesan','data berhasil Dikirim.');
        $this->session->set_userdata('login',true);
        
        
        //save
        $this->Login_model->simpan_revData($id,1,'Rev NI');
        
        }else{
            //$this->session->set_userdata('login',false);
            
        }
		

		//bila belum buat kalau udah di update

        $this->finish();

		

	}

    public function finish($value='')
    {
        redirect ('User_admin/');
    }


    //Masukan function selanjutnya disini
}