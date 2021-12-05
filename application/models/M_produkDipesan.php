<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produkDipesan extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function getTransaksiGroupNoTagihan($id_user,$dt=null){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		if ($dt[0]!=null) {
		$this->db->where('tbl_transaksi.day',$dt['2']); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.bln',$dt['1']); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$dt['0']); ///yang di ambil beli ..
		}
		

		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->group_by('tbl_transaksi.id_tgl'); ///yang di ambil beli ..

		return $this->db->get();
	}

	function getTransaksiGroupNoProduk($id_user,$dt=null){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		if ($dt[0]!=null) {
		$this->db->where('tbl_transaksi.day',$dt['2']); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.bln',$dt['1']); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$dt['0']); ///yang di ambil beli ..
		}
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->group_by('tbl_transaksi.id_produk'); ///yang di ambil beli ..

		return $this->db->get();
	}
	
	function getTransaksiGroupNoPembeli($id_user,$dt=null){
			$this->db->from('tbl_produk, tbl_transaksi');
			$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
			$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
			if ($dt[0]!=null) {
			$this->db->where('tbl_transaksi.day',$dt['2']); ///yang di ambil beli ..
			$this->db->where('tbl_transaksi.bln',$dt['1']); ///yang di ambil beli ..
			$this->db->where('tbl_transaksi.thn',$dt['0']); ///yang di ambil beli ..
			}
			$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
			$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
			$this->db->group_by('tbl_transaksi.id_pembeli'); ///yang di ambil beli ..

			return $this->db->get();
		}

	function getQtyperNoTagihan($idtgl){
		$this->db->from('tbl_transaksi');
		$this->db->where('id_tgl',$idtgl); 
		$a=$this->db->get();
		//
		$subtot=0;
		$subqty=0;
		if ($a->num_rows() > 0) {
			foreach ($a->result() as $key) {
				$subtot=$subtot+$key->qty*$key->harga_satuan ;
				$subqty=$subqty+$key->qty;
			}
		}

		$d=[

			'subtot'=>number_format($subtot,2,',','.'),
			'subqty'=>$subqty,

		];
		return $d;
	}

	function getQtyperProduk($id_produk,$penjual){
		$this->db->from('tbl_transaksi');
		$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		$this->db->where('id_produk',$id_produk); 
		$this->db->where('id_pelapak',$penjual); 
		$a=$this->db->get();
		//
		$subtot=0;
		$subqty=0;
		if ($a->num_rows() > 0) {
			foreach ($a->result() as $key) {
				$subtot=$subtot+$key->qty*$key->harga_satuan ;
				$subqty=$subqty+$key->qty;
			}
		}

		$d=[

			'subtot'=>number_format($subtot,2,',','.'),
			'subqty'=>$subqty,

		];
		return $d;
	}

	function getQtyperPembeli($id_pembeli,$penjual){
		$this->db->from('tbl_transaksi');
		$this->db->where('tbl_transaksi.buy','DIPESAN'); ///yang di ambil beli ..
		$this->db->where('id_user',$id_pembeli); 
		$this->db->where('id_pelapak',$penjual); 
		$a=$this->db->get();
		//
		$subtot=0;
		$subqty=0;
		if ($a->num_rows() > 0) {
			foreach ($a->result() as $key) {
				$subtot=$subtot+$key->qty*$key->harga_satuan ;
				$subqty=$subqty+$key->qty;
			}
		}

		$d=[

			'subtot'=>number_format($subtot,2,',','.'),
			'subqty'=>$subqty,

		];
		return $d;
	}

	function get_Pdipesan_all($via,$st='dipesan',$tg=null,$bd=1){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		$this->db->where('tbl_transaksi.buy',$st); 
		$this->db->where('tbl_transaksi.metode',$via); 

		if ($tg[0]!=null) {
			$this->db->where('tbl_transaksi.day',$tg[2]); 
			$this->db->where('tbl_transaksi.thn',$tg[0]); 
			$this->db->where('tbl_transaksi.bln',$tg[1]); 
		}
		$this->db->order_by('tbl_transaksi.id','DESC'); 
		if ($bd==2) {
			$this->db->group_by('tbl_transaksi.id_produk'); 
		}elseif ($bd==3) {
			$this->db->group_by('tbl_transaksi.id_pembeli'); 
		}
		

		return $this->db->get();
	}

	function getQtyperAllPembeli($v,$m,$b,$bd,$dt){
		$this->db->from('tbl_transaksi');

		if ($dt[0]!=null) {
		$this->db->where('tbl_transaksi.day',$dt['2']); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.bln',$dt['1']); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$dt['0']); ///yang di ambil beli ..
		}
		$this->db->where('tbl_transaksi.buy',$m); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode',$v); ///yang di ambil beli ..

		if ($bd==2) {
			$this->db->where('id_produk',$b);  
		}elseif ($bd==3) {
			$this->db->where('id_user',$b); 
		}
		
		$a=$this->db->get();
		//
		$subtot=0;
		$subqty=0;
		if ($a->num_rows() > 0) {
			foreach ($a->result() as $key) {
				$subtot=$subtot+$key->qty*$key->harga_satuan ;
				$subqty=$subqty+$key->qty;
			}
		}

		$d=[

			'subtot'=>$subtot,
			'subqty'=>$subqty,

		];
		return $d;
	}


} //cls