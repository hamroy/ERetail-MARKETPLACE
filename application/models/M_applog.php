<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_applog extends CI_Model {

function save_log($d){
	$this->db->insert('tbl_log_login_bm',$d);
}

}