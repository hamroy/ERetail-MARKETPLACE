<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_monitor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_monitor');
	}


	public function index()
	{
		redirect('C_monitor/beranda');
	}


	public function beranda($da = NULL)
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
			//$data['view']='pages/monitor/monitor_refrsh';
			//
			///
			$data['f'] = 'active';
			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';
			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';
			///
			$this->load->view('pages/monitor/monitor_refrsh', $data);
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}
	public function transaksi_bug($da = NULL)
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
			//$data['view']='pages/monitor/monitor_refrsh';
			//
			///
			$data['da'] = $da;
			$data['f'] = 'active';
			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';
			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';
			///
			$this->load->view('pages/monitor/monitor_refrsh_bug', $data);
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}
} ///class
