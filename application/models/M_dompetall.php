<?php



class M_dompetall extends CI_Model {



	function __construct()

	{

		parent::__construct();

	}
	
	
    
    function g_jvoucher_per($idjov){

		$this->db->from('tbl_jenis_voc');
        $this->db->where('id_jen_voc',$idjov);
		
		return $this->db->get();

	}

    

   
    
    function get_pesan_voc_all_iduser($id_user,$id_voc,$j_voucher,$pro=1){
        $this->db->where('id_user',$id_user);
        $this->db->where('id_voc',$id_voc);
        $this->db->where('j_voucher',$j_voucher);
        $this->db->where('proses',$pro);
        return $this->db->get('tbl_pesan_voc_all');
    }
    function get_pesan_voc_cekall_iduser_($id_user,$id_voc,$j_voucher){
        $this->db->where('id_user',$id_user);
        $this->db->where('id_voc',$id_voc);
        $this->db->where('j_voucher',$j_voucher);
        return $this->db->get('tbl_pesan_voc_all');
    }
	
    function insert_pesan_vall($d){

        $this->db->insert('tbl_pesan_voc_all',$d);
	}
    
     function get_stjob_id($id){
        $this->db->where('id_job',$id);
        return $this->db->get('tbl_st_job')->row();
    }
    
     function get_Pesan_voucher_all($job,$id_voc_s,$jvoc,$pro=0){

        $this->db->from('tbl_pesan_voc_all,ueu_tbl_user');
        $this->db->where('tbl_pesan_voc_all.id_user = ueu_tbl_user.idlog');
        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('tbl_pesan_voc_all.id_voc',$id_voc_s);
        $this->db->where('tbl_pesan_voc_all.j_voucher',$jvoc);
        $this->db->where('tbl_pesan_voc_all.proses',$pro);
        return $this->db->get();

    }
    
    function get_pemesan_vocall_peredisi($id_voc_s,$jvoc,$pro=0){

	
	    $this->db->from('tbl_pesan_voc_all,ueu_tbl_user');
        $this->db->where('tbl_pesan_voc_all.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);
        $this->db->where('tbl_pesan_voc_all.id_voc',$id_voc_s);
        $this->db->where('tbl_pesan_voc_all.j_voucher',$jvoc);
        $this->db->where('tbl_pesan_voc_all.proses',$pro);
        return $this->db->get();

	}
    
    function s_up_voucherall($d,$id){
        $this->db->where('idpvoc',$id);
        $this->db->update('tbl_pesan_voc_all',$d);
    }
    
    function del_pesan_v_all($id){
        $this->db->where('idpvoc ', $id);
        $this->db->delete('tbl_pesan_voc_all');
		
	}
    
    function get_saldo_vocall_iduser($id_user,$id_voc,$pro=1){
        //$this->db->select('saldo_awal');
        $this->db->where('id_user',$id_user);
        $this->db->where('proses',$pro);
        $this->db->where('id_voc',$id_voc);

        return $this->db->get('tbl_pesan_voc_all');
    }
    public function getAksesFas($d)
    {
            $this->db->where('id_user',$d['id_user']);
            $this->db->where('fasilitas',$d['fasilitas']);
            return $this->db->get('tbl_set_akses',$d);    
    }
    public function getAksesFasAkun($d)
    {
            $this->db->where('id_user',$d['id_user']);
            return $this->db->get('tbl_durasidompet');    
            
    }
   
    function saveAksesFasilitas($d){
        $fas=$this->getAksesFas($d);
          if($fas->num_rows()>0){    
            $this->db->where('id_user',$d['id_user']);
            $this->db->where('fasilitas',$d['fasilitas']);
            $this->db->update('tbl_set_akses',$d);    
          }else{
            $this->db->insert('tbl_set_akses',$d);
          }
        
    }
    //setfasPerAkun
    function saveAksesFasilitasAkun($d){
        $fasCek=$this->getAksesFasAkun($d);
       
        $fas='fasRedeem';
        if ($d['fasilitas']==1) {
            $fas='status';
        }
       

        if($fasCek->num_rows()>0){    
            $dUp=[
                $fas=>$d['status'],
                'tgl_t'=>$d['tgl'],
            ];
            $this->db->where('id_user',$d['id_user']);
            $this->db->update('tbl_durasidompet',$dUp);    
        }else{
            $dIn=[
                $fas=>$d['status'],
                'tgl_t'=>$d['tgl'],
                'id_user'=>$d['id_user'],
            ];
            $this->db->insert('tbl_durasidompet',$dIn);
        }
        
    }

    public function pemesanVouEdisi($id_voc,$jvoc,$pro=0,$job=1,$pjvo,$prodi=0) //
    {   
        switch ($pjvo) {
            case 1:
                    $this->db->where('tbl_pesan_voucher.id_user = ueu_tbl_user.idlog');
                    $this->db->from('tbl_pesan_voucher,ueu_tbl_user');
                    $this->db->select('idlog,id_user,id_voc,job,
                    tbl_pesan_voucher.proses,nik,unit,tanggal_p,waktu,tanggal_acc,saldo_awal');
                    $this->db->where('proses',$pro);
                    $this->db->where('id_voc',$id_voc);
                break;
            case 2:
                    $this->db->where('tbl_pesan_v_songsong.id_user = ueu_tbl_user.idlog');
                    $this->db->from('tbl_pesan_v_songsong,ueu_tbl_user');
                    $this->db->select('idlog,id_user,id_voc_song,job,
                    tbl_pesan_v_songsong.proses,nik,unit,tanggal_p,waktu,tanggal_acc,saldo_awal');
                    $this->db->where('proses',$pro);
                    $this->db->where('id_voc_song',$id_voc);
                break;
            case 4:
                    $this->db->where('tbl_pesan_v_mhs.id_user = ueu_tbl_user.idlog');
                    $this->db->from('tbl_pesan_v_mhs,ueu_tbl_user');
                    $this->db->select('idlog,id_user,id_voc_mhs,job,
                    tbl_pesan_v_mhs.proses,nik,unit,tanggal_p,waktu,tanggal_acc,saldo_awal,kode_prodi');
                    $this->db->where('proses',$pro);
                    $this->db->where('ueu_tbl_user.kode_prodi',$prodi);
                    $this->db->where('id_voc_mhs',$id_voc);
                break;
            default:
                    $this->db->where('tbl_pesan_voucher.id_user = ueu_tbl_user.idlog');
                    $this->db->from('tbl_pesan_voc_all,ueu_tbl_user');
                    $this->db->select('idlog,id_user,id_voc,job,
                    tbl_pesan_voc_all.proses,nik,unit,tanggal_p,waktu,tanggal_acc,saldo_awal');
                    $this->db->where('j_voucher',$jvoc); //vall
                    $this->db->where('proses',$pro);
                    $this->db->where('id_voc',$id_voc);
                break;
        }
        
        
        
        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->order_by('nik');
        
        $a=$this->db->get();
        return $a;

    }

	

}///class