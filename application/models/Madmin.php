<?php

class Madmin extends CI_Model {

	var $table = 'ueu_tbl_user';
	function __construct()
	{
		parent::__construct();
	}
	
	
	
	
	function get_all_id_produk($id_kat,$kat){
		$this->db->where('id_user',$id_kat);
		$this->db->where('id_k',$kat);
		$this->db->order_by('id' ,'DESC');
		return $this->db->get('tbl_produk');
	}
	
	
	function get_nama_kat_perid($id_k){
		$this->db->from('tbl_produk, tbl_kategori');
		$this->db->where('tbl_produk.id_k = tbl_kategori.id');
		$this->db->where('tbl_kategori.id',$id_k);
		$this->db->order_by('tbl_produk.id' ,'DESC');
		
		return $this->db->get();
	}
   
    function get_nama_kat_perid_online($id_k){
		$this->db->from('tbl_kategori');
		$this->db->where('id',$id_k);
		
		return $this->db->get();
	}
	
	function get_all_id_produk_perkateggori($id_kat){
		$this->db->where('id_user',$id_kat);
		$this->db->group_by('id_k');
		$this->db->order_by('id' ,'DESC');
		return $this->db->get('tbl_produk');
	}
	function get_all_id_produk_perkateggori_master(){
		$this->db->group_by('id_k');
		$this->db->order_by('id' ,'asc');
		return $this->db->get('tbl_produk');
	}

	function get_produk_by_id($id){
		$this->db->from('tbl_produk, tbl_kategori');
		$this->db->where('tbl_produk.id_k = tbl_kategori.id');
		$this->db->where('tbl_produk.id',$id);
		return $this->db->get();
	}
    
    function get_produk_byid_ok($id){
		$this->db->where('id',$id);
		return $this->db->get('tbl_produk');
	}
    
    function get_produk_byid_last(){
		$this->db->select_max('id');
		return $this->db->get('tbl_produk')->row()->id;
	}
	

