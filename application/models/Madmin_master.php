<?php



class Madmin_master extends CI_Model {



	var $table = 'ueu_tbl_user';

	function __construct()

	{

		parent::__construct();

	}

	

	

	

	

	function get_all_Penjual_all(){

		$this->db->where('wewenang !=','admin');

		$this->db->where('wewenang !=','bmt');

		$this->db->where('wewenang !=','keu');

		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status !=' ,3);

		$this->db->where('status !=' ,0);

		return $this->db->get('ueu_tbl_user');

	}

    

    ////TRANSAKSI PEMBELIPROSUK OLEH AKUN

    function get_trans_id_user(){

		$this->db->from('ueu_tbl_user,tbl_transaksi');

		$this->db->where('tbl_transaksi.id_user = ueu_tbl_user.idlog'); ///yang di ambil beli ..

		$this->db->where('ueu_tbl_user.status !=' ,3);

		$this->db->where('ueu_tbl_user.status !=' ,0);

		return $this->db->get();

	}

    

    ////TRANSAKSI PEMBELIPROSUK OLEH AKUN

    

    function get_all_Penjual($s){
        
        $sort2=$this->session->userdata('statp');
        if($sort2!='' and $s==1){
        $this->db->where('job' ,$sort2);    
        }
		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status' ,$s);
		///jika mhs
        // kode_prodi
        if($sort2=='3'){
        $statprodi=$this->session->userdata('statprodi');
        $this->db->where('kode_prodi', $statprodi);
        }
        
   		 //


		$this->db->where('status !=' ,3);
		$this->db->where('status !=' ,0);
        $this->db->where('wewenang !=','admin');

		return $this->db->get('ueu_tbl_user');

	}
    
    function get_all_Penjual_count($s){

		$this->db->where('wewenang !=','admin');

		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status' ,$s);

		$this->db->where('status !=' ,3);

		$this->db->where('status !=' ,0);

		return $this->db->count_all('ueu_tbl_user');

	}

	

	function get_all_Penjual_pag($s,$num,$offset){
       // $sort=1;
        $sort=$this->session->userdata('sort_a');
        $sort2=$this->session->userdata('statp');
        
        if($sort==2){
        //$this->db->order_by('job' ,'ESC');     
        if($sort2!='' and $s==1){
        $this->db->where('job' ,$sort2);    
        }
        
        }else{
        $this->db->order_by('idlog' ,'DESC');        
        }
    /////*/
        $this->db->order_by('idlog' ,'DESC');
        $this->db->where('status' ,$s);
    ///jika mhs
        // kode_prodi
        if($sort2=='3'){
        $statprodi=$this->session->userdata('statprodi');
        $this->db->where('kode_prodi', $statprodi);
        }
        
    //
        $this->db->where('wewenang !=','admin');

		$this->db->where('status !=' ,3);

		$this->db->where('status !=' ,0);

		return $this->db->get('ueu_tbl_user',$num, $offset);

	}

	

	function get_all_Penjual_pag_cari($s,$cr,$num,$offset){

		$this->db->where('wewenang !=','admin');

		$this->db->order_by('idlog' ,'DESC');

		

		//$this->db->where("nama LIKE '$cr' OR '% ".$cr." %' OR nama LIKE '% ".$cr."' OR nama LIKE '".$cr." %'");

		$this->db->like('nama' ,$cr);

		$this->db->where('status' ,$s);

		$this->db->where('status !=' ,3);

		$this->db->where('status !=' ,0);

		return $this->db->get('ueu_tbl_user',$num, $offset);

	}

    ////////AKTIFDANBLOk

	function get_all_Penjual_pag_cari_2($cr,$num,$offset){

		$this->db->where('wewenang !=','admin');
        
        $sort=$this->session->userdata('sort_a');
        $sort2=$this->session->userdata('statp');
        if($sort==2){
        $this->db->order_by('idlog' ,'DESC');    
        }else{
        $this->db->order_by('idlog' ,'DESC');        
        
        }

		

		//$this->db->where("nama LIKE '$cr' OR '% ".$cr." %' OR nama LIKE '% ".$cr."' OR nama LIKE '".$cr." %'");

		$this->db->like('nama' ,$cr);
		$this->db->or_like('nbm' ,$cr);

		///jika mhs
	        // kode_prodi
	        if($sort2=='3'){
	        $statprodi=$this->session->userdata('statprodi');
	        $this->db->where('kode_prodi', $statprodi);
	        }
        
   		 //

		$this->db->where('status !=' ,3);

		$this->db->where('status !=' ,0);

		return $this->db->get('ueu_tbl_user',$num, $offset);

	}

	////REV 14/07/17 DOMPET

	

	function get_pemesan_vo($s,$voc){

        //$voc=$this->M_voucher->get_max_id_voc();

		$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		$this->db->where('id_voc' ,$voc);

		return $this->db->get('tbl_pesan_voucher');

	}

