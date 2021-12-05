<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cetakA extends CI_Model {

function get_penjualMhs($s){
	// $sort=1;
        $sort=$this->session->userdata('sort_a');
        $sort2=$this->session->userdata('statp');
        
        if($sort==2){
        //$this->db->order_by('job' ,'ESC');     
        if($sort2!='' and $s==1){
        $this->db->where('job' ,$sort2);    
        }
        
        }else{
        $this->db->order_by('idlog' ,'DESC');        
        }
    /////*/
        $this->db->order_by('idlog' ,'DESC');
        $this->db->where('status' ,$s);
    ///jika mhs
        // kode_prodi
        if($sort2=='3'){
        $statprodi=$this->session->userdata('statprodi');
        $this->db->where('kode_prodi', $statprodi);
        }
        
    //
        $this->db->where('wewenang !=','admin');

		$this->db->where('status !=' ,3);

		$this->db->where('status !=' ,0);

		return $this->db->get('ueu_tbl_user');
}

}