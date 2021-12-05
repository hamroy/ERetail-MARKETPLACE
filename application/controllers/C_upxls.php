<?php

defined('BASEPATH') or exit('No direct script access allowed');



class C_upxls extends CI_Controller
{



	private ///= var 

		$filename = "import_data", // Kita tentukan nama filenya

		$keys = ''; // Kita tentukan nama filenya

	function __construct()

	{

		parent::__construct();

		$this->load->model('M_upfilex');

		$this->load->model('M_vparsel');

		$this->load->model('M_adminvoc');

		$this->load->model('M_dompetall');



		////========================

		$karakter = 'abcdefghijklmnopqrstuvwqyzABCDEFGHIJKLMNOPQRSTUVWQYZ1234567890';

		$keys = '';

		for ($i = 0; $i < 16; $i++) {

			$pos = rand(0, strlen($karakter) - 1);

			$keys .= $karakter{
			$pos};
		}



		$this->keys = $keys;

		////========================



	}







	public function index()
	{

		//$data['siswa'] = $this->M_upfilex->view();
		if ($this->session->userdata('login') != TRUE or $this->session->userdata('wewenang') != 'admin') {
			redirect('login');
		}

		$tgl = $this->M_time->harinow();

		$d = [

			'id_app' => 123,

			'token' => $this->keys,

			'akses' => '1',

			'tgl' => $tgl,

		];

		$this->M_upfilex->sendtoken($d);

		var_dump($d)['token'];



		redirect('http://im.E-Retail.com/?token=' . $this->keys . '&&tgl=' . $tgl);

		// redirect('http://localhost:80/import_xls/?token='.$this->keys.'&&tgl='.$tgl); ///onflne



		//$this->load->view('/pages/upxls/daftar_ex', $data);

	}



	public function C_uppeg()
	{

		//$data['siswa'] = $this->M_upfilex->view();
		if ($this->session->userdata('login') != TRUE or $this->session->userdata('wewenang') != 'admin') {
			redirect('login');
		}

		$tgl = $this->M_time->harinow();

		$d = [

			'id_app' => 123,

			'token' => $this->keys,

			'akses' => '1',

			'tgl' => $tgl,

		];

		$this->M_upfilex->sendtoken($d);

		var_dump($d)['token'];



		redirect('http://im.E-Retail.com/C_uppeg/?token=' . $this->keys . '&&tgl=' . $tgl);

		// redirect('http://localhost:80/import_xls/C_uppeg/?token='.$this->keys.'&&tgl='.$tgl); ///onflne



		//$this->load->view('/pages/upxls/daftar_ex', $data);

	}



	public function proses1_exs()

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



			$data['view'] = 'pages/master_admin/dompet/mhs/daftar_mhs_pesvoc';

			$data['gt_stjob'] = $gt_stjob = $this->M_voucher->get_stjob();

			///

			$data['id_job'] = $id_job = 0;

			//

			$data['m'] = 'active';



			$data['f'] = '';



			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';



			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';



			$data['id_voc_mhs'] = $id_voc_mhs = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS



