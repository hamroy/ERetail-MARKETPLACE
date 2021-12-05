<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_ramadhan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('Pdf');
		$this->load->model('M_vparsel');
	}


	public function index()
	{
		redirect('C_dompet/dompet');
	}

	function acc_pesan_voc_parsel($t, $id_user, $id, $id_job = 1, $dvo = 1)
	{
		///waktu


		///manambah voucer di tbl User_admin
		$this->form_validation->set_rules('saldo', 'saldo', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($t == 't') {
				$isinot = '
		Voucher Parsel Lebaran Sudah diterima.
		.<br/>
        Sebesar Rp ' . $this->input->post('saldo')
					. '
        <br/>--------------------------------------<br/>
        Terimakasih.
        ';

				$this->trnans_voc_parsel($id_user, $id);
			} else {

				$alasan = $this->input->post('alasan');

				$isinot = '

            		Mohon Maaf, <br/>

            		anda tidak diterima untuk memesan Voucher Parsel Lebaran .<br/>

            		Karena : ' . $this->input->post('alasan') . '

            		';

				$this->tolak_voc_parsel($id_user, $id);
			}

			$this->kirim_email($id_user, $isinot);

			$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');
			redirect('C_dompet/dafatar_pemesan_voucher/' . $id_job . '?vo=' . $dvo);
			//========================================================================
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali.');
			redirect('Login');
		}
	}

	function acc_pesan_voc_mhs($t, $id_user, $id, $id_job = 1, $dvo = 1)
	{
		///waktu
		///manambah voucer di tbl User_admin
		$this->form_validation->set_rules('saldo', 'saldo', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($t == 't') {
				$isinot = '
		Voucher Mahasiswa sudah diterima 
        .<br/>
        Sebesar Rp ' . $this->input->post('saldo')
					. '
        <br/>--------------------------------------<br/>
        Terimakasih.
        ';

				$this->trnans_voc_mahasisawa($id_user, $id);
			} else {

				$alasan = $this->input->post('alasan');

				$isinot = '

            		Mohon Maaf, <br/>

            		anda tidak diterima untuk memesan Voucher Mahasiswa.<br/>

            		Karena : ' . $this->input->post('alasan') . '

            		';

				$this->tolak_voc_mhs($id_user, $id);
			}

			$this->kirim_email($id_user, $isinot);

			$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');
			redirect('C_dompet/dafatar_pemesan_voucher/' . $id_job . '?vo=' . $dvo);
			//========================================================================
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali.');
			redirect('Login');
		}
	}

	function acc_pesan_voc_song($t, $id_user, $id, $id_job = 1, $dvo = 1)
	{
		///waktu


		///manambah voucer di tbl User_admin
		$this->form_validation->set_rules('saldo', 'saldo', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($t == 't') {
				$isinot = '
		Voucher Ramadhan & THR sudah diterima.
		.<br/>
        Sebesar Rp ' . $this->input->post('saldo')
					. '
        <br/>--------------------------------------<br/>
        Terimakasih.
        ';

				$this->trnans_voc_song($id_user, $id);
			} else {

				$alasan = $this->input->post('alasan');

				$isinot = '

            		Mohon Maaf, <br/>

            		anda tidak diterima untuk Voucher Ramadhan & THR .<br/>

            		Karena : ' . $this->input->post('alasan') . '

            		';

				$this->tolak_voc_song($id_user, $id);
			}

			$this->kirim_email($id_user, $isinot);

			$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');
			redirect('C_dompet/dafatar_pemesan_voucher/' . $id_job . '?vo=' . $dvo);
			//========================================================================
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali.');
			redirect('Login');
		}
	}

	function trnans_voc_parsel($id_user, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		if (!empty($this->input->post('saldo')) or $this->input->post('saldo') == 0) {

			$sal_trans = $this->input->post('saldo');

			$id_voc_s = $this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel    //masing

			///PErpindahan VOUCHER
			///20180420

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user,
				///rev 11017
				'kode' => 1, ///pendapatan
				'pendapatan' => $sal_trans, ///pendapatan

				'kontek' => 'Mendapat Voucher PARSEL ==  ' . $sal_trans,
				'tgl_trans' => $tanggal,
				'id_voc_p' => $id_voc_s,
				'j_voucher' => 1, ///parsel
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///PErpindahan VOUCHER


			$pp = 1;

			$d = array(
				'proses' => $pp,
				'tanggal_acc' => $tanggal . ' ' . $waktu,
				'saldo_awal' => $sal_trans,
			);


			//db tbl voucher
			if ($this->session->userdata('login') == TRUE  and $this->session->userdata('wewenang') == 'admin') {

				$this->M_vparsel->simpan_up_voucher_par($d, $id);
				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
			}
			//db tbl voucher

		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali 2.');
			redirect('Login');
		}
	}

	function tolak_voc_parsel($id_user, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		if (!empty($this->input->post('alasan'))) {
			$id_voc_s = $this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel    //masing
			///PErpindahan VOUCHER
			///20180420

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user,
				'kode' => 5, ///tolak voucher
				'kontek' => 'Voucher PARSEL DITOLAK ===  ' . $sal_trans,
				'tgl_trans' => $tanggal,
				'id_voc_p' => $id_voc_s,
				'j_voucher' => 1, ///parsel
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///PErpindahan VOUCHER


			$pp = 99;

			$d = array(
				'proses' => $pp,
				'tanggal_acc' => $tanggal . ' ' . $waktu,
				'saldo_awal' => $sal_trans,
				'alasan_tolak' => $this->input->post('alasan'),
			);


			//db tbl voucher
			if ($this->session->userdata('login') == TRUE  and $this->session->userdata('wewenang') == 'admin') {

				$this->M_vparsel->simpan_up_voucher_par($d, $id);
				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
			}
			//db tbl voucher

		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali 2.');
			redirect('Login');
		}
	}

	function trnans_voc_song($id_user, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		if (!empty($this->input->post('saldo')) or $this->input->post('saldo') == 0) {

			$sal_trans = $this->input->post('saldo');

			$id_voc_s = $this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi parsel    //masing

			///PErpindahan VOUCHER
			///20180420

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user,
				///rev 11017
				'kode' => 1, ///pendapatan
				'pendapatan' => $sal_trans, ///pendapatan

				'kontek' => 'Mendapat Voucher SONGSONG ==  ' . $sal_trans,
				'tgl_trans' => $tanggal,
				'id_voc_p' => $id_voc_s,
				'j_voucher' => 2, ///rmd & THR
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///PErpindahan VOUCHER


			$pp = 1;

			$d = array(
				'proses' => $pp,
				'tanggal_acc' => $tanggal . ' ' . $waktu,
				'saldo_awal' => $sal_trans,
			);


			//db tbl voucher
			if ($this->session->userdata('login') == TRUE  and $this->session->userdata('wewenang') == 'admin') {

				$this->M_vparsel->simpan_up_voucher_song($d, $id);
				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
			}
			//db tbl voucher

		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali 2.');
			redirect('Login');
		}
	}

	function trnans_voc_mahasisawa($id_user, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		if (!empty($this->input->post('saldo')) or $this->input->post('saldo') == 0) {

			$sal_trans = $this->input->post('saldo');

			$id_voc_s = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi parsel    //masing

			///PErpindahan VOUCHER
			///20180420

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user,
				///rev 11017
				'kode' => 1, ///pendapatan
				'pendapatan' => $sal_trans, ///pendapatan

				'kontek' => 'Mendapat Voucher MAHASISWA ==  ' . $sal_trans,
				'tgl_trans' => $tanggal,
				'id_voc_p' => $id_voc_s,
				'j_voucher' => 3, ///mahsiswa
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///PErpindahan VOUCHER


			$pp = 1;

			$d = array(
				'proses' => $pp,
				'tanggal_acc' => $tanggal . ' ' . $waktu,
				'saldo_awal' => $sal_trans,
			);


			//db tbl voucher
			if ($this->session->userdata('login') == TRUE  and $this->session->userdata('wewenang') == 'admin') {

				$this->M_vparsel->simpan_up_voucher_mhs($d, $id);
				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
			}
			//db tbl voucher

		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali 2.');
			redirect('Login');
		}
	}

	function tolak_voc_song($id_user, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		if (!empty($this->input->post('alasan'))) {
			$id_voc_s = $this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi parsel    //masing
			///PErpindahan VOUCHER
			///20180420

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user,
				'kode' => 5, ///tolak voucher
				'kontek' => 'Voucher SONGSONG DITOLAK ===  ' . $sal_trans,
				'tgl_trans' => $tanggal,
				'id_voc_p' => $id_voc_s,
				'j_voucher' => 2, ///RMD & THR
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///PErpindahan VOUCHER


			$pp = 99;

			$d = array(
				'proses' => $pp,
				'tanggal_acc' => $tanggal . ' ' . $waktu,
				'saldo_awal' => $sal_trans,
				'alasan_tolak' => $this->input->post('alasan'),
			);


			//db tbl voucher
			if ($this->session->userdata('login') == TRUE  and $this->session->userdata('wewenang') == 'admin') {

				$this->M_vparsel->simpan_up_voucher_song($d, $id);
				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
			}
			//db tbl voucher

		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali 2.');
			redirect('Login');
		}
	}

	function tolak_voc_mhs($id_user, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		if (!empty($this->input->post('alasan'))) {
			$id_voc_s = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi mhs
			///PErpindahan VOUCHER
			///20180420

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user,
				'kode' => 5, ///tolak voucher
				'kontek' => 'Voucher MAHASISWA DITOLAK ===  ' . $sal_trans,
				'tgl_trans' => $tanggal,
				'id_voc_p' => $id_voc_s,
				'j_voucher' => 3, ///mahsiswa
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///PErpindahan VOUCHER


			$pp = 99;

			$d = array(
				'proses' => $pp,
				'tanggal_acc' => $tanggal . ' ' . $waktu,
				'saldo_awal' => $sal_trans,
				'alasan_tolak' => $this->input->post('alasan'),
			);


			//db tbl voucher
			if ($this->session->userdata('login') == TRUE  and $this->session->userdata('wewenang') == 'admin') {

				$this->M_vparsel->simpan_up_voucher_mhs($d, $id);
				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
			}
			//db tbl voucher

		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali 2.');
			redirect('Login');
		}
	}

	function kirim_email($id_user, $isinot)
	{
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
	}

	function add_edisi_voucher()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {
			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
			$hm = $h * 60;
			$ms = $hm * 60;
			$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
			$bln = gmdate("n", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
			$thn = gmdate("Y", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
			$id_voc_s = $this->M_voucher->get_max_id_voc();
			$d = array(
				'id_voc' => $id_voc_s + 1,
			);
			$this->M_voucher->add_edisi_bln_now($d);
			$this->session->set_flashdata('pesan', 'Sukses.');
			redirect('C_dompet/sett_voc_all');
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PENJUAL
	public function riwayat_edisi_voc_2()
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
			$data['view'] = 'pages/master_admin/dompet/riwayat_edisia_2';
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

	function update_bio_o_admin($id)
	{
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));
		///upload file
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('user'),
			'password' => $this->input->post('pass'),
			//
			'rek' => $this->input->post('rek'),
			'bank' => $this->input->post('bank'),
			'nbm' => $this->input->post('nbm'),
			'bank' => strtoupper($this->input->post('bank')),
			//'jenis_kelamin'=>$this->input->post('jenis'),
			'no_kontak' => $this->input->post('no'),
			'alamat' => $this->input->post('alamat'),
			'tanggal_edit' => $tanggal,
			//'ranting'=>$this->input->post('ranting'),
			//'cabang'=>$this->input->post('cabang'),
			//'daerah'=>$this->input->post('daerah'),
			'job' => $this->input->post('job'),
			'ni' => $this->input->post('ni'),
			'kode_prodi' => $this->input->post('prodi'),
		);
		$this->Login_model->simpan_edt_bio($data, $id);

		$this->session->set_flashdata('pesan', 'Data sudah di perbaharui');
		redirect("C_dompet/sett_voc/$id");
	}
} ///class
