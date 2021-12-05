<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Controllernya_prayudi extends CI_Controller
{



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Si

	 * nce this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com/

	 *,

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */



	function __construct()
	{

		parent::__construct();
	}

	function index()
	{
		$this->load->view('masterpra/cek');
	}



	function simpan_set_info()

	{

		$u = array(

			'isi_info' => $this->input->post('informasi')

		);

		$this->Modelnya_prayudi->update_info($u);

		redirect('user_admin');
	}

	function coba_upload()
	{



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

				//$config['upload_path'] = './upload/poto_asli/'; //path folder anpa di kurangi

				$config['upload_path'] = 'http://static.jualretail.com/upload/barang/'; //path folder anpa di kurangi

				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan

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

							'tanggal' => $tanggal,

						);

						$this->Muser->simpan_tambah_data($datadb);

						$this->session->set_flashdata('pesan', 'data berhasil di simpan .');

						///	

						//////////NYIMPAN DATA KE DB	

						//////////////NOTIVIKASI EMAIL

						$isinot = '

    	<p>Produk yang Anda jual dalam proses verifikasi, </p><br/>

    	

    	<p>mohon tunggu notifikasi dari kami</p><br/>

		';



						$isinotad = '<p>ADA PRODUK BARU YANG SUDAH MASUK ,,, SEDANG MENUNGGU VERIFIKASI DARI ADMIN</p>

		';

						///emaiL

						///////////NOTIVIKASI EMAIL ke ADMIN

						$id_user = $this->session->userdata('id_user');

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



						$ci->email->to('masterpra2002@gmail.com', 'suryopratolo@gmail.com'); ///ke email pembeli

						$ci->email->bcc('E-Retail@jualretail.com');

						$ci->email->subject('Notifikasi Produk Baru - [E-Retail]');

						$ci->email->message($isinotad);

						//$ci->email->attach(base_url('pdf/test.pdf'));

						$this->email->send(); ///////////NOTIVIKASI EMAIL



						//////////////notifikasi email 21/3/17 ke //penjual

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

						$ci->email->subject('Notifikasi Produk Baru - [E-Retail]');

						$ci->email->message($isinot);

						//$ci->email->attach(base_url('pdf/test.pdf'));

						$this->email->send(); ///////////NOTIVIKASI EMAIL







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

						'tanggal' => $tanggal,

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

		//redirect ('C_user_admin/addproduk');




		redirect('controllernya_prayudi');
	}
}//class
