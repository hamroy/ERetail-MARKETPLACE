<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akunproduk extends CI_Model {

	

	public function __construct()
	{
		parent::__construct();
	}

	function delperidproduk($id){
        $this->db->where('id',$id);
        $this->db->delete('tbl_produk');
    }
    
    function delperidakun($id){
        $this->db->where('idlog',$id);
        $this->db->delete('ueu_tbl_user');
    }

}