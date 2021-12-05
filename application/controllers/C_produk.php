<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_produk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan0';
		$this->load->view('pages/layout/top-nav', $data);
	}

	public function produk_dipesan($sort = NULL)
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$g_id = $this->Muser->get_id_pass();
			$data['img'] = $g_id->row()->img;
			$data['nama'] = $g_id->row()->nama;
			$data['alamat'] = $g_id->row()->alamat;
			$data['kontak'] = $g_id->row()->no_kontak;
			$data['username'] = $g_id->row()->username;
			$data['sex'] = $g_id->row()->jenis_kelamin;

			$data['title0'] = 'E-Retail';
			$data['title1'] = 'E-Retail';
			///
			$data['a'] = $data['c'] = '';
			$data['f'] = $data['h'] = $data['g'] = '';
			$data['b'] = $data['d'] = $data['j'] = $data['k'] = '';
			$data['i'] = '';
			$data['n'] = 'active';
			$data['sort'] = $sort;
			///
			//$data['view']='pages/master_admin/produk/dipesan_all_tunai';
			$data['view'] = 'pages/master_admin/produk_dipesan_all';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}
}
