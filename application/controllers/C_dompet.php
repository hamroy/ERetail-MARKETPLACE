<?php

defined('BASEPATH') or exit('No direct script access allowed');



class C_dompet extends CI_Controller
{

	function __construct()

	{

		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('Pdf');
		$this->load->model('M_vparsel');
		$this->load->model('M_dompetall');
		$this->load->model('M_adminvoc');
		$this->load->model('M_gvocall');
		$this->load->model('M_dompetKu');
	}

	public function index()
	{

		redirect('C_dompetKu');
	}

	public function dompet()

	{
		$gs = $this->session->userdata();
		if ($gs['status_job'] < 4) {
			redirect('C_dompet/dompetumy'); //berhak akses dompet
		} elseif ($gs['status_job'] == 3 or $gs['status_job'] == 1001) {
			redirect('User_admin');
		} else {

			//redirect('User_admin');
			redirect('C_dompet/dompetumy'); //berhak akses dompet
		}
	}

	///rev tanggal 130717 DOMPET E-Retail	

	public function dompetumy()

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





			///

			$data['a'] = '';

			$data['c'] = $data['d'] = '';

			$data['b'] = '';

			$data['l'] = 'active';
			$data['l1'] = 'active';

			///

			///rev 61017

			if ($job == 3) {
				redirect('C_mahasiswa/dompet_mhs');
			}



			if (empty($job) or empty($ni) or !is_numeric($ni)) {

				$data['view'] = 'pages/admin/viewer/dompet/form_job';
			} else {

				$data['view'] = 'pages/admin/viewer/dompet';
			}







			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	///rev tanggal 130717 DOMPET E-Retail	

	public function riwayat_vcer()

	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {
			$data = $this->Muser->getDataProfil(); ///get masing masing id user
			$data['l'] = 'active';
			///
			$dvo = '';
			if (isset($_GET['pil'])) {
				$dvo = $_GET['pil'];
			}
			$statusP = '';
			if (isset($_GET['job'])) {
				$statusP = $_GET['job'];
			}
			$statprodi = '';
			if (isset($_GET['prodi'])) {
				$statprodi = $_GET['prodi'];
			}

			//

			$data['dvo'] = $dvo;
			$data['statusP'] = $statusP;
			$data['statprodi'] = $statprodi;
			//
			///

			$data['view'] = 'pages/master_admin/dompet/daftariwayat_dompet';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}



	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar verifikasi pemesan voucher

	public function dafatar_pemesan_voucher($id_job = 1)

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

			$data['view'] = 'pages/master_admin/daftar_pes_voucher';
			$data['isi'] = 'pages/master_admin/dompet/pesan_noedisi';
			$data['gt_stjob'] = $gt_stjob = $this->M_voucher->get_stjob();

			///
			$data['id_job'] = $id_job;

			$data['id_voc_s'] = $id_voc_s = $this->M_voucher->get_max_id_voc();  //makan
			$data['id_voc_par'] = $id_voc_par = $this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
			$data['id_voc_song'] = $id_voc_song = $this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi RMD DAN THR
			$data['id_voc_mhs'] = $id_voc_mhs = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS
			//
			$data['idjov'] = $idjov = 4; ///j_voucher
			$data['id_vocall'] = $id_vocall = $this->M_vparsel->get_max_id_vocall($idjov); ///menuju edisi voucher all

			//

			$data['m'] = 'active';

			$data['f'] = '';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///
			$data['notvar'] = ['', '', '', ''];
			$arvoc = ['', '', '', '', ''];
			///makan reguler
			$all_newvoucer2 = $this->M_voucher->get_Pesan_voucher_noed($id_job, $id_voc_s);     //makan
			$all_newvoucer213 = $this->M_vparsel->get_pemesan_voc_makan_all($id_voc_s);     //all makan
			$data['notvar'][0] = $all_newvoucer213->num_rows();
			//ramadhan dan THR         
			$all_newvoucer21 = $this->M_vparsel->get_Pesan_voucher_songsong($id_job, $id_voc_song);    //songsog
			$all_newvoucer211 = $this->M_vparsel->get_pemesan_voc_song_all($id_voc_song);    // all songsog
			$data['notvar'][1] = $all_newvoucer211->num_rows();
			//parsel
			$all_newvoucer22 = $this->M_vparsel->get_Pesan_voucher_parsel($id_job, $id_voc_par);     //parsel

