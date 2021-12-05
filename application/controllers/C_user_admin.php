<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user_admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                $this->load->model('Mtrans');
                $this->load->model('M_produk');
	}

	//untuk percobaan
	public function index()
	{
		echo 'ya';
	}

	public function addproduk($id_k=NULL)
	{	
		if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
			
		$data=$this->Muser->getDataProfil(); ///get masing masing id user
		
		$data['id_k']=$id_k;
		if($id_k!=NULL){
			$data['in']='in';
		}else{
			$data['in']='';
		}
		
		///
		$data['a']='';
		$data['c']=$data['d']='';
		$data['b']='active';
		///
		$data['view']='pages/admin/viewer/produk/Addproduk';
			//dropdown
			 $gtog=$this->Muser->get_kategori();
               
		if ($gtog->num_rows()>0){
			$no=1;
			$opsipasca1 = array('0'=>'---Pilih Kategori---');
			foreach($gtog->result() as $o){
				$opsipasca2[$o->id]=$o->kategori;
				$no++;
			}
			$data['kategori']=array_merge($opsipasca1,$opsipasca2);
			$data['prodi_default'] = '1';
		}//
		$this->load->view('pages/admin/beranda',$data);
		 } else { ///pengan login
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
        redirect ('Login');
        }
	}

    
    public function rinciproduk($id_produk=NULL)
	{	
		if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user' or $this->session->userdata('wewenang')=='admin'){
			
		$data=$this->Muser->getDataProfil(); ///get masing masing id user

		///
		$data['id_produk']=$id_produk;
		///
		$data['b']='active';
		///
		$data['view']='pages/admin/viewer/produk/rinciproduk';
		//dropdown
		$gtog=$this->Muser->get_kategori();
               
		if ($gtog->num_rows()>0){
			$no=1;
			$opsipasca1 = array('0'=>'---Pilih Kategori---');
			foreach($gtog->result() as $o){
				$opsipasca2[$o->id]=$o->kategori;
				$no++;
			}
			$data['kategori']=array_merge($opsipasca1,$opsipasca2);
			$data['prodi_default'] = '1';
		}//
				$this->load->view('pages/admin/beranda',$data);
		} else { ///pengan login
                $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
                redirect ('Login');
        }
	}
}
