<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dompet_2 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('Pdf');
		$this->load->model('M_adminvoc');
	}


	public function index()
	{
		redirect('C_dompet/dompet');
	}



	//////////////////Dompet
	function pesan_voucher_2018008($id)
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
			$idvoc = $this->M_voucher->get_max_id_voc();
			if ($this->form_validation->run() == TRUE) {

				$d = array(
					'nik' => $this->input->post('nik'),
					'unit' => $this->input->post('unit'),
					'id_user' => $id,
					'id_voc' => $idvoc,
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
        Anda sudah memesan Voucher. <br/>
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
				$ci->email->subject('PESAN VOUCHER - [E-Retail SUPERMALL]');
				$ci->email->message($isinot);
				//$ci->email->attach(base_url('pdf/test.pdf'));
				$gt_tblpesanvoucher = $this->M_voucher->get_pesann_voc_id($id, $idvoc);
				if ($gt_tblpesanvoucher->num_rows() > 0) {

					$this->session->set_flashdata('pesan', 'data Gagal Dikirim. Karena sudah menerima untuk edisi sekarang.');
					redirect('C_dompet/tcses');
				} else {
					$this->Madmin_master->pesan_v($d);
					$this->email->send();
				}



				///
				//$this->Madmin_master->block_penjual_model($id,$d);
				//bila belum buat kalau udah di update





				$this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu.');
				redirect('C_dompet/tcses');
			} else {

				if ($this->input->post('ya01') == NULL) {
					$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
					redirect('Login');
				} else {
					redirect('C_dompet/dompet');
				}
			}
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	function pesan_voucher($id)
	{
		redirect('C_voc_acc/pe_terima_voucher_makan');
	}

	function acc_pesan_voc($t, $id_user, $id, $id_job = 1)
	{
		///waktu


		///manambah voucer di tbl User_admin
		$this->form_validation->set_rules('saldo', 'saldo', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($t == 't') {
				$isinot = '
		Voucher UMY Sudah diterima
		.<br/>
        Sebesar Rp ' . $this->input->post('saldo')
					. '
        <br/>--------------------------------------<br/>
        Terimakasih.
        ';

				$this->trnans_voc($id_user, $id);

				$this->kirim_email($id_user, $isinot);
			} else {
			}
			$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');
			redirect('C_dompet/dafatar_pemesan_voucher/' . $id_job);
			//========================================================================
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali.');
			redirect('Login');
		}
	}

	function trnans_voc($id_user, $id)
	{

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));

		if (!empty($this->input->post('saldo')) or $this->input->post('saldo') == 0) {
			$sal_trans = $this->input->post('saldo');
			$id_voc_s = $this->M_voucher->get_max_id_voc();

			///PErpindahan VOUCHER
			///20180420
			$s_awal = $this->Muser->get_user_by_id($id_user)->row()->voucher_umy; ///saldo awal

			$vocer = array(
				'voucher_umy' => $s_awal + $sal_trans, ///masih sistem tindih
			);

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user,
				///rev 11017
				'kode' => 1, ///pendapatan
				'pendapatan' => $sal_trans, ///pendapatan

				'kontek' => 'Mendapat Voucher ===  ' . $sal_trans,
				'voucher_umy' => $s_awal + $sal_trans,
				'tgl_trans' => $tanggal,
				'id_voc' => $id_voc_s,
				'j_voucher' => 0, ///makan //reguler
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///PErpindahan VOUCHER


			$pp = 1;
			$ter = 1;
			$alasan = '';

			$d = array(
				'proses' => $pp,
				'tahap' => $pp,
				'tanggal_acc' => $tanggal . ' ' . $waktu,
				'pesan_voucer' => $ter,
				'alasan_tolak' => $alasan,
				'saldo_awal' => $sal_trans,
			);


			//db tbl voucher
			if ($this->session->userdata('login') == TRUE  and $this->session->userdata('wewenang') == 'admin') {

				$this->Mtrans->simpan_update_tbluser($id_user, $vocer); //update infor
				$this->Madmin_master->simpan_perubahan_tbl_voucher($d, $id);
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

			$this->M_voucher->add_edisi_bln_now_jvoc($d);

			$this->session->set_flashdata('pesan', 'Sukses.');
			redirect('C_dompet/sett_voc_all');
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PENJUAL
	public function riwayat_vocAll()
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
} ///class
