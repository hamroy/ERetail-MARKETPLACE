<?php

defined('BASEPATH') or exit('No direct script access allowed');



class User_admin extends CI_Controller
{

	function __construct()
	{

		parent::__construct();

		$this->load->helper(array('form', 'url'));

		$this->load->library('Pdf');
		$this->load->model('M_vparsel');
		$this->load->model('Mbank');
		$this->load->model('M_produk');
	}

	public function index()
	{

		if ($this->session->userdata('login') == TRUE) {

			$data = $this->Muser->getDataProfil();

			$data['view'] = 'pages/admin/viewer/profil';

			///

			$data['a'] = 'active';

			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function beranda($id_k = NULL)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$data = $this->Muser->getDataProfil();

			$data['id_k'] = $id_k;

			if ($id_k != NULL) {

				$data['in'] = 'in';
			} else {

				$data['in'] = '';
			}



			///

			$data['b'] = 'active';

			///

			$data['view'] = 'pages/admin/viewer/Add_produk';


			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}





	////[[[[[[[[[[[[[[[[TRANSAKSI ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function transaksi($thn = NULL)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			$data = $this->Muser->getDataProfil();
			$data['c'] = 'active';
			$data['sort'] = '';

			///

			$thn_now = $this->M_time->thn();
			if ($thn == NULL) {
				$data['thn'] = $thn_now;
			} else {
				$data['thn'] = $thn;
			}

			///

			$data['view'] = 'pages/admin/viewer/transaksi_produk';


			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function transaksi_rinci($thn = NULL, $bln = NULL)

	{

		if ($thn == NULL or $bln == NULL) {
			redirect('User_admin/transaksi/');
		}

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$data = $data = $this->Muser->getDataProfil();
			$data['c'] = 'active';
			$data['sort'] = '';

			///
			///thun
			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$thn_now = gmdate("Y", time() + ($ms));
			if ($thn == NULL) {
				$data['thn'] = $thn_now;
			} else {
				$data['thn'] = $thn;
			}
			$data['bln'] = $bln;

			///

			$data['view'] = 'pages/admin/viewer/transaksi/transaksi_produk_rinci';


			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	////

	////[[[[[[[[[[[[[[[[TRANSAKSI ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function transaksi_selesai()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			$data = $this->Muser->getDataProfil();
			$data['c2'] = 'active';

			///
			$this->load->model('M_transaksiAkun');
			///

			$data['view'] = 'pages/admin/viewer/transaksi_produk_selesai';



			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	////

	////[[[[[[[[[[[[[[[[[[[[[[[[[[[TRANSAKSI ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function transaksi_belanja()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$data = $data = $this->Muser->getDataProfil();
			$data['c1'] = 'active';

			///
			///
			$this->load->model('M_transaksiAkun');
			///

			$data['view'] = 'pages/admin/viewer/transaksi_belanja';


			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	//[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[barang_dipesan ]]]]]|[[[[rev23317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function barang_dipesan()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			$data = $data = $this->Muser->getDataProfil();
			$this->load->model('M_produkDipesan');
			$data['d'] = 'active';
			///

			//$data['view']='pages/admin/viewer/produk_dipesan';
			$data['view'] = 'pages/admin/viewer/produk_dipesan2';
			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}

	////

	public function barang_dipesan_to($id)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			$data = $data = $this->Muser->getDataProfil();
			$data['d'] = 'active';
			$data['id'] = $id;

			///

			//$data['view']='pages/admin/viewer/produk_dipesan';
			$this->load->model('M_dompetKu');
			$data['view'] = 'pages/admin/viewer/produk_dipesan2_to';




			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	////

	public function proses_simpan_save_data($id) ///blm edit masih di pake buat edit profuk

	{
		if ($this->session->userdata('login') == FALSE) {
			redirect('login');
		}

		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));
		$data = array(

			'nama' => $this->input->post('nama'),

			'id_k' => $this->input->post('id_k'),

			//'gambar'=>$gbr['file_name'],

			//'id_user'=>$this->session->userdata('id_user'),

			'stok' => $this->input->post('stok'),

			'satuan' => $this->input->post('satuan'),

			'harga' => $this->input->post('harga'),

			'hargak' => $this->input->post('hargak'),

			'deskripsi' => $this->input->post('deskripsi'),

			'tanggal_edit' => $tanggal,

		);

		$this->Madmin->simpan_save_data($data, $id);

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		//redirect ('User_admin/beranda');

