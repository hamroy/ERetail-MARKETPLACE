<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_kom extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Muser');
		$this->load->model('Mtrans');
		$this->load->model('Madmin_master');
		$this->load->model('Madmin');
		$this->load->model('Mforum');
	}



	public function index()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user
			$data['img'] = $g_id->row()->img;
			$data['nama'] = $g_id->row()->nama;
			$data['alamat'] = $g_id->row()->alamat;
			$data['kontak'] = $g_id->row()->no_kontak;
			$data['username'] = $g_id->row()->username;
			$data['rek'] = $g_id->row()->rek;
			$data['bank'] = $g_id->row()->bank;
			$data['sex'] = $g_id->row()->jenis_kelamin;

			$data['id_user'] = $g_id->row()->idlog;
			//============================================
			$data['title0'] = 'E-Retail';
			$data['title1'] = 'E-Retail';
			$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Kembali';
			$data['view'] = 'forum/awal';
			$data['produk'] = $this->Muser->get_produk_by_id($idp);
			$this->load->view('pages/layout/top-nav', $data);

			//================================================================
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login .');
			redirect('Login');
		}
		//============================================

	}

	public function produk_terlaris()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {
			$g_id = $this->Muser->get_id_pass();
			$data['img'] = $g_id->row()->img;
			$data['nama'] = $g_id->row()->nama;
			$data['alamat'] = $g_id->row()->alamat;
			$data['nbm'] = $g_id->row()->nbm;
			$data['kontak'] = $g_id->row()->no_kontak;
			$data['username'] = $g_id->row()->username;
			$data['password'] = $g_id->row()->password;
			$data['rek'] = $g_id->row()->rek;
			$data['bank'] = $g_id->row()->bank;
			$data['sex'] = $g_id->row()->jenis_kelamin;
			$data['title0'] = 'E-Retail';
			$data['title1'] = 'E-Retail';
			$data['view'] = 'pages/master_admin/info/produk_laris';
			///
			$data['h'] = 'active';
			$data['g'] = $data['f'] = $data['a'] = $data['b'] = $data['i'] = '';
			$data['c'] = $data['d'] = $data['j'] = $data['k'] = '';
			///
			$this->load->view('pages/admin/beranda', $data);
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	public function saran()
	{
		//if($this->session->userdata('login')!=0){
		$g_id = $this->Muser->get_id_pass(); ///get masing masing id user
		$data['img'] = $g_id->row()->img;
		$data['nama'] = $g_id->row()->nama;
		$data['alamat'] = $g_id->row()->alamat;
		$data['kontak'] = $g_id->row()->no_kontak;
		$data['username'] = $g_id->row()->username;
		$data['rek'] = $g_id->row()->rek;
		$data['bank'] = $g_id->row()->bank;
		$data['sex'] = $g_id->row()->jenis_kelamin;

		$data['id_user'] = $g_id->row()->idlog;
		//============================================
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Kembali';
		$data['view'] = 'forum/saran';
		$data['produk'] = $this->Muser->get_produk_by_id($idp);
		$this->load->view('pages/layout/top-nav', $data);


		//============================================

	}

	public function info($tab = 1)
	{
		if ($this->session->userdata('login') != 0) {
			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user
			$data['img'] = $g_id->row()->img;
			$data['nama'] = $g_id->row()->nama;
			$data['alamat'] = $g_id->row()->alamat;
			$data['kontak'] = $g_id->row()->no_kontak;
			$data['username'] = $g_id->row()->username;
			$data['rek'] = $g_id->row()->rek;
			$data['bank'] = $g_id->row()->bank;
			$data['sex'] = $g_id->row()->jenis_kelamin;

			$data['id_user'] = $g_id->row()->idlog;
		}
		//============================================
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Kembali';
		$data['tab'] = $tab;
		$data['bln'] = 0;
		$data['view'] = 'forum/info';
		$data['produk'] = $this->Muser->get_produk_by_id($idp);
		$this->load->view('pages/layout/top-nav', $data);


		//============================================

	}
	public function info_rinci_transaksi($tab = 1, $bln = 0)
	{
		if ($this->session->userdata('login') != 0) {
			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user
			$data['img'] = $g_id->row()->img;
			$data['nama'] = $g_id->row()->nama;
			$data['alamat'] = $g_id->row()->alamat;
			$data['kontak'] = $g_id->row()->no_kontak;
			$data['username'] = $g_id->row()->username;
			$data['rek'] = $g_id->row()->rek;
			$data['bank'] = $g_id->row()->bank;
			$data['sex'] = $g_id->row()->jenis_kelamin;

			$data['id_user'] = $g_id->row()->idlog;
		}
		//============================================
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Kembali';
		$data['tab'] = $tab;
		$data['bln'] = $bln;
		$data['view'] = 'forum/info';
		$this->load->view('pages/layout/top-nav', $data);


		//============================================

	}

	function kirimpesan($id)
	{
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu1 = gmdate("H:i:s", time() + ($ms));
		$waktu = gmdate("H:i", time() + ($ms));
		$d = array(
			'pesan' => $this->input->post('pesan'),
			'tanggal' => $tanggal,
			'waktu' => $waktu,
			'id_user' => $id,
		);
		$this->Mforum->sipankirimpesan($d);
		redirect('C_kom');
	}

	function simpansaran()
	{
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu1 = gmdate("H:i:s", time() + ($ms));
		$waktu = gmdate("H:i", time() + ($ms));
		//============================================
		if ($this->session->userdata('login') == FALSE) {


			if ($this->session->userdata('id_pembeli') == NULL) {
				$id_s = 'kosong';
			} else {
				$id_s = $this->session->userdata('id_pembeli');
			}
		} else {
			$id_s = $this->session->userdata('id_user');
		}
		//============================================ 

		$d = array(
			'saran' => $this->input->post('saran'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'no' => $this->input->post('no'),
			'nama_penjual' => $this->input->post('nama_penjual'),
			'tanggal' => $tanggal,
			'waktu' => $waktu,
			'id_user' => $id_s,
		);
		$this->Mforum->sipankirimsaran($d);
		redirect('C_kom/saran');
	}

	function produk_Statik($id)
	{

		$a = $this->Mtrans->get_produkqty_sumua($id);  ///terjual
		$c = $this->Mtrans->get_produkqty_sumua($id, 'batal_ot');  ///batal dibayar

		$x = $this->Mtrans->get_produkpembeli_sumua($id);  ///jumlah pembeli selesai
		$z = $this->Mtrans->get_produkpembeli_sumua($id, 'batal_ot');  ///jumlah pembeli batal dibayar
		//  $get_viewer_produk=$this->Mtrans->get_viewer_produk($id);  ///viewer

		echo "num_qty : " . $a; //*1
		echo "<br/> num_qty_ bo : " . $c; //*-1
		echo "<br/> num_pembeli : " . $x; //*2
		echo "<br/> num_pembeli bo: " . $z; //*-1

		$b = ($a) + ($c * (-1));
		$y = ($x * 2) + ($z * (-1));

		echo $b1 = $b / 2;
		echo $b2 = $y / 2;
		echo $b3 = ($b1 * 3) + ($b2 * 2);
		echo '<br/>' . $b4 = ($b3 / 5);

		$this->Mtrans->upd_produkqty_sumua($id, $b4);
		$this->session->set_userdata('al', TRUE);
		redirect('Welcome/produk_rinci_akhir/' . $id);
	}
}
