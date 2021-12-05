<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_voc_acc extends CI_Controller {


    public function __construct() { 
      parent::__construct();
      $this->load->database();
      $this->load->model('Mmahasiswa');
      $this->load->model('M_adminvoc');
      $this->load->model('M_dompetall');
      $this->load->model('M_gvocall');
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
    
    function pe_terima_voucher_makan($id,$jvoc=0){
		if($this->session->userdata('id_user')==$id AND $this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){	
		///waktu
		
        $this->form_validation->set_rules('nik','nik','required');
        $this->form_validation->set_rules('unit','unit','required');
        $this->form_validation->set_rules('ya01','ya01','required');
        $idvoc=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi parsel
        $g_jvoc=$this->M_getsaldo->get_jenisVoc_id($jvoc)->row();

        if ($this->form_validation->run() == TRUE){
        $ni=$this->input->post('nik'); 
        $cekmhsaktif=$this->M_adminvoc->cekniaktif($ni,$jvoc);
        $this->session->set_userdata('s_unit',$this->input->post('unit'));

        if($cekmhsaktif ->num_rows() == 0){
        $this->session->set_flashdata('pesan','Maaf, Anda Tidak berhak mendapatkan Voucher '.$g_jvoc->nama_jvoc.'.<br/> Karena Identitas tidak dikenal.
        <br/>
        Terima kasih.
        ');  
        $this->session->set_userdata('t_acc','0');  

        }else{
        $this->session->set_flashdata('pesan','Selamat, Anda berhak mendapatkan Voucher '.$g_jvoc->nama_jvoc.'.<br/> Klik tombol terima untuk mendapatkan Voucher '.$g_jvoc->nama_jvoc.'
        ');
        $this->session->set_userdata('t_acc','1');  
        $this->session->set_userdata('sjvoc',$g_jvoc->id_jen_voc);  
        }

        
        
		///
		//$this->Madmin_master->block_penjual_model($id,$d);
		//bila belum buat kalau udah di update
		
		
		redirect ('C_voc_acc/acc_voc/'.$g_jvoc->id_jen_voc.'');
        
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
    
    function kemail_($t,$sal_trans,$jvoc){
		///waktu
        $g_jvoc=$this->M_getsaldo->get_jenisVoc_id($jvoc)->row();
        if($t=='t'){
		$isinot='
        Selamat,
		Voucher '.$g_jvoc->nama_jvoc.' Sudah diterima.
		.<br/>
        Sebesar Rp '. $sal_trans
        .'
        <br/>--------------------------------------<br/>
        Terimakasih.
        ';
        
         
        }else{
		$isinot='

            		Mohon Maaf, <br/>

            		anda tidak diterima untuk memesan Voucher .<br/>

            		Karena : 
                    
                    <br/>--------------------------------------<br/>
                    Terimakasih.

            		';	
        }
        
        $this->c_email();
        $this->email->to($Emailto); ///ke email pembeli
        $this->email->bcc('admin@E-Retail.com');
        $this->email->subject('Notifikasi - [E-Retail SUPERMALL]');
        $this->email->message($isinot);
        $this->email->send();
        
    }
    
    ///TERIMA VOC
    
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

        if($trans=='0'){

        $data['link']=base_url('C_dompet/dompet');   
        $data['link_acc']=base_url('C_voc_acc/terimatrnans_voc_makan');     

        }elseif($trans=='1'){

        $data['link']=base_url('C_dompetp/dompet');    

        }elseif($trans=='mhs' && $job==3){

        $data['link']=base_url('C_mahasiswa/dompet_mhs');    
        $data['link_acc']=base_url('C_mahasiswa/terimatrnans_voc');    

        }elseif($trans=='2'){

        $data['link']=base_url('C_dompetsong');    
        $data['link_acc']=base_url('C_voc_acc/terimatrnans_voc_rmd');     

        }elseif($trans=='4'){

        $data['link']=base_url('C_dompetvoc');    
        $data['link_acc']=base_url('C_voc_acc/terimatrnans_voc_gji/');     

        }else{

        $data['link']=base_url('C_dompet');    
        $data['link_acc']=base_url('C_dompet');    

        }


		$data['view']='pages/admin/viewer/dompet/sespesan_acc';
		///

		$data['a']='';

		$data['b']='';
		$data['l']='active';

		$data['g']=$data['h']=$data['f']=$data['i']='';

		$data['c']=$data['d']=$data['k']='';

		///

		$this->load->view('pages/admin/beranda',$data);

		}else{

			 $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

                redirect ('Login');

		}

        

    }
    
    function terimatrnans_voc_makan(){
        
        if($this->session->userdata('login')!=TRUE OR $this->session->userdata('wewenang')!='user'){	
        redirect('login');
        }
            
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
        $jvoc=$this->session->userdata('sjvoc');
        
        //
        $cekmhsaktif=$this->M_adminvoc->cekniaktif($ni,$jvoc);
        
        if($cekmhsaktif ->num_rows() > 0){
            
        $sal_trans=$cekmhsaktif->row()->saldo_vou;
           
        $id_voc_s=$this->M_voucher->get_max_id_voc();  //makan
            
        ///PErpindahan VOUCHER
        ///20180420
       
        //riwayat
		
		//update metode pembayaran
		$rwytvocer=array(
		'id_user'=>$id_user,
		///rev 11017
		'kode'=>1, ///pendapatan
		'pendapatan'=>$sal_trans, ///pendapatan
		
		'kontek'=>'Mendapat Voucher MAKAN==  '.$sal_trans,
		'tgl_trans'=> $tanggal,
		'id_voc_p'=> $id_voc_s,
		'j_voucher'=> 0, ///MAKAN
		///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
		//untuk keperuan nota treansaksi
		);    
		
		///PErpindahan VOUCHER
		
		    
        $pp=1;
       
        
        $d=array(
		'nik'=>$ni,
        'unit'=>$s_unit,
		'id_user'=>$id_user,
		'id_voc'=>$id_voc_s,
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
        
        $gt_tblpesanvoucher=$this->M_vparsel->get_saldo_voc_makan_iduser($id_user,$id_voc_s);
        
		if($gt_tblpesanvoucher->num_rows() == 0){
		$this->M_vparsel->insert_pesan_vmakan($d); //insert

        ///SAVE sALDO
        $idtasasl=$this->M_vparsel->get_saldo_voc_makan_iduser($id_user,$id_voc_s)->row()->id;
        $this->M_adminvoc->save_tbl_saldovoc($idtasasl,$jvoc,$id_voc_s,$id_user,$sal_trans);
        ///



		}
        
        
		$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
		}
		//db tbl voucher
        
        $this->session->set_flashdata('pesan','Selamat, Anda mendapatkan voucher MAKAN sebesar 
        '.$sal_trans.' .<br/>
        Terima kasih.
        ');
        
        ///KIRIM EMAIl
        
        // $this->kemail_('t',$sal_trans,$jvoc);
        
		redirect ('C_dompet/tcses/mkn/'.$jvoc);
        
        }else{
            $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali 2 .');
            redirect ('Login'); 
        }
        
       
    }
    
    function terimatrnans_voc_rmd(){
        
        if($this->session->userdata('login')!=TRUE OR $this->session->userdata('wewenang')!='user'){	
        redirect('login');
        }
            
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
        $jvoc=$this->session->userdata('sjvoc');
        //
        $cekmhsaktif=$this->M_adminvoc->cekniaktif($ni,$jvoc);
        
        if($cekmhsaktif ->num_rows() > 0){
            
        $sal_trans=$cekmhsaktif->row()->saldo_vou;
           
        $id_voc_s=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi SONGSONG
            
        ///PErpindahan VOUCHER
        ///20180420
       
        //riwayat
		
		//update metode pembayaran
		$rwytvocer=array(
		'id_user'=>$id_user,
		///rev 11017
		'kode'=>1, ///pendapatan
		'pendapatan'=>$sal_trans, ///pendapatan
		
		'kontek'=>'Mendapat Voucher RMD&THR==  '.$sal_trans,
		'tgl_trans'=> $tanggal,
		'id_voc_p'=> $id_voc_s,
		'j_voucher'=> 2, ///RMD
		///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
		//untuk keperuan nota treansaksi
		);    
		
		///PErpindahan VOUCHER
		
		    
        $pp=1;
       
        
        $d=array(
		'nik'=>$ni,
        'unit'=>$s_unit,
		'id_user'=>$id_user,
		'id_voc_song'=>$id_voc_s,
		'bln'=>$bln,
		'thn'=>$thn,
		'tanggal_p'=>$tanggal,
		'waktu'=>$waktu,
		'proses'=>$pp,
		'tanggal_acc'=>$tanggal.' '.$waktu,
		'saldo_awal'=>$sal_trans,
		);
		
        
         //db tbl voucher
        
        $gt_tblpesanvoucher=$this->M_vparsel->get_pesan_voc_song2_id($id_user,$id_voc_s);
        
		if($gt_tblpesanvoucher->num_rows() == 0){
		$this->M_vparsel->insert_pesan_vsong2($d); //insert    

        ///SAVE sALDO
        $idtasasl=$this->M_vparsel->get_pesan_voc_song2_id($id_user,$id_voc_s)->row()->id;
        $this->M_adminvoc->save_tbl_saldovoc($idtasasl,$jvoc,$id_voc_s,$id_user,$sal_trans);
        ///



		}
        
        
		$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
		//db tbl voucher
        
        $this->session->set_flashdata('pesan','Selamat, Anda mendapatkan voucher RMD&THR sebesar 
        '.$sal_trans.' .<br/>
        Terima kasih.
        ');
        
        ///KIRIM EMAIl
        
        // $this->kemail_('t',$sal_trans,$jvoc);
        
		redirect ('C_dompet/tcses/'.$jvoc);
        
        }else{
            $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali 2');
            redirect ('Login'); 
        }
        
       
    }
    
    function terimatrnans_voc_gji(){
        
        if($this->session->userdata('login')!=TRUE OR $this->session->userdata('wewenang')!='user'){	
        redirect('login');
        }
            
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
        $jvoc=$this->session->userdata('sjvoc');
        //
        $cekmhsaktif=$this->M_adminvoc->cekniaktif($ni,$jvoc);
        
        if($cekmhsaktif ->num_rows() > 0){
            
        $sal_trans=$cekmhsaktif->row()->saldo_vou;
           
        $id_voc_s=$this->M_vparsel->get_max_id_vocall($jvoc); ///menuju edisi voucher all
            
        ///PErpindahan VOUCHER
        ///20180420
       
        //riwayat
		
		//update metode pembayaran
		$rwytvocer=array(
		'id_user'=>$id_user,
		///rev 11017
		'kode'=>1, ///pendapatan
		'pendapatan'=>$sal_trans, ///pendapatan
		
		'kontek'=>'Mendapat Voucher VG13==  '.$sal_trans,
		'tgl_trans'=> $tanggal,
		'id_voc_p'=> $id_voc_s,
		'j_voucher'=> 4, ///RMD
		///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
		//untuk keperuan nota treansaksi
		);    
		
		///PErpindahan VOUCHER
		
		    
        $pp=1;
       
        
        $d=array(
		'nik'=>$ni,
        'unit'=>$s_unit,
		'id_user'=>$id_user,
		'id_voc'=>$id_voc_s,
		'bln'=>$bln,
		'thn'=>$thn,
        'j_voucher'=> 4, ///RMD
		'tanggal_p'=>$tanggal,
		'waktu'=>$waktu,
		'proses'=>$pp,
		'tanggal_acc'=>$tanggal.' '.$waktu,
		'saldo_awal'=>$sal_trans,
		);
		
        
         //db tbl voucher
        
        $gt_tblpesanvoucher=$this->M_gvocall->get_pesan_voucher_vall($id_user,$id_voc_s,1,$jvoc);
        
		if($gt_tblpesanvoucher->num_rows() == 0){
		$this->M_dompetall->insert_pesan_vall($d);

        ///SAVE sALDO
        $idtasasl=$this->M_gvocall->get_pesan_voucher_vall($id_user,$id_voc_s,1,$jvoc)->row()->idpvoc;
        $this->M_adminvoc->save_tbl_saldovoc($idtasasl,$jvoc,$id_voc_s,$id_user,$sal_trans);
        ///

		
        }

        
        
		$this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
		//db tbl voucher
        
        $this->session->set_flashdata('pesan','Selamat, Anda mendapatkan voucher GAJI13 sebesar 
        '.$sal_trans.' .<br/>
        Terima kasih.
        ');
        
        ///KIRIM EMAIl
        
        //$this->kemail_('t',$sal_trans,$jvoc);
        
		redirect ('C_dompet/tcses/'.$jvoc);
        
        }else{
            $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali 2');
            redirect ('Login'); 
        }
        
       
    }
}
