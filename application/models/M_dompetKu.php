<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dompetKu extends CI_Model {

	

	public function __construct()
	{
		parent::__construct();
		
	}

    public function pendapatanDompet()
    {
        $id_user=$this->session->userdata('id_user');

        $dompet=0;
        $dompetKotor=0;
        $dompet_dicairkan=0;
        $dompet_selesai=0;
        $redeemTotal=0;
        $kode=1;
        $i=0;
        $c=$this->cek_pendatanTrue();
        //output
        if ($c==0) {
            
            $gv=$this->dompetMasukKu($id_user);

            $dompetKotor=$dompetKotor+$gv['dompet'];
            $dompet=$dompet+$gv['dompet_selesai'];
            $dompet_dicairkan=$dompet_dicairkan+$gv['redeem'];
            $dompet_selesai=$dompet_selesai+$gv['redeemSelesai'];
            $redeemTotal=$redeemTotal+$gv['redeemTotal'];
            $kode=$kode*$gv['kode'];
        

        }   
        ///

        $data['dompetKotor']=$dompetKotor;
        $data['dompetKu']=$dompet;
        
        $data['redeemTotal']=$redeemTotal;
        $data['redeemKu']=$dompet_dicairkan;
        $data['redeemSelesaiKu']=$redeemTotal-$dompet_dicairkan;
        $data['kode']=$kode;
        
        return $data;
    }

    function cek_pendatanTrue(){
        $id_user=$this->session->userdata('id_user');
        $qp=$this->dompetMasukKu($id_user);
        $fas=$this->M_setapp->setFasiltasApp();
        $x=$this->getDataDompetPerakun($id_user);
        $c=0;
        if ($fas['redeem']==0 and $x['fasRedeem']==1) {
            if($qp['dompet']!=($qp['dompet_selesai']+$qp['redeemTotal'])){
            $c=1;
            }
        }
        

        return $c;

    }

    public function saldoDompet()
    {
        $id_user=$this->session->userdata('id_user');
        
        $kode=1;
        
            $gv=$this->saldoKu($id_user); //$i = jenis voucher
            $saldoKuDiterima=$gv['saldoKuDiterima'];
            $saldo=$gv['saldo'];
            $saldo_dibelanjakan=$gv['saldo_dibelanjakan'];
            $saldo_dibelanjakanKu_proses=$gv['saldo_dibelanjakan_proses'];
            $kode=$kode*$gv['kode'];

        $data['saldoKuDiterima']=$saldoKuDiterima;
        $data['saldoKu']=$saldo;
        $data['saldo_dibelanjakanKu_proses']=$saldo_dibelanjakanKu_proses;
        $data['saldo_dibelanjakanKu']=$saldo_dibelanjakan;
        $data['kode']=$kode;

        ///
        
        return $data;
    }

    function terimaDompetPidahVoucher($id_user,$jvoc,$id_voc,$d){
        $this->db->where('id_user',$id_user)
        ->where('jvoc',$jvoc)
        ->where('id_voc',$id_voc)
        ->update('tbl_saldovoc',$d);
    }
    function getDataDompetPerakun($id_user){
        $a=$this->getDataDompetPerakun_sql($id_user);
        
        $d=[
            'saldo'=>0,
            'durasi'=>0,
            'addDurasi'=>0,
            'tgl_t'=>0,
            'proses'=>0,
            'status'=>1, //1=aktif
            'fasRedeem'=>1, //1=aktif
            'expired'=>0,
        ];

        if ($a->num_rows() > 0) {
          
          $expired = $this->M_time->durasi_ymd($a->row()->durasi,$a->row()->addDurasi);
          $d=[
            'saldo'=>$a->row()->saldo_bersih,
            'addDurasi'=>$a->row()->addDurasi,
            'durasi'=>$a->row()->durasi,
            'tgl_t'=>$a->row()->tgl_t,
            'proses'=>$a->row()->proses,
            'status'=>$a->row()->status,
            'fasRedeem'=>$a->row()->fasRedeem,
            'expired'=>$expired,//$expired //0=expired
        ];  
        }

        return $d;
    }

    public function getDataDompetPerakun_sql($id_user)
    {
        return $this->db->get_where('tbl_durasidompet',array('id_user'=>$id_user));
    }
    function saveDataDompetPerakun($d){
        $a=$this->getDataDompetPerakun_sql($d['id_user']);
        if ($a->num_rows() > 0) {
            $d_durasi=[
            'addDurasi'=>$d['addDurasi'],
        ];
            $this->db->where('id_user',$d['id_user'])
            ->update('tbl_durasidompet',$d_durasi);    
        }else{
            $this->db->insert('tbl_durasidompet',$d);    
        }
        
    }

    function getSaldoVocAll($id_user,$jvoc,$id_voc,$p=0){

       return $this->db->where('id_user',$id_user)
        ->where('jvoc',$jvoc)
        ->where('id_voc',$id_voc)
        ->where('proses',$p)
        ->get('tbl_saldovoc');
    }

    function saldoKuDiterima($id_user,$p=1){
        $a=$this->db->where('id_user',$id_user)
        ->select('proses, id_user, saldo_terima')
        ->where('proses',$p)
        ->get('tbl_saldovoc');
        $saldo=0;
        if ($a->num_rows() > 0) {
            foreach ($a->result() as $key) {
                $saldo=$saldo+$key->saldo_terima;
            }
        }

        return $saldo;

    }
    

//////////////dompet
    function dompetMasukKu($id_user){
        $jvoc=99;
        

        $gettotal_parsel_dapat = $this->get_totalTranVoucherPelapak($id_user,$jvoc,'dibayar');//tbltransaksi
       
        ////pendapatan voc parsel 
        $get_reedeem=$this->get_Total_redeemAll($id_user,'all');
        $dompet_dicairkan=$this->get_Total_redeemAll($id_user,'0');
        $dompet_selesai=$this->get_Total_redeemAll($id_user,"1");
        //
        $dompet=$gettotal_parsel_dapat-$get_reedeem;
        $fas=$this->M_setapp->setFasiltasApp();
        
        if($fas['redeem']>0){
            $dompet=0;
        }

        $x=$this->getDataDompetPerakun($id_user);
        if($x['fasRedeem']==0){
            $dompet=0;
        }
        //output
        $data['jvoc']=$jvoc;
        $data['id_user']=$id_user;
        $data['dompet']=$gettotal_parsel_dapat; //kotor
        $data['dompet_selesai']=$dompet; //bersih

        $data['redeemTotal']=$get_reedeem; //semua selaintolak
        $data['redeem']=$dompet_dicairkan; //sedang pencairan ke bmt
        $data['redeemSelesai']=$dompet_selesai; //selesai

        $data['pesan']='ok';
        $data['kode']=1;
        $data['t_rinci']='';
        ///
        
        return $data;
        
        
    }

    function getTransaksiVouchcer($id_user,$proses){
        $this->db->select('buy , metode ,id_user , qty ,harga_satuan');
        $this->db->where('buy',$proses);
        $this->db->where('metode','VOUCHER');
        $this->db->where('id_user',$id_user);
        return $this->db->get('tbl_transaksi');

    }

    function getTransaksiVouchcerPelapak($id_user,$proses){
        $this->db->select('buy , metode ,id_pelapak , qty ,harga_satuan');
        $this->db->where('buy',$proses);
        $this->db->where('metode','VOUCHER');
        $this->db->where('id_pelapak',$id_user);
        return $this->db->get('tbl_transaksi');

    }
    
    function get_totalTranVoucher($id_user,$jvoc=99,$proses){
        $a=$this->getTransaksiVouchcer($id_user,$proses);
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
    ///PENDAPATAN VOUCHER
    function get_totalTranVoucherPelapak($id_user,$jvoc=99,$proses){
        $a=$this->getTransaksiVouchcerPelapak($id_user,$proses);
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
    public function get_redeemAll($id)
    {
        $this->db->select('id_user,idlog,tbl_user_redeem.status,redeem');
        $this->db->from('tbl_user_redeem,ueu_tbl_user');
        $this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
        $this->db->where('tbl_user_redeem.id_user',$id);
        $this->db->where('tbl_user_redeem.status !=',2); ///2 == ditolak
        $a=$this->db->get();

        return $a;
    }
    public function get_redeemAllStatus($id,$sta)
    {
        $this->db->select('id_user,idlog,tbl_user_redeem.status,redeem');
        $this->db->from('tbl_user_redeem,ueu_tbl_user');
        $this->db->where('tbl_user_redeem.id_user = ueu_tbl_user.idlog');
        $this->db->where('tbl_user_redeem.id_user',$id);
        $this->db->where('tbl_user_redeem.status',$sta); ///2 == ditolak

        $a=$this->db->get();

        return $a;
    }
    function get_Total_redeemAll($id,$st='all'){ ///alll selain di tolak
        if ($st=='all') {
          $a=$this->get_redeemAll($id);   
        }else
        {
         $a=$this->get_redeemAllStatus($id,$st); 
        }
         
        

        if($a->num_rows()> 0){
            $t=0;
            foreach($a->result() as $x){
                $t=$t+($x->redeem);
            }
            return $t;
            
        }else{
            return 0;
        }
    }

    ///SALDODOMPET
    function saldoKu($id_user){
        $jvoc=99;
        $gettotal_pesan = $this->get_totalTranVoucher($id_user,$jvoc,'dipesan');  //tbltransaksi
        $gettotal_proses = $this->get_totalTranVoucher($id_user,$jvoc,'diproses');  //tbltransaksi
       
        $durasi=0;
        $hparsel=$this->saldoKuDiterima($id_user);

        $tranpesanbaayar=($gettotal_pesan+$gettotal_proses);

        $tosaldopar=$hparsel-$tranpesanbaayar; ///hasil akhir saldo

        //ONOFF VOUCHER
        
        $x=$this->getDataDompetPerakun($id_user);
        
        if($x['expired']==0){
            $tosaldopar=0;
        }

        if($x['status']==0){
            $tosaldopar=0;
        }

        $fas=$this->M_setapp->setFasiltasApp();
        if($fas['dompet']>0){
            $tosaldopar=0;
        }
        
        //output
        $data['jvoc']=$jvoc;
        $data['id_user']=$id_user;
        $data['durasi']=$durasi;

        $data['saldoKuDiterima']=$hparsel;
        $data['saldo']=$tosaldopar;
        $data['saldo_dibelanjakan']=$gettotal_pesan;
        $data['saldo_dibelanjakan_proses']=$gettotal_proses;
        $data['pesan']='ok';
        $data['kode']=1;
        
        ///
        
        return $data;
        
        
        
    }

} //class