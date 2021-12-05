<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_dompetvoc extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/

	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() { 
      parent::__construct();
      $this->load->database();
      $this->load->model('Mmahasiswa');
      $this->load->model('M_dompetall');
      $this->load->model('M_dompetKu');
      $this->load->model('M_adminvoc');
    } 
     
	public function index()
	{

		$gs=$this->session->userdata();
		if ($gs['status_job'] < 4) {
		$this->dompet_all($jvoc=4);
		} elseif ($gs['status_job']==3 or $gs['status_job']==1001) {
			redirect('User_admin');
		}
		else {
			
			//redirect('User_admin');
			$this->dompet_all($jvoc=4);
		}

    }
    
    public function v($jvoc)
	{

	$gs=$this->session->userdata();
		if ($gs['status_job'] < 4) {
		$this->dompet_all($jvoc=4);
		} elseif ($gs['status_job']==3 or $gs['status_job']==1001) {
			redirect('User_admin');
		}
		else {
			
			// redirect('User_admin');
			$this->dompet_all($jvoc=4);
		}
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
    
    
    public function dompet_all($jvoc=4)

	{	
		if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){

			

		$g_id=$this->Muser->get_id_pass(); ///get masing masing id user

		$data['img']=$g_id->row()->img;

		$data['nama']=$g_id->row()->nama;

		$data['alamat']=$g_id->row()->alamat;

		$data['kontak']=$g_id->row()->no_kontak;

		$data['username']=$g_id->row()->username;

		$data['rek']=$g_id->row()->rek;

		$data['nbm']=$g_id->row()->nbm;

		$data['bank']=$g_id->row()->bank;

		$data['sex']=$g_id->row()->jenis_kelamin;

		$data['id_user']=$g_id->row()->idlog;

		$data['job']=$job=$g_id->row()->job;

		$data['ni']=$ni=$g_id->row()->ni;
		$data['kodeprodi']=$g_id->row()->kode_prodi;

		///

		$data['voucher_umy']=$g_id->row()->voucher_umy;

		$data['dompet']=$g_id->row()->dompet;

		$data['voucher_dibelanjakan']=$g_id->row()->voucher_dibelanjakan;

		$data['dompet_dicairkan']=$g_id->row()->dompet_dicairkan;

		//================================================================

		$data['title0']='E-Retail';

		$data['title1']='E-Retail';

		///
        
        if($job==3or $job==1001){
             redirect ('C_mahasiswa/dompet_mhs');
        }

		

		

		///

		$data['a']='';

		$data['c']=$data['d']='';

		$data['b']='';

		$data['l']='active';
        
        
		$data['idjov']=$idjov=$jvoc;
        //
        switch($jvoc){
            case 0: //makan
            $data['l1']='active';
            $data['id_voc_s']=$id_voc_s=$this->M_voucher->get_max_id_voc();  //makan
            break;
            case 1: //parsel
            $data['id_voc_s']= $id_voc_par=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
            redirect('login');
            break;
            case 2: //rmd
            $data['vsong']='active';
            $data['id_voc_s']= $id_voc_song=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi RMD DAN THR
            break;
            case 4: //gj13
            $data['l3']='active';
            $data['id_voc_s']=$id_voc_s=$this->M_vparsel->get_max_id_vocall($idjov); ///menuju edisi voucher
            break;
        }
		
		
		
		
		
        //
		

		///

		///rev 61017

		if(empty($job) or empty($ni)or !is_numeric($ni)){

		$data['view']='pages/admin/viewer/dompet/form_job';

		}else{

		$data['view']='pages/admin/dompet_all/dompet_pesan';	

		}

		

		

			

		$this->load->view('pages/admin/beranda',$data);

		 } else { ///pengan login

                $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

        }

	}
    
   
    ////AKUN PESAN VOUCHER
    
    //////////////////Dompet
	function pesan_voucher_all($id){
		if($this->session->userdata('id_user')==$id AND $this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){	
		///waktu
		$h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate ( "H:i:s", time()+($ms));
		$bln = gmdate("n", time()+($ms)); // 
        $thn = gmdate("Y", time()+($ms)); // 
        $this->form_validation->set_rules('nik','nik','required');
        $this->form_validation->set_rules('unit','unit','required');
        $this->form_validation->set_rules('ya01','ya01','required');
        
        //
        $idjov=$this->input->post('idjvoc');
        $idvoc=$this->M_vparsel->get_max_id_vocall($idjov); ///menuju edisi voucher
        $gt_tblpesanvoucher=$this->M_dompetall->get_pesan_voc_cekall_iduser_($id,$idvoc,$idjov);    
        
        
        if ($this->form_validation->run() == TRUE){
		
        $d=array(
		'nik'=>$this->input->post('nik'),
        'unit'=>$this->input->post('unit'),
		'id_user'=>$id,
		'id_voc'=>$idvoc,
		'j_voucher'=>$idjov, //new
		'bln'=>$bln,
		'thn'=>$thn,
		'tanggal_p'=>$tanggal,
		'waktu'=>$waktu,
		'proses'=>0,
		);
		
		///////////NOTIVIKASI EMAIL
		$njvoc=$this->input->post('njvoc');
		$Emailto =$this->Muser->get_user_by_id($id)->row()->username;
		$pass =$this->Muser->get_user_by_id($id)->row()->password;
		
		$isinot='
        Anda sudah memesan '.$njvoc.'. <br/>
		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>
        
        <br/>
		Terima kasih.
		';
		
        $this->c_email();
        $this->email->to($Emailto); ///ke email pembeli
        $this->email->bcc('admin@E-Retail.com');
        $this->email->subject('PESAN VOUCHER - [E-Retail SUPERMALL]');
        $this->email->message($isinot);
        //$ci->email->attach(base_url('pdf/test.pdf'));
        
		if($gt_tblpesanvoucher->num_rows() > 0){
		
        $this->session->set_flashdata('pesan','data Gagal Dikirim. Karena sudah menerima untuk edisi sekarang.');
		redirect ('C_dompet/tcses/'.$idjov);
        
            
		}else{
			$this->M_dompetall->insert_pesan_vall($d);
            $this->email->send();
		}
        
      	
		
		///
		//$this->Madmin_master->block_penjual_model($id,$d);
		//bila belum buat kalau udah di update
		
		
		
		
		
		$this->session->set_flashdata('pesan','data berhasil Dikirim. Mohon Dituggu.');
		redirect ('C_dompet/tcses/'.$idjov);
        
        }else{
            
            if($this->input->post('ya01')==NULL){
             $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
                redirect ('Login');   
            }else{
             	redirect ('C_dompetp/dompet');   
            }
			 
		}
        
        }else{
			 $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
                redirect ('Login');
		}
		
	}    
    
    ////OTORISASI VOUCHER OL ADMIN
    function acc_pesan_voc_all($t,$id_user,$id,$id_job=1,$dvo=1,$idjov){
		///waktu
		
		
		///manambah voucer di tbl User_admin
		$this->form_validation->set_rules('saldo','saldo','required');
        
        if ($this->form_validation->run() == TRUE){
        if($t=='t'){
		$isinot='
		Voucher Parsel Lebaran Sudah diterima.
		.<br/>
        Sebesar Rp '. $this->input->post('saldo')
        .'
        <br/>--------------------------------------<br/>
        Terimakasih.
        ';
        
        $this->trnans_vocherall($id_user,$id,$idjov);
         
        }else{
         
        $alasan=$this->input->post('alasan');

		$isinot='

            		Mohon Maaf, <br/>

            		anda tidak diterima untuk memesan Voucher Gaji 13 .<br/>

            		Karena : '.$alasan.'
                    
                    <br/>--------------------------------------<br/>
                    Terimakasih.

            		';	
        
        $this->tolak_vocherall($id_user,$id,$idjov);
            
        }
        
        $this->c_email();
        $this->email->to($Emailto); ///ke email pembeli
        $this->email->bcc('admin@E-Retail.com');
        $this->email->subject('Notifikasi - [E-Retail SUPERMALL]');
        $this->email->message($isinot);
         $this->email->send();
        
        $this->session->set_flashdata('pesan','data berhasil di perbaharui .');
		redirect ('C_dompet/dafatar_pemesan_voucher/'.$id_job.'?vo='.$dvo);   
        //========================================================================
        }else{
			     $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali.');
                redirect ('Login');
		}    
		
		
		
	
    }
    
    ///TERIMA VOC
    
    function trnans_vocherall($id_user,$id,$idjov){
        
        $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate ( "H:i:s", time()+($ms));
        
        if(!empty($this->input->post('saldo')) or $this->input->post('saldo')==0 ){
            
            $sal_trans=$this->input->post('saldo');
           
            $id_voc_s=$this->M_vparsel->get_max_id_vocall($idjov);
            
        ///PErpindahan VOUCHER
        ///20180420
       
        //riwayat
		
		//update metode pembayaran
		$rwytvocer=array(
		'id_user'=>$id_user,
		///rev 11017
		'kode'=>1, ///pendapatan
		'pendapatan'=>$sal_trans, ///pendapatan
		
		'kontek'=>'Mendapat Voucher Gaji 13 ==  '.$sal_trans,
		'tgl_trans'=> $tanggal,
		'id_voc_p'=> $id_voc_s,
        'j_voucher'=> $idjov, /// ==4 gaji 13
		///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
		//untuk keperuan nota treansaksi
		);    
		
		///PErpindahan VOUCHER
		
		    
        $pp=1;
        
		$d=array(
		'proses'=>$pp,
		'tanggal_acc'=>$tanggal.' '.$waktu,
		'saldo_awal'=>$sal_trans,
		);
		
        
         //db tbl voucher
		if($this->session->userdata('login')==TRUE  AND $this->session->userdata('wewenang')=='admin'){
    
        $this->M_dompetall->s_up_voucherall($d,$id);
		
        $this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
		}
		//db tbl voucher
        
        }else{
            $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali 2.');
            redirect ('Login'); 
        }
    }
     
    ///TOALK VOUCHER
    function tolak_vocherall($id_user,$id,$idjov){
        
        $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate ( "H:i:s", time()+($ms));
        
        if(!empty($this->input->post('alasan'))){
            $id_voc_s=$id_voc_s=$this->M_vparsel->get_max_id_vocall($idjov);
        ///PErpindahan VOUCHER
        ///20180420
       
        //riwayat
		
		//update metode pembayaran
		$rwytvocer=array(
		'id_user'=>$id_user,
		'kode'=>5, ///tolak voucher
		'kontek'=>'Voucher Gaji 13 DITOLAK ===  '.$sal_trans,
		'tgl_trans'=> $tanggal,
		'id_voc_p'=> $id_voc_s,
        'j_voucher'=> $idjov, ///parsel
		///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
		//untuk keperuan nota treansaksi
		);    
		
		///PErpindahan VOUCHER
		
		    
        $pp=99;
        
		$d=array(
		'proses'=>$pp,
		'tanggal_acc'=>$tanggal.' '.$waktu,
		'saldo_awal'=>$sal_trans,
		'alasan_tolak'=>$this->input->post('alasan'),
		);
		
        
         //db tbl voucher
		if($this->session->userdata('login')==TRUE  AND $this->session->userdata('wewenang')=='admin'){
    
        $this->M_dompetall->s_up_voucherall($d,$id);
		$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
		}
		//db tbl voucher
        
        }else{
            $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali 2.');
            redirect ('Login'); 
        }
    }
   
}
