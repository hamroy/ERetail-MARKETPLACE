<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_monitorvoc extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_gprofilakun');
		$this->load->model('M_gvocall');
		$this->load->model('M_dompetall');
	}


	private function index()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan0';
		//$this->load->view('pages/layout/top-nav',$data);
	}

	function akunRinciVoc($jvoc, $id_user)
	{ {

			if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

				///mode baru get profil 20181001

				$data1 = $this->M_gprofilakun->gprofil();
				$data2 = $this->M_gprofilakun->navmenu();

				$data = ($data1 + $data2);

				///
				$data['id_user'] = $id_user;
				$data['f'] = 'active';

				///
				$data['view'] = 'madmin/mvoc/tampawal';
				$this->load->view('pages/admin/beranda', $data);
			} else { ///pengan login

				$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

				redirect('Login');
			}
		}
	}
}
