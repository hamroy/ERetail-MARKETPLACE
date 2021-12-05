<?php

defined('BASEPATH') or exit('No direct script access allowed');



class C_dompetsong extends CI_Controller
{

	function __construct()

	{

		parent::__construct();

		$this->load->helper(array('form', 'url'));

		$this->load->library('Pdf');
		$this->load->model('M_vparsel');
		$this->load->model('M_adminvoc');
		$this->load->model('M_dompetKu');
	}





	public function index()

	{
		$gs = $this->session->userdata();
		if ($gs['status_job'] < 4) {
			$this->dompetsong(); //berhak akses dompet
		} elseif ($gs['status_job'] == 3 or $gs['status_job'] == 1001) {
			redirect('User_admin');
		} else {

			//redirect('User_admin');
			$this->dompetsong(); //berhak akses dompet
		}
	}

	public function c_email()
	{
		//////////////notifikasi email 21/3/17
		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://host21.registrar-servers.com";
		$config['smtp_port'] = "465";
		$config['wordwrap'] = TRUE;
		//$config['smtp_user'] = "E-Retail@jualretail.com";
		$config['smtp_user'] = "admin@E-Retail.com";
		//$config['smtp_pass'] = "beduk2017";
		$config['smtp_pass'] = "52TuGw}TZSa7";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		//$list = array('ilhamroyroy@gmail.com');
		$ci->email->from('admin@E-Retail.com', 'E-Retail SUPERMALL');
	}



	///rev tanggal 130717 DOMPET E-Retail	

	public function dompetsong()

	{



		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user

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

			$data['job'] = $job = $g_id->row()->job;

			$data['ni'] = $ni = $g_id->row()->ni;
			$data['kodeprodi'] = $g_id->row()->kode_prodi;

			///

			$data['voucher_umy'] = $g_id->row()->voucher_umy;

			$data['dompet'] = $g_id->row()->dompet;

			$data['voucher_dibelanjakan'] = $g_id->row()->voucher_dibelanjakan;

			$data['dompet_dicairkan'] = $g_id->row()->dompet_dicairkan;

			//================================================================

			$data['title0'] = 'E-Retail';

			$data['title1'] = 'E-Retail';

			///

			if ($job == 3 or $job == 1001) {
				redirect('C_mahasiswa/dompet_mhs');
			}

			///

			$data['a'] = '';

			$data['c'] = $data['d'] = '';

			$data['b'] = '';

			$data['l'] = 'active';
			$data['vsong'] = 'active';

			///

			///rev 61017

			if ($job == 3) {
				redirect('C_mahasiswa/dompet_mhs');
			}

			if (empty($job) or empty($ni) or !is_numeric($ni)) {

				$data['view'] = 'pages/admin/viewer/dompet/form_job';
			} else {

				$data['view'] = 'pages/admin/dompet_song/dompet';
			}







			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	//////////////////Dompet
	function pesan_voucher_p($id)
	{
		if ($this->session->userdata('id_user') == $id and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			///waktu
			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
			$hm = $h * 60;
			$ms = $hm * 60;
			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
			$waktu = gmdate("H:i:s", time() + ($ms));
			$bln = gmdate("n", time() + ($ms)); // 
			$thn = gmdate("Y", time() + ($ms)); // 
			$this->form_validation->set_rules('nik', 'nik', 'required');
			$this->form_validation->set_rules('unit', 'unit', 'required');
			$this->form_validation->set_rules('ya01', 'ya01', 'required');
			$idvoc = $this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi SONGSONG
			if ($this->form_validation->run() == TRUE) {

				$d = array(
					'nik' => $this->input->post('nik'),
					'unit' => $this->input->post('unit'),
					'id_user' => $id,
					'id_voc_song' => $idvoc,
					'bln' => $bln,
					'thn' => $thn,
					'tanggal_p' => $tanggal,
					'waktu' => $waktu,
					'proses' => 0,
				);

				///////////NOTIVIKASI EMAIL

				$Emailto = $this->Muser->get_user_by_id($id)->row()->username;
				$pass = $this->Muser->get_user_by_id($id)->row()->password;

				$isinot = '
        Anda sudah memesan Voucher Ramadhan & THR. <br/>
		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>
		Terima kasih.
		';

				$this->c_email();
				$this->email->to($Emailto); ///ke email pembeli
				$this->email->bcc('admin@E-Retail.com');
				$this->email->subject('PESAN VOUCHER - [E-Retail SUPERMALL]');
				$this->email->message($isinot);
				//$ci->email->attach(base_url('pdf/test.pdf'));

				$gt_tblpesanvoucher = $this->M_vparsel->get_pesan_voc_song_id($id, $idvoc);
				if ($gt_tblpesanvoucher->num_rows() > 0) {

					$this->session->set_flashdata('pesan', 'data Gagal Dikirim. Karena sudah menerima untuk edisi sekarang.');
					redirect('C_dompet/tcses/song');
				} else {
					$this->M_vparsel->insert_pesan_vsong2($d);
					$this->email->send();
				}


				$this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu.');
				redirect('C_dompet/tcses/song');
			} else {

				if ($this->input->post('ya01') == NULL) {
					$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
					redirect('Login');
				} else {
					redirect('C_dompetsong');
				}
			}
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}
} ///class
