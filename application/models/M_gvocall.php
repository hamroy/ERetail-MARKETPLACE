<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_gvocall extends CI_Model {


    function __construct()
	{
		parent::__construct();

        $this->load->model('M_getsaldo');


	}
    
	function gvall($jvoc,$id_user)

	{
    
        $data['jvoc']=$jvoc;
        $data['id_voc']='';
        $data['id_user']=$id_user;
        $data['durasi']=0;

        $data['saldo']=0;
        $data['saldo_dibelanjakan']=0;
        $data['saldo_dibelanjakan_proses']=0;
        $data['dompet']=0;
        $data['dompet_selesai']=0;

        $data['redeemTotal']=0;
        $data['redeem']=0;
        $data['redeemSelesai']=0;
        $data['kode']=0;
        $data['pesan']='jenis voucher tidak tersedia';

        
	switch ($jvoc){
        case 0: //makan
        ///
        $data=$this->makan($jvoc,$id_user);
        ///
        break;
        case 1: ///parsel
        
        ///
        //$data=$this->parsel($jvoc,$id_user);
        ///
        break;
        case 2: ///rmd
        ///
        $data=$this->rmd($jvoc,$id_user);
        ///
        break;
        case 3: //mahasiswa
        ///
        $data=$this->vmhs($jvoc,$id_user);
        ///
        
        break;
       
        default: //GAJI13 ==4 ~
        
        $data['id_voc']=FALSE;
        $id_voc=$this->M_vparsel->get_max_id_vocall($jvoc); ///menuju edisi voucher all
        if($jvoc==99){

            $data=$this->dompetKu($jvoc,$id_user);
             
        }else{
            $data=$this->vall($jvoc,$id_user);
        }   
        break;
        
        
    }
    
     return $data;

	}
    
    function makan($jvoc,$id_user){
        
        $id_voc_s=$this->M_voucher->get_max_id_voc();  //makan
        
        $gpv=$this->M_vparsel->get_saldo_voc_makan_iduser($id_user,$id_voc_s,1); ///get saldo awal || 1=prsoes acc
        $gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vmakan($id_user,$id_voc_s,0); //tbltransaksi|| 0=makan
        $gettotal_parsel_pesan = $this->M_vparsel->get_total_tbltransaksi_vmakan_pesan($id_user,$id_voc_s,0); //tbltransaksi
        $gettotal_parsel_proses = $this->M_vparsel->get_total_tbltransaksi_proses($id_user,$id_voc_s,0,'diproses'); //tbltransaksi proses
        $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vmakan_didapat($id_user,$id_voc_s,0); //tbltransaksi
       
        $durasi=0;
        $hparsel=0;
        
        if($gpv->num_rows() > 0){
            ///pengulangan jika tumbol reset aktif
            $hg=$this->M_getsaldo->getSaldo($id_user,$id_voc_s,$jvoc=0);
            $hparsel=$hg['saldoDompet'];
            $durasi=$hg['durasi'];

        }    
        
       
        
        $tranpesanbaayar=($gettotal_parsel+$gettotal_parsel_pesan);

        $tosaldopar=$hparsel-$tranpesanbaayar; ///hasil akhir saldo

        //ONOFF VOUCHER
        

        if($this->onOffVoc($jvoc,$id_user)==1){
            $tosaldopar=0;
        }

        if ($tosaldopar<0) {
            $tosaldopar=0;
        }
        
        ////pendapatan voc parsel 
        $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($id_user,0); ///1=parsel , 0=makan ,2=song2
        $dompet_dicairkan=$this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user,0,0);
        $dompet_selesai=$this->Mbmt->get_tbl_reedeem_perid_user_selesai($id_user,$jvoc,1);
        //
        $dompet=$gettotal_parsel_dapat-$get_reedeem; ///hasil akhir pendapatan
        //
        //output
        $data['jvoc']=$jvoc;
        $data['id_voc']=$id_voc_s;
        $data['id_user']=$id_user;
        $data['durasi']=$durasi;

        $data['saldo']=$tosaldopar;
        $data['saldo_dibelanjakan']=$gettotal_parsel_pesan;
        $data['saldo_dibelanjakan_proses']=$gettotal_parsel_proses;

        $data['dompet']=$gettotal_parsel_dapat;
        $data['dompet_selesai']=$dompet;

        $data['redeemTotal']=$get_reedeem;
        $data['redeem']=$dompet_dicairkan;
        $data['redeemSelesai']=$dompet_selesai;
        $data['pesan']='ok';
        $data['kode']=1;
        $data['t_rinci']='C_monitorvoc/akunRinciVoc/'.$jvoc.'/'.$id_user;
        ///
        
        return $data;
        
        
        
    }
    
    //////////////parsel 'mati'
    function parsel($jvoc,$id_user){
        
        $id_voc_s=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
      
        $gpv=$this->M_vparsel->get_saldo_voc_parsel_iduser($id_user,$id_voc_s);
        
        $gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vparsel($id_user,$id_voc_s,1);	//tbltransaksi
        $gettotal_parsel_pesan = $this->M_vparsel->get_total_tbltransaksi_vparsel_pesan($id_user,$id_voc_s,1);	//tbltransaksi
        $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($id_user,$id_voc_s,1);	//tbltransaksi
        
        $hparsel=0;
        
        if($gpv->num_rows() > 0){
            $hg=$this->M_getsaldo->getSaldo($id_user,$id_voc_s,$jvoc=1);
            $hparsel=$hg['saldoDompet'];
        }    
        
        
        $tranpesanbaayar=($gettotal_parsel+$gettotal_parsel_pesan);
        
        $tosaldopar=($hparsel)-$tranpesanbaayar; //hasil akhir saldo
        //ONOFF VOUCHER
        

        if($this->onOffVoc($jvoc,$id_user)==1){
            $tosaldopar=0;
        }
        
        ////pendapatan voc parsel 
        $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($id_user,1);
        $dompet_dicairkan=$this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user,1,0);
        $dompet_selesai=$this->Mbmt->get_tbl_reedeem_perid_user_selesai($id_user,$jvoc,1);
        //
        $dompet=$gettotal_parsel_dapat-$get_reedeem; ///saldo pendapatan = transaksi-redeem(selain tolak)
        //output
        $data['jvoc']=$jvoc;
        $data['id_voc']=$id_voc_s;
        $data['id_user']=$id_user;
        $data['saldo']=$tosaldopar;
        $data['saldo_dibelanjakan']=$gettotal_parsel_pesan;
        $data['saldo_dibelanjakan_proses']=0;

        $data['dompet']=$gettotal_parsel_dapat;
        $data['dompet_selesai']=$dompet;

        $data['redeemTotal']=$get_reedeem;
        $data['redeem']=$dompet_dicairkan;
        $data['redeemSelesai']=$dompet_selesai;
        $data['pesan']='ok';
        $data['kode']=1;
        $data['t_rinci']='C_monitorvoc/akunRinciVoc/'.$jvoc.'/'.$id_user;
        ///
        
        return $data;
        
        
        
    }
    //////////////rmd&thr
    function rmd($jvoc,$id_user){
        
        $id_voc_s=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi RMD DAN THR
      
        $gpv=$this->M_vparsel->get_pesan_voc_song2_id($id_user,$id_voc_s);   ///ysng proses ==1 
        
        $gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vparsel($id_user,$id_voc_s,2);	//tbltransaksi
        $gettotal_parsel_pesan = $this->M_vparsel->get_total_tbltransaksi_vparsel_pesan($id_user,$id_voc_s,2);	//tbltransaksi
        $gettotal_parsel_proses = $this->M_vparsel->get_total_tbltransaksi_proses($id_user,$id_voc_s,2,'diproses');  //tbltransaksi
        $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($id_user,$id_voc_s,2);	//tbltransaksi
        
        $hparsel=0;
        $durasi=0;
        
        if($gpv->num_rows() > 0){
            $hg=$this->M_getsaldo->getSaldo($id_user,$id_voc_s,$jvoc=2);
            $hparsel=$hg['saldoDompet'];
            $durasi=$hg['durasi'];
        }    
        
        $tranpesanbaayar=($gettotal_parsel+$gettotal_parsel_pesan);
        
        $tosaldopar=($hparsel)-$tranpesanbaayar; //hasil akhir saldo
        
        //ONOFF VOUCHER
        

        if($this->onOffVoc($jvoc,$id_user)==1){
            $tosaldopar=0;
        }

        if ($tosaldopar<0) {
            $tosaldopar=0;
        }
        
        ////pendapatan voc parsel 
        $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($id_user,2);
        $dompet_dicairkan=$this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user,2,0);
        $dompet_selesai=$this->Mbmt->get_tbl_reedeem_perid_user_selesai($id_user,$jvoc,1);
        //
        $dompet=$gettotal_parsel_dapat-$get_reedeem; ///saldo pendapatan = transaksi-redeem(selain tolak)
        //output
        $data['durasi']=$durasi;
        $data['jvoc']=$jvoc;
        $data['id_voc']=$id_voc_s;
        $data['id_user']=$id_user;
        $data['saldo']=$tosaldopar;
        $data['saldo_dibelanjakan']=$gettotal_parsel_pesan;
        $data['saldo_dibelanjakan_proses']=$gettotal_parsel_proses;

        $data['dompet']=$gettotal_parsel_dapat;
        $data['dompet_selesai']=$dompet;

        $data['redeemTotal']=$get_reedeem;
        $data['redeem']=$dompet_dicairkan;
        $data['redeemSelesai']=$dompet_selesai;
        $data['pesan']='ok';
        $data['kode']=1;
        $data['t_rinci']='C_monitorvoc/akunRinciVoc/'.$jvoc.'/'.$id_user;
        ///
        
        return $data;
        
        
        
    }
    
    //////////////voucher all
    function vall($jvoc,$id_user){
        
        $id_voc_s=$this->M_vparsel->get_max_id_vocall($jvoc); ///menuju edisi voucher all
      
        $gpv=$this->M_dompetall->get_pesan_voc_all_iduser($id_user,$id_voc_s,$jvoc,1);    
        
        $gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vparsel($id_user,$id_voc_s,$jvoc);	//tbltransaksi 1=[parsel],$jvoc=4
        $gettotal_parsel_pesan = $this->M_vparsel->get_total_tbltransaksi_vparsel_pesan($id_user,$id_voc_s,$jvoc);	//tbltransaksi
        $gettotal_parsel_proses = $this->M_vparsel->get_total_tbltransaksi_proses($id_user,$id_voc_s,$jvoc,'diproses');  //tbltransaksi
        $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($id_user,$id_voc_s,$jvoc);	//tbltransaksi
        $hparsel=0;
        $durasi=0;
        
        if($gpv->num_rows() > 0){
            $hg=$this->M_getsaldo->getSaldo($id_user,$id_voc_s,$jvoc);
            $hparsel=$hg['saldoDompet'];
            $durasi=$hg['durasi'];
        }    
        
        $tranpesanbaayar=($gettotal_parsel+$gettotal_parsel_pesan);
        $tosaldopar=$hparsel-$tranpesanbaayar;
        //ONOFF VOUCHER
        

        if($this->onOffVoc($jvoc,$id_user)==1){
            $tosaldopar=0;
        }

        if ($tosaldopar<0) {
            $tosaldopar=0;
        }

        ////pendapatan voc parsel 
        $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($id_user,$jvoc);
        $dompet_dicairkan=$this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user,$jvoc,0);
        $dompet_selesai=$this->Mbmt->get_tbl_reedeem_perid_user_selesai($id_user,$jvoc,1);
        //
        $dompet=$gettotal_parsel_dapat-$get_reedeem;
        //output
        $data['jvoc']=$jvoc;
        $data['durasi']=$durasi;
        $data['id_voc']=$id_voc_s;
        $data['id_user']=$id_user;
        $data['saldo']=$tosaldopar;
        $data['saldo_dibelanjakan']=$gettotal_parsel_pesan;
        $data['saldo_dibelanjakan_proses']=$gettotal_parsel_proses;

        $data['dompet']=$gettotal_parsel_dapat;
        $data['dompet_selesai']=$dompet;

        $data['redeemTotal']=$get_reedeem;
        $data['redeem']=$dompet_dicairkan;
        $data['redeemSelesai']=$dompet_selesai;
        $data['pesan']='ok';
        $data['kode']=1;
        $data['t_rinci']='C_monitorvoc/akunRinciVoc/'.$jvoc.'/'.$id_user;
        ///
        
        return $data;
        
        
        
    }

    //////////////dompet
    function dompetKu($jvoc,$id_user){
        
        $id_voc_s=0;
        $gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vparsel($id_user,$id_voc_s,$jvoc);  //tbltransaksi 1=[parsel],$jvoc=4
        $gettotal_parsel_pesan = $this->M_vparsel->get_total_tbltransaksi_vparsel_pesan($id_user,$id_voc_s,$jvoc);  //tbltransaksi
        $gettotal_parsel_proses = $this->M_vparsel->get_total_tbltransaksi_proses($id_user,$id_voc_s,$jvoc,'diproses');  //tbltransaksi
        $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($id_user,$id_voc_s,$jvoc);    //tbltransaksi
       
        ////pendapatan voc parsel 
        $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($id_user,$jvoc);
        $dompet_dicairkan=$this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user,$jvoc,0);
        $dompet_selesai=$this->Mbmt->get_tbl_reedeem_perid_user_selesai($id_user,$jvoc,1);
        //
        $dompet=$gettotal_parsel_dapat-$get_reedeem;
        //output
        $data['jvoc']=$jvoc;
        $data['durasi']=0;
        $data['id_voc']=$id_voc_s;
        $data['id_user']=$id_user;
        $data['saldo']=0;
        $data['saldo_dibelanjakan']=$gettotal_parsel_pesan;
        $data['saldo_dibelanjakan_proses']=$gettotal_parsel_proses;

        $data['dompet']=$gettotal_parsel_dapat;
        $data['dompet_selesai']=$dompet;

        $data['redeemTotal']=$get_reedeem;
        $data['redeem']=$dompet_dicairkan;
        $data['redeemSelesai']=$dompet_selesai;
        $data['pesan']='ok';
        $data['kode']=1;
        $data['t_rinci']='C_monitorvoc/akunRinciVoc/'.$jvoc.'/'.$id_user;
        ///
        
        return $data;
        
        
        
    }
    
    //////////////voucher MAHASISWA
    function vmhs($jvoc,$id_user){
        
        $id_voc_s=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi parsel
        $gpv=$this->M_vparsel->get_saldo_voc_mhs_iduser($id_user,$id_voc_s);
        $gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vparsel($id_user,$id_voc_s,3);	//tbltransaksi 1=[parsel]
        $gettotal_parsel_pesan = $this->M_vparsel->get_total_tbltransaksi_vparsel_pesan($id_user,$id_voc_s,3);  //tbltransaksi
        $gettotal_parsel_proses = $this->M_vparsel->get_total_tbltransaksi_proses($id_user,$id_voc_s,3,'diproses');	//tbltransaksi
        
        $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($id_user,$id_voc_s,3);	//tbltransaksi
        
        $hparsel=0;
        $durasi=0;
       
        
        if($gpv->num_rows() > 0){
            $hg=$this->M_getsaldo->getSaldo($id_user,$id_voc_s,$jvoc);
            $hparsel=$hg['saldoDompet'];
            $durasi=$hg['durasi'];
        }    
        
        
        
        $tranpesanbaayar=($gettotal_parsel+$gettotal_parsel_pesan);
        $tosaldopar=$hparsel-$tranpesanbaayar;

        //ONOFF VOUCHER
        if($this->onOffVoc($jvoc,$id_user)==1){
            $tosaldopar=0;
        }

        if ($tosaldopar<0) {
            $tosaldopar=0;
        }
        
        ////pendapatan voc parsel 
        $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($id_user,3);
        $dompet_dicairkan=$this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user,3,0);
        $dompet_selesai=$this->Mbmt->get_tbl_reedeem_perid_user_selesai($id_user,$jvoc,1);
        //
        $dompet=$gettotal_parsel_dapat-$get_reedeem;
        //output
        $data['jvoc']=$jvoc;
        $data['durasi']=$durasi;
        $data['id_voc']=$id_voc_s;
        $data['id_user']=$id_user;
        $data['saldo']=$tosaldopar;
        $data['saldo_dibelanjakan']=$gettotal_parsel_pesan;
        $data['saldo_dibelanjakan_proses']=$gettotal_parsel_proses;

        $data['dompet']=$gettotal_parsel_dapat;
        $data['dompet_selesai']=$dompet;

        $data['redeemTotal']=$get_reedeem;
        $data['redeem']=$dompet_dicairkan;
        $data['redeemSelesai']=$dompet_selesai;
        $data['pesan']='ok';
        $data['kode']=1;
        $data['t_rinci']='C_monitorvoc/akunRinciVoc/'.$jvoc.'/'.$id_user;
        ///
        
        return $data;
        
        
        
    }
    
    //============================================================================================================================
    //============================================================================================================================
    
    function getPesanVoc($jvoc,$id_user){
        
        switch ($jvoc){
        case 0: //makan
        ///
        $data=$this->makanPesan($jvoc,$id_user);
        ///
        break;
        case 1: ///parsel
        $data['id_voc']= $id_voc=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
        break;
        case 2: ///rmd
        ///
        $data=$this->rmdPesan($jvoc,$id_user);
        ///
        break;
        case 3: //mahasiswa
        ///
        $data=$this->vMhsPesan($jvoc,$id_user);
        ///
        
        break;
       
        default: //GAJI13 ==4 ~
        
        $data['id_voc']=FALSE;
        $id_voc=$this->M_vparsel->get_max_id_vocall($jvoc); ///menuju edisi voucher all
        if($id_voc){
             $data=$this->vAllPesan($jvoc,$id_user);
        }
        break;
        
        
    }
        
    }
    /////////////////////////
    function voucherPesan($jvoc,$id_user){
        $gvall=$this->gvall($jvoc,$id_user);
        $id_voc=$gvall['id_voc'];
        
        switch($jvoc){
            case 0:
            $data=$this->get_pesan_voucher_mkan($id_user,$id_voc,1); ///1=terima
            break;
            case 1:
            $data=$this->get_pesan_voucher_parsel($id_user,$id_voc,1);
            break;
            case 2:
            $data=$this->get_pesan_voucher_rmd($id_user,$id_voc,1);
            break;
            case 3:
            $data=$this->get_pesan_voucher_mhs($id_user,$id_voc,1);
            break;
            default:
            $data=$this->get_pesan_voucher_vall($id_user,$id_voc,1,$jvoc);
            break;
        }
        
        return $data;
        
        
    }
    
    /////////////////////////
    function get_pesan_voucher_mkan($id,$id_voc,$pro){
		$this->db->select('*');
		$this->db->from('tbl_pesan_voucher,ueu_tbl_user');
		$this->db->where('tbl_pesan_voucher.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_pesan_voucher.id_user',$id);
		$this->db->where('tbl_pesan_voucher.id_voc',$id_voc);
        if($pro!='all'){
            $this->db->where('tbl_pesan_voucher.proses',$pro);
        }
		
		return $this->db->get();
	}
	/////////////////////////
    function get_pesan_voucher_parsel($id,$id_voc,$pro){
		$this->db->select('*');
		$this->db->from('tbl_pesan_v_parsel,ueu_tbl_user');
		$this->db->where('tbl_pesan_v_parsel.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_pesan_v_parsel.id_user',$id);
        
        $this->db->where('tbl_pesan_v_parsel.id_voc_p',$id_voc);
        if($pro!='all'){
            $this->db->where('tbl_pesan_v_parsel.proses',$pro);
        }
		
		return $this->db->get();
	}
    /////////////////////////
    function get_pesan_voucher_rmd($id,$id_voc,$pro){
		$this->db->select('*');
		$this->db->from('tbl_pesan_v_songsong,ueu_tbl_user');
		$this->db->where('tbl_pesan_v_songsong.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_pesan_v_songsong.id_user',$id);
        $this->db->where('tbl_pesan_v_songsong.id_voc_song',$id_voc);
        if($pro!='all'){
            $this->db->where('tbl_pesan_v_songsong.proses',$pro);
        }
		return $this->db->get();
	}
	/////////////////////////
    function get_pesan_voucher_mhs($id,$id_voc,$pro){
		$this->db->select('*');
		$this->db->from('tbl_pesan_v_mhs,ueu_tbl_user');
		$this->db->where('tbl_pesan_v_mhs.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_pesan_v_mhs.id_user',$id);
        
        $this->db->where('tbl_pesan_v_mhs.id_voc_mhs',$id_voc);
        if($pro!='all'){
            $this->db->where('tbl_pesan_v_mhs.proses',$pro);
        }
		return $this->db->get();
	}
	/////////////////////////
    function get_pesan_voucher_vall($id,$id_voc,$pro,$jvoc){
		$this->db->select('*');
		$this->db->from('tbl_pesan_voc_all,ueu_tbl_user');
		$this->db->where('tbl_pesan_voc_all.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_pesan_voc_all.id_user',$id);
         $this->db->where('tbl_pesan_voc_all.id_voc',$id_voc);
         $this->db->where('tbl_pesan_voc_all.j_voucher',$jvoc);
        if($pro!='all'){
            $this->db->where('tbl_pesan_voc_all.proses',$pro);
        }
		return $this->db->get();
	}
    
    ///////////////////////////////TRANSAKSI=======================================================
    
    function trans_pendapatanvoc($jvoc,$id_user,$st){
       
        switch($st){
            case 0:
            $st='ya';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;
            case 1:
            $st='dipesan';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;
            case 2:
            $st='dibayar';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;            
            case 3:
            $st='input';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;
            case 4:
            $st='expired';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;
            case 5:
            $st='batal';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;
            case 6:
            $st='Batal_ot';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;
           
            default:
            $st='ya';
            $data=$this->get_transaksi_pendapatanvoc($jvoc,$id_user,$st);
            break;
        }
        
        return $data;
        
        
    }
    
    function trans_pvoc($jvoc,$id_user,$st){
        $gvall=$this->gvall($jvoc,$id_user);
        $id_voc_s=$gvall['id_voc'];

        switch($st){
            case 0:
            $st='ya';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;
            case 1:
            $st='dipesan';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;
             case 2:
            $st='dibayar';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;            
            case 3:
            $st='input';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;
            case 4:
            $st='expired';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;
            case 5:
            $st='batal';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;
            case 6:
            $st='Batal_ot';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;
           
            default:
            $st='ya';
            $data=$this->get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st);
            break;
        }
        
        return $data;
        
        
    }
    
    function get_transaksi_voc($id_user,$id_voc_s,$jvoc,$st){
        $kolidvoc='id_voc_p';
        if($jvoc==0){
            $kolidvoc='id_voc';
        }

		$this->db->where('buy',$st);
		$this->db->where('metode','VOUCHER');
		$this->db->where('id_voc_p',$id_voc_s); ///edisi id
		$this->db->where('j_voucher',$jvoc); ///jenis voucer
		$this->db->where('id_user',$id_user);

		$a=$this->db->get('tbl_transaksi');
		
        return $a;

	}
    
    function get_transaksi_pendapatanvoc($jvoc,$id_user,$st){

		$this->db->where('buy',$st);
		$this->db->where('metode','VOUCHER');
		$this->db->where('j_voucher',$jvoc); ///jenis voucer
		$this->db->where('id_pelapak',$id_user);


		$a=$this->db->get('tbl_transaksi');
		return $a;

	}
    
    ////////////////////////////////////////////REDEEM
    
    function redeem_pvoc($jvoc,$id_user,$st){
        
        
        
        $this->db->select('*');
		$this->db->from('tbl_user_redeem,ueu_tbl_user');
		$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
		$this->db->where('tbl_user_redeem.id_user',$id_user);
		$this->db->where('tbl_user_redeem.j_voucher',$jvoc);
        if($st==0){ //redeem
        $this->db->where('tbl_user_redeem.status',$st); ///2 == ditolak
        }else{
        $this->db->where('tbl_user_redeem.status !=',2); ///2 == ditolak    
        $this->db->where('tbl_user_redeem.status !=',0); ///2 == ditolak    
        }
		
		return $this->db->get();
        
    }


    function onOffVoc($jvoc,$id_user){
        $get_setvoc=$this->Madmin_master->get_onoffvoc($id_user);     //set onoff
        $get_setvocall=$this->Madmin_master->get_onoffvoc_all($id_user);     //set onoff
        $onoff=0; //on

        ///vsong2 , vc3
        // vparsel, vc4
        // vmhs, vc5
        // v_gaji13, vc6

        switch ($jvoc){
        case 0: //makan
        ///
        $rwid='vc1';
        $rwall='vc1';
        ///
        break;
        case 1: ///parsel
        
        ///
        $rwid='vparsel';
        $rwall='vc4';
        ///
        break;
        case 2: ///rmd
        ///
        $rwid='vsong2';
        $rwall='vc3';
        ///
        break;
        case 3: //mahasiswa
        ///
        $rwid='vmhs';
        $rwall='vc5';
        ///
        
        break;
       
        default: //GAJI13 ==4 ~
        
        $rwid='v_gaji13';
        $rwall='vc6';
        break;
        
        
        }
    
        
        if($get_setvoc->num_rows() > 0){
                    if($get_setvoc->row()->$rwid == '0'){ //0=voucher off

                        $onoff=1;

                    }
                }   
        if($get_setvocall->num_rows() > 0){
        if($get_setvocall->row()->$rwall == 0 ){

            $onoff=1;

            }
        }

        return $onoff;

    }
    
public function getNameVoc($id_jvoc=0)
{
    return $this->db->query('SELECT * FROM `tbl_jenis_voc` WHERE `id_jen_voc` = '.$id_jvoc.' ORDER BY `id_jen_voc` ASC')
    ->row()->nama_jvoc;

}

	

}///class