<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_bugapp extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}


	public function d($id_tgl)
	{ 

		 	$this->session->set_flashdata('pesanvo','Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Silahkan dicoba lagi.
			');

			 $this->db->where('id_tgl',$this->session->userdata('idtgluntukerror'));

			 $this->db->delete('tbl_transaksi');

			 $this->Mtrans->del_id_produk($t->id_produk,$id_pembeli);
		
			 redirect('welcome/beli_produk/');    





		
	}

	}
