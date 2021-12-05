<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class C_akunproduk extends CI_Controller {


	var $thn_c;

	function __construct(){

		parent::__construct();

		  $this->load->helper(array('form', 'url'));
          $this->load->model('M_vparsel');
          $this->load->model('M_dompetall');
          $this->load->model('M_akunproduk');

		  $this->load->library('Pdf');
          $thn_c=$this->M_time->thn();
          $this->thn_c=$thn_c;

	}
    
        
    function hapuspilihan(){
       foreach($_POST['id_pr'] as $value){
           
        $this->M_akunproduk->delperidproduk($value);
       }
       $this->session->set_flashdata('pesan','SUKSES .');
       
       
       
        
        //var_dump($d);
        redirect ('Master_admin/daftar_produk_tolak/');
    }
    
    function hapuspilihanakun(){
       foreach($_POST['id_pr'] as $value){
           
        $this->M_akunproduk->delperidakun($value);
       }
       $this->session->set_flashdata('pesan','SUKSES .');
       
       
       
        
        //var_dump($d);
        redirect ('Master_admin/list_penjual_tolak/');
    }

   	

}



