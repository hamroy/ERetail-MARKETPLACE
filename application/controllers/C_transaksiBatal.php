<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_transaksiBatal extends CI_Controller
{

	function __construct($id_t = 0, $p = 'btl', $w = 'admin', $bc = 0)
	{
		parent::__construct();
		$karakter = 'ILHAMBADROYANI[ilhamroyani].1228';
		$keys = '';
		for ($i = 0; $i < 12; $i++) {
			$pos = rand(0, strlen($karakter) - 1);
			$keys .= $karakter{
			$pos};
		}

		$this->key = $keys;
	}


	public function index($id_t = 0, $p = 'btl', $w = 'admin')
	{
		$id_user = $this->input->post('id_user');

		if ($this->session->userdata('login') == FALSE or $this->session->userdata('wewenang') != "admin" or $this->session->userdata('id_user') != $id_user) {

			redirect('login');
		}



		$bc = 'T';
		$this->form_validation->set_rules('ck', 'ck', 'required'); ///valid_email

		if ($this->form_validation->run() == TRUE) {
			$valid = $this->input->post('ck');
			$jvocd = $this->input->post('jevoc');
			$key2 = $this->key;

			$this->btl_transaksiA($id_t, $key2);

			$this->btl_email_allfrom($id_t, $key2);

			$bc = $jvocd;
		}

		$this->index2($bc);
	}

	function index2($bc)
	{
		if ($bc == 'T') {

			redirect('Master_admin/produkdipesan_all/1');
		} elseif ($bc == 'F') {
			redirect('Master_admin/produkdipesan_all/3');
		} else {
			redirect('Master_admin/produkdipesan_all/2');
		}
	}

	function btl_transaksiA($id, $key2)
	{
		if ($key2 == $this->key) {


			////////////////REVISI 201717
			$getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();
			$gettotal = $this->Mtrans->get_total_tbltransaksi_oto($id);	//tbltransaksi get qty*harga satuan
			$lolos = 1;
			$hariini = $this->M_time->harinow();
			$jvocd = $this->input->post('jevoc');

			/////////////////////////////////////////////////////////////////////////////////////////////////////   
			//////rev Ilham 190717

			$u = array(
				'buy' => 'Batal_ot',
				'day' => $this->M_time->tgl_now(),
				'bln' => $this->M_time->bln(),
				'thn' => $this->M_time->thn(),
				'tgl_otorisasi' => $hariini,
			);

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $getidt->id_user,
				'id_transaksi' => $id,
				'kode' => 4,
				'kontek' => 'Pembatalan Belanja === ' . $gettotal,
				'tgl_trans' => $hariini,
				'j_voucher' => $jvocd,
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			////// REV 1417 INTI
			if ($gettotal != 0) {
				//selain VOUCHER  
				$this->Mtrans->update_bayar_otorisasi($id, $u);

				if ($jvocd != 'F' and $jvocd != 'T') {
					# code...
					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat	
				}

				$this->session->set_flashdata('pesan', 'Transaksi Berhasil dibatalkan.');
				//
			} else {
				//nol 
				$this->session->set_flashdata('pesan', 'Mohon maaf, data gagal tersimpan.<br/> Silahkan Coba sekali lagi.');
				redirect('C_dompet/tcses/trans');
			}
		} else {
			echo "error 100 *1";
			// echo "<br/>".$this->key;
			// echo "<br/>".$key2;
		}
	}

	function btl_email_allfrom($id, $key2)
	{
		///////EMAIL
		if ($key2 == $this->key) {
			require APPPATH . "third_party/PHPMailer-master/src/PHPMailer.php"; //SMTP.php
			require APPPATH . "third_party/PHPMailer-master/src/SMTP.php"; //SMTP.php
			require APPPATH . "third_party/PHPMailer-master/src/Exception.php"; //SMTP.php	    

			$data['getidt'] = $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();

			$data['idtblpembeli'] = $idtblpembeli = $this->Mtrans->get_tbl_pembeli($getidt->id_pembeli);

			$data['idtblpelapak'] = $idtblpelapak = $this->Mtrans->get_tbl_userpenjual($getidt->id_pelapak);

			$data['idtblproduk'] = $idtblproduk = $this->Mtrans->get_tbl_produk($getidt->id_produk);

			$btal = 'Mohon Maaf, <br/>
	 		
			Produk ' . $idtblproduk->row()->nama . '<br/>
			Sebanyak ' . $getidt->qty . '<br/>
			Yang Saudara pesan di penjual <br/>
    	    nama : ' . $idtblpelapak->row()->nama . '<br/> 
    	    email : ' . $idtblpelapak->row()->username . '<br/>
			Telah dibatalkan.<br/>
			Karena : ' . $this->input->post('alasan') . '
		
			<br />
			Terima Kasih <br/>
			
			Silahkan Belanja kembali di <a href="www.E-Retail.com">E-Retail SUPERMALL</a>.
			
			';

			/*/////////////notifikasi email 21/3/17
			
            //*/

			////SEND EMAIL 201902

			$mail = new PHPMailer\PHPMailer\PHPMailer();
			$mail->IsSMTP();

			$mail->SMTPDebug = 0;
			$mail->SMTPAuth   = true; // enabled SMTP authentication
			$mail->SMTPSecure = 'ssl';  // prefix for secure protocol to connect to the server
			$mail->Host       = "host21.registrar-servers.com";      // setting GMail as our SMTP server
			$mail->Port       = 465;                   // SMTP port to connect to GMail
			$mail->Username   = $this->config->item("mail");
			$mail->Password   = $this->config->item("pass_mail");
			$mail->SetFrom($this->config->item("mail"), 'E-Retail SUPERMALL');  //Who is sending 
			$mail->isHTML(true);

			$mail->Subject    = "PEMBATALAN TRANSAKSI PRODUK - [E-Retail]";
			$mail->Body      = $btal;
			//$email="ilhamroyroy@gmail.com";
			$mail->AddAddress($idtblpembeli->row()->email);

			if (!$mail->Send()) {

				return ('SALAH' . $mail->ErrorInfo);
			} else {

				echo ('benar');
			}
		} else {
			echo "error 102";
		}
	}

	function allIdTransaksi($get_d = 'TUNAI', $stg = 'dipesan')
	{

		$id_user = $this->input->post('id_user');
		$jvocd = $this->input->post('jevoc');
		$key = $this->key;
		if ($this->session->userdata('login') == FALSE or $this->session->userdata('wewenang') != "admin" or $this->session->userdata('id_user') != $id_user) {

			$this->index2($jvocd);
		}


		$all = $this->Madmin->get_Produk_dipesan_all($get_d, $stg);

		$simpan = '';

		if ($all->num_rows() > 0) {

			foreach ($all->result() as $aa) {

				if ($this->input->post('ck_' . $aa->id)) {

					$this->btl_transaksiA($aa->id, $key);
				}
			}
		}


		if ($simpan == null) {
			$this->index2($jvocd);
		}



		$this->index2($jvocd);
	}
} //cls 
