<?php

class Mbmt extends CI_Model {

	var $table = 'ueu_tbl_user';
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function check_daftar_pesan_voucher($id)
	{   
		$query = $this->db->get_where('tbl_pesan_voucher', array('id_user' => $id), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
		function get_daftar_pesan_voucher($id)
	{   
		return $this->db->get_where('tbl_pesan_voucher', array('id_user' => $id));
		
		
	}
	
	function get_tbl_redeem($id){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.id',$id);
		return $this->db->get();
	}
	
	function get_tbl_reedeem_perid_user($id,$jv=0){ ///alll selain di tolak
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.id_user',$id);
		$this->db->where('tbl_user_redeem.j_voucher',$jv);
		$this->db->where('tbl_user_redeem.status !=',2); ///2 == ditolak
		$a=$this->db->get();
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->redeem);
			}
			return $t;
			
		}else{
			return 0;
		}
	}
    
    function get_tbl_reedeem_perid_user_perstatus($id,$jv=0,$sta){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.id_user',$id);
		$this->db->where('tbl_user_redeem.j_voucher',$jv);
		$this->db->where('tbl_user_redeem.status',$sta); ///2 == ditolak
		$a=$this->db->get();
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->redeem);
			}
			return $t;
			
		}else{
			return 0;
		}
	}
    
    function get_tbl_reedeem_perid_user_selesai($id,$jv=0,$sta){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.id_user',$id);
		$this->db->where('tbl_user_redeem.j_voucher',$jv);
		$this->db->where('tbl_user_redeem.status !=',0); ///2 == ditolak
		$this->db->where('tbl_user_redeem.status !=',2); ///2 == ditolak
		$a=$this->db->get();
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->redeem);
			}
			return $t;
			
		}else{
			return 0;
		}
	}
    
    function getreedeem_perid_user_st($id,$st){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.id_user',$id);
		$this->db->where('tbl_user_redeem.status',$st); ///2 == ditolak
		$a=$this->db->get();
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->redeem);
			}
			return $t;
			
		}else{
			return 0;
		}
	}
    
    function get_tbl_reedeem_perid_user_awl($id){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.id_user',$id);
		$this->db->where('tbl_user_redeem.status',0);
		$a=$this->db->get();
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->redeem);
			}
			return $t;
			
		}else{
			return 0;
		}
	}
	function get_tbl_redeem_all($st=0){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.status',$st);
		$this->db->order_by('tbl_user_redeem.id','DESC');
		return $this->db->get();
	}
	
	function get_tbl_redeem_all_cetak3_eror(){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user,tbl_pesan_voucher');
		$this->db->where('tbl_pesan_voucher.id_user = ueu_tbl_user.idlog');
		$this->db->where('ueu_tbl_user.idlog = tbl_pesan_voucher.id_user');
		$this->db->where('tbl_user_redeem.status',3);
		return $this->db->get();
	}
	
		function get_tbl_redeem_all_cetak3(){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.status',3);
		return $this->db->get();
	}
	
		function get_tbl_pesan_voucher($id){
		$this->db->select('*');
		$this->db->from('tbl_pesan_voucher,ueu_tbl_user');
		$this->db->where('tbl_pesan_voucher.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_pesan_voucher.id_user',$id);
		return $this->db->get();
	}
	
	function get_tbl_redeem_all_setuju(){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.status',1);
		return $this->db->get();
	}
	
	
	/// SELESAI
	function get_tbl_redeem_all_selesai(){
		$this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.status',4);
		return $this->db->get();
	}
	
	function update_tbl_reedem($d,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_user_redeem', $d);
	}
	
	function get_tbl_reedem_id($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('tbl_user_redeem');
	}
	function update_info($d)
	{
		$this->db->where('id',1);
		$this->db->update('ueu_tbl_info', $d);
	}
	function simpan_edt_bio($d,$id)
	{
		$this->db->where('idlog',$id);
		$this->db->update('ueu_tbl_user', $d);
	}
	function sip_login($d)
	{
		//$this->db->where('id',1);
		$this->db->insert('tbl_lap_ship', $d);
	}
	function simpan_daftar($d)
	{
		//$this->db->where('id',1);
		$this->db->insert('ueu_tbl_user', $d);
	}
	
	/////rev :: 9/juli
	function simpan_daftar_sbm($d)
	{
		//$this->db->where('id',1);
		$this->db->insert('tbl_peserta_sbm', $d);
	}
	function sip_login_sip($d)
	{
		//$this->db->where('id',1);
		$this->db->insert('tbl_login_ship', $d);
	}
	///UP:201908
	function get_user_redeem($status,$prodi){
		$this->db->select('id_user,idlog,ni,nbm,nama,redeem,sum(redeem) as sRedeem');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.status !=',2);
		$this->db->where('ueu_tbl_user.job',$status);
		if ($status==3) {
			$this->db->where('ueu_tbl_user.kode_prodi',$prodi);
		}
		$this->db->order_by('ueu_tbl_user.idlog');
		$this->db->group_by('ueu_tbl_user.ni','DESC');
		return $this->db->get();
	}



}