    function get_pemesan_voc_all_list($s){

        $voc=$this->M_voucher->get_max_id_voc();

		$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		//$this->db->where('id_voc' ,$voc);

		return $this->db->get('tbl_pesan_voucher');

	}

    function get_pemesan_vo_pkdisi($s){

		$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		return $this->db->get('tbl_pesan_voucher');

	}

	

	function get_pemesan_vo_2($s){

		/*$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		return $this->db->get('tbl_input_voucher'); ///*/

		 $this->db->from('tbl_pesan_voucher,tbl_input_voucher');



		$this->db->where('tbl_pesan_voucher.id_user = tbl_input_voucher.id_user');



		$this->db->where('tbl_input_voucher.status',$s);

		//$this->db->where('tbl_input_voucher.edisi',$ed);

		$this->db->where('tbl_input_voucher.bonus',0); ///0 = tidak bonus 



		return $this->db->get();

	}

	/////REV 11/10/17

	

	function get_pemesan_vo_2_bonus($s){

		/*$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		return $this->db->get('tbl_input_voucher'); ///*/

		 $this->db->from('tbl_pesan_voucher,tbl_input_voucher');



		$this->db->where('tbl_pesan_voucher.id_user = tbl_input_voucher.id_user');



		$this->db->where('tbl_input_voucher.status',$s);

		$this->db->where('tbl_input_voucher.bonus',1);

		//$this->db->where('tbl_input_voucher.edisi',$ed);





		return $this->db->get();

	}

	function get_pemesan_vo_2_id_edisi($s,$ed){

		/*$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		return $this->db->get('tbl_input_voucher'); ///*/

		 $this->db->from('tbl_pesan_voucher,tbl_input_voucher');



		$this->db->where('tbl_pesan_voucher.id_user = tbl_input_voucher.id_user');

		$this->db->order_by('tbl_pesan_voucher.unit' ,'ASC');

		$this->db->where('tbl_input_voucher.status',$s);

		$this->db->where('tbl_input_voucher.edisi',$ed);

		$this->db->where('tbl_input_voucher.bonus',0);





		return $this->db->get();

	}



	///bonus voucher

	function get_pemesan_vo_2_id_edisi_bon_error($s,$ed){

		/*$this->db->order_by('id' ,'DESC');

		$this->db->where('proses' ,$s);

		return $this->db->get('tbl_input_voucher'); ///*/

		 $this->db->from('tbl_pesan_voucher,tbl_input_voucher');



		$this->db->where('tbl_pesan_voucher.id_user = tbl_input_voucher.id_user');

		$this->db->order_by('tbl_pesan_voucher.unit' ,'ASC');

		$this->db->where('tbl_input_voucher.status',$s);

		$this->db->where('tbl_input_voucher.edisi',$ed);

		$this->db->where('tbl_input_voucher.bonus',1);





		return $this->db->get();

	}

    

    ///bonus voucher

	function get_pemesan_vo_2_id_edisi_bon($s,$ed){

		 $this->db->from('tbl_input_voucher');

		$this->db->where('status',$s);

		$this->db->where('edisi',$ed);

		$this->db->where('bonus',1);





		return $this->db->get();

	}

	

	function get_all_sbm($s){

		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status' ,$s);

		$this->db->where('status !=' ,3);

		$this->db->where('status !=' ,0);

		return $this->db->get('tbl_peserta_sbm');

	}

	

	///simapn pemateri

	function save_pemateri($s){

		$this->db->insert('tbl_pemateri',$s);

	}

	function get_all_usernew(){

		$this->db->where('wewenang','user');

		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status' ,0);

		return $this->db->get('ueu_tbl_user');

	}

	

	///SBM

	

	function get_all_newsbm(){

		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status' ,0);

		return $this->db->get('tbl_peserta_sbm');

	}

	///get_all_usertolak

	function get_all_usertolak(){

		$this->db->where('wewenang','user');

		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status' ,3);

		return $this->db->get('ueu_tbl_user');

	}

	

	///get_all_sbmtolak

	function get_all_sbmtolak(){

		$this->db->order_by('idlog' ,'DESC');

		$this->db->where('status' ,3);

		return $this->db->get('tbl_peserta_sbm');

	}

	////////get penbeli

