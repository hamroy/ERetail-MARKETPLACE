<?php







class Modelnya_prayudi extends CI_Model {







	var $table = 'ueu_tbl_user';



	



	function __construct()



	{



		parent::__construct();



	}

	function jumlah_barang_baru_belum_acc()
	{
		$this->db->where('status',0);
		return $this->db->get('tbl_produk');
	}

	function jumlah_pendaftar_baru_belum_acc()
	{
		$this->db->where('status',0);
		return $this->db->get('ueu_tbl_user');
	}


	function tabel_besar()
	{
		return $this->db->get('tbl_mhs_aktif_xls');
	}

	function get_email_by_nim($nim)
	{
		$this->db->from('ueu_tbl_user, tbl_mhs_aktif_xls');
		$this->db->where('ueu_tbl_user.ni = tbl_mhs_aktif_xls.nim');
		//$this->db->where('status',1);
		$this->db->where('ueu_tbl_user.ni',$nim);
		$q = $this->db->get();
		if($q->num_rows()>0)
		{
			return $q->row()->username;//email
		}else{
			return '';
		}
	}

		function get_idvoc_by_nim($nim,$last_voucher)
	{
		$this->db->from('tbl_pesan_v_mhs, tbl_mhs_aktif_xls');
		$this->db->where('tbl_pesan_v_mhs.nik = tbl_mhs_aktif_xls.nim');
		$this->db->where('tbl_pesan_v_mhs.nik',$nim);
		$this->db->where('tbl_pesan_v_mhs.id_voc_mhs',$last_voucher);
		$q = $this->db->get();
		if($q->num_rows()>0)
		{
			return 'DIAMBIL';//email
		}elseif($this->get_email_by_nim($nim)!=''){
			return 'BELUM AMBIL';
		}else{
			return 'BELUM DAFTAR';
		}
	}

	function get_last_voucher_edition()
	{
		$this->db->order_by('id_e_mhs','desc');
		return $this->db->get('tbl_e_mhs')->row()->id_voc_mhs;
	}




	function tampilkan_info()



	{



		$this->db->order_by('id','desc');



		return $this->db->get('tbl_pengaturan_informasi');



	}	







	function update_info($u)



	{



		$this->db->insert('tbl_pengaturan_informasi',$u);



	}





	function get_transaksi_sort_job_harga($bln,$thn,$st){





		//SELECT `id_pembeli`,SUM(`qty`*`harga_satuan`) AS grandtotal FROM `tbl_transaksi` WHERE `bln`=1 AND `thn`=2018 AND `buy`= 'dibayar' AND `id_user` <> 0 GROUP BY `id_pembeli` ORDER BY grandtotal DESC

		$this->db->from('ueu_tbl_user, tbl_transaksi');



		$this->db->select('*, SUM(tbl_transaksi.qty * tbl_transaksi.harga_satuan) AS grandtotal');



		$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');







		//$this->db->where('tbl_produk.id_user = ueu_tbl_user.idlog');



         $this->db->group_by('tbl_transaksi.id_pembeli'); ///yang di ambil beli ..



		$this->db->where('tbl_transaksi.buy','dibayar'); ///yang di ambil beli ..







		$this->db->where('tbl_transaksi.bln',$bln); ///yang di ambil beli ..



		$this->db->where('tbl_transaksi.thn',$thn); ///yang di ambil beli ..







	    $this->db->where('ueu_tbl_user.job',$st); ///yang di ambil beli ..



         



		$this->db->where('tbl_transaksi.metode !=','');





        //$this->db->order_by('tbl_transaksi.total','DESC'); ///yang di ambil beli ..

        $this->db->order_by('tbl_transaksi.grandtotal','DESC'); ///yang di ambil beli ..



		return $this->db->get();







	}



       













}