		redirect('C_user_admin/rinciproduk/' . $id);
	}

	public function proses_simpan_del_data($id) ///

	{

		if ($this->session->userdata('login') == FALSE) {
			redirect('login');
		}

		//$this->Madmin->simpan_del_data($id);
		$d = [

			'id_user' => $this->session->userdata('id_user'),
			'id_produk' => $id,
			'tanggal' => $this->M_time->harinow(),

		];

		$this->M_produk->indata_delproduk($d);

		$d2 = [

			'status' => 2,
			'tanggal_edit' => $this->M_time->harinow(),

		];



		$this->M_produk->sdata_produk($d2, $id);

		$this->session->set_flashdata('pesan', 'data berhasil di hapus .');

		redirect('C_user_admin/rinciproduk/' . $id);
	}

	//////////

	public function proses_simpan_pluss_data($id_k = NULL) ///yangdi pakai

	{

		if ($this->session->userdata('login') == FALSE) {
			redirect('login');
		}

		if ($id_k != NULL) {

			////=============================rev23



			if ($id_k != 4) {

				$harga = $this->input->post('harga');

				$hargak = $this->input->post('hargak');

				$stok = $this->input->post('stok');
			} else {

				$harga = 0;

				$hargak = 0;

				$stok = 0;
			}



			////=============================rev23





			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));

			///////////////PROSES UPLOaD GAMBAR



			if ($this->session->userdata('login') == TRUE) {



				$this->load->library('upload');

				$nmfile = "image_" . time(); //nama file saya beri nama langsung dan diikuti fungsi time

				$image_path = realpath(APPPATH . '../upload/barang');

				//$config['upload_path'] = './upload/poto_asli/'; //path folder anpa di kurangi

				//$config['upload_path'] = './upload/barang/'; //path folder anpa di kurangi
				$config['upload_path'] = $image_path; //path folder anpa di kurangi

				$config['allowed_types'] = 'gif|jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

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

						$config2['width'] = 200; //lebar setelah resize menjadi 100 px

						$config2['height'] = 200; //lebar setelah resize menjadi 100 px



						$this->load->library('image_lib', $config2);

						//dibawah ini merupakan code untuk resize



						//pesan yang muncul jika resize error dimasukkan pada session flashdata

						if (!$this->image_lib->resize()) {

							$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
						}
						$gbr1 = $this->upload->data();

						//pesan yang muncul jika berhasil diupload pada session flashdata

						//////////proses tempel kata E-Retail

						$config["manipulation"]['source_image'] = $gbr1['full_path'];

						$this->load->library('image_lib', $config["manipulation"]);

						$config["manipulation"]['wm_text'] = 'E-Retail';

						$config["manipulation"]['wm_type'] = 'text';

						$config["manipulation"]['wm_font_size'] = '16';

						$config["manipulation"]['wm_font_color'] = '#17461e';

						$config["manipulation"]['wm_vrt_alignment'] = 'bottom';

						$config["manipulation"]['wm_hor_alignment'] = 'center';

						$this->image_lib->initialize($config["manipulation"]);

						$this->image_lib->watermark();



						///sukses

						//////////NYIMPAN DATA KE DB

						$datadb = array(

							'nama' => $this->input->post('nama'),

							'id_k' => $id_k,

							'gambar' => $gbr1['file_name'],

							'id_user' => $this->session->userdata('id_user'),

							'stok' => $stok,

							'satuan' => $this->input->post('satuan'),

							'harga' => $harga,

							'status' => 0, ///////terbaru harus di filter dulu

							'hargak' => $hargak,



							'deskripsi' => $this->input->post('deskripsi'),

							'tanggal' => $tanggal . ' ' . $waktu,

						);

						$this->Muser->simpan_tambah_data($datadb);

						$this->session->set_flashdata('pesan', 'data berhasil di simpan .');

						///	

						//////////NYIMPAN DATA KE DB	

						//////////////NOTIVIKASI EMAIL
						///emaiL

						///sukses

						//$this->session->set_flashdata("pesan", "data berhasil di simpan");

						$this->session->set_flashdata("pesan", "Data Berhasil disimpan, <br />Produk dalam proses verifikasi.

    		");

						///hapus file asli



						//

						$idp = $this->Madmin->get_produk_byid_last();

						redirect('C_user_admin/rinciproduk/' . $idp);
					} else {



						$this->session->set_flashdata('pesan0', ' Maaf, data Gagal di simpan .');

						redirect('C_user_admin/addproduk');
					}
				} else { ///gamabr

					$datadb = array(

						'nama' => $this->input->post('nama'),

						'id_k' => $id_k,

						'id_user' => $this->session->userdata('id_user'),

						'satuan' => $this->input->post('satuan'),

						'stok' => $stok,

						'harga' => $harga,

						'hargak' => $hargak,

						'deskripsi' => $this->input->post('deskripsi'),

						'tanggal' => $tanggal . ' ' . $waktu,

					);

					//$this->Muser->simpan_tambah_data($datadb);

					//$this->session->set_flashdata('pesan','data berhasil di simpan, Namun Foto Masih Kosong.');

					$this->session->set_flashdata('pesan0', 'Maaf Gambar Masih Kosong.');



					redirect('C_user_admin/addproduk');
				}
			} else { ///cek login

				redirect('login');
			}
		} ///idk

		redirect('C_user_admin/addproduk');
	} //funcitionpublic 

	//==============================================================================================================================



	//==============================================================================================================================

	function proses_simpan_editfoto_data()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			$this->load->library('upload');

			$nmfile = "image_" . time(); //nama file saya beri nama langsung dan diikuti fungsi time

			$config['upload_path'] = './upload/poto_asli'; //path folder

			$config['allowed_types'] = 'gif|jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

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

					$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

					$hm = $h * 60;

					$ms = $hm * 60;

					$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

					$waktu = gmdate("H:i:s", time() + ($ms));

					$datadb = array(

						'img' => $gbr['file_name'],

					);

					$this->Muser->simpan_ditprof_data($datadb);

					///

					$config2['image_library'] = 'gd2';

					$config2['source_image'] = $this->upload->upload_path . $this->upload->file_name;

					$config2['new_image'] = './upload/profil/'; // folder tempat menyimpan hasil resize

					$config2['width'] = 150; //lebar setelah resize menjadi 100 px

					$config2['height'] = 150; //lebar setelah resize menjadi 100 px

					$config2['maintain_ratio'] = TRUE;

					$this->load->library('image_lib', $config2);

					///=================penting

					if (!$this->image_lib->resize()) {

						$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
					}

					///sukses

					$this->session->set_flashdata("pesan", "Foto Profil Berhasil Diperbaharui");

					//

					redirect('User_admin/');
				} else { ///gamabr

					$this->session->set_flashdata('pesan', ' Maaf, Coba sekali lagi .');

					redirect('User_admin');
				}
			} else { ///gamabr

				$this->session->set_flashdata('pesan', ' Maaf, Gambar Belum Di isi .');

				redirect('User_admin/');
			}
		} else { ///cek login

			redirect('login');
		}
	}



	function proses_simpan_editproduk_data($id)

	{



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		///uplooad gambar

		if ($this->session->userdata('login') == TRUE) {

			$this->load->library('upload');

			$nmfile = "image_" . time(); //nama file saya beri nama langsung dan diikuti fungsi time

			$config['upload_path'] = './upload/barang/'; //path folder

			$config['allowed_types'] = 'gif|jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

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



					///prossess maxmin

					$config2['image_library'] = 'gd2';

					$config2['source_image'] = $this->upload->upload_path . $this->upload->file_name;

					// $config2['new_image'] = './upload/barang/'; // folder tempat menyimpan hasil resize

					$config2['maintain_ratio'] = TRUE;

					$config2['width'] = 200; //lebar setelah resize menjadi 100 px

					$config2['height'] = 200; //lebar setelah resize menjadi 100 px

					$this->load->library('image_lib', $config2);

					///=================penting

					if (!$this->image_lib->resize()) {

						$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
					}

					//////////proses tempel kata E-Retail

					$config["manipulation"]['source_image'] = $gbr['full_path'];

					$this->load->library('image_lib', $config["manipulation"]);

					$config["manipulation"]['wm_text'] = 'E-Retail';

					$config["manipulation"]['wm_type'] = 'text';

					$config["manipulation"]['wm_font_size'] = '16';

					$config["manipulation"]['wm_font_color'] = '#17461e';

					$config["manipulation"]['wm_vrt_alignment'] = 'bottom';

					$config["manipulation"]['wm_hor_alignment'] = 'center';

					$this->image_lib->initialize($config["manipulation"]);

					$this->image_lib->watermark();



					///sukses

					$datadb = array(

						'gambar' => $gbr['file_name'],

					);

					$this->Muser->simpan_ditproduk_data($datadb, $id);

					$this->session->set_flashdata("pesan", "Foto Produk Berhasil Diperbaharui");

					//

					redirect('C_user_admin/rinciproduk/' . $id);
				} else { ///gamabr

					$this->session->set_flashdata('pesan0', ' Maaf, Coba sekali lagi .');

					redirect('C_user_admin/rinciproduk/' . $id);
				}
			} else { ///gamabr

				$this->session->set_flashdata('pesan', ' Maaf, Gambar Belum Di isi .');

				redirect('C_user_admin/rinciproduk/' . $id);
			}
		} else { ///cek login

			redirect('login');
		}
	} //funcition

	////===========================================OTORIASAI PRODUK

	////////////20180501
	function dafprd_kategori($id_k = 1)
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			$data = $data = $this->Muser->getDataProfil();
			$data['id_k'] = $id_k;

			if ($id_k != NULL) {

				$data['in'] = 'in';
			} else {

				$data['in'] = '';
			}

			$data['b'] = 'active';

			///

			$data['view'] = 'pages/admin/viewer/produk/rincikat_produk';

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

	public function barang_idtransaksi($id = 0)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			$this->load->model('M_dompetKu');

			$data = $data = $this->Muser->getDataProfil();

			$data['d'] = 'active';
			$data['id'] = $id;

			///

			$data['view'] = 'pages/admin/viewer/produkDipesan/rinci_produk_idtranskasi.php';



			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}
}//class
