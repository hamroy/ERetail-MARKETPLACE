<?php







class M_voucher extends CI_Model {







	var $table = 'ueu_tbl_user';



	



	function __construct()



	{



		parent::__construct();



	}



	



     //// //REV 221017 VOUCHER



    function get_all_input_voc_id($id,$v)



	{   



		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id));



		



		



	}



     function cek_proses_blumacc($id,$v)



	{   



		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id,'status' => '0','bonus'=>$v));



		



		



	}



    function cek_proses_voc($id)



	{   



		$query = $this->cek_proses_blumacc($id,0);



		



		if ($query->num_rows() > 0)



		{



			return TRUE;



		}



		else



		{



			return FALSE;



		}



	}



    



    function add_oto_set_voc($d){



        $get=$this->Madmin_master->get_onoffvoc_all();    



        $d=array(



        'vc1'=>$get->row()->vc1,



        'vc3'=>$get->row()->vc3,



        'tgl'=>$get->row()->tgl,



        'vc2'=>$get->row()->vc2.'-0',



        



        );



        $this->db->insert('tbl_onoff_all_voucher',$d);



    }



     function add_oto_set_voc_perid_user($d,$id_user){



        //$get=$this->Madmin_master->get_onoffvoc_all();    



        $d=array(



        'vc2'=>$d.'-0',



        



        );



        $this->db->where('id_user',$id_user);



        $this->db->update('tbl_onoff_voucher',$d);



    }



    



    function add_edisi_set_voc($da){



        $get=$this->Madmin_master->get_onoffvoc_all();    



        $d=array(



        'edisi'=>$da+1,



        'tahap'=>0,



        'id_user'=>1,



        



        );



        $this->db->insert('tbl_input_voucher',$d);



    }



    



    function get_stjob(){

        

        $this->db->where('id_job !=',0);



        return $this->db->get('tbl_st_job');



    }



    



    /////////ILHAM 16122017



    function get_Pesan_voucher_noed($job,$id_voc_s){
        $this->db->from('tbl_pesan_voucher,ueu_tbl_user');



        $this->db->where('tbl_pesan_voucher.id_user = ueu_tbl_user.idlog');



        //$this->db->where('ueu_tbl_user.idlog',$id_user);



        $this->db->where('ueu_tbl_user.job',$job);



        $this->db->where('tbl_pesan_voucher.id_voc',$id_voc_s);



        $this->db->where('tbl_pesan_voucher.proses',0);



        



        return $this->db->get();



    }



    



    function add_edisi_bln_now($d){
        $this->db->insert('tbl_edisibln_voc',$d);
    }
    
    function add_edisi_bln_now_jvoc($d,$jvoc){
    
     if($jvoc==0){
       $this->db->insert('tbl_edisibln_voc',$d);
        }elseif($jvoc==1){
        $this->db->insert('tbl_e_parsel',$d);
        }elseif($jvoc==2){
       $this->db->insert('tbl_e_songsong',$d);
        }elseif($jvoc==3){
       $this->db->insert('tbl_e_mhs',$d);
        }elseif($jvoc==4){
       $this->db->insert('tbl_evoc_all',$d);
        }


        



    }



    



    function get_edisi_bln($id_voc){



        $this->db->where('id_voc',$id_voc);



        return $this->db->get('tbl_edisibln_voc');



    }



     function get_pesann_voc_id($id_user,$id_voc){



        $this->db->where('id_user',$id_user);



        $this->db->where('id_voc',$id_voc);



        return $this->db->get('tbl_pesan_voucher');



    }



    



    



    function get_id_user_tblpesanvoc_all($id_user,$j_voc=0){



		$this->db->select('*');

		$this->db->from('tbl_user_redeem');

		//$this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_user_redeem.id_user',$id_user);
		$this->db->where('tbl_user_redeem.j_voucher',$j_voc);

		$this->db->where('tbl_user_redeem.status !=',2); ///2 == ditolak

		return $this->db->get();

	}

    function get_id_user_tblpesanvoc_all_99($id_user){



        $this->db->select('*');

        $this->db->from('tbl_user_redeem');
        $this->db->where('tbl_user_redeem.id_user',$id_user);
        $this->db->where('tbl_user_redeem.status !=',2); ///2 == ditolak

        return $this->db->get();

    } 



    function get_id_user_tblpesanvoc_perid_voc($id_user,$id_voc){



		$this->db->where('id_voc',$id_voc);



		$this->db->where('id_user',$id_user);



		return $this->db->get('tbl_pesan_voucher');



	}



    ///////////



     function get_id_user_tblpesanvoc_perid($id_user,$id){



		$this->db->where('id',$id);



		$this->db->where('id_user',$id_user);



		return $this->db->get('tbl_user_redeem');



	}



    



     function get_max_id_voc(){



		$this->db->select_max('id_voc');



		return $this->db->get('tbl_edisibln_voc')->row()->id_voc;



	}
    
    /////////////BERANDA
    function get_pesan_voc_all_iduser_beranda($id_voc,$j_voucher,$pro=0){
        $this->db->where('id_voc',$id_voc);
        $this->db->where('j_voucher',$j_voucher);
        $this->db->where('proses',$pro);
        return $this->db->get('tbl_pesan_voc_all');
    }



    



    //=========================================PESAN VOUBCHER !! DES2-017



	function getpesan_voucher_perid_user($id_user){



        $this->db->order_by('id_voc','ACS');



		$this->db->where('proses !=',0);



		$this->db->where('proses !=',99);



		$this->db->where('id_user', $id_user);



        return $this->db->get('tbl_pesan_voucher');



		



	}

    

    public function id_last_userredeem($id){

        $this->db->where('id_user',$id);

         $this->db->select_max('id');

         return $this->db->get('tbl_user_redeem')->row()->id;

    }

    public function get_id_userredeem($id,$idre){

        $this->db->where('id_user',$id);

        $this->db->where('id',$idre);

        return $this->db->get('tbl_user_redeem');

    }



  public function up_id_userredeem($id,$idre){

        

        $d=array('cetak'=>1);

        $this->db->where('id_user',$id);

        $this->db->where('id',$idre);

        $this->db->update('tbl_user_redeem',$d);

    }


    ////RIWAYAT VOUCHER

    function riwayatVoucherAll($jvoc,$id_user='all',$sta=1,$id_voc=null){
        switch ($jvoc){
        case 0: //makan
        ///
        $a=$this->riwayatVmakan($jvoc,$id_user,$sta,$id_voc);

        ///
        break;
        case 1: ///parsel
        
        ///
        $a=$this->riwayatVparsel($jvoc,$id_user,$sta,$id_voc);
        ///
        break;
        case 2: ///rmd
        ///
        $a=$this->riwayatVrmd($jvoc,$id_user,$sta,$id_voc);
        ///
        break;
        case 3: //mahasiswa
        ///
        $a=$this->riwayatVmhs($jvoc,$id_user,$sta,$id_voc);
        ///
        
        break;
       
        default: //GAJI13 ==4 ~
        $a=$this->riwayatVall($jvoc,$id_user,$sta,$id_voc);
        break;
        
        
        
    }

    return $a;
    }


    function riwayatVmakan($jvoc,$id_user,$sta,$id_voc=null){

        $this->db->order_by('id' ,'DESC');
        
        if($id_voc!=null){
        $this->db->where('id_voc' ,$voc);    
        }
        if($sta!='all'){
        $this->db->where('proses' ,$sta);    
        }
        if($id_user!='all'){
        $this->db->where('id_user' ,$id_user);    
        }

        $a=$this->db->get('tbl_pesan_voucher');
        
        return $a;

    }

    function riwayatVparsel($jvoc,$id_user,$sta,$id_voc=null){
        $this->db->select('*');
        $this->db->select('id_voc_p as id_voc');
        $this->db->order_by('id' ,'DESC');
        if($id_voc!=null){
        $this->db->where('id_voc_p' ,$id_voc);    
        }
        if($sta!='all'){
        $this->db->where('proses' ,$sta);    
        }
        if($id_user!='all'){
        $this->db->where('id_user' ,$id_user);    
        }
        return $this->db->get('tbl_pesan_v_parsel');
    }
    function riwayatVrmd($jvoc,$id_user,$sta,$id_voc=null){
        $this->db->select('*');
        $this->db->select('id_voc_song as id_voc');

        $this->db->order_by('id' ,'DESC');
        if($id_voc!=null){
        $this->db->where('id_voc_song' ,$id_voc);    
        }
        if($sta!='all'){
        $this->db->where('proses' ,$sta);    
        }
        if($id_user!='all'){
        $this->db->where('id_user' ,$id_user);    
        }
        
        return $this->db->get('tbl_pesan_v_songsong');

    }
    function riwayatVmhs($jvoc,$id_user,$sta,$id_voc=null){
        $this->db->from('tbl_pesan_v_mhs');
        $this->db->select('*');
        $this->db->select('id_voc_mhs as id_voc'); 
        $this->db->order_by('id' ,'DESC');
        if($id_voc!=null){
        $this->db->where('id_voc_mhs' ,$id_voc);    
        }
        if($sta!='all'){
        $this->db->where('proses' ,$sta);    
        }
        if($id_user!='all'){
        $this->db->where('id_user' ,$id_user);    
        }
        return $this->db->get();   
    }
    function riwayatVall($jvoc,$id_user,$sta,$id_voc=null){
        $this->db->from('tbl_pesan_voc_all');
        $this->db->select('*');
        $this->db->select('idpvoc as id'); //idpvoc
        $this->db->where('j_voucher',$jvoc);

        $this->db->order_by('id' ,'DESC');
        if($id_voc!=null){
        $this->db->where('id_voc' ,$id_voc);    
        }
        if($sta!='all'){
        $this->db->where('proses' ,$sta);    
        }
        if($id_user!='all'){
        $this->db->where('id_user' ,$id_user);    
        }
        return $this->db->get();
    }

    //201908

    function gEdisiVoc($pvoc,$jvoc=4){
        $this->db->group_by('id_voc');
        switch ($pvoc) {
            case '1': //mkn
            $a=$this->db->get('tbl_pesan_voucher');
            break;
            case '2': //rmd
            $this->db->select('id_voc_song as id_voc');
            $a=$this->db->get('tbl_pesan_v_songsong');
            break;
            case '4': //mhs
            $this->db->select('id_voc_mhs as id_voc');
            $a=$this->db->get('tbl_pesan_v_mhs');
            break;
            
            default:
                $this->db->where('j_voucher',$jvoc);
                $a=$this->db->get('tbl_pesan_voc_all');
                break;
        }
        
        return $a;
        
    }




	



}