<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('Pdf');
        $this->load->Model('Mbank');
        $this->load->Model('M_cetakA');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }
    ////cetak DEPOSIt
    public function cetak_pesan_barang($cetak, $id_pembeli, $id_tgl) ////
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
        $data['id_tgl'] = $id_tgl;
        //================================================================
        $data['title0'] = 'E-Retail';
        $data['title1'] = 'E-Retail';
        $data['title2'] = '<i class="fa fa-fw fa-shopping-cart"></i> Kembali Belanja';
        switch ($cetak) {

            case 'pdf':
                //$file_pdf = $this->load->view('cetak/bill_pdf',$data,TRUE); 
                $file_pdf = $this->load->view('cetak/pesanbarang_pdf', $data, TRUE);;
                //$file_pdf = $this->load->view('cetak/bill_pdf2',$data,TRUE); 

                //  $this->pdf->pdf_create_portrait_down($file_pdf,'daftar Aparat Desa');
                //  $this->pdf->pdf_create_landscape($file_pdf,'bill-hotel');
                $this->pdf->pdf_create_portrait_down($file_pdf, 'BUKTI-PEMESANAN-BARANG');

                break;

            default:
                //$this->load->view('cetak/bill_html',$data);
                //$this->load->view('cetak/bill_html2',$data);
                $this->load->view('cetak/pesanbarang_html', $data);
                break;
        }
    }

    ////cetak DEPOSIt ///bagian admin penjual
    public function cetak_pesan_barang_admin($cetak, $id) ////
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
        $data['id'] = $id;
        $data['id_tgl'] = $id_tgl = 0;
        //================================================================
        $data['title0'] = 'E-Retail';
        $data['title1'] = 'E-Retail';
        $data['cetak'] = $cetak;
        $data['title2'] = '<i class="fa fa-fw fa-shopping-cart"></i> Kembali Belanja';
        switch ($cetak) {

            case 'html':
                $this->load->view('cetak/pesanbarang_html_adpen', $data);
                break;
            case 'awal':
                $this->load->view('cetak/pesanbarang_html_adpen', $data);
                break;
            case 'xls':
                //$this->load->view('cetak/bill_xls',$data);
                $this->load->view('cetak/bill_xls2', $data);
                break;
            case 'pdf':
                $file_pdf = $this->load->view('cetak/pesanbarang_html_adpen_pdf', $data, TRUE);;
                $this->pdf->pdf_create_portrait_down($file_pdf, 'BUKTI-PEMESANAN-BARANG');

                break;
        }
    }

    ////cetak BUKTI TRANSAkSI SELESAI
    public function cetak_transaksi_selesai($cetak, $id) ////
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
        $data['id'] = $id;
        ////////////////REVISI 15417
        $data['getidt'] = $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();

        $data['idtblpembeli'] = $idtblpembeli = $this->Mtrans->get_tbl_pembeli($getidt->id_pembeli);

        $data['idtblpelapak'] = $idtblpelapak = $this->Mtrans->get_tbl_userpenjual($getidt->id_pelapak);

        $data['idtblproduk'] = $idtblproduk = $this->Mtrans->get_tbl_produk($getidt->id_produk);
        ////////////////REVISI 201717
        //================================================================

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

        //================================================================

        $data['title0'] = 'E-Retail';
        $data['title1'] = 'E-Retail';
        $data['title2'] = '<i class="fa fa-fw fa-shopping-cart"></i> Kembali Belanja';
        $data['cetak'] = $cetak;
        switch ($cetak) {

            case 'html':
                //$this->load->view('cetak/bill_html',$data);
                //$this->load->view('cetak/bill_html2',$data);
                $this->load->view('cetak/transaksi_selesai/bukti_transaki', $data);
                break;
            case 'xls':

                //$this->load->view('cetak/bill_xls',$data);
                $this->load->view('cetak/bill_xls2', $data);
                break;
            case 'pdf':
                //$file_pdf = $this->load->view('cetak/bill_pdf',$data,TRUE); 
                $file_pdf = $this->load->view('cetak/transaksi_selesai/bukti_transaki_pdf', $data, TRUE);;
                //$file_pdf = $this->load->view('cetak/bill_pdf2',$data,TRUE); 

                //  $this->pdf->pdf_create_portrait_down($file_pdf,'daftar Aparat Desa');
                //  $this->pdf->pdf_create_landscape($file_pdf,'bill-hotel');
                $this->pdf->pdf_create_portrait_down($file_pdf, 'BUKTI-TRANSAKSI');

                break;
            case 'awal':
                $this->load->view('cetak/transaksi_selesai/bukti_transaki', $data);

                break;
        }
    }

    ////cetak BUKTI TRANSAkSI SELESAI
    public function cetak_redeem_akun($cetak, $id) ////
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
        $data['id'] = $id;
        ////////////////REVISI 15417
        $data['getidt'] = $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();

        $data['idtblpembeli'] = $idtblpembeli = $this->Mtrans->get_tbl_pembeli($getidt->id_pembeli);

        $data['idtblpelapak'] = $idtblpelapak = $this->Mtrans->get_tbl_userpenjual($getidt->id_pelapak);

        $data['idtblproduk'] = $idtblproduk = $this->Mtrans->get_tbl_produk($getidt->id_produk);
        ////////////////REVISI 201717
        //================================================================

        $data['timezone'] = $timezone  = +7; //(GMT +7:00) 
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

        //================================================================

        $data['title0'] = 'E-Retail';
        $data['title1'] = 'E-Retail';
        $data['title2'] = '<i class="fa fa-fw fa-shopping-cart"></i> Kembali Belanja';
        $data['cetak'] = $cetak;
        switch ($cetak) {

            case 'html':
                //$this->load->view('cetak/bill_html',$data);
                //$this->load->view('cetak/bill_html2',$data);
                $this->load->view('cetak/transaksi_selesai/bukti_transaki', $data);
                break;
            case 'xls':

                //$this->load->view('cetak/bill_xls',$data);
                $this->load->view('cetak/bill_xls2', $data);
                break;
            case 'pdf':
                //$file_pdf = $this->load->view('cetak/bill_pdf',$data,TRUE); 
                $file_pdf = $this->load->view('cetak/transaksi_selesai/bukti_transaki_pdf', $data, TRUE);;
                //$file_pdf = $this->load->view('cetak/bill_pdf2',$data,TRUE); 

                //  $this->pdf->pdf_create_portrait_down($file_pdf,'daftar Aparat Desa');
                //  $this->pdf->pdf_create_landscape($file_pdf,'bill-hotel');
                $this->pdf->pdf_create_portrait_down($file_pdf, 'BUKTI-TRANSAKSI');

                break;
            case 'awal':
                $this->load->view('cetak/transaksi_selesai/bukti_transaki', $data);

                break;
        }
    }
    ////cetak TRANSAKI
    public function cetak_trans_admin($bln = 1, $thn = 1, $sort = 'b1', $sort2 = 1, $cetak = "html") ////
    {
        if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {
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
        $data['sort'] = $sort;
        $data['sort2'] = $sort2;
        $data['bln'] = $bln;
        $data['thn'] = $thn;

        $data['cetak'] = $cetak;

        switch ($cetak) {

            case 'html':
                //$this->load->view('cetak/bill_html',$data);
                //$this->load->view('cetak/bill_html2',$data);

                //////////////20180125
                if ($sort2 == 1) {
                    $this->load->view('pages/master_admin/cetak/cetak_rincitransaksi', $data);
                } else {
                    $this->load->view('pages/master_admin/cetak/cetak_rincitransaksi_sta', $data);
                }
                break;
            case 'xls':

                //$this->load->view('cetak/bill_xls',$data);
                $this->load->view('cetak/bill_xls2', $data);
                break;
            case 'pdf':
                //$file_pdf = $this->load->view('cetak/bill_pdf',$data,TRUE); 
                $file_pdf = $this->load->view('cetak/transaksi_selesai/bukti_transaki_pdf', $data, TRUE);;
                //$file_pdf = $this->load->view('cetak/bill_pdf2',$data,TRUE); 

                //  $this->pdf->pdf_create_portrait_down($file_pdf,'daftar Aparat Desa');
                //  $this->pdf->pdf_create_landscape($file_pdf,'bill-hotel');
                $this->pdf->pdf_create_portrait_down($file_pdf, 'BUKTI-TRANSAKSI');

                break;
        }
    }


    ////cetak TRANSAKI
    public function cetak_pes_vou($cetak = "html", $id_job, $kd_prodi) ////
    {
        if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {
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

        $data['cetak'] = $cetak;
        $data['id_job'] = $id_job;
        $data['kd_prodi'] = $kd_prodi;
        $data['id_voc_mhs'] = $id_voc_mhs = $this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS

        switch ($cetak) {

            case 'xls':

                //$this->load->view('cetak/bill_xls',$data);
                if ($id_job == 3) {
                    $this->load->view('pages/master_admin/cetak/cetak_pes_voc', $data);
                } else {
                    $this->load->view('pages/master_admin/cetak/cetak_pes_voc', $data);
                }

                break;
        }
    }

    ////cetak DAFTAR PENJUAL
    public function cetak_akunP($cetak = "html", $ak) ////
    {
        if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'admin') {

            $data['q'] = $this->M_cetakA->get_penjualMhs($ak);

            switch ($cetak) {

                case 'xls':
                    $this->load->view('cetak/akun/akunPenjual', $data);

                    break;
            }
        } else {
            redirect('login');
        }
    }

    ////cetak TRANSAKI
    public function cetak_rekapBelanja_admin($cetak = 'html') ////
    {
        if ($this->session->userdata('login') != TRUE or $this->session->userdata('wewenang') != 'admin') {
            redirect('login');
        }

        $data['cetak'] = $cetak;

        if ($_GET['sP'] == null) {
            # code...
            $statusP = '';
        } else {
            $statusP = 'STATUS ' . $_GET['sP'];
        }
        if ($_GET['prodi'] == '0' or $_GET['prodi'] == '') {
            # code...
            $statprodi = '';
        } else {
            $statprodi = 'PRODI ' . $_GET['prodi'];
        }
        if ($_GET['thn'] == 'S') {
            # code...
            $thn = '';
        } else {
            $thn = 'Tahun ' . $_GET['thn'];
        }
        if ($_GET['bln'] == 'S') {
            # code...
            $bln = '';
        } else {
            $bln = 'Bulan ' . $_GET['bln'];
        }
        if ($_GET['tgl'] == 'S') {
            # code...
            $tgl = '';
        } else {
            $tgl = 'Tanggal ' . $_GET['tgl'];
        }



        $d_cetak = [

            'thn' => $thn,
            'bln' => $bln,
            'tgl' => $tgl,
            'tanggal' => 'TANGGAL ',
            'statusP' => $statusP,
            'statprodi' => $statprodi,

        ];
        $data['d'] = $d_cetak;
        $this->load->model('M_belanja');
        switch ($cetak) {

            case 'html':
                if ($_GET['s'] === 'P') {
                    # code...
                    $this->load->model('M_rekapPenjualan');
                    $data['get_all_id_produk'] = $get_all_id_produk = $this->M_rekapPenjualan->get_listAkun_rekap();
                    $this->load->view('pages/master_admin/cetak/cetak_rekapPendapatan', $data);
                } else {
                    $data['get_all_id_produk'] = $this->M_belanja->get_listPembeli_pag(0, 0);
                    $this->load->view('pages/master_admin/cetak/cetak_rekapBelanja', $data);
                }

                break;
            case 'xls':
                if ($_GET['s'] === 'P') {
                    # code...
                    $this->load->model('M_rekapPenjualan');
                    $data['get_all_id_produk'] = $get_all_id_produk = $this->M_rekapPenjualan->get_listAkun_rekap();
                    $this->load->view('pages/master_admin/cetak/cetak_rekapPendapatan_xls', $data);
                } else {
                    $data['get_all_id_produk'] = $this->M_belanja->get_listPembeli_pag(0, 0);
                    $this->load->view('pages/master_admin/cetak/cetak_rekapBelanja_xls', $data);
                }

                break;
        }
    }

    ////cetak REKAP PRODUK
    public function cetak_rekapProduk_admin($cetak = 'html') ////
    {
        if ($this->session->userdata('login') != TRUE or $this->session->userdata('wewenang') != 'admin') {
            redirect('login');
        }

        $data['cetak'] = $cetak;
        if ($_GET['thn'] == 'S') {
            # code...
            $thn = '';
        } else {
            $thn = 'Tahun ' . $_GET['thn'];
        }
        if ($_GET['bln'] == 'S') {
            # code...
            $bln = '';
        } else {
            $bln = 'Bulan ' . $_GET['bln'];
        }
        if ($_GET['tgl'] == 'S') {
            # code...
            $tgl = '';
        } else {
            $tgl = 'Tanggal ' . $_GET['tgl'];
        }

        $d_cetak = [

            'thn' => $thn,
            'bln' => $bln,
            'tgl' => $tgl,
            'tanggal' => 'TANGGAL ',

        ];
        $data['d'] = $d_cetak;
        $this->load->model('M_belanja');
        $this->load->model('M_rekapProduk');
        $id_k = $_GET['id_k'];
        switch ($cetak) {

            case 'html':

                if ($_GET['per'] == 1) {
                    if ($id_k == null) {
                        $data['get_all_id_produk'] = $gtog = $this->Muser->get_kategori();
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perKat_html', $data);
                    } else {
                        $data['get_all_id_produk'] = $this->M_rekapProduk->get_perKategori($id_k);
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perProdukKat_html', $data);
                    }
                } else {
                    if ($id_k == null) {
                        $data['get_all_id_produk'] = $this->M_voucher->get_stjob();
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perStatus_html', $data);
                    } else {
                        $data['get_all_id_produk'] = $this->M_rekapProduk->get_perStatusAkun($id_k);
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perProdukStatus_html', $data);
                    }
                }

                break;
            case 'xls':
                if ($_GET['per'] == 1) {
                    if ($id_k == null) {
                        $data['get_all_id_produk'] = $gtog = $this->Muser->get_kategori();
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perKat_xls', $data);
                    } else {
                        $data['get_all_id_produk'] = $this->M_rekapProduk->get_perKategori($id_k);
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perProdukKat_xls', $data);
                    }
                } else {
                    if ($id_k == null) {
                        $data['get_all_id_produk'] = $this->M_voucher->get_stjob();
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perStatus_xls', $data);
                    } else {
                        $data['get_all_id_produk'] = $this->M_rekapProduk->get_perStatusAkun($id_k);
                        $this->load->view('pages/master_admin/cetak/rekapProduk/cetak_perProdukStatus_xls', $data);
                    }
                }

                break;
        }
    }


    public function penerimaVoc($Evoc = '', $idjov = '', $st = '', $statusP = '', $dvo = '', $statprodi = '')
    {
        if ($this->session->userdata('login') == false) {
            redirect('login');
        }

        if ($Evoc == '' || $idjov == '' || $st == '' || $statusP == '' || $dvo == '') {
            redirect('Master_admin/list_penerima_voucher');
        }

        $data['st'] = $st;
        $data['idjov'] = $idjov;
        $data['dvo'] = $dvo;
        $data['statusP'] = $statusP;
        $data['statprodi'] = $statprodi;
        $data['Evoc'] = $Evoc;

        $this->load->model('M_dompetall');

        $this->load->view('pages/master_admin/cetak/rekapPenerimaVoc/penerimaVocher', $data);
    }
} //cls