	function get_all_pembeli($urut,$sortir,$num,$offs,$tot='tot'){

		$this->db->from('tbl_pembeli,tbl_transaksi');
		$this->db->where('tbl_pembeli.id = tbl_transaksi.id_pembeli ');
		$this->db->where('tbl_transaksi.buy ', 'dibayar');
		
		$this->db->group_by('tbl_transaksi.id_pembeli');


		$this->db->select('tbl_transaksi.*, SUM(tbl_transaksi.qty) AS sqty , SUM(tbl_transaksi.qty*tbl_transaksi.harga_satuan) AS total_beli');
		$this->db->select('tbl_pembeli.*');

		if($sortir==1){

		$this->db->like('tbl_pembeli.email' ,'umy.ac.id');

		$this->db->where('tbl_pembeli.email !=','');

		}elseif($sortir==2){

		$this->db->where("tbl_pembeli.email NOT LIKE", "%umy.ac.id%");	

		$this->db->where('tbl_pembeli.email !=','');

		}else{

		 $this->db->where('tbl_pembeli.email !=','');

		}

		//

		if($urut==2){

		$this->db->order_by('tbl_pembeli.nama' ,'ASC');

		}elseif($urut==1){

			$this->db->order_by('sqty' ,'DESC');

		}elseif($urut==3){

			$this->db->order_by('total_beli' ,'DESC');

		}else{

			$this->db->order_by('tbl_pembeli.id' ,'DESC');	

		}

		

		//$this->db->group_by('email');
		if($tot=='tot'){

		return $this->db->get('');

		}else{
		return $this->db->get('',$num,$offs);	
		}
		

	}

	////////get penbeli

	function get_all_pembeli_old(){

		

		$this->db->where('email !=','');

		$this->db->order_by('id' ,'DESC');

		$this->db->group_by('email');

		return $this->db->get('tbl_pembeli');

	}

	////get_all_produk

	function get_all_produk_all_laris(){

		$this->db->from('tbl_produk');
		$this->db->limit('100');

        $this->db->order_by('laris' ,'DESC');

		$this->db->where('status !=' ,0);
		$this->db->where('laris !=' ,0);

		

		return $this->db->get();

	}

    ////get_all_produk cari

	function get_all_produk_cari($kat){

		$this->db->where('status !=' ,0);

		$this->db->like('nama' ,$kat);
		$this->db->or_like('id' ,$kat);

		$this->db->order_by('id' ,'DESC');

		return $this->db->get('tbl_produk');

	}

	function get_all_produk($kat){

		$this->db->where('status !=' ,0);

		$this->db->where('id_k' ,$kat);

		$this->db->order_by('id' ,'DESC');

		return $this->db->get('tbl_produk');

	}

	function get_all_produk_pag($kat,$num,$offset){

		

		$this->db->order_by('id' ,'DESC');

		$this->db->where('status !=' ,0);

		$this->db->where('id_k' ,$kat);

		return $this->db->get('tbl_produk',$num, $offset);

	}

	////get_all_produk_toalk

	

	function get_all_produk_toalk(){

		$this->db->where('status' ,3); ///3 ==di tolak

		$this->db->order_by('id' ,'DESC');

		return $this->db->get('tbl_produk');

	}

	////get_all_produk_block

	

	function get_all_produk_block(){

		$this->db->where('status' ,2); ///2 ===di block

		$this->db->order_by('id' ,'DESC');

		return $this->db->get('tbl_produk');

	}

	////get_all_produk_new

	function get_all_produk_new(){

		$this->db->where('status' ,0);

		$this->db->order_by('id' ,'DESC');

		return $this->db->get('tbl_produk');
		
	}

		////get_user_produk

	function get_user_produk($id){

		

		 $this->db->where('idlog ', $id);

		return $this->db->get('ueu_tbl_user');

	}

		////get_all_saranmasuk

	function get_all_saranmasuk($id){

		$this->db->order_by('id' ,'DESC');

		// $this->db->where('idlog ', $id);

		return $this->db->get('tbl_saran');

	}

	////get_user_produk

	function get_kategori_produk($id){

		

		 $this->db->where('id ', $id);

		return $this->db->get('tbl_kategori');

	}

		////get_user_produk

		

	function get_produk_produkid($id){

		

		$this->db->where('id ', $id);

		return $this->db->get('tbl_produk');

	}

		////get_user_produk

	

	//=========================================BLOCK

	function block_penjual_model($id,$d){

        $this->db->where('idlog ', $id);

        $this->db->update('ueu_tbl_user',$d);

		

	}

	

	//=========================================terima_bsm

	function terima_bsm($id,$d){

        $this->db->where('idlog ', $id);

        $this->db->update('tbl_peserta_sbm',$d);

		

	}

	

	//=========================================PESAN VOUBCHER

	function pesan_v($d){

        $this->db->insert('tbl_pesan_voucher',$d);

		

	}

	//=========================================PESAN VOUBCHER

	function pesan_v_t2($d){

        $this->db->insert('tbl_input_voucher',$d);

		

	}

	

	//=========================================PESAN VOUBCHER

	function updatepesanvoucher($d,$id){

		$this->db->where('id_user', $id);

        $this->db->update('tbl_pesan_voucher',$d);

		

	}

    function simpan_save_udrevtah($d,$id,$th,$therr){

		$this->db->where('id_user',$id);

		$this->db->where('tahap', $therr);

        $this->db->update('tbl_input_voucher',$d);

		

	}

	//=========================================PESAN VOUBCHER

	function get_tbl_input_voucher(){

		$this->db->where('tahap !=', 1);

        return $this->db->get('tbl_input_voucher');

		

	}

