<?php

class M_loadFirst extends CI_Model {

    function UpTransaksiProses($id){
    $d=[
        'proses'=>1,
        'ket'=>'selesai',
        'tgl_up'=>$this->M_time->harinow(),
    ];
    $this->db->where('idTransaksi',$id);
    $this->db->where('proses',2);
    $a=$this->db->update('tbl_transaksi_proses',$d);

    if ($a) {
        return 'sukses';
    }
    
    }

    function UpTransaksi($id){
    $d=[
        'buy'=>'dibayar',
    ];
    $this->db->where('id',$id);
    $this->db->where('buy','diproses');
    $a=$this->db->update('tbl_transaksi',$d);

    if ($a) {
        return 'sukses';
    }
    
    }

    ///jika durasi habis
    function UpTransaksi_dipesan($id){
    $d=[
        'buy'=>'expired',
    ];
    $this->db->where('id_user',$id);
    $this->db->where('metode','VOUCHER');
    $this->db->where('buy','dipesan');
    $a=$this->db->update('tbl_transaksi',$d);

    if ($a) {
        return 'sukses';
    }
    
    }
    
    ///jika durasi habis
    function saldo_expired($id){
    $d=[
        'proses'=>3, ///3=expired
    ];
    
    $this->db->where('id_user',$id)
         ->where('proses',1);
    
    $a=$this->db->update('tbl_saldovoc',$d);

    if ($a) {
        return 'sukses';
    }

    
    }

    function get_Produk_diproses_pembeli($id_user){
        $this->db->from('tbl_transaksi_proses, tbl_transaksi');
        $this->db->where('tbl_transaksi_proses.idTransaksi = tbl_transaksi.id');

        $this->db->where('tbl_transaksi.id_user',$id_user); ///yang di ambil beli ..
        $this->db->where('tbl_transaksi_proses.proses',2); ///yang di ambil beli ..
        $this->db->where('tbl_transaksi.buy','diproses'); ///yang di ambil beli ..
        $this->db->group_by('tbl_transaksi_proses.idTransaksi'); ///yang di ambil beli ..

        $this->db->order_by('tbl_transaksi.id','DESC'); ///yang di ambil beli ..
        return $this->db->get();
    }

	
}