			$all_newvoucer222 = $this->M_vparsel->get_pemesan_voc_parsel_all($id_voc_par);     //all parsel
			$data['notvar'][2] = $all_newvoucer222->num_rows();
			///mahasiswa
			$all_newmhs_job = $this->M_vparsel->get_Pesan_voucher_mhs(3, $id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA
			$data['notvar'][3] = $all_newmhs_job->num_rows();
			///GAJI 13
			$all_newvoucer23 = $this->M_dompetall->get_Pesan_voucher_all($id_job, $id_vocall, $idjov, 0);     //GAJI13
			$all_newvoucer233 = $this->M_dompetall->get_pemesan_vocall_peredisi($id_vocall, $idjov);    // all songsog
			$data['notvar'][4] = $all_newvoucer233->num_rows();

			$dvo = 1;
			if (isset($_GET['vo'])) {
				$dvo = $_GET['vo'];
			}
			$data['dvo'] = $dvo;
			switch ($dvo) {
				case 1: //makan
					$data['all_newvoucer2'] = $all_newvoucer2;
					$data['actform'] = 'C_dompet_2/acc_pesan_voc/';
					$data['actform2'] = 'C_dompet/terima_pesan_voc/';
					$data['jvoc'] = 0;
					break;
				case 2: ///ramadhan
					$data['all_newvoucer2'] = $all_newvoucer21;
					$data['actform2'] = $data['actform'] = 'C_ramadhan/acc_pesan_voc_song/';
					$data['jvoc'] = 2;
					break;
				case 3: ///parsel
					$data['all_newvoucer2'] = $all_newvoucer22;
					$data['actform2'] = $data['actform'] = 'C_ramadhan/acc_pesan_voc_parsel/';
					$data['jvoc'] = 2;
					break;
				case 4: //mahasiswa
					$data['isi'] = 'pages/master_admin/dompet/pesan_noedisi_mhs';
					$data['jvoc'] = 3;

					$data['all_newvoucer2'] = $all_newmhs_job;
					$data['actform'] = $data['actform2'] = 'C_ramadhan/acc_pesan_voc_mhs/';
					break;
				case 5: //GAJI13
					$data['all_newvoucer2'] = $all_newvoucer23;
					$data['jvoc'] = 4;
					$data['isi'] = 'pages/master_admin/dompet/voucher_all/pesan_noedisi_all';
					$data['actform'] = $data['actform2'] = 'C_dompetvoc/acc_pesan_voc_all/';
					break;
				default:
					$data['all_newvoucer2'] = $all_newvoucer2;
					$data['jvoc'] = 0;
					$data['actform'] = 'C_dompet_2/acc_pesan_voc/';
					$data['actform2'] = 'C_dompet/terima_pesan_voc/';
					break;
			}



			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	//////////////////Dompet

	function pesan_voucher($id)
	{

		if ($this->session->userdata('id_user') == $id and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///waktu

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));



			$d = array(

				'nik' => $this->input->post('nik'),

				'id_user' => $id,

				'unit' => $this->input->post('unit'),

				'tanggal' => $tanggal,

				'waktu' => $waktu,

				'proses' => 0,

			);



			///////////NOTIVIKASI EMAIL



			$Emailto = $this->Muser->get_user_by_id($id)->row()->username;

			$pass = $this->Muser->get_user_by_id($id)->row()->password;



			$isinot = '

		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>

		Terima kasih.

		';

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



			$ci->email->to($Emailto); ///ke email pembeli

			$ci->email->bcc('admin@E-Retail.com');

			$ci->email->subject('[E-Retail SUPERMALL]');

			$ci->email->message($isinot);

			//$ci->email->attach(base_url('pdf/test.pdf'));

			$this->email->send();



			///

			//$this->Madmin_master->block_penjual_model($id,$d);

			//bila belum buat kalau udah di update



			$gt_tblpesanvoucher = $this->Login_model->check_daftar_pesan_voucher($id);

			if ($gt_tblpesanvoucher == TRUE) {

				$this->Madmin_master->updatepesanvoucher($d, $id);
			} else {

				$this->Madmin_master->pesan_v($d);
			}







			$this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu.');

			redirect('C_dompet/');
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	//////////////////Dompet job

	function pesan_voucher_job($id)
	{



		///waktu

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$d = array(

			'job' => $this->input->post('job'),

			'ni' => $this->input->post('ni'),

		);







		///

		$this->Madmin_master->block_penjual_model($id, $d);

		//bila belum buat kalau udah di update











		$this->session->set_flashdata('pesan', 'data berhasil Dikirim.');

		redirect('C_dompet/');
	}



	//////////////////Dompet tahap 2 ???pengaman sementara paling ok

	function pesan_voucher_t2($id, $th, $ed = 2)
	{ ///ID,TAHAP,EDISI

		if ($this->session->userdata('id_user') == $id and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///waktu

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));



			$d = array(

				'id_user' => $id,

				'saldo' => '0',

				'status' => '0',

				'tgl_oto' => '',

				'alasan_tolak' => '',

				'tgl_trans' => $tanggal . ' ' . $waktu,

				'tahap' => 0,

				'edisi' => $ed,

			);



			///////////NOTIVIKASI EMAIL



			$Emailto = $this->Muser->get_user_by_id($id)->row()->username;

			$pass = $this->Muser->get_user_by_id($id)->row()->password;



			$isinot = '

		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>

		Terima kasih.

		';

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



			$ci->email->to($Emailto); ///ke email pembeli

			$ci->email->bcc('admin@E-Retail.com');

			$ci->email->subject('[E-Retail SUPERMALL]');

			$ci->email->message($isinot);

			//$ci->email->attach(base_url('pdf/test.pdf'));

			$this->email->send();



			///

			//$this->Madmin_master->block_penjual_model($id,$d);

			//bila belum buat kalau udah di update

			///cek di tbl_inpuy _voucer



			//$gt_tblpesanvoucher=$this->Login_model->check_daftar_input_voucher($id,$th);



			//FALID EDISI

			$gt_tblpesanvoucher = $this->Login_model->check_daftar_input_voucher_edisi($id, $ed);



			//$this->Madmin_master->updatepesanvoucher_t2_th($d,$id,$th);        



			if ($gt_tblpesanvoucher == FALSE) {

				$this->Madmin_master->pesan_v_t2($d);



				$this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu.');
			} else {

				$this->session->set_flashdata('pesan0', 'data gagal Dikirim. Mohon Untuk Hubungi Admin E-Retail.');
			}





			redirect('C_dompet/tcses');
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function tcses($trans = NULL)
	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

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

			$data['file_nbm'] = $g_id->row()->file_nbm;

			$data['ranting'] = $g_id->row()->ranting;

			$data['cabang'] = $g_id->row()->cabang;

			$data['daerah'] = $g_id->row()->daerah;

			$data['title0'] = 'E-Retail';

			$data['title1'] = 'E-Retail';





			if ($trans == 'trans') {

				$data['link'] = base_url('User_admin/barang_dipesan');
			} elseif ($trans == 'parsel') {

				$data['link'] = base_url('C_dompetp/dompet');
			} elseif ($trans == 'mhs') {

				$data['link'] = base_url('C_mahasiswa/dompet_mhs');
			} elseif ($trans == 'song' or $trans == 2) {

				$data['link'] = base_url('C_dompetsong');
			} elseif ($trans == '4') {

				$data['link'] = base_url('C_dompetvoc');
			} else {

				$data['link'] = base_url('C_dompet/dompetumy');
			}





			$data['view'] = 'pages/admin/viewer/dompet/sespesan';

			///

			$data['a'] = '';

			$data['b'] = '';

			$data['g'] = $data['h'] = $data['f'] = $data['i'] = '';

			$data['c'] = $data['d'] = $data['k'] = '';

			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	//////////////////Dompet tahap 3 BONUS

	function pesan_voucher_t2_bonus($id, $th, $ed = 2)
	{ ///ID,TAHAP,EDISI

		if ($this->session->userdata('id_user') == $id and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			//redirect ('C_dompet/');

			$this->pesan_voucher_t2_bonus_blmrilis($id, $th, $ed = 2);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function pesan_voucher_t2_bonus_blmrilis($id, $th, $ed = 2)
	{ ///ID,TAHAP,EDISI



		///waktu

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		$d = array(

			'id_user' => $id,

			'saldo' => '0',

			'status' => '0',

			'tgl_oto' => '',

			'alasan_tolak' => '',

			'tgl_trans' => $tanggal . ' ' . $waktu,

			'tahap' => 0,

			'edisi' => $ed,

			'bonus' => 1,

		);



		///////////NOTIVIKASI EMAIL



		$Emailto = $this->Muser->get_user_by_id($id)->row()->username;

		$pass = $this->Muser->get_user_by_id($id)->row()->password;



		$isinot = '

		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>

		Terima kasih.

		';

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



		$ci->email->to($Emailto); ///ke email pembeli

		$ci->email->bcc('admin@E-Retail.com');

		$ci->email->subject('[E-Retail SUPERMALL]');

		$ci->email->message($isinot);

		//$ci->email->attach(base_url('pdf/test.pdf'));

		$this->email->send();



		///

		//$this->Madmin_master->block_penjual_model($id,$d);

		//bila belum buat kalau udah di update

		///cek di tbl_inpuy _voucer



		$gt_tblpesanvoucher = $this->Login_model->check_daftar_input_voucher($id, $th);





		$this->Madmin_master->pesan_v_t2($d);

		//$this->Madmin_master->updatepesanvoucher_t2_th($d,$id,$th);

		$this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu.');

		redirect('C_dompet/');
	}



	//////////////////TERIMA VOUCHER PERTAMA

	function terima_pesan_voc($t, $id_user, $id, $id_job = 1)
	{

		///waktu

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));
		$id_voc_s = $this->M_voucher->get_max_id_voc();
		$pp = 99;

		$ter = 99;

		$alasan = $this->input->post('alasan');

		$isinot = '

            		Mohon Maaf, <br/>

            		anda tidak diterima untuk memesan Voucher.<br/>

            		Karena : ' . $this->input->post('alasan') . '

            		';

		$d = array(

			'proses' => $pp,

			'tahap' => $pp,

			'tanggal_acc' => $tanggal . ' ' . $waktu,

			'pesan_voucer' => $ter,

			'alasan_tolak' => $alasan,

		);

		//update metode pembayaran
		$rwytvocer = array(
			'id_user' => $id_user,
			'kode' => 5, ///tolak voucher
			'kontek' => 'Voucher REGULER Ditolak ===  ',
			'tgl_trans' => $tanggal . ' ' . $waktu,
			'id_voc_p' => $id_voc_s,
			'j_voucher' => 0, ///makan
			///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
			//untuk keperuan nota treansaksi
		);

		$this->Madmin_master->simpan_perubahan_tbl_voucher($d, $id);
		$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat

		///////////NOTIVIKASI EMAIL

		$Emailto = $this->Muser->get_user_by_id($id_user)->row()->username;



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



		$ci->email->to($Emailto); ///ke email pembeli

		$ci->email->bcc('admin@E-Retail.com');

		$ci->email->subject('Notifikasi- [E-Retail SUPERMALL]');

		$ci->email->message($isinot);

		//$ci->email->attach(base_url('pdf/test.pdf'));

		$this->email->send();



		///

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('C_dompet/dafatar_pemesan_voucher/' . $id_job);
	}


	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar daftar_peserta


	////preses reedim ke bmt ///rev 51117

	function redeem_voucher($id, $jnvoc = 0)
	{

		$id = $this->session->userdata('id_user');

		///waktu

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$hariini = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));



