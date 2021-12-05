<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_setvoc extends CI_Controller {


    public function __construct() { 
      parent::__construct();
      $this->load->database();
      $this->load->model('Mmahasiswa');
      $this->load->model('M_dompetall');
      $this->load->model('M_getsaldo');
      $this->load->model('M_gvocall');
   } 
     
	public function index()
	{
	$this->iandexx();
    }
    
    public function iandexx()
	{
	if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='admin'){

    }else{
         redirect('C_dompet/sett_voc_all');
    }
    if(!isset($_POST['jvoc'])){
        redirect('C_dompet/sett_voc_all');
    }
    
    
    $job=$this->M_setapp->get_tbl_st_job_All();
    $waktu=$this->M_time->harinow();
    $waktu_to=$this->M_time->tglnow();
    $j_voucher=$_POST['jvoc'];
    
    ///nambah edisi otomatis per j voucher
    $npro='2'; //2===update
    if($j_voucher==0){
        $id_voc_s=$this->M_voucher->get_max_id_voc();
        $nkol='id_voc';
        $npro='2';
        $j_voucher_tran='0';
    }elseif($j_voucher==2){ ///songsong
        $nkol='id_voc_song';
        $j_voucher_tran='2';
		 $id_voc_s=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi parsel
    }elseif($j_voucher==1){ ///parsel
        $nkol='id_voc_p';
        $j_voucher_tran='1';
         $id_voc_s=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi mhs
    }elseif($j_voucher==3){ ///mhs
        $nkol='id_voc_mhs';
        $j_voucher_tran='3';
         $id_voc_s=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi all
    }elseif($j_voucher==4){ ///all
        $nkol='id_voc';
        $j_voucher_tran='4';
        $id_voc_s=$this->M_vparsel->get_max_id_vocall($j_voucher);
    }  
    
    /////////////  
    if($j_voucher==4){
         $dd=array(
          $nkol=>$id_voc_s+1,
          'tgl'=>$waktu_to,
          'status'=>1,
          'j_voucher'=>$j_voucher,
          );  
    }else{
         $dd=array(
          $nkol=>$id_voc_s+1,
          'tgl'=>$waktu_to,
          );  
    }
         
    
    $this->session->set_flashdata('pesan','Sukses.');
    ////proses yang iduser khusus voc di update    
    
    //model ada pilihan j voucher
    $this->M_voucher->add_edisi_bln_now_jvoc($dd,$j_voucher); 
       
    redirect('C_dompet/sett_voc_all');
    	
	}
    
    function reset_edisi_perjvoc($jvoc){
        if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='admin'){
        $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
		$hm = $h * 60;
		$ms = $hm * 60;
		$tanggal = gmdate("Y-m-d ", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$bln = gmdate("n", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
		$thn = gmdate("Y", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
        
        if($jvoc==0){
        $id_voc_s=$this->M_voucher->get_max_id_voc();        
        $koldb='id_voc';
        }elseif($jvoc==2){
        $id_voc_s=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
        $koldb='id_voc_p';
        }elseif($jvoc==1){
        $id_voc_s=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi parsel
        $koldb='id_voc_song';
        }
        
          $d=array(
          $koldb=>$id_voc_s+1,
          );  
        
        $this->M_voucher->add_edisi_bln_now_jvoc($d,$jvoc);    
        
        $this->session->set_flashdata('pesan','Sukses.');
        redirect('C_dompet/sett_voc_all');
        }else{
			 $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
                redirect ('Login');
		}
    }    
    
    //-----------------------------------------------------------------------------------------------------------------------------
    
    function setdompet($id_user=0,$job=0){
        if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
        $id_user=$this->session->userdata('id_user');
        
        ///edisi voucher dlu di cantumkan
         $id_voc=$this->M_voucher->get_max_id_voc();
         $id_voc_sg=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi SONGSONG
         $id_voc_pa=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
         $id_voc_all=$this->M_vparsel->get_max_id_vocall($jvoc=4);
         
         //
         $id1=$id_voc-1;
         $id2=$id_voc_sg-1;
         $id3=$id_voc_pa-1;
         $id4=$id_voc_all-1;
        ///edisi voucher dlu di cantumkan
        $cek1=$this->M_setapp->cek_alllvoc_iduser($id_user,0,$id1);   // pross 3 = proses reset        
        $cek2=$this->M_setapp->cek_alllvoc_iduser($id_user,2,$id2);  // 2=song      
        $cek3=$this->M_setapp->cek_alllvoc_iduser($id_user,1,$id3);  // 1=parsel 
        $cek4=$this->M_setapp->cek_alllvoc_iduser($id_user,4,$id4);  // 4=GAJI13

        
        if($cek1->num_rows() > 0){
         $this->setvoc_makan($id_user,$id_voc);

        }
        if($cek2->num_rows() > 0){
        // echo $cek2->num_rows().'<br/>';
         $this->setvoc_song2($id_user,$id_voc_sg);
        }
        if($cek3->num_rows() > 0){
        // echo $cek3->num_rows().'<br/>';
          $this->setvoc_parsel($id_user,$id_voc_pa);
        }
        if($cek4->num_rows() > 0){
        // echo $cek3->num_rows().'<br/>';
          $this->setvoc_all($id_user,$id_voc_all,4);
        }
        
        ////hapus data JIKA SELESAI
        $this->M_setapp->del_cekupvoc_user($id_user);
        $this->M_setapp->del_cekupvoc_user($id_user);
        ///
        
        ///proses lanjutan
        redirect('C_uprevdb');
        //redirect('C_dompet/dompet');
        
        }else{ ///iflogin
        
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');

        redirect ('Login');
         
        }
        }
    
    function setvoc_makan($id_user=0,$id_voc){
         if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
         $iduser=$id_user=$this->session->userdata('id_user');
        
         $waktu=$this->M_time->harinow();
         $id1=$id_voc-1; //tidak perlu
         ////------------------------------------------------------------------
         $cek1=$this->M_setapp->cek_alllvoc_iduser($id_user,0,$id1); //par3 = proses reset        
    
         if($cek1->num_rows() == 0){
             $this->setdompet();
         }
         
         $id_vocdl=$cek1->row()->id_voc_dl;
         //================
        ///

        $hg=$this->M_getsaldo->getSaldo($iduser,$id_vocdl,$j_voc=0);

        $tosaldopar=$hg['saldoSisa'];

        ////////////////////////
        $this->sv_saldoVoc($iduser,$id_vocdl,$j_voc=0);
        /////////////////RIWAYAT
         $d=[
         'id_user'=>$id_user,
         'id_voc'=>$id_voc, 
         'j_voucher'=>0, 
         'tanggal_i'=>$waktu,
         'proses'=>1, //1= aktif
         'saldo_awal'=>$tosaldopar,
          ];
         
         $this->M_vparsel->save_sissaldo_voc($d); ///menuju edisi parsel
          
 
         //print_r($d);
       
        
        }else{ ///iflogin
        
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
        redirect ('Login');
         
        }
        }
    
    function setvoc_song2($id_user=0,$id_voc){
         if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
         $iduser=$id_user=$this->session->userdata('id_user');
          $waktu=$this->M_time->harinow();
        /////---PEMBEDA parsel=2 dan song2=1--
         $id2=$id_voc-1;
        ////------------------------------------------------------------------
         $cek1=$this->M_setapp->cek_alllvoc_iduser($id_user,2,$id2); //par3 = proses reset        
         if($cek1->num_rows() == 0){
             $this->setdompet();
         }
         $id_voc_s=$cek1->row()->id_voc_dl;
         //================
      
        $hg=$this->M_getsaldo->getSaldo($iduser,$id_vocdl,$j_voc=2);

        $tosaldopar=$hg['saldoSisa'];

        ////////////////////////
        $this->sv_saldoVoc($iduser,$id_vocdl,$j_voc=2);
        /////////////////RIWAYAT
         
         $d=[
         'id_user'=>$id_user,
         'id_voc'=>$id_voc, 
         'j_voucher'=>2, //new
         'tanggal_i'=>$waktu,
         'proses'=>1, //1= aktif
         'saldo_awal'=>$tosaldopar,
          ];
         
         $this->M_vparsel->save_sissaldo_voc($d); ///menuju edisi parsel
          
 
         //print_r($d);
       
        
        }else{ ///iflogin
        
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
        redirect ('Login');
         
        }
        }
    
    function setvoc_parsel($id_user=0,$id_voc){
         if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
          $iduser=$id_user=$this->session->userdata('id_user');
          $waktu=$this->M_time->harinow();
        /////---PEMBEDA parsel=1 dan song2=2--
        $id3=$id_voc-1;
         ////------------------------------------------------------------------
         $cek1=$this->M_setapp->cek_alllvoc_iduser($id_user,1,$id3); //par3 = proses reset        
         if($cek1->num_rows() == 0){
             $this->setdompet();
         }
         $id_voc_s=$cek1->row()->id_voc_dl;
         //================
        $hg=$this->M_getsaldo->getSaldo($iduser,$id_vocdl,$j_voc=1);

        $tosaldopar=$hg['saldoSisa'];

        ////////////////////////
        $this->sv_saldoVoc($iduser,$id_vocdl,$j_voc=1);
        /////////////////RIWAYAT
         
         $d=[
         'id_user'=>$id_user,
         'id_voc'=>$id_voc, 
         'j_voucher'=>1, //new
         'tanggal_i'=>$waktu,
         'proses'=>1, //1= aktif
         'saldo_awal'=>$tosaldopar,
          ];
         
         $this->M_vparsel->save_sissaldo_voc($d); ///menuju edisi parsel
          
 
         //print_r($d);
       
        
        }else{ ///iflogin
        
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
        redirect ('Login');
         
        }
        }
    
    ///set voucher yang ga direst
    function setvoc_all($id_user=0,$id_voc,$jvoc){
         if($this->session->userdata('login')==TRUE AND $this->session->userdata('wewenang')=='user'){
          $iduser=$id_user=$this->session->userdata('id_user');
          $waktu=$this->M_time->harinow();
        ////-------------
        $id4=$id_voc-1;
        ////------------------------------------------------------------------
         $cek1=$this->M_setapp->cek_alllvoc_iduser($id_user,$jvoc,$id4); //par3 = proses reset        
         
         if($cek1->num_rows() == 0){
             $this->setdompet();
         }
         $id_voc_s=$cek1->row()->id_voc_dl;
         
        //================DIRUBAH UBAH
       
        $hg=$this->M_getsaldo->getSaldo($iduser,$id_vocdl,$j_voc=4);

        $tosaldopar=$hg['saldoSisa'];

        ////////////////////////
        $this->sv_saldoVoc($iduser,$id_vocdl,$j_voc=4);
        /////////////////RIWAYAT 
         $d=[
         'id_user'=>$id_user,
         'id_voc'=>$id_voc, 
         'j_voucher'=>$jvoc, //new
         'tanggal_i'=>$waktu,
         'proses'=>1, //1= aktif
         'saldo_awal'=>$tosaldopar,
          ];
         
         $this->M_vparsel->save_sissaldo_voc($d); ///menuju edisi parsel
          
 
         //print_r($d);
       
        
        }else{ ///iflogin
        
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
        redirect ('Login');
         
        }
        }

        function sv_saldoVoc($iduser,$id_vocdl,$j_voc){
        //riwayat
        
        if($this->session->userdata('login')==FALSE){ redirect('Login');}
        ///PErpindahan VOUCHER
        $iduser=$id_user=$this->session->userdata('id_user');
        $waktu=$this->M_time->harinow();
        $gv=$this->M_gvocall->gvall($j_voc,$iduser);
        $hg=$this->M_getsaldo->getSaldo($iduser,$id_vocdl,$j_voc);

        $sal_trans=$hg['saldoSisa'];
        
        $d=array(
        'proses'=>1,
        'id_user'=>$id_user,
        'id_voc'=>$gv['id_voc'],
        'tanggal_acc'=>$waktu,
        'saldo_awal'=>$sal_trans,
        );

        $this->Madmin_master->pesan_v($d);

        //update metode pembayaran
        $rwytvocer=array(
        'id_user'=>$id_user,
        ///rev 11017
        'kode'=>1, ///pendapatan
        'pendapatan'=>$sal_trans, ///pendapatan
        
        'kontek'=>'Mendapat Sisa Voucher '.$j_voc.' Edisi '.$gv['id_voc'].'  ===  '.$sal_trans,
        
        'tgl_trans'=> $waktu,
        'id_voc'=> $gv['id_voc'],
        'j_voucher'=> $j_voc, ///makan //reguler
        ///nanti bila emailselesai ad tambahan feildid tanggal sampe jamdan menit.
        //untuk keperuan nota treansaksi
        );    

        $this->Mtrans->simpan_tabl_riwayatvoc($rwytvocer); //riweayat
        


        }

   public function simpan_SetDompet()
    {
        if($this->session->userdata('login')==FALSE OR $this->session->userdata('wewenang')!='admin'){
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
        redirect ('Login');
         
        }
        
        $d=[
            'fasilitas'=>$_POST['fas'],
            'status'=>$_POST['stFas'],
            'id_user'=>$this->session->userdata('id_user'),
            'tgl'=>$this->M_time->harinow(),
        ];

        $this->M_dompetall->saveAksesFasilitas($d);

        redirect($this->M_setapp->urlBack());
        
    }    
    public function simpan_SetDompetAkun()
    {
        if($this->session->userdata('login')==FALSE OR $this->session->userdata('wewenang')!='admin'){
        $this->session->set_flashdata('pesan','Maaf, Anda harus login kembali .');
        redirect ('Login');
         
        }
        
        $d=[
            'fasilitas'=>$this->input->post('fas'),
            'status'=>$this->input->post('stFas'),
            'id_user'=>$this->input->post('akun'),
            'tgl'=>$this->M_time->harinow(),
        ];
        // print_r($d);
        // die();
        $this->M_dompetall->saveAksesFasilitasAkun($d);

        redirect($this->M_setapp->urlBack());
        
    }    
    
} //cls
?>