<?php

class M_produk extends CI_Model {

	function get_all_grupkat($id){

		$this->db->where('id_user',$id);
		$this->db->where('id_k !=',null);

		$this->db->group_by('id_k');
		$this->db->order_by('id' ,'DESC');
		return $this->db->get('tbl_produk');
	}

	function get_all_perkat($id,$kat){
		$this->db->where('id_user',$id);
		$this->db->where('id_k',$kat);
		$this->db->order_by('id' ,'DESC');
		return $this->db->get('tbl_produk');
	}

	function get_all_perkat_tdel($id){
		$this->db->where('id_produk',$id);
		$this->db->order_by('idno' ,'DESC');
		return $this->db->get('tbl_produk_del');
	}

	public function get_dataproduk($id,$kat)
	{
		$a =$this->get_all_perkat($id,$kat);
		$b=0;
		$c=0;
		if($a->num_rows() > 0){
  		 foreach($a->result() as $kat){

  		 	$b=$this->get_all_perkat_tdel($kat->id)->num_rows();;
  		 	if($b > 0){

  		 		$c--;

  		 	}





  		 }
  		} 

  		$d=[

  			'total'=>$a->num_rows(),
  			'total_tdel'=>$a->num_rows()+$c,
  			'total_del'=>$b,


  		];

  		return $d;

	}

	function sdata_produk($d,$id){
        $this->db->where('id', $id);
        $this->db->update('tbl_produk',$d);
		
	}

	function indata_delproduk($d){
        $this->db->insert('tbl_produk_del',$d);
	}
	
	
		
}