		//////rev Ilham 190717

		////////////////REVISI 201717

		$getvoucher = $this->Mtrans->get_voucher_tbluser_vocer($id);	 //tblambil voucher di tbl user

		$getdompet = $getvoucher->row()->dompet;

		$getdompet_awal = $getvoucher->row()->dompet_dicairkan;

		////////////////REVISI 15417

		///PErpindahan VOUCHER

		$this->form_validation->set_rules('redeem', 'redeem', 'required');

		$this->form_validation->set_rules('d3', 'd3', 'required');

		$transit = $this->input->post('redeem');

		///20180501
		if ($transit == NULL or $transit == 0) {
			$this->session->set_flashdata('pesan0', 'data Gagal Dikirim.');
			redirect('C_dompet/#null');
		}

		$kontvov = '';
		$transit_par = $transit;
		if ($jnvoc == 1) {
			$kontvov = "PARSEL";
			$transit = 0;
			$getdompet = 0;
		}
		if ($jnvoc == 2) {
			$kontvov = "RAMADHAN & THR";
			$transit = 0;
			$getdompet = 0;
		}
		if ($jnvoc == 3) {
			$kontvov = "MAHASISWA";
			$transit = 0;
			$getdompet = 0;
		}


		$vocer = array(

			'dompet' => $getdompet - $transit,

			'dompet_dicairkan' => $getdompet_awal + $transit,

		);



