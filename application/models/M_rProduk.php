<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rProduk extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function cekData($dt)
	{
		return $dt['data'];
	}
	
	function varProduk($id=0,$id_user=0){
		
		$d=[
			'produk'=>[
				'idProduk'=>$id,
				'kategori'=>[
					'idKat'=>0,
					'namaKat'=>0,
				],
				'nama'=>0,
				'harga'=>0,
				'harga_'=>0,
				'deskripsi'=>0,
				'kualitas'=>[
					'bobot'=>0,
					'mendali'=>0,
					'gbr_mendali'=>0,
				 ],
				'view'=>0,
				'rating'=>0,
				'satuan'=>0,
				'gambar'=>0,
				'tgl_post'=>0,
			],
			'penjual'=>[
				'idPenjual'=>$id_user,
				'nama'=>0,
				'alamat'=>0,
				'noHp'=>0,
				'email'=>0,
				'NBM'=>0,
				'foto'=>0,
				'foto_nbm'=>0,
				'job'=>0,
				'ni'=>0,
				'status'=>0,
				'kelamin'=>0,
				'bank'=>0,
				'rek'=>0,
				'tgl_daftar'=>0,

			],
			'persedian'=>[
				'tersedia'=>0,
				'terjual'=>0,
				'dipesan'=>0,
				'ditolak'=>0,
			],
		];

		return $d;


	}

	public function getProdukId($id)
	{
		
		$get_prod=$this->Muser->get_produk_by_id($id);
		if ($get_prod->num_rows() == 0) {
			return $this->varProduk($id);
		}
		$cell=$get_prod->row();
		////
		$harga=$this->Mtrans->get_hargaproduk($id);	
		////
		$lapPro=$this->viewLaporanProduk($id);
		////
		$mendali=$this->ketMendali($lapPro['kualitas']);
		////
		//PERSEDIAN
            //============================================================
             $qty=$this->Mtrans->get_produkqty($id); //terjual
             $qty2pesan=$this->perhitunganQty($id,'dipesan');  ///id_produk
             $qty2tolak=$this->perhitunganQty($id,'Batal_ot');  ///id_produk
            //============================================================
             $stoka=$cell->stok-$qty;
            //============================================================
		////
		$d=[
			'produk'=>[
				'idProduk'=>$id,
				'kategori'=>[
					'idKat'=>$cell->id_k,
					'namaKat'=>$cell->kategori,
				],
				'nama'=>$cell->nama,
				'deskripsi'=>$cell->deskripsi,
				'satuan'=>$cell->satuan,
				'gambar'=>$cell->gambar,
				'tgl_post'=>$cell->tanggal,
				///
				'harga'=>$cell->harga,
				'harga_'=>$harga,
				///
				'view'=>$lapPro['view'],
				'kualitas'=>[
					'bobot'=>$lapPro['kualitas'],
					'mendali'=>$mendali->mendali,
					'gbr_mendali'=>$mendali->gbr_mendali,
				 ],
				'rating'=>$lapPro['rating'],
			],		
			'persedian'=>[
				'tersedia'=>$stoka,
				'terjual'=>$qty,
				'dipesan'=>$qty2pesan,
				'ditolak'=>$qty2tolak,
			],
		];

		//=============================
		$guser=$this->Muser->get_user_by_id($cell->id_user);
		if ($get_prod->num_rows() == 0) {
			return $this->varProduk($id,$cell->id_user);
		}
		$cell_user=$guser->row();

		$d+=[
			'penjual'=>[
				'idPenjual'=>$cell->id_user,
				'nama'=>$cell_user->nama,
				'alamat'=>$cell_user->alamat,
				'noHp'=>$cell_user->no_kontak,
				'email'=>$cell_user->username,
				'NBM'=>$cell_user->nbm,

				'foto'=>$cell_user->img,
				'foto_nbm'=>$cell_user->file_nbm,
				'job'=>$cell_user->job,
				'ni'=>$cell_user->ni,
				'status'=>$cell_user->status,
				'kelamin'=>$cell_user->jenis_kelamin,
				'bank'=>$cell_user->bank,
				'rek'=>$cell_user->rek,
				'tgl_daftar'=>$cell_user->tanggal,
			],
		];


		return ($d);
	}

	function get_idprodukProses($id_b,$pro){
		$this->db->where('buy',$pro);
		$this->db->where('id_produk',$id_b);
		return $this->db->get('tbl_transaksi');

	}

	public function perhitunganQty($id_b,$pro)
	{
		$gt=$this->get_idprodukProses($id_b,$pro);

		if($gt->num_rows() > 0){
			$agtq=0;
			foreach($gt->result() as $gtq){
				$agtq=$agtq+$gtq->qty;
			}
		}else{
			$agtq=0;
		}

		return $agtq;
	}

	function laporanProduk($id){
        $this->db->from('tbl_produk, tbl_laporan_produk');
        $this->db->where('tbl_produk.id = tbl_laporan_produk.id_produk');
        $this->db->where('id_produk',$id);
        $a=$this->db->get();
        return $a;
	}

	function viewLaporanProduk($id){
        $a=$this->laporanProduk($id);
        $data=[
        		'view'=>0,
        		'rating'=>0,
        		'kualitas'=>0,
        		'catatan'=>0,
        		'tgl'=>0,
        	];
        if ($a->num_rows() > 0) {
        	$data=[
        		'view'=>$a->row()->view,
        		'rating'=>$a->row()->rating,
        		'kualitas'=>$a->row()->kualitas,
        		'catatan'=>$a->row()->catatan,
        		'tgl'=>$a->row()->tgl,
        	];

        }
        return $data;
	}

	public function cekProduk($id=0)
	{
		return $this->laporanProduk($id)->num_rows();
	}

	function ketMendali($id=0){
       $this->db->from('tbl_mendali');
       $this->db->where('bobot',$id);
       $a=$this->db->get();
        return $a->row();
	}

}