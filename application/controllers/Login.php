<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model("M_applog");
	}

	public function index()

	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';

		if ($this->session->userdata('login') == true) {
			if ($this->session->userdata('wewenang') == 'admin') {
				redirect('User_admin'); //jika m-admin
			} else {
				redirect('C_loadFirst'); //pemerikasasan sistem
			}
		}

		//cek batas pendaftar baru=50
		$cek = $this->Modelnya_prayudi->jumlah_pendaftar_baru_belum_acc();
		if ($cek->num_rows() < 51) {

			$data['view'] = 'pages/examples/form_login';
		} else {

			$data['view'] = 'pages/examples/form_login_for_blokir'; //DIGUNAKAN SAAT PEMBLOKIRAN WEB
		}

		$data['view'] = 'pages/examples/form_login';
		$this->load->view('pages/examples/login', $data);
	}

	public function daftar()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';

		////////////////////201807
		$pro = 1;
		if (isset($_GET['pro'])) {
			$pro = $_GET['pro'];
		}
		$data['pro'] = $pro;

		$data['view'] = 'pages/examples/form_daftar';
		$this->load->view('pages/examples/login', $data);
	}

	function proses()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));
		$xxx = substr($tanggal, '6', '4');
		$xx = substr($tanggal, '3', '2');
		$x = substr($tanggal, '0', '2');
		$hjamx = substr($waktu, '0', '2');

		if ($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->Login_model->check_user($username, $password) == TRUE) {

				if ($this->Login_model->check_user2($username, $password) == TRUE) {

					$q = $this->Login_model->get_id_pass($username, $password);
					$q1 = $q->row();
					$newdata = array(
						'username' => $username,
						//'password' => $password,
						'wewenang' => $q1->wewenang,
						'id_user' => $q1->idlog,
						'ni' => $q1->ni,
						'status_job' => $q1->job,
						'login' => TRUE
					);
					$this->session->set_userdata($newdata);
					//
					////SAVE

					$this->save_log($q1->idlog, 'Login');


					///SAVE

					if ($q1->idlog == 1 and $q1->username == $username and $q1->password == $password and $q1->wewenang == 'admin') {
						redirect('Master_admin');
					} elseif ($q1->wewenang == 'user') {
						// redirect('C_dompet/dompet');
						setcookie('Clogin', true, time() + (30 * 30), '/'); //86400 * 30 = 1hari
						// $this->send_email('login');
						redirect('C_loadFirst'); //pemerikasasan sistem
						// redirect('C_setvoc/setdompet/'.$q1->idlog.'/'.$q1->job);
					} else { ////pilihnnuser
						$this->session->set_flashdata('pesan', 'Maaf, username atau password Anda tidak terdaftar');
						redirect('Login');
					}
				} else { ///cek model ueu_tbl_user  jika status tidak 1

					$this->session->set_flashdata('pesan', 'Akun anda Masih dalam proses,<br/> mohon ditunggu');
					redirect('Login');
				}
			} else { ///cek model ueu_tbl_user no status 

				$this->session->set_flashdata('pesan', 'Maaf, username atau password Anda tidak terdaftar');
				redirect('Login');
			}
		} else { ///falidasi

			$this->session->set_flashdata('pesan', 'Maaf, username atau password Anda salah');
			redirect('');
		}
	}



	public function logout()
	{

		$id_user = $this->session->userdata('id_user');

		$this->save_log($id_user, 'Logout');

		$this->session->sess_destroy();
		$this->session->set_userdata('login', FALSE);
		$this->session->set_userdata('master_login', FALSE);
		$this->session->set_flashdata('pesan', 'Anda telah berhasil logout');

		redirect('Welcome');
	}

	public function logout_paksa()
	{

		$id_user = $this->session->userdata('id_user');

		$this->save_log($id_user, 'Logout');

		$this->session->sess_destroy();
		$this->session->set_userdata('login', FALSE);
		$this->session->set_userdata('master_login', FALSE);
		$this->session->set_flashdata('pesan', $_GET['s']);

		redirect('login');
	}



	function daftar_simpan_ssl()
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
		$config['upload_path'] = './upload/nbm/'; //path folder anpa di kurangi
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '0'; //maksimum besar file 2M
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

				///data
				$job = $this->input->post('job');
				if ($job == 3) {
					$ni = $this->input->post('ni');
				} else {
					$ni = $this->input->post('ni');
				}

				$data = array(

					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'nbm' => $this->input->post('nbm'),
					//REV 2
					'job' => $job,
					'ni' => $ni,

					//REV 2
					'no_kontak' => $this->input->post('no'),
					'rek' => $this->input->post('rek'),
					'bank' => strtoupper($this->input->post('bank')),
					'status' => 0,
					'alamat' => $this->input->post('alamat'),
					'password' => $this->input->post('pass'),
					'jenis_kelamin' => $this->input->post('jenis'),
					'wewenang' => 'user',
					'tanggal' => $tanggal . ' ' . $waktu,
					'file_nbm' => $gbr['file_name'],
					'ranting' => $this->input->post('ranting'),
					'cabang' => $this->input->post('cabang'),
					'daerah' => $this->input->post('daerah'),
					'setuju' => 1, //$this->input->post('setuju'),

					///rev 20180418

					'kode_prodi' => $this->input->post('prodi'),
				);

				$isinot = '<p>Terimakasih sudah mendaftar ,</p>
		<br/><p>mohon tunggu notifikasi dari Admin</p><br/>
        
        Terimaksih.
         ';

				$isinotad = '<p>Akun baru telah mendaftar. <br/>Sedang menunggu verifikasi dari admin</p>';

				$cekuser = $this->Login_model->check_user($this->input->post('username'), $this->input->post('pass'));
				$cekuser_saja = $this->Login_model->check_user_saja($this->input->post('username'));
				$cekusernopass = $this->Login_model->check_user_nopass($this->input->post('pass'));
				$cekusernonama = $this->Login_model->check_user_nama($this->input->post('nama'));

				if ($cekuser_saja == TRUE or $cekusernopass == TRUE or $cekusernonama == TRUE) {
					$this->session->set_flashdata('pesandaftar', 'Maaf ,<br/>Nama/Email/Password/  yang anda gunakan sudah terdaftar');
					redirect("Login/daftar");
				} else {
					////SAVE
					$this->Login_model->simpan_daftar($data);

					$this->session->set_flashdata('pesandaftars', 'Terimakasih sudah mendaftar, mohon tunggu notifikasi selanjutnya dari admin');

					redirect("Login/daftar?pro=4");
				}
			} else { ///gbr tdk sesuai
				$this->session->set_flashdata('pesandaftar', 'Mohon Maaf data gagal dikirim, <br/> mohon periksa lagi gambar anda.');
				redirect("Login/daftar");
			}
		} else {
			$this->session->set_flashdata('pesandaftar', 'Mohon Maaf data gagal dikirim, <br/> mohon masukkan gambar.');
			redirect("Login/daftar");
		}
	}


	function update_bio($id)
	{
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate("H:i:s", time() + ($ms));
		///upload file
		$this->load->library('upload');
		$nmfile = "image_" . time(); //nama file saya beri nama langsung dan diikuti fungsi time
		//$config['upload_path'] = './upload/poto_asli/'; //path folder anpa di kurangi
		$config['upload_path'] = './upload/nbm/'; //path folder anpa di kurangi
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



				$config2['width'] = 600; //lebar setelah resize menjadi 100 px



				$config2['height'] = 350; //lebar setelah resize menjadi 100 px







				$this->load->library('image_lib', $config2);



				//dibawah ini merupakan code untuk resize







				//pesan yang muncul jika resize error dimasukkan pada session flashdata



				if (!$this->image_lib->resize()) {



					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
				}
			}
		}







		$data = array(



			'nama' => $this->input->post('nama'),



			'rek' => $this->input->post('rek'),



			'bank' => $this->input->post('bank'),



			'nbm' => $this->input->post('nbm'),



			'bank' => strtoupper($this->input->post('bank')),



			'jenis_kelamin' => $this->input->post('jenis'),



			'no_kontak' => $this->input->post('no'),



			'alamat' => $this->input->post('alamat'),



			'tanggal_edit' => $tanggal,



			//'file_nbm'=>$gbr['file_name'],



			'ranting' => $this->input->post('ranting'),



			'cabang' => $this->input->post('cabang'),



			'daerah' => $this->input->post('daerah'),



			'job' => $this->input->post('job'),

			// 'ni' => $this->input->post('ni'),
			'kode_prodi' => $this->input->post('prodi'),



		);



		$this->Login_model->simpan_edt_bio($data, $id);



		$this->session->set_flashdata('pesan', 'Data sudah di perbaharui');



		redirect("User_admin");
	}







	///file update()



	function update_bio_file($id)
	{

		///upload file
		$this->load->library('upload');
		$nmfile = "image_" . time(); //nama file saya beri nama langsung dan diikuti fungsi time

		//$config['upload_path'] = './upload/poto_asli/'; //path folder anpa di kurangi
		$config['upload_path'] = './upload/nbm/'; //path folder anpa di kurangi
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '0'; //maksimum besar file 2M
		//$config['max_width']  = '1288'; //lebar maksimum 1288 px
		//$config['max_height']  = '768'; //tinggi maksimu 768 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya
		$config['max_filename'] = 200;
		$this->upload->initialize($config);
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
			}
		}

		$data = array(
			'file_nbm' => $gbr['file_name'],
		);

		$this->Login_model->simpan_edt_bio($data, $id);
		$this->Login_model->simpan_revData($id, 2, 'Rev FILE NBM');
		$this->session->set_flashdata('pesan', 'Data sudah di perbaharui');
		redirect("User_admin");
	}







	function update_pass($id)
	{



		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -



		$hm = $h * 60;



		$ms = $hm * 60;



		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.



		$waktu = gmdate("H:i:s", time() + ($ms));



		$data = array(



			'username' => $this->input->post('username'),



			'password' => $this->input->post('password'),



			'tanggal_edit' => $tanggal,



		);







		$cekuser = $this->Login_model->check_user($this->input->post('username'), $this->input->post('password'));



		$check_user_saja_nosaya = $this->Login_model->check_user_saja($this->input->post('username'));



		$check_user_saja_nosaya_pass = $this->Login_model->check_user_nopass($this->input->post('password'));



		$cekuser_saja_up = $this->Login_model->check_user_saja_nosaya($this->input->post('username'), $this->input->post('password'), $id);



		if ($cekuser == TRUE or $check_user_saja_nosaya_pass == TRUE) {



			$this->session->set_flashdata('pesan', 'gagal, Mohon coba lagi');



			redirect("User_admin");
		} else {



			$this->Login_model->simpan_edt_bio($data, $id);







			$this->session->set_userdata('login', FALSE);



			$this->session->set_userdata('master_login', FALSE);



			$this->session->sess_destroy();







			$this->session->set_flashdata('pesan', 'Silahkan Login kembali');



			redirect("Login");
		}
	}







	function reset_l0gin()
	{



		$this->session->set_userdata('login', FALSE);



		$this->session->set_userdata('master_login', FALSE);



		$this->session->sess_destroy();



		redirect("Welcome/allkategori");
	}

	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	function save_log($id_user = 0, $ket = null)
	{
		$tgl = $this->M_time->harinow();
		$tgl_t = $this->M_time->thnblntgl();

		$svlog = [

			'ip_addres' => $this->getRealIpAddr(),
			'id_user' => $id_user,
			'user' => $_SERVER['HTTP_USER_AGENT'],
			'file' => $_SERVER['PATH_TRANSLATED'],
			'url' => $_SERVER['HTTP_REFERER'],
			'ket' => $ket,
			'__ci' => $this->session->userdata('__ci_last_regenerate'),


		];

		$d = $tgl . " - id_user : " . $svlog['id_user'] . " - user : " . $svlog['user'] . " - file : " . $svlog['file'] . " - url : " . $svlog['url'] . " - ket : " . $svlog['ket'] . " - __ci : " . $svlog['__ci'] . "\r\n";
		$file_path = "log/logLogin_" . $tgl_t . ".txt";
		$file_handle = fopen($file_path, 'a+');
		// $d.='<kelas > ilham </kelas>';
		if ($file_handle == TRUE) {
			fwrite($file_handle, $d);
		}

		fclose($file_handle);

		// $this->M_applog->save_log($svlog);

	}
	
	public function cek(Type $var = null)
	{
		
	}
} //class
