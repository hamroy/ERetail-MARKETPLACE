<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_transelesai extends CI_Controller
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
    function ceklogin()
    {
        $id_user = $this->session->userdata('id_user');
        if ($this->session->userdata('login') == FALSE) {
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
        $val[3] = $this->input->post('num');
        $val[4] = $this->input->post('noTag');;
        $p = 1;
        $this->id_kuitansai($id, $val[0], $val[2]);
        $this->saveProsesTransaksi($id, $val[0], $val[2]);

        if ($val[3] == 1) {
            $dNoTag = array('noTag' => $val[4], 'st' => 1); //1==tagihan selesai
            $this->upTAgihanNoTag($dNoTag);
        }

        switch ($val[1]) {
            case 'T':
                //transfer
                // $this->setujui_transaksi($id,$ok,$ad,$val[0],$val[2]);
                break;
            case 99:
                // echo 'Via Dompet';
                $p = 2;
                $this->setujui_transaksi_dompet($id, $ok, $ad, $val[0], $val[2]);
                break;
            default:
                $this->setujui_transaksi($id, $ok, $ad, $val[0], $val[2]);
                break;
        }

        // redirect('C_transelesai/rinciTransaksi/'.$id.'/'.$id_user);
        // redirect('User_admin/barang_dipesan');
        $this->send_email_setuju($id);
        $st = 'Proses Berhasil';
        $this->nextGagal($st);
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
            $num = $this->input->post('num');

            $key2 = $this->key;

            if ($ok == 'btl') {

                $okk * $this->btl_transaksi_v2($id, $ok, $ad, $valid, $key2, $jvocd);
                //up status tagihan
                if ($num == 1) {
                    $dNoTag = array('noTag' => $noTag, 'st' => 1); //1==tagihan selesai
                    $this->upTAgihanNoTag($dNoTag);
                }

                //up status tagihan
                if ($okk == 1) {
                    $this->btl_email($id, $ok, $ad, $valid, $key2);
                } else {
                    $st = 'Proses pembatalan gagal';
                    $this->nextGagal($st);
                }
            }

            $st = 'Proses Berhasil';
            $this->nextGagal($st);
        } else { //not valid
            $st = 'Proses pembatalan gagal #valid';
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

                $this->Mtrans->update_bayar_otorisasi($id, $u);
                $this->session->set_flashdata('pesan', 'Transaksi Selesai');

                //////REV 050917
            } else {

                $st = 'Mohon maaf, data gagal tersimpan.<br/> Silahkan coba sekali lagi.';
                $this->nextGagal($st);
            }

            //////////////////////////////////////////////////  

        }
    }

    function btl_email($id, $ok, $ad = NULL, $valid, $key2)
    {
        $this->celLOgin();
        ///////EMAIL
        if ($valid != NULL and $key2 == $this->key) {

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

            $this->c_email();
            $this->mail->Body = $btal;
            // $email="ilhamroyroy@gmail.com";
            $email = $idtblpembeli->row()->username;
            $this->mail->AddAddress($email);
            if (!$this->mail->Send()) {

                $st = 'Email Gagal Terkirim ' . $this->mail->ErrorInfo;
                $this->nextGagal($st);
            }

            ///////////def
            $gcek_status_tra = $this->Mtrans->cek_tab_transak_status($id, 'Batal_ot');

            // if(){
            if ($gcek_status_tra == FALSE) {
                $this->mail->Send();
            }
        } else {
            echo "error 102";
        }
    }

    function tc()
    {
        echo 'ilham(' . $this->key;
        echo '<br />jam(' . $this->tgljam;
        echo '<br />key(' . $this->key;
        echo '<br />jam-detik(' . $this->tgljam_s;
    }

    public function send_email_setuju($id)
    {
        $this->ceklogin();

        //
        $timezone  = +7; //(GMT +7:00) 
        $h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
        $hm = $h * 60;
        $ms = $hm * 60;
        $tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
        $waktu = gmdate("H:i:s", time() + ($ms));
        $xxx = substr($tanggal, '6', '4');
        $xx = substr($tanggal, '3', '2');
        $x = substr($tanggal, '0', '2');
        $hariini = $tanggal;
        $data['tanggal'] = $tanggal = gmdate('d-m-Y', time() + 3600 * ($timezone + date('I')));
        ////////////////REVISI 15417
        $id_user = $this->session->userdata('id_user');
        $gdataTr = $this->Mtrans->get_tbl_transaksi_pelapak($id, $id_user);
        if ($gdataTr->num_rows() == 0) {
            redirect('login');
        }

        $data['getidt'] = $getidt = $gdataTr->row();
        $data['idtblpembeli'] = $idtblpembeli = $this->Mtrans->get_tbl_pembeli($getidt->id_pembeli);
        $data['idtblpelapak'] = $idtblpelapak = $this->Mtrans->get_tbl_userpenjual($getidt->id_pelapak);
        $data['idtblproduk'] = $idtblproduk = $this->Mtrans->get_tbl_produk($getidt->id_produk);
        ///////////////////////////////////////     
        ///////////KIRIM EMAIL DAN SAVE DATA
        //=========================================================================================
        $data['satuantot'] = $satuantot = $this->Mtrans->terbilang(($getidt->qty * $getidt->harga_satuan) + 0);
        //
        $this->buildPdf_pembayaran($id, $data);
        //
        $html = $this->load->view('pages/admin/viewer/email_attachment', $data, true);
        $attched_file = $_SERVER["DOCUMENT_ROOT"] . "/application/third_party/pdf/bukti_transaksi.pdf";
        //

        $this->c_email();

        $this->mail->Subject    = "BUKTI TRANSAKSI BARANG - [E-Retail] -" . time();
        $this->mail->Body      = $html;
        //$ci->email->attach($pdfroot);      	
        $this->mail->addAttachment($attched_file, 'bukti_transaksi.pdf');

        // $email="ilhamroyroy@gmail.com";
        $email = $idtblpembeli->row()->email;
        // echo $email;
        // die();
        $this->mail->AddAddress($email);

        if (!$this->mail->Send()) {
            $st = 'Email Gagal Terkirim';
            $this->nextGagal($st);
        } else {
            $st = 'Email Berhasil Terkirim';
            // $url=base_url('User_admin/barang_idtransaksi/'.$getidt->idtgl);
            // redirect($url);        
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
            echo "error 109 {kuitansi} ";
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
                $lanjut *= 0;
            }
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
            $lanjut = 1;

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

            //////rev Ilham 190717
            $u = array(
                'buy' => 'diproses',
                'tgl_otorisasi' => $hariini . ' ' . $waktu,
                'day' => $x,
                'bln' => $xx,
                'thn' => $xxx,
                'id_acc' => $id . '' . $key2, ///rev gen2

            );

            //////////////////////////////////////////////////  

            if (!empty($getidt->metode) and !empty($getidt->id_pelapak) and  $gettotal_p != 0) {

                //////REV 050917 ///proses akhir
                //=======================================================================================
                if ($getidt->metode == 'VOUCHER' and $getidt->j_voucher == 99) {
                    /////VIA VOUCHER	
                    //riwayat
                    $rwytvocer = array(
                        'id_user' => $getidt->id_user,
                        'id_transaksi' => $id,
                        'kode' => 3,
                        'transit' => $gettotal,
                        'id_penjual' => $getidt->id_pelapak,
                        'kontek' => 'SETUJU Belanja (Saldo Dompet Pindah ke penjual) [DOMPET]=== ' . $gettotal,
                        'tgl_trans' => $hariini . ' ' . $waktu,

                    );

                    $get_riwayat_vou = $this->Mtrans->get_tabl_riwayatvoc_true($id, $getidt->id_user, 3);
                    //$get_riwayat_vou=$this->Mtrans->get_tabl_riwayatvoc($id,$getidt->id_user,3); //riweayat	
                    ///rev 011017
                    if ($get_riwayat_vou == FALSE) {
                        $lanjut *= $this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat	
                        /////  
                    }



                    //=========================================================================================
                }

                $this->session->set_flashdata('pesan', 'Transaksi Selesai');
                $lanjut *= $this->Mtrans->update_bayar_otorisasi($id, $u);
                //////REV 050917

            } else {
                $st = 'Proses Update Tagihan gagal';
                $this->nextGagal($st);
                $lanjut *= 0;
            }

            //////////////////////////////////////////////////  

        } else {
            $st = 'Proses Update Tagihan gagal';
            $this->nextGagal($st);
            $lanjut *= 0;
        }

        return $lanjut;
    }

    function rinciTransaksi($id)
    {

        $this->ceklogin();
        $data = $this->Muser->getDataProfil();
        $data['d'] = 'active';
        $data['link'] = base_url('C_transelesai/send_email_setuju/' . $id);
        $url = $this->M_setapp->urlBack();

        $data['linkBack'] = $url;

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
            'tgl_u' => $this->M_time->harinow(),
        ];
        $dTSave = [
            'table' => 'tbl_tagihan',
            'data' => $data,
            'where' => $where,
        ];
        $ok *= $this->M_cud->updateData($dTSave);
        if ($ok == 0) {
            $st = 'Proses Update Tagihan gagal';
            $this->nextGagal($st);
        }
    }

    public function nextGagal($st)
    {
        $this->session->set_flashdata('pesan', $st);
        $this->session->set_flashdata('pesan0', $st);
        $url = $this->M_setapp->urlBack();
        // redirect ($url);
        redirect('User_admin/barang_dipesan?date=&bd=1');
    }

    function buildPdf_pembayaran($id, $data)
    {

        /////////////////////////////////////////////
        $pdfroot  = dirname(dirname(__FILE__));
        $pdfroot .= '/third_party/pdf/bukti_transaksi.pdf';
        $dompdf = new Dompdf\Dompdf();
        $html = $this->load->view('pages/admin/viewer/email_attachment', $data, true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents($pdfroot, $pdf);
    }
} //class
