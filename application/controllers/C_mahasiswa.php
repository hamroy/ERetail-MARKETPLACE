<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_mahasiswa extends CI_Controller {


    public function __construct() { 
      parent::__construct();
      $this->load->database();
      $this->load->model('Mmahasiswa');//
      $this->load->model('M_adminvoc');//
      $this->load->model('M_dompetKu');//
    } 
     
	public function index()
	{
		$stjob=$this->M_setapp->get_info_p()->job;
            if($stjob != 3 and $stjob != 1001){
                redirect ('Login');
            }
	$this->dompet_mhs();
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
    
    
    public function dompet_mhs()

	{	
		if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){

		    $stjob=$this->M_setapp->get_info_p()->job;
            if($stjob != 3 and $stjob != 1001){
                redirect ('Login');
            }	

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

		

		

		///

		$data['a']='';

		$data['c']=$data['d']='';

		$data['b']='';

		$data['l']='active';
		$data['l1']='active';

		///

		///rev 61017

		if(empty($job) or empty($ni)){

		$data['view']='pages/admin/viewer/dompet/form_job';

		}else{

		$data['view']='pages/admin/dompet_mhs/dompet_mhs';	

		}

		

		

			

		$this->load->view('pages/admin/beranda',$data);

		 } else { ///pengan login

                $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

        }

	}
    
    //////////////////Dompet
	function pesan_voucher_mhs_201808($id){
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
        $idvoc=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi parsel
        if ($this->form_validation->run() == TRUE){
		
        $d=array(
		'nik'=>$this->input->post('nik'),
        'unit'=>$this->input->post('unit'),
		'id_user'=>$id,
		'id_voc_mhs'=>$idvoc,
		'bln'=>$bln,
		'thn'=>$thn,
		'tanggal_p'=>$tanggal,
		'waktu'=>$waktu,
		'proses'=>0,
		);
		
		///////////NOTIVIKASI EMAIL
		
		$Emailto =$this->Muser->get_user_by_id($id)->row()->username;
		$pass =$this->Muser->get_user_by_id($id)->row()->password;
		
		$isinot='
        Anda sudah memesan Voucher Mahasiswa. <br/>
		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>
		Terima kasih.
		';
		
        $this->c_email();
        $this->email->to($Emailto); ///ke email pembeli
        $this->email->bcc('admin@E-Retail.com');
        $this->email->subject('PESAN VOUCHER - [E-Retail SUPERMALL]');
        $this->email->message($isinot);
        //$ci->email->attach(base_url('pdf/test.pdf'));
        
        $gt_tblpesanvoucher=$this->M_vparsel->get_pesan_voc_mhs_id($id,$idvoc);
        
		if($gt_tblpesanvoucher->num_rows() > 0){
		
        $this->session->set_flashdata('pesan','data Gagal Dikirim. Karena sudah menerima untuk edisi sekarang.');
		redirect ('C_dompet/tcses/parsel');
        
            
		}else{
			$this->M_vparsel->insert_pesan_vmhs($d);
            $this->email->send();
		}
        
      	
		
		///
		//$this->Madmin_master->block_penjual_model($id,$d);
		//bila belum buat kalau udah di update
		
		
		
		
		
		$this->session->set_flashdata('pesan','Data berhasil Dikirim. Mohon Dituggu.');
		redirect ('C_dompet/tcses/mhs');
        
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
    
    //////////////////Dompet
    
    
	function pesan_voucher_mhs($id){
        $this->pe_terima_voucher_mhs($id);
    }
	function pe_terima_voucher_mhs($id){
		if($this->session->userdata('id_user')==$id AND $this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){	
		///waktu
		
        $this->form_validation->set_rules('nik','nik','required');
        $this->form_validation->set_rules('unit','unit','required');
        $this->form_validation->set_rules('ya01','ya01','required');
        $idvoc=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi parsel
        
        if ($this->form_validation->run() == TRUE){
        $ni=$this->input->post('nik');
        $cekmhsaktif=$this->M_vparsel->ceknimmhsaktif($ni);
        
        $this->session->set_userdata('s_unit',$this->input->post('unit'));
        
        if($cekmhsaktif ->num_rows() == 0){
        $this->session->set_flashdata('pesan','Maaf, 
        Anda Tidak berhak mendapatkan Voucher Mahasiswa.<br/> Karena Identitas tidak dikenal.
        <br/>
        Terima kasih.
        ');  

        $this->session->set_userdata('t_acc','0');  

        }else{
        $this->session->set_flashdata('pesan','Selamat, 
        Anda berhak mendapatkan Voucher Mahasiswa.<br/> Klik tombol terima untuk mendapatkan Voucher Mahasiswa
        ');

        ///
        $this->session->set_userdata('t_acc','1');  
        $this->session->set_userdata('sjvoc',3);  
        }

        
        
		///
		//$this->Madmin_master->block_penjual_model($id,$d);
		//bila belum buat kalau udah di update
		
		
		redirect ('C_mahasiswa/acc_voc/mhs');
        
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
    
    
    function k_email($id){
        $Emailto =$this->Muser->get_user_by_id($id)->row()->username;
		$pass =$this->Muser->get_user_by_id($id)->row()->password;
		
		$isinot='
        Anda sudah memesan Voucher Mahasiswa. <br/>
		Mohon Tunggu Notifikasi selanjutnya dari Admin.<br/>
		Terima kasih.
		';
		
        $this->c_email();
        $this->email->to($Emailto); ///ke email pembeli
        $this->email->bcc('admin@E-Retail.com');
        $this->email->subject('PESAN VOUCHER - [E-Retail SUPERMALL]');
        $this->email->message($isinot);
        //$ci->email->attach(base_url('pdf/test.pdf'));
        $this->email->send();
    }
	
    function acc_voc($trans=NULL){

       if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){

		$g_id=$this->Muser->get_id_pass();
		$data['img']=$g_id->row()->img;
		$data['nama']=$g_id->row()->nama;
		$data['alamat']=$g_id->row()->alamat;
		$data['nbm']=$g_id->row()->nbm;
		$data['nbm']=$job=$g_id->row()->job; //status pekerjaan]
		$data['kontak']=$g_id->row()->no_kontak;
		$data['username']=$g_id->row()->username;
		$data['password']=$g_id->row()->password;
		$data['rek']=$g_id->row()->rek;
		$data['bank']=$g_id->row()->bank;
		$data['sex']=$g_id->row()->jenis_kelamin;
		$data['file_nbm']=$g_id->row()->file_nbm;
		$data['ranting']=$g_id->row()->ranting;
		$data['cabang']=$g_id->row()->cabang;
		$data['daerah']=$g_id->row()->daerah;
		$data['title0']='E-Retail';
		$data['title1']='E-Retail';

        if($trans=='trans'){

        $data['link']=base_url('User_admin/barang_dipesan');    

        }elseif($trans=='parsel'){

        $data['link']=base_url('C_dompetp/dompet');    

        }elseif($trans=='mhs' && $job==3 or $job==1001){

        $data['link']=base_url('C_mahasiswa/dompet_mhs');    
        $data['link_acc']=base_url('C_mahasiswa/terimatrnans_voc');    

        }elseif($trans=='song'){

        $data['link']=base_url('C_dompetsong');    

        }elseif($trans=='4'){

        $data['link']=base_url('C_dompetvoc');    

        }else{

        $data['link']=base_url('C_dompet');    

        }


		$data['view']='pages/admin/viewer/dompet/sespesan_acc';
		///

		$data['a']='';

		$data['b']='';

		$data['g']=$data['h']=$data['f']=$data['i']='';

		$data['c']=$data['d']=$data['k']='';

		///

		$this->load->view('pages/admin/beranda',$data);

		}else{

			 $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

		}

        

    }
    
    function terimatrnans_voc(){
            
        $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("d-m-Y ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$waktu = gmdate ( "H:i:s", time()+($ms));
		$bln = gmdate("n", time()+($ms)); // 
        $thn = gmdate("Y", time()+($ms)); // 
        //
        $ni=$this->session->userdata('ni');
       	$s_unit=$this->session->userdata('s_unit');
        $id_user=$this->session->userdata('id_user');
        //
        $cekmhsaktif=$this->M_vparsel->ceknimmhsaktif($ni);
        
        if($cekmhsaktif ->num_rows() > 0){
            
        $sal_trans=$cekmhsaktif->row()->saldo_vou;
           
        $id_voc_s=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi parsel    //masing
            
        ///PErpindahan VOUCHER
        ///20180420
       
        //riwayat
		
		//update metode pembayaran
		$rwytvocer=array(
		'id_user'=>$id_user,
		///rev 11017
		'kode'=>1, ///pendapatan
		'pendapatan'=>$sal_trans, ///pendapatan
		
		'kontek'=>'Mendapat Voucher ==  '.$sal_trans,
		'tgl_trans'=> $tanggal,
		'id_voc_p'=> $id_voc_s,
		'j_voucher'=> 3, ///mahsiswa
		///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
		//untuk keperuan nota treansaksi
		);    
		
		///PErpindahan VOUCHER
		
		    
        $pp=1;
       
        
        $d=array(
		'nik'=>$ni,
        'unit'=>$s_unit,
		'id_user'=>$id_user,
		'id_voc_mhs'=>$id_voc_s,
		'bln'=>$bln,
		'thn'=>$thn,
		'tanggal_p'=>$tanggal,
		'waktu'=>$waktu,
		'proses'=>$pp,
		'tanggal_acc'=>$tanggal.' '.$waktu,
		'saldo_awal'=>$sal_trans,
		);
		
        
         //db tbl voucher
		if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
        
        $gt_tblpesanvoucher=$this->M_vparsel->get_pesan_voc_mhs_id($id_user,$id_voc_s);
        
		if($gt_tblpesanvoucher->num_rows() ==0){
		$this->M_vparsel->insert_pesan_vmhs($d); //insert    
		///SAVE sALDO
        $idtasasl=$this->M_vparsel->get_pesan_voc_mhs_id($id_user,$id_voc_s)->row()->id;
        $this->M_adminvoc->save_tbl_saldovoc($idtasasl,$jvoc=3,$id_voc_s,$id_user,$sal_trans);
        ///
		}
        
        
		$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
		}
		//db tbl voucher
        
        $this->session->set_flashdata('pesan','Selamat, Anda mendapatkan voucher Mahasiswa sebesar 
        '.$sal_trans.' .<br/>
        Terima kasih.
        ');
		redirect ('C_dompet/tcses/mhs');
        
        }else{
            $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali 2.');
            redirect ('Login'); 
        }
        
       
    }

     function pindahstatus($idjob,$id_user){

     	 $this->session->set_flashdata('pesan','Maaf, Proses gagal');

     	$data=[

     		'job'=>$idjob=1001, //alumni

     	];
     	$id_job=$this->session->userdata('status_job');
     	if($this->session->userdata('id_user')==$id_user AND $this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user' and $id_job==3){	



     	$this->Login_model->simpan_edt_bio($data,$id_user);
     	$this->session->sess_destroy();       

     	$this->session->set_flashdata('pesandaftar','Perpindahan Status Berhasil, <br />Silahkan login kembali.');

     	

     	}

    	redirect('Login/logout');

    }
     
    
}