			$this->load->view('pages/admin/beranda', $data);
		} else {



			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');



			redirect('Login');
		}
	}



	public function daftar_mhs()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {
			$data = $this->Muser->getDataProfil();

			///
			$data['view'] = 'pages/master_admin/dompet/mhs/daftar_mhs';

			$data['gt_stjob'] = $gt_stjob = $this->M_voucher->get_stjob();

			///
			$data['id_job'] = $id_job = 0;
			//
			///
			$data['penvoc'] = $this->M_adminvoc->hitpenermavoc_peg(3);
			//

			$data['dari'] = $dari = 0;
			$data['all_newvoucer2'] = $this->M_vparsel->get_mhs_ex_aktif_pag(3, 3, 1);

			$data['halaman'] = $this->pagination->create_links();

			///
			$data['m'] = 'active';
			$data['f'] = '';
			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';
			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			$data['id_voc_mhs'] = $id_voc_mhs = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS
			$this->load->view('pages/admin/beranda', $data);
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}



	function acc_pesan_voc_mhs_all()
	{

		///waktu

		///manambah voucer di tbl User_admin

		$this->form_validation->set_rules('saldo', 'saldo', 'required');



		if ($this->form_validation->run() == TRUE) {

			$isinot = '

		Voucher Mahasiswa sudah diterima 

        .<br/>

        Sebesar Rp ' . $this->input->post('saldo')

				. '

        <br/>--------------------------------------<br/>

        Terimakasih.

        ';



			$id_voc_mhs = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS

			$get_ = $this->M_vparsel->get_Pvoc_mhs_ex(3, $id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA



			if ($get_->num_rows() > 0) {

				foreach ($get_->result() as $gidp) {



					$this->trnans_voc_mhs_per($gidp->id_user, $gidp->id);

					$this->kirim_email_per($gidp->id_user, $isinot);
				}
			}



			$get_ = $this->M_vparsel->get_Pvoc_mhs_ex(3, $id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA



			if ($get_->num_rows() == 0) {

				//$this->M_vparsel->mhs_aktif_deletall(); //bila data kosong maka di hapus

			}



			$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');



			redirect('C_upxls/proses1_exs?vo=3');

			//========================================================================

		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali.');

			redirect('Login');
		}
	}



	function kirim_email_per($id_user, $isinot)
	{

		///////////NOTIVIKASI EMAIL

		$Emailto = $this->Muser->get_user_by_id($id_user)->row()->username;



		//////////////notifikasi email 21/3/17

		$this->cfg_email();



		$this->email->to($Emailto); ///ke email pembeli

		$this->email->message($isinot);

		$this->email->send();
	}



	function trnans_voc_mhs_per($id_user, $id)
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



	function cfg_email()
	{

		$ci = get_instance();

		$ci->load->library('email');

		$config['protocol'] = "smtp";

		$config['smtp_host'] = "ssl://host21.registrar-servers.com";

		$config['smtp_port'] = "465";

		$config['wordwrap'] = TRUE;

		$config['smtp_user'] = "admin@E-Retail.com";

		$config['smtp_pass'] = "52TuGw}TZSa7";

		$config['mailtype'] = "html";

		$config['newline'] = "\r\n";

		$ci->email->initialize($config);

		$ci->email->from('admin@E-Retail.com', 'E-Retail SUPERMALL');

		$ci->email->bcc('admin@E-Retail.com');

		$ci->email->subject('Notifikasi- [E-Retail SUPERMALL]');
	}





	////PEGAWAI



	public function daftar_peg($jvoc = 1)

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



			$data['view'] = 'pages/master_admin/dompet/voucher_all/daftar_penerima';

			$data['gt_stjob'] = $gt_stjob = $this->M_voucher->get_stjob();

			///

			$data['jvoc'] = $jvoc;

			$data['dvo'] = $dvo = 1;

			if (isset($_GET['vo'])) {

				$data['dvo'] = $dvo = $_GET['vo'];
			}

			$data['gjvoc'] = $gjvoc = $this->M_adminvoc->get_jvoc($jvoc);



			//



			///

			$data['penvoc'] = $this->M_adminvoc->hitpenermavoc_peg($jvoc);

			//

			//revisi ilham pagination



			$nmrows = $this->M_adminvoc->get_peg_ex_aktif($jvoc);



			$config['base_url'] = base_url('C_upxls/daftar_peg/' . $jvoc);

			$data['total_rows'] =

				$config['total_rows'] = $nmrows->num_rows();

			$config['per_page'] = 10; /*Jumlah data yang dipanggil perhalaman*/

			$config['uri_segment'] = 4; /*data selanjutnya di parse diurisegmen 3*/

			$config['num_links'] = 10;

			/*Class bootstrap pagination yang digunakan*/



			$config['full_tag_open'] = "<ul class='pagination center' style='position:relative; top:-25px;'>";



			$config['full_tag_close'] = "</ul>";



			$config['num_tag_open'] = '<li>';



			$config['num_tag_close'] = '</li>';

			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";



			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";



			$config['next_tag_open'] = "<li>";



			$config['next_tagl_close'] = "</li>";



			$config['prev_tag_open'] = "<li>";



			$config['prev_tagl_close'] = "</li>";



			$config['first_tag_open'] = "<li>";



			$config['first_tagl_close'] = "</li>";



			$config['last_tag_open'] = "<li>";



			$config['last_tagl_close'] = "</li>";



			$this->pagination->initialize($config);

			//////////



			$data['dari'] = $dari = $this->uri->segment($config['uri_segment']);



			$data['all_newvoucer2'] =

				$this->M_adminvoc->get_peg_ex_aktif_pag($jvoc, $config['per_page'], $dari);



			$data['halaman'] = $this->pagination->create_links();



			/////

			$data['m'] = 'active';



			$data['f'] = '';



			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';



			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';



			$data['id_voc_mhs'] = $id_voc_mhs = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS



			$this->load->view('pages/admin/beranda', $data);
		} else {



			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');



			redirect('Login');
		}
	}



	public function acc_alljvoc()

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



			$data['view'] = 'pages/master_admin/dompet/mhs/daftar_mhs_pesvoc';

			$data['gt_stjob'] = $gt_stjob = $this->M_voucher->get_stjob();

			///

			$data['id_job'] = $id_job = 0;

			//

			$data['m'] = 'active';



			$data['f'] = '';



			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';



			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';



			$data['id_voc_mhs'] = $id_voc_mhs = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS



			$this->load->view('pages/admin/beranda', $data);
		} else {



			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');



			redirect('Login');
		}
	}



	function get_pesvoc($lim = 10)
	{



		$a = [

			'off' => $off = 0,

		];

		//revisi ilham pagination



		$nmrows = $this->M_vparsel->get_mhs_ex_aktif(3, 3);



		// $config['base_url'] = base_url('C_upxls/get_pesvoc/');

		$config['base_url'] = base_url('C_upxls/get_pesvoc/');

		$data['total_rows'] =

			$config['total_rows'] = $nmrows->num_rows();

		$config['per_page'] = 10; /*Jumlah data yang dipanggil perhalaman*/

		$config['uri_segment'] = 3; /*data selanjutnya di parse diurisegmen 3*/

		$config['num_links'] = 10;

		/*Class bootstrap pagination yang digunakan*/



		$config['full_tag_open'] = "<ul class='pagination center' style='position:relative; top:-25px;'>";



		$config['full_tag_close'] = "</ul>";



		$config['num_tag_open'] = '<li id="pag">';



		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";



		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";



		$config['next_tag_open'] = "<li>";



		$config['next_tagl_close'] = "</li>";



		$config['prev_tag_open'] = "<li>";



		$config['prev_tagl_close'] = "</li>";



		$config['first_tag_open'] = "<li>";



		$config['first_tagl_close'] = "</li>";



		$config['last_tag_open'] = "<li>";



		$config['last_tagl_close'] = "</li>";



		$this->pagination->initialize($config);

		//////////



		$a['dari'] = $dari = $off = 0;



		$a['all_newvoucer2'] =

			$this->M_vparsel->get_mhs_ex_aktif_pag(3, 3, 1, $lim, $dari);



		$a['halaman'] = $this->pagination->create_links();

		///



		$data['view'] = 'pages/master_admin/dompet/mhs/daftar_mhs_load';



		$this->load->view($data['view'], $a);
	}

	public function hpusData()
	{
		# code...
		if ($this->session->userdata('login') != TRUE or $this->session->userdata('wewenang') != 'admin') {
			redirect('login');
		}

		$this->db->truncate('tbl_mhs_aktif_xls');
		echo $url = $_SERVER['HTTP_REFERER'];

		redirect($url);
	}

	public function mhsExelJson()
	{
		# code...
		if ($this->session->userdata('login') != TRUE or $this->session->userdata('wewenang') != 'admin') {
			redirect('login');
		}
		$v = 'pages/master_admin/dompet/mhs/daftar_mhs_json';
		$this->load->view($v);
	}
} ///class