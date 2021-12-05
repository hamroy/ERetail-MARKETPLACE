<?php

class M_transaksiAkun extends CI_Model {


	function getDataPembeli($id,$id_user){

		$this->db->select('id,idlog,id_user,tbl_pembeli.nama');
		$a=$this->db->from('tbl_pembeli,ueu_tbl_user')
		->where('tbl_pembeli.id_user=ueu_tbl_user.idlog')
		->where('id',$id)
		->get();
		$nama=$id;
		if ($a->num_rows() > 0) {

			$nama=$a->row()->nama;
		}else{
			$gp=$this->getDataPembeliIduser($id_user);
			if ($gp->num_rows()>0) {
				$nama=$gp->row()->nama;
			}

		}

		///
		$d=[
			'nama'=>$nama,
		];
		return $d;
		
	}	

	function getDataPembeliIduser($id_user){
		$this->db->select('idlog,nama');
		$a=$this->db->from('ueu_tbl_user')
		->where('idlog',$id_user)
		->get();

		return $a;
	}

///
	function getDataProduk($id){

		

		$this->db->select('id,nama');
		$this->db->where('id', $id);

		$a=$this->db->get('tbl_produk');

		$nama=$id;

		if ($a->num_rows() > 0) {
			$nama=$a->row()->nama;
		}

		$d=[
			'nama'=>$nama,
		];

		return $d;

	}

///pendapatan

	public function totPendapatanAkunSelesai($value='')
	{
		return $this->totPendapatanAkun(1);

	}

	public function getTransaksiAllAkun()
	{
		$id_user=$this->session->userdata('id_user');
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');WW
		$this->db->where('tbl_transaksi.id_pelapak',$id_user); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}
	public function getTransaksiAllAkunBelanja()
	{
		$id_user=$this->session->userdata('id_user');
		$this->db->from('tbl_produk, tbl_transaksi');
		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');
		$this->db->where('tbl_transaksi.id_user',$id_user); ///yang di ambil beli ..
		$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');
		return $this->db->get();
	}

	public function totPendapatanAkun($p=1) //1=selesai
	{

		if ($p==1) {
			$a=$this->Madmin->get_all_transaksi_selesai($this->session->userdata('id_user'));
		}else{
			$a=$this->getTransaksiAllAkun();
		}
		
		$tunaiDipesan=0;
		$tunaiDiproses=0;
		$tunaiSelesai=0;
		$transDipesan=0;
		$transDiproses=0;
		$transSelesai=0;
		$voucherDipesan=0;
		$voucherDiproses=0;
		$voucherSelesai=0;
		if ($a->num_rows() >0) {
			foreach($a->result() as $gidp){
				$subtot=$gidp->harga_satuan*$gidp->qty;
	        	switch($gidp->metode){
					case 'VOUCHER':

						switch ($gidp->buy) {
							case 'dipesan':
								$voucherDipesan=$voucherDipesan+$subtot;
								break;
							case 'diproses':
								$voucherDiproses=$voucherDiproses+$subtot;
								break;

							case 'dibayar':
								$voucherSelesai=$voucherSelesai+$subtot;
								break;

						}
	                
					break;
					case 'TRANSFER':
	                
	                 
		                switch ($gidp->buy) {
							case 'dipesan':
								$transDipesan=$transDipesan+$subtot;
								break;

							case 'diproses':
								$transDiproses=$transDiproses+$subtot;
								break;
							
							case 'dibayar':
								$transSelesai=$transSelesai+$subtot;
								break;
						}
					
					break;
					
					default:

						switch ($gidp->buy) {
							case 'dipesan':
								$tunaiDipesan=$tunaiDipesan+$subtot;
								break;

							case 'diproses':
								$tunaiDiproses=$tunaiDiproses+$subtot;
								break;
							
							case 'dibayar':
								$tunaiSelesai=$tunaiSelesai+$subtot;
								break;
						}
					
					break;

					}

			}
		}
		$d=[
			'tunaiDipesan'=>$tunaiDipesan,
			'tunaiDiproses'=>$tunaiDiproses,
			'tunaiSelesai'=>$tunaiSelesai,
			'transDipesan'=>$transDipesan,
			'transDiproses'=>$transDipesan,
			'transSelesai'=>$transSelesai,
			'voucherDipesan'=>$voucherDipesan,
			'voucherDiproses'=>$voucherDipesan,
			'voucherSelesai'=>$voucherSelesai,
			'totalPendapatan'=>$tunaiSelesai+$voucherSelesai+$transSelesai,
		];
		return $d;
	}
	
