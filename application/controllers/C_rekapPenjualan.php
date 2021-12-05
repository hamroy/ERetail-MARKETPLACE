<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_rekapPenjualan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function PostTgl($p=0)
	{ 
		$thn=$this->input->post('T_thn');
		$bln=$this->input->post('T_bln');
		$tgl=$this->input->post('T_tgl');

		$d=[

			'T_thn'=>$thn,
			'T_bln'=>$bln,
			'T_tgl'=>$tgl,
			'Tampil'=>1,
		];

		// print_r($d);

		// die();

		$this->session->set_userdata($d);


		// redirect('Master_admin/transaksi_penjualan');

		$this->rMasterAdminBack($p);
		
	}

	function sortStatus($kd,$p=0){

		if ($kd==0) {
    		# code...
    		// $kd='';
    	}
        $d=[
        'statusP'=>$kd,
        ];
        $this->session->set_userdata($d);
        
        //var_dump($d);
        $this->rMasterAdminBack($p);

	}

	function sortStatusProdi($kd,$p=0){

		if ($kd==0) {
    		# code...
    		// $kd='';
    	}
        $d=[
        'sProdiP'=>$kd,
        ];
        $this->session->set_userdata($d);
        
        //var_dump($d);
        $this->rMasterAdminBack($p);

	}

	function rMasterAdminBack($p){
		if ($p==1) {
		redirect ('Master_admin/transaksi_belanja');
    	}elseif ($p==2) {
    	redirect ('C_rekapProduk');
    	}

    	redirect ('Master_admin/transaksi_penjualan');

	}

}