<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_verifikasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($token)
	{
	}

	function terimaProdukPilihan()
	{
		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}

		$lo = $this->load;
		$data['dpost'] = isset($_POST['id_produk']) ? $_POST['id_produk'] : '';
		if ($data['dpost'] == '') {
			redirect("Master_admin/verifikasi/?nav=2");
		}

		$lo->view('PageProses/terimaProduk', $data);
		// redirect ('Master_admin/verifikasi/?nav=2');
	}

	function savedataterimaProduk()
	{
		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}
		$id = isset($_POST['idproduk']) ? $_POST['idproduk'] : '';
		$this->idProduk = $id;
		if ($id == null) {
			echo '<button type="button" class="list-group-item">Proses penyimpanan data id ' . $id . ' dan kirim email ke penjula gagal </button>';
			return;
		}
		$this->savedataProduk();
		$cekeamil = $this->kirim_emailPerProduk();

		if ($cekeamil != 'benar') {
			echo '<button type="button" class="list-group-item">Proses penyimpanan data id ' . $id . ' dan kirim email ke penjula gagal </button>';
			return;
		}

		$urlnext = base_url('Master_admin/block_produk/' . $id . '/1/v/0');
		$data = '<button type="button" class="list-group-item">Proses penyimpanan data id ' . $id . ' dan kirim email ke penjula sudah selesai </button>';
		echo  $data;
	}

	function savedataProduk()
	{ //v=di verifikasi
		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}

		$jen_voc = 0;
		$id = $this->idProduk;
		$d = array(

			'status' => 1,
			'jen_voc' => $jen_voc,

		);

		$this->Madmin_master->block_produk_model($id, $d);
	}

	public function kirim_emailPerProduk()
	{
		if ($this->session->userdata('wewenang') != 'admin') {
			redirect('Login');
		}

		$id = $this->idProduk;
		$namaproduk = $this->Muser->get_produk_by_id($id)->row()->nama;

		//

		$g_id = $this->Muser->get_produk_by_id($id)->row()->id_user;

		$g_id_user = $this->Muser->get_user_by_id($g_id);

		$Emailto = $g_id_user->row()->username;

		///	

		$isinot = '

		Selamat Produk anda sudah dapat dijual di E-Retail.<br/>

		Dengan nama produk : ' . $namaproduk . '<br/>

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
		if (!$this->mail->Send()) {

			return ('SALAH' . $this->mail->ErrorInfo);
		} else {

			return ('benar');
		}
	}
}
