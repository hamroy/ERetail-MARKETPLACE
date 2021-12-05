<?php



class Msupermarket extends CI_Model {


    function __construct(){

        parent::__construct();

    }

    function get_supermarket()
    {
        $this->db->order_by('id_supermarket');
    	return $this->db->get('tbl_supermarket');
    }

    function get_supermarket_by_id($id)
    {
    	$this->db->where('id_supermarket',$id);
    	return $this->db->get('tbl_supermarket');
    }
}