	///==================================================================GETM TRANSAKSI 
	function get_all_transaksi00($id_user){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	
	///==================================================================GETM TRANSAKSI  per id
	
	///==================================================================GETM TRANSAKSI TERBARU
	function get_all_transaksi($bln,$id_user){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
    function get_all_transaksi_perbln($bln,$id_user,$thn){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	//==================================================================GETM TRANSAKSI TERBARU
    
    ///==================================================================GETM TRANSAKSI SELESAI
	function get_all_transaksi_selesai($id_user){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');WW
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	//==================================================================GETM TRANSAKSI TERBARU
	function get_all_transaksi_id_user($id_user){
		$this->db->from('tbl_transaksi');
		$this->db->where('id_user',$id_user); ///yang di ambil beli ..
		$this->db->order_by('id','DESC'); ///yang di ambil beli ..
		$this->db->where('metode !=','');
		
		return $this->db->get();
	}
	//==================================================================GETM TRANSAKSI TERBARU
	function get_all_transaksi_monitor(){
        $this->db->where('id >','1440');
		$this->db->from('tbl_transaksi');
		$this->db->order_by('id','DESC'); ///yang di ambil beli ..
		
		return $this->db->get();
	}
	function get_all_transaksi_monitor_day($xxx,$xx,$x){
		$this->db->from('tbl_transaksi');
		$this->db->where('thn',$x); ///yang di ambil beli ..
		$this->db->where('bln',$xx); ///yang di ambil beli ..
		$this->db->where('day',$xxx); ///yang di ambil beli ..
		$this->db->order_by('id','DESC'); ///yang di ambil beli ..
		
		return $this->db->get();
	}
	//==================================================================GETM TRANSAKSI TERBARU
	function get_all_transaksi_id_user_obatal($id_user){
		$this->db->from('tbl_transaksi');
		$this->db->where('id_user',$id_user); ///yang di ambil beli ..
		$this->db->order_by('id','DESC'); ///yang di ambil beli ..
		$this->db->where('metode !=','');
		$this->db->where('buy !=','Batal_ot');
		return $this->db->get();
	}
	
	function get_all_transaksi_id_user_obatal_dibeli($id_user,$jv=0){
		$this->db->from('tbl_transaksi');
		$this->db->where('id_pelapak',$id_user); ///yang di ambil beli ..
		$this->db->order_by('id','DESC'); ///yang di ambil beli ..
		$this->db->where('metode !=','');
		$this->db->where('j_voucher',$jv); //20180501
		$this->db->where('buy','dibayar');
		return $this->db->get();
	}
    
    ////REV 51117
    function get_all_transaksi_id_user_obatal_dibeli_voucher($id_user,$jv=0){
		
		 $get_id_produk=$this->get_all_transaksi_id_user_obatal_dibeli($id_user,$jv);
				   $tottunai=0;
				   $totvoc=0;
         foreach($get_id_produk->result() as $gidp){
         if($gidp->harga_satuan!=0){
				$akhirsat=$gidp->harga_satuan;
			}else{
				$akhirsat='1';
			}
         switch($gidp->metode){
						case 'VOUCHER':
						$totvoc=$totvoc+$akhirsat*$gidp->qty;
						break;
						case 'TUNAI':
						$tottunai=$tottunai+$akhirsat*$gidp->qty;
						break;
						}
         
         $has=$totvoc;
         }
         
         
         return $has;
         
         
	}
	
	///==================================================================GETM TRANSAKSI  per id
	function get_all_transaksi_id($id_user){
		$this->db->from('tbl_pembeli, tbl_transaksi');
		$this->db->where('tbl_pembeli.id = tbl_transaksi.id_pembeli');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_transaksi.id_pembeli',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	///==================================================================GET PRODUK DI PESAN 
	function get_Produk_dipesan($id_user){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
	//	$this->db->group_by('tbl_transaksi.id_produk'); ///yang di ambil beli ..
		//$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	///==================================================================GET PRODUK DI PESAN 
    
    ////////REV 131017
    ///==================================================================GET PRODUK DI PESAN 
	function get_Produk_dipesan_perid($id_user,$id){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.id',$id); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
	//	$this->db->group_by('tbl_transaksi.id_produk'); ///yang di ambil beli ..
		//$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	///==================================================================GET PRODUK DI PESAN 
     ///==================================================================GET PRODUK DI PESAN  PERIDRTRANSAKSI
	function get_Produk_dipesan_perid_transaksi($id_user,$id){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.id_tgl',$id); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
	//	$this->db->group_by('tbl_transaksi.id_produk'); ///yang di ambil beli ..
		//$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	///==================================================================GET PRODUK DI PESAN 
	///==================================================================GET get_Produk_dipesan_all
	function get_Produk_dipesan_all_old(){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
	//	$this->db->group_by('tbl_transaksi.id_produk'); ///yang di ambil beli ..
		//$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
    function get_Produk_dipesan_all($via,$st='dipesan'){
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
		// $this->db->where('tbl_transaksi.buy','dipesan'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy',$st); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode',$via); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
	//	$this->db->group_by('tbl_transaksi.id_produk'); ///yang di ambil beli ..
		//$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	///==================================================================get_Produk_dipesan_all
	function getidpembeli($id_pembeli){
		$this->db->from('tbl_pembeli');
		$this->db->where('id',$id_pembeli); ///yang di ambil beli ..
		return $this->db->get();
	}
    ///==================================================================get_Produk_dipesan_all
	function getid_trnasaksi($id){
		$this->db->from('tbl_transaksi');    
		$this->db->where('id',$id); ///yang di ambil beli ..
		return $this->db->get();
	}
	
	function kosong_data(){
        $this->db->where('id_unit !=', 0);
        $this->db->delete('ueu_tbl_user');
		
	}
	function simpan_save_data($d,$id){
        $this->db->where('id ', $id);
        $this->db->update('tbl_produk',$d);
		
	}
	
	function simpan_del_data($id){
        $this->db->where('id ', $id);
        $this->db->delete('tbl_produk');
		
	}
	///DEL data user 1 agustus
	function del_data_user($id){
        $this->db->where('idlog ', $id);
        $this->db->delete('ueu_tbl_user');
		
	}
	///DEL data produk 1 agustus
	function del_data_produk($id){
        $this->db->where('id ', $id);
        $this->db->delete('tbl_produk');
		
	}
	///DEL data pesan voucher 1 agustus
	function del_data_pesan_voucher($id){
        $this->db->where('id ', $id);
        $this->db->delete('tbl_pesan_voucher');
		
	}
    function del_data_pesan_v_parsel($id){
        $this->db->where('id ', $id);
        $this->db->delete('tbl_pesan_v_parsel');
		
	}
    
    function del_data_pesan_v_song($id){
        $this->db->where('id ', $id);
        $this->db->delete('tbl_pesan_v_songsong');
		
	}
    function del_data_pesan_v_mhs($id){
        $this->db->where('id ', $id);
        $this->db->delete('tbl_pesan_v_mhs');
		
	}
	
	function update_info($d)
	{
		$this->db->where('id',1);
		$this->db->update('ueu_tbl_info', $d);
	}
	
	function get_user_by_id($id_user){
		$this->db->where('idlog',$id_user);
		return $this->db->get('ueu_tbl_user');
	}

	///REV 201902

	function get_Produk_diproses($id_user){
		$this->db->from('tbl_transaksi_proses, tbl_transaksi,tbl_produk');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		$this->db->where('tbl_transaksi_proses.idTransaksi = tbl_transaksi.id');

		$this->db->where('tbl_produk.id_user',$id_user); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi_proses.proses',2); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','diproses'); ///yang di ambil beli ..
		$this->db->group_by('tbl_transaksi_proses.idTransaksi'); ///yang di ambil beli ..

		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		return $this->db->get();
	}

	function get_transpros_id($id){

		$this->db->from('tbl_transaksi_proses, tbl_transaksi,tbl_produk');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		$this->db->where('tbl_transaksi_proses.idTransaksi = tbl_transaksi.id');

		$this->db->where('tbl_transaksi.id',$id); ///yang di ambil beli ..
		$this->db->group_by('tbl_transaksi_proses.idTransaksi'); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		return $this->db->get();

	}
	
}