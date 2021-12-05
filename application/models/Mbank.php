<?php

class Mbank extends CI_Model {

	var $table = 'ueu_tbl_user';
	
	function __construct()
	{
		parent::__construct();
	}
	
    function cek_transaksi_user($id_pembeli,$tgl){
        $this->db->from('tbl_transaksi,tbl_tagihan');
		$this->db->where('tbl_tagihan.idtgl = tbl_transaksi.id_tgl');
		$this->db->where('tbl_tagihan.id_user = tbl_transaksi.id_user');
		$this->db->where('tbl_transaksi.id_user',$id_pembeli);
		$this->db->where('tbl_transaksi.id_tgl',$tgl);
		//$this->db->group_by('tbl_transaksi.id_produk');
		$this->db->order_by('tbl_transaksi.id');

		return $this->db->get();

	}
    
    function cek_transaksi_pembeli($id_pembeli,$tgl){
        $this->db->from('tbl_transaksi,tbl_tagihan');
		$this->db->where('tbl_tagihan.idtgl = tbl_transaksi.id_tgl');
		$this->db->where('tbl_tagihan.id_user = tbl_transaksi.id_user');
		$this->db->where('tbl_transaksi.id_user',$id_pembeli);
		$this->db->where('tbl_transaksi.id_tgl',$tgl);
		//$this->db->group_by('tbl_transaksi.id_produk');
		$this->db->order_by('tbl_transaksi.id');

		return $this->db->get();

	}
    
    ///GET DATA SUDAH PROSES
    
    
    function savekodepembayaran($d){
    
    $this->db2->insert('tbl_tagihan',$d);
    
    }
    
    //////////////
    
    function get_tagihan($id){
        
            //$this->db->select('kodepembayaran,id_user,status,tgl_t');
            $this->db->where('kodepembayaran', $id);
           // $this->db->where('kodepembayaran', $id);
            $kontak = $this->db->get('tbl_tagihan');
            
            return $kontak;
    }

    function get_tampil_tagihan($id){
        
           // $this->db2->select('kodepembayaran,id_user,status,tgl_t');
            $this->db->where('kodepembayaran', $id);
           // $this->db->where('kodepembayaran', $id);
            $kontak = $this->db->get('tbl_tagihan');
            return $kontak;
    }

    function get_user_bm($id){
        
            $this->db2->where('idlog', $id);
            $kontak = $this->db2->get('ueu_tbl_user');
            return $kontak;
    }
    
    function get_tagihan_bm($id){
        
            $this->db->select('kodepembayaran,id_user,status,tgl_t');
            $this->db->where('kodepembayaran', $id);
           // $this->db->where('kodepembayaran', $id);
            $kontak = $this->db->get('tbl_tagihan');
            
            return $kontak;
    }

    
    function get_tot_transaksi_peridtran($id_tgl,$id_pembeli){

        $this->db->where('id_tgl',$id_tgl);
		$this->db->group_by('id_produk');
		$this->db->where('id_pembeli',$id_pembeli);

		$this->db->order_by('id','DESC');

		$list= $this->db->get('tbl_transaksi');
        
        $tot=0;
        if($list->num_rows()>0){
            
        
	    foreach($list->result() as $t){
            $tot=$tot+$t->qty*$t->harga_satuan+0;
        } ///loop
        
        }
        
        return $tot;

	}



    
    
    
	
	
}