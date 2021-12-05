<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_getsaldo extends CI_Model {

function __construct()
	{
		parent::__construct();
        $this->load->model('M_gvocall');

	}

function getSaldo($iduser,$id_voc,$j_voc){
	 
        $gettotal_parsel = 
        $this->M_vparsel->get_total_tbltransaksi_vmakan($iduser,$id_voc,$j_voc); //tbltransaksi|| 0=makan        
        $gettotal_parsel_pesan = 
        $this->M_vparsel->get_total_tbltransaksi_vmakan_expired($iduser,$id_voc,$j_voc); //tbltransaksi yang sudah expired

        ////get saldo tbl semua voucher
        $gVAll=$this->get_saldoVocAll($iduser,$j_voc,$id_voc);

        switch ($j_voc){
        case 0: //makan
        ///
        $gVAll=$this->get_saldoVocMkn($iduser,$j_voc,$id_voc);
        //
        $gpv=$this->M_vparsel->get_saldo_voc_makan_iduser($iduser,$id_voc,1); ///VMKN || 1=prsoes acc
        ///
        break;
        case 1: ///parsel
        
        ///
        $gpv=$this->M_vparsel->get_saldo_voc_parsel_iduser($iduser,$id_voc); ///VPSL
        ///
        break;
        case 2: ///rmd
        ///
        $gVAll=$this->get_saldoVocRmd($iduser,$j_voc,$id_voc);
        ///
        $gpv=$this->M_vparsel->get_pesan_voc_song2_id($iduser,$id_voc);    ///tabel bedabeda /VRMD
        ///
        break;
        case 3: //mahasiswa
        ///
        $gVAll=$this->get_saldoVocMhs($iduser,$j_voc,$id_voc);
        ///
         $gpv=$this->M_vparsel->get_saldo_voc_mhs_iduser($iduser,$id_voc); ///VMHS
        ///
        
        break;
       
        default: //GAJI13 ==4 ~        
        $gpv=$this->M_dompetall->get_pesan_voc_all_iduser($iduser,$id_voc,$j_voc,1); //VALL/VG13
        break;

    }
       
        $hparsel=0;       
        $durasi=0;   //HARI

        ////VERSI201811


        
        if($gVAll->num_rows() > 0){

            foreach ($gVAll->result() as $key) {
                $hparsel=$hparsel+$key->saldo_awal;
                $durasi=$key->durasi;
            }



        }else{

            ////MSA TRANSISI
           /* if($gpv->num_rows() > 0){
            ///pengulangan jika tumbol reset aktif
                foreach ($gpv->result() as $key) {
                $hparsel=$hparsel+$key->saldo_awal;

                }
                
            }
            //*/

        }




            
        
        $d=[

        	'saldoDompet'=>$hparsel,
        	'saldoDiBelanjakan'=>$gpv->num_rows(),
        	'saldoTerpakai'=>$gettotal_parsel,
        	'saldoRedeem'=>0,
            'durasi'=>$durasi,
        	//resetvoucher
        	'saldoSisa'=>$hparsel-$gettotal_parsel,

        ];

        return($d);

	}

    function get_jenisVoc_id($idjov){

        $this->db->from('tbl_jenis_voc');
        $this->db->where('id_jen_voc',$idjov);
        
        return $this->db->get();
        
    }

    function get_saldoVoc($id_user,$jvoc,$id_voc){

        $this->db->from('tbl_saldovoc');

        $w_d=[

            'id_user'=>$id_user,
            'jvoc'=>$jvoc,
            'id_voc'=>$id_voc

        ];
        $this->db->where($w_d);
        
        return $this->db->get();

    }

    function get_saldoVocAll($id_user,$jvoc,$id_voc){

        $this->db->from('tbl_saldovoc,tbl_pesan_voc_all');
        $this->db->where('tbl_pesan_voc_all.idpvoc = tbl_saldovoc.id_tasal');

        $w_d=[
            'tbl_saldovoc.proses'=>0,
            'tbl_saldovoc.id_user'=>$id_user,
            'tbl_saldovoc.jvoc'=>$jvoc,
            'tbl_saldovoc.id_voc'=>$id_voc

        ];
        $this->db->where($w_d);
        
        return $this->db->get();

    }

    function get_saldoVocMkn($id_user,$jvoc,$id_voc){

        $this->db->from('tbl_saldovoc,tbl_pesan_voucher');
        $this->db->where('tbl_pesan_voucher.id = tbl_saldovoc.id_tasal');
        $w_d=[

            'tbl_saldovoc.id_user'=>$id_user,
            'tbl_saldovoc.jvoc'=>$jvoc,
            'tbl_saldovoc.id_voc'=>$id_voc, 
            //
            'tbl_saldovoc.proses'=>0,

        ];
        $this->db->where($w_d);
        
        return $this->db->get();

    }

    function get_saldoVocRmd($id_user,$jvoc,$id_voc){

        $this->db->from('tbl_saldovoc,tbl_pesan_v_songsong');
        $this->db->where('tbl_pesan_v_songsong.id = tbl_saldovoc.id_tasal');

        $w_d=[

            'tbl_saldovoc.id_user'=>$id_user,
            'tbl_saldovoc.jvoc'=>$jvoc,
            'tbl_saldovoc.id_voc'=>$id_voc,
            'tbl_saldovoc.proses'=>0,

        ];
        $this->db->where($w_d);
        
        return $this->db->get();

    }

    function get_saldoVocMhs($id_user,$jvoc,$id_voc){

        $this->db->from('tbl_saldovoc,tbl_pesan_v_mhs');
        $this->db->where('tbl_pesan_v_mhs.id = tbl_saldovoc.id_tasal');

        $w_d=[

            'tbl_saldovoc.proses'=>0,
            'tbl_saldovoc.id_user'=>$id_user,
            'tbl_saldovoc.jvoc'=>$jvoc,
            'tbl_saldovoc.id_voc'=>$id_voc

        ];
        $this->db->where($w_d);
        
        return $this->db->get();

    }

}