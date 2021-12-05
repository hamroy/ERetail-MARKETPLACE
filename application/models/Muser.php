<?php

class Muser extends CI_Model
{

	var $table = 'ueu_tbl_user';
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_gvocall');
	}


	function get_id_pass()
	{
		$id_user = $this->session->userdata('id_user');
		$this->db->select('*');
		$this->db->from('ueu_tbl_user');
		$this->db->where('idlog', $id_user);
		return $this->db->get();
	}

	function get_id_user_tblpesanvoc($id_user)
	{
		$this->db->select('*');
		$this->db->from('tbl_pesan_voucher');
		$this->db->where('id_user', $id_user);
		return $this->db->get();
	}

	function get_id_pass_nos($id_user)
	{
		//$id_user = $this->session->userdata('id_user');
		$this->db->select('*');
		$this->db->from('ueu_tbl_user');
		$this->db->where('idlog', $id_user);
		return $this->db->get();
	}
	function get_kategori()
	{
		$this->db->select('*');
		$this->db->from('tbl_kategori');
		return $this->db->get();
	}


	function get_kategori_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tbl_kategori');
	}

	function get_id_pass_id($username, $password)
	{
		$this->db->select('*');
		$this->db->from('tbl_pesan_kamar');
		$this->db->where('nama', $username);
		$this->db->where('id', $password);
		return $this->db->get();
	}
	function simpan_tambah_data($d)
	{
		$this->db->insert('tbl_produk', $d);
	}

	function get_produk_by_kat_sblmhswa($id_kat)
	{
		$this->db->where('id_user !=', $this->session->userdata('id_user'));
		$this->db->where('status', 1);
		//$this->db->where('harga !=',0);
		$this->db->where('id_k', $id_kat);
		$this->db->order_by('laris', 'DESC');
		return $this->db->get('tbl_produk');
	}

	function get_produk_by_kat_pag_mhswa($id_kat, $num, $offset)
	{
		$this->db->where('id_user !=', $this->session->userdata('id_user'));
		$this->db->where('status', 1);
		//$this->db->where('harga !=',0);
		$this->db->where('id_k', $id_kat);
		$this->db->order_by('laris', 'DESC');
		return $this->db->get('tbl_produk', $num, $offset);
	}
	////20180421
	function get_produk_by_kat($id_kat, $jsta = FALSE)
	{

		$this->db->from('ueu_tbl_user, tbl_produk');
		$id_user = $this->session->userdata('id_user');
		$this->db->where('ueu_tbl_user.idlog = tbl_produk.id_user');
		$this->db->where('ueu_tbl_user.idlog !=', $id_user);

		if ($jsta != FALSE) {
			$this->db->where('ueu_tbl_user.job', $jsta);
		}
		///*/


		$this->db->where('tbl_produk.status', 1);
		$this->db->where('tbl_produk.id_k', $id_kat);
		$this->db->order_by('tbl_produk.laris', 'DESC');
		return $this->db->get();
	}


	function get_produk_by_kat_pag($id_kat, $num, $offset, $jsta = FALSE)
	{
		$id_user = $this->session->userdata('id_user');
		$this->db->where('ueu_tbl_user.idlog = tbl_produk.id_user');
		$this->db->where('ueu_tbl_user.idlog !=', $id_user);
		if ($jsta != FALSE) {
			$this->db->where('ueu_tbl_user.job', $jsta);
		}
		///*/
		$this->db->where('tbl_produk.status', 1);
		$this->db->where('tbl_produk.id_k', $id_kat);
		$this->db->order_by('tbl_produk.laris', 'DESC');
		return $this->db->get('ueu_tbl_user,tbl_produk', $num, $offset);
	}

	function get_produk_by_kat_141017($id_kat)
	{
		$this->db->where('id_user !=', $this->session->userdata('id_user'));
		$this->db->where('status', 1);
		//$this->db->where('harga !=',0);
		$this->db->where('id_k', $id_kat);
		return $this->db->get('tbl_produk');
	}

	/////////REV 27917

	function get_produk_by_kat_id_pe($id_kat, $id)
	{
		//$this->db->where('id_user !=',$this->session->userdata('id_user'));
		$this->db->where('status', 1);
		//$this->db->where('harga !=',0);
		$this->db->where('id_k', $id_kat);
		$this->db->where('id_user', $id);
		return $this->db->get('tbl_produk');
	}
	///ilham9juni

	function get_produk_by_produkcari($cari)
	{

		//$likerows = "(SELECT * FROM tbl_produk WHERE nama LIKE '%$cari%') AS likerows ";
		//$regexrows = "(SELECT * FROM $likerows WHERE nama REGEXP('^.* $cari .*$')) AS regexrows ";
		//$query = "SELECT * FROM $regexrows ";	



		//$query = $this->db->get('people');


		$this->db->where('id_user !=', $this->session->userdata('id_user'));
		//$this->db->like('nama',$cari);
		$this->db->where("nama LIKE '$cari' OR '% " . $cari . " %' OR nama LIKE '% " . $cari . "' OR nama LIKE '" . $cari . " %'");
		//$this->db->where("nama",$cari);
		$this->db->where('harga !=', 0);
		$this->db->where('status', 1);
		$this->db->order_by('nama', 'ASC');
		//return $this->db->query($query);
		return $this->db->get('tbl_produk');
	}

	function get_produk_by_id($id)
	{
		$this->db->from('tbl_produk, tbl_kategori');
		$this->db->where('tbl_produk.id_k = tbl_kategori.id');
		$this->db->where('tbl_produk.id', $id);
		return $this->db->get();
	}

	function kosong_data()
	{
		$this->db->where('id_unit !=', 0);
		$this->db->delete('ueu_tbl_user');
	}

	function save_produk_by_id_view($d)
	{
		//$this->db->where('id_unit !=', 0);
		$this->db->insert('tbl_view_produk', $d);
	}
	function get_produk_by_id_view_rows($id)
	{
		$this->db->where('id_produk', $id);
		$a = $this->db->get('tbl_view_produk');
		return $a->num_rows();
	}
	function update_info($d)
	{
		$this->db->where('id', 1);
		$this->db->update('ueu_tbl_info', $d);
	}
	function simpan_ditproduk_data($d, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_produk', $d);
	}
	function simpan_ditprof_data($d)
	{
		$id = $this->session->userdata('id_user');
		$this->db->where('idlog', $id);
		$this->db->update('ueu_tbl_user', $d);
	}

	function get_user_by_id($id_user)
	{
		$this->db->where('idlog', $id_user);
		return $this->db->get('ueu_tbl_user');
	}

	///get_bsm_by_id

	function get_bsm_by_id($id_user)
	{
		$this->db->where('idlog', $id_user);
		return $this->db->get('tbl_peserta_sbm');
	}

	public function getDataProfil()
	{
		# code...
		$g_id = $this->get_id_pass(); ///get masing masing id user

		$data['k'] = $g_id->row()->password;
		$data['img'] = $g_id->row()->img;
		$data['nama'] = $g_id->row()->nama;
		$data['alamat'] = $g_id->row()->alamat;
		$data['kontak'] = $g_id->row()->no_kontak;
		$data['username'] = $g_id->row()->username;
		$data['rek'] = $g_id->row()->rek;
		$data['nbm'] = $g_id->row()->nbm;
		$data['bank'] = $g_id->row()->bank;
		$data['sex'] = $g_id->row()->jenis_kelamin;
		$data['id_user'] = $g_id->row()->idlog;
		$data['job'] = $g_id->row()->job;
		$data['file_nbm'] = $g_id->row()->file_nbm;
		$data['ni'] = $g_id->row()->ni;
		$data['nik'] = $g_id->row()->nbm;
		$data['ranting'] = $g_id->row()->ranting;
		$data['cabang'] = $g_id->row()->cabang;
		$data['daerah'] = $g_id->row()->daerah;
		$data['kodeprodi'] = $g_id->row()->kode_prodi;
		$data['kode_prodi'] = $g_id->row()->kode_prodi;
		///
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		///
		$data['a'] = '';
		$data['c'] = $data['d'] = '';
		$data['b'] = '';
		return $data;
	}

	public function getDataProfilPublik()
	{
		# code...
		$g_id = $this->get_id_pass(); ///get masing masing id user
		$data['img'] = $g_id->row()->img;
		$data['nama'] = $g_id->row()->nama;
		$data['alamat'] = $g_id->row()->alamat;
		$data['kontak'] = $g_id->row()->no_kontak;
		$data['username'] = $g_id->row()->username;
		$data['rek'] = $g_id->row()->rek;
		$data['nbm'] = $g_id->row()->nbm;
		$data['bank'] = $g_id->row()->bank;
		$data['sex'] = $g_id->row()->jenis_kelamin;
		$data['id_user'] = $g_id->row()->idlog;
		$data['job'] = $g_id->row()->job;
		$data['file_nbm'] = $g_id->row()->file_nbm;
		$data['ni'] = $g_id->row()->ni;
		$data['nik'] = $g_id->row()->nbm;
		$data['ranting'] = $g_id->row()->ranting;
		$data['cabang'] = $g_id->row()->cabang;
		$data['daerah'] = $g_id->row()->daerah;
		$data['kodeprodi'] = $g_id->row()->kode_prodi;
		$data['kode_prodi'] = $g_id->row()->kode_prodi;

		///
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';

		///
		$data['a'] = '';
		$data['c'] = $data['d'] = '';
		$data['b'] = '';

		return $data;
	}

	function getViewProdukIduserIdpro($id_user, $idp)
	{
		return $this->db->get_where('tbl_view_produk', array('id_user' => $id_user, 'id_produk' => $idp));
	}

	function supView_produk($d, $id_user, $idp)
	{
		$a = $this->getViewProdukIduserIdpro($id_user, $idp);
		if ($a->num_rows() == 0) {

			$this->db->insert('tbl_view_produk', $d);
		} else {
			$this->db->where('id_user', $id_user)->where('id_produk', $idp)
				->update('tbl_view_produk', $d);
		}
	}
} //cls