<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_vparsel extends CI_Model {

	var $table = 'ueu_tbl_user';
	function __construct(){



		parent::__construct();



	}
    
    function get_max_id_vocall($j_voucher){
		$this->db->select_max('id_voc');
		$this->db->where('j_voucher',$j_voucher);
		return $this->db->get('tbl_evoc_all')->row()->id_voc;
	}
    
    function get_max_id_v_parsel(){
		$this->db->select_max('id_voc_p');
		return $this->db->get('tbl_e_parsel')->row()->id_voc_p;
	}
    function get_max_id_v_songsong(){
		$this->db->select_max('id_voc_song');
		return $this->db->get('tbl_e_songsong')->row()->id_voc_song;
	}
    function get_max_id_v_id_voc_mhs(){
		$this->db->select_max('id_voc_mhs');
		return $this->db->get('tbl_e_mhs')->row()->id_voc_mhs;
	}
    
    
    function get_pesan_voc_parsel_id($id_user,$id_voc){
        $this->db->where('id_user',$id_user);
        $this->db->where('id_voc_p',$id_voc);
        return $this->db->get('tbl_pesan_v_parsel');
    }
    
    function get_pesan_voc_mhs_id($id_user,$id_voc){
        $this->db->where('id_user',$id_user);
        $this->db->where('id_voc_mhs',$id_voc);
        return $this->db->get('tbl_pesan_v_mhs');
    }
    function get_pesan_voc_song_id($id_user,$id_voc){
        $this->db->where('id_user',$id_user);
        $this->db->where('id_voc_song',$id_voc);
        return $this->db->get('tbl_pesan_v_songsong');
    }
    
   
    function get_pesan_voc_song2_id($id_user,$id_voc,$pro=1){
        $this->db->where('id_user',$id_user);
        $this->db->where('proses',$pro);
        $this->db->where('id_voc_song',$id_voc);
        return $this->db->get('tbl_pesan_v_songsong');
    }
    
    function get_saldo_voc_parsel_iduser($id_user,$id_voc,$pro=1){
        //$this->db->select('saldo_awal');
        $this->db->where('id_user',$id_user);
        $this->db->where('proses',$pro);
        $this->db->where('id_voc_p',$id_voc);

        return $this->db->get('tbl_pesan_v_parsel');
    }
    
    function get_saldo_voc_mhs_iduser($id_user,$id_voc,$pro=1){
        //$this->db->select('saldo_awal');
        $this->db->where('id_user',$id_user);
        $this->db->where('proses',$pro);
        $this->db->where('id_voc_mhs',$id_voc);

        return $this->db->get('tbl_pesan_v_mhs');
    }

    function get_saldo_voc_makan_iduser($id_user,$id_voc,$pro=1){ ///1=acc
        $this->db->where('id_user',$id_user);
        $this->db->where('proses',$pro);
        $this->db->where('id_voc',$id_voc); ///pembeda


        return $this->db->get('tbl_pesan_voucher');



    }
    
    function insert_pesan_vparsel($d){

        $this->db->insert('tbl_pesan_v_parsel',$d);
	}
    function insert_pesan_vsong2($d){

        $this->db->insert('tbl_pesan_v_songsong',$d);

	}
    function insert_pesan_vmhs($d){

        $this->db->insert('tbl_pesan_v_mhs',$d);

	}
    function insert_pesan_vmakan($d){

        $this->db->insert('tbl_pesan_voucher',$d);

	}
    
    function get_total_tbltransaksi_vparsel($id_user,$id_voc_s,$jvoc=1){

		$this->db->where('buy','dibayar');
		//$this->db->where('buy','dipesan');
		$this->db->where('metode','VOUCHER');
		$this->db->where('id_voc_p',$id_voc_s); ///edisi id
		$this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_user',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}

	function get_total_tbltransaksi_vmakan($id_user,$id_voc_s,$jvoc=0){

		$this->db->where('buy','dibayar');
		//$this->db->where('buy','dipesan');
		$this->db->where('metode','VOUCHER');
		$this->db->where('id_voc',$id_voc_s); ///edisi id versi pertama pake ini
		$this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_user',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}
    
    
    
    function get_total_tbltransaksi_vparsel_pesan($id_user,$id_voc_s,$jvoc=1,$buy='dipesan'){

		$this->db->where('buy',$buy);
		$this->db->where('metode','VOUCHER');
		$this->db->where('id_voc_p',$id_voc_s); ///edisi id varsel
        $this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_user',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}
    
    function get_total_tbltransaksi_vparsel_expired($id_user,$id_voc_s,$jvoc=1){ ///parsel dan song2

		$this->db->where('buy','expired');
		$this->db->where('metode','VOUCHER');
		$this->db->where('id_voc_p',$id_voc_s); ///edisi id varsel
        $this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_user',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}

	function get_total_tbltransaksi_vmakan_pesan($id_user,$id_voc_s,$jvoc=0,$buy='dipesan'){

		$this->db->where('buy',$buy);
		$this->db->where('metode','VOUCHER');
		$this->db->where('id_voc',$id_voc_s); ///edisi id varsel
        $this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_user',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}
    
    function get_total_tbltransaksi_vmakan_expired($id_user,$id_voc_s,$jvoc=0){

		$this->db->where('buy','expired');
		$this->db->where('metode','VOUCHER');
		$this->db->where('id_voc',$id_voc_s); ///edisi id varsel
        $this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_user',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}
    
    function get_total_tbltransaksi_vparsel_didapat($id_user,$id_voc_s,$jvoc=1){

		$this->db->where('buy','dibayar');
		$this->db->where('metode','VOUCHER');
		//$this->db->where('id_voc_p',$id_voc_s); ///edisi id
		$this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_pelapak',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}

	 function get_total_tbltransaksi_vmakan_didapat($id_user,$id_voc_s,$jvoc=0){

		$this->db->where('buy','dibayar');
		$this->db->where('metode','VOUCHER');
		//$this->db->where('id_voc',$id_voc_s); ///edisi id
		$this->db->where('j_voucher',$jvoc); ///jenis voucer

		$this->db->where('id_pelapak',$id_user);


		$a=$this->db->get('tbl_transaksi');
		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}
    
    function get_jenis_voc(){
		//$this->db->select('id_jen_voc,nama_jvoc');
		$this->db->from('tbl_jenis_voc');
		return $this->db->get();
	}
    
    function get_jenis_voc_id($id){
		$this->db->where('id_jen_voc',$id);
		$this->db->from('tbl_jenis_voc');
		return $this->db->get();
	}
    
    function get_Pesan_voucher_parsel($job,$id_voc_s){

        $this->db->from('tbl_pesan_v_parsel,ueu_tbl_user');
        $this->db->where('tbl_pesan_v_parsel.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);

        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('tbl_pesan_v_parsel.id_voc_p',$id_voc_s);
        $this->db->where('tbl_pesan_v_parsel.proses',0);
        return $this->db->get();

    }
    function get_Pesan_voucher_songsong($job,$id_voc_s){

        $this->db->from('tbl_pesan_v_songsong,ueu_tbl_user');
        $this->db->where('tbl_pesan_v_songsong.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);

        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('tbl_pesan_v_songsong.id_voc_song',$id_voc_s);
        $this->db->where('tbl_pesan_v_songsong.proses',0);
        return $this->db->get();

    }
    
    function get_Pesan_voucher_mhs($job=3,$id_voc_s,$pro=0){

        $this->db->from('tbl_pesan_v_mhs,ueu_tbl_user');
        $this->db->where('tbl_pesan_v_mhs.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);

        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('tbl_pesan_v_mhs.id_voc_mhs',$id_voc_s);
        $this->db->where('tbl_pesan_v_mhs.proses',$pro);
        return $this->db->get();

    }
    function get_Pesan_voucher_mhs_prodi($job=3,$id_voc_s,$pro=0,$kode_prodi){

        $this->db->from('tbl_pesan_v_mhs,ueu_tbl_user');
        $this->db->where('tbl_pesan_v_mhs.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);
        
        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->like('ueu_tbl_user.kode_prodi',$kode_prodi);
        $this->db->where('tbl_pesan_v_mhs.id_voc_mhs',$id_voc_s);
        $this->db->where('tbl_pesan_v_mhs.proses',$pro);
        return $this->db->get();

    }
    
    function get_pemesan_voc_parsel_all($id_voc_s){

	
	    $this->db->from('tbl_pesan_v_parsel,ueu_tbl_user');
        $this->db->where('tbl_pesan_v_parsel.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);
        $this->db->where('tbl_pesan_v_parsel.id_voc_p',$id_voc_s);
        $this->db->where('tbl_pesan_v_parsel.proses',0);
        return $this->db->get();

	}
    function get_pemesan_voc_makan_all($id_voc_s){

	
	    $this->db->from('tbl_pesan_voucher,ueu_tbl_user');
        $this->db->where('tbl_pesan_voucher.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);
        $this->db->where('ueu_tbl_user.job !=',3);
        $this->db->where('tbl_pesan_voucher.id_voc',$id_voc_s);
        $this->db->where('tbl_pesan_voucher.proses',0);
        return $this->db->get();

	}
    
    function get_pemesan_voc_makan_all_mhs($id_voc_s){

	
	    $this->db->from('tbl_pesan_v_mhs,ueu_tbl_user');
        $this->db->where('tbl_pesan_v_mhs.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);
        $this->db->where('ueu_tbl_user.job',3);
        $this->db->where('tbl_pesan_v_mhs.id_voc_mhs',$id_voc_s);
        $this->db->where('tbl_pesan_v_mhs.proses',0);
        return $this->db->get();

	}
    function get_pemesan_voc_song_all($id_voc_s){

	
	    $this->db->from('tbl_pesan_v_songsong,ueu_tbl_user');
        $this->db->where('tbl_pesan_v_songsong.id_user = ueu_tbl_user.idlog');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);
        $this->db->where('tbl_pesan_v_songsong.id_voc_song',$id_voc_s);
        $this->db->where('tbl_pesan_v_songsong.proses',0);
        return $this->db->get();

	}
    
    function simpan_up_voucher_par($d,$id){
        $this->db->where('id',$id);
        $this->db->update('tbl_pesan_v_parsel',$d);
    }
    
    function simpan_up_voucher_song($d,$id){
        $this->db->where('id',$id);
        $this->db->update('tbl_pesan_v_songsong',$d);
    }
    function simpan_up_voucher_mhs($d,$id){
        $this->db->where('id',$id);
        $this->db->update('tbl_pesan_v_mhs',$d);
    }
    
    function get_penerima_voc_song($s,$voc){


		$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		$this->db->where('id_voc_song' ,$voc);
		
		return $this->db->get('tbl_pesan_v_songsong');

	}
    
    function get_penerima_voc_par($s,$voc){


		$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		$this->db->where('id_voc_p' ,$voc);

		return $this->db->get('tbl_pesan_v_parsel');

	}
    
    function save_sissaldo_voc($d){
        $this->db->insert('tbl_saldo_sisa_voc',$d);
    }
    
    function get_sisa_voc($id_user,$id_voc_s,$jvoc){
        
        $this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,1);

		$this->db->where('id_user' ,$id_user);
		$this->db->where('id_voc' ,$id_voc_s);
		$this->db->where('j_voucher' ,$jvoc);
		
		return $this->db->get('tbl_saldo_sisa_voc');
        
    }
    
    ///////////////////////////
    
    function get_Pesan_voc_xls($id_pes,$id_user,$jvoc){
        $this->db->order_by('idsetvoc' ,'DESC');
		$this->db->where('proses' ,1);
		$this->db->where('id_user' ,$id_user);
		$this->db->where('id_p_voc' ,$id_pes);
		$this->db->like('jvoc' ,$jvoc);
		
		return $this->db->get('tbl_pesvoc_xls');
    }
    
    function mhs_aktif_($nim){
		$this->db->where('nim' ,$nim);
		return $this->db->get('tbl_mhs_aktif_xls');
    }
    function mhs_aktif_deletall(){
		$this->db->truncate('tbl_mhs_aktif_xls');
    }
    
    function get_Pvoc_mhs_ex($job=3,$id_voc_s,$pro=0){

        $this->db->from('tbl_pesan_v_mhs,ueu_tbl_user,tbl_mhs_aktif_xls');
        $this->db->where('tbl_pesan_v_mhs.id_user = ueu_tbl_user.idlog');
        $this->db->where('ueu_tbl_user.ni = tbl_mhs_aktif_xls.nim');
        //$this->db->where('ueu_tbl_user.idlog',$id_user);

        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('tbl_mhs_aktif_xls.proses',1); //1=aktiff
        $this->db->where('tbl_pesan_v_mhs.id_voc_mhs',$id_voc_s);
        $this->db->where('tbl_pesan_v_mhs.proses',$pro);
        return $this->db->get();

    }
    
    function get_mhs_ex_aktif($job=3,$id_voc_s,$pro=0){

        //$this->db->from('ueu_tbl_user,tbl_mhs_aktif_xls');
       /* $this->db->where('tbl_mhs_aktif_xls.nim = ueu_tbl_user.ni');
        $this->db->where('ueu_tbl_user.job',$job);
        $this->db->where('ueu_tbl_user.status',1);
        //*/
        return $this->db->get('tbl_mhs_aktif_xls');

    } ///get_mhs_ex_aktif_pag

    function get_mhs_ex_aktif_pag($job=3,$id_voc_s,$pro=0){

        $this->db->group_by('nim');
        $this->db->where('nim >',0);
        return $this->db->get('tbl_mhs_aktif_xls');
        // return $this->db->get('tbl_mhs_aktif_xls',$lim,$off);

    }
    
    function ceknimmhsaktif($ni){

        $this->db->from('ueu_tbl_user,tbl_mhs_aktif_xls');
        $this->db->where('tbl_mhs_aktif_xls.nim = ueu_tbl_user.ni');
        $this->db->where('tbl_mhs_aktif_xls.nim',$ni);
        $this->db->where('ueu_tbl_user.status',1);
        return $this->db->get();

    }
    
    function get_nim_akun($ni){
		//$id_user = $this->session->userdata('id_user');
		$this->db->select('ni,nim,status,idlog,id_user');
		$this->db->from('ueu_tbl_user,tbl_mhs_aktif_xls,tbl_pesan_v_mhs');
        $this->db->where('tbl_mhs_aktif_xls.nim = ueu_tbl_user.ni');
        $this->db->where('tbl_pesan_v_mhs.id_user = ueu_tbl_user.idlog');
        $this->db->where('tbl_mhs_aktif_xls.nim',$ni);
        $this->db->where('ueu_tbl_user.status',1);
		return $this->db->get();
	}

	//REV 201903
	function get_email_by_nim($nim)
	{	
		$this->db->select('ni,nim,status,idlog,username,kode_prodi');
		$this->db->from('ueu_tbl_user, tbl_mhs_aktif_xls');
		$this->db->where('ueu_tbl_user.ni = tbl_mhs_aktif_xls.nim');
		$this->db->where('status',1);
		$this->db->where('ueu_tbl_user.ni',$nim);
		$q = $this->db->get();
		$d=[
			'code'=>0,
			'nama'=>"",
			'prodi'=>"",
			'id_user'=>"",
		];
		if($q->num_rows()>0)
		{
			$gjob=$this->M_setapp->get_tbl_per_prodi_ok($q->row()->kode_prodi);
			$kdprodi='-';
			if($gjob->num_rows() > 0){
				$kdprodi=$gjob->row()->nama_prodi;
			}
			$d=[
			'code'=>1,
			'nama'=>$q->row()->username,
			'id_user'=>$q->row()->idlog,
			'prodi'=>$kdprodi,
			];
		}

		return $d;
	}

	function cek_ambilVoucher($nim){
		$a=$this->get_email_by_nim($nim);
		$d=[
			'code'=>0,
			'warna'=>"",
			'status'=>"BELUM DAFTAR",
		];
		if ($a['code']==1) {
			$cek_diterima=$this->M_adminvoc->get_vou_pesan_perakun($a['id_user'],3);// MAHASISWA 

			if ($cek_diterima->num_rows() > 0) {
				# code...
				$d=[
					'code'=>1,
					'warna'=>"#34d926",
					'status'=>"DITERIMA",
				];

			}else{

				$d=[
					'code'=>2,
					'warna'=>"#5969fb",
					'status'=>"TERDAFTAR",
				];

			}

		}

		return $d;
		
	}

	///REV210903

	function get_total_tbltransaksi_proses($id_user,$id_voc_s,$jvoc=0,$buy='dipesan'){

		$this->db->where('buy',$buy);
		$this->db->where('metode','VOUCHER');
        $this->db->where('j_voucher',$jvoc); ///jenis voucer
		$this->db->where('id_user',$id_user);
		$a=$this->db->get('tbl_transaksi');

		if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

	}


    
     
	
}