<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_tagihanSelesai extends CI_Controller
{

    var $key;

    function __construct()
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

    function celLOgin()
    {
        $id_user = $this->input->post('id_user');
        if ($this->session->userdata('login') == FALSE or $this->session->userdata('id_user') != $id_user) {
            redirect('login');
        }
    }

    //OPTIMALISASI
    function transaksiSelesai($id, $ok, $ad = NULL)
    {
        $this->celLOgin();
        //
        $this->form_validation->set_rules('ck', 'ck', 'required'); ///valid_email
        if ($this->form_validation->run() == FALSE) {
            redirect('login');
        }
        //
        $val[0] = $this->input->post('ck');
        $val[1] = $this->input->post('jevoc');
        $val[2] = $this->key;
        $p = 1;

        switch ($val[1]) {
            case 'T':
                //transfer
                // $this->setujui_transaksi($id,$ok,$ad,$val[0],$val[2]);
                break;
            case 99:
                echo 'Via Dompet';
                $p = 2;
                //$this->setujui_transaksi_dompet($id,$ok,$ad,$val[0],$val[2]);
                break;
            default:
                $this->setujui_transaksi($id, $ok, $ad, $val[0], $val[2]);
                break;
        }


        // print_r($val);

        // die();

        $this->id_kuitansai($id, $val[0], $val[2]);

        $this->saveProsesTransaksi($id, $val[0], $val[2]);

        //$this->send_email_setuju($id,$ok,$ad,$val[0],$val[2]);

        // $this->otorisasi_1($ad,$p);

        redirect('C_transelesai/rinciTransaksi/' . $id . '/' . $id_user);
    }

    ///

    function transaksiSelesaiBatal($id, $ok, $ad = NULL)
    {
        $this->celLOgin();
        $this->form_validation->set_rules('ck', 'ck', 'required'); ///valid_email
        $okk = 1;

        if ($this->form_validation->run() == TRUE) {
            $valid = $this->input->post('ck');
            $jvocd = $this->input->post('jevoc');
            $noTag = $this->input->post('noTag');

            $key2 = $this->key;

            if ($ok == 'btl') {

                $okk * $this->btl_transaksi_v2($id, $ok, $ad, $valid, $key2, $jvocd);
                //up status tagihan
                $dNoTag = array('noTag' => $noTag, 'st' => 1); //1==tagihan selesai
                $okk *= $this->upTAgihanNoTag($dNoTag);
                // $ok=2;

                //up status tagihan
                if ($okk == 1) {
                    //  $this->btl_email($id,$ok,$ad,$valid,$key2); 
                } else {
                    $st = 'Proses pembatalan gagal';
                    $this->nextGagal($st);
                }
            }

            $this->otorisasi_1($ad, 1);
        } else { //not valid
            $st = 'Proses pembatalan gagal';
            $this->nextGagal($st);
        }
    }



    ////REV : 230817
    function otorisasi_1($ad = NULL, $p = 2)
    { /// d pakai //id tbl transaksi

        ////FOOTER
        if ($ad == 'user') {

            redirect('User_admin/barang_dipesan?date=&bd=1');
        } else {
            redirect('Master_admin/produkdipesan_all');
        }
    } //funsi


    function setujui_transaksi($id, $ok, $ad, $valid, $key2)
    {
        if ($valid != NULL and $key2 == $this->key) {

            $timezone  = +7; //(GMT +7:00) 
            //$hariini = gmdate('d-m-Y H:i:s', time() + 3600*($timezone+date('I')));
            $h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
            $hm = $h * 60;
            $ms = $hm * 60;
            $tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
            $waktu = gmdate("H:i:s", time() + ($ms));
            $xxx = substr($tanggal, '6', '4');
            $xx = substr($tanggal, '3', '2');
            $x = substr($tanggal, '0', '2');
            $hariini = $tanggal;
            $lanjut = 1;

            $data['tanggal'] = $tanggal = gmdate('d-m-Y', time() + 3600 * ($timezone + date('I')));
            ////////////////REVISI 15417
            $data['getidt'] = $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();
            ////////////////REVISI 201717
            $gettotal = $this->Mtrans->get_total_tbltransaksi_oto($id);    //tbltransaksi get qty*harga satuan
            //////rev Ilham 190717


            $u = array(
                'buy' => 'dibayar', //rev201902
                'tgl_otorisasi' => $hariini . ' ' . $waktu,
                'day' => $x,
                'bln' => $xx,
                'thn' => $xxx,
                'id_acc' => $id . '' . $key2, ///rev gen2

                ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
                //untuk keperuan nota treansaksi
            );

            //////////////////////////////////////////////////  

            if (!empty($getidt->metode) and !empty($getidt->id_pelapak) and  $gettotal != 0) {

                //////REV 050917 ///proses akhir

                /////  VIA TUNAI

                $lanjut *= $this->Mtrans->update_bayar_otorisasi($id, $u);
                $this->session->set_flashdata('pesan', 'Transaksi Selesai');

                //////REV 050917
            } else {
                $st = 'Proses pembatalan gagal';
                $this->nextGagal($st);
                $lanjut = 0;
            }



            //////////////////////////////////////////////////  

        } else {
            $st = 'Proses pembatalan gagal';
            $this->nextGagal($st);
            $lanjut = 0;
        }

        return $lanjut;
    }

    function btl_email($id, $ok, $ad = NULL, $valid, $key2)
    {
        $this->celLOgin();
        ///////EMAIL
        if ($valid != NULL and $key2 == $this->key) {
            require APPPATH . "third_party/PHPMailer-master/src/PHPMailer.php"; //SMTP.php
            require APPPATH . "third_party/PHPMailer-master/src/SMTP.php"; //SMTP.php
            require APPPATH . "third_party/PHPMailer-master/src/Exception.php"; //SMTP.php	    

            $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();
            // renovasi
            $idtblpembeli = $this->Mtrans->get_tbl_userpenjual($getidt->id_user);
            //
            $idtblpelapak = $this->Mtrans->get_tbl_userpenjual($getidt->id_pelapak);
            $idtblproduk = $this->Mtrans->get_tbl_produk($getidt->id_produk);

            $btal = 'Mohon Maaf, <br/>
	 		
			Produk ' . $idtblproduk->row()->nama . '<br/>
			Sebanyak ' . $getidt->qty . '<br/>
			Yang Saudara pesan di penjual <br/>
    	    nama : ' . $idtblpelapak->row()->nama . '<br/> 
    	    email : ' . $idtblpelapak->row()->username . '<br/>
			Telah dibatalkan.<br/>
			Karena : ' . $this->input->post('alasan') . ' . <br/>
			
			
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

            $mail->Subject    = "TRANSAKSI PRODUK - [E-Retail]";
            $mail->Body      = $btal;
            // $email="ilhamroyroy@gmail.com";
            $email = $idtblpembeli->row()->username;
            $mail->AddAddress($email);
            if (!$mail->Send()) {

                $st = 'Email Gagal Terkirim ' . $mail->ErrorInfo;
                $this->nextGagal($st);
            }

            ///////////def
            $gcek_status_tra = $this->Mtrans->cek_tab_transak_status($id, 'Batal_ot');

            // if(){
            if ($gcek_status_tra == FALSE) {
                $mail->Send();
            }
        } else {
            $st = 'Proses email gagal';
            $this->nextGagal($st);
        }
    }

    function tc()
    {
        echo 'ilham(' . $this->key;
        echo '<br />jam(' . $this->tgljam;
        echo '<br />key(' . $this->key;
        echo '<br />jam-detik(' . $this->tgljam_s;
    }

    public function send_email_setuju($id, $ok, $ad, $valid, $key2)
    {

        /////SEND EMAIl 201902
        require APPPATH . "third_party/PHPMailer-master/src/PHPMailer.php"; //SMTP.php
        require APPPATH . "third_party/PHPMailer-master/src/SMTP.php"; //SMTP.php
        require APPPATH . "third_party/PHPMailer-master/src/Exception.php"; //SMTP.php	    
        //
        $this->buildPdf_pembayaran();

        //
        $attched_file = $_SERVER["DOCUMENT_ROOT"] . "/application/third_party/pdf/bukti_transaksi.pdf";
        //

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

        $mail->Subject    = "BUKTI TRANSAKSI BARANG - [E-Retail]";
        $mail->Body      = '<h3>BUKTI PEMBAYARAN BARANG / KUITANSI (E-Retail)</h3>
        ';
        //$ci->email->attach($pdfroot);      	
        $mail->addAttachment($attched_file, 'bukti_transaksi.pdf');

        $email = "ilhamroyroy@gmail.com";
        $mail->AddAddress($email);
        if (!$mail->Send()) {

            echo ('gagal' . $mail->ErrorInfo);
        } else {

            echo ('sukses');
        }
    }

    ///////////////id_kuitansai

    function id_kuitansai($id, $valid, $key2)
    {
        $this->celLOgin();
        if ($valid != NULL and $key2 == $this->key) {
            $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();
            $jm = $this->M_time->tgljam_s();
            if ($getidt->id_user == 0) {
                $st = '';
                $idt = '';
            } else {
                $g_iduser = $this->Mtrans->get_voucher_tbluser_vocer($getidt->id_user);
                $st = $g_iduser->row()->job;
                $idt = $id;
            }



            $id_kui = $jm;
            $u = [
                'id_kuitansi' => $idt . '/' . $id_kui,
            ];
            $this->Mtrans->update_bayar_otorisasi($id, $u);
        } else {
            $st = 'Proses id_kuitansi gagal';
            $this->nextGagal($st);
        }
    }

    function btl_transaksi_v2($id, $ok, $ad, $valid, $key2, $jvocd = 0)
    {
        $this->celLOgin();
        $lanjut = 1;

        if ($valid != NULL and $key2 == $this->key) {

            $h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
            $hm = $h * 60;
            $ms = $hm * 60;

            $tanggal = $this->M_time->tglnow();
            $waktu = $this->M_time->time();
            $hariini = $tanggal;

            $xxx = substr($tanggal, '6', '4');
            $xx = substr($tanggal, '3', '2');
            $x = substr($tanggal, '0', '2');


            $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();
            $gettotal = $this->Mtrans->get_total_tbltransaksi_oto($id); //tbltransaksi get qty*harga satuan


            $u = array(
                'buy' => 'Batal_ot',
                'tgl_otorisasi' => $hariini . ' ' . $waktu,
                'day' => $x,
                'bln' => $xx,
                'thn' => $xxx,
                ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
                //untuk keperuan nota treansaksi
            );

            ////// REV 1417 INTI
            if ($gettotal != 0) {

                if ($getidt->metode == 'VOUCHER') {
                    /////////pengaman transaksi
                    $rwytvocer = array(
                        'id_user' => $getidt->id_user,
                        'id_transaksi' => $id,
                        'kode' => 4,
                        'kontek' => 'Pembatalan Belanja === ' . $gettotal . ' Karena : ' . $this->input->post('alasan'),
                        'tgl_trans' => $hariini . ' ' . $waktu,
                        'j_voucher' => $jvocd,
                        ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
                        //untuk keperuan nota treansaksi
                    );

                    $lanjut *= $this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riwayat	

                }
                // sukses
                $lanjut *= $this->Mtrans->update_bayar_otorisasi($id, $u);
                $this->session->set_flashdata('pesan', 'Transaksi Berhasil dibatalkan.');
            } else {
                //nol 
                $st = 'Proses transfer gagal';
                $this->nextGagal($st);
                $lanjut = 0;
            }
        } else {
            echo "error 100 *1";
            echo "<br/>" . $valid;
            echo "<br/>" . $this->key;
            echo "<br/>" . $key2;
            $lanjut *= 0;
        }

        return $lanjut;
    }

    ///201902
    function saveProsesTransaksi($id, $valid, $key2)
    {
        if ($valid != NULL and $key2 == $this->key) {
            $this->load->model('MtransaksiProses');
            $u = array(
                'ket' => 'proses',
                'idTransaksi' => $id,
                'proses' => 2, //1=selesai
                'durasi' => $this->M_time->tgl_ymd(),
                'tgl' => $this->M_time->harinow(),

            );
            /////////pengaman transaksi
            $this->MtransaksiProses->simpan_tablTransaksi_proses($u); //riweayat	



        }
    }
    function setujui_transaksi_dompet($id, $ok, $ad, $valid, $key2)
    {

        if ($valid != NULL and $key2 == $this->key) {

            $tanggal = $this->M_time->tglnow();
            $waktu = $this->M_time->time();

            $xxx = substr($tanggal, '6', '4');
            $xx = substr($tanggal, '3', '2');
            $x = substr($tanggal, '0', '2'); //day

            $hariini = $tanggal;

            $data['tanggal'] = $tanggal;

            ////////////////REVISI 15417
            $data['getidt'] = $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();
            ////////////////REVISI 201717
            $gettotal = $this->Mtrans->get_total_tbltransaksi_oto($id);    //tbltransaksi get qty*harga satuan
            $gettotal_p = $gettotal;    //tbltransaksi get qty*harga satuan
            $transit0 = $gettotal;

            //////////////////////////////////////////////////
            //riwayat
            //update metode pembayaran
            $rwytvocer = array(
                'id_user' => $getidt->id_user,
                'id_transaksi' => $id,
                'kode' => 3,
                'transit' => $gettotal,
                'id_penjual' => $getidt->id_pelapak,
                'kontek' => 'SETUJU Belanja (Saldo Dompet Pindah ke penjual) [DOMPET]=== ' . $gettotal,
                'tgl_trans' => $hariini . ' ' . $waktu,
                ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
                //untuk keperuan nota treansaksi
            );
            //////rev Ilham 190717
            $u = array(
                'buy' => 'diproses',
                'tgl_otorisasi' => $hariini . ' ' . $waktu,
                'day' => $x,
                'bln' => $xx,
                'thn' => $xxx,
                'id_acc' => $id . '' . $key2, ///rev gen2

                ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
                //untuk keperuan nota treansaksi
            );

            //////////////////////////////////////////////////  

            if (!empty($getidt->metode) and !empty($getidt->id_pelapak) and  $gettotal_p != 0) {

                //////REV 050917 ///proses akhir
                //=======================================================================================
                if ($getidt->metode == 'VOUCHER' and $getidt->j_voucher == '0') {
                    /////VIA VOUCHER	
                    $get_riwayat_vou = $this->Mtrans->get_tabl_riwayatvoc_true($id, $getidt->id_user, 3);
                    //$get_riwayat_vou=$this->Mtrans->get_tabl_riwayatvoc($id,$getidt->id_user,3); //riweayat	
                    ///rev 011017
                    if ($get_riwayat_vou == FALSE) {

                        $this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat	
                        /////  
                        $this->Mtrans->update_bayar_otorisasi($id, $u);
                    }

                    $this->session->set_flashdata('pesan', 'Transaksi Selesai');


                    //=========================================================================================

                } else {

                    /////  VIA TUNAI
                    $this->Mtrans->update_bayar_otorisasi($id, $u);
                    $this->session->set_flashdata('pesan', 'Transaksi Selesai');
                    //$key2=$this->key;   
                }
                //////REV 050917
            } else {
                $st = 'Proses pembatalan gagal';
                $this->nextGagal($st);
                $lanjut = 0;
            }

            //////////////////////////////////////////////////  

        } else {
            echo "error 1091 umy";
            $st = 'Proses pembatalan gagal';
            $this->nextGagal($st);
            $lanjut = 0;
        }
    }

    function rinciTransaksi($id, $id_user)
    {

        $this->celLOgin();

        $data = $this->Muser->getDataProfil();
        $data['d'] = 'active';
        $data['link'] = base_url('C_transelesai/send_email_setuju_lama/');
        $data['linkBack'] = base_url('User_admin/barang_dipesan?date=&bd=1');

        ///

        ///

        $data['view'] = 'pages/admin/transaksi/kirimEmail';
        $this->load->view('pages/admin/beranda', $data);
    }

    public function upTAgihanNoTag($dT)
    {
        $this->celLOgin();
        $this->load->model('M_cud');
        $ok = 1;
        $where = [
            'notagihan' => $dT['noTag'],
            'status' => 0
        ];
        $data = [
            'status' => $dT['st'],
        ];
        $dTSave = [
            'table' => 'tbl_tagihan',
            'data' => $data,
            'where' => $where,
        ];
        $ok *= $this->M_cud->updateData($dTSave);
        return $ok;
    }

    public function nextGagal($st)
    {
        $this->session->set_flashdata('pesan', $st);
        $this->session->set_flashdata('pesan0', $st);
        $url = $this->M_setapp->urlBack();
        redirect($url);
    }
} //class
