<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Pengaturan extends CI_Controller
{



	var $thn_c;



	function __construct()
	{



		parent::__construct();

		$this->load->model('Mjurnalis');

		$this->load->helper(array('form', 'url'));

		$this->load->model('M_vparsel');

		$this->load->model('M_dompetall');

		$this->load->model('M_belanja');

		$this->load->library('Pdf');

		$thn_c = $this->M_time->thn();

		$this->thn_c = $thn_c;
	}





	public function jurnalis($cari = NULL, $ak = 1)



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







			$data['view'] = 'pengaturan/daftar_jurnalis';







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


	public function berita($cari = NULL, $ak = 1)



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







			$data['view'] = 'pengaturan/daftar_berita';







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



	public function list_jurnalis($cari = NULL, $ak = 1)

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



			$data['view'] = 'pengaturan/daftar_jurnalis_cari';



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

	function daftarjurnalis($id_pelapak)
	{
		$tambah = array('id_pelapak' => $id_pelapak);
		$this->Mjurnalis->tambahjurnalis($tambah);
		redirect('pengaturan/jurnalis'); //ok
	}

	function blokir($id)
	{
		$s = array('status' => 'blokir');
		$this->Mjurnalis->updatejurnalis($s, $id);
		redirect('pengaturan/jurnalis'); //ok
	}

	function aktifkan($id)
	{
		$s = array('status' => '');
		$this->Mjurnalis->updatejurnalis($s, $id);
		redirect('pengaturan/jurnalis'); //ok
	}
}
