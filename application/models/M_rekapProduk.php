<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rekapProduk extends CI_Model {

public function get_perKategori($id=1)
{
		$day=$this->session->userdata('T_tgl');
        $thn=$this->session->userdata('T_thn');
        $bln=$this->session->userdata('T_bln');


    	if ($day!="S") {
           $this->db->where('tbl_transaksi.day',$day);
        }

        if ($bln!="S") {
           $this->db->where('tbl_transaksi.bln',$bln);
        }

        if ($thn!="S") {
           $this->db->where('tbl_transaksi.thn',$thn);
        }
    $this->db->select('id_k, id_produk, thn, bln , day, qty , ueu_tbl_user.nama, tbl_produk.nama as namaProduk, sum(qty) as sqty');
	return $this->db->from('tbl_produk, tbl_transaksi, ueu_tbl_user')
	->where('tbl_produk.id = tbl_transaksi.id_produk')
	->where('tbl_produk.id_user = ueu_tbl_user.idlog')
	->where('tbl_produk.id_k',$id)
	->group_by('tbl_transaksi.id_produk')
	->order_by('sqty', 'DESC')
	->get();

}

public function get_perStatusAkun($id=1)
{
		$day=$this->session->userdata('T_tgl');
        $thn=$this->session->userdata('T_thn');
        $bln=$this->session->userdata('T_bln');


    	if ($day!="S") {
           $this->db->where('tbl_transaksi.day',$day);
        }

        if ($bln!="S") {
           $this->db->where('tbl_transaksi.bln',$bln);
        }

        if ($thn!="S") {
           $this->db->where('tbl_transaksi.thn',$thn);
        }

    $this->db->select('id_pelapak, thn, bln , day, qty ,nama, job, sum(qty) as sqty');
	return $this->db->from('ueu_tbl_user, tbl_transaksi')
	->where('ueu_tbl_user.idlog = tbl_transaksi.id_pelapak')
	->where('ueu_tbl_user.job',$id)
	->group_by('tbl_transaksi.id_pelapak')
	->order_by('sqty', 'DESC')
	->get();

}

function getTotal_perKategori($id){

	$a=$this->get_perKategori($id);
	$totPro=0;
	if ($a->num_rows() > 0) {
		foreach ($a->result() as $key) {
			$totPro=$totPro+$key->sqty;
		}
	}
	// return $a->num_rows();
	return $totPro;
}

function getTotal_perStatusAkun($id){

	$a=$this->get_perStatusAkun($id);
	$totPro=0;
	if ($a->num_rows() > 0) {
		foreach ($a->result() as $key) {
			$totPro=$totPro+$key->sqty;
		}
	}
	// return $a->num_rows();
	return $totPro;
}

}