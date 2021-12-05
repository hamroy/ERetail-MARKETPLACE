<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_select2 extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/

	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() { 
      parent::__construct();
      $this->load->database();
       } 
     
	public function index()
	{
		$json = [];
		if(!empty($this->input->get("q"))){
			$this->db->like('nama_prodi', $this->input->get("q"));
			$query = $this->db->select('kode_prodi as id,nama_prodi as text')
						->limit(10)
						->get("tbl_kodefakprod");
			$json = $query->result();
		}

		
		echo json_encode($json);
	}
    
     public function myformAjax($id) { 
       $this->db->like('nama_prodi', $id);
       $result = $this->db->where("nama_prodi !=",NULL)->get("tbl_kodefakprod")->result();
       echo json_encode($result);
   }
    
}
?>