<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_sbm extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['view'] = 'pages/examples/form_daftar_sbm';
		$this->load->view('pages/examples/login', $data);
	}


	////otorisai
	////[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[verifikasi ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
	public function otorisasi()
	{
		if ($this->session->userdata('login') == TRUE) {

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
			$data['b'] = $data['d'] = $data['i'] = $data['k'] = '';
			$data['j'] = 'active';
			///
			$data['view'] = 'pages/sbm/verifikasi_produk';
			//dropdown
			//dropdown
			$gtog = $this->Muser->get_kategori();

			if ($gtog->num_rows() > 0) {
				$no = 1;
				$opsipasca1 = array('0' => '---Pilih Kategori---');
				foreach ($gtog->result() as $o) {
					$opsipasca2[$o->id] = $o->kategori;
					$no++;
				}
				$data['kategori'] = array_merge($opsipasca1, $opsipasca2);
				$data['prodi_default'] = '1';
			} //

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}
	////otorisai

	function a()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan1';
		$this->load->view('pages/layout/top-nav', $data);
	}

	function b()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan2';
		$this->load->view('pages/layout/top-nav', $data);
	}

	function c()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan3';
		$this->load->view('pages/layout/top-nav', $data);
	}


	function daftar_simpan_sbm()
	{ //upload
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));
		///upload file
		$this->load->library('upload');
		$nmfile = "image_" . time(); //nama file saya beri nama langsung dan diikuti fungsi time
		//$config['upload_path'] = './upload/poto_asli/'; //path folder anpa di kurangi
		$config['upload_path'] = './upload/sbm/'; //path folder anpa di kurangi
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '0'; //maksimum besar file 2M
		//$config['max_width']  = '1288'; //lebar maksimum 1288 px
		//$config['max_height']  = '768'; //tinggi maksimu 768 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya
		$config['max_filename'] = 200;
		$this->upload->initialize($config);
		date_default_timezone_set("Asia/Jakarta");

		if ($_FILES['file']['name']) {
			if ($this->upload->do_upload('file')) {
				$gbr = $this->upload->data();

				//////////////////PROSES MENGECILKAN UKURAN //151417
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $gbr['full_path'];
				//  $config2['new_image'] = './upload/barang/'; // folder tempat menyimpan hasil resize
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 600; //lebar setelah resize menjadi 100 px
				$config2['height'] = 350; //lebar setelah resize menjadi 100 px

				$this->load->library('image_lib', $config2);
				//dibawah ini merupakan code untuk resize

				//pesan yang muncul jika resize error dimasukkan pada session flashdata
				if (!$this->image_lib->resize()) {
					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
				}

				$data = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'nbm' => $this->input->post('nbm'),
					'no_kontak' => $this->input->post('no'),

					'tempat_l' => $this->input->post('t4'),
					'tgl_l' => $this->input->post('tgl'),
					'usaha' => $this->input->post('usaha'),


					'alamat' => $this->input->post('alamat'),
					//		'password'=>$this->input->post('pass'),
					'jenis_kelamin' => $this->input->post('jenis'),
					//		'wewenang'=>'user',
					//'ranting'=>'user',
					//'daerah'=>'user',
					'tanggal' => $tanggal,
					'file_nbm' => $gbr['file_name'],
					'ranting' => $this->input->post('ranting'),
					'cabang' => $this->input->post('cabang'),
					'daerah' => $this->input->post('daerah'),
					//		'setuju'=>$this->input->post('setuju'),
				);

				$isinot = '<p>Terimakasih sudah mendaftar</p>,<br/><p>mohon tunggu notifikasi</p><br/>
		';
				$isinotad = '<p>ADA PESERTA SBM BARU YANG SUDAH MENDAFTAR ,,, SEDANG MENUNGGU VERIFIKASI DARI ADMIN</p>
		';

				$cekuser = $this->Login_model->check_user($this->input->post('username'), $this->input->post('pass'));
				$cekusernopass = $this->Login_model->check_user_nopass($this->input->post('pass'));
				if ($cekuser == TRUE) {
					$this->session->set_flashdata('pesandaftar', 'Maaf ,<br/> Email yang anda gunakan sudah terdaftar');
					redirect("C_sbm");
				} else {
					///////////NOTIVIKASI EMAIL
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

					$ci->email->to($this->input->post('username')); ///ke email pembeli
					$ci->email->bcc('E-Retail@jualretail.com');
					$ci->email->subject('Notifikasi Pendaftaran SBM - [E-Retail]');
					$ci->email->message($isinot);
					//$ci->email->attach(base_url('pdf/test.pdf'));
					$this->email->send(); ///////////NOTIVIKASI EMAIL


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

					$ci->email->to('masterpra2002@gmail.com'); ///ke email pembeli
					$ci->email->bcc('E-Retail@jualretail.com', 'ilhamroyroy@gmail.com');
					$ci->email->subject('Peserta SBM baru - [E-Retail]');
					$ci->email->message($isinotad);
					//$ci->email->attach(base_url('pdf/test.pdf'));
					$this->email->send();

					///



					//$this->Login_model->simpan_daftar($data);
					$this->Login_model->simpan_daftar_sbm($data);

					$this->session->set_flashdata('pesandaftars', 'Terimakasih sudah mendaftar, monhon tunggu notifikasi dari admin');
					redirect("C_sbm");
				}
			} else { ///gbr tdk sesuai
				$this->session->set_flashdata('pesandaftar', 'Mohon Maaf data gagal dikirim, <br/> mohon periksa lagi gambar anda.');
				redirect("C_sbm");
			}
		} else {
			$this->session->set_flashdata('pesandaftar', 'Mohon Maaf data gagal dikirim, <br/> mohon masukkan gambar.');
			redirect("C_sbm");
		}
	}

	//////////////////SBM 10717
	function terima_penjual($id)
	{
		$d = array(
			'status' => 1,
		);

		///////////NOTIVIKASI EMAIL

		$Emailto = $this->Muser->get_bsm_by_id($id)->row()->username;
		$pass = $this->Muser->get_bsm_by_id($id)->row()->password;

		$isinot = '
		Selamat Pendaftaran anda di Terima.<br/>
		
		';
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
		$ci->email->subject('Notifikasi Pendaftaran BSM - [E-Retail]');
		$ci->email->message($isinot);
		//$ci->email->attach(base_url('pdf/test.pdf'));
		$this->email->send();

		///
		//$this->Madmin_master->block_penjual_model($id,$d);
		$this->Madmin_master->terima_bsm($id, $d);

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');
		redirect('C_sbm/otorisasi');
	}

	//////////////////bsm tolak
	function tolak_penjual($id)
	{
		$d = array(
			'status' => 3,
		);
		$this->Madmin_master->terima_bsm($id, $d);
		///////////NOTIVIKASI EMAIL
		$Emailto = $this->Muser->get_bsm_by_id($id)->row()->username;
		$isinot = '
		Mohon Maaf, <br/>
		anda tidak diterima .<br/>
		Karena : ' . $this->input->post('teks') . '
		';
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
		$ci->email->subject('Notifikasi Pendaftaran SBM - [E-Retail]');
		$ci->email->message($isinot);
		//$ci->email->attach(base_url('pdf/test.pdf'));
		$this->email->send();

		///
		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');
		redirect('C_sbm/otorisasi');
	}

	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar daftar_peserta
	public function daftar_peserta()
	{
		if ($this->session->userdata('login') == TRUE) {
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
			$data['view'] = 'pages/sbm/daftar_penjual';
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

	public function pemateri()
	{
		if ($this->session->userdata('login') == TRUE) {

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
			//================================================================
			$data['title0'] = 'E-Retail';
			$data['title1'] = 'E-Retail';
			///
			$data['id_k'] = $id_k;
			if ($id_k != NULL) {
				$data['in'] = 'in';
			} else {
				$data['in'] = '';
			}

			///
			$data['a'] = '';
			$data['c'] = $data['d'] = '';
			$data['b'] = 'active';
			///
			$data['view'] = 'pages/sbm/Add_pemateri';
			//dropdown
			$gtog = $this->Muser->get_kategori();

			if ($gtog->num_rows() > 0) {
				$no = 1;
				$opsipasca1 = array('0' => '---Pilih Kategori---');
				foreach ($gtog->result() as $o) {
					$opsipasca2[$o->id] = $o->kategori;
					$no++;
				}
				$data['kategori'] = array_merge($opsipasca1, $opsipasca2);
				$data['prodi_default'] = '1';
			} //
			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	/////SIMPAN PEG PEMATEERI

	function simpan_pemateri()
	{ //upload
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));
		///upload file
		$this->load->library('upload');
		$nmfile = "image_" . time(); //nama file saya beri nama langsung dan diikuti fungsi time
		//$config['upload_path'] = './upload/poto_asli/'; //path folder anpa di kurangi
		$config['upload_path'] = './upload/sbm/'; //path folder anpa di kurangi
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '0'; //maksimum besar file 2M
		//$config['max_width']  = '1288'; //lebar maksimum 1288 px
		//$config['max_height']  = '768'; //tinggi maksimu 768 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya
		$config['max_filename'] = 200;
		$this->upload->initialize($config);
		date_default_timezone_set("Asia/Jakarta");

		if ($_FILES['file']['name']) {
			if ($this->upload->do_upload('file')) {
				$gbr = $this->upload->data();

				//////////////////PROSES MENGECILKAN UKURAN //151417
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $gbr['full_path'];
				//  $config2['new_image'] = './upload/barang/'; // folder tempat menyimpan hasil resize
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 600; //lebar setelah resize menjadi 100 px
				$config2['height'] = 350; //lebar setelah resize menjadi 100 px

				$this->load->library('image_lib', $config2);
				//dibawah ini merupakan code untuk resize

				//pesan yang muncul jika resize error dimasukkan pada session flashdata
				if (!$this->image_lib->resize()) {
					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
				}

				$data = array(
					'nama' => $this->input->post('nama'),
					'tanggal' => $tanggal,
					'foto' => $gbr['file_name'],
					'rincian' => $this->input->post('deskripsi'),
					//		'setuju'=>$this->input->post('setuju'),
				);

				$this->Madmin_master->save_pemateri($data);

				$this->session->set_flashdata('pesandaftars', 'Terimakasih sudah mendaftar, monhon tunggu notifikasi dari admin');
				redirect("C_sbm/pemateri");
			} else { ///gbr tdk sesuai
				$this->session->set_flashdata('pesandaftar', 'Mohon Maaf data gagal dikirim, <br/> mohon periksa lagi gambar anda.');
				redirect("C_sbm/pemateri");
			}
		} else {
			$this->session->set_flashdata('pesandaftar', 'Mohon Maaf data gagal dikirim, <br/> mohon masukkan gambar.');
			redirect("C_sbm/pemateri");
		}
	}
} ///class
