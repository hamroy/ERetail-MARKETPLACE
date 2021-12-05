<?php



class Mtrans extends CI_Model
{



	function __construct()

	{

		parent::__construct();
	}



	function tambah($add)
	{

		$this->db->insert('tbl_transaksi', $add);
	}
	///UPDATE
	function update_plusqty($id, $id_prod, $t)
	{ ///id_pembeli //produk /iddata{
		$this->db->where('id_pembeli', $id);
		$this->db->where('id_produk', $id_prod);
		$this->db->where('buy', 'ya');
		$this->db->update('tbl_transaksi', $t);
	}



	function tambah_pembeli($add)
	{

		$this->db->insert('tbl_pembeli', $add);
	}

	function uptambah_pembeli($add)
	{
		$a = $this->getidpembeli_iduser($add['id_user']);

		if ($a->num_rows() > 0) {
			# code...
			$this->db->where('id_user', $add['id_user']);
			$this->db->update('tbl_pembeli', $add);
		} else {
			$this->db->insert('tbl_pembeli', $add);
		}
	}


	function update_pembeli($add, $id_pembeli)
	{
		///pake parameter.
		$this->db->where('id', $id_pembeli);

		$this->db->update('tbl_pembeli', $add);
	}

	function getprofilpembeli($id)
	{

		$this->db->where('id', $id);

		return $this->db->get('tbl_pembeli');
	}

	function getidpembeli_iduser($id)
	{

		$this->db->where('id_user', $id);
		return $this->db->get('tbl_pembeli');
	}

	//====================================================update_qty 

	function update_qty($id, $add)
	{

		$this->db->where('id', $id);

		$this->db->update('tbl_transaksi', $add);
	}

	//====================================================del_id_transaksi

	function del_id_produk($id, $id_p)
	{

		$this->db->where('id_produk', $id);

		$this->db->where('id_pembeli', $id_p);
		$this->db->where('buy', 'ya');

		$this->db->delete('tbl_transaksi');
	}

	function del_produk_buya($iduser)
	{


		$this->db->where('id_user', $iduser);
		$this->db->where('buy', 'ya');

		$this->db->delete('tbl_transaksi');
	}

	////del id barang di transaksi