		//riwayat



		//update metode pembayaran


		$rwytvocer = array(

			'id_user' => $id,

			'kontek' => 'Redeem [' . $kontvov . ']' . $transit_par,

			'dompet_dicairkan' => $transit,

			'dompet' => $getdompet - $transit,

			'tgl_trans' => $hariini . ' ' . $waktu,

			///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.

			//untuk keperuan nota treansaksi

		);



		///

		if ($getdompet >= $transit) {



			//$tcdef=1;	



			if ($this->form_validation->run() == TRUE) {

				$this->tgl_kebmt($id, $transit_par, $jnvoc);

				if ($jnvoc == 0) {
					$this->Mtrans->simpan_update_tbluser($id, $vocer); //update infor    
				}


				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat	

				$this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu. <br/>

        Silahkan Cetak sebagai bukti.

        ');

				$this->kirim_email_redeem_akun($id);

				redirect('C_dompet/cetakan_beranda/');
			}
		} else {

			$this->session->set_flashdata('pesan0', 'data Gagal Dikirim. Mohon Periksa kembali.');

			redirect('C_dompetp/#error');
		}
	}



	public function cetakan_beranda()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user

			$data['img'] = $g_id->row()->img;

			$data['nama'] = $g_id->row()->nama;

			$data['alamat'] = $g_id->row()->alamat;

			$data['kontak'] = $g_id->row()->no_kontak;

			$data['username'] = $g_id->row()->username;

			$data['rek'] = $g_id->row()->rek;

			//$data['nbm']=$g_id->row()->nbm;

			$data['bank'] = $g_id->row()->bank;

			$data['sex'] = $g_id->row()->jenis_kelamin;

			$data['id_user'] = $g_id->row()->idlog;

			///

			$g_id2 = $this->Muser->get_id_user_tblpesanvoc($g_id->row()->idlog); ///get masing masing id user

			if ($g_id2->num_rows() > 0) {

				$data['nbm'] = $g_id2->row()->nik;

				$data['unit'] = $g_id2->row()->unit;
			} else {

				$data['nbm'] = $g_id->row()->nbm;

				$data['unit'] = '';
			}

			///

			$data['voucher_umy'] = $g_id->row()->voucher_umy;

			$data['dompet'] = $g_id->row()->dompet;

			$data['voucher_dibelanjakan'] = $g_id->row()->voucher_dibelanjakan;

			$data['dompet_dicairkan'] = $g_id->row()->dompet_dicairkan;

			//================================================================

			$data['title0'] = 'E-Retail';

			$data['title1'] = 'E-Retail';

			///



			///

			$data['id_user'] = $g_id->row()->idlog;

			$data['a'] = '';

			$data['c'] = $data['d'] = '';

			$data['b'] = '';

			$data['l'] = 'active';

			///

			$data['view'] = 'pages/admin/viewer/cetak1';



			//$this->load->view('bmt/cetak_html',$data);

			//$this->load->view('pages/admin/cetakhtml_redeem',$data);

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	public function cetak($cetak = 'html', $fase = 1, $id = null)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user

			$data['img'] = $g_id->row()->img;

			$data['nama'] = $g_id->row()->nama;

			$data['alamat'] = $g_id->row()->alamat;

			$data['kontak'] = $g_id->row()->no_kontak;

			$data['username'] = $g_id->row()->username;

			$data['rek'] = $g_id->row()->rek;

			//$data['nbm']=$g_id->row()->nbm;

			$data['bank'] = $g_id->row()->bank;

			$data['sex'] = $g_id->row()->jenis_kelamin;

			$data['id_user'] = $g_id->row()->idlog;

			///

			$g_id2 = $this->Muser->get_id_user_tblpesanvoc($g_id->row()->idlog); ///get masing masing id user

			if ($g_id2->num_rows() > 0) {

				$data['nbm'] = $g_id2->row()->nik;

				$data['unit'] = $g_id2->row()->unit;
			} else {

				$data['nbm'] = $g_id->row()->nbm;

				$data['unit'] = '';
			}

			///

			///

			$data['voucher_umy'] = $g_id->row()->voucher_umy;

			$data['dompet'] = $g_id->row()->dompet;

			$data['voucher_dibelanjakan'] = $g_id->row()->voucher_dibelanjakan;

			$data['dompet_dicairkan'] = $g_id->row()->dompet_dicairkan;

			//================================================================

			$data['title0'] = 'E-Retail';

			$data['title1'] = 'E-Retail';

			///

			$data['id'] = $id;

			$data['cetak'] = $cetak;

			$data['a'] = '';

			$data['c'] = $data['d'] = '';

			$data['b'] = '';

			$data['l'] = 'active';

			///

			//$data['view']='bmt/cetak1';

			switch ($cetak) {



				case 'html':

					if ($fase == 2) {

						$this->load->view('pages/admin/cetak/cetakhtml_redeem_riwayat', $data);
					} else {

						$this->load->view('pages/admin/cetak/cetakhtml_redeem', $data);
					}

					break;

				case 'awal':

					$this->load->view('pages/admin/cetak/cetakhtml_redeem', $data);

					break;



				case 'pdf':

					//$file_pdf = $this->load->view('cetak/bill_pdf',$data,TRUE); 

					if ($fase == 2) {

						$file_pdf = $this->load->view('pages/admin/cetak/cetakhtml_redeem_riwayat', $data, TRUE);
					} else {

						$file_pdf = $this->load->view('pages/admin/cetak/cetakhtml_redeem', $data, TRUE);
					}



					//$file_pdf = $this->load->view('cetak/bill_pdf2',$data,TRUE); 



					//  $this->pdf->pdf_create_portrait_down($file_pdf,'daftar Aparat Desa');

					//  $this->pdf->pdf_create_landscape($file_pdf,'bill-hotel');

					$this->pdf->pdf_create_portrait_down($file_pdf, 'BUKTI-REDEEM');



					break;
			}



			//$this->load->view('pages/admin/beranda',$data);

		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	///setting voucher per iduser



	public function sett_voc($idlog)

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

			$data['id_user'] = $idlog;

			//$data['view']='pages/master_admin/daftar_produk_penjual';

			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///

			//================================================================

			$data['title0'] = 'E-Retail';

			$data['title1'] = 'E-Retail';

			//
			$cek = $this->Madmin_master->get_onoffvoc($idlog);

			if ($cek->num_rows() == 0) {

				$d = array(
					'id_user' => $idlog,
					'vc1' => 1,
					'vmhs' => 1,
					'vsong2' => 1,
					'vparsel' => 1,
					'v_gaji13' => 1,
				);

				$this->Madmin_master->simpan_save_onoffvoc($d);
			} else {
			}



			$data['view'] = 'pages/master_admin/dompet/set_voc';



			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}







	function simpan_Set_voc($id, $vc, $aktif)
	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			///waktu

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));







			switch ($vc) {

				case '1':

					$d = array(

						'id_user' => $id,

						'vc1' => $aktif, //voucer 1

						// 'vc2'=>$vcd2, //voucer 2

						// 'vc3'=>$vcd3, //voucer 3

						'tgl' => $tanggal . ' ' . $waktu,



					);

					break;

				case '2':





					$th = $this->Login_model->get_daftar_input_voucher_st_all();

					$edi = '';

					for ($x = 2; $x <= $th; $x++) {

						if ($x == $this->input->post('ed_' . $x)) {

							$edi = $edi . '-' . $this->input->post('ed_' . $x);
						} else {

							$edi = $edi . '-0';
						}
					}





					$d = array(

						'id_user' => $id,

						// 'vc1'=>1, //voucer 1

						//'vc2'=>$this->input->post('ed_2'), //voucer 2

						'vc2' => $edi, //voucer 2

						// 'vc3'=>$vcd3, //voucer 3

						'tgl' => $tanggal . ' ' . $waktu,



					);

					break;

				case '3':

					$d = array(

						'id_user' => $id,

						// 'vc1'=>1, //voucer 1

						// 'vc2'=>1, //voucer 2

						'vc3' => $aktif, //voucer 3

						'tgl' => $tanggal . ' ' . $waktu,



					);

					break;
			}





			$cek = $this->Madmin_master->get_onoffvoc($id);

			if ($cek->num_rows() > 0) {

				$this->Madmin_master->simpan_up_onoffvoc($id, $d);
			} else {

				$this->Madmin_master->simpan_save_onoffvoc($d);
			}







			$this->session->set_flashdata('pesan', 'berhasil. ');

			redirect('C_dompet/sett_voc/' . $id);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	/////sett_voc_all

	public function sett_voc_all()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$data = $this->Muser->getDataProfil();
			$data['v'] = 'active';
			///

			//================================================================

			$data['view'] = 'pages/master_admin/dompet/set_voc_all';
			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function simpan_Set_voc_all($vc)
	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			///waktu

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));







			switch ($vc) {

				case '2':




					if (($this->input->post('reguler') == 1)) {

						$vch1 = '1';
					} else {

						$vch1 = '0';
					}

					if (($this->input->post('parsel') == 1)) {

						$vch1bonus = '1';
					} else {

						$vch1bonus = '0';
					}
					if (($this->input->post('song') == 1)) {

						$vch1song = '1';
					} else {

						$vch1song = '0';
					}
					if (($this->input->post('mhs') == 1)) {

						$vchmhs = '1';
					} else {

						$vchmhs = '0';
					}
					if (($this->input->post('gaji13') == 1)) {

						$vcgj = '1';
					} else {

						$vcgj = '0';
					}



					$d = array(

						'vc1' => $vch1, //voucer 1

						'vc2' => '', //voucer 2 ///ga di pake

						'vc3' => $vch1song, //voucer 3 song
						'vc4' => $vch1bonus, //voucer 4 parsel
						'vc5' => $vchmhs, //voucer 5 MHSISWA
						'vc6' => $vcgj, //voucer 6 GAJI 13

						'tgl' => $tanggal . ' ' . $waktu,



					);

					break;
			}





			$this->Madmin_master->simpan_save_onoffvoc_all($d);







			$this->session->set_flashdata('pesan', 'berhasil. ');

			redirect('C_dompet/sett_voc_all/');
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function revedtah($id, $vc, $therr)
	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			///waktu

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));



			$d = array(

				'tahap' => $vc, //tahap

			);

			$this->Madmin_master->simpan_save_udrevtah($d, $id, $vc, $therr);





			$this->session->set_flashdata('pesan', 'berhasil. ');

			redirect('C_dompet/riwayat_edisi_voc/#collapseOne' . $id);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PENJUAL

	public function riwayat_edisi_voc()

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

			$data['view'] = 'pages/master_admin/dompet/riwayat_edisia';

			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	public function ndd_edisi_siadmin()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$gt_tblinputpesanvoucher_select_tahap = $this->Login_model->get_daftar_input_voucher_st_all();

			$th = $gt_tblinputpesanvoucher_select_tahap;

			$this->M_voucher->add_edisi_set_voc($th);

			redirect('C_dompet/sett_voc_all');
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	public function cetakan_beranda_riwayat($j_voc = 0)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$data = $this->Muser->getDataProfil(); ///get masing masing id user
			///

			$g_id2 = $this->Muser->get_id_user_tblpesanvoc($data['id_user']); ///get masing masing id user

			$data['l'] = 'active';

			if ($j_voc == 0) {
				$data['l1'] = 'active';
			} else {
				$data['l2'] = 'active';
			}

			$data['j_voc'] = $j_voc;

			///

			$data['view'] = 'pages/admin/viewer/dompet/daftar_riwayat_redeem';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function kirim_email_redeem_akun($id)
	{

		//////rev Ilham 190717



		///////////NOTIVIKASI EMAIL

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user' and $this->session->userdata('id_user') == $id) {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user

			$data['nama'] = $g_id->row()->nama;

			$g_id2 = $this->Muser->get_id_user_tblpesanvoc($g_id->row()->idlog); ///get masing masing id user

			if ($g_id2->num_rows() > 0) {

				$data['nbm'] = $g_id2->row()->nik;

				$data['unit'] = $g_id2->row()->unit;
			} else {

				$data['nbm'] = $g_id->row()->nbm;

				$data['unit'] = '';
			}

			///

			///

			//================================================================

			$data['title1'] = 'E-Retail';

			$data['cetak'] = 'pdf';

			///



			$Emailto = $this->Muser->get_user_by_id($id)->row()->username;

			$pass = $this->Muser->get_user_by_id($id)->row()->password;



			$isinot = '

		Anda berhasil meredem.<br/>

		Terima kasih.

		';



			/////////////////////////////////////////////    



			$pdfroot  = dirname(dirname(__FILE__));

			$pdfroot .= '/third_party/pdf/redeem/bukti_redeem.pdf';







			$dompdf = new Dompdf\Dompdf();



			$html = $this->load->view('pages/admin/cetak/cetakhtml_redeem_email', $data, TRUE);



			$dompdf->loadHtml($html);



			// (Optional) Setup the paper size and orientation

			$dompdf->setPaper('A4', 'landscape');



			// Render the HTML as PDF

			$dompdf->render();



			// Get the generated PDF file contents

			$pdf = $dompdf->output();



			// Output the generated PDF to Browser

			//$dompdf->stream();



			//$pdf_string =   $dompdf->output();

			file_put_contents($pdfroot, $pdf);

			///============================================================================PEMBEDA

			//*/

			////// REV 1417





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



			$ci->email->to($Emailto); ///ke email pembeli

			$ci->email->bcc('admin@E-Retail.com');

			$ci->email->subject('BUKTI REDEEM - [E-Retail SUPERMALL]');

			$ci->email->message($isinot);

			$attched_file = $_SERVER["DOCUMENT_ROOT"] . "/application/third_party/pdf/redeem/bukti_redeem.pdf";



			//$ci->email->attach($pdfroot);      	

			$ci->email->attach($attched_file);



			$ci->email->send();

			redirect('C_dompet/cetakan_beranda/');



			/*if($this->email->send()){

           

           

        }else{

        $this->session->set_flashdata('pesan','Email gagal terkirim dan data berhasil Dikirim . Mohon Dituggu. <br/>

        Silahkan Cetak sebagai bukti.

        ');

		//redirect ('C_dompet/cetakan_beranda/');

        } //*/
		} else {

			echo 'error cooy';
		}
	}



	function simpan_Set_voc_nodsi($id, $vc, $aktif)
	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			///waktu

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));







			switch ($vc) {

				case '1':
					$d = array(
						'id_user' => $id,
						'vc1' => $aktif, //voucer 1
						'tgl' => $tanggal . ' ' . $waktu,
					);
					break;
				case '2':
					$d = array(
						'id_user' => $id,
						'vsong2' => $aktif, //voucer 1
						'tgl' => $tanggal . ' ' . $waktu,
					);
					break;
				case '3':
					$d = array(
						'id_user' => $id,
						'vparsel' => $aktif, //voucer 1
						'tgl' => $tanggal . ' ' . $waktu,
					);
					break;
				case '4':
					$d = array(
						'id_user' => $id,
						'vmhs' => $aktif, //voucer 1
						'tgl' => $tanggal . ' ' . $waktu,
					);
					break;
				case '5':
					$d = array(
						'id_user' => $id,
						'v_gaji13' => $aktif, //voucer 1
						'tgl' => $tanggal . ' ' . $waktu,
					);
					break;
				default:

					$this->session->set_flashdata('pesan', 'GAGAL. ');

					redirect('C_dompet/sett_voc/' . $id);

					break;
			}





			$cek = $this->Madmin_master->get_onoffvoc($id);

			if ($cek->num_rows() > 0) {

				$this->Madmin_master->simpan_up_onoffvoc($id, $d);
			} else {

				$this->Madmin_master->simpan_save_onoffvoc($d);
			}







			$this->session->set_flashdata('pesan', 'berhasil. ');

			redirect('C_dompet/sett_voc/' . $id);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function tgl_kebmt($id, $transit, $jnvoc = 0)
	{

		if ($this->form_validation->run() == TRUE) {



			$tanggal = $this->M_time->tglnow_slas();

			$tanggal_waknow = $this->M_time->harinow();

			//$tanggal= '26-01-2018'; 

			$pectgl = explode('/', $tanggal);



			$cektgl = $this->M_time->get_tbl_ttgl($pectgl[0]);

			$ttgl = $cektgl->row()->t_tgl;

			$b_bln = date('m', strtotime('+1 months', strtotime($tanggal_waknow)));

			$t_thn = $pectgl[2];



			if ($pectgl[1] == 12 and $pectgl[0] > 10) {

				$b_bln = '01';

				$t_thn = $pectgl[2] + 1;
			}



			if ($pectgl[0] < 11) {



				$b_bln = $pectgl[1];

				$t_thn = $pectgl[2];
			} //*/

			///20180501

			///20180501



			$redem = array(

				'id_user' => $id,

				'j_voucher' => $jnvoc, //1=voucher parsel
				'redeem' => $transit,

				'tgl_trans' => $tanggal_waknow,

				/////

				'tgl_kebmt' => $ttgl . '-' . $b_bln . '-' . $t_thn,



				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.

				//untuk keperuan nota treansaksi

			);



			///////////////////2%

			$pec_redem = $transit * 2 / 100;

			$p_redem = $pec_redem;

			$redem_a = $transit - $pec_redem;


			///20180501




			/////////REV sudah di bagi disiis

			$redem_bg = array(

				'id_user' => $id,

				'redeem' => $redem_a,

				'kebmt' => $p_redem,

				'tgl_trans' => $tanggal_waknow,

				'tgl_kebmt' => $ttgl . '-' . $b_bln . '-' . $t_thn,

				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.

				//untuk keperuan nota treansaksi

			);

			/////////REV sudah di bagi disiis

			$this->session->set_userdata($redem_bg); //record

			$this->Mtrans->simpan_tabl_reedemuser($redem); //reedem	



		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}   ///*/

	}
} ///class
