<?php

defined('BASEPATH') or exit('No direct script access allowed');



class C_dompetp extends CI_Controller
{

    function __construct()

    {

        parent::__construct();

        $this->load->helper(array('form', 'url'));

        $this->load->library('Pdf');
        $this->load->model('M_vparsel'); //
        $this->load->model('M_saldompet'); //M_saldompet

    }





    public function index()

    {

        redirect('C_dompetp/dompet');
    }

    public function c_email()
    {
        //////////////notifikasi email 21/3/17
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://host21.registrar-servers.com";
        $config['smtp_port'] = "465";
        $config['wordwrap'] = TRUE;
        //$config['smtp_user'] = "E-Retail@jualretail.com";
        $config['smtp_user'] = "admin@E-Retail.com";
        //$config['smtp_pass'] = "beduk2017";
        $config['smtp_pass'] = "52TuGw}TZSa7";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
        //$list = array('ilhamroyroy@gmail.com');
        $ci->email->from('admin@E-Retail.com', 'E-Retail SUPERMALL');
    }



    ///rev tanggal 130717 DOMPET E-Retail	

    public function dompet()

    {



        if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {



            $g_id = $this->Muser->get_id_pass(); ///get masing masing id user

            $data['img'] = $g_id->row()->img;

            $data['nama'] = $g_id->row()->nama;

            $data['alamat'] = $g_id->row()->alamat;

            $data['kontak'] = $g_id->row()->no_kontak;

            $data['username'] = $g_id->row()->username;

            $data['rek'] = $g_id->row()->rek;

            $data['nbm'] = $g_id->row()->nbm;

            $data['bank'] = $g_id->row()->bank;

            $data['sex'] = $g_id->row()->jenis_kelamin;

            $data['id_user'] = $g_id->row()->idlog;

            $data['job'] = $job = $g_id->row()->job;

            $data['ni'] = $ni = $g_id->row()->ni;
            $data['kodeprodi'] = $g_id->row()->kode_prodi;

            ///

            $data['voucher_umy'] = $g_id->row()->voucher_umy;

            $data['dompet'] = $g_id->row()->dompet;

            $data['voucher_dibelanjakan'] = $g_id->row()->voucher_dibelanjakan;

            $data['dompet_dicairkan'] = $g_id->row()->dompet_dicairkan;

            //================================================================

            $data['title0'] = 'E-Retail';

            $data['title1'] = 'E-Retail';

            ///




            ///

            $data['a'] = '';

            $data['c'] = $data['d'] = '';

            $data['b'] = '';

            $data['l'] = 'active';
            $data['l2'] = 'active';

            ///

            ///rev 61017

            if ($job == 3) {
                redirect('C_mahasiswa/dompet_mhs');
            }

            if (empty($job) or empty($ni)) {

                $data['view'] = 'pages/admin/viewer/dompet/form_job';
            } else {

                $data['view'] = 'pages/admin/dompet_p/dompet';
            }







            $this->load->view('pages/admin/beranda', $data);
        } else { ///pengan login

            $this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

            redirect('Login');
        }
    }



    //////////////////Dompet
    function pesan_voucher_p($id)
    {
        if ($this->session->userdata('id_user') == $id and $this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
            ///waktu
            $h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -
            $hm = $h * 60;
            $ms = $hm * 60;
            $tanggal = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.
            $waktu = gmdate("H:i:s", time() + ($ms));
            $bln = gmdate("n", time() + ($ms)); // 
            $thn = gmdate("Y", time() + ($ms)); // 
            $this->form_validation->set_rules('nik', 'nik', 'required');
            $this->form_validation->set_rules('unit', 'unit', 'required');
            $this->form_validation->set_rules('ya01', 'ya01', 'required');
            $idvoc = $this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
            if ($this->form_validation->run() == TRUE) {

                $d = array(
                    'nik' => $this->input->post('nik'),
                    'unit' => $this->input->post('unit'),
                    'id_user' => $id,
                    'id_voc_p' => $idvoc,
                    'bln' => $bln,
                    'thn' => $thn,
                    'tanggal_p' => $tanggal,
                    'waktu' => $waktu,
                    'proses' => 0,
                );

                ///////////NOTIVIKASI EMAIL

                $Emailto = $this->Muser->get_user_by_id($id)->row()->username;
                $pass = $this->Muser->get_user_by_id($id)->row()->password;

                $isinot = '
        Anda sudah memesan Voucher Parsel. <br/>
		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>
		Terima kasih.
		';

                $this->c_email();
                $this->email->to($Emailto); ///ke email pembeli
                $this->email->bcc('admin@E-Retail.com');
                $this->email->subject('PESAN VOUCHER - [E-Retail SUPERMALL]');
                $this->email->message($isinot);
                //$ci->email->attach(base_url('pdf/test.pdf'));

                $gt_tblpesanvoucher = $this->M_vparsel->get_pesan_voc_parsel_id($id, $idvoc);

                if ($gt_tblpesanvoucher->num_rows() > 0) {

                    $this->session->set_flashdata('pesan', 'data Gagal Dikirim. Karena sudah menerima untuk edisi sekarang.');
                    redirect('C_dompet/tcses/parsel');
                } else {
                    $this->M_vparsel->insert_pesan_vparsel($d);
                    $this->email->send();
                }



                ///
                //$this->Madmin_master->block_penjual_model($id,$d);
                //bila belum buat kalau udah di update





                $this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu.');
                redirect('C_dompet/tcses/parsel');
            } else {

                if ($this->input->post('ya01') == NULL) {
                    $this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
                    redirect('Login');
                } else {
                    redirect('C_dompetp/dompet');
                }
            }
        } else {
            $this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');
            redirect('Login');
        }
    }

