<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_bmt extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'bmt') {
			redirect('C_bmt/reedem_new');
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	///rev tanggal 130717 DOMPET E-Retail	
	public function beranda()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'bmt') {

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
			$data['l1'] = '';
			$data['l2'] = '';
			$data['l3'] = '';
			///
			$data['view'] = 'bmt/daftar';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	///rev tanggal 130717 DOMPET E-Retail	
	public function dompet_bank()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'bmt') {

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
			$data['l1'] = '';
			$data['l2'] = '';
			$data['l3'] = '';
			///
			$data['view'] = 'bmt/daftar_dompet';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	///rev tanggal 130717 DOMPET E-Retail	
	public function reedem_new()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'bmt') {

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
			$data['l'] = '';
			$data['l1'] = '';
			$data['l2'] = 'active';
			$data['l3'] = '';
			///
			$data['view'] = 'bmt/daftar_new';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	public function reedem_disetujui()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'bmt') {

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
			$data['l'] = '';
			$data['l1'] = '';
			$data['l2'] = '';
			$data['l3'] = 'active';
			///
			$data['view'] = 'bmt/daftar_disetujui';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	public function cetakan_beranda($hasil_no)
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'bmt') {

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
			$data['idid'] = $hasil_no;
			$data['a'] = '';
			$data['c'] = $data['d'] = '';
			$data['b'] = '';
			$data['l'] = 'active';
			///
			$data['view'] = 'bmt/cetak1';

			//$this->load->view('bmt/cetak_html',$data);
			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	public function cetak($hasil_no)
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'bmt') {

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
			///
			$data['voucher_umy'] = $g_id->row()->voucher_umy;
			$data['dompet'] = $g_id->row()->dompet;
			$data['voucher_dibelanjakan'] = $g_id->row()->voucher_dibelanjakan;
			$data['dompet_dicairkan'] = $g_id->row()->dompet_dicairkan;
			//================================================================
			$data['title0'] = 'E-Retail';
			$data['title1'] = 'E-Retail';
			///
			$pec = explode('-', $hasil_no); ///masukkan ke array 
			$d = array(
				'status' => 3, //print()

			);
			for ($q = 1; $q < count($pec); $q++) { ////PENGULANGAN 
				$this->Mbmt->update_tbl_reedem($d, $pec[$q]);
			}
			///
			$data['idid'] = $hasil_no;
			$data['a'] = '';
			$data['c'] = $data['d'] = '';
			$data['b'] = '';
			$data['l'] = 'active';
			///
			//$data['view']='bmt/cetak1';

			$this->load->view('bmt/cetak_html', $data);
			//$this->load->view('pages/admin/beranda',$data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar verifikasi pemesan voucher
	public function dafatar_pemesan_voucher()
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
			///
			$data['m'] = 'active';
			$data['f'] = '';
			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';
			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';
			///
			$this->load->view('pages/admin/beranda', $data);
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	//////////////////BMT 
	function setuju($id_user, $id, $s)
	{

		///waktu
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));



		///MEMPERBAHARUI VOUCHER
		////////////////REVISI 201717
		$getvoucher = $this->Mtrans->get_voucher_tbluser_vocer($id_user);	 //tblambil voucher di tbl user
		$getdompet = $getvoucher->row()->dompet;
		$getdompet_awal = $getvoucher->row()->dompet_dicairkan;
		$transit0 = $this->Mbmt->get_tbl_redeem($id); //di tabl reedem get reedeem
		$transit = $transit0->row()->redeem;
		////////////////REVISI 15417
		///PErpindahan VOUCHER
		//diterima dompet tetap  d tolak dompet di kurangi
		if ($s == 'ya') {
			////MERUBAH SETATUS DI TBL REEDEEM
			$d = array(
				'status' => 1,
				'tgl_oto' => $tanggal,
			);
			//
			$vocer = array( //update tbl user
				'dompet_dicairkan' => $getdompet_awal - $transit,
			);

			//riwayat

			//update metode pembayaran
			$rwytvocer = array( ///andd rowayat voucher
				'id_user' => $id,
				'kontek' => 'Setuju Redeem (voucer pindah ke bmt)' . $transit,
				'dompet_dicairkan' => $getdompet_awal - $transit,
				'tgl_trans' => $tanggal,
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);
			//ISI EMAL
			$isinot = '
		Permintaan Pencairan Voucher Diterima oleh BMT
		<br/> Terima kasih.
		';
			//NOTIF
			$this->session->set_flashdata('pesan', 'data berhasil Dikirim.');
		} else {

			////MERUBAH SETATUS DI TBL REEDEEM
			$d = array(
				'status' => 2, //tolak
				'tgl_oto' => $tanggal,
				'alasan_tolak' => $this->input->post('alasan'),
			);

			$vocer = array(
				'dompet' => $getdompet + $transit,
				'dompet_dicairkan' => $getdompet_awal - $transit,
			);

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id,
				'kontek' => 'Tolak Redeem (voucher kemabali)' . $transit,
				'dompet_dicairkan' => $getdompet_awal - $transit,
				'dompet' => $getdompet + $transit,
				'tgl_trans' => $tanggal,
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);
			//ISI EMAL
			$isinot = '
		Permintaan Pencairan Voucher dItolak oleh BMT, <br/>
		karena : ' . $this->input->post('alasan') . ' 
		<br/> Terima kasih.
		';
			//NOTIF
			$this->session->set_flashdata('pesan', 'data berhasil Dikirim.');
		}





		//////rev Ilham 190717

		///////////NOTIVIKASI EMAIL

		$Emailto = $this->Muser->get_user_by_id($id_user)->row()->username;


		//////////////notifikasi email 21/3/17
		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://host21.registrar-servers.com";
		$config['smtp_port'] = "465";
		$config['wordwrap'] = TRUE;
		$config['smtp_user'] = "E-Retail@jualretail.com";
		$config['smtp_pass'] = "beduk2017";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";


		$ci->email->initialize($config);
		//$list = array('ilhamroyroy@gmail.com');

		$ci->email->from('E-Retail@jualretail.com', 'E-Retail SUPERMALL');

		$ci->email->to($Emailto); ///ke email pembeli
		$ci->email->bcc('E-Retail@jualretail.com');
		$ci->email->subject('[E-Retail]');
		$ci->email->message($isinot);
		//$ci->email->attach(base_url('pdf/test.pdf'));
		$this->email->send();

		///

		$this->Mbmt->update_tbl_reedem($d, $id);
		$this->Mtrans->simpan_update_tbluser($id_user, $vocer); //update infor
		$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat



		redirect('C_bmt/');
	}


	function cetak_pencairan()
	{ ///cuam pemecahan
		$all = $this->Mbmt->get_tbl_redeem_all_setuju();

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('id_' . $aa->id)) {

					$simpan = $simpan . '-' . $aa->id;
				}
			}
		}

		$hasil_no = $simpan;




		$this->session->set_flashdata('pesan', 'Pastikan data yang akan Diceak Benar' . $hasil_no);
		redirect('C_bmt/cetakan_beranda/' . $hasil_no);
	}
} ///class