	//=========================================PESAN VOUBCHER

	function get_tbl_input_voucher_perid_user($id_user){

        $this->db->order_by('tahap','ACS');

		$this->db->where('tahap !=', 0);

		$this->db->where('status', 1);

		$this->db->where('id_user', $id_user);

        return $this->db->get('tbl_input_voucher');

		

	}

    function get_tbl_input_voucher_perid_user_no_edisi($id_user){

        $this->db->order_by('tahap','ACS');

		$this->db->where('tahap !=', 0);

		$this->db->where('status', 1);

		$this->db->where('id_user', $id_user);

        return $this->db->get('tbl_input_voucher_noedisi');

		

	}

	//=========================================PESAN VOUBCHER

	function get_tbl_input_voucher_perid_user_v($id_user,$id){

		$this->db->where('tahap !=', 1);

		$this->db->where('id_user', $id_user);

		$this->db->where('tahap', $id);

        return $this->db->get('tbl_input_voucher');

		

	}

    function get_tbl_input_voucher_perid_user_v_noedisi($id_user,$id){

		$this->db->where('tahap !=', 1);

		$this->db->where('id_user', $id_user);

		$this->db->where('tahap', $id);

        return $this->db->get('tbl_input_voucher_noedisi');

		

	}

	

	//=========================================PESAN VOUBCHER

	function updatepesanvoucher_t2($d,$id){

		$this->db->where('id_user', $id);

        $this->db->update('tbl_input_voucher',$d);

		

	}

	

	//=========================================PESAN VOUBCHER

	function updatepesanvoucher_t2_th($d,$id,$th){

		$this->db->where('id_user', $id);

		$this->db->where('tahap', $th);

        $this->db->update('tbl_input_voucher',$d);

		

	}

	function simpan_judul_edisi($d,$id){

		$this->db->where('edisi', $id);

        $this->db->update('tbl_judul_edisi',$d);

		

	}

	function insert_judul_edisi($d){

        $this->db->insert('tbl_judul_edisi',$d);

		

	}

	function simpan_judul_edisi_bn($d,$id){

		$this->db->where('edisi', $id);

        $this->db->update('tbl_judul_edisi_bonus',$d);

		

	}

	function insert_judul_edisi_bn($d){

        $this->db->insert('tbl_judul_edisi_bonus',$d);

		

	}

	

	function get_judul_edisi($id){

		$this->db->where('edisi',$id);

       return $this->db->get('tbl_judul_edisi');

		

	}

	

	function get_judul_edisi_bonus($id){

		$this->db->where('edisi',$id);

       return $this->db->get('tbl_judul_edisi_bonus');

		

	}

	function get_input_pemesan_vo($th){

		 $this->db->from('tbl_input_voucher, tbl_pesan_voucher');



		$this->db->where('tbl_input_voucher.id_user = tbl_pesan_voucher.id_user');



		$this->db->order_by('tbl_input_voucher.id' ,'DESC');



		$this->db->where('tbl_input_voucher.edisi', $th);

		$this->db->where('tbl_input_voucher.status', 1);

		$this->db->where('tbl_input_voucher.bonus', 0);

      return  $this->db->get();

		

	}

	

	function get_input_pemesan_vo_bonus_rev($th){

		 $this->db->from('tbl_input_voucher, tbl_pesan_voucher');



		$this->db->where('tbl_input_voucher.id_user = tbl_pesan_voucher.id_user');



		$this->db->order_by('tbl_input_voucher.id' ,'DESC');



		$this->db->where('tbl_input_voucher.edisi', $th);

		$this->db->where('tbl_input_voucher.status', 1);

		$this->db->where('tbl_input_voucher.bonus', 1);

      return  $this->db->get();

		

	}

    

    function get_input_pemesan_vo_bonus($th){

		 $this->db->from('tbl_input_voucher');





		$this->db->order_by('id' ,'DESC');



		$this->db->where('edisi', $th);

		$this->db->where('status', 1);

		$this->db->where('bonus', 1);

      return  $this->db->get();

		

	}

	

	function get_total_peredisi($th){

		 $q = $this->get_input_pemesan_vo($th);



		$tot=0;

		$qty=0;



		if($q->num_rows()>0){



			foreach($q->result() as $t){

				

				$tot = $tot + ($t->saldo);

			}



		}

		

		return $tot;

		

	}



	function get_total_peredisi_bonus($th){

		 $q = $this->get_input_pemesan_vo_bonus($th);



		$tot=0;

		$qty=0;



		if($q->num_rows()>0){



			foreach($q->result() as $t){

				

				$tot = $tot + ($t->saldo);

			}



		}

		

		return $tot;

		

	}

	

	//=========================================PESAN VOUBCHER

	function simpan_perubahan_tbl_voucher($d,$id){

		 $this->db->where('id ', $id);

        $this->db->update('tbl_pesan_voucher',$d);

		

	}

	//=========================================PESAN VOUBCHER

