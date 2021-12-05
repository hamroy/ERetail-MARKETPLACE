<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Servis extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('idlog');
        if ($id == '') {
            //$kontak = $this->db->get('ueu_tbl_user')->result();
            $kontak = null;
        } else {
            $this->db->select('idlog, nama, status, username');
            $this->db->where('idlog', $id);
            $this->db->where('status', 1);//status 1 = akun terdaftar
                    
            $kontak = $this->db->get('ueu_tbl_user')->result();
        }
        $this->response($kontak, 200);
    }
    
    ///Jivcoba ilham
     function get_kd() {
         echo 123123;
       
       
    }


    //Masukan function selanjutnya disini
}