	///belanja
	public function totBelanjaAkunSelesai($value='')
	{
		return $this->totBelanjaAkun(1);

	}
	//
	public function totBelanjaAkun($p=1) //1=selesai
	{

		if ($p==1) {
			$a=$this->Madmin->get_all_transaksi_id_user($this->session->userdata('id_user'));
		}else{
			$a=$this->getTransaksiAllAkunBelanja();
		}
		
		$tunaiDipesan=0;
		$tunaiDiproses=0;
		$tunaiSelesai=0;
		$transDipesan=0;
		$transDiproses=0;
		$transSelesai=0;
		$voucherDipesan=0;
		$voucherDiproses=0;
		$voucherSelesai=0;
		if ($a->num_rows() >0) {
			foreach($a->result() as $gidp){
				$subtot=$gidp->harga_satuan*$gidp->qty;
	        	switch($gidp->metode){
					case 'VOUCHER':

						switch ($gidp->buy) {
							case 'dipesan':
								$voucherDipesan=$voucherDipesan+$subtot;
								break;
							case 'diproses':
								$voucherDiproses=$voucherDiproses+$subtot;
								break;

							case 'dibayar':
								$voucherSelesai=$voucherSelesai+$subtot;
								break;

						}
	                
					break;
					case 'TRANSFER':
	                
	                 
		                switch ($gidp->buy) {
							case 'dipesan':
								$transDipesan=$transDipesan+$subtot;
								break;

							case 'diproses':
								$transDiproses=$transDiproses+$subtot;
								break;
							
							case 'dibayar':
								$transSelesai=$transSelesai+$subtot;
								break;
						}
					
					break;
					
					default:

						switch ($gidp->buy) {
							case 'dipesan':
								$tunaiDipesan=$tunaiDipesan+$subtot;
								break;

							case 'diproses':
								$tunaiDiproses=$tunaiDiproses+$subtot;
								break;
							
							case 'dibayar':
								$tunaiSelesai=$tunaiSelesai+$subtot;
								break;
						}
					
					break;

					}

			}
		}
		$d=[
			'tunaiDipesan'=>$tunaiDipesan,
			'tunaiDiproses'=>$tunaiDiproses,
			'tunaiSelesai'=>$tunaiSelesai,
			'transDipesan'=>$transDipesan,
			'transDiproses'=>$transDipesan,
			'transSelesai'=>$transSelesai,
			'voucherDipesan'=>$voucherDipesan,
			'voucherDiproses'=>$voucherDipesan,
			'voucherSelesai'=>$voucherSelesai,
			'totalBelanja'=>$tunaiSelesai+$voucherSelesai+$transSelesai,
		];
		return $d;
	}
	
public function prosesTransaksi($p)
{
	$d='';
	switch($p){
			case 'dipesan':
			$d= 'PESAN';
			break;
			case 'diproses':
		  	$d= 'DIPROSES';
		 	break;
			case 'dibayar':
			$d= 'SELESAI';
			break;
			case 'Batal_ot':
			$d= 'Di Tolak';
			break;
			case 'expired':
			$d= 'expired';
			break;
			case 'ya':
			$d= 'keranjang';
			break;
			case 'input':
			$d= 'input Offline';
			break;
      }
      return $d;
}

}///class