	function del_id_transaksi($id)
	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_transaksi');
	}
	///update_bayar_otorisasi
	function update_bayar_otorisasi($id, $u)
	{
		$this->db->trans_begin();
		$this->db->where('id', $id);
		$this->db->update('tbl_transaksi', $u);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$ok = 0; //gagal
		} else {
			$this->db->trans_commit();
			$ok = 1;
		}

		return $ok;
	}



	function show_pembeli_maxid()
	{

		$this->db->select_max('id');

		return $this->db->get('tbl_pembeli')->row()->id;
	}

	function getidpelapk($id)
	{

		$this->db->where('id', $id);

		return $this->db->get('tbl_produk');
	}

	function upd_produkqty_sumua($id, $d)
	{

		$this->db->where('id', $id);

		$this->db->update('tbl_produk', array('laris' => $d));
	}

	function show_pembeli()
	{

		return $this->db->get('tbl_pembeli');
	}

	function get_qty_tbl_transaksi($id)
	{

		$this->db->where('id', $id);

		return $this->db->get('tbl_transaksi');
	}

	function get_tbl_transaksi_pelapak($id, $id_user)
	{

		$this->db->where('id', $id);
		$this->db->where('id_pelapak', $id_user);
		$this->db->where('buy', 'dibayar');
		$this->db->or_where('buy', 'diproses');

		return $this->db->get('tbl_transaksi');
	}

	//////////////REV20180122
	function get_tbl_transaksi_tgl($id, $bl, $th)
	{

		$this->db->where('day', $id);
		$this->db->where('bln', $bl);
		$this->db->where('thn', $th);

		return $this->db->get('tbl_transaksi');
	}
	function get_total_tbltransaksi_oto($id)
	{

		$this->db->where('id', $id);

		$a = $this->db->get('tbl_transaksi');
		if ($a->num_rows() > 0) {

			return $a->row()->qty * $a->row()->harga_satuan;
		} else {
			return 0;
		}
	}

	function get_tbl_pembeli($id)
	{

		$this->db->where('id', $id);

		return $this->db->get('tbl_pembeli');
	}

	function get_tbl_userpenjual($id)
	{

		$this->db->where('idlog', $id);

		return $this->db->get('ueu_tbl_user');
	}


	function get_tbl_produk($id)
	{

		$this->db->where('id', $id);

		return $this->db->get('tbl_produk');
	}

	function insert_pembeli_new()
	{

		$tp = $this->Mtrans->show_pembeli()->num_rows();

		$pembeli = $tp + 1;

		$this->session->set_userdata('id_pembeli', $pembeli);

		$d = array(

			'nama' => '',

		);

		$this->tambah_pembeli($d);
	}



	function lihat_keranjang_by_pembeli($id_pembeli)
	{

		$this->db->where('buy', 'ya');
		$this->db->group_by('id_produk');
		$this->db->where('id_pembeli', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}

	function lihat_keranjang_id_user($id_user)
	{

		$this->db->where('buy', 'ya');
		$this->db->group_by('id_produk');
		$this->db->where('id_user', $id_user);

		return $this->db->get('tbl_transaksi');
	}

	function lihat_keranjang_by_pelapak($id_user)
	{ ///Pelapak

		$this->db->where('buy', 'ya');

		$this->db->where('id_pelapak', $id_user);

		return $this->db->get('tbl_transaksi');
	}

	function lihat_keranjang_by_pembeli_tanpa_cart($id_pembeli)
	{
		//
		$this->db->where('buy', 'ya');

		$this->db->group_by('id_produk');
		$this->db->where('id_user', $id_pembeli);

		$this->db->order_by('id', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}

	function get_transaksi_produk_persorttgl_dipesan_email($id_tgl, $id_pembeli)
	{

		//$this->db->where('buy','dipesan');
		$this->db->where('id_tgl', $id_tgl);
		$this->db->group_by('id_produk');
		$this->db->where('id_user', $id_pembeli);

		$this->db->order_by('id', 'DESC');

		return $this->db->get('tbl_transaksi');
	}

	function get_transaksi_produk_persorttgl_dipesan($id_tgl)
	{

		$this->db->where('buy', 'dipesan');
		$this->db->where('id_tgl', $id_tgl);
		$this->db->group_by('id_produk');


		$this->db->order_by('id', 'DESC');

		return $this->db->get('tbl_transaksi');
	}

	////REV 160717

	function get_total_tbltransaksi($id_pembeli)
	{

		$this->db->where('buy', 'ya');

		$this->db->where('id_user', $id_pembeli);


		$a = $this->db->get('tbl_transaksi');
		if ($a->num_rows() > 0) {
			$t = 0;
			foreach ($a->result() as $x) {
				$t = $t + ($x->qty * $x->harga_satuan);
			}
			return $t;
		} else {
			return 0;
		}
	}

	////REV 160717

	function get_voucher_tbluser($id_pembeli)
	{


		$this->db->where('idlog', $id_pembeli);


		$a = $this->db->get('ueu_tbl_user');
		if ($a->num_rows() > 0) {

			return 0;
		} else {
			return 0;
		}
	}

	function get_voucher_tbluser_vocer($id_pembeli)
	{


		$this->db->where('idlog', $id_pembeli);


		return $this->db->get('ueu_tbl_user');
	}

	function get_prosuduk_all_nogrup($id_pro, $id_pembeli)
	{

		$this->db->where('buy', 'ya');

		$this->db->where('id_produk', $id_pro);
		$this->db->where('id_user', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}

	function get_prosuduk_all_nogrup_pesan($id_pro, $id_pembeli, $tgl)
	{

		$this->db->where('buy', 'dipesan');
		$this->db->where('id_tgl', $tgl);
		$this->db->where('id_produk', $id_pro);
		$this->db->where('id_pembeli', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}


	function get_prosuduk_all_nogrup_pesan_nobuy($id_pro, $id_pembeli, $tgl)
	{

		$this->db->where('id_tgl', $tgl);
		$this->db->where('id_produk', $id_pro);
		$this->db->where('id_pembeli', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}

	function get_prosuduk_all_nogrup_pelapak($id_pro, $id_pembeli, $penjual)
	{

		$this->db->where('buy', 'ya');
		$this->db->where('id_pelapak', $penjual);
		$this->db->where('id_produk', $id_pro);
		$this->db->where('id_pembeli', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}
	function get_prosuduk_all_nogrup_pelapak_email($id_pro, $id_pembeli, $penjual, $id_tgl)
	{

		//$this->db->where('buy','ya');
		$this->db->where('id_pelapak', $penjual);
		$this->db->where('id_produk', $id_pro);
		$this->db->where('id_tgl', $id_tgl);
		$this->db->where('id_pembeli', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}
	function get_produk_perpelapak($id_pembeli, $id_user)
	{

		$this->db->where('buy', 'ya');

		$this->db->where('id_pembeli', $id_pembeli);
		$this->db->group_by('id_produk');
		$this->db->where('id_pelapak', $id_user);

		$this->db->order_by('id', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}
	function get_produk_perpelapak_vok($sort, $id_user)
	{

		$this->db->where('buy', 'dipesan');

		$this->db->where('id_tgl', $sort);
		$this->db->group_by('id_produk');
		$this->db->where('id_pelapak', $id_user);

		$this->db->order_by('id', 'DESC');

		return $this->db->get('tbl_transaksi');
	}
	function get_produk_perpelapak_vokemail($sort, $id_user)
	{

		//$this->db->where('buy','dipesan');

		$this->db->where('id_tgl', $sort);
		$this->db->group_by('id_produk');
		$this->db->where('id_pelapak', $id_user);

		$this->db->order_by('id', 'DESC');

		return $this->db->get('tbl_transaksi');
	}
	function lihat_keranjang_by_pembeli_tanpa_cart_pesan($id_pembeli, $tgl)
	{
		//$this->db->where('buy','dipesan');
		$this->db->where('id_tgl', $tgl);
		$this->db->group_by('id_produk');
		$this->db->where('id_pembeli', $id_pembeli);
		$this->db->order_by('id');

		return $this->db->get('tbl_transaksi');
	}

	function lihat_keranjang_by_pembeli_tanpa_cart_penjual_id_tgl($id_pembeli, $tgl)
	{

		$this->db->where('id_pembeli', $id_pembeli);
		$this->db->group_by('id_pelapak');
		$this->db->where('id_tgl', $tgl);
		$this->db->order_by('id');

		return $this->db->get('tbl_transaksi');
	}

	function lihat_keranjang_by_pembeli_tanpa_cart_penjual($id_pembeli)
	{

		$this->db->where('buy', 'ya');

		$this->db->where('id_pembeli', $id_pembeli);
		$this->db->group_by('id_pelapak');

		$this->db->order_by('id', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}
	function gettranproduk_dipesan_forpenjual($id_tgl)
	{

		$this->db->where('buy', 'dipesan');
		$this->db->where('id_tgl', $id_tgl);

		$this->db->group_by('id_pelapak');

		$this->db->order_by('id', 'DESC');

		return $this->db->get('tbl_transaksi');
	}

	function gettranproduk_dipesan_forpenjual_email($id_tgl, $id_pembeli)
	{

		//$this->db->where('buy','dipesan');
		$this->db->where('id_tgl', $id_tgl);
		$this->db->where('id_user', $id_pembeli);
		$this->db->group_by('id_pelapak');

		$this->db->order_by('id', 'DESC');

		return $this->db->get('tbl_transaksi');
	}

	function lihat_keranjang_by_pelapak_tanpa_cart($id_pembeli)
	{

		$this->db->where('buy', 'ya');

		$this->db->where('id_pelapak', $id_pembeli);

		return $this->db->get('tbl_transaksi');
	}

	function get_all_idproduk($id_b)
	{

		$this->db->where('buy', 'dibayar');

		$this->db->where('id_produk', $id_b);

		return $this->db->get('tbl_transaksi');
	}

	function get_all_idproduk_pesan_keranjang($id_b, $id)
	{

		$this->db->where('buy', 'ya');  ///buy baru masuk keranjang

		$this->db->where('id_produk', $id_b);

		//$this->db->where('id_pelapak',$id);

		$this->db->where('id_pembeli', $id);





		return $this->db->get('tbl_transaksi');
	}

	function get_all_idproduk_pesan($id_b)
	{

		$this->db->where('buy', 'dipesan');

		$this->db->where('id_produk', $id_b);

		//$this->db->where('id_pelapak',$id);






		return $this->db->get('tbl_transaksi');
	}

	//keranhjang
	function get_all_idproduk_pesan_kerjang($id_b, $id_s)
	{

		$this->db->where('buy', 'ya');

		$this->db->where('id_produk', $id_b);
		$this->db->where('id_user', $id_s);

		//$this->db->where('id_pelapak',$id);
		return $this->db->get('tbl_transaksi');
	}

	/////////////////////////Ilham 5327

	function get_produkqty($id_pembeli)
	{

		$gt = $this->get_all_idproduk($id_pembeli);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	/////////////////////////Ilham 161017

	function get_produkqty_sumua($id, $s = 'dibayar')
	{
		$this->db->where('id_produk', $id);
		$this->db->where('buy', $s);
		$gt = $this->db->get('tbl_transaksi');


		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	function get_produkpembeli_sumua($id, $s = 'dibayar')
	{
		$this->db->where('id_produk', $id);
		$this->db->where('buy', $s);
		$gt = $this->db->get('tbl_transaksi');

		return $gt->num_rows();
	}

	function get_viewer_produk($id)
	{
		$this->db->where('id_produk', $id);
		$gt = $this->db->get('tbl_view_produk');

		return $gt;
	}

	function get_produkqty_dipesan_keranjang($id_p, $idembeli)
	{

		$gt = $this->get_all_idproduk_pesan_keranjang($id_p, $idembeli);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	function get_produkqty_dipesan($id)
	{

		$gt = $this->get_all_idproduk_pesan($id);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	//
	function get_produkqty_dikeranjang($id, $id_s)
	{

		$gt = $this->get_all_idproduk_pesan_kerjang($id, $id_s);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	function m_numrowsqty($id_produk, $id_pembeli)
	{

		$gt = $this->get_prosuduk_all_nogrup($id_produk, $id_pembeli);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	//pesan
	function m_numrowsqty_pesan($id_produk, $id_pembeli, $tgl)
	{

		$gt = $this->get_prosuduk_all_nogrup_pesan($id_produk, $id_pembeli, $tgl);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	//m_numrowsqty_pesan_dahlama
	function m_numrowsqty_pesan_dahlama($id_produk, $id_pembeli, $tgl)
	{

		//	$gt=$this->get_prosuduk_all_nogrup_pesan($id_produk,$id_pembeli,$tgl);
		$gt = $this->get_prosuduk_all_nogrup_pesan_nobuy($id_produk, $id_pembeli, $tgl);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	function m_numrowsqty_pelapak($id_produk, $id_pembeli, $penjual)
	{

		$gt = $this->get_prosuduk_all_nogrup_pelapak($id_produk, $id_pembeli, $penjual);
		//$gt=$this->get_prosuduk_all_nogrup($id_produk,$id_pembeli,$penjual);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}

	function m_numrowsqty_pelapak_email($id_produk, $id_pembeli, $penjual, $tglsort)
	{

		$gt = $this->get_prosuduk_all_nogrup_pelapak_email($id_produk, $id_pembeli, $penjual, $tglsort);
		//$gt=$this->get_prosuduk_all_nogrup($id_produk,$id_pembeli,$penjual);

		if ($gt->num_rows() > 0) {

			$agtq = 0;

			foreach ($gt->result() as $gtq) {

				$agtq = $agtq + $gtq->qty;
			}
		} else {

			$agtq = 0;
		}

		return $agtq;
	}



	function total_belanja_by_pembeli($id_pembeli)
	{

		$this->db->from('tbl_produk, tbl_transaksi');

		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		$this->db->where('tbl_transaksi.buy', 'ya');

		$this->db->where('tbl_transaksi.id_user', $id_pembeli);

		$q = $this->db->get();

		$tot = 0;

		if ($q->num_rows() > 0) {

			foreach ($q->result() as $t) {
				if (empty($t->hargak)) {
					$harga = $t->harga;
				} else {
					$harga = $t->hargak;
				}
				$tot = $tot + ($t->qty * $t->harga_satuan);
			}
		}

		return $tot;
	}

	function total_belanja_by_penjual($id_pembeli)
	{

		$this->db->from('tbl_produk, tbl_transaksi');

		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		$this->db->where('tbl_transaksi.buy', 'ya');

		$this->db->where('id_pelapak', $id_pembeli);

		$q = $this->db->get();

		$tot = 0;

		if ($q->num_rows() > 0) {

			foreach ($q->result() as $t) {

				$tot = $tot + ($t->qty * $t->harga);
			}
		}

		return $tot;
	}



	function update_bayar($id_pembeli, $u)
	{

		//	$this->db->where('id_pelapak',$id_pembeli);

		$this->db->where('buy', 'ya');

		$this->db->where('id_user', $id_pembeli);

		$this->db->update('tbl_transaksi', $u);
	}

	////REV 160717

	function simpan_update_tbluser($id_pembeli, $u)
	{ //updade user tentang voucher

		//	$this->db->where('id_pelapak',$id_pembeli);


		$this->db->where('idlog', $id_pembeli);

		$this->db->update('ueu_tbl_user', $u);
	}

	function simpan_tabl_riwayatvoc($u)
	{ //riwayat tentang voucher

		$this->db->trans_begin();
		$this->db->insert('tbl_riwayat_voucher', $u);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$ok = 0; //gagal
		} else {
			$this->db->trans_commit();
			$ok = 1;
		}

		return $ok;
	}

	function get_tabl_riwayatvoc($id, $id_user, $ko, $id_transaksi)
	{ //riwayat tentang voucher

		$this->db->where('id', $id);
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->where('id_user', $id_user);
		$this->db->where('kode', $ko);

		$a = $this->db->get('tbl_riwayat_voucher');
		if ($a->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_tabl_riwayatvoc_true($id, $id_user, $ko)
	{ //riwayat tentang voucher

		$this->db->where('id_transaksi', $id);
		$this->db->where('id_user', $id_user);
		$this->db->where('kode', $ko);

		$a = $this->db->get('tbl_riwayat_voucher');
		if ($a->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function cek_tab_transak_status($id, $buy)
	{ //tramnsaksiksi tentang voucher

		$this->db->where('id', $id);
		$this->db->where('buy', $buy);

		$a = $this->db->get('tbl_transaksi');
		if ($a->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function simpan_tabl_reedemuser($u)
	{ //riwayat tentang voucher


		$this->db->insert('tbl_user_redeem', $u);
	}

	////REV 160717

	function update_bayar_keranjang($id_pembeli, $u, $id)
	{

		$this->db->where('id', $id);

		$this->db->where('id_pembeli', $id_pembeli);



		$this->db->update('tbl_transaksi', $u);
	}

	function update_bayar_keranjang_user($id_user, $u, $id)
	{

		$this->db->where('id', $id);

		$this->db->where('id_pelapak', $id_user);



		$this->db->update('tbl_transaksi', $u);
	}

	function getpropuler()
	{

		$this->db->order_by('id', 'RANDOM');

		$this->db->where('id_k !=', 4);

		$this->db->where('nama !=', NULL);

		$this->db->where('gambar !=', NULL);

		$this->db->where('harga !=', 0);

		$this->db->where('stok !=', NULL);

		return $this->db->get('tbl_produk', 10, 0);
	}

	function getprobaru()
	{

		$this->db->order_by('id', 'DESC');

		$this->db->where('id_k !=', 4);

		$this->db->where('nama !=', NULL);

		$this->db->where('gambar !=', NULL);

		$this->db->where('harga !=', NULL);

		$this->db->where('harga !=', 0);

		return $this->db->get('tbl_produk', 10, 0);
	}

	function getpromurah()
	{

		$this->db->order_by('harga', 'ASC');

		$this->db->where('id_k !=', 4);

		$this->db->where('nama !=', NULL);

		$this->db->where('harga !=', NULL);

		$this->db->where('gambar !=', NULL);

		return $this->db->get('tbl_produk', 10, 0);
	}

	function getprobaruid()
	{

		$this->db->order_by('id', 'ASC');

		$this->db->where('id_k !=', 4);

		$this->db->where('nama !=', NULL);

		$this->db->where('harga !=', NULL);

		$this->db->where('gambar !=', NULL);

		return $this->db->get('tbl_produk', 10, 0);
	}

	function getpromrurruid()
	{

		$this->db->order_by('harga', 'DESC');

		$this->db->where('id_k !=', 4);

		$this->db->where('harga !=', NULL);

		$this->db->where('nama !=', NULL);

		$this->db->where('gambar !=', NULL);

		return $this->db->get('tbl_produk', 10, 0);
	}
	//////////////////////////////////////////////24317
	function getpropuler1()
	{
		$this->db->order_by('id', 'RANDOM');
		$this->db->where('id_k !=', 4);
		$this->db->where('id_k <=', 5);
		$this->db->where('status', 1);
		$this->db->where('nama !=', NULL);
		$this->db->where('gambar !=', NULL);
		$this->db->where('harga !=', 0);
		$this->db->where('stok !=', NULL);
		return $this->db->get('tbl_produk', 10, 0);
	}
	function getpropuler2()
	{
		$this->db->order_by('id', 'RANDOM');
		$this->db->where('id_k !=', 4);
		$this->db->where('id_k >=', 6);
		$this->db->where('id_k <=', 9);
		$this->db->where('nama !=', NULL);
		$this->db->where('gambar !=', NULL);
		$this->db->where('status', 1);
		$this->db->where('harga !=', 0);
		$this->db->where('stok !=', NULL);
		return $this->db->get('tbl_produk', 10, 0);
	}
	function getpropuler3()
	{
		$this->db->order_by('id', 'RANDOM');
		$this->db->where('id_k !=', 4);
		$this->db->where('id_k >=', 10);
		$this->db->where('id_k <=', 11);
		$this->db->where('nama !=', NULL);
		$this->db->where('gambar !=', NULL);
		$this->db->where('status', 1);
		$this->db->where('harga !=', 0);
		$this->db->where('stok !=', NULL);
		return $this->db->get('tbl_produk', 10, 0);
	}
	function getpropuler4()
	{
		$this->db->order_by('id', 'RANDOM');
		$this->db->where('status', 1);
		$this->db->where('id_k !=', 4);
		$this->db->where('id_k >=', 12);
		$this->db->where('id_k <=', 13);
		$this->db->where('nama !=', NULL);
		$this->db->where('gambar !=', NULL);
		$this->db->where('harga !=', 0);
		$this->db->where('stok !=', NULL);
		return $this->db->get('tbl_produk', 10, 0);
	}
	function getpropuler5()
	{
		$this->db->order_by('id', 'RANDOM');
		$this->db->where('id_k !=', 4);
		$this->db->where('status', 1);
		$this->db->where('id_k >=', 14);
		$this->db->where('id_k <=', 15);
		$this->db->where('status', 1);
		$this->db->where('nama !=', NULL);
		$this->db->where('gambar !=', NULL);
		$this->db->where('harga !=', 0);
		$this->db->where('stok !=', NULL);
		return $this->db->get('tbl_produk', 10, 0);
	}
	function getpropuler6()
	{
		$this->db->order_by('id', 'RANDOM');
		$this->db->where('id_k !=', 4);
		$this->db->where('status', 1);
		$this->db->where('id_k >=', 16);
		$this->db->where('id_k <=', 17);
		$this->db->where('status', 1);
		$this->db->where('nama !=', NULL);
		$this->db->where('gambar !=', NULL);
		$this->db->where('harga !=', 0);
		$this->db->where('stok !=', NULL);
		return $this->db->get('tbl_produk', 10, 0);
	}

	//////////
	function terbilang($x)
	{
		$abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		//if ($x == 0){ return 'Nol';}
		if ($x < 12)
			return " " . $abil[$x];
		elseif ($x < 20)
			return $this->terbilang($x - 10) . "Belas";
		elseif ($x < 100)
			return $this->terbilang($x / 10) . " Puluh" . $this->terbilang($x % 10);
		elseif ($x < 200)
			return " Seratus" . $this->terbilang($x - 100);
		elseif ($x < 1000)
			return $this->terbilang($x / 100) . " Ratus" . $this->terbilang($x % 100);
		elseif ($x < 2000)
			return " Seribu" . $this->terbilang($x - 1000);
		elseif ($x < 1000000)
			return $this->terbilang($x / 1000) . " Ribu" . $this->terbilang($x % 1000);
		elseif ($x < 1000000000)
			return $this->terbilang($x / 1000000) . " Juta" . $this->terbilang($x % 1000000);
	}

	function cekidpembeli_ya($id_pembeli, $id_produk)
	{
		$query = $this->db->get_where('tbl_transaksi', array('id_pembeli' => $id_pembeli, 'id_produk' => $id_produk, 'buy' => 'ya'), 1, 0);

		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	///
	function getqtyidpembeli_ya($id_pembeli, $id_produk)
	{
		return $this->db->get_where('tbl_transaksi', array('id_pembeli' => $id_pembeli, 'id_produk' => $id_produk, 'buy' => 'ya'));
	}
	///
	function get_samemail($username)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get_where('tbl_pembeli', array('email' => $username));
	}
	function cek_email_pembelisama($username)
	{

		$query = $this->get_samemail($username);
		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	///28517 harus di rubah jika ngambil harga k

	function get_hargaproduk($id)
	{

		$query = $this->db->get_where('tbl_produk', array('id' => $id));
		if ($query->num_rows() > 0) {
			if (empty($query->row()->hargak) or $query->row()->hargak == 0 or $query->row()->harga < $query->row()->hargak) {
				return $query->row()->harga;
			} else {
				return $query->row()->hargak;
			}
		} else {
			return 0;
		}
	}
	///28517

	function cek_tran_produk_ya($id_pembeli)
	{
		$query = $this->db->get_where('tbl_transaksi', array('id_pembeli' => $id_pembeli, 'buy' => 'ya'));
		if ($query->num_rows() > 0) {

			return TRUE;
		} else {
			return FALSE;
		}
	}

	function cek_tran_voc_bel($id_tgl, $id_user_save = 0)
	{
		$query = $this->db->get_where('tbl_riwayat_voucher', array('id_tgl' => $id_tgl, 'id_user' => $id_user_save));
		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_id_t_tbltransaksi_p($id_pembeli)
	{

		$this->db->where('buy', 'ya');

		$this->db->where('id_user', $id_pembeli);


		$a = $this->db->get('tbl_transaksi');

		if ($a->num_rows() > 0) {
			$t = '';
			foreach ($a->result() as $x) {
				$t = $t . '-' . $x->id;
			}

			return $t;
		} else {
			return 0;
		}
	}

	function newkodepembayaran()
	{
		//SELECT FLOOR(RAND()*99999999999) AS `notagihan` FROM `tbl_tagihan` WHERE `notagihan` NOT IN (SELECT `kodepembayaran` FROM `tbl_tagihan`) LIMIT 1

		return $this->db->query('SELECT FLOOR(RAND()*99999999999) AS `kodepembayaran` FROM `tbl_tagihan` WHERE `notagihan` NOT IN (SELECT `kodepembayaran` FROM `tbl_tagihan`) and `transfer` = 1 LIMIT 1');
	}

	function validnopembayaran()
	{
		$kodepembayaran_ = $this->Mtrans->newkodepembayaran()->row()->kodepembayaran;
		if ($kodepembayaran_ != 0 or strlen($kodepembayaran_) != 11) {
			if (strlen($kodepembayaran_) != 11) {
				//$kodepembayaran = $this->Mtrans->newkodepembayaran()->row()->kodepembayaran;	
				$kodepembayaran = $kodepembayaran_ * 10;
			} else {
				$kodepembayaran = $this->Mtrans->newkodepembayaran()->row()->kodepembayaran;
			}

			return $kodepembayaran . '-' . strlen($kodepembayaran_);
		}
	}

	function savekodepembayaran($d)
	{

		$this->db->insert('tbl_tagihan', $d);
	}

	function cekkodepembayaran($id)
	{
		$this->db->where('kodepembayaran', $id);
		$this->db->where('transfer', 1);

		$query = $this->db->get('tbl_tagihan');
		if ($query->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	function delidtkodepembayaran($id)
	{
		$this->db->where('id_transaksi', $id);
		$this->db->delete('tbl_tagihan');
	}

	function cek_id_t_tbltransaksi_p($id)
	{
		$this->db->where('id_transaksi', $id);
		$query = $this->db->get('tbl_tagihan');
		if ($query->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	function total_belanja_by_pembeli_pesan($id_pembeli, $id_tgl)
	{
		$list = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart_pesan($id_pembeli, $id_tgl);
		$tot = 0;
		if ($list->num_rows() > 0) {
			foreach ($list->result() as $t) {
				$tot = $tot + $t->qty * $t->harga_satuan;
			}
		}

		return ($tot);
	}

	function cekProdukDibeli($id_pembeli)
	{
		$a = $this->lihat_keranjang_by_pembeli_tanpa_cart($id_pembeli);
		$d = [];
		$pk = 1;
		if ($a->num_rows() > 0) {
			foreach ($a->result() as $key) {
				$barang = $this->Muser->get_produk_by_id($key->id_produk);
				$jobPelapak = $this->Muser->get_user_by_id($barang->row()->id_user)->row()->job;
				$hsl = 0;
				if ($jobPelapak == 8) {
					$hsl = 1;
				}
				$pk = $pk * $hsl;
			}
		}

		$d = [
			'p_kopkar' => $pk,
		];

		return $d;
	}
}///class