    ////preses reedim ke bmt ///rev 51117

    function redeem_voucher_v2($id, $jnvoc = 0)
    {

        $id = $this->session->userdata('id_user');
        $iduser = $id;

        ///waktu

        $h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

        $hm = $h * 60;

        $ms = $hm * 60;

        $hariini = gmdate("d-m-Y ", time() + ($ms)); // the "-" can be switched to a plus if that's what your time zone is.

        $waktu = gmdate("H:i:s", time() + ($ms));



        //////rev Ilham 190717

        ////////////////REVISI 201717

        $getvoucher = $this->Mtrans->get_voucher_tbluser_vocer($id);     //tblambil voucher di tbl user

        $getdompet = $getvoucher->row()->dompet;

        $getdompet_awal = $getvoucher->row()->dompet_dicairkan;

        ////////////////REVISI 15417

        ///PErpindahan VOUCHER

        $this->form_validation->set_rules('redeem', 'redeem', 'required');

        $this->form_validation->set_rules('jvoc', 'jvoc', 'required');
        $this->form_validation->set_rules('d3', 'd3', 'required');

        $transit = $this->input->post('redeem');
        $jnvoc = $this->input->post('jvoc');

        ///20180501
        if ($transit == NULL or $transit == 0) {
            $this->session->set_flashdata('pesan0', 'data Gagal Dikirim.');
            redirect('C_dompet/#null');
        }

        ///securty


        $kontvov = '';
        $transit_par = $transit;
        if ($jnvoc == 1) {
            $kontvov = "PARSEL";
            $transit = 0;
            $getdompet = 0;
            $id_voc_p = $this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
            ///getdatapendapaatan
            $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($iduser, $id_voc_p, 1);    //tbltransaksi
            $get_reedeem = $this->Mbmt->get_tbl_reedeem_perid_user($iduser, 1); ///1=parsel , 0=makan ,2=song2


        } elseif ($jnvoc == 2) {
            $kontvov = "SONGSONG";
            $transit = 0;
            $getdompet = 0;
            $id_voc_p = $this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi SONGSONG; ///id edisi voc parsel last
            ///getdatapendapaatan
            $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($iduser, $id_voc_p, 2);    //tbltransaksi
            $get_reedeem = $this->Mbmt->get_tbl_reedeem_perid_user($iduser, 2); ///1=parsel , 0=makan ,2=song2


        } elseif ($jnvoc == 3) {
            $kontvov = "MAHASISWA";
            $transit = 0;
            $getdompet = 0;
            $id_voc_p = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS; ///id edisi voc parsel last
            ///getdatapendapaatan
            $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($iduser, $id_voc_p, 3);    //tbltransaksi
            $get_reedeem = $this->Mbmt->get_tbl_reedeem_perid_user($iduser, 3); ///1=parsel , 0=makan ,2=song2,3=mhs [selain tolak]


        } elseif ($jnvoc == 4) {
            $kontvov = "GAJI13";
            $transit = 0;
            $getdompet = 0;
            $id_voc_p = $this->M_vparsel->get_max_id_vocall($jnvoc); ///menuju edisi GAJI; ///id edisi voc parsel last
            ///getdatapendapaatan
            $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($iduser, $id_voc_p, $jnvoc);    //tbltransaksi
            $get_reedeem = $this->Mbmt->get_tbl_reedeem_perid_user($iduser, $jnvoc); ///1=parsel , 0=makan ,2=song2,3=mhs [selain tolak]


        } elseif ($jnvoc == 0) {
            $kontvov = "MAKAN";
            $transit = 0;
            $getdompet = 0;
            $id_voc_p = $this->M_voucher->get_max_id_voc();  ///e makan
            ///getdatapendapaatan
            $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vmakan_didapat($iduser, $id_voc_p, 0); //tbltransaksi
            $get_reedeem = $this->Mbmt->get_tbl_reedeem_perid_user($iduser, 0); ///1=parsel , 0=makan ,2=song2
        } elseif ($jnvoc == 99) {
            $kontvov = "DOMPETLAIN";
            $transit = 0;
            $getdompet = 0;
            $id_voc_p = 0;

            ///GALLVOC 201811
            $gv = $this->M_saldompet->gDomall($iduser);  ///
            /////
            $gettotal_parsel_dapat = $gv['dompet_selesai']; ///hasil akhir pendapatan (cetak)
            $get_reedeem = 0;
        } else {
            $this->session->set_flashdata('pesan0', 'Redeem gagal.');
            redirect('C_dompet/tcses/?gagal=1');
        }


        $dompet = $gettotal_parsel_dapat - $get_reedeem; ///hasil akhir pendapatan

        if ($dompet < $transit_par) {
            $this->session->set_flashdata('pesan0', 'Saldo tidak cukup.');
            redirect('C_dompet/tcses/#saldotidakcukup');
        }

        /* echo $dompet.'<br>';
        echo $transit_par;
		//*/
        //riwayat
        //update metode pembayaran


        $rwytvocer = array(

            'id_user' => $id,

            'kontek' => 'Redeem [' . $kontvov . ']' . $transit_par,

            'tgl_trans' => $hariini . ' ' . $waktu,
            'j_voucher' => $jnvoc,
            'id_voc_p' => $id_voc_p,
            'kode' => 6,

            ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.

            //untuk keperuan nota treansaksi

        );



        ///


        if ($dompet >= $transit) {



            //$tcdef=1;	



            if ($this->form_validation->run() == TRUE) {

                $this->tgl_kebmt_v2($id, $transit_par, $jnvoc);

                $this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat	

                $this->session->set_flashdata('pesan', 'data berhasil Dikirim. Mohon Dituggu. <br/>

        Silahkan Cetak sebagai bukti.

        ');

                //$this->kirim_email_redeem_akun($id);

                redirect('C_dompet/kirim_email_redeem_akun/' . $id);
                //redirect ('C_dompet/cetakan_beranda/');



            }
        } else {

            $this->session->set_flashdata('pesan0', 'data Gagal Dikirim. Mohon Periksa kembali.');

            redirect('C_dompetp/#error');
        }

        ///*/





    }

    function tgl_kebmt_v2($id, $transit, $jnvoc = 0)
    {

        if ($this->form_validation->run() == TRUE) {

            $tanggal = $this->M_time->tglnow_slas();

            $tanggal_waknow = $this->M_time->harinow();

            //$tanggal= '26-01-2018'; 
            ///201904
            $tanggal_kebmt = $this->M_time->keBmt();
            ///*/

            ///201904


            $redem = array(

                'id_user' => $id,

                'j_voucher' => $jnvoc, //1=voucher parsel
                'redeem' => $transit,

                'tgl_trans' => $tanggal_waknow,

                /////

                'tgl_kebmt' => $tanggal_kebmt,



                ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.

                //untuk keperuan nota treansaksi

            );



            ///////////////////2%

            $pec_redem = $transit * 2 / 100;

            $p_redem = $pec_redem;

            $redem_a = $transit - $pec_redem;


            ///20180501




            /////////REV sudah di bagi disiis

            $redem_bg = array(

                'id_user' => $id,

                'redeem' => $redem_a,

                'kebmt' => $p_redem,

                'tgl_trans' => $tanggal_waknow,

                'tgl_kebmt' => $tanggal_kebmt,

                ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.

                //untuk keperuan nota treansaksi

            );

            /////////REV sudah di bagi disiis

            $this->session->set_userdata($redem_bg); //record

            $this->Mtrans->simpan_tabl_reedemuser($redem); //reedem	



        } else { ///pengan login

            $this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

            redirect('Login');
        }   ///*/

    }
} ///class
