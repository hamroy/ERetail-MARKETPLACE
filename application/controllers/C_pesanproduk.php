<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pesanproduk extends CI_Controller
{

	var $tanngal;
	var $sort_tanggal;
	var $waktu;
	var $harinow;
	var $id_voc;

	function __construct()
	{
		parent::__construct();
		$this->load->model('Muser');
		// $this->load->model('M_vparsel');
		$this->load->model('Mtrans');
		// $this->load->model('M_dompetall');
		$this->load->model('Mbank');
		// $this->load->model('M_gvocall');
		// $this->load->model('M_dompetKu');
		////
		require APPPATH . "third_party/PHPMailer-master/src/PHPMailer.php"; //SMTP.php
		require APPPATH . "third_party/PHPMailer-master/src/SMTP.php"; //SMTP.php
		require APPPATH . "third_party/PHPMailer-master/src/Exception.php"; //SMTP.php	    

		/////////////////////
		$h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time        zone is.
		$waktu = gmdate("H:i:s ", time() + ($ms));
		$hariini = gmdate('d-m-Y H:i:s', time() + ($ms));
		//////////////
		//======================
		$xxxxxx = substr($hariini, '17', '2');
		$xxxxx = substr($hariini, '14', '2');
		$xxxx = substr($hariini, '11', '2');
		$xxx = substr($tanggal, '0', '2');
		$xx = substr($tanggal, '3', '2');
		$x = substr($tanggal, '6', '4');
		$tgl1 = $x . '' . $xx . '' . $xxx . '' . $xxxx . '' . $xxxxx . '' . $xxxxxx;
		$voc = $x . '' . $xx;
		///JAM
		$this->sort_tanggal = $tgl1;
		$this->tanngal = $tanggal;
		$this->waktu = $waktu;
		$this->harinow = $hariini;
		$id_voc_s = $this->M_voucher->get_max_id_voc();
		$this->id_voc = $id_voc_s;
		$this->id_voc_p = $id_voc_s;
	}




	/////////////TAHAP PEMBAYARAN  (tahap ke 2) ///pesan barang dulu sintemnya
	function bayar_gagal($id_pembeli)
	{
		$so = $this->sort_tanggal;

		redirect('C_pesanproduk/bayar_0/' . $id_pembeli . '/' . $so);
	}
	function bayar($id_pembeli, $so = 0)
	{ ///hanya menhubah status dan notifikasi ke pembeli dan penjual
		///palidaasi
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('namapembeli', 'namapembeli', 'required'); ///valid_email
		$so = $this->sort_tanggal;
		////REV 20082017
		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			$id_user_save = $this->session->userdata('id_user');
		} else {
			$id_user_save = '0';
		}



		$via = $this->input->post('metode');

		///////////////////////////////////////////////////////////////////////////////////////////////// 

		if ($this->form_validation->run() == TRUE) {
			////bila email sama maka yg di update sesuai emailnya
			$cekemail = $this->Mtrans->cek_email_pembelisama($this->input->post('email'));

			if ($cekemail == TRUE) {
				$id_pembeli = $this->Mtrans->get_samemail($this->input->post('email'))->row()->id;
				$id_pembeli_email = $id_pembeli;
			} else {

				$getidpembeli = $this->Mtrans->getidpembeli_iduser($id_user_save); ///bila user

				if ($getidpembeli->num_rows() > 0) {
					# code...
					$id_pembeli = $getidpembeli->row()->id;
				} else {
					redirect('Welcome/beli_produk');
				}




				$t = array(
					'id' => $id_pembeli,
					'id_user' => $id_user_save,
					'nama' => $this->input->post('namapembeli'),
					//'nik'=>$this->input->post('nik'),
					'email' => $this->input->post('email'),
					'hp' => $this->input->post('hppembeli'),
					'alamat' => $this->input->post('alamatpembeli'),
					'ranting' => $this->input->post('ranting'),
					'cabang' => $this->input->post('cabang'),
					'daerah' => $this->input->post('daerah'),
					'tgl_id' => $so,
				);
				//$this->Mtrans->tambah_pembeli($t); //rev ilham 8317
				$this->Mtrans->update_pembeli($t, $id_pembeli);
				$id_pembeli_email = $id_pembeli;
			}
			/// cekemail



			////if	
			$this->session->set_userdata('tahap2', TRUE);

			//redirect('C_pesanproduk/bayar2/'.$id_pembeli.'/'.$so.'/'.$id_pembeli_email.'/'.$id_user_save);

			///buat kodepembayaran
			$this->new_kdpembayaran($id_pembeli, $so, $id_user_save, $id_pembeli_email, $via);
			////if		

		} else {

			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Mohon Di Ulang Kembali.');
			redirect('welcome/beli_produk/' . $id_pembeli);
		} //palidasi
		/////
	}

	function bayar2($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via, $kodepembayaran, $getidall)
	{
		if ($this->sort_tanggal == $tglsort and $via != NULL) {

			// $this->session->set_userdata('tahap2',FALSE);



			/////////

			$tpkd = 0;

			if ($via == 'VOUCHER') {

				//$this->session->set_userdata('tahap3',TRUE);
				$this->trans_vocher($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
			} elseif ($via == 'PARSEL') {
				//$this->trans_vocher_parsel($id_pembeli,$tglsort,$id_pembeli_email,$id_user_save,$via);
			} elseif ($via == 'SONGSONG') {
				$this->trans_vocher_song2($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
			} elseif ($via == 'MAHASISWA') {
				$this->trans_vocher_mhs($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
			} elseif ($via == 'GAJI13') {
				$this->trans_vocher_gj13($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
			}
			///TRANSFER 201808
			elseif ($via == 'TRANSFER') {
				$tpkd = 1;
				$this->via_transfer($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
			} else { ///selain vocher

				////////////////////////////////////////////////////////////////////////////////////////////////////////
				//update metode pembayaran
				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli
				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session
				////////////////////////////////////////////////////////////////////////////////////////////////////////



			}


			///kirim email
			$this->email_pesan($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);

			$this->session->set_flashdata('modses', '1');
			$this->session->set_userdata('idtgl', $tglsort);

			if ($tpkd == '1') {
				//send notif email kode[pembayaran]
				$this->send_email_pembeli_pesan($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
				//tampilkan 
				redirect('welcome/tq_bk/' . $id_pembeli_email . '/' . $tglsort . '?idp=' . $id_pembeli . '&&nm=' . $this->input->post('namapembeli') . '&&kd=' . $kodepembayaran . '&&tr=' . $getidall . '&&v=' . $via);
			} else {
				redirect('welcome/tq/' . $id_pembeli_email . '/' . $tglsort . '?idp=' . $id_pembeli . '&&nm=' . $this->input->post('namapembeli') . '&&kd=tpkd' . $kodepembayaran);
			}


			///REV 160717
		} else {
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			///
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 ');

			redirect('welcome/beli_produk/');

			///////*/

		}
	}

	function trans_vocher_old($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			//$this->session->set_userdata('tahap3',FALSE);



			///REV 160717

			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi
			$getvou = $this->Mtrans->get_voucher_tbluser($id_pembeli);	 //tblambil voucher di tbl user
			$getvoucher = $this->Mtrans->get_voucher_tbluser_vocer($id_pembeli);	 //tblambil voucher di tbl user	

			///if voucher lebih besar dari total belanja
			if ($getvou >= $gettotal) { //lolos
				///PErpindahan VOUCHER
				$sisavoc = $getvou - $gettotal;
				$transit0 = $gettotal;
				$transit = $getvoucher->row()->voucher_dibelanjakan + $gettotal;
				//update metode pembayaran
				$vocer = array(
					'voucher_dibelanjakan' => $transit,
					'voucher_umy' => $sisavoc,
				);

				//riwayat

				//update metode pembayaran
				$rwytvocer = array(
					'id_user' => $id_user_save,
					'kontek' => 'Belanja === ' . $gettotal,
					'voucher_dibelanjakan' => $transit,
					'voucher_umy' => $sisavoc,
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					////rev011017
					'kode' => 2,
					'j_voucher' => 0, ///makan
					'belanja' => $gettotal,
					'id_voc' => $this->id_voc,

					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);

				///////
				//update metode pembayaran

				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'id_voc' => $this->id_voc,
					'j_voucher' => 0, ///makan
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli

				/////////

				//////////////////////////////////////////////////////////////////////////////////////////////////////

				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session

				$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
				//$ck_idtgl_tran=$this->Mtrans->cek_tran_voc_bel($id_user_save); //id_pembeli pake session
				$ck_idtgl_tran = $this->Mtrans->cek_tran_voc_bel($id_tgl, $id_user_save); //id_pembeli pake session

				//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



				//db tbl voucher
				if ($ck_ya == FALSE and $ck_idtgl_tran == FALSE) {

					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
					$this->Mtrans->simpan_update_tbluser($id_pembeli, $vocer); //update infor



				} else {
					$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

					redirect('welcome/beli_produk/');
				}
				//db tbl voucher

				///PErpindahan VOUCHER

				////////////////////////////////////////////////////////////////////////////////////////////////////////




			} else { //gagal voucher tidak cukup

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Saldo VOUCHER Anda ( ' . $getvou . ' ) Tidak Mencukupi ( ' . $gettotal . ' ).<br/>
			<a type="button" class="btn btn-warning btn-block" href="' . base_url('Welcome/batalpesan/' . $id_pembeli) . '" onclick="return confirm("Anda yakin?"")">BATAL PEMESANAN
     	</a>
			');

				redirect('welcome/beli_produk/');
			} //perbandingan vouchet dan total belanja
		} else //TIDAK LOLOS GERBANG PERTAMA

		{
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			////
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}

	function email_pesan($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{


		$via_ = 'VOUCHER';
		// if($via=='VOUCHER'){
		//     $via_='';
		// }

		if ($via == 'VOUCHER') {
			$via = 'UMY';
		}

		if ($via == 'TUNAI') {
			$via_ = '';
		}
		//////////////notifikasi email 21/3/17
		///////////////22/3/17
		$list = $this->Mtrans->get_transaksi_produk_persorttgl_dipesan_email($tglsort, $id_user_save);
		$listpenjual = $this->Mtrans->gettranproduk_dipesan_forpenjual_email($tglsort, $id_user_save);
		////////////////////

		$idtagihan = $tglsort;
		$list_kd = $this->Mbank->cek_transaksi_pembeli($id_user_save, $tglsort);	//tbltransaksi

		if ($list_kd->num_rows() > 0) {
			$idtagihan = $list_kd->row()->notagihan;
		}

		///------------------------------------->>UNTUK PEMBELI=====================================
		//////////////notifikasi email 21/3/17

		///=========================LOOP PENJUAL


		foreach ($listpenjual->result() as $tt) { ///loop 1
			///////
			$totp = 0;
			/////ISI per penjual

			///---------------------------------------->>>UNTUK PENJUAL
			$isipesan = '
		Selamat Produk yang Anda jual Sudah Dipesan.<br/>
		Berikut Data Pembeli :<br/>
<table class="table" border="0" width="100%">
	
	<tr style="background: #cbdbc8; border-bottom: 1px" align="left">
			<td colspan="1" width="10%">No. </td>
    		<td>' . $idtagihan . '</td>
	</tr>
    <tr style="background: #cbdbc8; border-bottom: 1px" align="left">
			<td colspan="1" width="10%">Nama Pembeli </td>
    		<td>' . $this->input->post('namapembeli') . '</td>
	</tr>
	<tr style="background: #cbdbc8; border-bottom: 1px" align="left">
			<td colspan="1" width="10%">No. telepon </td>
    		<td>' . $this->input->post('hppembeli') . '</td>
	</tr>
	<tr style="background: #cbdbc8; border-bottom: 1px" align="left">
			<td colspan="1" width="10%">Pembayaran melalui</td>
    		<td> ' . $via_ . ' ' . $via . '</td>
	</tr>
	<tr style="background: #cbdbc8; border-bottom: 1px" align="left">
		
			<td colspan="1" width="10%">Alamat</td>
    		<td>' . $this->input->post('alamatpembeli') . '</td>
	</tr>
    <tr style="background: #cbdbc8; border-bottom: 1px" align="left">
			<td colspan="1" width="10%">Tanggal </td>
    		<td>' . $this->harinow . '</td>
	</tr>
</table><br/><br/>
		Berikut Data Produk Yang dipesan :<br/><br/>
		<table class="table" border="0" width="100%">
	<tr style="background: #c1c1ca; border-bottom: 1px" align="center">
			<td colspan="2">Nama Produk </td>
    		<td>Total</td>
	</tr>
	';
			///////

			//$barang = $this->Muser->get_produk_by_id($tt->id_produk);

			//$Emailto =$this->Muser->get_user_by_id($barang->row()->id_user)->row()->username;
			$Emailto = $this->Muser->get_user_by_id($tt->id_pelapak)->row()->username;
			//$list = $this->Mtrans->get_produk_perpelapak($id_pembeli,$tt->id_pelapak);
			//v2
			$list = $this->Mtrans->get_produk_perpelapak_vokemail($tglsort, $tt->id_pelapak);
			$isipesan1 = '';
			foreach ($list->result() as $t) { ///LOOP 2
				/////NUMROWS()
				$numqty = $this->Mtrans->m_numrowsqty_pelapak_email($t->id_produk, $id_pembeli_email, $tt->id_pelapak, $tglsort);
				/////NUMROWS()

				$barang = $this->Muser->get_produk_by_id($t->id_produk);
				if (empty($barang->row()->hargak)) {
					$harga = $barang->row()->harga;
				} else {
					$harga = $barang->row()->hargak;
				}
				$isipesan1 = '	
   
	<tr style="background: #dcdce0">
		<td align="left" width="5%">
		<img src="' . base_url() . '/upload/barang/' . $barang->row()->gambar . '" alt="E-Retail" style="width: 100px; height: 90px"/>
		</td>
		<td colspan="2">' . $numqty . ' <b>' . $barang->row()->nama . '</b><br/>
		
		</td>
	</tr>
	
	<tr style="background: #c1c1ca; border-bottom: 1px" align="center">
			<td colspan="1"> </td>
			<td colspan="1" align="right">Sub Total </td>
    		<td colspan="1" align="right">' . number_format($numqty * $t->harga_satuan, 2, ',', '.') . '</td>
	</tr>
	
    ' . $isipesan1;
				$totp = $totp + ($numqty * $t->harga_satuan) + 0;
			} ///loop 2
			////=================================================================penjual
			$isipesan2 = '
	<tr style="background: #c1c1ca; border-bottom: 1px" align="center">
			<td colspan="1"> </td>
			<td colspan="1" align="right">Ongkos Kirim </td>
    		<td align="right">' . number_format(0, 2, ',', '.') . '</td>
	</tr>
	<tr style="background: #c1c1ca; border-bottom: 1px" align="center">
			<td colspan="2" align="left">Total yang diterima</td>
    		<td align="right" style="background: #38d112">' . number_format($totp, 2, ',', '.') . '</td>
	</tr>
	<!---->
</table><br/>

Info lengkap silahkan <a href="' . base_url('Login') . '">Login</a><br/>
<br/><br/><br/><br/>

	</div>
	
		';
			/////
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
			$mail->Subject    = "Notifikasi - [E-Retail SUPERMALL] - " . time();

			$mail->Body      = '
            <html>
            <head>
            <title>E-Retail SUPERMALL</title>
            </head>
            <body>
            <h3>E-Retail SUPERMALL</h3>
            <hr />
            ' . $isipesan . ' ' . $isipesan1 . ' ' . $isipesan2 . '<br>
            <p><hr /></p>
            <p><a href="E-Retail.com">E-Retail SUPERMALL<a/></p>
            </body>
            </html>
        ';
			// $email="ilhamroyroy@gmail.com";
			$mail->AddAddress($Emailto);
			if (!$mail->Send()) {

				echo ('SALAH' . $mail->ErrorInfo);
			} else {

				echo ('benar');
			}
		} //loop 1



	}

	function trans_vocher_parsel($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///REV 160717

			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi ok

			$tosaldopar = $gettotal;
			///if voucher lebih besar dari total belanja
			if ($tosaldopar != $gettotal) { //lolos


				//riwayat

				//update metode pembayaran
				$rwytvocer = array(
					'id_user' => $id_user_save,
					'kontek' => 'Belanja [PARSEL] === ' . $gettotal,
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					////rev011017
					'kode' => 2,
					'belanja' => $gettotal,
					'id_voc' => 0,
					'id_voc_p' => $id_voc_s,
					'j_voucher' => 1, ///parsel

					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);

				///////
				//update metode pembayaran
				$via = 'VOUCHER';
				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'j_voucher' => 1, ///parsel
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'id_voc' => 0, ///
					'id_voc_p' => $id_voc_s, ///
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli

				/////////

				//////////////////////////////////////////////////////////////////////////////////////////////////////

				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session

				$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
				$ck_idtgl_tran = $this->Mtrans->cek_tran_voc_bel($id_tgl, $id_user_save); //id_pembeli pake session

				//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



				//db tbl voucher
				if ($ck_ya == FALSE and $ck_idtgl_tran == FALSE) {
					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
				} else {
					$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

					redirect('welcome/beli_produk/');
				}
				//db tbl voucher

				///PErpindahan VOUCHER

				////////////////////////////////////////////////////////////////////////////////////////////////////////




			} else { //gagal voucher tidak cukup

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Saldo VOUCHER Anda ( ' . $getvou . ' ) Tidak Mencukupi ( ' . $gettotal . ' ).<br/>
			<a type="button" class="btn btn-warning btn-block" href="' . base_url('Welcome/batalpesan/' . $id_pembeli) . '" onclick="return confirm("Anda yakin?"")">BATAL PEMESANAN
     	</a>
			');

				redirect('welcome/beli_produk/');
			} //perbandingan vouchet dan total belanja
		} else //TIDAK LOLOS GERBANG PERTAMA

		{
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			////
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}

	function trans_vocher_song2($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///REV 160717

			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi ok

			$gta = $this->M_gvocall->gvall(2, $id_user_save);
			$tosaldopar = $gta['saldo'];
			$gta['id_voc'];


			///if voucher lebih besar dari total belanja

			if ($tosaldopar >= $gettotal) { //lolos


				//riwayat

				//update metode pembayaran
				$rwytvocer = array(
					'id_user' => $id_user_save,
					'kontek' => 'Belanja [SONGSONG] === ' . $gettotal,
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					////rev011017
					'kode' => 2,
					'belanja' => $gettotal,
					'id_voc' => 0,
					'id_voc_p' => $gta['id_voc'],
					'j_voucher' => 2, ///parsel

					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);

				///////
				//update metode pembayaran
				$via = 'VOUCHER';
				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'j_voucher' => 2, ///parsel
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'id_voc' => 0, ///
					'id_voc_p' => $gta['id_voc'], ///
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli

				/////////

				//////////////////////////////////////////////////////////////////////////////////////////////////////

				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session  	


				$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
				$ck_idtgl_tran = $this->Mtrans->cek_tran_voc_bel($id_tgl, $id_user_save); //id_pembeli pake session

				//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



				//db tbl voucher
				if ($ck_ya == FALSE and $ck_idtgl_tran == FALSE) {
					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
				} else {
					$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

					redirect('welcome/beli_produk/');
				}
				//db tbl voucher

				///PErpindahan VOUCHER

				////////////////////////////////////////////////////////////////////////////////////////////////////////




			} else { //gagal voucher tidak cukup

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Saldo VOUCHER Anda ( ' . $tosaldopar . ' ) Tidak Mencukupi ( ' . $gettotal . ' ).<br/>
			<a type="button" class="btn btn-warning btn-block" href="' . base_url('Welcome/batalpesan/' . $id_pembeli) . '" onclick="return confirm("Anda yakin?"")">BATAL PEMESANAN
     	</a>
			');

				redirect('welcome/beli_produk/');
			} //perbandingan vouchet dan total belanja
		} else //TIDAK LOLOS GERBANG PERTAMA

		{
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			////
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2 #songsong');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}

	function trans_vocher_mhs($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///REV 160717

			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi ok

			////----------VOUCHER MAHSISWA
			$gta = $this->M_gvocall->gvall(3, $id_user_save);
			$tosaldopar = $gta['saldo'];
			$gta['id_voc'];
			///if voucher lebih besar dari total belanja

			if ($tosaldopar >= $gettotal) { //lolos


				//riwayat

				//update metode pembayaran
				$rwytvocer = array(
					'id_user' => $id_user_save,
					'kontek' => 'Belanja [SONGSONG] === ' . $gettotal,
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					////rev011017
					'kode' => 2,
					'belanja' => $gettotal,
					'id_voc' => 0,
					'id_voc_p' => $gta['id_voc'],
					'j_voucher' => 3, ///mhs

					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);

				///////
				//update metode pembayaran
				$via = 'VOUCHER';
				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'j_voucher' => 3, ///mhs
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'id_voc' => 0, ///
					'id_voc_p' => $gta['id_voc'], ///
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli

				/////////

				//////////////////////////////////////////////////////////////////////////////////////////////////////

				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session  	


				$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
				$ck_idtgl_tran = $this->Mtrans->cek_tran_voc_bel($id_tgl, $id_user_save); //id_pembeli pake session

				//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



				//db tbl voucher
				if ($ck_ya == FALSE and $ck_idtgl_tran == FALSE) {
					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
				} else {
					$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

					redirect('welcome/beli_produk/');
				}
				//db tbl voucher

				///PErpindahan VOUCHER

				////////////////////////////////////////////////////////////////////////////////////////////////////////




			} else { //gagal voucher tidak cukup

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Saldo VOUCHER Anda ( ' . $tosaldopar . ' ) Tidak Mencukupi ( ' . $gettotal . ' ).<br/>
			<a type="button" class="btn btn-warning btn-block" href="' . base_url('Welcome/batalpesan/' . $id_pembeli) . '" onclick="return confirm("Anda yakin?"")">BATAL PEMESANAN
     	</a>
			');

				redirect('welcome/beli_produk/');
			} //perbandingan vouchet dan total belanja
		} else //TIDAK LOLOS GERBANG PERTAMA

		{
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			////
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2 #songsong');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}

	function trans_vocher($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			//$this->session->set_userdata('tahap3',FALSE);



			///REV 160717

			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi

			$getvou = $this->Mtrans->get_voucher_tbluser($id_pembeli);	 //tblambil voucher di tbl user
			$getvoucher = $this->Mtrans->get_voucher_tbluser_vocer($id_pembeli);	 //tblambil voucher di tbl user	

			////20180501
			$iduser = $id_user_save;

			$gta = $this->M_gvocall->gvall(0, $id_user_save);
			$tosaldopar = $gta['saldo'];
			$gta['id_voc'];

			///if voucher lebih besar dari total belanja


			if ($tosaldopar >= $gettotal) { //lolos
				///PErpindahan VOUCHER
				$sisavoc = $getvou - $gettotal;
				$transit0 = $gettotal;
				$transit = $getvoucher->row()->voucher_dibelanjakan + $gettotal;

				//update metode pembayaran
				$vocer = array(
					'voucher_dibelanjakan' => $transit,
					'voucher_umy' => $sisavoc,
				);

				//riwayat

				//update metode pembayaran
				$rwytvocer = array(
					'id_user' => $id_user_save,
					'kontek' => 'Belanja === ' . $gettotal,
					'voucher_dibelanjakan' => $transit,
					'voucher_umy' => $sisavoc,
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					////rev011017
					'kode' => 2,
					'j_voucher' => 0, ///makan
					'belanja' => $gettotal,
					'id_voc' => $gta['id_voc'],

					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);

				///////
				//update metode pembayaran

				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'id_voc' => $gta['id_voc'],
					'j_voucher' => 0, ///makan
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli

				/////////

				//////////////////////////////////////////////////////////////////////////////////////////////////////

				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session

				$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
				//$ck_idtgl_tran=$this->Mtrans->cek_tran_voc_bel($id_user_save); //id_pembeli pake session
				$ck_idtgl_tran = $this->Mtrans->cek_tran_voc_bel($tglsort, $id_user_save); //id_pembeli pake session

				//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



				//db tbl voucher
				if ($ck_ya == FALSE and $ck_idtgl_tran == FALSE) {

					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
					$this->Mtrans->simpan_update_tbluser($id_pembeli, $vocer); //update infor



				} else {
					$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

					redirect('welcome/beli_produk/');
				}
				//db tbl voucher

				///PErpindahan VOUCHER

				////////////////////////////////////////////////////////////////////////////////////////////////////////




			} else { //gagal voucher tidak cukup

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Saldo VOUCHER Anda ( ' . $tosaldopar . ' ) Tidak Mencukupi ( ' . $gettotal . ' ).<br/>
			<a type="button" class="btn btn-warning btn-block" href="' . base_url('Welcome/batalpesan/' . $id_pembeli) . '" onclick="return confirm("Anda yakin?"")">BATAL PEMESANAN
     	</a>
			');

				redirect('welcome/beli_produk/');
			} //perbandingan vouchet dan total belanja
		} else //TIDAK LOLOS GERBANG PERTAMA

		{
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			////
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}

	///VOUCHER GAJI 13

	function trans_vocher_gj13($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///REV 160717

			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi ok

			$idjov = 4;
			// $tosaldopar=$this->M_gvocall->gvall($idjov,$id_user_save)['saldo'];
			$gta = $this->M_gvocall->gvall($idjov, $id_user_save);
			$tosaldopar = $gta['saldo'];
			$gta['id_voc'];
			///if voucher lebih besar dari total belanja
			if ($tosaldopar >= $gettotal) { //lolos


				//riwayat

				//update metode pembayaran
				$rwytvocer = array(
					'id_user' => $id_user_save,
					'kontek' => 'Belanja [GAJI 13] === ' . $gettotal,
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					////rev011017
					'kode' => 2,
					'belanja' => $gettotal,
					'id_voc' => 0,
					'id_voc_p' => $gta['id_voc'],
					'j_voucher' => $idjov, ///parsel

					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);

				///////
				//update metode pembayaran
				$via = 'VOUCHER';
				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'j_voucher' => $idjov, ///parsel
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'id_voc' => 0, ///
					'id_voc_p' => $gta['id_voc'], ///
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli

				/////////
				//////////////////////////////////////////////////////////////////////////////////////////////////////

				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session

				$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
				$ck_idtgl_tran = $this->Mtrans->cek_tran_voc_bel($id_tgl, $id_user_save); //id_pembeli pake session

				//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



				//db tbl voucher
				if ($ck_ya == FALSE and $ck_idtgl_tran == FALSE) {
					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
				} else {
					$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

					redirect('welcome/beli_produk/');
				}
				//db tbl voucher

				///PErpindahan VOUCHER

				////////////////////////////////////////////////////////////////////////////////////////////////////////




			} else { //gagal voucher tidak cukup

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Saldo VOUCHER Anda ( ' . $tosaldopar . ' ) Tidak Mencukupi ( ' . $gettotal . ' ).<br/>
			<a type="button" class="btn btn-warning btn-block" href="' . base_url('Welcome/batalpesan/' . $id_pembeli) . '" onclick="return confirm("Anda yakin?"")">BATAL PEMESANAN
     	</a>
			');

				redirect('welcome/beli_produk/');
			} //perbandingan vouchet dan total belanja
		} else //TIDAK LOLOS GERBANG PERTAMA

		{
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			////
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}

	////VIA TRANSFER

	function via_transfer($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///REV 201808
			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi

			//riwayat

			//update metode pembayaran
			$rwytvocer = array(
				'id_user' => $id_user_save,
				'kontek' => 'Belanja [TRANSFER] === ' . $gettotal,
				'tgl_trans' => $this->harinow,
				'id_tgl' => $tglsort,
				////rev011017
				'kode' => 2,
				'belanja' => $gettotal,

				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);

			///////
			//

			//update metode pembayaran
			$u = array(
				'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
				'metode' => $via,
				'buy' => 'dipesan',
				'tgl_trans' => $this->harinow,
				'id_tgl' => $tglsort,
				'id_user' => $id_user_save, ///harus make id_user
				'nama_pembeli' => $this->input->post('namapembeli'),
				///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
				//untuk keperuan nota treansaksi
			);
			//mencatat nama pembeli

			/////////

			//////////////////////////////////////////////////////////////////////////////////////////////////////

			$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session

			$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
			//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



			//db tbl voucher
			if ($ck_ya == FALSE) {
				$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
			} else {
				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

				redirect('welcome/beli_produk/');
			}
			//db tbl voucher

			///PErpindahan VOUCHER
			////////////////////////////////////////////////////////////////////////////////////////////////////////
		} else //TIDAK LOLOS GERBANG KEDUA

		{
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}

	function new_kdpembayaran($id_pembeli, $so, $id_user_save, $id_pembeli_email, $via)
	{

		if ($this->sort_tanggal == $so) {

			$getidall = $this->Mtrans->get_id_t_tbltransaksi_p($id_user_save);	//tbltransaksi
			$cekidall = $this->Mtrans->cek_id_t_tbltransaksi_p($getidall);	//tbltransaksi

			//$list = $this->Mbank->get_tot_transaksi_peridtran($so,$id_pembeli);	//pake id sebelum di save id pembeli email 

			$tot = $gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi;

			$kodepembayaran = $this->Mtrans->validnopembayaran();



			$vtran = FALSE;
			if ($via == 'TRANSFER') {

				$vtran = TRUE;
				$cek_kode = $this->Mtrans->cekkodepembayaran($kodepembayaran);
				if ($cek_kode == 1) { ///cek kodepembayaran	
					redirect('welcome/beli_produk/?error=Mohon ulangi kembali');
				}
			} else {
				$kodepembayaran = 'BM' . $kodepembayaran;
			}



			$d = [
				'kodepembayaran' => $kodepembayaran,

				'total' => $tot,

				'id_user' => $id_user_save,
				'id_p' => $id_pembeli, //sebelum
				'id_p_after' => $id_pembeli_email, //sesudah
				'id_transaksi' => $getidall,
				'idtgl' => $so,
				'transfer' => $vtran,

				'status' => '0', //proses
				'tgl_t' => $this->harinow,
			];


			if ($cekidall == 0) { //cek id transaksi 


				///TRANSFER 201808
				///proses lanjut
				$this->Mtrans->savekodepembayaran($d);     //db bm        

				$this->bayar3($id_pembeli, $so, $id_pembeli_email, $id_user_save, $via, $kodepembayaran, $getidall);
			} else {
				$this->Mtrans->delidtkodepembayaran($getidall);
				redirect('welcome/beli_produk/?error=2');
			}



			///*/




		} else {
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			');

			redirect('welcome/beli_produk/');
		}
	}




	////////////KIRIM EMAIl ODE pEMBAYARAN

	function send_email_pembeli_pesan($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{
		//////////////notifikasi email 21/3/17
		$list = $this->Mbank->get_tot_transaksi_peridtran($tglsort, $id_pembeli_email);
		$tot = $list;

		$list_kd = $this->Mbank->cek_transaksi_pembeli($id_pembeli_email, $tglsort);	//tbltransaksi login
		$idtagihan = $tglsort;
		$kd = '-';
		if ($list_kd->num_rows() > 0) {
			$kd = $list_kd->row()->kodepembayaran;
			$idtagihan = $list_kd->row()->notagihan;
		}



		///---------------------------------------->>>UNTUK PEMBELI=================================================================
		$isitagihan = '
			    <table width="100%" border="1">
			        	<tr align="center" width="50%">
			        		<td >
			                <div >
			                <h3>    
			                <em>KODE PEMBAYARAN</em><br/>
			                    ' . $kd . '     
			                </h3>
			                </div>
			               
			                </td>
			        		<td>
			                <h4><em>Jumlah</em>
			                <br/>
			                Rp ' . number_format($tot, 2, ',', '.') . '</h4>
			                </td>
			        	</tr>
			      </table>
			      <hr/>
				
				
				<div style="background: #edf1f1; border-radius: 10px"><br/>
					<h1>E-Retail</h1>
					<h3>BUKTI PEMESANAN BARANG</h3>
					<hr/>
					Hai ' . $this->input->post('namapembeli') . ',<br/>
			Terima kasih atas kepercayaan anda berbelanja di E-Retail.
			<br/>
			<br/>
			Berikut adalah penjelasan tagihan: 
			<table class="table" border="0" width="100%">
				<tr style="background: #cbdbc8; border-bottom: 1px" align="left">
						<td colspan="1" width="20%">No. Transaksi</td>
			    		<td>' . $idtagihan . '</td>
				</tr>
			    
			    <tr style="background: #cbdbc8; border-bottom: 1px" align="left">
						<td colspan="1" width="20%">Tanggal Transaksi</td>
			    		<td>' . $this->harinow . '</td>
				</tr>
				
			    <tr style="background: #cbdbc8; border-bottom: 1px" align="left">
						<td colspan="1" width="10%">Pembayaran Melalui</td>
			    		<td>' . $via . '</td>
				</tr>
			    
			    <tr style="background: #cbdbc8; border-bottom: 1px" align="left">
						<td colspan="1" width="10%">Total pembayaran </td>
			    		<td>' . $tot . '</td>
				</tr>
				

				
				
				<!---->
			    </table>

			<br/>
					';

		///========================================PEMBELI
		$isitagihan2 = '
    
    Terimaksih . 
	<br/>
    <p><a href="' . base_url('welcome/tq_bk/' . $id_pembeli_email . '/' . $tglsort . '#' . $id_pembeli . '!$%$#%^3$' . $this->input->post('namapembeli')) . '">Lihat Detail Tagihan </a></p><br/>
    <br/><br/><br/><br/>

	</div>
		
		';

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
		$mail->Subject    = "Notifikasi - [E-Retail SUPERMALL] - " . time();

		$mail->Body      = '
            <html>
            <head>
            <title>E-Retail SUPERMALL</title>
            </head>
            <body>
            <h3>E-Retail SUPERMALL</h3>
            <hr />
            ' . $isitagihan . ' ' . $isitagihan2 . '<br>
            <p><hr /></p>
            <p><a href="E-Retail.com">E-Retail SUPERMALL<a/></p>
            </body>
            </html>
        ';
		//$email="ilhamroyroy@gmail.com";
		$mail->AddAddress($this->input->post('email'), $this->input->post('namapembeli'));
		if (!$mail->Send()) {

			echo ('SALAH' . $mail->ErrorInfo);
		} else {

			echo ('benar');
		}


		//echo $isitagihan.$isitagihan2;



	}

	function conf_mail()
	{

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
		$mail->Subject    = "Notifikasi - [E-Retail SUPERMALL] - " . time();

		return $mail;
	}

	function bayar3($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via, $kodepembayaran, $getidall)
	{
		if ($this->sort_tanggal == $tglsort and $via != NULL) {
			$tpkd = 0;

			if ($via == 'DOMPET') {

				//$this->session->set_userdata('tahap3',TRUE);
				$this->trans_dompet($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
			} elseif ($via == 'TRANSFER') {

				$tpkd = 1;
				$this->via_transfer($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
			} else { ///selain vocher

				////////////////////////////////////////////////////////////////////////////////////////////////////////
				//update metode pembayaran
				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli
				$this->Mtrans->update_bayar($id_user_save, $u); //id_pembeli pake session
				////////////////////////////////////////////////////////////////////////////////////////////////////////



			}


			///kirim email
			$this->email_pesan($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);

			$this->session->set_flashdata('modses', '1');
			$this->session->set_userdata('idtgl', $tglsort);

			if ($tpkd == '1') {
				//send notif email kode[pembayaran]
				$this->send_email_pembeli_pesan($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via);
				//tampilkan 
				redirect('welcome/tq_bk/' . $id_pembeli_email . '/' . $tglsort . '?idp=' . $id_pembeli . '&&nm=' . $this->input->post('namapembeli') . '&&kd=' . $kodepembayaran . '&&tr=' . $getidall . '&&v=' . $via);
			} else {
				redirect('welcome/tq/' . $id_pembeli_email . '/' . $tglsort . '?idp=' . $id_pembeli . '&&nm=' . $this->input->post('namapembeli') . '&&kd=tpkd' . $kodepembayaran);
			}


			///REV 160717
		} else {
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			///
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 ');

			redirect('welcome/beli_produk/');

			///////*/

		}
	}

	function trans_dompet($id_pembeli, $tglsort, $id_pembeli_email, $id_user_save, $via)
	{

		if ($this->sort_tanggal == $tglsort and $via != NULL and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			///REV 160717
			$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi ok
			$idjov = 99;
			// $tosaldopar=$this->M_gvocall->gvall($idjov,$id_user_save)['saldo'];
			$gta = $this->M_dompetKu->saldoDompet();  ///DOMPET
			$tosaldopar = $gta['saldoKu'];

			///if voucher lebih besar dari total belanja

			if ($tosaldopar >= $gettotal) { //lolos
				//riwayat

				//update metode pembayaran
				$rwytvocer = array(
					'id_user' => $id_user_save,
					'kontek' => 'Belanja [GAJI 13] === ' . $gettotal,
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					////rev011017
					'kode' => 2,
					'belanja' => $gettotal,
					'j_voucher' => $idjov, ///

					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);

				///////
				//update metode pembayaran
				$via = 'VOUCHER';

				$u = array(
					'id_pembeli' => $id_pembeli_email, ///bisa make id_user atau id_pembeli UNTUK KE TABEL PEMBELI
					'metode' => $via,
					'j_voucher' => $idjov, ///
					'buy' => 'dipesan',
					'tgl_trans' => $this->harinow,
					'id_tgl' => $tglsort,
					'id_user' => $id_user_save, ///harus make id_user
					'nama_pembeli' => $this->input->post('namapembeli'),
					///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
					//untuk keperuan nota treansaksi
				);
				//mencatat nama pembeli

				/////////
				//////////////////////////////////////////////////////////////////////////////////////////////////////

				$this->Mtrans->update_bayar($id_pembeli, $u); //id_pembeli pake session

				$ck_ya = $this->Mtrans->cek_tran_produk_ya($id_pembeli); //id_pembeli pake session
				$ck_idtgl_tran = $this->Mtrans->cek_tran_voc_bel($id_tgl, $id_user_save); //id_pembeli pake session

				//JIKA TRANSAKSI PRODUK SUDAH BERUBAH MENJADI DI PESAN MAKA LOLOS



				//db tbl voucher
				if ($ck_ya == FALSE and $ck_idtgl_tran == FALSE) {
					$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
				} else {
					$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAK LOLOS TAHAP TRANSFER');

					redirect('welcome/beli_produk/');
				}
				//db tbl voucher

				///PErpindahan VOUCHER

				////////////////////////////////////////////////////////////////////////////////////////////////////////




			} else { //gagal voucher tidak cukup

				$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Saldo VOUCHER Anda ( ' . $tosaldopar . ' ) Tidak Mencukupi ( ' . $gettotal . ' ).<br/>
			<a type="button" class="btn btn-warning btn-block" href="' . base_url('Welcome/batalpesan/' . $id_pembeli) . '" onclick="return confirm("Anda yakin?"")">BATAL PEMESANAN
     	</a>
			');

				redirect('welcome/beli_produk/');
			} //perbandingan vouchet dan total belanja
		} else //TIDAK LOLOS GERBANG PERTAMA

		{
			/*/////
		    echo $via.'<br/>';
		/////
            echo $this->sort_tanggal.' pc<br />';
            echo $tglsort.'<br />';
            echo $id_pembeli_email.'<br />';
            echo $id_user_save.'<br />';
        //////*/
			////
			$this->session->set_flashdata('pesanvo', 'Mohon Maaf , Penyimpanan Tidak Sempurna .
			<br/> Pastikan Internet Stabil .
			 TIDAKLOLOS TAHAP 2');

			redirect('welcome/beli_produk/');

			///////*/
		}
	}
	
} ///class
