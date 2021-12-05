
<?php
class Mmahasiswa extends CI_Model {

	var $table = 'ueu_tbl_user';
	
	function __construct()
	{
		parent::__construct();
	}
	
    function kosongkan_expired_voc2($d,$id_user){

        $this->db->where('id_user',$id_user);
        $this->db->where('metode','VOUCHER');

        $this->db->where('buy','DIPESAN');

        $this->db->update('tbl_transaksi',$d);

    }

    function kosongkan_user_sal_voc2($d,$idjob){

       // $this->db->where('voucher_umy !=','0');

        //$this->db->where('voucher_dibelanjakan !=','0');
        
        $this->db->where('job',$idjob);
        
        $this->db->update('ueu_tbl_user',$d);

    }
    
    function get_user_job($idjob){

        
        $this->db->where('job',$idjob);
        $this->db->where('status !=',0);
        
        return $this->db->get('ueu_tbl_user');

    }

    function get_akunprodi($kdprodi){
        $this->db->where('kode_prodi',$kdprodi);
        $this->db->where('wewenang !=','admin');
        $this->db->where('status' ,1);
        $this->db->where('job',3);
        return $this->db->get('ueu_tbl_user');
    }
    
    
	
	
}