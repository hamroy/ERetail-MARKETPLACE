<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class C_rekapProduk extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->model('M_rekapPenjualan');
		$this->load->model('M_rekapProduk');

		  

	}

	public function index()
	{
		if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='admin'){

		$data=$this->Muser->getDataProfil();

		$data['view']='pages/master_admin/rekapProduk/rekapProduk_awal';

		///

		$data['h']='active';
		$data['id_k']='';

		///

		$this->load->view('pages/admin/beranda',$data);

		}else{

			 $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

             redirect ('Login');

		}

	}

	public function rinciKat($id_k=1)
	{
		if($this->session->userdata('login')!=TRUE OR $this->session->userdata('wewenang')!='admin'){

			 $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

             redirect ('Login');

		}


		$data=$this->Muser->getDataProfil();

		$data['view']='pages/master_admin/rekapProduk/rekapProduk_awal';

		///

		$data['h']='active';
		$data['id_k']=$id_k;


		///

		$this->load->view('pages/admin/beranda',$data);

		
	}

	public function rinciStaA($id_k=1) //status
	{
		if($this->session->userdata('login')!=TRUE OR $this->session->userdata('wewenang')!='admin'){

			 $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

             redirect ('Login');

		}


		$data=$this->Muser->getDataProfil();

		$data['view']='pages/master_admin/rekapProduk/rekapProduk_awal';

		///

		$data['h']='active';
		$data['id_k']=$id_k;


		///

		$this->load->view('pages/admin/beranda',$data);

		
	}

}//class

