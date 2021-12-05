<?php
class M_rekapPenjualan extends CI_Model {
	function __construct()
	{

		parent::__construct();

	}

    function G_gruopthntransaksi(){
        $query = "SELECT * FROM `tbl_transaksi` WHERE `thn` != 0 GROUP BY `thn` ORDER BY `thn` DESC";   
        return $this->db->query($query);
    }

    function blnKeindo($bln){

      $pbln=substr($bln, -1);
      if ($bln>=10) {
      $pbln=substr($bln, -2);
      }
        $blnaray=array(
                    '1'=>'Januari',
                    '2'=>'Februari',
                    '3'=>'Maret',
                    '4'=>'April',
                    '5'=>'Mei',
                    '6'=>'Juni',
                    '7'=>'Juli',
                    '8'=>'Agustus',
                    '9'=>'September',
                    '10'=>'Oktober',
                    '11'=>'November',
                    '12'=>'Desember',
        );

        return $blnaray[$pbln];

    }

    public function get_listAkun_rekap()
    {
        # code...
        
        // $job=3;
        $day=$this->session->userdata('T_tgl');
        $thn=$this->session->userdata('T_thn');
        $bln=$this->session->userdata('T_bln');

        $job=$this->session->userdata('statusP');
        $kdP='';
        if ($job==3) {
            $kdP=$this->session->userdata('sProdiP');
        }
        
        $d=[

            // 'ueu_tbl_user.status'=>1,
            'tbl_transaksi.buy'=>'dibayar',

        ];

        if ($day!="S") {
           $this->db->where('tbl_transaksi.day',$day);
        }

        if ($bln!="S") {
           $this->db->where('tbl_transaksi.bln',$bln);
        }

        if ($thn!="S") {
           $this->db->where('tbl_transaksi.thn',$thn);
        }

        if ($kdP!=0) {
           $this->db->where('ueu_tbl_user.kode_prodi',$kdP);
        }

        if ($job!=0) {
           $this->db->where('ueu_tbl_user.job',$job);
        }

        $a=$this->db->where($d)
        ->from('ueu_tbl_user,tbl_transaksi')
        ->where('ueu_tbl_user.idlog = tbl_transaksi.id_pelapak')
       ->group_by('tbl_transaksi.id_pelapak')
        ->order_by('tbl_transaksi.id_tgl')
        // ->join('tbl_transaksi','ueu_tbl_user.idlog = tbl_transaksi.id_pelapak','left')
        ->get();

        return $a;
    }

    function get_transaksiPendapatanPenjual($id_user,$via,$buy){

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

    $d=[

        'id_pelapak'=>$id_user,
        'metode'=>$via,
        'buy'=>$buy,

    ];
    $a=$this->db->where($d)
    ->get('tbl_transaksi');

    return $a;
                

    }

    function get_transaksiPendapatanPenjualStatus($id_status,$via,$buy){

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

    $d=[

        'job'=>$id_status,
        'metode'=>$via,
        'buy'=>$buy,

    ];

    $this->db->SELECT('idlog,job,thn,bln,day,metode,buy,id_pelapak,qty,harga_satuan');
    $this->db->from('ueu_tbl_user,tbl_transaksi')
        ->where('ueu_tbl_user.idlog = tbl_transaksi.id_pelapak');
    $a=$this->db->where($d)
    ->get();

    return $a;
                

    }
//// get transaksi pembelian per status
    function get_transaksiPembelianPenjualStatus($id_status,$via,$buy){

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

    $d=[

        'job'=>$id_status,
        'metode'=>$via,
        'buy'=>$buy,

    ];

    $this->db->SELECT('idlog,job,thn,bln,day,metode,buy,id_user,qty,harga_satuan');
    $this->db->from('ueu_tbl_user,tbl_transaksi')
        ->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');
    $a=$this->db->where($d)
    ->get();

    return $a;
                

    }
    ///get_BelanjaPembeli
    function get_pendapatanPenjual($id_p,$via,$buy='dibayar'){

        $a=$this->get_transaksiPendapatanPenjual($id_p,$via,$buy);


        $tot=0;
        if ($a->num_rows()==0) {
            return $tot;
        }
        foreach ($a->result() as $key) {
            $tot=$tot+($key->qty*$key->harga_satuan);
        }

        return $tot;


    }

    ////get transaksi per status
    function get_pendapatanStatus($id_s,$via,$buy='dibayar',$t='d'){
        if ($t=='b') {
            $a=$this->get_transaksiPembelianPenjualStatus($id_s,$via,$buy);
        }else{
            $a=$this->get_transaksiPendapatanPenjualStatus($id_s,$via,$buy);    
        }
        


        $tot=0;
        if ($a->num_rows()==0) {
            return $tot;
        }
        foreach ($a->result() as $key) {
            $tot=$tot+($key->qty*$key->harga_satuan);
        }

        return $tot;


    }

    function get_transPerProdi($kode_prodi){

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

    $d=[

        // 'id_pelapak'=>$id_user,
        // 'metode'=>$via,
        'tbl_transaksi.buy'=>'dibayar',
        'ueu_tbl_user.kode_prodi'=>$kode_prodi,
        'ueu_tbl_user.job'=>3,
        'ueu_tbl_user.status'=>1,



    ];
    $a=$this->db->where($d)
        ->from('ueu_tbl_user,tbl_transaksi')
        ->where('ueu_tbl_user.idlog = tbl_transaksi.id_pelapak')
        // ->group_by('tbl_transaksi.id_pelapak')
        // ->order_by('tbl_transaksi.id_tgl')
        ->get();

        return $a;

    return $a;
                

    }

    public function get_TotPerProdi($kode_prodi)
    {
        $a=$this->get_transPerProdi($kode_prodi);
        

        $tot=0;
        if ($a->num_rows()==0) {
            return $tot;
        }
        foreach ($a->result() as $key) {
            $tot=$tot+($key->qty*$key->harga_satuan);
        }

        return $tot;
    }




}///class