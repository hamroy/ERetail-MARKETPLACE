<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Muser');
		$this->load->model('Mtrans');
		$this->load->model('M_vparsel');
		$this->load->model('M_dompetall');
		$this->load->model('Mbank');
		$this->load->model('M_rProduk');
	}

	public function index()
	{
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user



			$data['img'] = $g_id->row()->img;



			$data['nama'] = $g_id->row()->nama;



			$data['alamat'] = $g_id->row()->alamat;



			$data['kontak'] = $g_id->row()->no_kontak;



			$data['username'] = $g_id->row()->username;



			$data['rek'] = $g_id->row()->rek;



			$data['bank'] = $g_id->row()->bank;



			$data['sex'] = $g_id->row()->jenis_kelamin;



			//================================================================



		}



		//============================================



		if ($this->session->userdata('login') == FALSE) {



			$data['id_s'] = $this->session->userdata('id_pembeli');
		} else {



			$data['id_s'] = $this->session->userdata('id_user');
		}



		//============================================ 



		///---------------------------------USER







		$data['title0'] = 'E-Retail';



		$data['title1'] = 'E-Retail SUPERMALL';



		$data['title2'] = '';



		$data['view'] = 'pages/publik/kategori';



		$this->load->view('pages/layout/top-nav', $data);
	}





	function allkategori()



	{



		if ($this->session->userdata('login') == FALSE) {



			//$this->session->sess_destroy();



			redirect('Welcome');
		} else {

			// die();

			redirect('Welcome');
		}
	}



	public function publik($id)
	{

		if ($this->session->userdata('login') == FALSE) {
			redirect('login');
			///*/
		}
		$jsta = FALSE;
		$market = $this->session->userdata('id_supermarket');
		if ($market != null or $market != 0) {
			$jsta = $this->M_setapp->get_idjobmarket();
		}
		// echo 'il'.$jsta;      
		// die($jsta);
		$data = $this->Muser->getDataProfilPublik(); ///get masing masing id user
		//============================================

		if ($this->session->userdata('login') == FALSE) {
			$data['id_s'] = $this->session->userdata('id_pembeli');
		} else {
			$data['id_s'] = $this->session->userdata('id_user');
		}

		$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Lihat semua kategori';
		$data['view'] = 'pages/publik/rinci_kategori';
		$data['kat'] = $this->Muser->get_kategori_by_id($id);

		////////////PAGIANTION
		//revisi ilham pagination

		//$gtog=$this->Muser->get_produk_by_kat($id);
		// die($jsta);
		$gtog = $this->Muser->get_produk_by_kat($id, $jsta);
		$config['base_url'] = base_url('Welcome/publik/' . $id);
		$data['total_rows'] = $config['total_rows'] = $gtog->num_rows();
		$config['per_page'] = 30; /*Jumlah data yang dipanggil perhalaman*/
		$config['uri_segment'] = 4; /*data selanjutnya di parse diurisegmen 3*/
		$choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = round($choice);
		$config['num_links'] = 5;
		/*Class bootstrap pagination yang digunakan*/
		$config['full_tag_open'] = "<ul id='demo' class='pagination' style='position:relative; top:-25px;'>";
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

		//////////

		$data['gtog'] = $gtog = $this->Muser->get_produk_by_kat_pag($id, $config['per_page'], $dari, $jsta);
		$data['halaman'] = $this->pagination->create_links();
		///////////

		////////////PAGIANTION
		$data['id_k'] = $id;
		$this->load->view('pages/layout/top-nav', $data);
	}



	public function cari_produk()



	{



		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user



			$data['img'] = $g_id->row()->img;



			$data['nama'] = $g_id->row()->nama;



			$data['alamat'] = $g_id->row()->alamat;



			$data['kontak'] = $g_id->row()->no_kontak;



			$data['username'] = $g_id->row()->username;



			$data['rek'] = $g_id->row()->rek;



			$data['bank'] = $g_id->row()->bank;



			$data['sex'] = $g_id->row()->jenis_kelamin;



			//================================================================



		}



		//============================================



		if ($this->session->userdata('login') == FALSE) {



			$data['id_s'] = $this->session->userdata('id_pembeli');
		} else {



			$data['id_s'] = $this->session->userdata('id_user');
		}



		//============================================



		$data['cari'] = $this->input->post('cari');



		$data['title0'] = 'E-Retail';



		$data['title1'] = 'E-Retail';



		$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Lihat semua kategori';



		$data['view'] = 'pages/publik/rinci_produk_cari';



		//$data['kat']=$this->Muser->get_kategori_by_id($id);



		//$data['id_k']=$id;



		$this->load->view('pages/layout/top-nav', $data);
	}



	public function produk($idp)
	{
		if ($this->session->userdata('login') == FALSE) {
			redirect('Login');
		}

		$data['produk'] = $get_prod = $this->Muser->get_produk_by_id($idp);

		$data['id_produk'] = $idp;

		//echo 
		$idlog = $this->session->userdata('id_user');

		if ($get_prod->num_rows() == 0) {

			redirect('Welcome/allkategori/');
		}

		if ($get_prod->row()->id_user == $idlog) {

			redirect('Welcome/allkategori/');
		} else {

			$tgl = $this->M_time->harinow();
			$tgl_t = $this->M_time->thnblntgl();
			$id_user = $get_prod->row()->id_user;

			$da = array(
				'id_user' => $idlog,
				'id_user_p' => $id_user,
				'id_produk' => $idp,
				'tgl' => $tgl,
			);

			$d = $tgl . " - id_user : " . $da['id_user'] . " - idpenjual : " . $da['id_user_p'] . " - idproduk : " . $da['id_produk'] . "\n";
			$file_path = "log/logViewProduk_" . $tgl_t . ".txt";

			$file_handle = fopen($file_path, 'a+');
			// $d.='<kelas > ilham </kelas>';
			if ($file_handle == TRUE) {
				fwrite($file_handle, $d);
			}

			fclose($file_handle);

			// Initialize the XML parser
			$this->Muser->supView_produk($da, $idlog, $idp);

			$al = TRUE;

			$this->produk_rinci($idp, $al);
			// redirect('Welcome/produk_rinci/'.$idp.'/'.$al);



		}
	}



	public function produk_rinci($idp, $al = FALSE)
	{

		if ($this->session->userdata('login') == FALSE) {
			redirect('Login');
		}

		if ($al == FALSE) {
			redirect('Welcome/produk/' . $idp);
		} else {
			redirect('C_kom/produk_Statik/' . $idp);
		}
	}

	public function produk_rinci_akhir($idp)
	{
		if ($this->session->userdata('al') == FALSE) {

			redirect('Welcome/produk/' . $idp);
		}

		if ($this->session->userdata('login') == FALSE) {
			redirect('Login');
		}

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			$data = $this->Muser->getDataProfil(); ///get masing masing id user

			//================================================================
			$job = $data['job'];
			$idlog = $data['id_user'];
		} else {

			$idlog = 0;

			$job = '';
		}

		//============================================



		$getidpembeli = $this->Mtrans->getidpembeli_iduser($idlog); ///bila user

		$id_pembeli = $this->session->userdata('id_pembeli');

		if ($getidpembeli->num_rows() > 0) {
			# code...
			$id_pembeli = $getidpembeli->row()->id;
		}

		$data['id_s'] = $id_pembeli;

		//============================================

		$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Lihat semua kategori';

		$data['view'] = 'pages/publik/rinci_produk';

		$data['produk_nama'] = '';

		$data['produk'] = $get_prod = $this->Muser->get_produk_by_id($idp);

		if ($get_prod->num_rows() > 0) {

			$data['produk_nama'] = $get_prod->row()->nama;
		}

		$data['id_produk'] = $idp;

		///20180421

		$gus = $this->Muser->get_id_pass_nos($idlog);

		$gus_prod = $this->Muser->get_id_pass_nos($get_prod->row()->id_user);

		if ($job == 1001 or $job == 3) {

			if ($gus_prod->row()->job != 3 and $gus_prod->row()->job != 1001) {

				redirect('Welcome/allkategori/');
			}
		}

		///*/

		if ($get_prod->row()->id_user == $idlog) {

			redirect('Welcome/allkategori/');
		} else {



			$this->load->view('pages/layout/top-nav_produkrinci', $data);
		}
	}

	public function profil_publik($id_user, $id_k = 0, $id_produk = 0)



	{



		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user



			$data['img'] = $g_id->row()->img;



			$data['nama'] = $g_id->row()->nama;



			$data['alamat'] = $g_id->row()->alamat;



			$data['kontak'] = $g_id->row()->no_kontak;



			$data['username'] = $g_id->row()->username;



			$data['rek'] = $g_id->row()->rek;



			$data['bank'] = $g_id->row()->bank;



			$data['sex'] = $g_id->row()->jenis_kelamin;



			//================================================================



			$idlog = $g_id->row()->idlog;
		} else {



			$idlog = 0;
		}



		//============================================



		if ($this->session->userdata('login') == FALSE) {



			$data['id_s'] = $this->session->userdata('id_pembeli');
		} else {



			$data['id_s'] = $this->session->userdata('id_user');
		}



		//============================================



		$data['title0'] = 'E-Retail';



		$data['title1'] = 'E-Retail';



		$data['id_user'] = $id_user;



		$data['id_k'] = $id_k;



		$data['id_produk'] = $id_produk;



		$data['title2'] = '<i class="fa fa-fw fa-th-large"></i> Lihat semua kategori';



		$data['view'] = 'pages/publik/profil_penjual';







		$this->load->view('pages/layout/top-nav', $data);
	}



	//============================================================================KERANJANG



	function proses_keranjang()
	{



		//$tp = $this->Mtrans->show_pembeli()->num_rows();



		$id_pembeli = $this->session->userdata('id_pembeli');



		$all = $this->db->get('tbl_transaksi');



		$simpan = '';



		if ($all->num_rows() > 0) {



			foreach ($all->result() as $aa) {



				if ($this->input->post('k_' . $aa->id)) {



					$simpan = $simpan . '-' . $aa->id;
				}
			}
		}



		$hasil_no = $simpan;



		$pec = explode('-', $hasil_no); ////di pecah  dalam bentu array



		for ($x = 1; $x < count($pec); $x++) {



			$u = array(



				'buy' => 'ya',



			);



			if ($this->session->userdata('login') == FALSE) {



				$id = $this->session->userdata('id_pembeli');



				$this->Mtrans->update_bayar_keranjang($id, $u, $pec[$x]);
			} else {



				$id = $this->session->userdata('id_user'); ///bila user



				$this->Mtrans->update_bayar_keranjang_user($id, $u, $pec[$x]);
			}
		}















		redirect('welcome/beli_produk/' . $id . '#' . $x);
	}



	/////======================================QTY



	function tambahqty($id_tran, $q)
	{



		$g = $this->Mtrans->get_qty_tbl_transaksi($id_tran)->row();



		if ($q == 'min') {



			$ak = $g->qty - 1;
		} else {



			$ak = $g->qty + 1;
		}



		$u = array(



			'qty' => $ak,



		);



		$this->Mtrans->update_qty($id_tran, $u);



		if ($this->session->userdata('login') == FALSE) {



			$id = $this->session->userdata('id_pembeli');
		} else {



			$id = $this->session->userdata('id_user'); ///bila user







		}



		redirect('welcome/beli_produk/' . $id . '#' . $g->qty);
	}



	//////////////////DEL TARANSAKSI



	function hapus_idtransaksi($id_tran)
	{


		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			// $id = $this->session->userdata('id_user'); ///bila user
			$id = $this->session->userdata('id_pembeli');

			$this->Mtrans->del_id_transaksi($id_tran);
		} else {
			redirect('login');
		}

		redirect('welcome/beli_produk/' . $id . '#');
	}



	////proses pertama memasukkan barang ke keranjang sebelum di beli--------------=====================================
	function proses_beli_produk()
	{ ////tahap 1 memasukkan ke keranjang 
		if ($this->session->userdata('login') == FALSE) {
			redirect('Login');
		}

		$id_user = $this->session->userdata('id_user');
		if ($this->session->userdata('id_pembeli') == NULL or empty($this->session->userdata('id_pembeli'))) {
			//////////////
			$tgl1 = $this->M_time->sort_tanggal();
			//////////////
			if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
				$daUser = $this->Muser->getDataProfilPublik();
				$t = array(
					'nama' => $daUser['nama'], ///bila user
					'hp' => $daUser['kontak'], ///bila user
					'alamat' => $daUser['alamat'], ///bila user
					'email' => $daUser['username'], ///bila user
					'id_user' => $id_user, ///bila user
					'tgl_id' => $tgl1,
				);

				$this->Mtrans->uptambah_pembeli($t);
			}


			////

			$tp = $this->Mtrans->getidpembeli_iduser($id_user);
			$pembeli = $tp->row()->id;
			$this->session->unset_userdata('id_pembeli');
			$this->session->set_userdata('id_pembeli', $pembeli);
			// 
		}

		//////////////
		if ($this->session->userdata('id_pembeli') == NULL or empty($this->session->userdata('id_pembeli'))) {
			$this->proses_beli_produk();
		} //loop
		//////////////

		/////////id_pelapak

		$getp = $this->Mtrans->getidpelapk($this->input->post('id_produk'))->row()->id_user;

		/////////id_pelapak

		$id_prod = $this->input->post('id_produk');

		$id_pembeli = $this->session->userdata('id_pembeli');

		///280517
		$hpro = $this->Mtrans->get_hargaproduk($id_prod);
		///280517

		/////
		$hariini = $this->M_time->harinow();
		/////


		$qtyi = $this->input->post('qty');
		$t = array(
			'id_pembeli' => $id_pembeli, ///hanya sementara
			//
			'id_user' => $id_user, ///hanya sementara
			'id_pelapak' => $getp,
			'id_produk' => $id_prod,
			'qty' => $qtyi,
			'tgl_trans' => $hariini,
			'buy' => 'ya', ////rev 8317
			'harga_satuan' => $hpro, ////rev 240717 nyimpan harga satuan
			'total' => $qtyi * $hpro, ////rev 8317
			//'hargasatuan'=> $qtyi*$hpro, ////rev 8317

		);


		///jika sudah ada maka update ///id_pembeli // id  //status=ya

		$cekidpem = $this->Mtrans->cekidpembeli_ya($id_pembeli, $id_prod);

		if ($cekidpem == TRUE) {

			//update
			$get_qty = $this->Mtrans->getqtyidpembeli_ya($id_pembeli, $id_prod);
			$plusqty = $get_qty->row()->qty;
			$plusharga = $get_qty->row()->harga_satuan;
			$plusharga_totla = $get_qty->row()->total;

			$tqty = array(
				'qty' => $plusqty + $qtyi,
				'harga_satuan' => $hpro,
				'total' => ($hpro * $plusqty) + ($hpro * $qtyi),
			);

			//save
			if ($hpro == 0 or $qtyi == 0) {
				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Mohon Di Ulang Kembali');
			} else {
				$this->Mtrans->update_plusqty($id_pembeli, $id_prod, $tqty); ///id_pembeli //produk /iddata
			}

			//save

		} else { ///alur yang di gunakan

			if ($hpro == 0) {

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Mohon Di Ulang Kembali');
			} else {

				$this->Mtrans->tambah($t);	 //new

			}
		}


		redirect('welcome/beli_produk/#' . $this->session->userdata('id_pembeli'));
	}







	function beli_produk()
	{
		if ($this->session->userdata('login') == FALSE) {
			redirect('Login');
		}
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			$this->load->model('M_dompetKu');

			$data = $this->Muser->getDataProfil(); ///get masing masing id user
			////rev122017

			$iduser = $data['id_user'];

			/////////////////
			$data['saldo_voc'] = $gv = $this->M_dompetKu->saldoDompet()['saldoKu'];  ///DOMPET
			// $data['saldo_voc']=$this->M_gvocall->gvall(0,$iduser)['saldo'];
			// $data['saldo_parsel']=$this->M_gvocall->gvall(1,$iduser)['saldo'];
			// $data['saldo_song2']=$this->M_gvocall->gvall(2,$iduser)['saldo'];
			// $data['saldo_mhs']=$this->M_gvocall->gvall(3,$iduser)['saldo'];
			// $data['saldo_mhs']=$this->M_gvocall->gvall(3,$iduser)['saldo'];
			// $data['saldo_gj13']=$this->M_gvocall->gvall(4,$iduser)['saldo'];

			//
			//================================================================

		}

		//================================================================


		$list = $this->Mtrans->lihat_keranjang_by_pelapak_tanpa_cart($iduser); ///bila user
		$getidpembeli = $this->Mtrans->getidpembeli_iduser($iduser); ///bila user

		if ($getidpembeli->num_rows() > 0) {
			# code...
			$id_pembeli = $getidpembeli->row()->id;
		} else {

			$this->Mtrans->del_produk_buya($iduser);
			$s = 'Maaf, anda Harus Belanja dari Tahap awal';
			redirect('login/logout_paksa?s=' . $s);
		}
		////////REV 1117
		$data['id_s'] = $id_pembeli;
		$data['id_pembeli'] = $id_pembeli;

		//============================================

		////DEF ID PEMBELI150717
		$this->session->set_userdata('id_pembeli_id_pembeli', $id_pembeli);
		////DEF ID PEMBELI15071

		//================================================================

		$data['title2'] = '<i class="fa fa-fw fa-shopping-cart"></i> Tambah Daftar Belanja';
		$data['view'] = 'pages/publik/beli_produk';
		$data['daftar_barang'] = $list;
		$data['produk'] = $this->Muser->get_produk_by_id($this->input->post('id_produk'));
		$data['qty'] = $this->input->post('qty');
		$this->load->view('pages/layout/top-nav', $data);
	}

	////
	function tq($id_pembeli, $tgl1)
	{



		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user



			$data['img'] = $g_id->row()->img;



			$data['nama'] = $g_id->row()->nama;



			$data['alamat'] = $g_id->row()->alamat;



			$data['kontak'] = $g_id->row()->no_kontak;



			$data['username'] = $g_id->row()->username;



			$data['rek'] = $g_id->row()->rek;



			$data['bank'] = $g_id->row()->bank;



			$data['sex'] = $g_id->row()->jenis_kelamin;



			//================================================================



		}



		$data['id_pembeli'] = $id_pembeli;



		$data['id_tgl'] = $tgl1;



		//================================================================



		$data['title0'] = 'E-Retail';



		$data['title1'] = 'E-Retail';



		$data['title2'] = '<i class="fa fa-fw fa-shopping-cart"></i> Kembali Belanja';



		$data['view'] = 'pages/publik/terimakasih';



		$this->load->view('pages/layout/top-nav', $data);
	}







	function batalpesan($id_pembeli)
	{



		$u = array(



			//'metode'=>$this->input->post('metode'),



			'buy' => 'batal',



			///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.



			//untuk keperuan nota treansaksi



		);











		$this->Mtrans->update_bayar($id_pembeli, $u);



		redirect('welcome/allkategori/');
	}



	function supermarket($id = '')

	{

		$this->session->set_userdata('id_supermarket', $id); ///id_jobmarket



		redirect(base_url());
	}



	function nosupermarket()

	{

		$this->session->set_userdata('id_supermarket', '');

		redirect(base_url());
	}



	function tq_bk($id_pembeli, $tgl1)
	{



		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



			$g_id = $this->Muser->get_id_pass(); ///get masing masing id user



			$data['img'] = $g_id->row()->img;



			$data['nama'] = $g_id->row()->nama;



			$data['alamat'] = $g_id->row()->alamat;



			$data['kontak'] = $g_id->row()->no_kontak;



			$data['username'] = $g_id->row()->username;



			$data['rek'] = $g_id->row()->rek;



			$data['bank'] = $g_id->row()->bank;



			$data['sex'] = $g_id->row()->jenis_kelamin;
		}



		//================================================================

		$data['id_pembeli'] = $id_pembeli;



		$data['id_tgl'] = $tgl1;



		//================================================================



		$data['title0'] = 'E-Retail';



		$data['title1'] = 'E-Retail';



		$data['title2'] = '<i class="fa fa-fw fa-shopping-cart"></i> Kembali Belanja';



		$data['view'] = 'pages/publik/terimakasih_kd';



		$this->load->view('pages/layout/top-nav', $data);
	}

	///UJICOBA EXSEKUSI API

	public function ex_api($url = '')
	{
		$url = "http://wsb.supra-center.com/Payment/bm/format/json";
		$_cookieFileLocation = dirname(dirname(dirname(__FILE__))) . '/cookie/cookie.txt';

		$data   = array(
			"nomorPembayaran" => "54339122729",
			"waktuTransaksi" => "20180816211006",
			"kodeBank" => "123",
			"passwordBank" => "Idh32&4sud)(dAD{}adhgK1228",
			"kodeChannel" => "54339122729",
			"kodeTerminal" => "54339122729",
			"idTransaksi" => "54339122729",
			"totalNominal" => "40000",
			"nomorJurnalBank" => "54339122729",
			"idTagihan" => "54339122729",
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $_cookieFileLocation);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $_cookieFileLocation);
		$json_response = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		$response = json_decode($json_response, true);

		return $json_response;
	}

	function viewApi($value = '')
	{
		# code...
		$data = $this->ex_api();
		print_r($data);
		echo "<script>console.log('$data');</script>";
	}
}
