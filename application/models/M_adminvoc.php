<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_adminvoc extends CI_Model {

	

	public function __construct()
	{
		parent::__construct();
		
	}
    
    function get_peg_ex_aktif($jvoc){

        //$this->db->from('ueu_tbl_user,tbl_mhs_aktif_xls');
       /* $this->db->where('tbl_mhs_aktif_xls.nim = ueu_tbl_user.ni');
        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('ueu_tbl_user.status',1);
        $this->db->where('j_voc	',$jvoc);
        //*/
        $this->db->where('j_voc',$jvoc);

        return $this->db->get('tbl_peg_xls');

    }

    function get_peg_ex_aktif_pag($jvoc,$lim,$offl){

        //$this->db->from('ueu_tbl_user,tbl_mhs_aktif_xls');
       /* $this->db->where('tbl_mhs_aktif_xls.nim = ueu_tbl_user.ni');
        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('ueu_tbl_user.status',1);
        $this->db->where('j_voc ',$jvoc);
        //*/
        $this->db->where('j_voc',$jvoc);
        $this->db->order_by('noid');
        return $this->db->get('tbl_peg_xls',$lim,$offl);

    }

    
    function get_jvoc($jvoc){
    $this->db->where('id_jen_voc',$jvoc);
    return $this->db->get('tbl_jenis_voc');
        
    }
    
    function cekniaktif($ni,$jvoc){

        $this->db->from('ueu_tbl_user,tbl_peg_xls');
        $this->db->where('tbl_peg_xls.ni = ueu_tbl_user.ni');
        $this->db->where('tbl_peg_xls.ni',$ni);
        $this->db->where('tbl_peg_xls.j_voc',$jvoc);
        $this->db->where('ueu_tbl_user.status',1);
        return $this->db->get();

    }
    
     function get_vou_pesan($id_user,$jvoc){
		
		$id_v=$this->M_gvocall->gvall($jvoc,$id_user);
		$id_voc=$id_v['id_voc'];
		
        switch ($jvoc){
        case 0:
        
        $cetak=$this->Madmin_master->get_pemesan_vo('1',$id_voc);
        
        break;
        case 2:
        
        $cetak=$this->M_vparsel->get_penerima_voc_song('1',$id_voc);
        break;
        case 1:
        
        $cetak=$this->M_vparsel->get_penerima_voc_par('1',$id_voc);
        break;
        case 3:
        
        $cetak=$this->M_vparsel->get_Pesan_voucher_mhs(3,$id_voc,1);
        break;
        
        default:
        $cetak=$this->M_dompetall->get_pemesan_vocall_peredisi($id_voc,$jvoc,1);    // all songsog
        break;
        
        
    }
    
    return($cetak);

    }


    function get_vou_pesan_perakun($id_user,$jvoc){
        
        $id_v=$this->M_gvocall->gvall($jvoc,$id_user);
        $id_voc=$id_v['id_voc'];
        
        switch ($jvoc){
        case 0:
        
        $gpv=$this->M_vparsel->get_saldo_voc_makan_iduser($id_user,$id_voc,1); ///get saldo awal || 1=prsoes 
        
        break;
        case 2:
        $gpv=$this->M_vparsel->get_pesan_voc_song2_id($id_user,$id_voc,1);   ///ysng proses ==1 
        
        break;
        case 1:
        
        $gpv=$this->M_vparsel->get_saldo_voc_parsel_iduser($id_user,$id_voc,1);
        break;
        case 3:
        
        $gpv=$this->M_vparsel->get_saldo_voc_mhs_iduser($id_user,$id_voc,1);
        break;
        
        default:
        $gpv=$this->M_dompetall->get_pesan_voc_all_iduser($id_user,$id_voc,$jvoc,1); 
        break;
        
        
    }
    
    return($gpv);

    }

    function save_tbl_saldovoc($id_tasal,$jvoc,$id_voc,$id_user,$saldo=0){
        $d=[
            'id_tasal'=>$id_tasal,
            'saldo_terima'=>$saldo,
            'jvoc'=>$jvoc,
            'id_voc'=>$id_voc,
            'id_user'=>$id_user,
            'proses '=>0, //=0=> baru input belum bisa di belanjkan
            'durasi'=>$this->M_time->tgl_ymd(),
            'tgl_t'=>$this->M_time->harinow(),

        ];

        $this->db->insert('tbl_saldovoc',$d);
    }

    function cek_tbl_saldovoc($sta,$jvoc,$id_voc,$id_user){

        $d=[
            
            'jvoc'=>$jvoc,
            'id_voc'=>$id_voc,
            'id_user'=>$id_user,
            'proses '=>$sta, //1=ok
            

        ];

        $this->db->where($d);

     return $this->db->get('tbl_saldovoc');   
    }

    function hitpenermavoc_peg($jvoc){
        if($jvoc==3){

            $a=$this->M_vparsel->get_mhs_ex_aktif(3,3);
            $ni='nim';

        }else{

            $a=$this->get_peg_ex_aktif($jvoc);
            $ni='ni';

        }
        
            $tbdaf=0;
            $tsdaf=0;
            $smen=0;
        if($a->num_rows() > 0){
            
        foreach($a->result() as $gidp){ 

            $getnama=$this->M_vparsel->get_nim_akun($gidp->$ni);
                if($getnama->num_rows() > 0){

                /////CEK SUDAH NGAMBIL BELUM
                $cek_diterima=$this->M_adminvoc->get_vou_pesan_perakun($getnama->row()->idlog,$jvoc);     
                $sb ='TERDAFTAR';    
                
                if($cek_diterima->num_rows() > 0){
                  $sb ='DITERIMA';    
                  $smen=$smen+1;
                }else{
                  $tsdaf=$tsdaf+1;
                }
                }else{
                $sb= 'BELUM DAFTAR';
                $tbdaf=$tbdaf+1;
                }
            

        }

        }

        return [ 
            'num'=>$a->num_rows(),
            'terdaftar'=>$tsdaf,
            'menerima'=>$smen,
            'belumDaftar'=>$tbdaf,

        ];

    }



	

}