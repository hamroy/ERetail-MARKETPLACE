<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_lapProduk extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_rProduk','produk');
		$this->load->model('M_cud');
	}

	public function index()
	{ 
		if($this->session->userdata('login')==FALSE){
		$this->session->unset_userdata('login',FALSE);
		/////REV 20190128
    	redirect('login');
   		////
    	}
	}

	function viewProduk($id=0){
		$this->index();
		$a=$this->produk->getProdukId($id);

		echo json_encode($a);


	}

	function saveUpProduk(){
		$this->index();
		$id=$this->input->post('id');
		$men=0;
		if ($this->input->post('mendali')!='') {
			$men=$this->input->post('mendali');
		}
		$data=array(
		'id_k'=>$this->input->post('id_k'),
		);

		$dataR=[
			'table'=>'tbl_laporan_produk',
			'where'=>[
				'id_produk'=>$id,
			],
			'data'=>[
			'id_produk'=>$id,
			'kualitas'=>$men,
			],
		];

		$this->Madmin->simpan_save_data($data,$id);
		$c=$this->produk->cekProduk($id);

		if ($c == 0) {
		$this->M_cud->insertData($dataR);
		}else{
		$this->M_cud->updateData($dataR);
		}

		$this->session->set_flashdata('pesan','data berhasil di perbaharui .');
		redirect ($this->M_setapp->urlBack());	

	}

	function cekMEndali($id){
		print_r($this->produk->ketMendali($id));
	}

} //c