<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_dompetlain extends CI_Controller {

    public function __construct() { 
      parent::__construct();
      $this->load->database();
      $this->load->model('M_saldompet');
    } 
     
	public function index()
	{
		$stjob=$this->M_setapp->get_info_p()->job;
            if($stjob != 3 and $stjob != 1001){
                redirect ('Login');
            }
	$this->dompet_lain();
    }
   
     public function c_email()
    {
        //////////////notifikasi email 21/3/17
		$ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://host21.registrar-servers.com";
        $config['smtp_port'] = "465";
        $config['wordwrap'] = TRUE;
         //$config['smtp_user'] = "E-Retail@jualretail.com";
        $config['smtp_user'] = "admin@E-Retail.com";
        //$config['smtp_pass'] = "beduk2017";
        $config['smtp_pass'] = "52TuGw}TZSa7";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
 		//$list = array('ilhamroyroy@gmail.com');
        $ci->email->from('admin@E-Retail.com', 'E-Retail SUPERMALL');
    }
    
    
    public function dompet_lain()

	{	
		if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){

		    $stjob=$this->M_setapp->get_info_p()->job;
            if($stjob != 3 and $stjob != 1001){
                redirect ('Login');
            }	

		$g_id=$this->Muser->get_id_pass(); ///get masing masing id user

		$data['img']=$g_id->row()->img;

		$data['nama']=$g_id->row()->nama;

		$data['alamat']=$g_id->row()->alamat;

		$data['kontak']=$g_id->row()->no_kontak;

		$data['username']=$g_id->row()->username;

		$data['rek']=$g_id->row()->rek;

		$data['nbm']=$g_id->row()->nbm;

		$data['bank']=$g_id->row()->bank;

		$data['sex']=$g_id->row()->jenis_kelamin;

		$data['id_user']=$g_id->row()->idlog;

		$data['job']=$job=$g_id->row()->job;

		$data['ni']=$ni=$g_id->row()->ni;
		$data['kodeprodi']=$g_id->row()->kode_prodi;

		///

		$data['voucher_umy']=$g_id->row()->voucher_umy;

		$data['dompet']=$g_id->row()->dompet;

		$data['voucher_dibelanjakan']=$g_id->row()->voucher_dibelanjakan;

		$data['dompet_dicairkan']=$g_id->row()->dompet_dicairkan;

		//================================================================

		$data['title0']='E-Retail';

		$data['title1']='E-Retail';

		///

		

		

		///

		$data['a']='';

		$data['c']=$data['d']='';

		$data['b']='';

		$data['l']='active';
		$data['l4']='active';

		///

		///rev 61017

		if(empty($job) or empty($ni)){

		$data['view']='pages/admin/viewer/dompet/form_job';

		}else{

		$data['view']='pages/admin/dompetLain/dompet_lain';	

		}

		

		

			

		$this->load->view('pages/admin/beranda',$data);

		 } else { ///pengan login

                $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

        }

	}
     
}