	function simpan_perubahan_tbl_voucher_input($d,$id){

		 $this->db->where('id ', $id);

        $this->db->update('tbl_input_voucher',$d);

		

	}

	//=========================================PESAN VOUBCHER

	function simpan_perubahan_tbl_pesan_voc_eds($d,$id){

		 $this->db->where('id_user ', $id);

        $this->db->update('tbl_pesan_voucher',$d);

		

	}

	///==================================================================GETM TRANSAKSI 

	function get_all_transaksi(){

		$this->db->from('tbl_transaksi');

		$this->db->where('buy','dibayar'); ///yang di ambil beli ..

		$this->db->order_by('id','DESC'); ///yang di ambil beli ..

		return $this->db->get();

	}

	function block_produk_model($id,$d){

        $this->db->where('id', $id);

        $this->db->update('tbl_produk',$d);

		

	}

	

	function kosong_data(){

        $this->db->where('id_unit !=', 0);

        $this->db->delete('ueu_tbl_user');

		

	}

	function simpan_save_data($d,$id){

        $this->db->where('id ', $id);

        $this->db->update('tbl_produk',$d);

		

	}

	///

	function jmlh_produk_dibeli($id_pembeli){

        $this->db->from('tbl_produk, tbl_transaksi');



		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');



		$this->db->where('tbl_transaksi.buy','dibayar');



		$this->db->where('id_pembeli',$id_pembeli);



		$q = $this->db->get();



		$tot=0;

		$qty=0;



		if($q->num_rows()>0){



			foreach($q->result() as $t){

				if(empty($t->hargak)){

					$harga=$t->harga;

				}else{

					$harga=$t->hargak;

				}

				$tot = $tot + ($t->qty * $harga);

				$qty=$qty+$t->qty;

			}



		}

		

		return $qty;

		//return $tot;

		

	}

	///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_riwayat_belanja($id){

		$this->db->from('tbl_transaksi');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('metode','VOUCHER'); ///yang di ambil beli ..

		$this->db->where('id_user',$id); ///yang di ambil beli ..

