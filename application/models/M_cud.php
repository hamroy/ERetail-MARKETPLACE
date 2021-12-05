<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cud extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function cekData($dt)
	{
		return $dt['data'];
	}
	
	function insertData($dt){

		$this->db->trans_begin();

		$this->db->insert($dt['table'],$dt['data']);

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        $ok=0;
		}
		else
		{
		        $this->db->trans_commit();
		        $ok=1;
		}

		return $ok;


	}

	function updateData($dt){

		$this->db->trans_begin();

		$this->db->where($dt['where']);
		$this->db->update($dt['table'],$dt['data']);

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        $ok=0;
		}
		else
		{
		        $this->db->trans_commit();
		        $ok=1;
		}

		return $ok;


	}

	function deleteData($dt){

		$this->db->trans_begin();

		$this->db->where($dt['where']);
		$this->db->delete($dt['table']);

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        $ok=0;
		}
		else
		{
		        $this->db->trans_commit();
		        $ok=1;
		}

		return $ok;


	}


}