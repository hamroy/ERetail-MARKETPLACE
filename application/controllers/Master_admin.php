<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master_admin extends CI_Controller
{

	var $thn_c;

	function __construct()
	{

		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->model('M_vparsel');
		$this->load->model('M_dompetall');
		$this->load->model('M_belanja');
		$this->load->model('Mmahasiswa');
		$this->load->model('M_rProduk');

		$this->load->library('Pdf');
		$thn_c = $this->M_time->thn();
		$this->thn_c = $thn_c;
	}

	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PENJUAL

	public function index()

	{

		redirect('Master_admin/list_penjual');
	}

	public function list_penjual($cari = NULL, $ak = 1)

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

			$data['ak'] = $ak;



			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///



			$data['view'] = 'pages/master_admin/penjual/daftar_penjual';



			///



			//revisi ilham pagination

			$get_all_id_produk = $this->Madmin_master->get_all_Penjual($ak);
			$get_all_id_produk_all = $this->Madmin_master->get_all_akun_all($ak);



			$config['base_url'] = base_url('Master_admin/list_penjual/');

			$data['total_rows'] = $config['total_rows'] = $get_all_id_produk->num_rows();
			$data['total_rows_all'] = $get_all_id_produk_all->num_rows();



			$config['per_page'] = 20; /*Jumlah data yang dipanggil perhalaman*/

			$config['uri_segment'] = 3; /*data selanjutnya di parse diurisegmen 3*/

			$choice = $config['total_rows'] / $config['per_page'] = 20;

			//$config['num_links'] = round($choice);
			$config['num_links'] = 10;

			/*Class bootstrap pagination yang digunakan*/

			$config['full_tag_open'] = "<ul class='pagination center' style='position:relative; top:-25px;'>";

			$config['full_tag_close'] = "</ul>";

			$config['num_tag_open'] = '<li>';

			$config['num_tag_close'] = '</li>';

			if ($cari == 'cari') {

				$config['cur_tag_open'] = "<li><li><a href='" . base_url('Master_admin/list_penjual') . "'>";
			} else {

				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			}



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

			if ($cari == 'cari') {
				$dcr = $this->input->post('cari');
				$data['dari'] = 3;
				$dari = 0;
				$data['q'] = $this->Madmin_master->get_all_Penjual_pag_cari_2($dcr, $config['per_page'], $dari);

				$data['halaman'] = '';
			} elseif ($cari == 'ga') {
				$data['dari'] = $dari = $this->uri->segment(5);
				$data['q'] = $this->Madmin_master->get_all_Penjual_pag($ak, $config['per_page'], $dari);

				$data['halaman'] = $this->pagination->create_links();
			} else {
				$data['dari'] = $dari = $this->uri->segment(3);
				$data['q'] = $this->Madmin_master->get_all_Penjual_pag($ak, $config['per_page'], $dari);

				$data['halaman'] = $this->pagination->create_links();
			}



			///////////



			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function list_penjual_tolak()

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



			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///



			$data['view'] = 'pages/master_admin/penjual/daftar_penjual_ditolak';



			///





			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PENJUAL

	public function transaksi_belanja()

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



			$data['view'] = 'pages/master_admin/riwayat_belanjaall';

			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///
			//revisi ilham pagination

			//   $nmrows=$this->M_belanja->get_listPembeli();

			//   $config['base_url'] = base_url('Master_admin/transaksi_belanja/');

			//   $data['total_rows']=$config['total_rows'] = $nmrows->num_rows();

			//   $config['per_page'] = 20; /*Jumlah data yang dipanggil perhalaman*/
			//   $config['uri_segment'] = 3; /*data selanjutnya di parse diurisegmen 3*/
			//   $config['num_links'] = 10;
			//   /*Class bootstrap pagination yang digunakan*/

			//   $config['full_tag_open'] = "<ul class='pagination center' style='position:relative; top:-25px;'>";

			//   $config['full_tag_close'] ="</ul>";

			//   $config['num_tag_open'] = '<li>';

			//   $config['num_tag_close'] = '</li>';
			//   $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";

			//   $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

			//   $config['next_tag_open'] = "<li>";

			//   $config['next_tagl_close'] = "</li>";

			//   $config['prev_tag_open'] = "<li>";

			//   $config['prev_tagl_close'] = "</li>";

			//   $config['first_tag_open'] = "<li>";

			//   $config['first_tagl_close'] = "</li>";

			//   $config['last_tag_open'] = "<li>";

			//   $config['last_tagl_close'] = "</li>";

			//   $this->pagination->initialize($config);
			//      //////////

			// $dari= $this->uri->segment(3);	
			$data['dari'] = 0;
			$this->load->model('M_rekapPenjualan');
			$data['get_all_id_produk'] = $this->M_belanja->get_listPembeli_pag(0, 0);

			// $data['halaman'] = $this->pagination->create_links();
			$data['halaman'] = '';
			///

			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PENJUAL

	public function transaksi_penjualan()

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

			$data['view'] = 'pages/master_admin/riwayat_transaksi_penjualanl';

			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///

			$this->load->model('M_rekapPenjualan');

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PENJUAL

	public function daftar_Saldo_voucer()

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

			$data['view'] = 'pages/master_admin/daftar_saldo_voc';

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





	public function daftar_produk_penjual($id)

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

			$data['id_user'] = $id;

			$data['view'] = 'pages/master_admin/daftar_produk_penjual';

			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///

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
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PRMBELi

	public function daftar_pembeli($urut = 0, $sortir = 0)

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

			$data['view'] = 'pages/master_admin/daftar_pembeli';

			///

			$data['urut'] = $urut;

			$data['sortir'] = $sortir;

			$data['g'] = 'active';

			$data['f'] = $data['a'] = $data['b'] = $data['h'] = $data['i'] = '';

			$data['c'] = $data['d'] = $data['j'] = $data['k'] = '';

			///
			//revisi ilham pagination

			$nmrows = $this->Madmin_master->get_all_pembeli($urut, $sortir, 0, 0, 'tot');

			$config['base_url'] = base_url('Master_admin/daftar_pembeli/' . $urut . '/' . $sortir);

			$data['total_rows'] = $config['total_rows'] = $nmrows->num_rows();

			$config['per_page'] = 20; /*Jumlah data yang dipanggil perhalaman*/
			$config['uri_segment'] = 5; /*data selanjutnya di parse diurisegmen 3*/
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

			$data['dari'] = $dari = $this->uri->segment(5);

			$data['get_all_id_produk'] =
				$get_all_id_produk = $this->Madmin_master->get_all_pembeli($urut, $sortir, $config['per_page'], $dari, 'pag');

			$data['halaman'] = $this->pagination->create_links();
			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}





	////daftar produk pembeli

	public function daftar_pembeli_produk($id)

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

			$data['id_pembeli'] = $id;

			$data['view'] = 'pages/master_admin/daftar_pembeli_produk';

			///

			$data['g'] = 'active';

			$data['f'] = $data['a'] = $data['b'] = $data['h'] = $data['i'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['j'] = '';

			///

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	/////]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]Daftar PRODUK

	public function daftar_produk($id_k = 1)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$data = $this->Muser->getDataProfil();

			$data['view'] = 'pages/master_admin/daftar_produk';

			///

			$data['id_k'] = $id_k;

			$data['h'] = 'active';

			///

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

			//dropdown jenis voc
			$data['gtjen'] = $gtjen = $this->M_vparsel->get_jenis_voc();
			if ($gtjen->num_rows() > 0) {
				// $jenvoc= array('0'=>'---Pilih---');
				foreach ($gtjen->result() as $je) {
					$jenvoc2[$je->id_jen_voc] = $je->nama_jvoc;
				}
				//$data['jenvoc']=array_merge($jenvoc,$jenvoc2); ///join array
				$data['jenvoc'] = $jenvoc2; ///join array
			} //



			//////paginatijn

			//revisi ilham pagination

			$get_all_id_produk = $this->Madmin_master->get_all_produk($id_k);



			$config['base_url'] = base_url('Master_admin/daftar_produk/' . $id_k . '/');

			$data['total_rows'] = $config['total_rows'] = $get_all_id_produk->num_rows();



			$config['per_page'] = 20; /*Jumlah data yang dipanggil perhalaman*/

			$config['uri_segment'] = 4; /*data selanjutnya di parse diurisegmen 3*/

			$choice = $config['total_rows'] / $config['per_page'] = 20;

			$config['num_links'] = 10;

			/*Class bootstrap pagination yang digunakan*/

			$config['full_tag_open'] = "<ul class='pagination' style='position:relative; top:-25px;'>";

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

			$data['dari'] = $dari = $this->uri->segment('4');



			$this->pagination->initialize($config);

			$data['halaman'] = $this->pagination->create_links();



			$data['q'] = $this->Madmin_master->get_all_produk_pag($id_k, $config['per_page'], $dari);

			//	$data['q'] = $this->Madmin_master->get_all_produk($id_k);

			/*

   	//////////

   	if($cari!='cari'){

	$data['q'] = $this->Madmin_master->get_all_Penjual_pag($ak,$config['per_page'],$dari);	

	}else{

	$dcr=$this->input->post('cari');

	$data['q'] = $this->Madmin_master->get_all_Penjual_pag_cari($ak,$dcr,$config['per_page'],$dari);	

	}

	

	/////////// */

			//////paginatijn

			//

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function daftar_produk_cari()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$data = $this->Muser->getDataProfil();
			$data['view'] = 'pages/master_admin/daftar_produk_cari';

			///
			$data['h'] = 'active';
			///

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
			//dropdown jenis voc
			$data['gtjen'] = $gtjen = $this->M_vparsel->get_jenis_voc();
			if ($gtjen->num_rows() > 0) {
				$jenvoc = array('0' => '---Pilih---');
				foreach ($gtjen->result() as $je) {
					$jenvoc2[$je->id_jen_voc] = $je->nama_jvoc;
				}
				$data['jenvoc'] = array_merge($jenvoc, $jenvoc2); ///join array
			} //





			$dc = $this->input->post('cari');

			if (empty($dc)) {

				$dtc = 'kosong';
			} else {

				$dtc = $dc;
			}

			$data['q'] = $this->Madmin_master->get_all_produk_cari($dtc);



			//

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function daftar_produk_tolak()

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

			$data['view'] = 'pages/master_admin/produk/daftar_produk_tolak';

			///

			$data['h'] = 'active';

			$data['g'] = $data['f'] = $data['a'] = $data['b'] = $data['i'] = '';

			$data['c'] = $data['d'] = $data['j'] = $data['k'] = '';

			///

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





			$dc = $this->input->post('cari');

			if (empty($dc)) {

				$dtc = 'kosong';
			} else {

				$dtc = $dc;
			}

			$data['q'] = $this->Madmin_master->get_all_produk_cari($dtc);



			//

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function daftar_produk_blok()

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

			$data['view'] = 'pages/master_admin/produk/daftar_produk_blok';

			///

			$data['h'] = 'active';

			$data['g'] = $data['f'] = $data['a'] = $data['b'] = $data['i'] = '';

			$data['c'] = $data['d'] = $data['j'] = $data['k'] = '';

			///

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





			$dc = $this->input->post('cari');

			if (empty($dc)) {

				$dtc = 'kosong';
			} else {

				$dtc = $dc;
			}

			$data['q'] = $this->Madmin_master->get_all_produk_cari($dtc);



			//

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	///////////////////////list_penerima_voucher

	public function list_penerima_voucher()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$data = $this->Muser->getDataProfil();
			$data['view'] = 'pages/master_admin/dompet/daftar_penerima_voucher';

			///
			$data['v'] = 'active';
			$data['v1_a'] = 'active';
			///
			$dvo = '';
			if (isset($_GET['vo'])) {
				$dvo = $_GET['vo'];
			}
			$statusP = '';
			if (isset($_GET['job'])) {
				$statusP = $_GET['job'];
			}
			$statprodi = '';
			if (isset($_GET['prodi'])) {
				$statprodi = $_GET['prodi'];
			}
			$Evoc = '';
			if (isset($_GET['Evoc'])) {
				$Evoc = $_GET['Evoc'];
			}
			//

			$data['dvo'] = $dvo;
			$data['statusP'] = $statusP;
			$data['statprodi'] = $statprodi;
			$data['Evoc'] = $Evoc;
			//

			$this->load->view('pages/admin/beranda', $data);
		} else {
			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
			redirect('Login');
		}
	}



	///////////////////////list_penerima_voucher_bonus

	public function list_penerima_voucher_bonus()

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

			$data['view'] = 'pages/master_admin/dompet/daftar_penerima_voucher_bonus';

			///

			$data['v'] = 'active';

			$data['h'] = '';

			$data['g'] = $data['f'] = $data['a'] = $data['b'] = $data['i'] = '';

			$data['c'] = $data['d'] = $data['j'] = $data['k'] = '';

			///







			$dc = $this->input->post('cari');

			if (empty($dc)) {

				$dtc = 'kosong';
			} else {

				$dtc = $dc;
			}

			$data['q'] = $this->Madmin_master->get_all_produk_cari($dtc);



			//

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function list_penerima_voucher_tolak()

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

			$data['view'] = 'pages/master_admin/dompet/daftar_penerima_voucher_tolak';

			///

			$data['v'] = 'active';
			$data['v1_b'] = 'active';

			$data['h'] = '';

			$data['g'] = $data['f'] = $data['a'] = $data['b'] = $data['i'] = '';

			$data['c'] = $data['d'] = $data['j'] = $data['k'] = '';

			$dvo = 1;
			if (isset($_GET['vo'])) {
				$dvo = $_GET['vo'];
			}
			$data['dvo'] = $dvo;

			///

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





			$dc = $this->input->post('cari');

			if (empty($dc)) {

				$dtc = 'kosong';
			} else {

				$dtc = $dc;
			}

			$data['q'] = $this->Madmin_master->get_all_produk_cari($dtc);



			//

			$this->load->view('pages/admin/beranda', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	////[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[TRANSAKSI ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function transaksi($bln = 1, $thn = NULL, $sort = 'b1', $sort2 = 1)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {



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

			$data['b'] = $data['d'] = $data['j'] = $data['k'] = '';

			$data['i'] = 'active';

			$data['sort'] = $sort;

			$data['sort2'] = $sort2;

			///
			if ($bln > 12) {
				$bln = 12;
			}

			///
			$stget = '';
			if (isset($_GET['st'])) {
				$stget = $_GET['st'];
			}
			$data['stget'] = $stget;
			///

			$data['bln'] = $bln;
			$data['thn'] = $thn;

			///
			//////////////20180125
			if ($sort2 == 1) {
				$data['view'] = 'pages/master_admin/info/rincitransaksi_produk';
			} else {
				$data['view'] = 'pages/master_admin/info/rincitransaksi_produk_status';
			}
			///REV
			$data['blnaray'] =
				$blnaray = array(
					'01' => 'Januari',
					'1' => 'Januari',
					'2' => 'Februari',
					'02' => 'Februari',
					'3' => 'Maret',
					'03' => 'Maret',
					'4' => 'April',
					'04' => 'April',
					'5' => 'Mei',
					'05' => 'Mei',
					'6' => 'Juni',
					'06' => 'Juni',
					'7' => 'Juli',
					'07' => 'Juli',
					'8' => 'Agustus',
					'08' => 'Agustus',
					'9' => 'September',
					'09' => 'September',
					10 => 'Oktober',
					'11' => 'November',
					'12' => 'Desember',
				);


			$data['totbln'] = $totbln = $this->Madmin_master->total_tanpa_sort($bln, $thn);
			///REV




			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}


	//[[[[[[[[[[[[[[[[[[[[[[[[produkdipesan_all (rev5317 ) ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function produkdipesan_all($v = 1, $sort = NULL)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {



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

			$data['b'] = $data['d'] = $data['j'] = $data['k'] = '';

			$data['i'] = '';

			$data['n'] = 'active';

			$data['sort'] = $sort;

			$data['v'] = $v;

			$data['act1'] = '';

			$data['act2'] = '';

			$data['act3'] = '';

			/////////////////



			switch ($v) {

				case '1': ///tunai

					$data['get_d'] = 'TUNAI';

					$data['isi'] = 'dipesan_all_tunai';

					$data['act1'] = 'style="background-color: #154e0a ;color: #ffffff"';

					break;

				case '2': ///voucher

					$data['get_d'] = 'VOUCHER';

					$data['isi'] = 'dipesan_all_tunai';

					$data['act2'] = 'style="background-color: #154e0a ;color: #ffffff"';

					break;

				case '3': ///transfer

					$data['get_d'] = 'TRANSFER';

					$data['isi'] = 'dipesan_all_tunai';

					$data['act3'] = 'style="background-color: #154e0a ;color: #ffffff"';

					break;

				default:

					$data['isi'] = 'dipesan_all_tunai';

					$data['get_d'] = 'TUNAI';

					$data['act1'] = 'style="background-color: #154e0a ;color: #ffffff"';

					break;
			}



			////////////////
			$this->load->model('M_produkDipesan');

			$data['view'] = 'pages/master_admin/produk_dipesan_all';



			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	////

	////[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[verifikasi ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function verifikasi()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$data = $this->Muser->getDataProfilPublik();
			///
			$data['j'] = 'active';
			///
			$data['view'] = 'pages/master_admin/verifikasi_produk';

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	////



	////[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[saran ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function saran()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {



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

			$data['b'] = $data['d'] = $data['i'] = '';

			$data['j'] = '';

			$data['k'] = 'active';

			///

			$data['view'] = 'pages/master_admin/saran_masuk';

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

	////



	////[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[forum ]]]]]] [rev5317]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

	public function forum()

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {



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

			$data['b'] = $data['d'] = $data['i'] = '';

			$data['j'] = '';

			$data['k'] = 'active';

			///

			$data['view'] = 'forum/awal';

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

	////

	//////////////////==================================================BLOCK



	function block_penjual($id, $up)
	{

		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}


		$d = array(

			'status' => $up,

		);

		$this->Madmin_master->block_penjual_model($id, $d);

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		///

		///////////NOTIVIKASI EMAIL

		$Emailto = $this->Muser->get_user_by_id($id)->row()->username;

		$pass = $this->Muser->get_user_by_id($id)->row()->password;



		if ($up == 1) {

			$isinot = '

		Selamat, <br/>

		Anda sudah dapat Login sebagai Penjual DI  E-Retail .<br/>

		dengan : <br/>

		Username : ' . $Emailto . '<br/>

		Password : ' . $pass . '<br/>

		

		<hr/>

		Untuk Login klik <a href="' . base_url('Login') . '">DISINI</a><br/>

		';
		} else {

			$isinot = '

		Mohon maaf, <br/>

		Anda tidak lagi memiliki akses Login sebagai Penjual DI  E-Retail .<br/>

		dengan : <br/>

		Username : ' . $Emailto . '<br/>

		Password : ' . $pass . '<br/>

		Karena : ' . $this->input->post('alasan') . '

		

		<hr/>

		';
		}



		//////////////notifikasi email 21/3/17

		$this->c_email();

		$this->mail->Body = '
            <html>
            <head>
            <title>E-Retail SUPERMALL</title>
            </head>
            <body>
            <h3>E-Retail SUPERMALL</h3>
            <hr />
            ' . $isinot . '<br>
            <p><hr /></p>
            <p><a href="E-Retail.com">E-Retail SUPERMALL<a/></p>
            </body>
            </html>
        ';
		// $Emailto='ilhamroyroy@gmail.com';
		$this->mail->AddAddress($Emailto);
		$this->mail->Send();


		///

		redirect('Master_admin');
	}



	//////////////////BLOV 5/4/17

	function terima_penjual($id)
	{

		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}


		$d = array(

			'status' => 1,

		);

		$this->Madmin_master->block_penjual_model($id, $d);

		///////////NOTIVIKASI EMAIL

		$Emailto = $this->Muser->get_user_by_id($id)->row()->username;

		$pass = $this->Muser->get_user_by_id($id)->row()->password;

		$isinot = '

		Selamat Anda Sudah Terdaftar Di E-Retail.<br/>

		Username : ' . $Emailto . '<br/>

		Password : ' . $pass . '<br/>

		

		

		<hr/>

		Untuk Login klik <a href="' . base_url('Login') . '">DISINI</a><br/>

		';

		//////////////notifikasi email 21/3/17

		$this->c_email();
		$this->mail->Body = '
            <html>
            <head>
            <title>E-Retail SUPERMALL</title>
            </head>
            <body>
            <h3>E-Retail SUPERMALL</h3>
            <hr />
            ' . $isinot . '<br>
            <p><hr /></p>
            <p><a href="E-Retail.com">E-Retail SUPERMALL<a/></p>
            </body>
            </html>
        ';
		// $Emailto='ilhamroyroy@gmail.com';
		$this->mail->AddAddress($Emailto);
		$this->mail->Send();
		///

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/verifikasi');
	}

	//////////////////BLOV 5/4/17

	function tolak_penjual($id)
	{
		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}

		$d = array(

			'status' => 3,

		);

		$this->Madmin_master->block_penjual_model($id, $d);

		///////////NOTIVIKASI EMAIL

		$Emailto = $this->Muser->get_user_by_id($id)->row()->username;

		$isinot = '

		Mohon Maaf, <br/>

		anda tidak diterima sebagai penjual di E-Retail.<br/>

		Karena : ' . $this->input->post('teks') . '

		';

		//////////////notifikasi email 21/3/17

		$this->c_email();
		$this->mail->Body = '
            <html>
            <head>
            <title>E-Retail SUPERMALL</title>
            </head>
            <body>
            <h3>E-Retail SUPERMALL</h3>
            <hr />
            ' . $isinot . '<br>
            <p><hr /></p>
            <p><a href="E-Retail.com">E-Retail SUPERMALL<a/></p>
            </body>
            </html>
        ';
		// $Emailto='ilhamroyroy@gmail.com';
		$this->mail->AddAddress($Emailto);
		$this->mail->Send();
		///

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/verifikasi');
	}

	//////////////////BLOV 5/4/17

	function tolak_produk($id)
	{

		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}


		$d = array(

			'status' => 3,

		);

		$this->Madmin_master->block_produk_model($id, $d);

		///////////NOTIVIKASI EMAIL email penjual bukan session



		$namaproduk = $this->Muser->get_produk_by_id($id)->row()->nama;

		$g_id = $this->Muser->get_produk_by_id($id)->row()->id_user;

		$g_id_user = $this->Muser->get_user_by_id($g_id);

		$Emailto = $g_id_user->row()->username;

		$isinot = '

		Mohon Maaf, <br/>

		Produk anda tidak diterima dijual di E-Retail.<br/>

		Dengan Nama Produk : ' . $namaproduk . '<br/>

		Karena : ' . $this->input->post('alasan') . '

		';

		//////////////notifikasi email 21/3/17
		$this->c_email();

		$this->mail->Body = '
            <html>
            <head>
            <title>E-Retail SUPERMALL</title>
            </head>
            <body>
            <h3>E-Retail SUPERMALL</h3>
            <hr />
            ' . $isinot . '<br>
            <p><hr /></p>
            <p><a href="E-Retail.com">E-Retail SUPERMALL<a/></p>
            </body>
            </html>
        ';
		// $Emailto='ilhamroyroy@gmail.com';
		$this->mail->AddAddress($Emailto);
		$this->mail->Send();

		///

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/verifikasi?nav=2');
	}

	/////BLOCK PRODUk DAN TERIMA

	function block_produk($id, $up, $v, $id_user = NULL, $id_k = 1)
	{ //v=di verifikasi

		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}


		$jen_voc = 0;
		if ($id_k == 20) {
			$jen_voc = 1;
		}

		$d = array(

			'status' => $up,
			'jen_voc' => $jen_voc,

		);

		$this->Madmin_master->block_produk_model($id, $d);

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		///////////NOTIVIKASI EMAIL

		///


		$namaproduk = $this->Muser->get_produk_by_id($id)->row()->nama;

		//

		$g_id = $this->Muser->get_produk_by_id($id)->row()->id_user;

		$g_id_user = $this->Muser->get_user_by_id($g_id);

		$Emailto = $g_id_user->row()->username;

		///	

		if ($up == 1) { ///1 di terima

			$isinot = '

		Selamat Produk anda sudah dapat dijual di  E-Retail .<br/>

		Dengan nama produk : ' . $namaproduk . '<br/>

		

		

		<hr/>

		Untuk Login klik <a href="' . base_url('Login') . '">DISINI</a><br/>

		';
		} else {

			$isinot = '

		Mohon Maaf, <br/>

		produk anda <b>tidak dapat</b> dijual di  E-Retail .<br/>

		Dengan Nama Produk : ' . $namaproduk . '.<br/>

		Karena : ' . $this->input->post('alasan') . '

		

		

		<hr/>

		Untuk Login klik <a href="' . base_url('Login') . '">DISINI</a><br/>

		';
		}



		//////////////notifikasi email 21/3/17

		$this->c_email();

		$this->mail->Body = '
            <html>
            <head>
            <title>E-Retail SUPERMALL</title>
            </head>
            <body>
            <h3>E-Retail SUPERMALL</h3>
            <hr />
            ' . $isinot . '<br>
            <p><hr /></p>
            <p><a href="E-Retail.com">E-Retail SUPERMALL<a/></p>
            </body>
            </html>
        ';
		// $Emailto='ilhamroyroy@gmail.com';
		$this->mail->AddAddress($Emailto);
		$this->mail->Send();

		if ($v == 'v') {

			redirect('Master_admin/verifikasi/?nav=2');
		} elseif ($v == 'p') {

			redirect('Master_admin/daftar_produk');
		} else {

			redirect('Master_admin/daftar_produk_penjual/' . $id_user);
		}
	}



	//////////PINDAK KAEGORI

	public function proses_simpan_save_data_pindah($id, $v = 'p', $id_user = NULL) ///blm edit masih di pake buat edit profuk

	{
		if ($this->session->userdata('login') == false) {
			redirect('Login');
		}


		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

		$hm = $h * 60;

		$ms = $hm * 60;

		$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

		$waktu = gmdate("H:i:s", time() + ($ms));

		$data = array(

			'id_k' => $this->input->post('id_k'),
			'jen_voc' => $this->input->post('jen_voc'),

		);

		$this->Madmin->simpan_save_data($data, $id);

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');



		if ($v == 'v') {

			redirect('Master_admin/verifikasi');
		} elseif ($v == 'ep_a') {

			redirect('Master_admin/daftar_produk/' . $this->input->post('id_k'));
		} elseif ($v == 'p') {

			redirect('Master_admin/daftar_produk');
		} else {

			redirect('Master_admin/daftar_produk_penjual/' . $id_user);
		}
	}



	///REV 1 agustus

	function hapus_akun($id_user)
	{
		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}
		$this->Madmin->del_data_user($id_user);

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/verifikasi');
	}

	function hapus_produk($id)
	{

		$this->Madmin->del_data_produk($id);

		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/verifikasi');
	}

	function hapus_pesan_vou($id, $vo)
	{
		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}
		switch ($vo) {
			case 1:
				$this->Madmin->del_data_pesan_voucher($id);

				break;
			case 2: //song
				$this->Madmin->del_data_pesan_v_song($id);
				break;
			case 3: //parsel
				$this->Madmin->del_data_pesan_v_parsel($id);
				break;
			case 4: //mhsiswa
				$this->Madmin->del_data_pesan_v_mhs($id);
				break;
			case 5: //mhsiswa
				$this->M_dompetall->del_pesan_v_all($id);
				break;
			default:
				$this->Madmin->del_data_pesan_voucher($id);
				break;
		}


		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/list_penerima_voucher_tolak/?vo=' . $vo);
	}



	function ganti_judul_edisi($id)
	{

		$d = array(

			'ket' => $this->input->post('ket'),

			'edisi' => $id,



		);

		$get_juduledisi = $this->Madmin_master->get_judul_edisi($id);

		if ($get_juduledisi->num_rows() > 0) {

			$this->Madmin_master->simpan_judul_edisi($d, $id);
		} else {

			$this->Madmin_master->insert_judul_edisi($d);
		}



		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/list_penerima_voucher/');
	}



	function ganti_judul_edisi_bonus($id)
	{

		$d = array(

			'ket' => $this->input->post('ket'),

			'edisi' => $id,



		);

		$get_juduledisi = $this->Madmin_master->get_judul_edisi_bonus($id);

		if ($get_juduledisi->num_rows() > 0) {

			$this->Madmin_master->simpan_judul_edisi_bn($d, $id);
		} else {

			$this->Madmin_master->insert_judul_edisi_bn($d);
		}



		$this->session->set_flashdata('pesan', 'data berhasil di perbaharui .');

		redirect('Master_admin/list_penerima_voucher_bonus/');
	}



	public function monitor($da = NULL)

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

			if ($da == 'day') {

				$data['view'] = 'pages/monitor/monitor_day';
			} else {

				$data['view'] = 'pages/monitor/monitor';
			}

			//

			///

			$data['f'] = 'active';

			$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';

			$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

			///

			$this->load->view('pages/admin/monitor', $data);
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function kosongkan_trans_voucher()
	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));

			$d = array(

				'buy' => 'expired',

				'tgl_otorisasi' => $tanggal . '' . $waktu,

			);

			$this->Madmin_master->kosongkan_expired_voc($d);

			//redirect(Master_admin/produkdipesan_all/2);

			$this->kosongkan_voc_tbluser();
		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	function kosongkan_voc_tbluser()
	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

			$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

			$hm = $h * 60;

			$ms = $hm * 60;

			$tanggal = gmdate("Y-m-d ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

			$waktu = gmdate("H:i:s", time() + ($ms));

			$d = array(

				'voucher_umy' => '0',

				'voucher_dibelanjakan' => 0,

			);

			$this->Madmin_master->kosongkan_user_sal_voc($d);

			redirect('C_dompet_2/add_edisi_voucher');

			//$this->kosongkan_voc_tbluser();

		} else {

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}



	public function daf_transaksi($thn = null)

	{

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {



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

			$data['b'] = $data['d'] = $data['j'] = $data['k'] = '';

			$data['i'] = 'active';

			$data['sort'] = 0;

			///
			if ($thn == null) {
				$data['thn'] = $this->thn_c;
			} else {
				$data['thn'] = $thn;
			}

			///

			$data['view'] = 'pages/master_admin/transaksi_produk';

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

	function sort_pelapakakun($sort, $st = '')
	{
		$d = [
			'statp' => $st,
			'sort_a' => $sort
		];
		$this->session->set_userdata($d);

		//var_dump($d);
		redirect('Master_admin/list_penjual');
	}

	//sortprodi_pelapakakunmhs - 201902

	function sortprodi_pelapakakunmhs($kd)
	{
		if ($kd == 0) {
			# code...
			$kd = '';
		}
		$d = [
			'statprodi' => $kd,
		];
		$this->session->set_userdata($d);

		//var_dump($d);
		redirect('Master_admin/list_penjual');
	}
}