		return $this->db->get();

	}

	///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_riwayat_belanja_pesan($id){

		$this->db->from('tbl_transaksi');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('buy','dipesan'); ///yang di ambil beli ..

		$this->db->where('metode','VOUCHER'); ///yang di ambil beli ..

		$this->db->where('id_user',$id); ///yang di ambil beli ..

		return $this->db->get();

	}

	

	///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_riwayat_belanja_voucerdipake($id){

		$q=$this->get_riwayat_belanja($id);

		$q2=$this->get_riwayat_belanja_pesan($id);

		if($q->num_rows()>0){

		$tot=0;

			foreach($q->result() as $t){

				

				$tot = $tot + ($t->qty * $t->harga_satuan);

				$qty=$tot;

			}



		}else{

			$qty=0;

		}

		if($q2->num_rows()>0){

		$tot2=0;

			foreach($q2->result() as $t2){

				

				$tot2 = $tot2 + ($t2->qty * $t2->harga_satuan);

				$qty2=$tot2;

			}



		}else{

			$qty2=0;

		}

		

		return $qty2+$qty;

	}

	///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_all_transaksi_grupbln($thn=2017){

		$this->db->from('tbl_transaksi');

		//$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..

		$this->db->order_by('tbl_transaksi.bln','DESC'); ///yang di ambil beli ..

		$this->db->group_by('tbl_transaksi.bln'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		$this->db->where('tbl_transaksi.bln !=','0');

		return $this->db->get();

    }

        

    ////////LEBIH RINGAN    

    function get_all_transaksi_idbln($bln){

		$this->db->from('tbl_produk, tbl_transaksi');

		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->order_by('tbl_transaksi.bln','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		$this->db->where('tbl_transaksi.bln !=','0');

		return $this->db->get();

	}

	///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_transaksi_grupbln($bln,$thn){

		$this->db->from('tbl_transaksi');

		//$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..

		$this->db->order_by('tbl_transaksi.id','ASC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}

    ///==================================================================GETM TRANSAKSI GRUB BY idpembeli

	function get_transaksi_sort_job($bln,$thn,$st){

        $this->db->select('*');
        $this->db->select('sum(qty) AS grqty',FALSE);
        $this->db->select('sum(qty*harga_satuan) AS ttotharga',FALSE);
       
        $this->db->from('tbl_transaksi');
        
        $this->db->join('ueu_tbl_user a','a.idlog = tbl_transaksi.id_user','right');
		
        
		//$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');
            
		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.id_user !=',0); ///yang di ambil beli ..

		$this->db->where('a.job',$st); ///yang di ambil beli ..

      //  $this->db->order_by('grqty','DESC'); ///yang di ambil beli ..

        $this->db->order_by('grqty','DESC'); ///yang di ambil beli ..
            $this->db->order_by('ttotharga','DESC'); ///yang di ambil beli ..
        $this->db->order_by('id','DESC'); ///yang di ambil beli ..
        
        $this->db->group_by('tbl_transaksi.id_user'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}
    
    ////////rinci no gropu
    function get_transaksi_sort_job_rinci($bln,$thn,$st,$id_p){

		$this->db->from('ueu_tbl_user, tbl_transaksi');

		$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.id_user',$id_p); ///yang di ambil beli ..

		$this->db->where('ueu_tbl_user.job',$st); ///yang di ambil beli ..

        $this->db->order_by('tbl_transaksi.qty','DESC'); ///yang di ambil beli ..

        $this->db->order_by('tbl_transaksi.total','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}
    
    function subtot_qty_idp($bln,$thn,$st,$id_p,$pl){
        $a=$this->get_transaksi_sort_job_rinci($bln,$thn,$st,$id_p);
        $qt=0;
        $t=0;
        foreach($a->result() as $gidp_r){
            $qt=$qt+$gidp_r->qty;
                   /* if(empty($this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak)){
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->harga;	
        			}else{
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak;	
        			}
                    ///*/
                   $hrgasatuan_r=0;
        			if($gidp_r->harga_satuan!=0){
        				$akhirsat_r=$gidp_r->harga_satuan;
        			}else{
        				$akhirsat_r=$hrgasatuan_r;
        			} 
            $t=$t+($akhirsat_r*$gidp_r->qty);
            
            }
            
            switch ($pl){
                case '1':
                return $qt;
                break;
                case '2':
                return $t;
                break;
            }
            
    }
    
    /////NOLOGIN
    function subtot_qty_idp_nologin($bln,$thn,$id_p,$pl){
        $a=$this->get_transaksi_nosort_job_sr1_rinci($bln,$thn,$id_p);
        $qt=0;
        $t=0;
        foreach($a->result() as $gidp_r){
            $qt=$qt+$gidp_r->qty;
                    /*if(empty($this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak)){
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->harga;	
        			}else{
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak;	
        			}///*/
        			if($gidp_r->harga_satuan!=0){
        				$akhirsat_r=$gidp_r->harga_satuan;
        			}else{
        				$akhirsat_r=$hrgasatuan_r;
        			} 
            $t=$t+($akhirsat_r*$gidp_r->qty);
            
            }
            
            switch ($pl){
                case '1':
                return $qt;
                break;
                case '2':
                return $t;
                break;
            }
            
    }
    ////20180125
    function get_transaksi_nosort_job($bln,$thn){
        
        $this->db->select('*');
        $this->db->select('sum(qty*harga_satuan) AS ttotharga',FALSE);
        $this->db->select('sum(qty) AS grqty',FALSE);
		$this->db->from('tbl_transaksi');
		//$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.id_user',0); ///yang di ambil beli ..

        $this->db->order_by('grqty','DESC'); ///yang di ambil beli ..
        $this->db->order_by('ttotharga','DESC'); ///yang di ambil beli ..
        $this->db->order_by('id','DESC'); ///yang di ambil beli ..
        $this->db->group_by('tbl_transaksi.id_pembeli'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}

     ///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_transaksi_sort_job_harga($bln,$thn,$st){
        
        $this->db->select('*');
        $this->db->select('sum(qty*harga_satuan) AS ttotharga',FALSE);
        $this->db->select('sum(qty) AS grqty',FALSE);

		$this->db->from('ueu_tbl_user, tbl_transaksi');

		$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');
         $this->db->group_by('tbl_transaksi.id_pembeli'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..

	    $this->db->where('ueu_tbl_user.job',$st); ///yang di ambil beli ..
         

        $this->db->order_by('ttotharga','DESC'); ///yang di ambil beli ..
        $this->db->order_by('grqty','DESC'); ///yang di ambil beli ..
        $this->db->order_by('id','DESC'); ///yang di ambil beli ..
       

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}

    
    function get_transaksi_sort_job_harga_rinci($bln,$thn,$st,$id_p){

		$this->db->from('ueu_tbl_user, tbl_transaksi');

		$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..

	    $this->db->where('ueu_tbl_user.job',$st); ///yang di ambil beli ..
        $this->db->where('tbl_transaksi.id_user',$id_p); ///yang di ambil beli ..
        

        $this->db->order_by('tbl_transaksi.total','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}
    
    ////GA LOGIn 
    function get_transaksi_nosort_job_sr1_rinci($bln,$thn,$id_p){
        
       ///*
        $this->db->select('*');
        $this->db->select('(qty*harga_satuan) AS ttotharga',FALSE);
        $this->db->select('(qty) AS grqty',FALSE);
        //*/
		$this->db->from('tbl_transaksi');

		//$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..

        $this->db->where('tbl_transaksi.id_pembeli',$id_p); ///yang di ambil beli ..
        
        $this->db->where('tbl_transaksi.id_user',0); ///yang di ambil beli ..
        

        $this->db->order_by('grqty','DESC'); ///yang di ambil beli ..
        $this->db->order_by('ttotharga','DESC'); ///yang di ambil beli ..
        $this->db->order_by('id','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}
    
    
    function get_transaksi_nosort_job_sr1_rinci_hrg($bln,$thn,$id_p){
        
        $this->db->select('*');
        $this->db->select('(qty*harga_satuan) AS ttotharga',FALSE);
        $this->db->select('(qty) AS grqty',FALSE);

		$this->db->from('tbl_transaksi');

		//$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..

        $this->db->where('tbl_transaksi.id_pembeli',$id_p); ///yang di ambil beli ..
        
        $this->db->where('tbl_transaksi.id_user',0); ///yang di ambil beli ..
        

        $this->db->order_by('ttotharga','DESC'); ///yang di ambil beli ..
        $this->db->order_by('grqty','DESC'); ///yang di ambil beli ..
        
        $this->db->order_by('id','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}

    ///////20180125
    function get_transaksi_nosort_job_harga($bln,$thn){
        $this->db->select('*');
        $this->db->select('sum(qty*harga_satuan) AS ttotharga',FALSE);
        $this->db->select('sum(qty) AS grqty',FALSE);
		$this->db->from('tbl_transaksi');

		//$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..
        $this->db->group_by('tbl_transaksi.id_pembeli'); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.id_user',0); ///yang di ambil beli ..


        $this->db->order_by('ttotharga','DESC'); ///yang di ambil beli ..
        
        $this->db->order_by('grqty','DESC'); ///yang di ambil beli ..
        
        $this->db->order_by('id','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}

	///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_transaksi_grupbln_qty($bln,$thn){

		$this->db->from('tbl_transaksi');

		//$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..		
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..		

        //$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..

		$this->db->order_by('tbl_transaksi.qty','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}

	///==================================================================GETM TRANSAKSI get_transaksi_all_qty

	function get_transaksi_all_qty(){

		$this->db->from('tbl_produk, tbl_transaksi');

		$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

        ///yang di ambil beli ..

	    $this->db->group_by('tbl_transaksi.id_produk');

		$this->db->order_by('tbl_transaksi.qty','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		$this->db->limit('10');

		

		return $this->db->get();

	}

    

    ///===============================GETM TRANSAKSI get_transaksi_all_qty_laris LARIS

	function get_transaksi_all_qty_laris(){

		$this->db->from('tbl_produk');

		$this->db->order_by('tbl_produk.laris','DESC'); ///yang di ambil beli ..

		$this->db->limit('10');

		

		return $this->db->get();

	}

	///==================================================================GETM TRANSAKSI GRUB BY BLN

	function get_transaksi_grupbln_harga($bln,$thn){

		$this->db->from('tbl_transaksi');
        //$this->db->select('*, SUM(qty*harga_satuan)  AS g_total');

		//$this->db->where('tbl_produk.id = tbl_transaksi.id_produk');

		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');

		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..
		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..

		//$this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..

		//$this->db->order_by('tbl_produk.harga','DESC'); ///yang di ambil beli ..

		$this->db->order_by('tbl_transaksi.total','DESC'); ///yang di ambil beli ..

		$this->db->where('tbl_transaksi.metode !=','');

		return $this->db->get();

	}

	

	function total_transaksiperbln($bln,$sort){

				 if($sort==NULL){

				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln);

				  	

				  }elseif($sort=='b1'){

				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln);

                  }elseif($sort=='b2'){

				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_qty($bln);

				  }elseif($sort=='b3'){

				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_harga($bln);

				  }

				  //

				   

				   if($get_id_produk->num_rows() > 0){

				   $totperbln=0;

				   

                  	foreach($get_id_produk->result() as $gidp){

                  		if(empty($this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak)){

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->harga;	

			}else{

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak;	

			}

			if($gidp->harga_satuan!=0){

				$akhirsat=$gidp->harga_satuan;

			}else{

				$akhirsat=$hrgasatuan;

			}

                  		$totperbln=$totperbln+$akhirsat*$gidp->qty;

                  		} 	

                  	return($totperbln);

				   }else{

				   	return(0);

				   }

				  

				  

	}
    
    function total_transaksiperbln_thn($bln,$sort,$thn){

				$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln,$thn);

				  //

				   

				   if($get_id_produk->num_rows() > 0){

				   $totperbln=0;

				   

                  	foreach($get_id_produk->result() as $gidp){

                  		if(empty($this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak)){

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->harga;	

			}else{

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak;	

			}

			if($gidp->harga_satuan!=0){

				$akhirsat=$gidp->harga_satuan;

			}else{

				$akhirsat=$hrgasatuan;

			}

                  		$totperbln=$totperbln+$akhirsat*$gidp->qty;

                  		} 	

                  	return($totperbln);

				   }else{

				   	return(0);

				   }

				  

				  

	}
    
    ///REV20180125
    function total_tanpa_sort($bln,$thn){

				$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln,$thn);

				  //

				   

		    if($get_id_produk->num_rows() > 0){

		    $totperbln=0;

            foreach($get_id_produk->result() as $gidp){

            
            /*if(empty($this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak)){

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->harga;	

			}else{

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak;	

			}///*/

			if($gidp->harga_satuan!=0){

				$akhirsat=$gidp->harga_satuan;

			}else{

				$akhirsat=0;

			}

                  		$totperbln=$totperbln+$akhirsat*$gidp->qty;

                  		} 	

                  	return($totperbln);

				   }else{

				   	return(0);

				   }

				  

				  

	}



	function total_transaksiperbln_id($bln,$id,$thn){

			//$get_id_produk=$this->Madmin->get_all_transaksi($bln,$this->session->userdata('id_user'));
			$get_id_produk=$this->Madmin->get_all_transaksi_perbln($bln,$this->session->userdata('id_user'),$thn);

				  //

				   

		    if($get_id_produk->num_rows() > 0){

			  $totperbln=0;

				   

            foreach($get_id_produk->result() as $gidp){
            
            $hrgasatuan=0;
            $gprod=$this->Madmin->get_produk_by_id($gidp->id_produk);
            if($gprod->num_rows() > 0){
            if(empty($gprod->row()->hargak)){
			$hrgasatuan= $gprod->row()->harga;	
			}else{
			$hrgasatuan= $gprod->row()->hargak;	
			}  
            }

			if($gidp->harga_satuan!=0){

				$akhirsat=$gidp->harga_satuan;

			}else{

				$akhirsat=$hrgasatuan;

			}

                  		$totperbln=$totperbln+$akhirsat*$gidp->qty;

                  		} 	

                  	return($totperbln);

				   }else{

				   	return(0);

				   }

				  

				  

	}

    

    /////////////26/10/17

    

	function simpan_save_onoffvoc($d){

       

       // $this->db->where('id ', $id);

        //$this->db->update('tbl_onoff_voucher',$d);

        $this->db->insert('tbl_onoff_voucher',$d);

		

	}

    function simpan_save_onoffvoc_all($d){

       

       // $this->db->where('id ', $id);

        //$this->db->update('tbl_onoff_voucher',$d);

        $this->db->insert('tbl_onoff_all_voucher',$d);

		

	}

    function simpan_up_onoffvoc($id,$d){

       

        $this->db->where('id_user ', $id);

        $this->db->update('tbl_onoff_voucher',$d);

		

	}

    

    function get_onoffvoc($id){

       

        $this->db->where('id_user ', $id);

       return $this->db->get('tbl_onoff_voucher');

		

	}

    function get_onoffvoc_all(){

       

        //$this->db->where('id_user ', $id);

        $this->db->order_by('id ', 'DESC');

       return $this->db->get('tbl_onoff_all_voucher');

		

	}

    function get_onoffvoc_pervc($id,$svc){

       

        $this->db->where('id_user ', $id);

       $q= $this->db->get('tbl_onoff_voucher');

       $r='0';

       if($q->num_rows() > 0){

           switch ($svc) {

               case '1':

               $r=$q->row()->vc1;

               break;

               case '2':

               $r=$q->row()->vc2;

               break;

               case '3':

               $r=$q->row()->vc3;

               break;

           }

       }

       

       return $r;

		

	}



    

    function get_onoffvoc_pervc_all($svc){

       

       $this->db->order_by('id ', 'DESC');

       $q= $this->db->get('tbl_onoff_all_voucher');

       $r='0';

       if($q->num_rows() > 0){

           switch ($svc) {

               case '1':

               $r=$q->row()->vc1;

               break;

               case '2':

               $r=$q->row()->vc2;

               break;

               case '3':

               $r=$q->row()->vc3;

               break;

           }

       }

       

       return $r;

		

	}

    

    function kosongkan_expired_voc($d){

        $this->db->where('metode','VOUCHER');

        $this->db->where('buy','DIPESAN');

        $this->db->update('tbl_transaksi',$d);

    }

    function kosongkan_user_sal_voc($d){

       // $this->db->where('voucher_umy !=','0');

        //$this->db->where('voucher_dibelanjakan !=','0');

        $this->db->update('ueu_tbl_user',$d);

    }

    function get_tblaccmek($id){
        $this->db->where('id_transaksi',$id);
        return $this->db->get('tbl_acc_mek');
    }
    
    function get_akunperstatus($id){
        $this->db->where('job',$id);
        $this->db->where('status !=' ,3);
		$this->db->where('status !=' ,0);
        $this->db->where('wewenang !=','admin');
        $this->db->where('status' ,1);
        return $this->db->get('ueu_tbl_user');
    }
    
    function get_all_akun_all($s){
        
        

		$this->db->where('status' ,$s);
        $this->db->where('status !=' ,3);
		$this->db->where('status !=' ,0);
        $this->db->where('wewenang !=','admin');

		return $this->db->get('ueu_tbl_user');

	}
    
    

	

}